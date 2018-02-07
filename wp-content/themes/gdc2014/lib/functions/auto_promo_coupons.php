<?php



// hide coupon field on cart & checkout page for trade users (as they get their 40% discount from 'dynamic pricing' plugin)
// nb. should add conditional statement, checking if 'dynamic pricing' plugin is activated first..
function hide_coupon_field_on_cart( $enabled ) {
    global $woocommerce;
    $currentuser = wp_get_current_user();
    if(in_array( 'trade_user', (array) $currentuser->roles )){ // TRADE CUSTOMER - REMOVE COUPONS FEATURE ON CART PAGE! 
        //if ( is_cart() || is_checkout() ) {
        $enabled = false;
        //}
    }else{ // NOT TRADE CUSTOMER - ENABLE COUPONS
        //if ( is_cart() || is_checkout() ) {
        $enabled = true;   
        //}
    } 
    return $enabled;
}
add_filter( 'woocommerce_coupons_enabled', 'hide_coupon_field_on_cart' );




// ADD COUPON AUTOMATICALLY IF CART TOTAL IS OVER SPECIFIED MINIMUM, NO OTHER COUPON IS APPLIED ALREADY AND USER HAS NOT MANUALLY REMOVED THIS AUTO-COUPON
add_action( 'woocommerce_before_cart', 'apply_matched_coupons' );
add_action( 'woocommerce_before_checkout_form', 'apply_matched_coupons' );

