<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


require_once( 'lib/functions/insert_content.php' );
require_once( 'lib/functions/google_fonts.php' );
require_once( 'lib/functions/blog_title_image.php' );
require_once( 'lib/functions/clean_html5_header.php' );
require_once( 'lib/functions/widget_areas.php' );
require_once( 'lib/functions/sidebars.php' );
require_once( 'lib/functions/shop_navigation_script.php' );
require_once( 'lib/functions/enqueue_styles_scripts.php' );
require_once( 'lib/functions/custom_post_types.php' );
require_once( 'lib/functions/add-thumbnails.php' );
require_once( 'lib/functions/simplemap-edits.php' );
require_once( 'lib/functions/simplemap-custom-template.php' );
require_once( 'lib/functions/custom_user_meta.php' );
require_once( 'lib/functions/gf_mergesupport.php');
require_once( 'lib/functions/gf_autoexpert/autoexpert.php');
require_once( 'lib/functions/loop_shortcode.php');
require_once( 'lib/functions/custom_siteinfo.php' );
require_once( 'lib/functions/custom_email.php' );
//require_once( 'lib/cmb/custom-meta-boxes.php' );
require_once( 'lib/functions/custom-meta2.php' );
require_once( 'lib/functions/custom_login.php' );
require_once( 'lib/functions/gf_trade_registration_form.php' );
require_once( 'lib/functions/custom_cart_notifications.php' );
require_once( 'lib/functions/gf_customisations.php' );
require_once( 'lib/functions/auto_promo_coupons.php' );
require_once( 'lib/functions/explode_woo_tabs.php' );
require_once( 'lib/functions/woocommerce_edits.php' );
require_once( 'lib/functions/gf_add_spa.php' );

require_once( 'lib/functions/skx.php' );



// function to write to WP Debug Log in my own functions / templates
if (!function_exists('mbm_write_log')) {
    function mbm_write_log ( $log )  {
        if ( true === WP_DEBUG ) {
            if ( is_array( $log ) || is_object( $log ) ) {
                error_log( print_r( $log, true ) );
            } else {
                error_log( $log );
            }
        }
    }
}





add_filter('manage_users_columns', 'pippin_add_user_id_column');
function pippin_add_user_id_column($columns) {
    $columns['skx_sex'] = 'Gender';
    return $columns;
}
 
add_action('manage_users_custom_column',  'pippin_show_user_id_column_content', 10, 3);
function pippin_show_user_id_column_content($value, $column_name, $user_id) {
    $user = get_userdata( $user_id );
    $sex = get_user_meta($user_id, 'skx_sex', true);
    if ( 'skx_sex' == $column_name )
        return $sex;
    return $value;
}





//add_action('woocommerce_order_status_processing', 'skx_create_pdf', 10, 1);
function skx_create_pdf($order_id){

    if(is_user_logged_in()){
        //$currentsite = getcwd();
        $currentsite = $_SERVER["DOCUMENT_ROOT"];
        //mbm_write_log('MART' . $currentsite);

        $order = new WC_order($order_id);
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
        $skx_results = get_skx_product_results($user_id);
        $recommendations = $skx_results['recommendations'];
        $skx_product_ids = $skx_results['all_ids'];

        
        if($previous_orders_with_skx_samples > 0 ){

            require_once 'lib/mpdf60/mpdf.php'; 
            $mpdf=new mPDF('utf-8', array(210,297));
            $html = '<html>';
            $html .= '<head><link rel="stylesheet" href="'. get_stylesheet_directory_uri() .'/lib/css/skx_pdf.css" type="text/css" /></head>';
            $html .= '<body class="skx">';
            $html .= '<div class="logo"><img width="300" src="'. get_stylesheet_directory_uri() .'/images/gdclogo.jpg" alt="Germaine de Capuccini"></div><br><br><br>';
            $html .= '<p>Hi ' . $user_info->first_name . ' and thanks for using our Skincare Expert service. We hope you love using your free samples and we have added a 20% discount coupon to your account for use against your first order. Simply select it at the cart / checkout when placing your order. <i>It is valid for the next 4 weeks (minimum spend £25).</i></p>';
            if($previous_orders_with_skx_samples == 1 ){ $html .= '<p>We have also added £4.95 credit to your account to reimburse you for the shipping cost of these samples.</p>'; }
            $html .= '<p>Turn over to see your recommended products and instructions for their use. You can also check your own personalised skincare routine at any time here: <b>www.gdcspa.co.uk/my-skin</b>. If we ever launch products that are even more suited to your skin in the future, they will appear there too!</p>';
            $html .= '<p>If you need any help using your coupon or need more advice on caring for your skin, please call us on <b>0845 600 0203</b> and one of our highly trained therapists will be happy to help.</p>';
            $html .= '<br><br><br><br><p>Kindest regards,<br>the Skincare Expert</p>';
            $html .= '<img width="180" src="'. get_stylesheet_directory_uri() .'/images/signature.jpg" alt="The Skincare Expert">';
            $html .= '<p style="page-break-after:always;"></p>';
            $html .= '<div class="logo"><img width="300" src="'. get_stylesheet_directory_uri() .'/images/gdclogo.jpg" alt="Germaine de Capuccini"></div><br><br><br>';
            $html .= '<table>';

            foreach ($recommendations as $type => $id) {
                foreach ($id as $key => $value) {
                    $product_id = $value;
                    $product = new WC_Product( $product_id );
                    $price = $product->price;
                    $product_meta = get_post_meta($product_id);
                    $add_to_cart_url = $page_url . '/?add-to-cart=' . $product_id . '' ;
                    $prodprice = number_format($price, 2, '.', '');
                    if ( get_post_meta($product_id, "_cmb_instructions", true) ) { $instructions = '<p>' . get_post_meta($product_id, "_cmb_instructions", true) . '</p>'; } 
                    else { $instructions = term_description( '155', 'recommendation_type' ); }

                    $prodexcerpt = get_the_excerpt($product_id);
                    $prodimage = '<div class="product_image_wrapper_outer"><span class="product_image_wrapper_inner"></span>' . get_the_post_thumbnail( $product_id, 'thumb', array('class'=>'productimage') ) . '</div>';

                    $html .= '<tr><td>'. $prodimage .'</td><td><h4>'. esc_attr( $type ) .': '. esc_attr( get_the_title($product_id) ) .'</h4><br>'. $instructions  .'</td></tr><tr><br><br></tr>';
                    //$img = get_the_post_thumbnail( $product_id, 'thumb', array('class'=>'productimage') )

                }
            }
            $html .= '</table>'; 
            $html .= '<hr><br><p>If you feel that any of the recommended products are not right for you or would like to discuss your skin\'s needs further, we\'d be delighted to help so please call us on <b>0845 600 0203</b>.</p><p>Kindest regards, The Germaine de Capuccini team.</p>';       
            $html .='</body></html>';
            $mpdf->WriteHTML($html);
            $mpdf->Output($currentsite . '/files/skx/skx-'. $order_id .'.pdf', 'F');
        
        }
    }
}












