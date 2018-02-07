<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
// first check that woo exists to prevent fatal errors
if ( function_exists( 'is_woocommerce' ) ) :


// USE YOAST TITLE (IF IT EXISTS) FOR GOOGLE PRODUCT FEED, ELSE FALL BACK ON PRODUCT TITLE
function lw_woocommerce_gpf_title($title, $product_id) {
    if( get_post_meta( $product_id, '_yoast_wpseo_title', true ) ){
        return get_post_meta( $product_id, '_yoast_wpseo_title', true );
    }
    else return $title;  
}
add_filter( 'woocommerce_gpf_title', 'lw_woocommerce_gpf_title', 10, 2);




// Rename/Filter the Title of a WooCommerce Product on the Single Product Page
// add_filter('the_title', 'xcsn_single_product_page_title', 10, 2);
function xcsn_single_product_page_title($title, $id) {

    if( ( is_product() && in_the_loop() ) ) {      
        if ( get_post_meta(get_the_ID(), '_cmb_subheading', true) ) { 
            $title = $title  . '<span class="subheading">' . get_post_meta(get_the_ID(), '_cmb_subheading', true) . '<span>';
        }
        else $title = $title;
        return $title;
    }
    //Return the normal Title if conditions aren't met
    return $title;
}



// Display field value on the order edit page
add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );
function my_custom_checkout_field_display_admin_order_meta($order){
    $meta = get_post_meta( $order->id, ['billing']['billing_options'], true );
    $user_id = $meta['_customer_user']['0'];
    $user_object = new WP_User( $user_id );
    $user_roles = $user_object->roles;
    $roles_string = implode(', ',$user_roles);
    if( empty( $user_roles ) ){ $customer_roles = 'guest'; }
    else{ $customer_roles = $roles_string; }

    echo 'Customer role: <b>' . $customer_roles . '</b>';
}



// Add used coupons to the order confirmation email
add_action( 'woocommerce_email_after_order_table', 'add_used_coupons_to_admin_new_order', 15, 2 );
function add_used_coupons_to_admin_new_order( $order, $is_admin_email ) {

    if ( $is_admin_email ) {

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
            echo '<h2>' . __('Coupons used') . ' (' . $coupons_count . '): ' . $coupons_list . '</h2>';
            
        } // endif get_used_coupons
    } // endif $is_admin_email 
}


add_action( 'woocommerce_email_customer_details', 'add_user_role_to_admin_new_order', 15, 2 );
function add_user_role_to_admin_new_order( $order, $is_admin_email ) {

    $meta = get_post_meta( $order->id, ['billing']['billing_options'], true );
    $user_id = $meta['_customer_user']['0'];
    $user_object = new WP_User( $user_id );
    $user_roles = $user_object->roles;
    $roles_string = implode(', ',$user_roles);
    if( empty( $user_roles ) ){ $customer_roles = 'guest'; }
    else{ $customer_roles = $roles_string; }

    if ( $is_admin_email ) {
        echo '<h2>' . __('Customer role') . ': ' . $roles_string . '</h2>';
    }
}


// FIX
add_filter('woocommerce_dynamic_pricing_is_rule_set_valid_for_user', 'allow_guest_for_rules', 10, 3);
function allow_guest_for_rules( $result, $condition, $adjustment_set ) {

    if ( $condition['args']['applies_to'] == 'roles' && isset( $condition['args']['roles'] ) && is_array( $condition['args']['roles'] ) ) {
        foreach ( $condition['args']['roles'] as $role ) {
            if ( ( $role == 'guest' && !is_user_logged_in() ) || current_user_can( $role ) ) {
                $result = 1;
                break;
            }
        }
    }
    return $result;
}



function gdc_mobile_shop_nav_link(){
    if(is_woocommerce()){
        echo '<div class="desktophide"><a class="button" href="#navtabs" style="width:100%; text-align:center;">Browse Products</a></div>';
    }
}
add_action('woocommerce_before_main_content', 'gdc_mobile_shop_nav_link');
add_filter( 'woocommerce_create_account_default_checked', function( $isChecked) { return true; } );



