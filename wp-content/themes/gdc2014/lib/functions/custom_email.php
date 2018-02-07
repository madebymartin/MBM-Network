<?php 
function mbm_promos($order_id){
    $order = new jigoshop_order($order_id);

    $mbm_order_grand_total = $order->order_total;
    $mbm_order_shipping = $order->order_shipping;
    $mbm_cart_subtotal = $mbm_order_grand_total - $mbm_order_shipping;
    $mbm_freeshipping_threshold = Jigoshop_Base::get_options()->get_option('jigoshop_free_shipping_minimum_amount');
    $mbm_need_to_spend = $mbm_freeshipping_threshold - $mbm_cart_subtotal;
    $mbm_need_to_spend_2dp = number_format($mbm_need_to_spend, 2, '.', '');
    $user_id = get_current_user_id();

    $promo_loop = new WP_Query( array(
    'post_type' => 'promotion',
    'posts_per_page' => '-1',
    'orderby' => 'date',
    'order' => 'DESC'
    ) ); 
    wp_reset_query();

    //  PROMOTIONS
    echo '<hr><br><h2>Promotions:</h2>';
    while ( $promo_loop->have_posts() ) : $promo_loop->the_post();
        $promo_name = get_the_title();
        $promo_id = get_the_id();
        $promo_gift_id = get_post_meta( get_the_id(), '_cmb_promo_gift', true );
        $promo_required_spend = get_post_meta( get_the_id(), '_cmb_promo_required_spend', true );
        $promo_required_spend_remaining = $promo_required_spend - $mbm_cart_subtotal;
        $promo_required_spend_remaining_2dp = number_format($promo_required_spend_remaining, 2, '.', '');
        $promo_required_product_id = get_post_meta( get_the_id(), '_cmb_promo_required_product', true );
        $current_time = (int) current_time( 'timestamp' );
        $current_pretty_time = date_i18n( 'l j F Y',$current_time);
        $promo_start = get_post_meta( get_the_id(), '_cmb_promo_start_date', true );
        $promo_start_pretty = date_i18n( 'l j F Y',$promo_start);
        $promo_end = get_post_meta( get_the_id(), '_cmb_promo_end_date', true );
        $promo_end_pretty = date_i18n( 'l j F Y',$promo_end);
        $_product = new jigoshop_product( $promo_required_product_id );
        $prodprice = $_product->get_price_html();
        $jigoshop_options = Jigoshop_Base::get_options();

        
        if (($promo_end > $current_time) && ($promo_start < $current_time)){
            if($promo_required_spend){ //Spend Promo
                if ($promo_required_spend_remaining > 0){ // NEED TO SPEND
                    echo '<p><img style="margin:0 0.35em 0 0;" width="20" src="' . get_stylesheet_directory_uri() . '/images/alert.png" alt="success">doesnt qualify for free <a href="' . get_the_permalink($promo_gift_id) . '">' . get_the_title($promo_gift_id) . '</a> <br>(short by £' . $promo_required_spend_remaining_2dp . ')</p>';
                }
                else { // CONGRATULATIONS
                    echo '<p><img style="margin:0 0.35em 0 0;" width="20" src="' . get_stylesheet_directory_uri() . '/images/success2.png" alt="success">FREE GIFT: <a href="' . get_the_permalink($promo_gift_id) . '">' . get_the_title($promo_gift_id) . '</a> <br>(for spending over £' . $promo_required_spend . ')</p>';
                }
            }// End of Spend Promo

            else { // Product Promo
                foreach($order->items as $order_item) {
                    if($order_item['id'] == $promo_required_product_id){
                        $qualify = 'yes-' . $promo_id;
                    }
                    else{}
                } // end of foreach

                if($qualify == 'yes-' . $promo_id){ //QUALIFIES
                        echo '<p><img style="margin:0 0.35em 0 0;" width="20" src="' . get_stylesheet_directory_uri() . '/images/success2.png" alt="success">FREE GIFT: <a href="' . get_the_permalink($promo_gift_id) . '">' . get_the_title($promo_gift_id) . '</a><br>(for buying <a href="' . get_the_permalink($promo_gift_id) . '">' . get_the_title($promo_required_product_id) . '</a>)</p>';
                }
                else{ //DOESNT QUALIFY
                    echo '<p><img style="margin:0 0.35em 0 0;" width="20" src="' . get_stylesheet_directory_uri() . '/images/alert.png" alt="success">doesnt qualify for free <a href="' . get_the_permalink($promo_gift_id) . '">' . get_the_title($promo_gift_id) . '</a><br>(did not buy ' . get_the_title($promo_required_product_id) . ')</p>';
                }
            } // end of Product Promo
        }
    endwhile;
}




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
    $subject = sprintf(__('%s Website Order #%s', 'jigoshop'), '', $order->id);
    ob_start();
    //echo __("You have received an order from ", 'jigoshop') . $order->billing_first_name . ' ' . $order->billing_last_name . __(". Their order is as follows:", 'jigoshop') . PHP_EOL . PHP_EOL;
    //add_header_info($order);
    
    $mbm_order_grand_total = $order->order_total;
    $mbm_order_shipping = $order->order_shipping;
    $mbm_cart_subtotal = $mbm_order_grand_total - $mbm_order_shipping;
    $mbm_freeshipping_threshold = Jigoshop_Base::get_options()->get_option('jigoshop_free_shipping_minimum_amount');
    $mbm_need_to_spend = $mbm_freeshipping_threshold - $mbm_cart_subtotal;
    $mbm_need_to_spend_2dp = number_format($mbm_need_to_spend, 2, '.', '');
    $user_id = get_current_user_id();

    $order_custom_billing_data  = get_post_meta($order_id, '_custom_billing_fields');
        if($order_custom_billing_data && is_array($order_custom_billing_data)):
            foreach($order_custom_billing_data as $key=>$field){
                if($field && is_array($field)):
                    foreach( $field as $array_key=>$data){
                    //    echo $data['label'] . "\t\t\t\t" . $data['value'] . PHP_EOL;
                        if($data['label'] == 'Title'){ $mbm_title = $data['value'];}
                    }
                endif;
                }
        endif;
    
    $promo_loop = new WP_Query( array(
    'post_type' => 'promotion',
    'posts_per_page' => '-1',
    'orderby' => 'date',
    'order' => 'DESC'
    ) ); 
    wp_reset_query();

    $previous_orders = new WP_Query( array( 
        'post_type' => 'shop_order', 
        'posts_per_page' => -1,
        'post_status'     => 'publish',
        'meta_query' => array(
            'relation' => 'AND',
                array(
                    'key' => 'customer_user',
                    'value' => $user_id,
                    'compare' => '='
                ),
                array(
                    'key' => '_js_completed_date',
                //    'value' => '0',
                    'compare' => 'EXISTS'
                )
            )
    ) );
    $order_count = $previous_orders->post_count;
    $this_is_order_nth = $order_count + 1;
    wp_reset_query();