add_filter( 'wp_mail_from_name', function( $name ) {
return 'Germaine de Capuccini';
});

add_filter( 'wp_mail_from', function( $email ) {
    return 'service@germaine-de-capuccini.co.uk';
});


//Page Slug Body Class
function add_slug_body_class( $classes ) {
    if( current_user_can('access_management')){}
    elseif( current_user_can('access_trade_content')) { $classes[] = 'tradeuser';}
    return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );



/**
* Preview WooCommerce Emails.
* @author WordImpress.com
* @url https://github.com/WordImpress/woocommerce-preview-emails
* If you are using a child-theme, then use get_stylesheet_directory() instead
*/
$preview = get_stylesheet_directory() . '/woocommerce/emails/woo-preview-emails.php';
if(file_exists($preview)) {
    require $preview;
}




// HACK TO FORCE BROWSERS TO REFRESH CSS - SET NEW VERSION NUMBER AND BROWSERS WILL NOT USED OLD CACHED VERSION
function my_wp_default_styles($styles)
{
    $styles->default_version = "1.23";
}
add_action("wp_default_styles", "my_wp_default_styles");


add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields( $fields ) {
     $fields['billing']['billing_phone']['label'] = 'Mobile Number<br><small>(Courier will text you with delivery time)</small>';
     $fields['billing']['billing_phone']['label_class'] = 'mobilelabel';
     $fields['billing']['billing_email']['clear'] = true;
     //$fields['billing']['billing_email']['class'] = 'test';
     return $fields;
}





/*add_action( 'woocommerce_thankyou', 'my_custom_tracking' );
function my_custom_tracking( $order_id ) {
// Lets grab the order
$order = new WC_Order( $order_id );

//echo '<div id="fb_tracker_24-07-15"></div>';

}*/


//add_filter( 'wc_wishlists_create_list_args', 'mbm_wishlist_default_to_shared');
function mbm_wishlist_default_to_shared($args){

    $defaults = array(
        'wishlist_title' => $title,
        'wishlist_description' => '',
        'wishlist_type' => 'list',
        'wishlist_sharing' => 'Shared',
        'wishlist_status' => is_user_logged_in() ? 'active' : 'temporary',
        'wishlist_owner' => WC_Wishlists_User::get_wishlist_key(),
        'wishlist_owner_email' => is_user_logged_in() ? $current_user->user_email : '',
        'wishlist_owner_notifications' => false,
        'wishlist_first_name' => is_user_logged_in() ? $current_user->user_firstname : '',
        'wishlist_last_name' => is_user_logged_in() ? $current_user->user_lastname : '',
        'wishlist_items' => array(),
        'wishlist_subscribers' => array(is_user_logged_in() ? $current_user->user_email : ''),
    );
    $args = wp_parse_args( $args, $defaults );
}




