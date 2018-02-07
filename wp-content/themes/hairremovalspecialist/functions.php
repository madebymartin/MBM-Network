<?php
require_once( 'lib/functions/deregister_plugin_styles.php' );
require_once( 'lib/functions/enqueue_css.php' );
require_once( 'lib/functions/html5doctype.php' );
require_once( 'lib/functions/activation.php' );
require_once( 'lib/functions/custom_login.php' );



/* FUNCTIONALITY & BACKEND*/
require_once( 'lib/functions/add_thumbnails.php' );
require_once( 'lib/functions/custom_post_types.php' );
require_once( 'lib/functions/custom_role_capabilities.php' );
require_once( 'lib/functions/remove_widget_areas.php' );
//require_once( 'lib/functions/add_footer_widget_area.php' );
//require_once( 'lib/functions/add_roles.php' );

	/* META BOXES */
	require_once( 'lib/cmb/custom-meta-boxes.php' );
	require_once( 'lib/functions/custom_meta.php' );



/* CONTENT FRONT END DISPLAY*/
//require_once( 'lib/functions/custom_vcard.php' );
require_once( 'lib/functions/siteinfo.php' );
require_once( 'lib/functions/replace_howdy.php' );
require_once( 'lib/functions/deregister_plugin_styles.php' );
require_once( 'lib/functions/modify_postheader_postmeta.php' );
require_once( 'lib/functions/custom_blog_title.php' );
require_once( 'lib/functions/google_fonts.php' );
require_once( 'lib/functions/insert_headingstripe.php' );
require_once( 'lib/functions/insert_aside_testimonial.php' );




//require_once( 'lib/functions/insert_content.php' );
//require_once( 'lib/functions/add_links_to_adminbar.php' );
//require_once( 'lib/functions/custom_archive_loop.php' );
//require_once( 'lib/functions/custom_category_loop.php' );
//require_once( 'lib/functions/custom_category_archive.php' );
//require_once( 'lib/functions/custom_index_loop.php' );
//require_once( 'lib/functions/custom_page_titles.php' );
//require_once( 'lib/functions/custom_search_loop.php' );
//require_once( 'lib/functions/kill_superfish.php' );
require_once( 'lib/functions/move_access.php' );
//require_once( 'lib/functions/override_thematic_post_title.php' );
//require_once( 'lib/functions/blog_title_image.php' );




function childtheme_override_postheader() {
    $postheader = thematic_postheader_posttitle();
    echo apply_filters( 'thematic_postheader', $postheader ); // Filter to override default post header
}  // end postheader




add_editor_style('lib/css/custom_admin.css');




/* Remove postfooter */
function remove_postfooter() {
	/* bye postfooter */
}
add_filter('thematic_postfooter', 'remove_postfooter');






// completely remove nav above functionality
function childtheme_override_nav_above() {
    // silence
}


// remove single page nav below functionality - keeps if pagenavi plugin is installed
function childtheme_override_nav_below() {
    if ( ! is_single() ) { ?>
        <div id="nav-below" class="navigation"> <?php
            if ( function_exists( 'wp_pagenavi' ) ) {
                wp_pagenavi();
             } else { ?>
            <div class="nav-previous"><?php next_posts_link(sprintf('<span class="meta-nav">&laquo;</span> %s', __('Older posts', 'thematic') ) ) ?></div>
            <div class="nav-next"><?php previous_posts_link(sprintf('%s <span class="meta-nav">&raquo;</span>',__( 'Newer posts', 'thematic') ) ) ?></div>
            <?php } ?>
        </div>  <?php
    }
}


// show full post instead of excerpt on categories
function childtheme_thematic_content($content) {
    if (is_category()) {
        $content= 'full';
    }
    return $content;
}
add_filter('thematic_content', 'childtheme_thematic_content');


// add read more on categories to match wp read more
function childtheme_modify_excerpt($text) {
    return str_replace('[...]', ' <a href="'.get_permalink().'" class="more-link">Read more &raquo;</a>', $text);
}
add_filter('get_the_excerpt', 'childtheme_modify_excerpt');



//remove the skip to anchor link feature on read more
function childtheme_remove_more_jump_link($link) {
    $offset = strpos($link, '#more-');
    if ($offset) {
        $end = strpos($link, '"',$offset);
    }
    if ($end) {
        $link = substr_replace($link, '', $offset, $end-$offset);
    }
    return $link;
}
add_filter('the_content_more_link', 'childtheme_remove_more_jump_link');




