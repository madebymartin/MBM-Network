<?php
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





add_action('woocommerce_before_shop_loop_item_title', 'mbm_wrap_loop_image_open', 9);
if(!function_exists('mbm_wrap_loop_image_open')){
	function mbm_wrap_loop_image_open(){
		echo '<div class="image-wrapper">';
	}
}
add_action('woocommerce_before_shop_loop_item_title', 'mbm_wrap_loop_image_close', 11);
if(!function_exists('mbm_wrap_loop_image_close')){
	function mbm_wrap_loop_image_close(){
		echo '</div>';
	}
}


if(!function_exists('mbm_woocommerce_output_product_description')){
	function mbm_woocommerce_output_product_description(){
		echo '<div class="description">';
			the_content();
		echo '</div>';
	}
}



if(!function_exists('mbm_random_related_testimonial')){
	function mbm_random_related_testimonial(){
		$term_id = get_queried_object_id();
		$args = array(
			'post_type' => 'testimonial',
			'posts_per_page'	=> 1,
			'orderby'	=>	'rand',
			'order'	=>	'ASC',
			'meta_query' => array(
				array(
					'key'     => 'mbm_praise_for',
					'value'   => $term_id,
					'compare' => 'LIKE',
					'fields'	=> 'ids',
				),
			),
		);
		$testimonials = new WP_Query( $args );
		if ($testimonials->have_posts()){
			$testimonial = $testimonials->posts[0];
			echo '<div class="testimonial"><div class="bubble"><p>'. $testimonial->post_content .'</p></div><p class="speech">'. $testimonial->post_title .'</p></div>';
		}
	}
}



/* 
*	SHOW / HIDE PRODUCT IMAGE DEPENDING ON CMB CHECKBOX
*/
add_action('template_redirect', 'mbm_single_product_image_show_hide');
if(!function_exists('mbm_single_product_image_show_hide')){
	function mbm_single_product_image_show_hide(){
		if(get_post_meta(get_the_ID(), 'mbm_showimage', true) == 'on'){}
		else{remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );}
	}
}


add_filter('body_class','mbm_image_hide_bodyclass');
function mbm_image_hide_bodyclass( $classes ) {
	if ( get_post_meta( get_the_ID(), 'mbm_showimage', true ) ) {}
	else{ $classes[] = 'hide-image'; }
	return $classes;
}





add_action('template_redirect', 'mbm_woocommerce_hooks');
if(!function_exists('mbm_woocommerce_hooks')){
	function mbm_woocommerce_hooks(){
		// Single Product
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
		add_action( 'woocommerce_after_single_product_summary', 'mbm_woocommerce_output_product_description', 10 );
		remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);

		remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
		remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );

		add_action( 'woocommerce_after_shop_loop', 'woocommerce_taxonomy_archive_description', 10 );
		add_action( 'woocommerce_after_shop_loop', 'woocommerce_product_archive_description', 10 );

		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

		add_action( 'woocommerce_after_shop_loop', 'mbm_random_related_testimonial', 10 );

		

	}
}