add_filter( 'woocommerce_wishlist_share_via_email_body', 'mbm_wishlist_email', 10, 4);
function mbm_wishlist_email( $body, $wishlist_id, $name, $to  ){
    
    $key = get_post_meta($wishlist_id, '_wishlist_sharing_key', true);
    $link = get_permalink($wishlist_id) . '' . $wishlist_id . '&wlkey=' . $key;
    $content = filter_input( INPUT_POST, 'wishlist_content', FILTER_SANITIZE_STRIPPED );

    $body = '<div style="text-align:center; padding: 0 40px;">';
        $body.= '<br><h2 style="text-transform:uppercase;">STUCK FOR A GIFT IDEA FOR ' . $name . '?</h2><br>';
        $body.= '<img width="500" style="width: 100%; max-width:100%;" src="https://germaine-de-capuccini.co.uk/email/images/gift.jpg" alt="Gift imagex"><br><br>';
        $body.= $name . ' has made a list of favourite products and thought it might help if you were stuck for gift ideas! <a href="' . $link . '">You can see the wishlist here.</a>';
        $body .= '<br><br><div style="text-align:center; display:inline-block; border:1px solid #777777; padding:20px;"><h3 style="text-align:center; font-size:12px; font-style:normal;">PERSONAL MESSAGE</h3>' . $content . '</div>';
        $body .= '<br><br><a style="display:inline-block;" href="' . $link . '"><img width="300" src="https://germaine-de-capuccini.co.uk/email/images/viewlist2.jpg" alt="Make a wish come true" style="width:300px; margin: 20px auto; display:block; max-width:100%;"></a><br>';
    $body .= '</div>';

    return $body;
}





// add content to the thank you page
add_action( 'woocommerce_thankyou', 'add_content', 1 );
function add_content() {
echo '<div id="fb_tracker_24-07-15"></div>';
}





add_action('admin_head', 'my_custom_admin_style');
function my_custom_admin_style() {
  echo '<style>
    input#_cmb_subheading-cmb-field-0{ width: 100% !important; }
    input.code { width: 100% !important; }
  </style>';
}


function mbm_add_trade_link(){
    global $current_user;
    get_currentuserinfo();

    if ( is_account_page() ){ 
        if(current_user_can('access_trade_content') ){
            echo '<div class="notification">';
                //echo 'Welcome back ' . $current_user->user_firstname . '!<br>';
                echo 'You are a registered trade customer and can <a href="' . get_permalink('6516') . '">access trade support here</a>';
            echo '</div>';
        }
    }
}
add_action('thematic_abovepost', 'mbm_add_trade_link');


function blgs_rnb_remove_admin_bar() {
    global $wp_admin_bar;
 
    //Remove WordPress Logo Menu Items
    $wp_admin_bar->remove_menu('wp-logo'); // Completely Removes WP Logo, Below are the individual items
    $wp_admin_bar->remove_menu('about');   // 'About WordPress'
    $wp_admin_bar->remove_menu('wporg');   // 'WordPress.org'
    $wp_admin_bar->remove_menu('documentation');  // 'Documentation'
    $wp_admin_bar->remove_menu('support-forums');  // 'Support Forums'
    $wp_admin_bar->remove_menu('feedback');       // 'Feedback'
 
    //Remove Site Name Items
    //$wp_admin_bar->remove_menu('site-name'); // Completely Removes Site Name from Dashboar and Front End Admin Bar, Below are the individual items
    //$wp_admin_bar->remove_menu('view-site'); // 'Visit Site'
 
    //$wp_admin_bar->remove_menu('dashboard'); // 'Dashboard' Link, Only Front End
    $wp_admin_bar->remove_menu('themes'); // 'Themes' Link, Only Front End
    $wp_admin_bar->remove_menu('widgets'); // 'Widgets' Link, Only Front End
    $wp_admin_bar->remove_menu('menus'); // 'Menus' Link, Only Front End
    $wp_admin_bar->remove_menu('customize'); // 'Menus' Link, Only Front End
 
    // Remove Comments Bubble
    //$wp_admin_bar->remove_menu('comments');
 
    //Remove Update Link if theme/plugin/core updates are available
    //$wp_admin_bar->remove_menu('updates');
 
    //Remove '+ New' Menu Items
    $wp_admin_bar->remove_menu('new-content'); // Completely Removes '+ New' from Dashboar and Front End Admin Bar, Below are the individual items
    $wp_admin_bar->remove_menu('new-post');   // 'Post' Link
    $wp_admin_bar->remove_menu('new-media');   // 'Media' Link
    $wp_admin_bar->remove_menu('new-link');   // 'Link' Link
    $wp_admin_bar->remove_menu('new-page');   // 'Page' Link
    $wp_admin_bar->remove_menu('new-user');   // 'User' Link
 
    // Remove 'Howdy, username' Menu Items
    $wp_admin_bar->remove_menu('my-account');  // Completely Removes 'Howdy, username' and Menu Items
    $wp_admin_bar->remove_menu('user-actions');  // Completely Removes Submenu Items Only
    $wp_admin_bar->remove_menu('user-info'); // 'username' which links to profile page
    $wp_admin_bar->remove_menu('edit-profile');  // 'Edit My Profile' Link
    $wp_admin_bar->remove_menu('logout');  // 'Log Out' Link
 
}
add_action( 'wp_before_admin_bar_render', 'blgs_rnb_remove_admin_bar' );