// add favicon to site, add 16x16 or 32x32 .ico or .png image to child themes main folder
function childtheme_add_favicon() { ?>
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
<?php }
add_action('wp_head', 'childtheme_add_favicon');





// clean up useless wordpress links in the head of the document
// remove wp version number, generator not needed for Thematic (it already removes it)
remove_action('wp_head', 'wp_generator');
// remove really simple discovery
remove_action('wp_head', 'rsd_link');
// remove windows live writer xml
remove_action('wp_head', 'wlwmanifest_link');
// remove index relational link
remove_action('wp_head', 'index_rel_link');
// remove parent relational link
remove_action('wp_head', 'parent_post_rel_link');
// remove relational start link
remove_action('wp_head', 'start_post_rel_link');
// remove prev/next relational link
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');



// remove the index, follow meta tags from header since it is browser default.
// http://scottnix.com/polishing-thematics-head/
function childtheme_create_robots($content) {
    global $paged;
    if (thematic_seo()) {
        if((is_home() && ($paged < 2 )) || is_front_page() || is_single() || is_page() || is_attachment())
        {
            $content = "";
        } elseif (is_search()) {
            $content = "\t";
            $content .= "<meta name=\"robots\" content=\"noindex,nofollow\" />";
            $content .= "\n\n";
        } else {
            $content = "\t";
            $content .= "<meta name=\"robots\" content=\"noindex,follow\" />";
            $content .= "\n\n";
        }
    return $content;
    }
}
add_filter('thematic_create_robots', 'childtheme_create_robots');


// removes the H1 on main page which is duplicated when a page is used as a front page
// also adds the content into a more semantic paragraph tag, where before it was just a div
function childtheme_override_blogdescription() {
    $blogdesc = '"blog-description">' . get_bloginfo('description', 'display');
    echo "\t<p id=$blogdesc</p>\n\n";
}



// featured image post thumbnail sizing
function childtheme_post_thumb_size($size) {
    $size = array(300,225);
    return $size;
}
add_filter('thematic_post_thumb_size', 'childtheme_post_thumb_size');









/*-----------------------------------------------------------------------------------*/
/* Remove Unwanted Admin Menu Items */
/*-----------------------------------------------------------------------------------*/

function remove_admin_menu_items() {
    
    if ( ! current_user_can('administrator') ) {
        $remove_menu_items = array(__('Links'), __('Posts'), __('Comments'), __('Tools'), __('Appearance'));
        }
    
    else{
        $remove_menu_items = array(__('Links'), __('Posts'), __('Comments'));
        }
        
        global $menu;
        end ($menu);
        while (prev($menu)){
            $item = explode(' ',$menu[key($menu)][0]);
            if(in_array($item[0] != NULL?$item[0]:"" , $remove_menu_items)){
            unset($menu[key($menu)]);}
        }       
}
add_action('admin_menu', 'remove_admin_menu_items');




/* Only show WordPress update nag to admins */
function jp_proper_update_nag() {
  if ( !current_user_can( 'manage_options' ) ) {
    remove_action ( 'admin_notices', 'update_nag', 3 );
  }
}
add_action ( 'admin_notices', 'jp_proper_update_nag', 1 );








/* ADD IE Specific CSS */
function ie_stylesheet() {
?>
<!--[if IE]>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/IE.css" type="text/css" media="screen, projection" />
<![endif]-->
<?php
}
add_filter('wp_head', 'ie_stylesheet');



/* HIDE WORDPRESS VERSION */
remove_action('wp_head', 'wp_generator');



/* show admin bar only for admins and editors */
if (!current_user_can('edit_posts')) {
	add_filter('show_admin_bar', '__return_false');
}



/* CUSTOM ADMIN FOOTER */
function modify_footer_admin () {
  echo 'This website was <a href="http://madebymartin.co.uk" target="blank">Made by Martin</a>. If you need me, <a href="mailto:madebymartin@gmail.com">please contact me here</a>';
}
add_filter('admin_footer_text', 'modify_footer_admin');



/* Remove View Posts Filed Under… */
add_filter('wp_list_categories', 'remove_category_link_prefix');

function remove_category_link_prefix($output) {
	return str_replace('View all posts filed under ', '', $output);
}
?>