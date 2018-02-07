<?php
/**
 * The template for displaying product category thumbnails within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Increase loop count
$woocommerce_loop['loop'] ++;
?>
<li class="productcat<?php
    if ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 || $woocommerce_loop['columns'] == 1 )
        echo ' first';
	if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 )
		echo ' last';
	?>">

	<?php do_action( 'woocommerce_before_subcategory', $category ); ?>

	<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
		<div class="image-wrap">
			<?php 
			$thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );
			$image = wp_get_attachment_url( $thumbnail_id );
			//if ( $image ) {
				echo '<img src="' . $image . '" alt="' . $category->name . '" />';
			//}


				//woocommerce_subcategory_thumbnail($category); ?>
            <span class="info-icon"></span>
        </div>
        <?php
			/**
			 * woocommerce_before_subcategory_title hook
			 * @unhooked woocommerce_subcategory_thumbnail - 10
			 */
			do_action( 'woocommerce_before_subcategory_title', $category );
		?>
		<h3><?php echo $category->name; ?></h3>
		<?php
			/**
			 * woocommerce_after_subcategory_title hook
			 */
			do_action( 'woocommerce_after_subcategory_title', $category );
		?>
        <div class="prodcatinfo">
            <p class="mobilehide">
            	<?php echo $category->category_description; ?>
            </p>
        </div>
			<?php
			if ( $category->count > 0 ){
				echo '<span class="mobilehide button">View ' . $category->count . ' products</span>';
			}
			//echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category );
			?>
	</a>
	<?php do_action( 'woocommerce_after_subcategory', $category ); ?>
</li>
