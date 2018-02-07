<?php
/*
 * Configure WooCommerce
 */

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

// Unhook WooCommerce wrappers
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// Set WooCommerce wrappers
add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
  echo '<div id="primary" class="content-area">
  			<main id="main" class="site-main" role="main">';
}

function my_theme_wrapper_end() {
  echo '</main>
    	<!-- #main -->
  		</div>
  		<!-- #primary -->';
}

//Add featured image support to shop page
add_action('stnsvn_pre_content', 'paloma_shop_featured', 25);

function paloma_shop_featured() {
    $page_id = wc_get_page_id('shop');
    if (is_shop() && has_post_thumbnail($page_id)) {  // If has post thumbnail, display
        $thumb_id = get_post_thumbnail_id($page_id);
        $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
        $thumb_url = $thumb_url_array[0];   
        ?> 
                    <div class="page-featured-img" style="background: url('<?php echo $thumb_url; ?>'); background-position: 50%; background-size: cover;"></div>
    <?php }
}

//Add shop class to shop page
if (class_exists( 'WooCommerce' )) {
    add_filter( 'body_class', 'paloma_shop_class' );
    function paloma_shop_class( $classes ) {
            if ( is_shop( ) ) {
                $classes[] = 'shop-page';
            } 
            return $classes;
        }
}

// Change number or products per row to 2
add_filter('loop_shop_columns', 'paloma_loop_columns');
if (!function_exists('paloma_loop_columns')) {
    function paloma_loop_columns() {
        return 2; // 2 products per row
    }
}

// Changes number of products shown in WC
add_action('wp_loaded', 'paloma_number_wc_products');

function paloma_number_wc_products(){
    $number_products = get_theme_mod('wc_number_products', '6');
    add_filter( 'loop_shop_per_page', function( $cols ) use ( $number_products ) {
            return $number_products;
        }, 20
    );
}

//Configure WC Sidebar
add_action('woocommerce_sidebar', 'paloma_remove_wc_sidebar', 5);

function paloma_remove_wc_sidebar() {
    $paloma_wc_sidebar = get_theme_mod('paloma_woocommerce_style', 'full_width');
    if ($paloma_wc_sidebar == 'full_width'){
    	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar' );
    }
}

//WC Sidebar
function paloma_sidebar_wc(){
			add_filter( 'body_class', 'paloma_wc_sidebar_classes' ); //Add class to body
		    function paloma_wc_sidebar_classes( $classes ) {
		    	$paloma_wc_layout = get_theme_mod( 'paloma_woocommerce_style', 'full_width');
					if ( $paloma_wc_layout == 'sidebar' && (class_exists( 'WooCommerce' ) && (is_checkout() || is_cart() || is_woocommerce()) )) {
			     	   $classes[] = 'sidebar-layout';
			    	}
			    	return $classes;
				} 
			}

add_action('after_setup_theme', 'paloma_sidebar_wc');

//Add placeholder text to WooCommerce fields
    add_action( 'wp_head', 'paloma_review_inputs' );
    function paloma_review_inputs() {
        if (is_product()) {
         ?>       <script>
                jQuery(document).ready(function() {
                  jQuery('#author').attr('placeholder', 'Name');
                  jQuery('#email').attr('placeholder', 'Email');
                });
                </script>
        <?php
            }
    }

//Add support for WC3.0 gallery features

add_action( 'after_setup_theme', 'paloma_wc3_setup' );

function paloma_wc3_setup() {
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );
}

// Define WC image sizes
function paloma_woocommerce_image_dimensions() {
    global $pagenow;
 
    if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
        return;
    }

    $catalog = array(
        'width'     => '850',   // px
        'height'    => '590',   // px
        'crop'      => 1        // true
    );

    $single = array(
        'width'     => '850',   // px
        'height'    => '590',   // px
        'crop'      => 1        // true
    );

    $thumbnail = array(
        'width'     => '240',   // px
        'height'    => '166',   // px
        'crop'      => 1        // false
    );

    // Image sizes
    update_option( 'shop_catalog_image_size', $catalog );       // Product category thumbs
    update_option( 'shop_single_image_size', $single );         // Single product image
    update_option( 'shop_thumbnail_image_size', $thumbnail );   // Image gallery thumbs
}

add_action( 'after_switch_theme', 'paloma_woocommerce_image_dimensions', 1 );
