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





	// Crowbarred Feefo tab - for testing - should be moved to a function to insert this later on..



	$curdir = getcwd();
	// The principal possible parameters passed here are $logon and $limit. 
	//  $vendorref can be used if you want the feedback for particular products, for which you have sent unique vendorrefs 
	//  $vendorref may contain wildcards  (e.g.   *SKU1234*  would pick up a feedback on 'SKU1234 THURSDAY'
	//  You could also pass various other parameters - see the parameters passed at the top of the feedback viewing page on the Feefo site.
	//  have added mode, can be product or service or both

	//$logon = array_key_exists('logon', $_GET) ? $_GET['logon'] : null;
	$limit = array_key_exists('limit', $_GET) ? $_GET['limit'] : null;
	$mode = array_key_exists('mode', $_GET) ? $_GET['mode'] : null;
	$vendorref = array_key_exists('vendorref', $_GET) ? $_GET['vendorref'] : null;
	$suppressnegatives = array_key_exists('suppressnegatives', $_GET) ? $_GET['suppressnegatives'] : null;

	$xml_filename = "http://ww2.feefo.com/api/xmlfeedback?merchantidentifier=germaine-de-capuccini";

	if ($limit)
		$xml_filename .= "&limit=".$limit;
	if ($vendorref)
	  $xml_filename.="&vendorref=".$vendorref;
	if ($mode)
	  $xml_filename.="&mode=".$mode; 
	if ($suppressnegatives)
	  $xml_filename.="&negativesanswered=true";

	 
	if (phpversion() < "5"){
		$xmldoc = domxml_open_file( $xml_filename);
		$xsldoc = domxml_xslt_stylesheet_file ( $curdir."/feedback.xsl");
		$result = $xsldoc->process($xmldoc);
		echo $result->dump_mem();
	}
	else
	{
		$doc = new DOMDocument();
		$xsl = new XSLTProcessor();
		$doc->load($curdir."/feedback.xsl");
		$xsl->importStyleSheet($doc);
		$doc->load($xml_filename);
		echo $xsl->transformToXML($doc);
	}















	$sku = $product->get_sku();
	//$xmlurl = file_get_contents('http://ww2.feefo.com/api/xmlfeedback?merchantidentifier=germaine-de-capuccini&vendorref=' . $sku);    
	$xmlurl = 'http://ww2.feefo.com/api/xmlfeedback?merchantidentifier=germaine-de-capuccini&vendorref=' . $sku;    
	$xml = simplexml_load_string($xmlurl, null, LIBXML_NOCDATA);
	//$xml = simplexml_load_file($xmlurl, null, LIBXML_NOCDATA);
	



	echo '<div class="tab" id="section-feeforeviews">';
		echo '<h3>Feefo</h3>';
		echo $sku;
		echo '<hr>' . $xmlurl;
		echo '<hr>';

			print_r($xml); 


/*		
			foreach( $xml->feedbacklist->feedback as $feedback ){
				echo (string)$feedback;
				echo '<hr>';
			}*/


		echo '<hr>';

	echo '</div>';




	foreach ( $tabs as $key => $tab ){
		echo '<div class="tab" id="section-' . $key . '">';
		//echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key );
			//echo $tab['title'];
			call_user_func( $tab['callback'], $key, $tab );
			//print_r($tab);
		echo '</div>';
	}
	echo '</div>';
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