//  CUTOMER DETAILS AND PREVIOUS ORDER COUNT
    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
    if (($this_is_order_nth %100) >= 11 && ($this_is_order_nth%100) <= 13)
       $abbreviation = $this_is_order_nth. 'th';
    else
       $abbreviation = $this_is_order_nth. $ends[$this_is_order_nth % 10];


    if($user_id == '0'){
        $order_count_message = '<h2>This is a guest order from ' . $mbm_title . ' ' . $order->billing_first_name . ' ' . $order->billing_last_name . '</h2>';
    }
    else{
        $order_count_message = '<h2>This is our ' . $abbreviation .' order from ' . $mbm_title . ' ' . $order->billing_first_name . ' ' . $order->billing_last_name . '</h2>';
    }


    echo $order_count_message;


//  ORDER DETAILS
    echo '<hr><br><h2>Products Ordered</h2>';
    $mbm_coupons_array = $order->order_discount_coupons;
    foreach($mbm_coupons_array as $mbm_coupon) {
        $mbm_coupon_code = $mbm_coupon[code];
        $mbm_code_prefix = mb_substr($mbm_coupon_code, 0, 2);
        //echo $mbm_code_prefix;
        if($mbm_code_prefix == 'se'){
            echo '<p style="background-color:#330066; color:#fff; font-size:18px; padding:20px; text-align:center;">Skincare Expert coupon used: <b>' . $mbm_coupon_code . '</b></p><br>';
        }
        else{
            echo 'Coupon used: <b>' . $mbm_coupon_code . '</b><br>';
        }
    }

    add_order_totals($order, false, true);


    // SHOW PROMOTIONS IF NOT USING TRADE DISCOUNT
    if ( is_plugin_active( 'jigoshop-customer-discounts/jigoshop-customer-discounts.php' ) ) {

        // grab looop of customer discounts
        $customer_discounts_loop = new WP_Query( array(
        'post_type' => 'customer_discount',
        'posts_per_page' => '-1',
        'orderby' => 'date',
        'order' => 'DESC'
        ) ); 
        wp_reset_query();

        while ( $customer_discounts_loop->have_posts() ) : $customer_discounts_loop->the_post();
            $roles = get_post_meta( get_the_id(), 'groups', true ); // array of roles set for this discount (customer discount plugin)
            $in_role = check_user_role($roles);
            $current_user = wp_get_current_user(); 

            // Define roles to check
            if ($in_role) {
            //  CUSTOMER DISCOUNT EXISTS FOR CURRENT USER - no promotions!
                echo '<hr><p style="background-color:#330066; color:#fff; font-size:18px; padding:20px; text-align:center;">This is a trade order with 40% Discount</p>';
                echo '<h3>User Details:</h3>';
                echo 'Username: ' . $current_user->user_login .'<br>';
                echo 'Name: ' . $current_user->user_firstname . ' ' . $current_user->user_lastname .'<br>';
                echo 'Account Number: ' . get_user_meta($user_id, 'accountnumber', true) .'<br>';
                echo 'Salon: ' . get_user_meta($user_id, 'accountname', true) .'<br>';
                echo 'Salon Phone: ' . get_user_meta($user_id, 'accountphone', true) .'<br>';
                echo 'Job Role: ' . get_user_meta($user_id, 'jobrole', true) .'<br>';
            } else {
            mbm_promos($order_id); 
            }

        endwhile ;      
    } else{
        //  PROMOTIONS
        mbm_promos($order_id); 
    }

