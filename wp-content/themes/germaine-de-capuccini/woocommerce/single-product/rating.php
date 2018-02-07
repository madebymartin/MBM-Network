<?php
/**
 * Single Product Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/rating.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.3.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
	return;
}


$sku = $product->get_sku();
if( empty($sku) ){return;}


$xml_url = "https://ww2.feefo.com/api/xmlfeedback?merchantidentifier=germaine-de-capuccini&protocol=https&mode=product&negativesanswered=true&sortby=date&order=asc&allcomments=True&since=year&vendorref=" . $sku;
$xml = simplexml_load_file($xml_url);
$theme_dir = get_stylesheet_directory_uri();



if( ! $xml ) { 
// COULDNT GET THE XML FROM FEEFO
} 
else { 
	// SUCCESSFULLY GOT FEEFO XML FEED
	foreach ($xml as $feedback) {
		//echo $feedback->AVERAGE;
		if($feedback->AVERAGE){$average_rating_percent = $feedback->AVERAGE;}
		if($feedback->TOTALPRODUCTCOUNT){$review_count = $feedback->TOTALPRODUCTCOUNT;}
	}
	$average_rating_of_5 = $average_rating_percent/20;

	if( $review_count == '1' ){$rt = 'review';}
	elseif( $review_count > '1' ){$rt = 'reviews';}

	if( $review_count > 0 ){
		echo '<div class="woocommerce-product-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';
			echo '<div class="star-rating" title="Rated ' . $average_rating_of_5 . ' out of 5">';
				echo '<span style="width:' . $average_rating_percent . '%">';
					echo '<strong itemprop="ratingValue" class="rating">' . $average_rating_of_5 . '</strong> out of <span itemprop="bestRating">5</span> based on <span itemprop="ratingCount" class="rating">' . $review_count . '</span> customer ratings';
				echo '</span>';
			echo '</div>';
			echo '<a href="#tab-reviews" class="woocommerce-review-link" rel="nofollow">(<span itemprop="reviewCount" class="count">' . $review_count . '</span> ' . $rt . ') <img width="110" class="feefologo" src="' . $theme_dir . '/img/feefo/feefo-logo.png" alt="Powered by Feefo" title="Powered by Feefo"></a>';
			echo '';

		echo '</div>';
	}

} 





/*$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();*/



/*if ( $rating_count > 0 ) : ?>

	<div class="woocommerce-product-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
		<div class="star-rating" title="<?php printf( __( 'Rated %s out of 5', 'woocommerce' ), $average ); ?>">
			<span style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>%">
				<strong itemprop="ratingValue" class="rating"><?php echo esc_html( $average ); ?></strong> <?php printf( __( 'out of %s5%s', 'woocommerce' ), '<span itemprop="bestRating">', '</span>' ); ?>
				<?php printf( _n( 'based on %s customer rating', 'based on %s customer ratings', $rating_count, 'woocommerce' ), '<span itemprop="ratingCount" class="rating">' . $rating_count . '</span>' ); ?>
			</span>
		</div>
		<?php if ( comments_open() ) : ?><a href="#reviews" class="woocommerce-review-link" rel="nofollow">(<?php printf( _n( '%s customer review', '%s customer reviews', $review_count, 'woocommerce' ), '<span itemprop="reviewCount" class="count">' . $review_count . '</span>' ); ?>)</a><?php endif ?>
	</div>

<?php endif; */

?>
