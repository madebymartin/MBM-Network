<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Intuity
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function intuity_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'intuity_body_classes' );



wp_register_style('quicksand-font-css', 'https://fonts.googleapis.com/css?family=Quicksand');
wp_enqueue_style ('quicksand-font-css');


// wp_register_script('smoothscroll-js', get_stylesheet_directory_uri() . '/js/jquery.smooth-scroll.js', array('jquery'), false, true);
// wp_register_script('ba-bbq-js', get_stylesheet_directory_uri() . '/js/jquery.ba-bbq.js', array('jquery'), false, true);
wp_register_script('theme_jquery', get_stylesheet_directory_uri() . '/js/theme.jquery.js', array('jquery'), false, true);

// // wp_enqueue_script ('smoothscroll-js');
// wp_enqueue_script ('ba-bbq-js');
wp_enqueue_script ('theme_jquery');



remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 30);



/*wp_register_script('scrollspy_js', get_stylesheet_directory_uri() . '/js/scrollspy.js', array('jquery'), false, true);
wp_enqueue_script ('scrollspy_js');
*/