/*
//  gdc_billing_address_details($order);
    echo '<br><hr><h2>Billing Address</h2>' . PHP_EOL;
    echo $order->billing_first_name . ' ' . $order->billing_last_name . PHP_EOL;
    if ($order->billing_company)
    echo $order->billing_company . PHP_EOL;
    echo str_replace(", ","<br>",$order->formatted_billing_address) . PHP_EOL;
    do_action('jigoshop_after_email_billing_address', $order->id);
*/

//  SHIPPING DETAILS
    echo '<br><hr><br><h2>Delivery Address</h2>';
    if ( $order->shipping_method != 'local_pickup' ) {

        echo $order->shipping_first_name . ' ' . $order->shipping_last_name . PHP_EOL;
        if ($order->shipping_company) echo $order->shipping_company . PHP_EOL;
        echo str_replace(", ","<br>",$order->formatted_shipping_address) . PHP_EOL;

        if(!empty($order->shipping_service))
            echo __('Shipping: ','jigoshop') . html_entity_decode(ucwords($order->shipping_service), ENT_QUOTES, 'UTF-8') . PHP_EOL . PHP_EOL;

        do_action('jigoshop_after_email_shipping_address', $order->id);

    } else {
        //IRRELEVANT AS WE DONT OFFER LOCAL PICKUP
        echo __('To be picked up by:', 'jigoshop') . PHP_EOL;
        echo $order->shipping_first_name . ' ' . $order->shipping_last_name . PHP_EOL;
        if ($order->shipping_company) echo $order->shipping_company . PHP_EOL;
        echo PHP_EOL;
        echo __('At location:', 'jigoshop') . PHP_EOL;
        echo add_company_information() . PHP_EOL . PHP_EOL;
    }

//  add_customer_details($order);
    echo '<br><hr><br><h2>Contact Details</h2>';
    echo 'Name: ' . $mbm_title . ' ' . $order->billing_first_name . ' ' . $order->billing_last_name .'<br>';
    echo 'Email: ' . $order->billing_email . '<br>';
    echo 'Phone: ' . $order->billing_phone . '<br>';
//  print_r($order);

    $message = ob_get_clean();
    $message = apply_filters('jigoshop_change_new_order_email_contents', $message, $order);