/**
 * Optimize WooCommerce Scripts
 * Remove WooCommerce Generator tag, styles, and scripts from non WooCommerce pages.
 */
//add_action( 'wp_enqueue_scripts', 'child_manage_woocommerce_styles', 99 );

function child_manage_woocommerce_styles() {
    //remove generator meta tag
    remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );

    //dequeue scripts and styles
    if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
        wp_dequeue_style( 'woocommerce_frontend_styles' );
        wp_dequeue_style( 'woocommerce_fancybox_styles' );
        wp_dequeue_style( 'woocommerce_chosen_styles' );
        wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
        wp_dequeue_script( 'wc_price_slider' );
        wp_dequeue_script( 'wc-single-product' );
        wp_dequeue_script( 'wc-add-to-cart' );
        wp_dequeue_script( 'wc-cart-fragments' );
        wp_dequeue_script( 'wc-checkout' );
        wp_dequeue_script( 'wc-add-to-cart-variation' );
        wp_dequeue_script( 'wc-single-product' );
        wp_dequeue_script( 'wc-cart' );
        wp_dequeue_script( 'wc-chosen' );
        wp_dequeue_script( 'woocommerce' );
        wp_dequeue_script( 'prettyPhoto' );
        wp_dequeue_script( 'prettyPhoto-init' );
        wp_dequeue_script( 'jquery-blockui' );
        wp_dequeue_script( 'jquery-placeholder' );
        wp_dequeue_script( 'fancybox' );
        wp_dequeue_script( 'jqueryui' );
    }
}



// ADD 'LOGIN/OUT' LINK AND CART VALUE TO HEADER
function mbm_login_link_and_cart(){
    $myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
    $current_user = wp_get_current_user();
    global $woocommerce;
    $cart = $woocommerce->cart;
    $gdc_cart_total = $cart->total;
    $cart_url = $woocommerce->cart->get_cart_url();
    $cart_total_exc_shipping_inc_vat = $woocommerce->cart->subtotal;
    $cart_total_exc_shipping_inc_vat_2dp = number_format($cart_total_exc_shipping_inc_vat, 2, '.', '');

    if ( $myaccount_page_id ) {
        $myaccount_page_url = get_permalink( $myaccount_page_id );

        if ( is_user_logged_in() ) { // USER IS LOGGED IN
            echo '<a class="sign_in_link" href="' . wp_logout_url( get_home_url() ) . '" title="Log out" >Log out</a>';

        }else{ // NOT LOGGED IN
            if ( is_account_page() ){ } // THIS IS THE 'MY ACCOUNT' PAGE, NO NEED FOR LOGIN LINK
            else{echo '<a class="sign_in_link" href="' . $myaccount_page_url . '" title="Log in" >Log in</a>';}
        }
    }

    if(! sizeof ($woocommerce->cart->cart_contents) == 0){ // cart not empty - display cart link with cart total
        echo '<a class="sign_in_link" href="' . $cart_url . '"><img width="12" style="margin-bottom:-2px; margin-right:2px;" src="' . get_bloginfo('stylesheet_directory') . '/images/cart.png"> £' . $cart_total_exc_shipping_inc_vat_2dp . '</a>';
    }else{ // CART EMPTY
        // DO NOTHING
    }
}
add_action( 'thematic_header', 'mbm_login_link_and_cart', 2 );



// ADD CONTINUE SHOPPING BUTTON ABOVE SIDEBAR ON CART & CHECKOUT PAGES
add_action( 'thematic_abovemainasides', 'mbm_continue_shopping_button' );
function mbm_continue_shopping_button(){ 
    if( is_cart() || is_checkout() ){ ?>
        <a class="button wc-backward" href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>"><?php _e( 'Continue Shopping', 'woocommerce' ) ?></a>
    <?php }
}



//remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
//add_action('woocommerce_after_shop_loop_item_title','woocommerce_template_single_excerpt', 5);
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );



add_filter( 'add_to_cart_text', 'gdc_custom_cart_button_single' ); // < 2.1
add_filter( 'woocommerce_product_single_add_to_cart_text', 'gdc_custom_cart_button_single' ); // 2.1 +
function gdc_custom_cart_button_single() {
    $button_text = 'Add to bag';
    return __( $button_text, 'woocommerce' );
}



