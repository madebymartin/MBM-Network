<?php
/**
 * Custom Child Theme Functions
 *
 * This file's parent directory can be moved to the wp-content/themes directory 
 * to allow this Child theme to be activated in the Appearance - Themes section of the WP-Admin.
 *
 * Included is a basic theme setup that will add support for custom header images and custom 
 * backgrounds. There are also a set of commented theme supports that can be uncommented if you need
 * them for backwards compatibility. If you are starting a new theme, these legacy functionality can be deleted.  
 *
 * More ideas can be found in the community documentation for Thematic
 * @link http://docs.thematictheme.com
 *
 * @package ThematicSampleChildTheme
 * @subpackage ThemeInit
 */


// ------------------- ADD IE Specific CSS ------------------ //
function ie_stylesheet() {
?>
<!--[if IE]>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/IE.css" type="text/css" media="screen, projection" />
<![endif]-->
<?php 
}
add_filter('wp_head', 'ie_stylesheet');


//ADD CURRENT PAGE CLASS
function my_page_css_class( $css_class, $page ) {
	global $post;
	if ( $post->ID == $page->ID ) {
		$css_class[] = 'current_page_item';
	}
	return $css_class;
}
add_filter( 'page_css_class', 'my_page_css_class', 10, 2 );


//HIDE WORDPRESS VERSION
remove_action('wp_head', 'wp_generator');

// show admin bar only for admins and editors
if (!current_user_can('edit_posts')) {
	add_filter('show_admin_bar', '__return_false');
}

//KILL SUPERFISH DROPDOWNS SCRIPT
function childtheme_override_head_scripts(){
   // Abscence makes the heart grow fonder
}
add_action('thematic_head_scripts','childtheme_override_head_scripts');



 //CUSTOM ADMIN FOOTER
function modify_footer_admin () {
  echo 'Created by <a href="http://totallydesignandprint.com" target="blank">Totally Design &amp; Print</a>.';
  echo ' Powered by<a href="http://WordPress.org">WordPress</a>.';
}

add_filter('admin_footer_text', 'modify_footer_admin');




/* Include library functions */
require_once ('lib/functions/html5doctype.php');
require_once ('lib/functions/custom-siteinfo.php');
require_once ('lib/functions/replace-howdy.php');
// require_once ('lib/functions/custom-login.php');
require_once ('lib/functions/add-thumbnails.php');
require_once ('lib/functions/custom-post-types.php');
require_once ('lib/functions/insert-into-head.php');
//require_once ('lib/functions/insert-content.php');
//require_once ('lib/functions/custom-page-title.php');
require_once ('lib/functions/custom_sidebars.php');


//require_once ('lib/functions/custom-user-meta.php');
//require_once ('lib/functions/add-roles.php');
//require_once ('lib/functions/custom_category_loop.php');
//require_once ('lib/functions/simplemap-edits.php');
//require_once ('lib/functions/simplemap-custom-template.php');
//require_once ('lib/functions/block-admin.php');
//require_once ('lib/functions/custom-jigoshop-functions.php');
//require_once ('lib/functions/custom-email.php');
//require_once ('lib/functions/custom_category_archive.php');
require_once ('lib/functions/custom_archive_loop.php');
require_once ('lib/functions/custom_index_loop.php');
//require_once ('lib/functions/remove-author-single.php');





//NO BACKEND ACCESS FOR NON-ADMIN / Non-Editor
function no_mo_dashboard() {
    if ( !current_user_can('edit_posts') && !defined('DOING_AJAX') ) {
        wp_redirect(site_url());
        exit;
    }
}
add_action('admin_init', 'no_mo_dashboard');



// Remove View Posts Filed Under….
add_filter('wp_list_categories', 'remove_category_link_prefix');

function remove_category_link_prefix($output) {
	return str_replace('View all posts filed under ', '', $output);
}






/*  CUSTOM META (can't get to work as a n included file?!  */
add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
function cmb_sample_metaboxes( array $meta_boxes ) {
// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';

require_once ('lib/functions/custom-meta2.php');

	// Add other metaboxes as needed
	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'lib/metabox2/init.php';

}





/* ADD CUSTOM POST TYPE TO DYNAMIC BODY CLASS */

function post_type_body_class($c) {
global $wp_query;

$post_type = get_query_var('post_type');

	if( get_post_type() == $post_type ){
		$c[] = $post_type;
		} else {
		null;
		}
	return $c;
}


$c = array();
{
// Generic semantic classes for what type of content is displayed
is_front_page() ? $c[] = ‘home’ : null; // For the front page, if set
is_home() ? $c[] = ‘blog’ : null; // For the blog posts page, if set
is_archive() ? $c[] = ‘archive’ : null;
is_date() ? $c[] = ‘date’ : null;
is_search() ? $c[] = ‘search’ : null;
is_paged() ? $c[] = ‘paged’ : null;
is_attachment() ? $c[] = ‘attachment’ : null;
is_404() ? $c[] = ‘four04′ : null; // CSS does not allow a digit as first character
is_page() ? $c[] = ‘page’ : null;
if (!is_home()) { $c[] = get_post_type() ; } // Adds a custom post type body class
}

add_filter('thematic_body_class','post_type_body_class');



// increase exceprt box height
add_action('admin_head', 'excerpt_textarea_height');
function excerpt_textarea_height() {
    echo'
    <style type="text/css">
        #excerpt{ height:200px; }
    </style>
    ';
}













//CUSTOM THEME OPTIONS - NOT WORKING QUITE RIGHT YET
/*
function childtheme_override_opt_init(){

}

*/












?>