//    $message = html_entity_decode(strip_tags($message));
    $message = $message;
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
    $order = new jigoshop_order( $order_id );
    $subject = 'Thank you for your order #' . $order->id;
    ob_start();
    echo 'Hi ';
    echo $order->billing_first_name . ' ' . $order->billing_last_name . PHP_EOL;
    echo __("Thank you for your order, we are proccessing it now.",'jigoshop') . PHP_EOL . PHP_EOL;
	echo __("Unless otherwise specified, your order will be despatched within the next 1-2 working days and should arrive to you within 5 working days.",'jigoshop') . PHP_EOL;
    echo '<hr>' . PHP_EOL;
    echo __('Your order reference number is: ','jigoshop') . '<b>' . $order->id . '</b>' . PHP_EOL;
    echo '<hr>' . PHP_EOL . PHP_EOL;
	echo 'Order details:' . PHP_EOL . PHP_EOL;
    echo $order->email_order_items_list(false, true); // no download links, show SKU
    
    $mbm_order_grand_total = $order->order_total;
    $mbm_order_shipping = $order->order_shipping;
    $mbm_cart_subtotal = $mbm_order_grand_total - $mbm_order_shipping;
    $mbm_freeshipping_threshold = Jigoshop_Base::get_options()->get_option('jigoshop_free_shipping_minimum_amount');
    $mbm_need_to_spend = $mbm_freeshipping_threshold - $mbm_cart_subtotal;
    $mbm_need_to_spend_2dp = number_format($mbm_need_to_spend, 2, '.', '');

            $promo_loop = new WP_Query( array(
            'post_type' => 'promotion',
            'posts_per_page' => '-1',
            'orderby' => 'date',
            'order' => 'DESC'
            ) ); 
            wp_reset_query();
            
                while ( $promo_loop->have_posts() ) : $promo_loop->the_post();
                    $promo_name = get_the_title();
                    $promo_id = get_the_id();
                    $promo_gift_id = get_post_meta( get_the_id(), '_cmb_promo_gift', true );
                    $promo_required_spend = get_post_meta( get_the_id(), '_cmb_promo_required_spend', true );
                    $promo_required_spend_remaining = $promo_required_spend - $mbm_cart_subtotal;
                    $promo_required_spend_remaining_2dp = number_format($promo_required_spend_remaining, 2, '.', '');
                    $promo_required_product_id = get_post_meta( get_the_id(), '_cmb_promo_required_product', true );
                    $current_time = (int) current_time( 'timestamp' );
                    $current_pretty_time = date_i18n( 'l j F Y',$current_time);
                    $promo_start = get_post_meta( get_the_id(), '_cmb_promo_start_date', true );
                    $promo_start_pretty = date_i18n( 'l j F Y',$promo_start);
                    $promo_end = get_post_meta( get_the_id(), '_cmb_promo_end_date', true );
                    $promo_end_pretty = date_i18n( 'l j F Y',$promo_end);
                    $_product = new jigoshop_product( $promo_required_product_id );
                    $prodprice = $_product->get_price_html();
                    $jigoshop_options = Jigoshop_Base::get_options();



                    // SHOW PROMOTIONS IF NOT USING TRADE DISCOUNT
                    if ( is_plugin_active( 'jigoshop-customer-discounts/jigoshop-customer-discounts.php' ) ) {

                        // grab looop of customer discounts
                        $customer_discounts_loop = new WP_Query( array(
                        'post_type' => 'customer_discount',
                        'posts_per_page' => '-1',
                        'orderby' => 'date',
                        'order' => 'DESC'
                        ) ); 
                        wp_reset_query();

                        while ( $customer_discounts_loop->have_posts() ) : $customer_discounts_loop->the_post();
                            $roles = get_post_meta( get_the_id(), 'groups', true ); // array of roles set for this discount (customer discount plugin)
                            $in_role = check_user_role($roles); 

                            // Define roles to check
                            if ($in_role) {
                            //  CUSTOMER DISCOUNT EXISTS FOR CURRENT USER - no promotions!
                            } else {
                            if (($promo_end > $current_time) && ($promo_start < $current_time)){
                        if($promo_required_spend){ //Spend Promo
                            if ($promo_required_spend_remaining > 0){ // NEED TO SPEND
                            }
                            else { // CONGRATULATIONS
                                echo '<p>FREE GIFT: ' . get_the_title($promo_gift_id) . ' (for spending over £' . $promo_required_spend . ')</p>';
                            }
                        }// End of Spend Promo

                        else { // Product Promo
                            foreach($order->items as $order_item) {
                                if($order_item['id'] == $promo_required_product_id){
                                    $qualify = 'yes-' . $promo_id;
                                }
                                else{}
                            } // end of foreach

                            if($qualify == 'yes-' . $promo_id){ //QUALIFIES
                                    echo '<p>FREE GIFT: ' . get_the_title($promo_gift_id) . ' (for buying ' . get_the_title($promo_required_product_id) . ')</p>';
                            }
                            else{ //DOESNT QUALIFY
                            }
                        } // end of Product Promo
                    } 
                            }

                        endwhile ;      
                    } else{
                        //  PROMOTIONS
                        if (($promo_end > $current_time) && ($promo_start < $current_time)){
                        if($promo_required_spend){ //Spend Promo
                            if ($promo_required_spend_remaining > 0){ // NEED TO SPEND
                            }
                            else { // CONGRATULATIONS
                                echo '<p>FREE GIFT: ' . get_the_title($promo_gift_id) . ' (for spending over £' . $promo_required_spend . ')</p>';
                            }
                        }// End of Spend Promo

                        else { // Product Promo
                            foreach($order->items as $order_item) {
                                if($order_item['id'] == $promo_required_product_id){
                                    $qualify = 'yes-' . $promo_id;
                                }
                                else{}
                            } // end of foreach

                            if($qualify == 'yes-' . $promo_id){ //QUALIFIES
                                    echo '<p>FREE GIFT: ' . get_the_title($promo_gift_id) . ' (for buying ' . get_the_title($promo_required_product_id) . ')</p>';
                            }
                            else{ //DOESNT QUALIFY
                            }
                        } // end of Product Promo
                    } 
                    }



                    
                    
                endwhile; 
    echo '<hr>' . PHP_EOL;




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
    $message = $message;

    wp_mail( $order->billing_email, $subject, $message );
}