add_filter( 'add_to_cart_text', 'gdc_custom_cart_button_archive' ); // < 2.1
add_filter( 'woocommerce_product_add_to_cart_text', 'gdc_custom_cart_button_archive' ); // 2.1 +
function gdc_custom_cart_button_archive() {
    global $product;
    $price = $product->get_price();
    $button_text = 'Add to bag (£' . $price . ')';
        return __( $button_text, 'woocommerce' );   
}





remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 39 );




add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
function woo_rename_tabs( $tabs ) {

$icon_url_description = get_bloginfo('stylesheet_directory') . '/images/icon-info.png"';
$icon_url_reviews = get_bloginfo('stylesheet_directory') . '/images/icon-reviews.png"';
$icon_url_customise = get_bloginfo('stylesheet_directory') . '/images/icon-personalise.png"';

$tabs['description']['title'] = __( '<img width="46" src="' . $icon_url_description . '" />' ); // Rename the description tab
$tabs['reviews']['title'] = __( '<img width="46" src="' . $icon_url_reviews . '" />' ); // Rename the reviews tab
//$tabs['customize']['title'] = __( '<img width="46" src="' . $icon_url_customise . '" />' ); // Rename the reviews tab
 
return $tabs;
 
}




// REMOVE ADDITIONAL INFO TAB
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['additional_information'] ); // Remove the additional information tab
return $tabs;
}


//add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
function woo_new_product_tab( $tabs ) {

    // ADD INSTRUCTIONS TAB
    if ( get_post_meta(get_the_ID(), "_cmb_instructions", true) ) {
        $instructions_icon_url = get_bloginfo('stylesheet_directory') . '/images/icon-instructions.png"';
        $tabs['instructions_tab'] = array(
        'title' => __( '<img width="46" src="' . $instructions_icon_url . '" alt="Instructions" />', 'woocommerce' ),
        'priority' => 50,
        'callback' => 'product_instructions_tab_content'
        );
    }

    // ADD INGREDIENTS TAB
    if ( get_post_meta(get_the_ID(), "_cmb_ingredients", true) ) {
        $ingredients_icon_url = get_bloginfo('stylesheet_directory') . '/images/icon-ingredients.png"';
        $tabs['ingredients_tab'] = array(
        'title' => __( '<img width="46" src="' . $ingredients_icon_url . '" alt="Ingredients" />', 'woocommerce' ),
        'priority' => 55,
        'callback' => 'product_ingredients_tab_content'
        );
    }

    return $tabs;
}


function product_instructions_tab_content() { 
    //echo '<h2>Instructions for use</h2>';
    if ( get_post_meta(get_the_ID(), "_cmb_instructions", true) ) {
        echo '<h2>Instructions for use</h2>';
        echo '<p>' . get_post_meta(get_the_ID(), "_cmb_instructions", true). '</p>';
        }
}

function product_ingredients_tab_content() { 
    //echo '<h2>Instructions for use</h2>';
    if ( get_post_meta(get_the_ID(), "_cmb_ingredients", true) ) {
        echo '<h2>Ingredients</h2>';
        echo '<p>' . get_post_meta(get_the_ID(), "_cmb_ingredients", true). '</p>';
        }
        else{
            echo '<h2>Ingredients</h2>';
            echo 'No ingredients set.';
        }
}



