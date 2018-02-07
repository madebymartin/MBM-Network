<?php
global $woocommerce;
$cart_url = $woocommerce->cart->get_cart_url();
$currentuser = wp_get_current_user();

if(in_array( 'trade_user', (array) $currentuser->roles )){ // TRADE CUSTOMER - DO NOTHING!
    echo '<div class="aside"><div class="notification">';
        echo 'Your trade discount is applied automatically.';
    echo '</div></div>';
}


else{ // NOT TRADE USER
    if( is_cart() || is_checkout() ){
    //  SILENCE
    }else{
        
        //  NOT CART OR CHECKOUT - DISPLAY STUFF..

        // LOOP ALL COUPONS
/*        $all_coupons = new WP_Query( array(
            'post_type' => 'shop_coupon',
            'posts_per_page' => '-1',
            'status' => 'publish',
            'orderby' => 'title',
            'order' => 'ASC',
        ));*/

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


        if ( $coupon_promos->have_posts() ) {
        echo '<div class="aside"><div class="notification">';
            while ( $coupon_promos->have_posts() ) : $coupon_promos->the_post();
                
                $auto_coupon_code = get_the_title();
                $coupon_description = get_the_excerpt();

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
//                    
                    $all_prizes_names[] = get_the_title();

                endwhile;
                $prizes_links_list = implode(" and ", $all_free_gifts);
                $prizes_names_list = implode(" and ", $all_prizes_names);
                $minimum_spend = $all_meta[minimum_amount][0];
                $required_products = $all_meta[product_ids][0];
                $required_categories = $all_meta[product_categories][0];
                $excluded_products = $all_meta[exclude_product_ids][0];
                $excluded_categories = $all_meta[exclude_product_categories][0];
                $expiry_date = $all_meta[expiry_date][0];
                $cart_total_exc_shipping_inc_vat = $woocommerce->cart->subtotal;
                $remaining_required_spend = $minimum_spend - $cart_total_exc_shipping_inc_vat;
                $req_spend_2dp = number_format($remaining_required_spend, 2, '.', '');


                // DEFINE MESSAGES FOR EACH COUPON TYPE
                if($coupon_type == 'free_gift'){ // FREE GIFT(S)

                    //$prize = $prizes_links_list;
                    $prize = $prizes_names_list;

                    $qualified_message = 'Congratulations! Your cart qualifies for your free ' . $prize . '. <a href="' . $cart_url . '" class="button">Visit the cart for your gift</a>';
                    $success_message = 'Your cart contains your free ' . $prize;



                    
                }elseif($coupon_type == 'fixed_cart'){ // CART FIXED AMOUNT
                    $prize = '£' . $coupon_amount . 'discount';
                    $qualified_message = 'Congratulations! Visit the cart page to receive your ' . $prize;
                    $success_message = 'Your cart contains your ' . $prize;
                    
                }elseif($coupon_type == 'percent'){ // CART PERCENTAGE
                    $prize = $coupon_amount . '% discount';
                    $qualified_message = 'Congratulations! Visit the cart page to receive your ' . $prize;
                    $success_message = 'Your cart contains your ' . $prize;

                }elseif($coupon_type == 'fixed_product'){ // PRODUCT FIXED AMOUNT
                    $prize = '£' . $coupon_amount . 'discount';
                    $qualified_message = 'Congratulations! Visit the cart page to receive your ' . $prize;
                    $success_message = 'Your cart contains your ' . $prize;

                }elseif($coupon_type == 'percent_product'){ // PRODUCT PERCENTAGE
                    $prize = $coupon_amount . '% discount';
                    $qualified_message = 'Congratulations! Visit the cart page to receive your ' . $prize;
                    $success_message = 'Your cart contains your ' . $prize;

                }else{} // SOME OTHER DISCOUNT TYPE..?




                // DISPLAY MESSAGE..
                if ( $woocommerce->cart->has_discount( $auto_coupon_code ) ){ // CART ALREADY HAS PROMO COUPON APPLIED
                    echo $success_message;
                }


                else{ // CART DOESN'T HAVE PROMO COUPON APPLIED
                    if ( $woocommerce->cart->subtotal >= $minimum_spend ) { //  MINIMUM SPEND IS MET
                        echo $qualified_message;
                    }else{ //   MIN SPEND NOT MET
                        echo $coupon_description;
                        echo ' <b>(Spend just another £' . $req_spend_2dp . ')</b>.';
                    }
                }


            endwhile;
            wp_reset_postdata();
        echo '</div></div>';
        }
        
    }
}
?>