/**
 * Order Status 'Complete' Confirmation Email
 * */
remove_action('order_status_completed', 'jigoshop_completed_order_customer_notification');
add_action('order_status_completed', 'jigoshop_completed_order_customer_notification_gdc');



function jigoshop_completed_order_customer_notification_gdc($order_id) {

    $order = new jigoshop_order($order_id);
    $subject = 'Your order #' . $order->id . ' is on its way to you';
    ob_start();
	echo 'Hi ';
	echo $order->billing_first_name . ' ' . $order->billing_last_name . PHP_EOL;
    echo __("Your order is complete and on it's way to you. You should receive delivery within 3 working days", 'jigoshop') . PHP_EOL . PHP_EOL;
    echo '<hr>' . PHP_EOL;
    echo __('Your order reference number is: ','jigoshop') . $order->id . '' . PHP_EOL;
    echo '<hr>' . PHP_EOL . PHP_EOL;
	echo 'Order details are below:' . PHP_EOL . PHP_EOL;
    echo $order->email_order_items_list(true, true); // show download links and SKU

    $mbm_order_grand_total = $order->order_total;
    $mbm_order_shipping = $order->order_shipping;
    $mbm_cart_subtotal = $mbm_order_grand_total - $mbm_order_shipping;
    $mbm_freeshipping_threshold = Jigoshop_Base::get_options()->get_option('jigoshop_free_shipping_minimum_amount');
    $mbm_need_to_spend = $mbm_freeshipping_threshold - $mbm_cart_subtotal;
    $mbm_need_to_spend_2dp = number_format($mbm_need_to_spend, 2, '.', '');

            $promo_loop = new WP_Query( array(
            'post_type' => 'promotion',
            'posts_per_page' => '-1',
            'orderby' => 'date',
            'order' => 'DESC'
            ) ); 
            wp_reset_query();
            
                while ( $promo_loop->have_posts() ) : $promo_loop->the_post();
                    $promo_name = get_the_title();
                    $promo_id = get_the_id();
                    $promo_gift_id = get_post_meta( get_the_id(), '_cmb_promo_gift', true );
                    $promo_required_spend = get_post_meta( get_the_id(), '_cmb_promo_required_spend', true );
                    $promo_required_spend_remaining = $promo_required_spend - $mbm_cart_subtotal;
                    $promo_required_spend_remaining_2dp = number_format($promo_required_spend_remaining, 2, '.', '');
                    $promo_required_product_id = get_post_meta( get_the_id(), '_cmb_promo_required_product', true );
                    $current_time = (int) current_time( 'timestamp' );
                    $current_pretty_time = date_i18n( 'l j F Y',$current_time);
                    $promo_start = get_post_meta( get_the_id(), '_cmb_promo_start_date', true );
                    $promo_start_pretty = date_i18n( 'l j F Y',$promo_start);
                    $promo_end = get_post_meta( get_the_id(), '_cmb_promo_end_date', true );
                    $promo_end_pretty = date_i18n( 'l j F Y',$promo_end);
                    $_product = new jigoshop_product( $promo_required_product_id );
                    $prodprice = $_product->get_price_html();
                    $jigoshop_options = Jigoshop_Base::get_options();
                    
                    if (($promo_end > $current_time) && ($promo_start < $current_time)){
                        if($promo_required_spend){ //Spend Promo
                            if ($promo_required_spend_remaining > 0){ // NEED TO SPEND
                            }
                            else { // CONGRATULATIONS
                                echo '<p>FREE GIFT: ' . get_the_title($promo_gift_id) . ' (for spending over £' . $promo_required_spend . ')</p>';
                            }
                        }// End of Spend Promo

                        else { // Product Promo
                            foreach($order->items as $order_item) {
                                if($order_item['id'] == $promo_required_product_id){
                                    $qualify = 'yes-' . $promo_id;
                                }
                                else{}
                            } // end of foreach

                            if($qualify == 'yes-' . $promo_id){ //QUALIFIES
                                    echo '<p>FREE GIFT: ' . get_the_title($promo_gift_id) . ' (for buying ' . get_the_title($promo_required_product_id) . ')</p>';
                            }
                            else{ //DOESNT QUALIFY
                            }
                        } // end of Product Promo
                    }
                endwhile; 
    echo '<hr>' . PHP_EOL;






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
echo 'Thanks again for shopping with Germaine de Capuccini' . PHP_EOL;
echo '<hr>' . PHP_EOL;

    $message = ob_get_clean();
    $message = $message;
    $message = apply_filters('jigoshop_completed_order_customer_notification_mail_message', $message);

    wp_mail($order->billing_email, $subject, $message, "From: " . get_option('jigoshop_email') . "\r\n");
}






