<?php
//define('THEMATIC_COMPATIBLE_BODY_CLASS', true);
define('THEMATIC_COMPATIBLE_POST_CLASS', true);
define('THEMATIC_COMPATIBLE_COMMENT_HANDLING', true);
define('THEMATIC_COMPATIBLE_COMMENT_FORM', true);
define('THEMATIC_COMPATIBLE_FEEDLINKS', true);

//HIDE WORDPRESS VERSION
remove_action('wp_head', 'wp_generator');

// show admin bar only for admins and editors
if (!current_user_can('edit_posts')) {
	add_filter('show_admin_bar', '__return_false');
}


// Remove View Posts Filed Under….
add_filter('wp_list_categories', 'remove_category_link_prefix');

function remove_category_link_prefix($output) {
	return str_replace('View all posts filed under ', '', $output);
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


/* REMOVE DASHBOARD WIDGETS 
function remove_dashboard_widgets(){
  global$wp_meta_boxes;
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); 
}

add_action('wp_dashboard_setup', 'remove_dashboard_widgets');
*/

?>