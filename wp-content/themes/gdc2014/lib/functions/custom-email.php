<?php 
/**
 * replace Email Content
 */

/**
 * New order notification email template
 * */
remove_action('order_status_pending_to_processing', 'jigoshop_new_order_notification');
remove_action('order_status_pending_to_completed', 'jigoshop_new_order_notification');
remove_action('order_status_pending_to_on-hold', 'jigoshop_new_order_notification');

add_action('order_status_pending_to_processing', 'jigoshop_new_order_notification_gdc');
add_action('order_status_pending_to_completed', 'jigoshop_new_order_notification_gdc');
add_action('order_status_pending_to_on-hold', 'jigoshop_new_order_notification_gdc');

function jigoshop_new_order_notification_gdc($order_id) {

    $order = new jigoshop_order($order_id);

    $subject = sprintf(__('%s Website Order # %s', 'jigoshop'), get_bloginfo('name'), $order->id);

    ob_start();

    echo __("You have received an order from ", 'jigoshop') . $order->billing_first_name . ' ' . $order->billing_last_name . __(". Their order is as follows:", 'jigoshop') . PHP_EOL . PHP_EOL;
    
    add_header_info($order);
    
    add_order_totals($order, false, true);

    add_customer_details($order);
    
    add_billing_address_details($order);

    add_shipping_address_details($order);

    $message = ob_get_clean();
    
    $message = apply_filters('jigoshop_change_new_order_email_contents', $message, $order);
    $message = html_entity_decode(strip_tags($message));

    wp_mail(get_option('jigoshop_email'), $subject, $message, "From: " . get_option('jigoshop_email') . "\r\n");
}

/**
 * Customer proccessing notification
 */
remove_action('order_status_pending_to_processing', 'jigoshop_processing_order_customer_notification');
remove_action('order_status_pending_to_on-hold', 'jigoshop_processing_order_customer_notification');

add_action('order_status_pending_to_processing', 'jigoshop_processing_order_customer_notification_gdc');
add_action('order_status_pending_to_on-hold', 'jigoshop_processing_order_customer_notification_gdc');

function jigoshop_processing_order_customer_notification_gdc( $order_id ) {

    $order = &new jigoshop_order( $order_id );

    $subject = '' . get_bloginfo('name') . ' ' . __('Order Received','jigoshop');

    ob_start();
echo 'Hi ';
echo $order->billing_first_name . ' ' . $order->billing_last_name . PHP_EOL;
    echo __("Thank you for your order, we are proccessing it now.",'jigoshop') . PHP_EOL . PHP_EOL;
	echo __("Unless otherwise specified, your order will be despatched within the next 1-2 working days and should arrive to you within 5 working days.",'jigoshop') . PHP_EOL . PHP_EOL;


    echo '<hr>' . PHP_EOL;
    echo __('Your order reference number is: ','jigoshop') . $order->id . '' . PHP_EOL;
    echo '<hr>' . PHP_EOL . PHP_EOL;

	echo 'The details of this order are as follows:' . PHP_EOL . PHP_EOL;

    echo $order->email_order_items_list(false, true); // no download links, show SKU

    if ($order->customer_note) :
        echo PHP_EOL . __('Note:','jigoshop') .$order->customer_note . PHP_EOL;
    endif;

    echo PHP_EOL . __('Subtotal:','jigoshop') . "\t\t\t" . html_entity_decode($order->get_subtotal_to_display(), ENT_COMPAT, 'UTF-8') . PHP_EOL;
    if ($order->order_shipping > 0) echo __('Shipping:','jigoshop') . "\t\t\t" . html_entity_decode($order->get_shipping_to_display(), ENT_COMPAT, 'UTF-8') . PHP_EOL;
    if ($order->order_discount > 0) echo __('Discount:','jigoshop') . "\t\t\t" . html_entity_decode(jigoshop_price($order->order_discount), ENT_COMPAT, 'UTF-8') . PHP_EOL;
    if ($order->get_total_tax() > 0) echo __('Tax:','jigoshop') . "\t\t\t\t" . html_entity_decode(jigoshop_price($order->get_total_tax()), ENT_COMPAT, 'UTF-8') . PHP_EOL;
    echo __('Total:','jigoshop') . "\t\t\t\t" . html_entity_decode(jigoshop_price($order->order_total), ENT_COMPAT, 'UTF-8') . ' - via ' . ucwords($order->payment_method) . PHP_EOL . PHP_EOL;

    do_action('jigoshop_after_email_order_info', $order->id);


    echo '<hr>' . PHP_EOL;
    echo __('Billing Details:','jigoshop') . PHP_EOL;
	echo '<br/>' . PHP_EOL;

    echo $order->billing_first_name . ' ' . $order->billing_last_name . PHP_EOL;
    if ($order->billing_company) echo $order->billing_company . PHP_EOL;
    echo $order->formatted_billing_address . PHP_EOL . PHP_EOL;

    do_action('jigoshop_after_email_billing_address', $order->id);

	echo '<hr>' . PHP_EOL;
    echo __('This order will be delivered to: ','jigoshop') . PHP_EOL;
	echo '<br/>' . PHP_EOL;

    echo $order->shipping_first_name . ' ' . $order->shipping_last_name . PHP_EOL;
    if ($order->shipping_company) echo $order->shipping_company . PHP_EOL;
    echo $order->formatted_shipping_address . PHP_EOL . PHP_EOL;

    do_action('jigoshop_after_email_shipping_address', $order->id);

    $message = ob_get_clean();
    $message = html_entity_decode( strip_tags( $message ) );

    wp_mail( $order->billing_email, $subject, $message );
}

