<?php
//Custom Login// --------------------------------------------------------------------------------------------------

add_filter( 'login_headerurl', 'w4_login_headerurl');
function w4_login_headerurl(){
	return home_url('/');
}

add_filter( 'login_headertitle', 'w4_login_headertitle');
function w4_login_headertitle(){
	return get_bloginfo('title', 'display' );
}

/**
 * Redirect user after successful login.
 *
 * @param string $redirect_to URL to redirect to.
 * @param string $request URL the user is coming from.
 * @param object $user Logged user's data.
 * @return string
 */
function my_login_redirect( $redirect_to, $request, $user ) {
	//is there a user to check?
	global $user;
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		//check for admins
		if ( in_array( 'administrator', $user->roles ) ) {
			// redirect them to the default place
			return home_url().'/admin';
		} else {
			return home_url().'/admin';
		}
	} else {
		return $redirect_to;
	}
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );


function my_login_stylesheet() { ?>
    <link rel="stylesheet" id="custom_wp_admin_css"  href="<?php echo get_bloginfo( 'stylesheet_directory' ) . '/lib/css/login.css'; ?>" type="text/css" media="all" />
<?php }
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );



?>