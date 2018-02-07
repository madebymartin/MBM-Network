<?php
function mbm_jquery_tabs() {

	// REGISTER JS + CSS FOR TABBED NAV
	//wp_register_script( 'jquery-tabs', get_stylesheet_directory_uri() . '/lib/js/tabs.js', array('jquery'), false, false );
	wp_register_script( 'jquery-tabs-categories', get_stylesheet_directory_uri() . '/lib/js/tabs-categories.js', array('jquery'), false, false );
	wp_register_script( 'jquery-tabs-concerns', get_stylesheet_directory_uri() . '/lib/js/tabs-concerns.js', array('jquery'), false, false );
	wp_register_script( 'jquery-tabs-ranges', get_stylesheet_directory_uri() . '/lib/js/tabs-ranges.js', array('jquery'), false, false );
	wp_register_style('tabs-css', get_stylesheet_directory_uri() . '/lib/css/jquery-tabs-style.css', array('jigoshop-required'));

	// enqueue the scripts for use in theme
	wp_enqueue_script('jquery-ui-core');// enqueue jQuery UI Core
	wp_enqueue_script('jquery-ui-tabs');// enqueue jQuery UI Tabs
	wp_enqueue_style ('tabs-css');

	if ( !is_admin() ) {
		if ( is_page( 'products' ) || is_page( '5793' ) || is_shop() || is_tax( 'product_cat' ) || is_page( 'special-offers' ) || is_page( '5830' ) || is_singular( 'product' ) || is_page_template( 'template-custom-shop-page.php' )){ wp_enqueue_script ('jquery-tabs-categories'); }
		elseif (is_tax( 'product_range' )){ wp_enqueue_script ('jquery-tabs-ranges'); }
		elseif (is_tax( 'skin_concern' )){ wp_enqueue_script ('jquery-tabs-concerns'); }
		else{ 
			//wp_enqueue_script ('jquery-tabs-categories'); 
		}
	}
}
add_action('wp_enqueue_scripts', 'mbm_jquery_tabs');
?>