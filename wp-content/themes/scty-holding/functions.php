<?php
/**
 * Intuity functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Intuity
 */


// SHOP FRONT SHOWS ALL DATES IN ORDER, ALONG WITH DETAILS FOR EACH PRODUCT/EVENT/WORKSHOP/COURSE ETC..
// USER CAN FILTER LIST BY EVENT TYPE (PRODUCT CATEGORY), TRAINER, LOCATION ETC
if ( ! function_exists( 'mbm_get_all_bookable_dates' ) ){
	function mbm_get_all_bookable_dates($trainer_id, $location_id){

		//trainer ids array for meta query
		$trainer_ids_array = new WP_Query( array (
		    'orderby'               => 'date',
		    'posts_per_page'        => -1,
		    'fields' => 'ids',
		    'post_type' => 'trainer'
		));
		$trainer_ids_array = $trainer_ids_array->posts;
		if(empty($trainer_id)){$trainer_ids = $trainer_ids_array; }
		else{ $trainer_ids = $trainer_id; }



		//location ids array for meta query
		$location_ids_array = new WP_Query( array (
		    'orderby'               => 'title',
		    'posts_per_page'        => -1,
		    'fields' => 'ids',
		    'post_type' => 'location'
		));
		$location_ids_array = $location_ids_array->posts;
		if(empty($location_id)){$location_ids = $location_ids_array; }
		else{ $location_ids = $location_id; }





		$bookable_dates_array = array();

		$bookable_products_loop = new wp_query( array(
				'post_type' => 'product',
/*				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'product_cat',
						'field' => 'slug',
						'terms' => 'samples',
						'operator' => 'NOT IN'
					),

				),*/
				'meta_query' => array(
                'relation' => 'AND',
                    array(
                        'key'     => '_wc_booking_availability',
                        'value'   => '',
                        'compare' => '!=',
                    ),
                    array(
                        'key'     => 'mbm_trainer',
                        'value'   => $trainer_ids,
                        'compare' => 'IN',
                    ),
                    array(
                        'key'     => 'mbm_location',
                        'value'   => $location_ids,
                        'compare' => 'IN',
                    ),
                ),

				'orderby' => 'title',
				'posts_per_page' => '-1',
				'order' => 'ASC'
		) );

		
		if ( $bookable_products_loop->have_posts() ) {
			while ( $bookable_products_loop->have_posts() ) : $bookable_products_loop->the_post();

				$product_id = get_the_ID();

				$availability = get_post_meta(get_the_ID())["_wc_booking_availability"];
				$availability_array = unserialize($availability['0']);


				foreach ($availability_array as $key => $value) {
					$date = $value['from'];
					$unix_ts = strtotime($date);
					$day = date( "jS", $unix_ts );
					$month = date( "M", $unix_ts );
					$year = date( "Y", $unix_ts );
					$bookable = $value['bookable'];

					if ($bookable == 'yes') {
						$bookable_dates_array[] = array('timestamp' => $unix_ts, 'product_id' => $product_id);
					}
					
				}



			endwhile;
			// Prevent weirdness
			wp_reset_postdata();
		}
		sort($bookable_dates_array);
		return $bookable_dates_array;
	}
}







// add_filter('gettext', 'translate_text');
// add_filter('ngettext', 'translate_text');

function translate_text($translated) { 
$translated = str_ireplace('product', 'event', $translated); 
$translated = str_ireplace('category', 'type', $translated); 
return $translated; 
}







// RE-WRAP WOOCOMMERCE IN THEME CONTAINER & DECLARE WOO SUPPORT
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);
function my_theme_wrapper_start() {
  echo '<section class="hentry">';
}
function my_theme_wrapper_end() {
  echo '</section>';
}
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}


// COPYRIGHT FOR FOOTER - CALLED IN FOOTER.PHP
if ( ! function_exists( 'intuity_copyright' ) ) {
	function intuity_copyright() {
		$year = current_time( 'Y', 1 );
		if($year > '2016'){ echo 'Copyright 2016-' . $year . ' Society LDN™'; }
		else{ echo 'Copyright ' . $year . ' Society LDN™'; }

	}
}


remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );









if ( ! function_exists( 'intuity_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function intuity_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Intuity, use a find and replace
	 * to change 'intuity' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'intuity', get_template_directory() . '/languages' );

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
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'intuity' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'intuity_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'intuity_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function intuity_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'intuity_content_width', 640 );
}
add_action( 'after_setup_theme', 'intuity_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function intuity_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'intuity' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
//add_action( 'widgets_init', 'intuity_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function intuity_scripts() {
	wp_enqueue_style( 'intuity-style', get_stylesheet_uri() );

	wp_enqueue_script( 'intuity-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'intuity-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'intuity_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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

require_once get_template_directory() . '/inc/meta.php';