// FORCES GRAVITY FORMS TO SEND IN PLAIN TEXT SO THAT WP BETTER EMAIL WILL WRAP IN CUSTOM TEMPLATE - IF WP-BETTER-EMAIL PLUGIN IS ACTIVE
/*
add_filter('gform_notification', 'change_notification_format', 10, 3);
function change_notification_format( $notification, $form, $entry ) {

    // is_plugin_active is not availble on front end
    if( !is_admin() )
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    // does WP Better Emails exists and activated ?
    if( !is_plugin_active('wp-better-emails/wpbe.php') )
        return $notification;

    // change notification format to text from the default html
    $notification['message_format'] = "text";
    // disable auto formatting so you don't get double line breaks
    $notification['disableAutoformat'] = true;

    return $notification;
}
*/




// CREATE 'CHECK ROLE' FUNCTION FOR USE BELOW
function check_user_role($roles,$user_id=NULL) {
    // Get user by ID, else get current user
    if ($user_id)
    $user = get_userdata($user_id);
    else
    $user = wp_get_current_user();
     
    // No user found, return
    if (empty($user))
    return FALSE;
     
    // Loop through user roles
    foreach ($user->roles as $role) {
        // Does user have role
        if (in_array($role,$roles)) {
            return TRUE;
        }
    }
    // User not in roles
    return FALSE;
}





add_theme_support('html5', array('search-form'));



// show admin bar only for admins and editors
if (!current_user_can('list_users')) {
    add_filter('show_admin_bar', '__return_false');
}


function childtheme_override_search_loop() {
    while ( have_posts() ) : the_post(); 

            // action hook for insterting content above #post
            thematic_abovepost();
            ?>
            <hr>    

            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?> > 
                <a href="<?php echo the_permalink(); ?>"><div style="width:150px; height:150px; background:#fff; text-align:center; float: left; margin: 0 3em 0 0;">
                    <?php if ( has_post_thumbnail() ) { the_post_thumbnail('shop_small'); } ?>
                </div></a>

                <?php thematic_postheader(); ?>
                                    
            </div><!-- #post -->

        <?php 
            // action hook for insterting content below #post
            thematic_belowpost();
    
    endwhile;
}


function tw_remove_menu_pages() {
// remove product submenus
    if ( !current_user_can( 'manage_options' ) ) {
        remove_submenu_page('edit.php?post_type=product', 'edit-tags.php?taxonomy=product_tag&amp;post_type=product');
        remove_submenu_page('edit.php?post_type=product', 'edit-tags.php?taxonomy=acne&amp;post_type=product');
        remove_submenu_page('edit.php?post_type=product', 'edit-tags.php?taxonomy=combination_oily&amp;post_type=product');
        remove_submenu_page('edit.php?post_type=product', 'edit-tags.php?taxonomy=dry&amp;post_type=product');
        remove_submenu_page('edit.php?post_type=product', 'edit-tags.php?taxonomy=normal_combination&amp;post_type=product');
        remove_submenu_page('edit.php?post_type=product', 'edit-tags.php?taxonomy=normal_dry&amp;post_type=product');
        remove_submenu_page('edit.php?post_type=product', 'edit-tags.php?taxonomy=oily&amp;post_type=product');
        remove_submenu_page('edit.php?post_type=product', 'edit-tags.php?taxonomy=male_acne&amp;post_type=product');
        remove_submenu_page('edit.php?post_type=product', 'edit-tags.php?taxonomy=male_combination_oily&amp;post_type=product');
        remove_submenu_page('edit.php?post_type=product', 'edit-tags.php?taxonomy=recommendation_type&amp;post_type=product');
        remove_submenu_page('edit.php?post_type=product', 'edit-tags.php?taxonomy=male_dry&amp;post_type=product');
        remove_submenu_page('edit.php?post_type=product', 'edit-tags.php?taxonomy=male_normal_combination&amp;post_type=product');
        remove_submenu_page('edit.php?post_type=product', 'edit-tags.php?taxonomy=male_normal_dry&amp;post_type=product');
        remove_submenu_page('edit.php?post_type=product', 'edit-tags.php?taxonomy=male_oily&amp;post_type=product');
    }
} 
add_action( 'admin_menu', 'tw_remove_menu_pages', 999 );



/* Only show WordPress update nag to admins */
function jp_proper_update_nag() {
  if ( !current_user_can( 'manage_options' ) ) {
    remove_action ( 'admin_notices', 'update_nag', 3 );
  }
}
add_action ( 'admin_notices', 'jp_proper_update_nag', 1 );



/**
* Merge Tags as Dynamic Population Parameters
* http://gravitywiz.com/2012/05/22/dynamic-products-via-post-meta/
*/

