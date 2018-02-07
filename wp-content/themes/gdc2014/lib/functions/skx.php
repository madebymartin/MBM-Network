<?php

function computeAge($starttime,$endtime){
    $age = date("Y",$endtime) - date("Y",$starttime);
    //if birthday didn't occur that last year, then decrement
    if(date("z",$endtime) < date("z",$starttime)) $age--;
    return $age;
}

add_action("gform_user_registered", "autologin", 10, 4);
function autologin($user_id, $config, $entry, $password) {
    wp_set_auth_cookie($user_id, false, '');
}



function get_product_by_sku( $sku ) {
  global $wpdb;
  $product_id = $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_sku' AND meta_value='%s' LIMIT 1", $sku ) );
  if ( $product_id ) return new WC_Product( $product_id );
  return null;
}


function order_contains_skx($order_id){
    $order = new WC_order($order_id);
    $items = $order->get_items();
    $skx_sample_set_product = get_product_by_sku( 'SKX' );
    $sample_set_id = $skx_sample_set_product->id;
    $return = false;
    foreach ( $items as $item ) {
        $product_id = $item['product_id'];
        if ( $product_id == $sample_set_id ){ $return = true; }
    }
    return $return;
}



add_action( 'woocommerce_checkout_update_order_meta', 'skx_order_meta', 10, 2 );
function skx_order_meta( $order_id, $posted ) {
    if(is_user_logged_in()){
        $order = new WC_Order( $order_id );
        $user_id = $order->user_id;
        $items = $order->get_items(); 
        $skx_sample_set_product = get_product_by_sku( 'SKX' );
        $sample_set_id = $skx_sample_set_product->id;

        foreach ( $items as $item ) {
            $product_id = $item['product_id'];
            if ( $product_id == $sample_set_id ) {
                $user_id = $order->user_id;
                $skx_results = get_skx_product_results($user_id);
                $skx_product_ids = $skx_results['all_ids'];
                $skx_meta_value = '<ul>';
                foreach ($skx_product_ids as $id) {
                    $skx_meta_value .= '<li>'. get_the_title($id) .'</li>';
                }
                $skx_meta_value .= '</ul>';
            }
        }
        update_post_meta( $order_id, 'skx_recommendations', $skx_meta_value );
    }
}



function get_skx_product_results($user_id){
    if(empty($user_id)){$user_id = get_current_user_id();} else{$user_id = $user_id;}
    $user_meta = get_user_meta($user_id);
    $page_url = rtrim(get_permalink(),'/');
    $user_firstname = get_user_meta($user_id, 'first_name', true);
    $user_sex = get_user_meta($user_id, 'skx_sex', true);
    $user_dob = get_user_meta($user_id, 'skx_dob', true);
    $user_dob_timestamp = strtotime($user_dob);
    $currenttimestamp = current_time( 'timestamp');
    $today = strtotime('today', $currenttimestamp);
    $user_age_sec = $today - $user_dob_timestamp;
    $user_age = computeAge($user_dob_timestamp,$today);

    if( 16 <= $user_age && 24 >= $user_age){$user_age = '16-24';}
    elseif( 25 <= $user_age && 34 >= $user_age){$user_age = '25-34';}
    elseif( 35 <= $user_age && 54 >= $user_age){$user_age = '35-54';}
    elseif( 55 <= $user_age ){$user_age = '55+';}
    
    $user_sensitivity = get_user_meta($user_id, 'skx_sensitivity', true);
    $user_concern1 = get_user_meta($user_id, 'skx_skin_concern1', true);
    $user_skintype = get_user_meta($user_id, 'skx_skintype', true);

    // COMPILE $_GDC_COMBINATION VARIABLE - USED TO MATCH TAXONOMY TERMS IN THE TAX_QUERY OF THE WP QUERY IN PRODUCTS_LOOP.PHP
    $_gdc_combination = $user_concern1 . '-' . $user_age . '-' .$user_sensitivity. '';

    // DEFINE PRODUCT LOOP VARIABLE
    if ($user_sex === 'male'){
    // MALE
    $_gdc_taxonomy = $user_sex . '_' . $user_skintype;
        }

    else {
    // FEMALE
    $_gdc_taxonomy = $user_skintype;
        }

    $loops = array(
        'Cleanser'=>'cleanser', 
        'Toner' => 'toner', 
        'Daily Treatment' => 'daily-treatment-cream', 
        'Eye Treatment' => 'eye-treatment'
    );

    $recommendations = array();
    $all_rec_products = array();

    foreach ($loops as $type => $term) {
        $loop = new wp_query( array(
            'post_type' => 'product',
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => $_gdc_taxonomy,
                    'field' => 'slug',
                    'terms' => $_gdc_combination
                ),
                array(
                    'taxonomy' => 'recommendation_type',
                    'field' => 'slug',
                    'terms' => $term
                ),
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => 'samples',
                    'operator' => 'NOT IN'
                ),
            ),
            'orderby' => 'title',
            'posts_per_page' => '-1',
            'order' => 'ASC'
        ) );
        
        $recommendations[$type] = array();
        while( $loop->have_posts() ) : $loop->the_post();
            $product_id = get_the_ID();
            $recommendations[$type][] = $product_id;
            $all_rec_products[] = $product_id;
        endwhile;
        wp_reset_query();
    }

    return array(
        'all_ids' => $all_rec_products,
        'recommendations' => $recommendations
        );

}



