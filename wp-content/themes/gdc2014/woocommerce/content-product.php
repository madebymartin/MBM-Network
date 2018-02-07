<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}



// ONLY SHOW PRODUCT IN ARCHIVE PAGE IF IT DOESNT BELONG TO SAMPLES CATEGORY
if ( has_term( 'samples', 'product_cat' ) ) {


	// ADMIN CONTENT
          if ( current_user_can('administrator') ) { //ADMIN
          	?>
				<li <?php post_class( $classes );?> >
					<?php
					do_action( 'woocommerce_before_shop_loop_item' );
					do_action( 'woocommerce_before_shop_loop_item_title' );
					?>

					<h3><?php the_title(); ?></h3>

					<?php

					do_action( 'woocommerce_after_shop_loop_item_title' );
					?>


					<div class="excurpt">
						<?php 
						echo $product->get_categories( ', ', '<span class="categories"><em>' . _n( 'Category:', 'Categories:', $cat_count, 'woocommerce' ) . ' ', '</em></span><br>' ); 
					//	echo $product->get_tags( ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $tag_count, 'woocommerce' ) . ' ', '.</span>' );
						echo get_the_term_list( $post->ID, 'skin_concern', '<em>Suited to: ', ', ', '</em><br>' );
						echo get_the_term_list( $post->ID, 'product_range', '<em>Range: ', ', ', '</em><br>' );
						?>

						<br>
						<p><?php woocommerce_template_single_excerpt(); ?></p>
					</div>

					<div class="main-product-image">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php woocommerce_template_loop_product_thumbnail(); ?>
						</a>
					</div>

					<div class="buttons">
						<a href="<?php the_permalink(get_the_id()); ?>" class="button">More Info</a>
						<?php 
						if($product->is_purchasable()){
							do_action( 'woocommerce_after_shop_loop_item' ); 
						} else{echo '<div class="button">Unavailable</div>';}?>
					</div>

				</li>
			<?php
          } else{	// EVEYONE ELSE
          	// wp_redirect( '//germaine-de-capuccini.co.uk/shop/', $status );
			// exit;
          }
} else { ?>


	<li <?php post_class( $classes ); ?>>

		<?php 
		do_action( 'woocommerce_before_shop_loop_item' );

		//woocommerce_before_shop_loop_item_title hook
		//hooked woocommerce_show_product_loop_sale_flash - 10
		//unhooked woocommerce_template_loop_product_thumbnail - 10
		do_action( 'woocommerce_before_shop_loop_item_title' );
		?>

		<h3><?php the_title(); ?></h3>

		<?php
		/**
		 * woocommerce_after_shop_loop_item_title hook
		 *
		 * @hooked woocommerce_template_loop_rating - 5
		 * @unhooked woocommerce_template_loop_price - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item_title' );
		?>


		<div class="excurpt">
			<?php 
			echo $product->get_categories( ', ', '<span class="categories"><em>' . _n( 'Category:', 'Categories:', $cat_count, 'woocommerce' ) . ' ', '</em></span><br>' ); 
		//	echo $product->get_tags( ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $tag_count, 'woocommerce' ) . ' ', '.</span>' );
			echo get_the_term_list( $post->ID, 'skin_concern', '<em>Suited to: ', ', ', '</em><br>' );
			echo get_the_term_list( $post->ID, 'product_range', '<em>Range: ', ', ', '</em><br>' );
			?>

			<br>
			<p><?php woocommerce_template_single_excerpt(); ?></p>
		</div>

		<div class="main-product-image">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php woocommerce_template_loop_product_thumbnail(); ?>
			</a>
		</div>

		<div class="buttons">
			<a href="<?php the_permalink(get_the_id()); ?>" class="button">More Info</a>
			<?php 
			if($product->is_purchasable()){
				do_action( 'woocommerce_after_shop_loop_item' ); 
			} else{echo '<div class="button">Unavailable</div>';}?>
		</div>

	</li>
<?php } ?>