add_filter('gform_pre_render', 'gform_prepopluate_merge_tags');
function gform_prepopluate_merge_tags($form) {

    $filter_names = array();

    foreach($form['fields'] as &$field) {

        if(!rgar($field, 'allowsPrepopulate'))
            continue;

        // complex fields store inputName in the "name" property of the inputs array
        if(is_array(rgar($field, 'inputs')) && $field['type'] != 'checkbox') {
            foreach($field['inputs'] as $input) {
                if(rgar($input, 'name'))
                    $filter_names[] = array('type' => $field['type'], 'name' => rgar($input, 'name'));
            }
        } else {
            $filter_names[] = array('type' => $field['type'], 'name' => rgar($field, 'inputName'));
        }

    }

    foreach($filter_names as $filter_name) {

        $filtered_name = GFCommon::replace_variables_prepopulate($filter_name['name']);

        if($filter_name['name'] == $filtered_name)
            continue;

        add_filter("gform_field_value_{$filter_name['name']}", create_function("", "return '$filtered_name';"));
    }

    return $form;
}


function my_connection_types_products() {
    /*
    p2p_register_connection_type( array(
        'name' => 'product-product',
        'from' => 'product',
        'to' => 'product',
        'reciprocal' => true,
        'title' => 'Full Size-Sample Link',
        'cardinality' => 'one-to-one'
        ) 
    );
    */

    p2p_register_connection_type( array(
        'name' => 'treatment-product',
        'from' => 'treatments',
        'to' => 'product',
        'reciprocal' => true,
        'title' => 'Related Products & Treatments',
        'cardinality' => 'many-to-many'
        ) 
    );

}
add_action( 'p2p_init', 'my_connection_types_products' );







add_action('init', 'mbm_add_post_type_support');
function mbm_add_post_type_support() {
add_post_type_support( 'sm-location', array( 'thumbnail' ) );
add_post_type_support( 'shop_coupon', array( 'custom-fields' ) );
}


// add favicon to site, add 16x16 or 32x32 .ico or .png image to child themes main folder
function childtheme_add_favicon() { ?>
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
<?php }
add_action('wp_head', 'childtheme_add_favicon');



// add a header aside widget, currently set up to be inside the #branding div
function childtheme_add_header_widget($content) {
    $content['Header Aside Widget'] = array(
        'admin_menu_order' => 2,
        'args' => array (
        'name' => 'Header Aside',
        'id' => 'header-aside-widget',
        'description' => __('The widget area in the header.', 'thematic'),
        'before_widget' => thematic_before_widget(),
        'after_widget' => thematic_after_widget(),
        'before_title' => thematic_before_title(),
        'after_title' => thematic_after_title(),
            ),
        'action_hook'   => 'thematic_header',
        'function'      => 'childtheme_header_aside_widget',
        'priority'      => 6
        );
    return $content;
}
add_filter('thematic_widgetized_areas', 'childtheme_add_header_widget');


// set structure for the header aside widget
function childtheme_header_aside_widget() {
    if ( is_active_sidebar('header-aside-widget') ) {
        echo thematic_before_widget_area('header-widget');
        dynamic_sidebar('header-aside-widget');
        echo thematic_after_widget_area('header-widget');
    }
}


// set structure for the 4th subsidiary aside, footer widget (#footer-widget)
// this is modified from the original by adding the .sub-wrapper, super hacky!
function childtheme_4th_subsidiary_aside() {
    if ( is_active_sidebar('4th-subsidiary-aside') ) {
        echo thematic_before_widget_area('footer-widget');
        dynamic_sidebar('4th-subsidiary-aside');
        echo thematic_after_widget_area('footer-widget');
    }
    echo "\n" . '</div><!-- .sub-wrapper -->' . "\n";
}
// open the sub-wrapper, super hacky!
function childtheme_subsidiary_wrapper_div () { ?>
    <div class="sub-wrapper">
<?php }
add_action('thematic_footer', 'childtheme_subsidiary_wrapper_div');



// hide unused widget areas inside the WordPress admin
function childtheme_hide_areas($content) {
    unset($content['Index Top']);
    unset($content['Index Insert']);
    unset($content['Index Bottom']);
    unset($content['Single Top']);
    unset($content['Single Insert']);
    unset($content['Single Bottom']);
    unset($content['Page Top']);
    unset($content['Page Bottom']);
    return $content;
}
add_filter('thematic_widgetized_areas', 'childtheme_hide_areas');



/*-----------------------------------------------------------------------------------*/
/* Remove Unwanted Admin Menu Items */
/*-----------------------------------------------------------------------------------*/

function remove_admin_menu_items() {
    
    if ( ! current_user_can('administrator') ) {
        $remove_menu_items = array(__('Links'), __('Posts'), __('Comments'), __('Tools'), __('Appearance'));
        }
    
    else{
        // $remove_menu_items = array(__('Links'), __('Posts'), __('Comments'));
        $remove_menu_items = array(__('Links'));
        }
        
        global $menu;
        end ($menu);
        while (prev($menu)){
            $item = explode(' ',$menu[key($menu)][0]);
            if(in_array($item[0] != NULL?$item[0]:"" , $remove_menu_items)){
            unset($menu[key($menu)]);}
        }       
}
add_action('admin_menu', 'remove_admin_menu_items');




// register additional custom menu slot
function childtheme_register_menus() {
    if ( function_exists( 'register_nav_menu' )) {
        register_nav_menu( 'footer_menu', 'Footer Menu' );
        register_nav_menu( 'about_gdc', 'About GdC Menu' );
    }
}
add_action('thematic_child_init', 'childtheme_register_menus');



