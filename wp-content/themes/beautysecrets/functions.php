<?php

// Unleash the power of Thematic's comment form
define('THEMATIC_COMPATIBLE_COMMENT_FORM', true);




include ('lib/functions/insert-content.php');
include ('lib/functions/replace-howdy.php');
include ('lib/functions/override-siteinfo.php');
include ('lib/functions/custom-post-types.php');
include ('lib/functions/add-thumbnails.php');
include ('lib/functions/custom-login.php');



add_filter('mce_css', 'my_editor_style');
function my_editor_style($url) {
if ( !empty($url) )
$url .= ',';

// Change the path here if using sub-directory
$url .= trailingslashit( get_stylesheet_directory_uri() ) . 'editor-style.css';
return $url;
}



//Add shotcode to display menu: [menu name="footer-navigation"]    
function print_menu_shortcode($atts, $content = null) {
    extract(shortcode_atts(array( 'name' => null, ), $atts));
    return wp_nav_menu( array( 'menu' => $name, 'echo' => false ) );
}
add_shortcode('menu', 'print_menu_shortcode');       


 //CUSTOM ADMIN FOOTER
function modify_footer_admin () {
  echo 'Created by <a href="http://totallydesignandprint.com" target="blank">Totally Design &amp; Print</a>.';
  echo ' Powered by<a href="http://WordPress.org">WordPress</a>.';
}

add_filter('admin_footer_text', 'modify_footer_admin');




// CUSTOM META ---------------------------------------------------------------------------------------------------------


/* CUSTOM META (can't get to work as an included file?! */
add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
function cmb_sample_metaboxes( array $meta_boxes ) {
// Start with an underscore to hide fields from custom fields list
	$prefix = 'rw_';

include ('lib/functions/custom-meta.php');

	// Add other metaboxes as needed
	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'lib/metabox/init.php';

}
?>