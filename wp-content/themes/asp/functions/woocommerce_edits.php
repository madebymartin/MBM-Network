<?php
// override the quantity input with a dropdown

function woocommerce_quantity_input( $args = array(), $product = null, $echo = true ) {
    global $product;

    if( !is_cart() ){
            $defaults = array(
            'input_name'    => 'quantity',
            'input_value'   => '1',
            'max_value'     => apply_filters( 'woocommerce_quantity_input_max', '', $product ),
            'min_value'     => apply_filters( 'woocommerce_quantity_input_min', '', $product ),
            'step'      => apply_filters( 'woocommerce_quantity_input_step', '1', $product ),
            'style'     => apply_filters( 'woocommerce_quantity_style', 'float:left; margin-right:10px;', $product )
        );
        if ( ! empty( $defaults['min_value'] ) )
            $min = $defaults['min_value'];
        else $min = 1;

        if ( ! empty( $defaults['max_value'] ) )
            $max = $defaults['max_value'];
        else $max = 10;

        if ( ! empty( $defaults['step'] ) )
            $step = $defaults['step'];
        else $step = 1;

        $options = '';
        for ( $count = $min; $count <= $max; $count = $count+$step ) {
            $options .= '<option value="' . $count . '">' . $count . '</option>';
        }
        echo '<div class="quantity_select" style="' . $defaults['style'] . '"><select name="' . esc_attr( $defaults['input_name'] ) . '" title="' . _x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ) . '" class="qty">' . $options . '</select></div>';
    }

    else{
        if ( is_null( $product ) )
            $product = $GLOBALS['product'];

            $defaults = array(
                'input_name'    => 'quantity',
                'input_value'   => '1',
                'max_value'     => apply_filters( 'woocommerce_quantity_input_max', '', $product ),
                'min_value'     => apply_filters( 'woocommerce_quantity_input_min', '', $product ),
                'step'          => apply_filters( 'woocommerce_quantity_input_step', '1', $product )
            );

            $args = apply_filters( 'woocommerce_quantity_input_args', wp_parse_args( $args, $defaults ), $product );

            ob_start();

            wc_get_template( 'global/quantity-input.php', $args );

            if ( $echo ) {
                echo ob_get_clean();
            } else {
                return ob_get_clean();
            }
    }

}





// SINGLE PRODUCT EDITS...


// REMOVE STUFF COMPLETELY
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
//remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );


// MOVE POSITION OF STANDARD STUFF
remove_action( 'woocommerce_before_single_product','wc_print_notices');
add_action( 'thematic_header','wc_print_notices', 10);


// ADD NEW STUFF
add_action('thematic_header','single_product_header_spacer', 11);
add_action( 'woocommerce_single_product_summary', 'ucw_product_bullets', 50 );
add_action( 'woocommerce_single_product_summary', 'facebook_like_widget', 55 );
//add_action( 'woocommerce_after_single_product_summary', 'ucw_sticky_product_nav', 1 );
add_action( 'woocommerce_after_single_product_summary', 'ucw_product_description', 10 );
add_action( 'woocommerce_after_single_product_summary', 'ucw_woocommerce_upsell_display', 40 );






// Wrap upsells in section class to limit width
function ucw_woocommerce_upsell_display(){
    /*
    echo '<section class="product-section">';
        woocommerce_upsell_display();
    echo '</section>';
    */
}

// add header spacer to increase its height
function single_product_header_spacer(){
    if( is_product() ){
        echo '<div class="spacer"></div>';
    }
}

// insert bullets added by humanmade cmb
function ucw_product_bullets(){
    if(get_post_meta( get_the_id(), '_cmb_product_benefits', false )){
        echo '<ul class="benefits">';
            $bullets = get_post_meta( get_the_id(), '_cmb_product_benefits', false );
            foreach ($bullets as $key => $bullet){
                echo '<li>' . $bullet . '</li>';
            }
        echo '</ul>';
    }
}


/*
// insert product sticky nav
function ucw_sticky_product_nav (){
    if( is_product() ){
        
        echo '<div id="sticky_product_nav">';
            echo '<div class="product-sticky-nav">';

                echo '<a href="#header">';
                    the_post_thumbnail( 'thumbnail', array('class' => 'stickythumb') );
                echo '</a>';

                echo '<ul class="productnav">';
                    echo '<li><a href="#description-section">Overview</a></li>';

                    // create link to each section anchor
                    if(get_post_meta( get_the_id(), '_cmb_page_section', false )){
                        $sections = get_post_meta( get_the_id(), '_cmb_page_section', false );

                        foreach ($sections as $key => $section){
                            $section_h1 = $section['_cmb_section_h1'];
                            $section_id = '#' . str_replace(' ', '-', $section_h1);
                            echo '<li class="mobilehide"><a href="' . $section_id . '">' . $section_h1 . '</a></li>'; 
                        }
                    }
                    echo '<li><a href="#reviews-section">Reviews</a></li>';
                echo '</ul>';

            woocommerce_template_single_add_to_cart();
        echo '</div></div>';

    }
}
*/





// insert main description (main content) wrapped in section class to limit width
function ucw_product_description(){
    global $product, $post;
    if ( $post->post_content ) {
        echo '<section class="product-section" id="description-section" itemprop="description">';
            the_content();
        echo '</section>';
    }
}







// WOOCOMMERCE PRODUCT ARCHIVE EDITS...

// MORE INFO SPAN - HIDDEN ON MOBILE
function ucw_more_info_span(){
    echo '<a class="button moreinfo desktophide" href="' . get_the_permalink() . '">More Info</a>';
}
//add_action( 'woocommerce_after_shop_loop_item', 'ucw_more_info_span', 15 );

// EXCERPT - HIDDEN ON MOBILE
function ucw_mobilehide_excerpt(){
    echo '<div class="mobilehide excerpt">';
        woocommerce_template_single_excerpt();
    echo '</div>';
}

// BULLETS - HIDDEN ON MOBILE
function ucw_product_bullets_mobilehide(){
    if(get_post_meta( get_the_id(), '_cmb_product_benefits', false )){
        echo '<ul class="benefits mobilehide">';
            $bullets = get_post_meta( get_the_id(), '_cmb_product_benefits', false );
            foreach ($bullets as $key => $bullet){
                echo '<li>' . $bullet . '</li>';
            }
        echo '</ul>';
    }
}



add_action( 'woocommerce_after_shop_loop_item', 'ucw_mobilehide_excerpt', 16 );
add_action( 'woocommerce_after_shop_loop_item', 'ucw_product_bullets_mobilehide', 15 );

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
//remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
//remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );







// USES YOAST SEO TITLE FOR GOOGLE FEED TITLES INSTEAD OF USING THE MAIN PRODUCT TITLE
function lw_woocommerce_gpf_title($title, $product_id) {
    return get_post_meta( $product_id, '_yoast_wpseo_title', true );
}
add_filter( 'woocommerce_gpf_title', 'lw_woocommerce_gpf_title', 10, 2);


?>