// remove user agent sniffing from thematic theme
// this is what applies classes to the browser type and version body classes
function childtheme_show_bc_browser() {
    return FALSE;
}
add_filter('thematic_show_bc_browser', 'childtheme_show_bc_browser');





function childtheme_override_single_post() { 

            // action hook for insterting content above #post
            thematic_abovepost();
            ?>
        
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?> > 

            <?php

                // creating the post header
                thematic_postheader();
            ?>
                
                <div class="entry-content">
                
                    <?php 
                    if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                        the_post_thumbnail('banner');
                    }
                    echo '<br><br>';
                    thematic_content();

                    wp_link_pages(array('before' => sprintf('<div class="page-link">%s', __('Pages:', 'thematic')),
                                                'after' => '</div>')); ?>
                    
                </div><!-- .entry-content -->
                
                <?php thematic_postfooter(); ?>
                
            </div><!-- #post -->
    <?php
        // action hook for insterting content below #post
        thematic_belowpost();
}

function childtheme_override_category_loop() {
        while ( have_posts() ) : the_post(); 

                // action hook for insterting content above #post
                thematic_abovepost();
                ?>
    
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?> > 

                <?php

                    // creating the post header
                    thematic_postheader();
                ?>
                
                    <div class="entry-content">
                        
                        <?php thematic_content();
                        echo '<a class="button right" href="' . get_permalink()  . '">Read More</a>';
                         ?>
    
                    </div><!-- .entry-content -->
                    
                    <?php thematic_postfooter(); ?>
                    
                </div><!-- #post -->

            <?php 
                // action hook for insterting content below #post
                thematic_belowpost();
        
        endwhile;
    }





// had to add .title-wrap div around the titles, mostly for correct scaling on em paddings.
// also beefed up to add more robust style options with spans, which all around gives you tons of title styling options
function childtheme_override_page_title() {
    global $post;
        $content = "\t\t\t\t";
        $content .= '<div class="title-wrap">';
        if (is_attachment()) {
                $content .= '<h2 class="page-title"><span><a href="';
                $content .= apply_filters('the_permalink',get_permalink($post->post_parent));
                $content .= '" rev="attachment"><span class="meta-nav">&laquo; </span><span>';
                $content .= get_the_title($post->post_parent);
                $content .= '</span></a></span></h2>';
        } elseif (is_author()) {
                $content .= '<h1 class="page-title author"><span>';
                $author = get_the_author_meta( 'display_name', $post->post_author );
                $content .= __('Author Archives:', 'thematic');
                $content .= ' <span>';
                $content .= $author;
                $content .= '</span></span></h1>';
        } elseif (is_category()) {
                $content .= '<h1 class="page-title"><span>';
                $content .= __('Blog:', 'thematic');
                $content .= ' <span>';
                $content .= single_cat_title('', FALSE);
                $content .= '</span></span></h1>' . "\n";
                $content .= "\n\t\t\t\t" . '<div class="archive-meta">';
                if ( !(''== category_description()) ) : $content .= apply_filters('archive_meta', category_description()); endif;
                $content .= '</div>';
        } elseif (is_search()) {
                $content .= '<h1 class="page-title"><span>';
                $content .= __('Search Results for:', 'thematic');
                $content .= ' <span id="search-terms">';
                $content .= get_search_query();
                $content .= '</span></span></h1>';
        } elseif (is_tag()) {
                $content .= '<h1 class="page-title"><span>';
                $content .= __('Tag Archives:', 'thematic');
                $content .= ' <span>';
                $content .= ( single_tag_title( '', false ));
                $content .= '</span></span></h1>';
        } elseif (is_tax()) {
                global $taxonomy;
                $content .= '<h1 class="page-title"><span>';
                $tax = get_taxonomy($taxonomy);
                $content .= $tax->labels->singular_name . ' ';
                $content .= __('Archives:', 'thematic');
                $content .= ' <span>';
                $content .= thematic_get_term_name();
                $content .= '</span></span></h1>';
        } elseif (is_post_type_archive() && is_archive() ) {
                $content .= '<h1 class="page-title"><span>';
                $post_type_obj = get_post_type_object( get_post_type() );
                $post_type_name = $post_type_obj->labels->singular_name;
                $content .= __('Archives:', 'thematic');
                $content .= ' <span>';
                $content .= $post_type_name;
                $content .= '</span></span></h1>';
        } elseif (is_day()) {
                $content .= '<h1 class="page-title"><span>';
                $content .= sprintf(__('Daily Archives: <span>%s</span>', 'thematic'), get_the_time(get_option('date_format')));
                $content .= '</span></h1>';
        } elseif (is_month()) {
                $content .= '<h1 class="page-title"><span>';
                $content .= sprintf(__('Monthly Archives: <span>%s</span>', 'thematic'), get_the_time('F Y'));
                $content .= '</span></h1>';
        } elseif (is_year()) {
                $content .= '<h1 class="page-title"><span>';
                $content .= sprintf(__('Yearly Archives: <span>%s</span>', 'thematic'), get_the_time('Y'));
                $content .= '</span></h1>';
        }
        $content .= "\n";
        $content .= "</div> <!-- .title-wrap -->";
    echo apply_filters('thematic_page_title', $content);
}



