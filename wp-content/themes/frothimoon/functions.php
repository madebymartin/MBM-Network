<?php

//
//  Custom Child Theme Functions
//
// Unleash the power of Thematic's dynamic classes
define('THEMATIC_COMPATIBLE_BODY_CLASS', true);
define('THEMATIC_COMPATIBLE_POST_CLASS', true);

// Unleash the power of Thematic's comment form
// define('THEMATIC_COMPATIBLE_COMMENT_FORM', true);

/* Unleash the power of Thematic's feed link functions */
define('THEMATIC_COMPATIBLE_FEEDLINKS', true);


/* Include library functions */
include ('lib/functions/custom-login.php');
include ('lib/functions/add-thumbnails.php');
include ('lib/functions/add-roles.php');
include ('lib/functions/custom-post-types.php');
include ('lib/functions/move-navigation.php');
include ('lib/functions/insert-content.php');
include ('lib/functions/page-specific-stylesheets.php');
include ('lib/functions/custom_archive_loop.php');
include ('lib/functions/custom_category_loop.php');
include ('lib/functions/custom_category_archive.php');
include ('lib/functions/override-page-title.php');
include ('lib/functions/override-siteinfo.php');



/*  CUSTOM META (can't get to work as a n included file?!  */
add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
function cmb_sample_metaboxes( array $meta_boxes ) {
// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';

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

/* USE WP-PAGENAVI IF INSTALLED, IF NOT, USE DEFAULT PAGE NAVI */
if(function_exists('wp_pagenavi')) { // if PageNavi is activated 
 
wp_pagenavi(); // Use PageNavi
 
} else { // Otherwise, use traditional Navigation ?>
 
<div class="nav-previous">
<!-- next_post_link -->
</div>
 
<div class="nav-next">
<!-- previous_post_link -->
</div>
 
<?php } // End if-else statement



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



add_action( 'template_redirect', 'my_redirect_author_archive' );
function my_redirect_author_archive() {
	if ( is_author() ) {
		wp_redirect( home_url( '' ), 301 );
		exit;
	}
}



?>