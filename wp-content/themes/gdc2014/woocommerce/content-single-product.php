<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if(!current_user_can( 'switch_themes' )){
	$terms = wp_get_post_terms( get_the_id(), 'product_cat' );
	$this_product_id = get_the_id();
	foreach ( $terms as $term ) $categories[] = $term->slug;
	if ( in_array( 'samples', $categories ) ) {  
		$linked_products = new WP_Query( array( 
		'post_type' => 'product', 
		'posts_per_page' => 1,
		'orderby' => 'date', 
		'order' => 'DESC',
		'meta_query' => array(
			array(
				'key'     => 'sample_version',
				'value'   => array( $this_product_id ),
				'compare' => 'IN',
				),
			),
		) ); 
		while ( $linked_products->have_posts() ) : $linked_products->the_post();

			$linked_product_id = get_the_id();
			$linked_product_url = get_permalink( $linked_product_id );
			echo $linked_product_url;
			wp_redirect( $linked_product_url ); exit;
		endwhile;
		wp_reset_query(); 
	}
}



	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
		/**
		 * woocommerce_before_single_product_summary hook
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary">

		<?php
			/**
			 * woocommerce_single_product_summary hook
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 */
			do_action( 'woocommerce_single_product_summary' );
		?>

	</div><!-- .summary -->

	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
<!-- Please call pinit.js only once per page -->
<script type="text/javascript" async defer  data-pin-shape="round" data-pin-height="32" data-pin-hover="true" src="//assets.pinterest.com/js/pinit.js"></script>
