<?php
/**
 * Customer processing order email
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
	date_default_timezone_set('Europe/London');
	$date = date_create();
	$date_timestamp = date_timestamp_get($date);
	$day = date("l", $date_timestamp );
	$time = date("H", $date_timestamp );
	
	//FOR TESTING...
/*	$day = 'Thursday';
	$time = '15';*/
	do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text ); 
	$ordertotal = $order->get_total();
	$donation = $ordertotal / 10;
	$donation2dp = number_format($donation, 2);
	//echo $donation2dp . '<br>';

	if($day === 'Friday' && $time < '12'){
		// FRIDAY BEFORE dispatch
		$dispatch_message = 'In support of Breast Cancer Awareness Month, we will donate <b>£' . $donation2dp . '</b> (10% of your order) on your behalf.</p><p>Your order will be dispatched today and should arrive on ' . date('l', strtotime('next monday')) . '';
		$deldate = date('l jS F', strtotime('next monday'));
	}
	elseif($day === 'Friday' && $time > '11' || $day === 'Saturday' || $day === 'Sunday'){
		// FRIDAY AFTER dispatch OR WEEKEND
		$dispatch_message = 'In support of Breast Cancer Awareness Month, we will donate <b>£' . $donation2dp . '</b> (10% of your order) on your behalf.</p><p>Your order will be dispatched on Monday so you should receieve your delivery on ' . date('l', strtotime('next tuesday')) . '.';
		$deldate = date('l jS F', strtotime('next tuesday'));
	}
	elseif($day === 'Thursday' && $time > '11'){
		// THURSDAY AFTER dispatch
		$dispatch_message = 'In support of Breast Cancer Awareness Month, we will donate <b>£' . $donation2dp . '</b> (10% of your order) on your behalf.</p><p>Your order will be dispatched tomorrow and should arrive on ' . date('l', strtotime('next monday')) . '.';
		$deldate = date('l jS F', strtotime('next monday'));
	}
	elseif($time < '12'){
		// MON-THURS BEFORE dispatch
		$dispatch_message = 'In support of Breast Cancer Awareness Month, we will donate <b>£' . $donation2dp . '</b> (10% of your order) on your behalf.</p><p>Your order will be dispatched today so you should receieve your delivery tomorrow.';
		$deldate = date("l jS F", $date_timestamp + '86400');
	}
	else{
		// MON - WEDS AFTER dispatch
		$dispatch_message = 'In support of Breast Cancer Awareness Month, we will donate <b>£' . $donation2dp . '</b> (10% of your order) on your behalf.</p><p>Your order will be dispatched tomorrow so you should receieve your delivery on ' . date("l", $date_timestamp + '172800');
		$deldate = date("l jS F", $date_timestamp + '172800');
	}


	do_action('woocommerce_email_header', $email_heading); 


?>
<table style="width:100%;">
	<tr>
		<td><?php _e( "<p>Hi " . $order->billing_first_name . ", thank you for your order. " . $dispatch_message . ' We\'ll send you another email to confirm when your order has been dispatched.</p><p>If you have any questions or concerns, please don\'t hesitate to call us during usual office hours on <b>0845 600 0203</b> (local rate).</p><h2>Your order number is <strong>' . $order->get_order_number() . '</strong></h2><h3>Estimated delivery: ' . $deldate . '</h3><br><hr>', 'woocommerce' ); ?></td>
		<td><img src="https://germaine-de-capuccini.co.uk/email/images/ribbon.jpg" alt="Breast Cancer Awareness Week" style="float:right; width:150px; height:auto;"></td>
	</tr>
</table>


<table class="td" cellspacing="0" cellpadding="6" style="width: 100%; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;" border="0">
	<thead>
		<tr>
			<th class="td" scope="col" style="text-align:left;"><?php _e( 'Product', 'woocommerce' ); ?></th>
			<th class="td" scope="col" style="text-align:left;"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
			<th class="td" scope="col" style="text-align:left;"><?php _e( 'Price', 'woocommerce' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php echo $order->email_order_items_table( $order->is_download_permitted(), false, true, true, $order->has_status( 'processing' ) ); ?>

	</tbody>
	<tfoot>
		<?php
			if ( $totals = $order->get_order_item_totals() ) {
				$i = 0;
				foreach ( $totals as $total ) {
					$i++;
					?><tr>
						<th class="td" scope="row" colspan="2" style="text-align:left; <?php if ( $i == 1 ) echo 'border-top-width: 4px;'; ?>"><?php echo $total['label']; ?></th>
						<td class="td" style="text-align:left; <?php if ( $i == 1 ) echo 'border-top-width: 4px;'; ?>"><?php echo $total['value']; ?></td>
					</tr><?php
				}
			}
		?>
	</tfoot>
</table>

<br><br><p>Thanks again for being a valued customer, we hope to see you again soon!</p>

<?php do_action( 'woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text ); ?>

<?php do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text ); ?>

<?php do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text ); ?>

<?php do_action( 'woocommerce_email_footer' ); ?>