function apply_matched_coupons() {
    
    $currentuser = wp_get_current_user();
    
        //NOT A TRADE USER
        global $woocommerce;
        $cart_url = $woocommerce->cart->get_cart_url();

        //GET PARAMETER FOR REMOVED COUPON IF IT EXISTS
        if(isset($_GET["remove_coupon"])){
            $removed_coupon = $_GET["remove_coupon"];
        }

        // LOOP ALL COUPONS
        $all_coupons = new WP_Query( array(
            'post_type' => 'shop_coupon',
            'posts_per_page' => '-1',
            'status' => 'publish',
            'orderby' => 'title',
            'order' => 'ASC',
        ));

        // GET LATEST 'PUBLIC PROMO' COUPON
        date_default_timezone_set('Europe/London');
        $current_date = date("Y-m-d");

        // GET LATEST 'PUBLIC PROMO' COUPON AND DISPLAY THE BANNER IF IT EXISTS
        $coupon_promos = new WP_Query( array(
            'post_type' => 'shop_coupon',
            'posts_per_page' => '1',
            'orderby' => 'date',
            'order' => 'DESC',
            'meta_query' => array(
                'relation' => 'AND',
                array(
                'key'     => 'public_promo',
                'value'   => '1',
                'compare' => 'IN',
                ),
                array(
                'key' => 'expiry_date',
                'value' => $current_date,
                'compare' => '>'
                ),
            ),
        ) );



        if(in_array( 'trade_user', (array) $currentuser->roles )){ // TRADE USER
            if ( ! empty( $woocommerce->cart->applied_coupons ) ) {
                $woocommerce->cart->remove_coupons();
                
                wp_redirect( $cart_url );
                $woocommerce->add_message('Your coupon was removed as you are logged in as a trade customer.');
                exit;

            } else{
                //    echo '<div class="woocommerce-message"><div class="left">Trade customers are not allowed coupons, sorry!</div></div>';
            }


        }else{ // NOT TRADE USER

            if ( $coupon_promos->have_posts() ) {
                while ( $coupon_promos->have_posts() ) : $coupon_promos->the_post();

                    // DEFINE THIS COUPON CODE
                    $auto_coupon_code = get_the_title();

                    if( $removed_coupon == $auto_coupon_code ){
                        // AUTO-COUPON WAS MANUALLY REMOVED - DO NOTHING FOR THIS COUPON CODE

                    }else{ // COUPON NOT MANUALLY REMOVED - CARRY ON

                        // DEFINE THIS COUPONs META FIELDS
                        $all_meta = get_post_meta( get_the_id() );
                        $coupon_type = $all_meta[discount_type][0];
                        $coupon_amount = $all_meta[coupon_amount][0];
                        $coupon_free_gifts = $all_meta[gift_ids][0];
                        $free_gifts_arr = explode(',', $coupon_free_gifts);
                        $free_gifts = new WP_Query(
                        array(
                            'post_type' => 'product',
                            'posts_per_page' => -1,
                            'post__in' => $free_gifts_arr
                            )
                        );
                        $all_free_gifts = array();
                        while ( $free_gifts->have_posts() ) : $free_gifts->the_post();
                            global $product;
                            $price = $product->get_price_html();
                    $price_amount_only = $product->get_price();
                    if ($price_amount_only > 0){$all_free_gifts[] = '<b><a href="' . get_permalink() . '">' . get_the_title() . '</a></b> (worth ' . $price . ')';}
                    else{$all_free_gifts[] = '<b><a href="' . get_permalink() . '">' . get_the_title() . '</a></b>';}

                        endwhile;
                        $prizes_links_list = implode(" and ", $all_free_gifts);
                        $minimum_spend = $all_meta[minimum_amount][0];
                        $required_products = $all_meta[product_ids][0];
                        $required_categories = $all_meta[product_categories][0];
                        $excluded_products = $all_meta[exclude_product_ids][0];
                        $excluded_categories = $all_meta[exclude_product_categories][0];
                        $expiry_date = $all_meta[expiry_date][0];
                        $cart_total_exc_shipping_inc_vat = $woocommerce->cart->subtotal;
                        $remaining_required_spend = $minimum_spend - $cart_total_exc_shipping_inc_vat;
                        $req_spend_2dp = number_format($remaining_required_spend, 2, '.', '');

                        //$cart_content = $woocommerce->cart;
                        //print_r($cart_content);


                        if($all_coupons->have_posts() ){ // COUPONS EXIST - RETURN IF ANY OF THEM ARE ALREADY APPLIED..
                            while ( $all_coupons->have_posts() ) : $all_coupons->the_post();
                                $this_coupon_code = get_the_title();
                                if ( $woocommerce->cart->has_discount( $this_coupon_code ) ) return;
                            endwhile;
                        }

                        if ( $woocommerce->cart->has_discount( $auto_coupon_code ) ) return; //   RETURN IF CURRENT PROMO COUPON IS ALREADY APPLIED

                        // EVERYTHING IS CHECKED - LETS APPLY THE COUPON...



            // FREE GIFT(S)
                        if($coupon_type == 'free_gift'){ 
                            if ( $woocommerce->cart->subtotal >= $minimum_spend ) { // MINIMUM SPEND MET
                                $woocommerce->cart->add_discount( $auto_coupon_code );
                                $woocommerce->show_messages();
                                echo '<div class="woocommerce-message"><div class="left">Congratulations! Your free gift has been added to your cart.<br></div></div>';

                            }else{ // MINIMUM SPEND NOT MET
                                echo '<div class="woocommerce-message">';
                                    echo '<div class="left">Spend just <b>£' . $req_spend_2dp . '</b> more to receive your free gift of ' . $prizes_links_list . '.<br></div>';
                                    echo '<div style="text-align:center;">';
                                        while ( $free_gifts->have_posts() ) : $free_gifts->the_post();
                                            the_post_thumbnail( '200sq' ) . ' ';
                                        endwhile;
                                    echo '</div>';
                                echo '</div>';
                            }

            // CART FIXED AMOUNT
                        }elseif($coupon_type == 'fixed_cart'){ 
                            if ( $woocommerce->cart->subtotal >= $minimum_spend ) { // MINIMUM SPEND MET
                                $woocommerce->cart->add_discount( $auto_coupon_code );
                                //$woocommerce->show_messages();
                                echo '<div class="woocommerce-message"><div class="left">Congratulations! Your <b>£' . $coupon_amount . '</b> discount has been applied to your cart.<br></div></div>';

                            }else{ // MINIMUM SPEND NOT MET
                                echo '<div class="woocommerce-message"><div class="left">Spend just <b>£' . $req_spend_2dp . '</b> more for a <b>£' . $coupon_amount . '</b> discount.<br></div></div>';
                            }

            // CART PERCENTAGE
                        }elseif($coupon_type == 'percent'){ 
                            if ( $woocommerce->cart->subtotal >= $minimum_spend ) { // MINIMUM SPEND MET
                                $woocommerce->cart->add_discount( $auto_coupon_code );
                                //$woocommerce->show_messages();
                                echo '<div class="woocommerce-message"><div class="left">Congratulations! Your <b>' . $coupon_amount . '%</b> discount has been applied to your cart.<br></div></div>';

                            }else{ // MINIMUM SPEND NOT MET
                                echo '<div class="woocommerce-message"><div class="left">Spend just <b>£' . $req_spend_2dp . '</b> more for a <b>' . $coupon_amount . '%</b> discount.<br></div></div>';
                            }

            // PRODUCT FIXED AMOUNT
                        }elseif($coupon_type == 'fixed_product'){ 
                            if ( $woocommerce->cart->subtotal >= $minimum_spend ) { // MINIMUM SPEND MET
                                $woocommerce->cart->add_discount( $auto_coupon_code );
                                //$woocommerce->show_messages();
                                echo '<div class="woocommerce-message"><div class="left">Congratulations! Your <b>£' . $coupon_amount . '</b> discount has been applied to your cart.<br></div></div>';

                            }else{ // MINIMUM SPEND NOT MET
                                echo '<div class="woocommerce-message"><div class="left">Spend just <b>£' . $req_spend_2dp . '</b> more for a <b>£' . $coupon_amount . '</b> discount.<br></div></div>';
                            }

            // PRODUCT PERCENTAGE
                        }elseif($coupon_type == 'percent_product'){ 
                            if ( $woocommerce->cart->subtotal >= $minimum_spend ) { // MINIMUM SPEND MET
                                $woocommerce->cart->add_discount( $auto_coupon_code );
                                //$woocommerce->show_messages();
                                echo '<div class="woocommerce-message"><div class="left">Congratulations! Your <b>' . $coupon_amount . '%</b> discount has been applied to your cart.<br></div></div>';

                            }else{ // MINIMUM SPEND NOT MET
                                echo '<div class="woocommerce-message"><div class="left">Spend just <b>£' . $req_spend_2dp . '</b> more for a <b>' . $coupon_amount . '%</b> discount.<br></div></div>';
                            }

            // SOME OTHER DISCOUNT TYPE..?
                        }else{} 

                    }

                endwhile;
                // Prevent weirdness
                wp_reset_postdata();
        }
    }
    
}








//add_action( 'woocommerce_before_cart', 'remove_coupons' );
//add_action( 'woocommerce_before_checkout_form', 'remove_coupons' );
/*
function remove_coupons() {
    global $woocommerce;

    $currentuser = wp_get_current_user();
    $checkout_url = $woocommerce->cart->get_checkout_url();

    $array = $woocommerce->cart->get_coupons( $type );
    
    if(in_array( 'trade_user', (array) $currentuser->roles )){ // TRADE USER
        $woocommerce->cart->remove_coupon('powerlight65');
//        $woocommerce->cart->remove_coupons('2');
        //echo 'you are a trade customer';
        print_r($array);
    }
}
*/

?>