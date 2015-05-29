<?php


// add a custom stylesheet so we can customize the login page a bit.
function lscu_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_template_directory_uri() . '/css/login.css' );
}
add_action( 'login_enqueue_scripts', 'lscu_login_stylesheet' );



// display the my account/login links based on user state.
function account_toolbox() {

	// set up a global for the current user info
	global $current_user;

	// current user information
	get_currentuserinfo();

	// get the account page link.
    $account_page = get_post( pure_get_option( 'account-page' ) );
    $account_url = get_permalink( $account_page->ID );

	// get the account page link.
    $login_page = get_post( pure_get_option( 'login-page' ) );
    $login_url = get_permalink( $login_page->ID );

	// get the referer
	$referer = ( isset( $_SERVER['HTTPS'] ) ? 'https://' : 'http://' ) . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

	if ( stristr( $referer, '/log-in/' ) ) {
		$referer = get_home_url();
	}

	// if the user is logged in.
	if ( is_user_logged_in() ) { 
		?>
		<a href="<?php print $account_url ?>" class='account-button'>My Account</a> <a href="<?php echo wp_logout_url( get_bloginfo( 'home' ) ) ?>" class="logout-button">Logout</a>
		<span class='welcome'>Welcome, <?php print ( !empty( $current_user->user_firstname ) ? $current_user->user_firstname : $current_user->user_login ); ?></span>
		<?php 
	} else { 
		?>
		<a href="<?php print $login_url ?>?redirect_to=<?php print $referer ?>" class='account-button'>Log In</a>
		<?php 
	}

}



// add a new password encryption schema that includes the username.
add_filter( 'authenticate', 'lscu_signon', 30, 3 );
function lscu_signon( $user, $username, $password ) {

	if ( isset( $_POST['log'] ) ) {
		$creds = array(
			'user_login' => $_POST['log'],
			'user_password' => $_POST['log'] . "\n" . $_POST['pwd'],
			'remember' => true
		);
		$user_check = get_user_by( 'login', $_POST['log'] );
		
		if ( $user_check->user_pass == md5( $_POST['log'] . "\n" . $_POST['pwd'] ) ) {
			return $user_check;
		}
	}

	// return the user
    return $user;

}



// when the user authenticates on LSCU, also authenticate them on InfoSight
function infosight_authenticate() {

	// let's redirect to infosight's login endpoint so that it can authenticate us on there as well.
    header( "Location: http://fl.leagueinfosight.com/Security__Login_6169.htm?email=" . $_POST['log'] . "&password=" . urlencode( $_POST['pwd'] ) . "&action=login&return_to=" . urlencode( $_POST['redirect_to'] ) );
    exit;

}
add_action('wp_login', 'infosight_authenticate');



