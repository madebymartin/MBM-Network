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

add_filter( 'login_url', 'mysite_login_url', 10, 2);
function mysite_login_url( $force_reauth, $redirect ){

	if ( !empty($redirect) )
		$login_url = add_query_arg( 'redirect_to', urlencode( $redirect ), $login_url );

	if ( $force_reauth )
		$login_url = add_query_arg( 'reauth', '1', $login_url ) ;

	return $login_url ;
}



function my_login_stylesheet() { ?>
    <link rel="stylesheet" id="custom_wp_admin_css"  href="<?php echo get_bloginfo( 'stylesheet_directory' ) . '/lib/css/login.css'; ?>" type="text/css" media="all" />
<?php }
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );
?>