/**
 * Order Status 'Complete' Confirmation Email
 * */
remove_action('order_status_completed', 'jigoshop_completed_order_customer_notification');
add_action('order_status_completed', 'jigoshop_completed_order_customer_notification_gdc');



function jigoshop_completed_order_customer_notification_gdc($order_id) {

    $order = new jigoshop_order($order_id);

    $subject = '' . get_bloginfo('name') . ' ' . __('Order Complete', 'jigoshop');

    ob_start();
	echo 'Hi ';
	echo $order->billing_first_name . ' ' . $order->billing_last_name . PHP_EOL;
    echo __("Your order is complete and on it's way to you. You should receive delivery within 3 working days", 'jigoshop') . PHP_EOL . PHP_EOL;

    echo '<hr>' . PHP_EOL;
    echo __('Your order reference number is: ','jigoshop') . $order->id . '' . PHP_EOL;
    echo '<hr>' . PHP_EOL . PHP_EOL;

	echo 'Order details are below:' . PHP_EOL . PHP_EOL;
    echo $order->email_order_items_list(true, true); // show download links and SKU

    if ($order->customer_note) :
        echo PHP_EOL . __('Note:', 'jigoshop') . $order->customer_note . PHP_EOL;
    endif;

    if (get_option('jigoshop_calc_taxes') == 'yes' && $order->order_subtotal_inc_tax)
        echo PHP_EOL . __('Retail Price:', 'jigoshop') . "\t\t\t" . html_entity_decode($order->get_subtotal_to_display(), ENT_COMPAT, 'UTF-8') . PHP_EOL;
    else
        echo PHP_EOL . __('Subtotal:', 'jigoshop') . "\t\t\t" . html_entity_decode($order->get_subtotal_to_display(), ENT_COMPAT, 'UTF-8') . PHP_EOL;
    if (get_option('jigoshop_calc_taxes') == 'yes' && $order->order_subtotal_inc_tax) :
        if ($order->order_shipping > 0)
            echo __('Shipping:', 'jigoshop') . "\t\t\t" . html_entity_decode($order->get_shipping_to_display(), ENT_COMPAT, 'UTF-8') . PHP_EOL;

        foreach ($order->get_tax_classes() as $tax_class) :
            if ($order->tax_class_is_not_compound($tax_class)) :
                echo $order->get_tax_class_for_display($tax_class) . ' (' . (float) $order->get_tax_rate($tax_class) . '%):' . "\t\t\t" . html_entity_decode($order->get_tax_amount($tax_class), ENT_COMPAT, 'UTF-8') . PHP_EOL;
            endif;
        endforeach;
        echo __('Subtotal:', 'jigoshop') . "\t\t\t" . html_entity_decode(jigoshop_price($order->order_subtotal_inc_tax), ENT_COMPAT, 'UTF-8') . PHP_EOL;
    else :
        if ($order->order_shipping > 0)
            echo __('Shipping:', 'jigoshop') . "\t\t\t" . html_entity_decode($order->get_shipping_to_display(), ENT_COMPAT, 'UTF-8') . PHP_EOL;
    endif;
    if ($order->order_discount > 0)
        echo __('Discount:', 'jigoshop') . "\t\t\t" . html_entity_decode(jigoshop_price($order->order_discount), ENT_COMPAT, 'UTF-8') . PHP_EOL;
    if (get_option('jigoshop_calc_taxes') == 'yes') :
        if ($order->order_subtotal_inc_tax) :
            foreach ($order->get_tax_classes() as $tax_class) :
                if (!$order->tax_class_is_not_compound($tax_class)) :
                    echo $order->get_tax_class_for_display($tax_class) . ' (' . (float) $order->get_tax_rate($tax_class) . '%):' . "\t\t\t" . html_entity_decode($order->get_tax_amount($tax_class), ENT_COMPAT, 'UTF-8') . PHP_EOL;
                endif;
            endforeach;
        else :
            foreach ($order->get_tax_classes() as $tax_class) :
                echo $order->get_tax_class_for_display($tax_class) . ' (' . (float) $order->get_tax_rate($tax_class) . '%):' . "\t\t\t" . html_entity_decode($order->get_tax_amount($tax_class), ENT_COMPAT, 'UTF-8') . PHP_EOL;
            endforeach;
        endif;
    endif;
    echo __('Total:', 'jigoshop') . "\t\t\t\t" . html_entity_decode(jigoshop_price($order->order_total), ENT_COMPAT, 'UTF-8') . ' - ' . __('via', 'jigoshop') . ' ' . ucwords($order->payment_method_title) . PHP_EOL . PHP_EOL;

    do_action('jigoshop_after_email_order_info', $order->id);



    echo '<hr>' . PHP_EOL;
    echo __('BILLING ADDRESS', 'jigoshop') . PHP_EOL ;

    echo $order->billing_first_name . ' ' . $order->billing_last_name . PHP_EOL;
    if ($order->billing_company)
        echo $order->billing_company . PHP_EOL;
    echo $order->formatted_billing_address . PHP_EOL . PHP_EOL;

    do_action('jigoshop_after_email_billing_address', $order->id);

    echo '<hr>' . PHP_EOL;
    echo __('Your order will be delivered within 5 working days to:', 'jigoshop') . PHP_EOL;

    echo $order->shipping_first_name . ' ' . $order->shipping_last_name . PHP_EOL;
    if ($order->shipping_company)
        echo $order->shipping_company . PHP_EOL;
    echo $order->formatted_shipping_address . PHP_EOL . PHP_EOL;

    do_action('jigoshop_after_email_shipping_address', $order->id);

echo '<hr>' . PHP_EOL;
echo 'Thanks again for shopping with Germaine De Capuccini' . PHP_EOL;
echo '<hr>' . PHP_EOL;

    $message = ob_get_clean();
    $message = html_entity_decode(strip_tags($message));
    $message = apply_filters('jigoshop_completed_order_customer_notification_mail_message', $message);

    wp_mail($order->billing_email, $subject, $message, "From: " . get_option('jigoshop_email') . "\r\n");
}
?>