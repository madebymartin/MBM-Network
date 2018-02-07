<?php
//THEME ACTIVATION FUNCTIONS - CREATE PAGES - SET OPTIONS - CREATE MENUS - ACTIVATE PLUGINS

if (isset($_GET['activated']) && is_admin()){

//CREATE HOME PAGE
        $new_page_title = 'Home';
        $new_page_content = 'This is the homepage';
        $new_page_template = ''; //ex. template-custom.php. Leave blank if you don't want a custom page template.
        //don't change the code bellow, unless you know what you're doing
        $page_check = get_page_by_title($new_page_title);
        $new_page = array(
                'post_type' => 'page',
                'post_title' => $new_page_title,
                'post_content' => $new_page_content,
                'post_status' => 'publish',
                'post_author' => 1,
        );
        if(!isset($page_check->ID)){
                $new_page_id = wp_insert_post($new_page);
                if(!empty($new_page_template)){
                        update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
                }
        }
//CREATE ADMIN PAGE
        $new_page_title = 'Admin';
        $new_page_content = 'Login Here';
        $new_page_template = ''; //ex. template-custom.php. Leave blank if you don't want a custom page template.
        //don't change the code bellow, unless you know what you're doing
        $page_check = get_page_by_title($new_page_title);
        $new_page = array(
                'post_type' => 'page',
                'post_title' => $new_page_title,
                'post_content' => $new_page_content,
                'post_status' => 'publish',
                'post_author' => 1,
        );
        if(!isset($page_check->ID)){
                $new_page_id = wp_insert_post($new_page);
                if(!empty($new_page_template)){
                        update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
                }
        }
//CREATE CONTACT US PAGE
        $new_page_title = 'Contact Us';
        $new_page_content = 'Please get in touch using the form below';
        $new_page_template = ''; //ex. template-custom.php. Leave blank if you don't want a custom page template.
        //don't change the code bellow, unless you know what you're doing
        $page_check = get_page_by_title($new_page_title);
        $new_page = array(
                'post_type' => 'page',
                'post_title' => $new_page_title,
                'post_content' => $new_page_content,
                'post_status' => 'publish',
                'post_author' => 1,
        );
        if(!isset($page_check->ID)){
                $new_page_id = wp_insert_post($new_page);
                if(!empty($new_page_template)){
                        update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
                }
        }
//CREATE SITEMAP PAGE
        $new_page_title = 'Sitemap';
        $new_page_content = '';
        $new_page_template = ''; //ex. template-custom.php. Leave blank if you don't want a custom page template.
        //don't change the code bellow, unless you know what you're doing
        $page_check = get_page_by_title($new_page_title);
        $new_page = array(
                'post_type' => 'page',
                'post_title' => $new_page_title,
                'post_content' => $new_page_content,
                'post_status' => 'publish',
                'post_author' => 1,
        );
        if(!isset($page_check->ID)){
                $new_page_id = wp_insert_post($new_page);
                if(!empty($new_page_template)){
                        update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
                }
        }

// SET OPTIONS
$home = get_page_by_title( 'Home' );
update_option( 'page_on_front', $home->ID );
update_option( 'show_on_front', 'page' );
update_option( 'date_format', 'F jS, Y' );

if (get_option('permalink_structure') != '/%category%/%postname%/') { 
update_option('permalink_structure', '/%category%/%postname%/');
}
if (get_option('rg_gforms_currency') != '/% GBP%/%postname%/') { 
update_option( 'rg_gforms_currency', 'GBP' );
}


update_option( 'rg_gforms_enable_html5', '1' );
update_option( 'rg_gforms_key', '7824cc28e0ae2dc44d54dcbee8eef657' );
update_option( 'use_trackback', '0' );
update_option( 'use_balanceTags', '0' );
update_option( 'can_compress_scripts', '1' );
update_option( 'comment_moderation', '1' );
update_option( 'comment_registration', '1' );
update_option( 'default_ping_status', '0' );
update_option( 'default_role', 'subscriber' );
update_option( 'default_comment_status', 'closed' );
update_option( 'upload_path', 'assets' );
update_option( 'use_balanceTags', '0' );
update_option( 'require_name_email', '1' );
update_option( 'uploads_use_yearmonth_folders', '0' );
update_option( 'gzipcompression', '0' );


//REMOVE HELLY DOLLY
require_once(ABSPATH . 'wp-admin/includes/plugin.php');
require_once(ABSPATH . 'wp-admin/includes/file.php');
if (file_exists(WP_PLUGIN_DIR . '/hello.php'))
delete_plugins(array('hello.php'));


//REMOVE HELLO WORLD
$post = get_page_by_path('hello-world',OBJECT,'post');
if ($post)
  wp_delete_post($post->ID,true);


//REMOVE SAMPLE PAGE
$page = get_page_by_path('sample-page',OBJECT,'page');
if ($page)
  wp_delete_post($page->ID,true);

}
//END THEME ACTIVATION FUNCTIONS
?>