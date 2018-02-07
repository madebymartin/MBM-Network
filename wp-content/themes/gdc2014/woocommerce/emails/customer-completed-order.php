<?php
/**
 * Customer completed order email
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


	if($day === 'Friday' || $day === 'Saturday' || $day === 'Sunday'){
		// DISPATCHED FRIDAY SATURDAY OR SUNDAY 
		$delivery_message = 'It should arrive on ' . date('l', strtotime('next monday')) . '.';
		$deldate = date('l jS F', strtotime('next monday'));
	}
	else{
		// DISPATCHED MON - THURS 
		$delivery_message = 'It should arrive on ' . date("l", $date_timestamp + '129600') . '.';
		$deldate = date('l jS F', $date_timestamp + '129600');
	}


?>

<?php do_action( 'woocommerce_email_header', $email_heading ); ?>

<p><?php _e( "<p>Hi " . $order->billing_first_name . ", your order has been dispatched. " . $delivery_message . " Thanks again for being a fantastic customer!</p><p>If you have any questions or concerns, please don't hesitate to call us during usual office hours on <b>0845 600 0203</b> (local rate).</p><h2>Your order number is <strong>" . $order->get_order_number() . "</strong></h2><h3>Estimated delivery: " . $deldate . "</h3><br><hr>", 'woocommerce' ); ?>

<?php do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text ); ?>

<table class="td" cellspacing="0" cellpadding="6" style="width: 100%; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;" border="0">
	<thead>
		<tr>
			<th class="td" scope="col" style="text-align:left;"><?php _e( 'Product', 'woocommerce' ); ?></th>
			<th class="td" scope="col" style="text-align:left;"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
			<th class="td" scope="col" style="text-align:left;"><?php _e( 'Price', 'woocommerce' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php echo $order->email_order_items_table( true, false, true, true ); ?>
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

<?php do_action( 'woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text ); ?>

<?php do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text ); ?>

<?php do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text ); ?>

<?php do_action( 'woocommerce_email_footer' ); ?>