add_filter('gform_notification_46', 'skx_user_notification', 10, 3);
add_filter('gform_notification_47', 'skx_user_notification', 10, 3);
function skx_user_notification( $notification, $form, $entry ) {
    if($notification["name"] == "Your Personal Recommendation"){
        $message_content = '';

        if(is_user_logged_in()){
            $user = wp_get_current_user();
            $user_email = $user->user_email;
            $user_id = $user->ID;
        }
        else{
            $user_email = $entry["37"];
            $user = get_user_by( 'email', $user_email  );
            $user_id = $user->ID;
        }
        
        $user_fname = $user->user_firstname;
        $skx_results = get_skx_product_results($user_id);
        $recommendations = $skx_results['recommendations'];
        $skx_product_ids = $skx_results['all_ids'];

        $message_content .= '<p>Hi '. $user_fname .', thank you for using our Skincare Expert service.</p><p>Based on the information you gave us, the following products should all be ideal for your skin. If you have any questions at all, please do not hesitate to call on <b>0845 094 9460</b> (local rate).</p><br>';

        foreach ($recommendations as $type => $id) {
            foreach ($id as $key => $value) {
                $product_id = $value;
                $product = new WC_Product( $product_id );
                $price = $product->price;
                $product_meta = get_post_meta($product_id);
                $prod_url = get_permalink($product_id);
                $prodprice = number_format($price, 2, '.', '');
                $prod_img_url = get_the_post_thumbnail_url( $product_id, $size = 'large' );

                if ( get_post_meta($product_id, "_cmb_instructions", true) ) { $instructions = '<p>' . get_post_meta($product_id, "_cmb_instructions", true) . '</p>'; } 
                else { $instructions = term_description( '155', 'recommendation_type' ); }

                $message_content .= '<hr style="color:#ccc;"><br><h2 style="font-style:normal;font-size:17px;text-align:left; font-weight:normal">'. $type .':<span style="font-size:12px;"><br>'. get_the_title($product_id) .'</span></h2>';
                $message_content .= '<a href="'. $prod_url .'"><div style="background: #fff;display: block;position: relative;top: 0;clear: both;height: 200px;width: 200px;text-align: center;"><img width="200" style="display: inline-block;height: 100%; width:auto;" src="'. $prod_img_url .'"></div></a>';
                $message_content .= '<div class="instructions">'. $instructions . '</div><br><br>';

            }
        }
        $notification['to'] = $user_email;
        $notification['message'] = $message_content;
        return $notification;
    }
}