function gdc_billing_address_details($order) {

    echo '<h3>Billing Address</h3>' . PHP_EOL;
    echo $order->billing_first_name . ' ' . $order->billing_last_name . PHP_EOL;
    if ($order->billing_company)
    echo $order->billing_company . PHP_EOL;
    echo $order->formatted_billing_address . PHP_EOL . PHP_EOL;

    do_action('jigoshop_after_email_billing_address', $order->id);

}


function gdc_shipping_address_details($order) {

    echo '<h3>Shipping Address</h3>' . PHP_EOL;
    if ( $order->shipping_method != 'local_pickup' ) {

        echo $order->shipping_first_name . ' ' . $order->shipping_last_name . PHP_EOL;
        if ($order->shipping_company) echo $order->shipping_company . PHP_EOL;
        echo $order->formatted_shipping_address . PHP_EOL . PHP_EOL;

        if(!empty($order->shipping_service))
            echo __('Shipping: ','jigoshop') . html_entity_decode(ucwords($order->shipping_service), ENT_QUOTES, 'UTF-8') . PHP_EOL . PHP_EOL;

        do_action('jigoshop_after_email_shipping_address', $order->id);

    } else {

        echo __('To be picked up by:', 'jigoshop') . PHP_EOL;
        echo $order->shipping_first_name . ' ' . $order->shipping_last_name . PHP_EOL;
        if ($order->shipping_company) echo $order->shipping_company . PHP_EOL;
        echo PHP_EOL;
        echo __('At location:', 'jigoshop') . PHP_EOL;
        echo add_company_information() . PHP_EOL . PHP_EOL;

    }

}
?>