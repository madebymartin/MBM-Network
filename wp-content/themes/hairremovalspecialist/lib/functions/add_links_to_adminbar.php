<?php 
// add links/menus to the admin bar
function mytheme_admin_bar_render() {
	global $wp_admin_bar;
	$wp_admin_bar->add_menu( array(
		'parent' => 'new-content', // use 'false' for a root menu, or pass the ID of the parent menu
		'id' => 'new_media', // link ID, defaults to a sanitized title value
		'title' => __('Media'), // link title
		'href' => admin_url( 'media-new.php') // name of file
		'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
	));
}
add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );
?>