add_action( 'woocommerce_single_product_summary', 'sample_full_size_link', 38 );
function sample_full_size_link(){
    global $post;
    $connected = new WP_Query( array(
    'connected_type' => 'product-product',
    'connected_items' => get_queried_object(),
    'nopaging' => true,
    ) ); 

    if ( $connected->have_posts() ){
        while ( $connected->have_posts() ) : $connected->the_post();

            if( has_term( 'samples', 'product_cat', $post->ID ) ) {
                // Linked product IS in category 'samples'
                echo '<div class="tryasample"><div class="tinyimage"><a href="' . get_the_permalink() . '">';
                the_post_thumbnail(array(100,100));
                echo '</a></div>';
                echo get_the_post_thumbnail('medium') . 'New to this product? <br><a href="' . get_the_permalink() . '">Try a sample</a></div>';
            }else{
                // Linked product is Not in category 'samples'
                echo '<div class="tryasample"><div class="tinyimage"><a href="' . get_the_permalink() . '">';
                the_post_thumbnail(array(100,100));
                echo '</a></div>';
                echo get_the_post_thumbnail('medium') . '<a href="' . get_the_permalink() . '">Go to full-sized product ></a></div>';
            }

            
        endwhile;
        wp_reset_query();
        
    }

}



// Display 99 products per page.
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 99;' ), 20 );


remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
//remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);






// CHANGE SALE FLASH TEXT
add_filter('woocommerce_sale_flash', 'gdc_change_sale_content', 10, 3);
function gdc_change_sale_content($content, $post, $product){
$content = '<span class="onsale">'.__( 'Special Offer', 'woocommerce' ).'</span>';
return $content;
}



// HIDE PRODUCTS IN SAMPLE CATEGORY FROM ARCHIVE PAGES
add_action( 'pre_get_posts', 'custom_pre_get_posts_query' );
function custom_pre_get_posts_query( $q ) {
if ( ! $q->is_main_query() ) return;
if ( ! $q->is_post_type_archive() ) return;
if ( ! is_admin() ) {
$q->set( 'tax_query', array(array(
'taxonomy' => 'product_cat',
'field' => 'slug',
'terms' => array( 'samples' ), // Don't display products in the membership category on the shop page . For multiple category , separate it with comma.
'operator' => 'NOT IN'
)));
}
remove_action( 'pre_get_posts', 'custom_pre_get_posts_query' );
}



remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'thematic_abovemainasides', 'mbm_woocommerce_cross_sell_display' );


if ( ! function_exists( 'mbm_woocommerce_cross_sell_display' ) ) {

    /**
     * Output the cart cross-sells.
     *
     * @param  integer $posts_per_page
     * @param  integer $columns
     * @param  string $orderby
     */
    function mbm_woocommerce_cross_sell_display( $posts_per_page = 2, $columns = 2, $orderby = 'rand' ) {
        if(is_cart()){
            wc_get_template( 'cart/cross-sells.php', array(
                'posts_per_page' => $posts_per_page,
                'orderby'        => $orderby,
                'columns'        => $columns
            ) );
        }
    }
}



// WooCommerce Shipping Calculated after Coupon
add_filter( 'woocommerce_shipping_free_shipping_is_available', 'filter_shipping', 10, 2 );
 
function filter_shipping( $is_available, $package ) {
    if ( WC()->cart->prices_include_tax )
        $total = WC()->cart->cart_contents_total + array_sum( WC()->cart->taxes );
    else
        $total = WC()->cart->cart_contents_total;
 
    $total = $total - ( WC()->cart->get_order_discount_total() + WC()->cart->get_cart_discount_total() );
 
    // You can hardcode the number or get the setting from the shipping method
    $shipping_settings = get_option('woocommerce_free_shipping_settings');
    $min_total = $shipping_settings['min_amount'] > 0 ? $shipping_settings['min_amount'] : 0;
    
    if ( $min_total  > $total ) {
        $is_available = false;
    }
 
    return $is_available;
}


 
// This basically recalculates totals after the discount has been added
add_action( 'woocommerce_calculate_totals', 'change_shipping_calc' );
function change_shipping_calc( $cart ) {
 
        $packages = WC()->cart->get_shipping_packages();
 
        // Calculate costs for passed packages
        $package_keys       = array_keys( $packages );
        $package_keys_size  = sizeof( $package_keys );
 
        for ( $i = 0; $i < $package_keys_size; $i ++ ) {
            unset( $packages[ $package_keys[ $i ] ]['rates'] );
 
            $package_hash   = 'wc_ship_' . md5( json_encode( $packages[ $package_keys[ $i ] ] ) );
 
            delete_transient( $package_hash );
        }
 
        // Calculate the Shipping
        $cart->calculate_shipping();
 
        // Trigger the fees API where developers can add fees to the cart
        $cart->calculate_fees();
 
        // Total up/round taxes and shipping taxes
        if ( $cart->round_at_subtotal ) {
            $cart->tax_total          = $cart->tax->get_tax_total( $cart->taxes );
            $cart->shipping_tax_total = $cart->tax->get_tax_total( $cart->shipping_taxes );
            $cart->taxes              = array_map( array( $cart->tax, 'round' ), $cart->taxes );
            $cart->shipping_taxes     = array_map( array( $cart->tax, 'round' ), $cart->shipping_taxes );
        } else {
            $cart->tax_total          = array_sum( $cart->taxes );
            $cart->shipping_tax_total = array_sum( $cart->shipping_taxes );
        }
 
        // VAT exemption done at this point - so all totals are correct before exemption
        if ( WC()->customer->is_vat_exempt() ) {
            $cart->remove_taxes();
        }
}
 
