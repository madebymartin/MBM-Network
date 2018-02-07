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


add_action('wp_enqueue_scripts', 'LAP_enqueue_scripts');
if(!function_exists('LAP_enqueue_scripts')){
	function LAP_enqueue_scripts(){
		
		wp_register_style('quicksand-font-css', 'https://fonts.googleapis.com/css?family=Quicksand');
		wp_enqueue_style ('quicksand-font-css');
		wp_enqueue_style( 'lap-bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css' );
		wp_enqueue_style( 'lap-lightbox-css', get_stylesheet_directory_uri() . '/css/lightbox.css' );
		wp_enqueue_style( 'lap-bootstrap-theme', get_stylesheet_directory_uri() . '/css/bootstrap-theme.css' );
		wp_enqueue_style( 'lap-style', get_stylesheet_uri() );


		// wp_register_script('smoothscroll-js', get_stylesheet_directory_uri() . '/js/jquery.smooth-scroll.js', array('jquery'), false, true);
		// wp_register_script('ba-bbq-js', get_stylesheet_directory_uri() . '/js/jquery.ba-bbq.js', array('jquery'), false, true);
		// wp_register_script('smoothscroll', get_stylesheet_directory_uri() . '/js/smoothscroll.js', array('jquery'), false, true);

		// wp_enqueue_script ('smoothscroll-js');
		// wp_enqueue_script ('ba-bbq-js');
		// wp_enqueue_script ('smoothscroll');
		
		// wp_enqueue_script( 'lap-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
		wp_enqueue_script( 'lap-lightbox-js', get_template_directory_uri() . '/js/lightbox.js', array('jquery'), '2.9.0', false );
		// wp_enqueue_script( 'lap-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
		wp_enqueue_script( 'lap-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'), '20170721', true );
		wp_enqueue_script( 'lap-theme-js', get_template_directory_uri() . '/js/theme.js', array('jquery'), '20170721', true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}
}






remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 30);



/*wp_register_script('scrollspy_js', get_stylesheet_directory_uri() . '/js/scrollspy.js', array('jquery'), false, true);
wp_enqueue_script ('scrollspy_js');
*/