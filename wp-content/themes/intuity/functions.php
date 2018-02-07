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

					$end_date = $value['to'];
					$end_timestamp = strtotime($end_date);
					$now = time();

					if ($bookable == 'yes' && $now < $end_timestamp) {
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
// $translated = str_ireplace('Add to basket', 'Book Now', $translated); 
return $translated; 
}

add_filter( 'add_to_cart_text', 'woo_custom_cart_button_text' );    // < 2.1
function woo_custom_cart_button_text() {
    return __( 'Book Now', 'woocommerce' );
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




remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );




// Single Product

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );


remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );




/*if ( ! function_exists( 'mbm_woocommerce_taxonomy_archive_description' ) ) {
	function mbm_woocommerce_taxonomy_archive_description() {
		if ( is_tax( array( 'product_cat', 'product_tag' ) ) && 0 === absint( get_query_var( 'paged' ) ) ) {
			$description = term_description();
			if ( $description ) {
				echo '<div class="term-description">' . $description . '</div>';
			}
		}
	}
}
remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
// remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );
add_action( 'woocommerce_before_shop_loop', 'mbm_woocommerce_taxonomy_archive_description', 10 );
*/
















// add_action( 'init', 'wpm_product_cat_register_meta' );
/**
 * Register details product_cat meta.
 *
 * Register the details metabox for WooCommerce product categories.
 *
 */
function wpm_product_cat_register_meta() {

	register_meta( 'term', 'details', 'wpm_sanitize_details' );

}

/**
 * Sanitize the details custom meta field.
 *
 * @param  string $details The existing details field.
 * @return string          The sanitized details field
 */
function wpm_sanitize_details( $details ) {

	return wp_kses_post( $details );

}


// add_action( 'product_cat_add_form_fields', 'wpm_product_cat_add_details_meta' );
/**
 * Add a details metabox to the Add New Product Category page.
 *
 * For adding a details metabox to the WordPress admin when
 * creating new product categories in WooCommerce.
 *
 */
function wpm_product_cat_add_details_meta() {

	wp_nonce_field( basename( __FILE__ ), 'wpm_product_cat_details_nonce' );

	?>
	<div class="form-field">
		<label for="wpm-product-cat-details"><?php esc_html_e( 'Details', 'wpm' ); ?></label>
		<textarea name="wpm-product-cat-details" id="wpm-product-cat-details" rows="5" cols="40"></textarea>
		<p class="description"><?php esc_html_e( 'Detailed category info to appear below the product list', 'wpm' ); ?></p>
	</div>
	<?php

}




// add_action( 'product_cat_edit_form_fields', 'wpm_product_cat_edit_details_meta' );
/**
 * Add a details metabox to the Edit Product Category page.
 *
 * For adding a details metabox to the WordPress admin when
 * editing an existing product category in WooCommerce.
 *
 * @param  object $term The existing term object.
 */
function wpm_product_cat_edit_details_meta( $term ) {

	$product_cat_details = get_term_meta( $term->term_id, 'details', true );

	if ( ! $product_cat_details ) {
		$product_cat_details = '';
	}

	$settings = array( 'textarea_name' => 'wpm-product-cat-details' );
	?>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="wpm-product-cat-details"><?php esc_html_e( 'Details', 'wpm' ); ?></label></th>
		<td>
			<?php wp_nonce_field( basename( __FILE__ ), 'wpm_product_cat_details_nonce' ); ?>
			<?php wp_editor( wpm_sanitize_details( $product_cat_details ), 'product_cat_details', $settings ); ?>
			<p class="description"><?php esc_html_e( 'Detailed category info to appear below the product list','wpm' ); ?></p>
		</td>
	</tr>
	<?php

}





// add_action( 'create_product_cat', 'wpm_product_cat_details_meta_save' );
// add_action( 'edit_product_cat', 'wpm_product_cat_details_meta_save' );
/**
 * Save Product Category details meta.
 *
 * Save the product_cat details meta POSTed from the
 * edit product_cat page or the add product_cat page.
 *
 * @param  int $term_id The term ID of the term to update.
 */
function wpm_product_cat_details_meta_save( $term_id ) {

	if ( ! isset( $_POST['wpm_product_cat_details_nonce'] ) || ! wp_verify_nonce( $_POST['wpm_product_cat_details_nonce'], basename( __FILE__ ) ) ) {
		return;
	}

	$old_details = get_term_meta( $term_id, 'details', true );
	$new_details = isset( $_POST['wpm-product-cat-details'] ) ? $_POST['wpm-product-cat-details'] : '';

	if ( $old_details && '' === $new_details ) {
		delete_term_meta( $term_id, 'details' );
	} else if ( $old_details !== $new_details ) {
		update_term_meta(
			$term_id,
			'details',
			wpm_sanitize_details( $new_details )
		);
	}
}





//add_action( 'woocommerce_before_shop_loop', 'wpm_product_cat_display_details_meta' );
/**
 * Display details meta on Product Category archives.
 *
 */
function wpm_product_cat_display_details_meta() {

	if ( ! is_tax( 'product_cat' ) ) {
		return;
	}

	$t_id = get_queried_object()->term_id;
	$details = get_term_meta( $t_id, 'details', true );

	if ( '' !== $details ) {
		?>
		<div class="product-cat-details">
			<?php echo apply_filters( 'the_content', wp_kses_post( $details ) ); ?>
		</div>
		<?php
	}

}







foreach ( array( 'pre_term_description' ) as $filter ) {
    remove_filter( $filter, 'wp_filter_kses' );
}
 
foreach ( array( 'term_description' ) as $filter ) {
    remove_filter( $filter, 'wp_kses_data' );
}



























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

	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'intuity' ),
		'id'            => 'footer',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'intuity_widgets_init' );



/**
* Custom Login Page
*/
function mbm_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_template_directory_uri() . '/style-login.css' );
    //wp_enqueue_script( 'custom-login', get_template_directory_uri() . '/style-login.js' );
}
add_action( 'login_enqueue_scripts', 'mbm_login_stylesheet' );


function mbm_login_items_header(){
	$site_url = get_site_url();
	$theme_dir = get_stylesheet_directory_uri();
	echo '<div id="page" class="site">
		<header id="masthead" class="site-header" role="banner">
			<div class="site-branding">
				<a id="logo" href="' . $site_url . '"><img src="' . $theme_dir . '/img/intuity-logo-white.png" alt="Intuity Healing Academy" width="175"></a>
			</div>
		</header>';
}
add_action('login_head', 'mbm_login_items_header');








/**
 * Enqueue scripts and styles.
 */
function intuity_scripts() {
	wp_enqueue_style( 'intuity-style', get_stylesheet_uri(), '', '1.2' );
	wp_enqueue_style( 'intuity-calendar-style', get_stylesheet_directory_uri() . '/inc/calendar.css' );
	wp_enqueue_script( 'intuity-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'intuity-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_register_script('responsive_video_js', get_template_directory_uri() . '/js/responsive-video.js', array('jquery'), '1.0' );
    wp_enqueue_script('responsive_video_js');

	// if(is_page('team')){
	// 	wp_enqueue_script( 'intuity-resize-grid', get_template_directory_uri() . '/js/resize_grid.js', array('jquery'), '20151215', false ); 
	// }
	


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
require_once get_template_directory() . '/inc/calendar.php';