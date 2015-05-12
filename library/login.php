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
		Welcome, <?php print ( !empty( $current_user->user_firstname ) ? $current_user->user_firstname : $current_user->user_login ); ?> <span>|</span> <a href="/faq">Help</a> <span>|</span> <a href="/account">My Account</a>
		<?php 
	} else { 
		?>
		<a href="/faq">Help</a> <span>|</span> <a href="/wp-login.php">Log In</a>
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



?>