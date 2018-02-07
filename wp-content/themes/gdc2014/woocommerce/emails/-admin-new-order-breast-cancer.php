<?php
/**
 * Admin new order email
 *
 * @author WooThemes
 * @package WooCommerce/Templates/Emails/HTML
 * @version 2.4.0
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

	if($day === 'Friday' && $time < '12'){
		// FRIDAY BEFORE dispatch
		$dispatchdate = date("l jS F", $date_timestamp);
		$deliverydate = date('l jS F', strtotime('next monday'));
	}
	elseif($day === 'Friday' && $time > '11' || $day === 'Saturday' || $day === 'Sunday'){
		// FRIDAY AFTER dispatch OR WEEKEND
		$dispatchdate = date('l jS F', strtotime('next monday'));
		$deliverydate = date('l jS F', strtotime('next tuesday'));
	}
	elseif($day === 'Thursday' && $time > '11'){
		// THURSDAY AFTER dispatch
		$dispatchdate = date("l jS F", $date_timestamp + '86400');
		$deliverydate = date('l jS F', strtotime('next monday'));
	}
	elseif($time < '12'){
		// MON-THURS BEFORE dispatch
		$dispatchdate = date("l jS F", $date_timestamp);
		$deliverydate = date("l jS F", $date_timestamp + '86400');
	}
	else{
		// MON - WEDS AFTER dispatch
		$dispatchdate = date("l jS F", $date_timestamp + '86400');
		$deliverydate = date("l jS F", $date_timestamp + '172800');
	}
	$user_id = $order->get_user_id();
	$user = new WP_User( $user_id );

	// Find trade customer's salon
	$connected_salon = new WP_Query( array(
	  'connected_type' => 'salon_staff',
	  'post_status' => array('publish', 'draft'),
	  'connected_items' => $user_id,
	  'nopaging' => true,
	) );
		if ( $connected_salon->have_posts() ) {
		while ( $connected_salon->have_posts() ) : $connected_salon->the_post();
			$salon_object = $connected_salon->post;
			$salon_id = $salon_object->ID;
			$salon_name =  ' (' . get_the_title($salon_id) . ')';
		endwhile;
		wp_reset_postdata();
	}

	if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
		foreach ( $user->roles as $role ){
			$custrole = $role;
		}
		if($custrole == 'customer'){$custrole = 'Regular Customer';}
		elseif($custrole == 'trade_user'){
			$custrole = 'Trade Customer';

		}
		else{$custrole = $custrole;}
	}else{ $custrole = 'Guest'; }

	$customer_orders = get_posts( array(
    'numberposts' => -1,
    'meta_key'    => '_customer_user',
    'meta_value'  => $user_id,
    'post_type'   => wc_get_order_types(),
    'post_status' => array_keys( wc_get_order_statuses() ),
    'order'		  => 'ASC'
	) );


?>

<?php do_action( 'woocommerce_email_header', $email_heading ); ?>
<h2><a class="link" href="<?php echo admin_url( 'post.php?post=' . $order->id . '&action=edit' ); ?>"><?php printf( __( 'Order #%s', 'woocommerce'), $order->get_order_number() ); ?></a> (<?php printf( '<time datetime="%s">%s</time>', date_i18n( 'c', strtotime( $order->order_date ) ), date_i18n( wc_date_format(), strtotime( $order->order_date ) ) ); ?>)</h2>
<?php 
$count = '0';
$totalspend = '0';
foreach($customer_orders as $customer_order){
	$order_id = $customer_order->ID;
	$order_obj = new WC_Order($order_id);
	$spend = $order_obj->get_total();
	//echo '<br>' . $customer_order->ID . ' - ' . $order_obj->get_total() . '<hr>';
	$count++;
	if($count =='1'){ 
		$first_order = $customer_order->post_date_gmt;
	}
	$totalspend = $totalspend + $spend;
	$totalspend = round($totalspend, 2);
}
$ordertotal = $order->get_total();
$donation = $ordertotal / 10;
$donation2dp = number_format($donation, 2);
?>

<table style="width:100%;">
	<tr>
		<td><?php echo 'The amount to donate to Breast Cancer Awareness: <b>£'. $donation2dp .  '</b> (10% of the order).'; ?></td>
		<td><img src="https://germaine-de-capuccini.co.uk/email/images/ribbon.jpg" alt="Breast Cancer Awareness Week" style="float:right; width:150px; height:auto;"></td>
	</tr>
</table>


<?php
echo '<table border="0" cell-padding="5" style="width:100%; line-height: 1.35;">';
	echo '<tr>';
		echo '<td>';
			echo 'New order from ' . $order->billing_first_name . ' ' . $order->billing_last_name;
			echo '<ul>';
				echo '<li>' . $custrole . '' . $salon_name . '</li>';
				echo '<li>Total Orders: ' . $count . '</li>';
				echo '<li>First Order: ' . $first_order . '</li>';
				echo '<li>Total Spend: £' . $totalspend . '</li>';

				if( $order->get_used_coupons() ) {
				    $coupons_count = count( $order->get_used_coupons() );
				    $i = 1;
				    $coupons_list = '';
				    foreach( $order->get_used_coupons() as $coupon) {
				        $coupons_list .=  $coupon;
				        if( $i < $coupons_count )
				            $coupons_list .= ', '; 
				        $i++;
				    }
				    echo '<li>' . __('Coupons used') . ' (' . $coupons_count . '): <b>' . $coupons_list . '</b></li>';
				}

				echo '<li>Dispatch: ' . $dispatchdate . '</li>';
				echo '<li>Delivery: ' . $deliverydate . '</li>';

			echo '</ul>';
		echo '</td>';
		echo '<td style="border:1px solid #333;"><p>Delivery Address</p>' . $order->get_shipping_address() . '</td>';
	echo '</tr>';
echo '</table><br>';
do_action( 'woocommerce_email_before_order_table', $order, true, false );




?>

<table class="td" cellspacing="0" cellpadding="6" style="width: 100%; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;" border="0">
	<thead>
		<tr>
			<th class="td" scope="col" style="text-align:left;"><?php _e( 'Product', 'woocommerce' ); ?></th>
			<th class="td" scope="col" style="text-align:left;"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
			<th class="td" scope="col" style="text-align:left;"><?php _e( 'Price', 'woocommerce' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php echo $order->email_order_items_table( false, true, true, true ); ?>
	</tbody>
	<tfoot>
		<?php
			if ( $totals = $order->get_order_item_totals() ) {
				$i = 0;
				foreach ( $totals as $total ) {
					$i++;
					?><tr>
						<th class="td" scope="col" colspan="2" style="font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; text-align:left; <?php if ( $i == 1 ) echo 'border-top-width: 4px;'; ?>"><?php echo $total['label']; ?></th>
						<td class="td" scope="col" style="text-align:left; <?php if ( $i == 1 ) echo 'border-top-width: 4px;'; ?>"><?php echo $total['value']; ?></td>
					</tr><?php
				}
			}
		?>
	</tfoot>
</table>

<?php do_action( 'woocommerce_email_after_order_table', $order, true, false ); ?>

<?php do_action( 'woocommerce_email_order_meta', $order, true, false ); ?>

<?php do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text ); ?>

<?php do_action( 'woocommerce_email_footer' ); ?>