// completely remove nav above functionality
function childtheme_override_nav_above() {
    // silence
}



// cuts the default size of the search input field down to cut overlap
// css sizes this fine, but it could be placed in things other than aside, this is back up. ;)
function childtheme_thematic_search_form_length() {
    return "16";
}
add_filter('thematic_search_form_length', 'childtheme_thematic_search_form_length');

// change the default search box text
function childtheme_search_field_value() {
    return "Search";
}
add_filter('search_field_value', 'childtheme_search_field_value');



// kill the post header information, loading this below in the post footer
function childtheme_override_postheader_postmeta() {
    // silence!
}




// example of changing up the display of the entry-utility for a different look
function childtheme_override_postfooter() {
    $post_type = get_post_type();
    $post_type_obj = get_post_type_object($post_type);
    $tagsection = get_the_tags();

    // Display nothing for "Page" post-type
    if ( $post_type == 'page' ) {
        $postfooter = '';
    // For post-types other than "Pages" press on
    } else {
        $postfooter = '<footer class="entry-utility">';
        $postfooter .= '<ul class="main-utilities">';
        $postfooter .= '<li class="entypo-user">' . thematic_postmeta_authorlink() . '</li>';
        $postfooter .= '<li class="entypo-calendar">' . thematic_postmeta_entrydate() . '</li>';
        $postfooter .= '<li class="entypo-comment">' . thematic_postfooter_postcomments() . '</li>';
        $postfooter .= '</ul>';
        $postfooter .= '<ul class="sub-utilities">';
        $postfooter .= '<li class="entypo-folder">' . thematic_postfooter_postcategory() . '</li>';
            if ( $tagsection ) {
        $postfooter .= '<li class="entypo-tag">' . thematic_postfooter_posttags() . '</li>';
            }
            if ( is_user_logged_in() ) {
                $postfooter .= '<li class="entypo-pencil">' . thematic_postfooter_posteditlink() . '</li>';
            }
        $postfooter .= '</ul>';
        $postfooter .= "</footer><!-- .entry-utility -->\n";
    }
    // Put it on the screen
    // echo apply_filters( 'thematic_postfooter', $postfooter ); // Filter to override default post footer
}

function childtheme_postmeta_entrydate($entrydate) {
    $entrydate = '<span class="meta-prep meta-prep-entry-date">' . __('', 'thematic') . '</span>';
    $entrydate .= '<span class="entry-date">';
    $entrydate .= get_the_time( thematic_time_display() );
    $entrydate .= '</span>';
    return $entrydate;
}
add_filter('thematic_postmeta_entrydate', 'childtheme_postmeta_entrydate');

// remove unneeded code from postcategory
function childtheme_override_postfooter_postcategory() {
    $postcategory = '<span class="cat-links">';
    if ( is_category() && $cats_meow = thematic_cats_meow(', ') ) {
        $postcategory .= __('<span class="meta-prep meta-prep-category">Also posted in</span> ', 'thematic') . $cats_meow;
    } else {
        $postcategory .= __('<span class="meta-prep meta-prep-category">Posted in</span> ', 'thematic') . get_the_category_list(', ');
    }
    $postcategory .= '</span>';
    return apply_filters('thematic_postfooter_postcategory',$postcategory);
}

// remove unneeded code from posttags
function childtheme_override_postfooter_posttags() {
    if ( is_single() && !is_object_in_taxonomy( get_post_type(), 'category' ) ) {
        $tagtext = __('<span class="meta-prep meta-prep-tags">Tagged</span>', 'thematic');
        $posttags = get_the_tag_list("<span class=\"tag-links\"> $tagtext ",', ','</span> ');
    } elseif ( is_single() ) {
        $tagtext = __('<span class="meta-prep meta-prep-tags">Tagged</span>', 'thematic');
        $posttags = get_the_tag_list("<span class=\"tag-links\"> $tagtext ",', ','</span> ');
    } elseif ( is_tag() && $tag_ur_it = thematic_tag_ur_it(', ') ) {
        $posttags = '<span class="tag-links">' . __('<span class="meta-prep meta-prep-tags">Also tagged</span> ', 'thematic') . $tag_ur_it . '</span>' . "\n\n\t\t\t\t\t\t";
    } else {
        $tagtext = __('<span class="meta-prep meta-prep-tags">Tagged</span>', 'thematic');
        $posttags = get_the_tag_list("<span class=\"tag-links\"> $tagtext ",', ','</span>' . "\n\n\t\t\t\t\t\t");
    }
    return apply_filters('thematic_postfooter_posttags',$posttags);
}



// featured image size (on anything with excerpt)
function childtheme_post_thumb_size($size) {
    $size = array(200,200);
    return $size;
}
add_filter('thematic_post_thumb_size', 'childtheme_post_thumb_size');

