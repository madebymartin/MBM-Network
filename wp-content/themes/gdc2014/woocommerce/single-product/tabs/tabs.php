<?php
/**
 * Single Product tabs
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $product;
/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) {

	echo '<div class="woocommerce-tabs wc-tabs-wrapper">';


	// Woocommerce tabs
	foreach ( $tabs as $key => $tab ){
		echo '<div class="tab" id="section-' . $key . '">';
		//echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key );
			//echo $tab['title'];
			call_user_func( $tab['callback'], $key, $tab );
			//print_r($tab);
		echo '</div>';
	}
	echo '</div>';


	// Feefo Tab
	$sku = $product->get_sku();
	$theme_dir = get_stylesheet_directory_uri();
	$xsl_url = $theme_dir . '/lib/feefo/feedback-single-product.xsl';
	$xml_url = "http://ww2.feefo.com/api/xmlfeedback?merchantidentifier=germaine-de-capuccini&protocol=https&mode=product&negativesanswered=true&limit=200&sortby=date&order=desc&allcomments=True&since=year&vendorref=" . $sku;
	$xml = simplexml_load_file($xml_url);

	if( ! $xml ) { 
	// COULDNT GET THE XML FROM FEEFO
	} 
	else { 
		// SUCCESSFULLY GOT FEEFO XML FEED
		foreach ($xml as $feedback) {
			if($feedback->TOTALPRODUCTCOUNT){$review_count = $feedback->TOTALPRODUCTCOUNT;}
		}
	}

	if( $review_count > 0 && !empty($sku) ){
		echo '<div class="tab" id="section-feeforeviews">';
			echo '<h2>Reviews<br><span class="feefo">Powered by <a target="blank" href="http://ww2.feefo.com/en-gb/reviews/germaine-de-capuccini#?timeFrame=ALL&sort=newest"><img src="' . $theme_dir . '/images/feefo-logo.png" alt="Powered by Feefo" title="Powered by Feefo"></a></span></h2>';
			// OLD PHP
			if (phpversion() < "5"){
				$xmldoc = domxml_open_file( $xml_url);
				$xsldoc = domxml_xslt_stylesheet_file ( $xsl_url );
				$result = $xsldoc->process($xmldoc);
				echo $result->dump_mem();
			}
			// PHP over v4:
			else
			{
				$doc = new DOMDocument();
				$xsl = new XSLTProcessor();
				$doc->load($xsl_url);
				$xsl->importStyleSheet($doc);
				$doc->load($xml_url);
				echo $xsl->transformToXML($doc);
			}
			echo '<br><a target="blank" href="http://ww2.feefo.com/en-gb/reviews/germaine-de-capuccini#?timeFrame=ALL&sort=newest">View all our reviews on Feefo</a>';
		echo '</div>'; // reviews tab
	}
}



/*if ( ! empty( $tabs ) ) : ?>

	<div class="woocommerce-tabs wc-tabs-wrapper">
		<ul class="tabs wc-tabs">
			<?php foreach ( $tabs as $key => $tab ) : ?>
				<li class="<?php echo esc_attr( $key ); ?>_tab">
					<a href="#tab-<?php echo esc_attr( $key ); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php foreach ( $tabs as $key => $tab ) : ?>
			<div class="panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>">
				<?php call_user_func( $tab['callback'], $key, $tab ); ?>
			</div>
		<?php endforeach; ?>
	</div>

<?php endif; */

?>