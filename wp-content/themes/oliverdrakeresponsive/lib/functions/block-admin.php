<?php
add_action( 'init', 'blockusers_init' );
 
function blockusers_init() {
	get_currentuserinfo();
	if ( is_admin() && !current_user_can('edit_posts')){

		wp_redirect( home_url() );
		exit;
	}
}

?>