add_filter( 'woocommerce_table_rate_query_rates_args', 'filter_shipping_2', 10 );
function filter_shipping_2( $arguments ) {
    if ( WC()->cart->prices_include_tax )
        $total = WC()->cart->cart_contents_total + array_sum( WC()->cart->taxes );
    else
        $total = WC()->cart->cart_contents_total;
 
    $total = $total - ( WC()->cart->get_order_discount_total() + WC()->cart->get_cart_discount_total() );
 
    $arguments['price'] = $total;
 
    return $arguments;
}



function replacePayPalIcon($iconUrl) {
    return get_bloginfo('stylesheet_directory') . '/images/paypal-logo.png';
}
 
add_filter('woocommerce_paypal_icon', 'replacePayPalIcon');

/*
//Add used coupons to the order confirmation email
add_action( 'woocommerce_email_after_order_table', 'add_payment_method_to_admin_new_order', 15, 2 );
function add_payment_method_to_admin_new_order( $order, $is_admin_email ) {
    if ( $is_admin_email ) {
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
        
            echo '<br><p><strong>Coupons used (' . $coupons_count . ') :</strong> ' . $coupons_list . '</p>';
        
        } // endif get_used_coupons
    } // endif $is_admin_email
}
*/
 



 
// Add used coupons to the order edit page - Not needed as WC has better version already built in
/*
add_action( 'woocommerce_admin_order_data_after_billing_address', 'custom_checkout_field_display_admin_order_meta', 10, 1 );
function custom_checkout_field_display_admin_order_meta($order){
    if( $order->get_used_coupons() ) {
        $coupons_count = count( $order->get_used_coupons() );
        echo '<h4>' . __('Coupons used') . ' (' . $coupons_count . '): ';
         
        $i = 1;
        
        foreach( $order->get_used_coupons() as $coupon) {
            echo $coupon;
            if( $i < $coupons_count )
                echo ', ';
            $i++;
        }
        echo '</h4>';
    }
}
*/



/*
// Hook in
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields', 16);

// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields( $fields ) {
     $fields['billing']['billing_options'] = array(
    'label'       => __('Title', 'woocommerce'),
    'placeholder' => _x('', 'placeholder', 'woocommerce'),
    'required'    => true,
    'clear'       => false,
    'type'        => 'select',
    'options'     => array(
        'mr' => __('Mr', 'woocommerce' ),
        'mrs' => __('Mrs', 'woocommerce' ),
        'ms' => __('Ms', 'woocommerce' )
        )
    );
    return $fields;
}


add_filter("woocommerce_checkout_fields", "order_fields");
function order_fields($fields) {

    $order = array(
        "billing_first_name", 
        "billing_last_name", 
        "billing_company", 
        "billing_address_1", 
        "billing_address_2", 
        "billing_postcode", 
        "billing_country", 
        "billing_email", 
        "billing_phone"

    );
    foreach($order as $field)
    {
        $ordered_fields[$field] = $fields["billing"][$field];
    }

    $fields["billing"] = $ordered_fields;
    return $fields;
}
*/




add_theme_support( 'woocommerce' );

endif;
?>