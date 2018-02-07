<?php
/**
 * _s functions and definitions
 *
 * @package _s
 */
require_once('functions/activation.php');
require_once('functions/script_style_manager.php');
require_once('functions/meta.php');
require_once('functions/roles_capabilities.php');
// require_once('functions/login.php');
require_once('functions/post_types.php');






add_action( 'after_setup_theme', 'mbm_image_size' );
function mbm_image_size() {
    add_image_size( 'banner', 1000, 415, true ); // (cropped)
}

add_filter( 'image_size_names_choose', 'mbm_image_sizes_into_admin' );
function mbm_image_sizes_into_admin( $sizes ) {
    return array_merge( $sizes, array(
        'banner' => __( 'Banner' ),
    ) );
}








add_filter( 'gform_confirmation_anchor', '__return_true' );










function add_woo_wrapper(){
    echo '<div class="restrict-width">';
}
function add_woo_wrapper_close(){
    echo '</div>';
}
add_action('woocommerce_before_main_content', 'add_woo_wrapper');
add_action('woocommerce_after_main_content', 'add_woo_wrapper_close');



/*
add_action('init', 'my_remove_editor_from_post_type');
function my_remove_editor_from_post_type() {
    remove_post_type_support( 'page', 'editor' );
}*/


/**
 * Check if WooCommerce is active
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
}

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

/* show admin bar only for admins and editors */
if (!current_user_can('edit_posts')) {
    add_filter('show_admin_bar', '__return_false');
}

/* CUSTOM ADMIN FOOTER */
function modify_footer_admin () {
  echo 'If you have any problems or questions regarding the administration of this website, please <a href="mailto:madebymartin@gmail.com" target="blank">ask me here</a>.';
}
add_filter('admin_footer_text', 'modify_footer_admin');


/* Only show WordPress update nag to admins */
function jp_proper_update_nag() {
  if ( !current_user_can( 'manage_options' ) ) {
    remove_action ( 'admin_notices', 'update_nag', 3 );
  }
}
add_action ( 'admin_notices', 'jp_proper_update_nag', 1 );


/* Remove Unwanted Admin Menu Items */

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



/*function mbm_auto_sticky_nav(){
	$nav_items = '';
	$sections = get_post_meta(get_the_ID(), 'mbm_page_sections', false);
	if($sections){
		$link_count = '0';
		foreach($sections as $index => $section) {
			$title = $section['nav_item_title'];
			if(!empty($title)){
				$section_id = 'section-' . $index;
				$link_id = 'link-' . $section_id;
				$nav_items .= '<li><a class="stickynav" href="#' . $section_id  . '">' . $title . '</a></li>';
				$link_count += 1;
			}			
		}
		if ( is_page_template( 'template-trade.php' ) && !current_user_can('access_trade_content')) { $nav_items .= '<li><a class="stickynav" href="#trade-login">Existing Customers</a></li>'; }
		echo '<div id="sections_nav">';
		echo '<a class="scroll-top" href="#page"><img width="30" src="' . get_bloginfo('stylesheet_directory') . '/images/home.svg"></a>';
		
		if($link_count > 0){ 
			echo '<ul id="top-menu">';
				echo $nav_items;
			echo '</ul>';
		}
		echo '</div>';
	}
}*/



/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'mbm_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mbm_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on _s, use a find and replace
	 * to change '_s' to the name of your theme in all the template files
	 */
	load_theme_textdomain( '_s', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', '_s' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'mbm_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // mbm_setup
add_action( 'after_setup_theme', 'mbm_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function mbm_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', '_s' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Page Bottom', '_s' ),
		'id'            => 'page-bottom',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		// 'before_title'  => '<h1 class="widget-title">',
		// 'after_title'   => '</h1>',
	) );

}
add_action( 'widgets_init', 'mbm_widgets_init' );



/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
