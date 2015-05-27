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

	// if the user is logged in.
	if ( is_user_logged_in() ) { 
		?>
		<a href="/account" class='account-button'>My Account</a> <a href="<?php echo wp_logout_url( get_bloginfo( 'home' ) ) ?>" class="logout-button">Logout</a>
		<span class='welcome'>Welcome, <?php print ( !empty( $current_user->user_firstname ) ? $current_user->user_firstname : $current_user->user_login ); ?></span>
		<?php 
	} else { 
		?>
		<a href="/log-in/?redirect_to=<?php print 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>" class='account-button'>Log In</a>
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



// let's create a shortcode that displays a login form on the front-end.
function login_form_shortcode( $atts, $content = null ) {
 	
 	$form = '';

 	if ( !empty( get_query_var( 'login', '' ) ) ) {
 		$form = '<div class="login-error">The credentials you entered do not match our records.</a>';
 	}

	if ( isset( $_REQUEST['redirect_to'] ) ) {
		$redirect = $_REQUEST['redirect_to'];
	} else {
		$redirect = get_bloginfo( 'home' );
	}
 
	if ( !is_user_logged_in() ) {
		$form .= wp_login_form( array('echo' => false, 'redirect' => $redirect ) );
	}

	$form = str_replace( get_bloginfo('home') . '/log-in/?redirect_to=', '', $form );

	return $form;

}
add_shortcode('lscu-login-form', 'login_form_shortcode');



// when the user authenticates on LSCU, also authenticate them on InfoSight
function infosight_authenticate() {

	// let's redirect to infosight's login endpoint so that it can authenticate us on there as well.
    header( "Location: http://fl.leagueinfosight.com/Security__Login_6169.htm?testsite=yes&email=" . $_POST['log'] . "&password=" . urlencode( $_POST['pwd'] ) . "&action=login&return_to=" . urlencode( $_POST['redirect_to'] ) );
    exit;

}
add_action('wp_login', 'infosight_authenticate');



// when a user resets their password, redirect them to the login form.
function lost_password_redirect( $user_info, $newpass ) {

    wp_redirect( home_url() . '/log-in' ); 
    exit;

}
add_action( 'password_reset', 'lost_password_redirect' );



// if the login fails for any reason, redirect the user back
// to the login form with a parameter for the login error.
function failed_login_redirect( $username ) {

    $referrer = wp_get_referer();

    if ( $referrer && ! strstr($referrer, 'wp-login') && ! strstr($referrer,'wp-admin') ) {
        wp_redirect( add_query_arg( 'login', 'failed', $referrer ) );
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



?>