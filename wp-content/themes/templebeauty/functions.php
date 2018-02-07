<?php
// add_theme_support( 'thematic_legacy_feedlinks' );
// add_theme_support( 'thematic_legacy_body_class' );
// add_theme_support( 'thematic_legacy_post_class' );
// add_theme_support( 'thematic_legacy_comment_form' );
// add_theme_support( 'thematic_legacy_comment_handling' );


/* Include library functions */
require_once ('lib/functions/activation.php');
require_once ('lib/functions/enqueue_css.php');
require_once ('lib/functions/siteinfo.php');
//require_once ('lib/functions/remove_author_single.php');
//require_once ('lib/functions/kill_superfish.php');

require_once ('lib/functions/override_thematic_post_title.php');




require_once ('lib/functions/move_access.php');
require_once ('lib/functions/insert_content.php');
require_once ('lib/functions/add_thumbnails.php');
require_once ('lib/functions/custom_post_types.php');
require_once ('lib/functions/custom_sidebars.php');
require_once ('lib/functions/custom_archive_loop.php');
require_once ('lib/functions/remove_author_single.php');
require_once ('lib/functions/homepage_slider.php');
require_once ('lib/functions/custom_index_loop.php');
require_once ('lib/functions/custom_category_loop.php');
//require_once ('lib/functions/override_thematic_post_title.php');
require_once ('lib/functions/hide_themes_etc.php');
require_once ('lib/functions/remove_thematic_options.php');
require_once ('lib/functions/custom-login.php');



add_editor_style('lib/css/custom_admin.css');


/*  CUSTOM META (can't get to work as an included file?!  */
add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
function cmb_sample_metaboxes( array $meta_boxes ) {
// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';

require_once ('lib/functions/custom_meta.php');

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



// ------------------- ADD IE Specific CSS ------------------ //
function ie_stylesheet() {
?>
<!--[if IE]>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/IE.css" type="text/css" media="screen, projection" />
<![endif]-->
<?php
}
add_filter('wp_head', 'ie_stylesheet');


//HIDE WORDPRESS VERSION
remove_action('wp_head', 'wp_generator');

// show admin bar only for admins and editors
if (!current_user_can('edit_posts')) {
	add_filter('show_admin_bar', '__return_false');
}

//ADD CURRENT PAGE CLASS
function my_page_css_class( $css_class, $page ) {
	global $post;
	if ( $post->ID == $page->ID ) {
		$css_class[] = 'current_page_item';
	}
	return $css_class;
}
add_filter( 'page_css_class', 'my_page_css_class', 10, 2 );



 //CUSTOM ADMIN FOOTER
function modify_footer_admin () {
  echo 'Created by <a href="http://totallydesignandprint.com" target="blank">Totally Design &amp; Print</a>.';
  echo ' Powered by<a href="http://WordPress.org">WordPress</a>.';
}

add_filter('admin_footer_text', 'modify_footer_admin');


// Remove View Posts Filed Under….
add_filter('wp_list_categories', 'remove_category_link_prefix');

function remove_category_link_prefix($output) {
	return str_replace('View all posts filed under ', '', $output);
}




?>