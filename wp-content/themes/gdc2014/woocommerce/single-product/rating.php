<?php
/**
 * Single Product Rating
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.3.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
$sku = $product->get_sku();
$xml_url = "https://ww2.feefo.com/api/xmlfeedback?merchantidentifier=germaine-de-capuccini&protocol=https&mode=product&negativesanswered=true&sortby=date&order=asc&allcomments=True&since=year&vendorref=" . $sku;
$xml = simplexml_load_file($xml_url);
$theme_dir = get_stylesheet_directory_uri();

if( empty($sku) ){return;}



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
		echo '<div class="woocommerce-product-rating" itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating">';
			echo '<div class="star-rating" title="Rated ' . $average_rating_of_5 . ' out of 5">';
				echo '<span style="width:' . $average_rating_percent . '%">';
					echo '<strong itemprop="ratingValue" class="rating">' . $average_rating_of_5 . '</strong> out of <span itemprop="bestRating">5</span> based on <span itemprop="ratingCount" class="rating">' . $review_count . '</span> customer ratings';
				echo '</span>';
			echo '</div>';
			echo '<a href="#section-feeforeviews" class="woocommerce-review-link" rel="nofollow">(<span itemprop="reviewCount" class="count">' . $review_count . '</span> ' . $rt . ')<img width="110" class="feefologo" src="' . $theme_dir . '/images/feefo-logo.png" alt="Powered by Feefo" title="Powered by Feefo"></a>';
			echo '';

		echo '</div>';
	}

} 
?>