// if the login fails for any reason, redirect the user back
// to the login form with a parameter for the login error.
function failed_login_redirect( $username ) {

    $referrer = $_SERVER["HTTP_REFERER"];
    $redirect_to = ( isset( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : get_home_url() );

    if ( $referrer && ! strstr($referrer, 'wp-login') && ! strstr($referrer,'wp-admin') ) {
    	$redirect_url = add_query_arg( 'redirect_to', $redirect_to, add_query_arg( 'login-error', 'true', $referrer ) );
        wp_redirect( $redirect_url );
        exit;
    }

}
add_action( 'wp_login_failed', 'failed_login_redirect' );



// check for empty username and password when a user is authenticating
// by default, WP doesn't even treat this as a login attempt, and redirects
// the user back to the admin login, which we'd like to avoid.
function empty_credential_error( $user, $username, $password ) {

    if ( is_a( $user, 'WP_User' ) ) return $user;

    if ( empty($username) || empty($password) ) {
        $error = new WP_Error();
        $user  = new WP_Error( 'authentication_failed', __('Neither the username nor password can be empty.' ));

        return $error;
    }

}
add_filter( 'authenticate', 'empty_credential_error', 30, 3 );


/*
// override new user notification
function wp_new_user_notification ( $user_id, $pass = '' ) {
	
	// -> Get the new user's ID.
	$user_data = new WP_User ( $user_id );
	
	// -> Build the admin payload.
	$admin_message  = sprintf ( __( 'New user registration on %s:' ), get_option('blogname')) . "\r\n\r\n";
	$admin_message .= sprintf ( __( 'Username: %s' ), $user_data->user_login ) . "\r\n\r\n";
	$admin_message .= sprintf ( __( 'E-mail: %s' ), $user_data->user_email ) . "\r\n";
	
	// -> Send out an e-mail regardless of errors.
	@wp_mail ( get_option ( 'admin_email' ) , sprintf ( __( '[%s] New User Registration' ), get_option ( 'blogname' ) ), $admin_message );
	
	// -> Return/do not continue if the password is null.
	if ( empty ( $pass ) ) return;
	

	// get the password reset page URL.
    $login_page = get_post( pure_get_option( 'login-page' ) );
    $login_url = get_permalink( $login_page->ID );

    // get the message option from our metabox.
 	$message = pure_get_option( 'welcome-email' );

    // replace shortcodes in the email message body.
    $message = str_replace( '[login-url]', $login_url, $message );
    $message = str_replace( '[user-id]', $user_data->ID, $message );
    $message = str_replace( '[first-name]', $user_data->first_name, $message );
    $message = str_replace( '[last-name]', $user_data->last_name, $message );
    $message = str_replace( '[user-login]', $user_data->user_login, $message );
    $message = str_replace( '[email]', $user_data->user_email, $message );
    $message = str_replace( '[homepage]', get_home_url(), $message );
    $message = str_replace( '[admin-email]', get_option( 'admin_email' ), $message );
    $message = str_replace( '[date]', date( 'n/j/Y' ), $message );
    $message = str_replace( '[time]', date( 'g:i a' ), $message );

	
	// -> Add line breaks to the body.
	$message = nl2br ( $message );

	// -> Strip out any slashes in the content.
	$message = stripslashes ( $message );

    // get the blog name for the reset email subject
    $blogname = wp_specialchars_decode( get_option('blogname'), ENT_QUOTES );
    $title = sprintf( __('[%s] Welcome!'), $blogname );
	
	// -> Send out the message.
	wp_mail ( $user_data->user_email, $title, $message );
		
}
*/



// let's create a shortcode that displays a login form on the front-end.
function login_form_shortcode( $atts, $content = null ) {
 	
 	$form = '';

 	if ( isset( $_REQUEST['login-error'] ) ) {
 		$form = '<div class="login-error">The credentials you entered do not match our records.</div>';
 	}

	if ( isset( $_REQUEST['redirect_to'] ) ) {
		$redirect = $_REQUEST['redirect_to'];
	} else {
		$redirect = get_home_url();
	}
 
    $account_page = get_post( pure_get_option( 'account-page' ) );
    $account_url = get_permalink( $account_page->ID );
 
    $reset_page = get_post( pure_get_option( 'reset-page' ) );
    $reset_url = get_permalink( $reset_page->ID );

	if ( !is_user_logged_in() ) {
		$form .= wp_login_form( array('echo' => false, 'redirect' => $redirect ) );
		$form .= '<p><a href="' . $reset_url . '">Lost/forgotten Password</a></p>';
	} else {
		$form .= "You are currently logged in, please visit <a href='" . $account_url . "'>your account</a> for more options.";
	}

	return $form;

}
add_shortcode('pure-login-form', 'login_form_shortcode');



// let's create a shortcode that displays a login form on the front-end.
function reset_form_shortcode( $atts, $content = null ) {

    $account_page = get_post( pure_get_option( 'account-page' ) );
    $account_url = get_permalink( $account_page->ID );
 	
 	// they're logged in, what do they need a password reset for?!
	if ( is_user_logged_in() ) return "You are currently logged in, please visit <a href='" . $account_url . "'>your account</a> for more options.";

	// empty form variable.
	$form = '';

    $reset_page = get_post( pure_get_option( 'reset-page' ) );
    $reset_url = get_permalink( $reset_page->ID );

    $action = ( isset( $_REQUEST['action'] ) ? $_REQUEST['action'] : '' );

    // handle requests
 	if ( isset( $_REQUEST['reset'] ) ) {

	    // the reset request has been sent
 		$form .= 'A password reset email has been sent to the email address we have on record. Please click the link in it to continue the reset process.';

 	} else if ( $action == 'rp' && isset( $_REQUEST['key'] ) && isset( $_REQUEST['login'] ) ) {

 		// if the password doesn't match, display an error.
 		if ( isset( $_REQUEST['mismatch'] ) ) $form .= '<div class="error reset">The two passwords you entered do not match. Please try again.</div>'; 

 		// if they clicked the link to reset, show the password and confirmation password fields.
 		$form .= '<form name="resetpassform" id="resetpassform" action="' . $reset_url . '?action=resetpass" method="post" autocomplete="off">
			<input type="hidden" name="user_login" value="' . $_REQUEST['login'] . '" />
			<p>
				<label for="pass1">New password<br />
				<input type="password" name="pass1" id="pass1" class="input" size="20" value="" autocomplete="off" /></label>
			</p>
			<p>
				<label for="pass2">Confirm new password<br />
				<input type="password" name="pass2" id="pass2" class="input" size="20" value="" autocomplete="off" /></label>
			</p>
			<input type="hidden" name="rp_key" value="' . $_REQUEST['key'] . '" />
			<p class="submit"><input type="submit" name="wp-submit" id="wp-submit" value="Reset Password" /></p>
		</form>';

 	} else {

 		// if they're just arriving at this page, display a lost password form.
	 	$form .= '<form name="lostpasswordform" id="lostpasswordform" action="' . get_home_url() . '/wp-login.php?action=lostpassword" method="post">
			<p>
				<label for="user_login">Username or E-mail:<br>
				<input type="text" name="user_login" id="user_login" class="password-reset" value="" autocomplete="off"></label>
			</p>
			<input type="hidden" name="redirect_to" value="' . $reset_url . '?action=reset" />
			<p class="submit"><input type="submit" name="wp-submit" id="wp-submit" value="Get New Password"></p>
		</form>';

	}
 
	return $form;

}
add_shortcode('pure-reset-password', 'reset_form_shortcode');



// function to reset the password to the new one.
function pure_reset_password( $user, $new_pass ) {
	/**
	 * Fires before the user's password is reset.
	 *
	 * @since 1.5.0
	 *
	 * @param object $user     The user.
	 * @param string $new_pass New user password.
	 */
	do_action( 'password_reset', $user, $new_pass );

	wp_set_password( $new_pass, $user->ID );
	update_user_option( $user->ID, 'default_password_nag', false, true );

	wp_password_change_notification( $user );

	$login_page = get_post( pure_get_option( 'login-page' ) );
	$login_url = get_permalink( $login_page->ID );

    wp_redirect( $login_url . '?reset=success' ); 
    exit;

}



// set a handler for reset
function reset_password_handler() {

	// get the reset page from the db
	$reset_page = get_post( pure_get_option( 'reset-page' ) );
	$reset_url = get_permalink( $reset_page->ID );

	// get the login parameter
	$login = ( isset( $_POST['user_login'] ) ? $_POST['user_login'] : '' );

	// grab the action parameter
	$action = ( isset( $_REQUEST['action'] ) ? $_REQUEST['action'] : '' );

	// handle based on the action
	if ( $action == 'resetpass' && !empty( $login ) ) {

		// check if the passwords match
		if ( $_POST['pass1'] != $_POST['pass2'] ) {

			// if the passwords don't match, redirect with an error parameter
			wp_redirect( $reset_url . '?action=rp&key=' . $_POST['rp_key'] . '&login=' . $_POST['user_login'] . "&mismatch=1" );
			exit;

		}

		// retrieve user data
		$userdata = get_user_by( 'login', $login );

		// set the new password.
		pure_reset_password( $userdata, $_POST['pass1'] );

	}
}
add_action( 'init', 'reset_password_handler', 9995 );



// update the password retrieval message
function pure_retrieve_password_message( $message, $key ){
    
	global $wpdb;
				
	// -> Get the target username or e-mail from the post.
	$Post_Login = htmlentities ( $_POST['user_login'] );
	
	// -> Get the required variables.	
	$user_id = $wpdb -> get_results ( "SELECT ID FROM $wpdb->users WHERE (user_login='$Post_Login' OR user_email='$Post_Login') LIMIT 1" );
		
	// -> Get the new user's ID.			
	$user_data = new WP_User ( $user_id->ID );
			
    // get the message option from our metabox.
 	$message = pure_get_option( 'reset-email' );

    // replace shortcodes in the email message body.
    $message = str_replace( '[password-reset-url]' , $reset_url . "?action=rp&key=$key&login=" . rawurlencode( $user_data->user_login ), $message );
    $message = str_replace( '[user-id]', $user_data->ID, $message );
    $message = str_replace( '[first-name]', $user_data->first_name, $message );
    $message = str_replace( '[last-name]', $user_data->last_name, $message );
    $message = str_replace( '[user-login]', $user_data->user_login, $message );
    $message = str_replace( '[email]', $user_data->user_email, $message );
    $message = str_replace( '[homepage]', get_home_url(), $message );
    $message = str_replace( '[admin-email]', get_option( 'admin_email' ), $message );
    $message = str_replace( '[date]', date( 'n/j/Y' ), $message );
    $message = str_replace( '[time]', date( 'g:i a' ), $message );
	
	// -> Add line breaks to the body.
	$message = nl2br ( $message );
	
	// -> Strip out any slashes in the content.
	$message = stripslashes ( $message );
	
	// -> Return the result.
	return $message;

}
add_filter( 'retrieve_password_message', 'pure_retrieve_password_message', 11, 2 );


?>