// super hacky way to remove width and height from images, better for slider... but I don't like this :P
// reference - css-tricks.com/snippets/wordpress/remove-width-and-height-attributes-from-inserted-images/
add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}


function childtheme_override_content() {
        global $thematic_content_length;
    
        if ( strtolower($thematic_content_length) == 'full' ) {
            $post = get_the_content( thematic_more_text() );
            $post = apply_filters('the_content', $post);
            $post = str_replace(']]>', ']]&gt;', $post);
        } elseif ( strtolower($thematic_content_length) == 'excerpt') {
            $post = '';
            $post .= get_the_excerpt();
            $post = apply_filters('the_excerpt',$post);
            if ( apply_filters( 'thematic_post_thumbs', TRUE) ) {
                $post_title = get_the_title();
                $size = 'banner';
                $attr = apply_filters( 'thematic_post_thumb_attr', array('title'    => sprintf( esc_attr__('Permalink to %s', 'thematic'), the_title_attribute( 'echo=0' ) ) ) );
                if ( has_post_thumbnail() ) {
                    $post = sprintf('<a class="entry-thumb" href="%s" title="%s">%s</a>',
                                    get_permalink() ,
                                    sprintf( esc_attr__('Permalink to %s', 'thematic'), the_title_attribute( 'echo=0' ) ),
                                    get_the_post_thumbnail(get_the_ID(), $size, $attr)) . $post;
                    }
            }
        } elseif ( strtolower($thematic_content_length) == 'none') {
            $post= '';      
        } else {
            $post = get_the_content( thematic_more_text() );
            $post = apply_filters('the_content', $post);
            $post = str_replace(']]>', ']]&gt;', $post);
        }
        echo apply_filters('thematic_post', $post);
    }


// override the index loop and remove the sticky posts, which will now be handled by the slider
function childtheme_override_index_loop() {
        
    // Count the number of posts so we can insert a widgetized area
    $count = 1;
    while ( have_posts() ) : the_post();

            // action hook for inserting content above #post
            thematic_abovepost();
            ?>

            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?> > 

            <?php

                // creating the post header
                thematic_postheader();
            ?>
                
                <div class="entry-content">
                
                    <?php 
                    thematic_content();
                    echo '<a class="button right" href="' . get_permalink()  . '">Read More</a>';
                    ?>

                    <?php wp_link_pages(array('before' => sprintf('<div class="page-link">%s', __('Pages:', 'thematic')),
                                                'after' => '</div>')); ?>
                
                </div><!-- .entry-content -->
                
                <?php thematic_postfooter(); ?>
                
            </div><!-- #post -->

        <?php 
            // action hook for insterting content below #post
            thematic_belowpost();
            
            comments_template();

            if ( $count == thematic_get_theme_opt( 'index_insert' ) ) {
                get_sidebar('index-insert');
            }
            $count = $count + 1;
    endwhile;   
}



function childtheme_override_content_init() {
        global $thematic_content_length;
        
        $content = '';
        $thematic_content_length = '';
        
        if (is_home() || is_front_page()) { 
            $content = 'excerpt';
        } elseif (is_single()) {
            $content = 'full';
        } elseif (is_tag()) {
            $content = 'excerpt';
        } elseif (is_search()) {
            $content = 'excerpt';   
        } elseif (is_category()) {
            $content = 'excerpt';
        } elseif (is_author()) {
            $content = 'excerpt';
        } elseif (is_archive()) {
            $content = 'excerpt'; 
        }
        
        $thematic_content_length = apply_filters('thematic_content', $content);
        
    }



// kill access and add some new code to be used with the jQuery drop down menu
function childtheme_override_access() { ?>
    <div id="access">
        <div class="menu-button"><span class="menu-title">Menu</span><div class="button"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></div></div>
        <div class="access-nav" role="navigation">
           <?php
            if ( ( function_exists("has_nav_menu") ) && ( has_nav_menu( apply_filters('thematic_primary_menu_id', 'primary-menu') ) ) ) {
                echo  wp_nav_menu(thematic_nav_menu_args());
            } else {
                echo  thematic_add_menuclass(wp_page_menu(thematic_page_menu_args()));
            }
            ?>
        </div>
    </div><!-- #access -->
    <?php
}



// add class "has-flyout" to items with sub menus, for indicator arrows
// reference - codex.wordpress.org/Function_Reference/wp_nav_menu
function add_menu_parent_class( $items ) {
    $parents = array();
    foreach ( $items as $item ) {
        if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
            $parents[] = $item->menu_item_parent;
        }
    }
    foreach ( $items as $item ) {
        if ( in_array( $item->ID, $parents ) ) {
            $item->classes[] = 'has-flyout';
        }
    }
    return $items;
}
add_filter( 'wp_nav_menu_objects', 'add_menu_parent_class' );



function is_subpage() {
    global $post;                              // load details about this page

    if ( is_page() && $post->post_parent ) {   // test to see if the page has a parent
        return $post->post_parent;             // return the ID of the parent post

    } else {                                   // there is no parent so ...
        return false;                          // ... the answer to the question is false
    }
} 
?>