// USE woocommerce_payment_complete when on live server
add_action('woocommerce_payment_complete', 'skx_create_coupons', 10, 1);
//add_action('woocommerce_order_status_processing', 'skx_create_coupons', 10, 1);
//add_action('woocommerce_order_status_on-hold', 'skx_create_coupons', 10, 1);
function skx_create_coupons($order_id){
    if(is_user_logged_in()){
        $order = new WC_order($order_id);
        if(order_contains_skx($order_id)){
            $shipping = new WC_Shipping_Flat_Rate();
            $flat_rate_fee = $shipping->cost;
            $flat_rate_fee = $flat_rate_fee + ($flat_rate_fee * 0.2);
            $order_shipping_total = $order->get_total_shipping();
            $order_shipping_tax = $order->get_shipping_tax();
            $order_shipping_total = $order_shipping_total + $order_shipping_tax;
            $user_id = $order->user_id;
            $user_info = get_userdata($user_id);
            $items = $order->get_items();
            $skx_sample_set_product = get_product_by_sku( 'SKX' );
            $sample_set_id = $skx_sample_set_product->id;
            $sample_set_product = new WC_Product( $sample_set_id );
            $sample_set_price = $sample_set_product->get_price();
            $customer_orders = get_posts( array(
                'numberposts' => -1,
                'meta_key'    => '_customer_user',
                'meta_value'  => $user_id,
                'post_type'   => wc_get_order_types(),
                'post_status' => array_keys( wc_get_order_statuses() ),
                'order'       => 'ASC'
            ) );
            $previous_orders_with_skx_samples = 0;
            foreach($customer_orders as $customer_order){
                $this_order_id = $customer_order->ID;
                $this_order = new WC_Order($this_order_id);
                $this_order_items = $this_order->get_items();

                foreach ($this_order_items as $item) {
                    $item_id = $item['product_id'];
                    if($item_id == $sample_set_id){ 
                        $previous_orders_with_skx_samples++; 
                    }
                }
            }

        /*    $example_coupon = get_post_meta('72502');
            foreach ($example_coupon as $key => $value) {
                echo $key . ': ';
                print_r($value);
                echo '<br>';
            }*/

            if($previous_orders_with_skx_samples == 1  &&  $order_shipping_total > 0){
                // This is the first and only order for SKX samples AND shipping was paid...

                // Create store credit for user's next order (for the value they paid)
                $skx_coupon_refund = array(
                    'post_title'        => 'skx' . substr(md5(rand()), 0, 7),
                    'post_content'      => 'SKX samples store credit coupon',
                    'post_excerpt'      => 'Skincare Expert postage credit: ' . $user_info->display_name,
                    'post_status'       => 'publish',
                    'post_author'       => 1,
                    'post_type'         => 'shop_coupon',
                    'comment_status'    => 'closed'
                );
                $skx_coupon_refund_id = wp_insert_post( $skx_coupon_refund );
                add_post_meta($skx_coupon_refund_id, 'discount_type', 'smart_coupon', true);
                //add_post_meta($skx_coupon_refund_id, 'discount_type', 'fixed_cart', true);
                add_post_meta($skx_coupon_refund_id, 'coupon_amount', $flat_rate_fee, true);
                add_post_meta($skx_coupon_refund_id, 'free_gift_shipping', 'no', true);
                add_post_meta($skx_coupon_refund_id, 'individual_use', 'no', true);
                add_post_meta($skx_coupon_refund_id, 'exclude_product_ids', $sample_set_id, false);
                add_post_meta($skx_coupon_refund_id, 'free_shipping', 'no', true);
                add_post_meta($skx_coupon_refund_id, 'exclude_product_categories', '314', false);
                add_post_meta($skx_coupon_refund_id, 'customer_email', $user_info->user_email, true);
                add_post_meta($skx_coupon_20percent_id, 'auto_generate_coupon', 'no', true);
                add_post_meta($skx_coupon_20percent_id, 'sc_coupon_validity', '20', true);
                add_post_meta($skx_coupon_20percent_id, 'validity_suffix', 'days', true);
                add_post_meta($skx_coupon_20percent_id, 'usage_limit', '1', true);
                //add_post_meta($skx_coupon_20percent_id, 'sc_is_visible_storewide', 'yes', true);


                // Create store credit for user's next order (for the value they paid)
                $skx_coupon_20percent = array(
                    'post_title'        => 'skx' . substr(md5(rand()), 0, 7),
                    'post_content'      => 'SKX samples 20% discount',
                    'post_excerpt'      => 'Skincare Expert 20% discount: ' . $user_info->display_name,
                    'post_status'       => 'publish',
                    'post_author'       => 1,
                    'post_type'         => 'shop_coupon',
                    'comment_status'    => 'closed'
                );
                $skx_coupon_20percent_id = wp_insert_post( $skx_coupon_20percent );
                add_post_meta($skx_coupon_20percent_id, 'discount_type', 'percent_product', true);
                add_post_meta($skx_coupon_20percent_id, 'coupon_amount', '20', true);
                add_post_meta($skx_coupon_20percent_id, 'free_gift_shipping', 'no', true);
                add_post_meta($skx_coupon_20percent_id, 'individual_use', 'no', true);
                add_post_meta($skx_coupon_20percent_id, 'exclude_product_ids', $sample_set_id, false);
                add_post_meta($skx_coupon_20percent_id, 'free_shipping', 'no', true);
                add_post_meta($skx_coupon_20percent_id, 'exclude_product_categories', '314', false);
                add_post_meta($skx_coupon_20percent_id, 'customer_email', $user_info->user_email, true);
                add_post_meta($skx_coupon_20percent_id, 'auto_generate_coupon', 'no', true);
                add_post_meta($skx_coupon_20percent_id, 'sc_coupon_validity', '40', true);
                add_post_meta($skx_coupon_20percent_id, 'validity_suffix', 'days', true);
                //add_post_meta($skx_coupon_20percent_id, 'sc_is_visible_storewide', 'yes', true);
                add_post_meta($skx_coupon_20percent_id, 'minimum_amount', '25', true);
                add_post_meta($skx_coupon_20percent_id, 'usage_limit', '1', true);
            }
        } // End if order contains SKX product
    }
}









add_filter( 'woocommerce_email_attachments', 'attach_skx_pdf_to_email', 10, 3); 
function attach_skx_pdf_to_email ( $attachments, $status , $order ) {

    $order_id = $order->get_order_number();

    if( order_contains_skx($order_id) ){

        $allowed_statuses = array( 'new_order', 'processing' );
        $currentsite = $_SERVER["DOCUMENT_ROOT"];

        if( isset( $status ) && in_array ( $status, $allowed_statuses ) ) {
             $your_pdf_path = $currentsite . '/files/skx/skx-' . $order_id . '.pdf'; 
             $attachments[] = $your_pdf_path; 
        }

    }

    return $attachments;
}