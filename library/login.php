<?php


// add a custom stylesheet so we can customize the login page a bit.
function lscu_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_template_directory_uri() . '/css/login.css' );
}
add_action( 'login_enqueue_scripts', 'lscu_login_stylesheet' );



function account_toolbox() {
	global $current_user;
	get_currentuserinfo();

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



// additional login functionality
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



function login_form_shortcode( $atts, $content = null ) {
 	
 	$form = '';

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



function infosight_authenticate() {

	// let's redirect to infosight's login endpoint so that it can authenticate us on there as well.
    header( "Location: http://fl.leagueinfosight.com/Security__Login_6169.htm?testsite=yes&email=" . $_POST['log'] . "&password=" . urlencode( $_POST['pwd'] ) . "&action=login&return_to=" . urlencode( $_POST['redirect_to'] ) );
    exit;

}
add_action('wp_login', 'infosight_authenticate');



?>