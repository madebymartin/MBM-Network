<?php
// Add Shopping Info into Branding Div
function additional_branding_content() {
{ ?>

<!--
<div id="shoppinginfo">
	<div id="bagdetails">
		<div id="bagitems"> <a href="<?php echo jigoshop_cart::get_cart_url(); ?>">
		<?php echo sprintf(_n('%d item &ndash; ', '%d items &ndash; ', jigoshop_cart::$cart_contents_count, 'jigoshop'), jigoshop_cart::$cart_contents_count);
    	//echo jigoshop_cart::get_cart_total();
		?> in the shopping bag</a>
<a href="<?php echo get_permalink(11); ?>">Checkout</a>
<a class="" href="<?php echo get_permalink(7); ?>">My Account</a>
		</div>
	</div>
</div>
-->
<!-- our contact blurb ends here -->
<?php }

} // end of our new function childtheme_contact_blurb

// Now we add our new function to our Thematic Action Hook
add_action('thematic_header','additional_branding_content', 6);




// Change columns in related products output to 3
 remove_action( 'jigoshop_after_single_product_summary', 'jigoshop_output_related_products', 20);
add_action( 'jigoshop_after_single_product_summary', 'jigotheme_output_related_products', 20);
 
function jigotheme_output_related_products() {
    jigoshop_related_products(3,3); // 3 products, 3 columns
}


//Remove Jigoshop Breadcrumbs
//remove_action( 'jigoshop_before_main_content', 'jigoshop_breadcrumb', 20, 0);



//Customise the shop emails content-------------------------------------
remove_action('order_status_completed', 'jigoshop_completed_order_customer_notification');

add_action('order_status_completed', 'gdc_completed_order_customer_notification');

include ('gdc_emails.php');



//### Sale products shortcode #########################################################

function jigoshop_sale_products( $atts ) {
   
	extract(shortcode_atts(array(
		'per_page'					=> get_option('jigoshop_catalog_per_page'),
		'columns'					=> get_option('jigoshop_catalog_columns'),
		'orderby'					=> get_option('jigoshop_catalog_sort_orderby'),
		'order'						=> get_option('jigoshop_catalog_sort_direction'),
		'pagination'				=> false
	), $atts));
	
	$today = date('Y-m-d',time());
	$tomorrow = mktime(0, 0, 0, date("y"), date("m"), date("d")+1);
	$args = array(
		'post_type'     			=> 'product',
		'post_status'				=> 'publish',
		'ignore_sticky_posts'   	=> 1,
		'posts_per_page'			=> $per_page,
		'orderby'					=> $orderby,
		'order'						=> $order,
		'meta_query'				=> array(
				array(
						'key'		=> 'visibility',
						'value'		=> array( 'catalog', 'visible' ),
						'compare'	=> 'IN'
				),
				array(
						'key'		=> 'sale_price',
						'value'		=> '',
						'compare'	=> '!=',
				),
				array(
						'key'		=> 'sale_price_dates_from',
						'value'		=> $today,
						'compare'	=> '<=',
				),
				array(
						'key'		=> 'sale_price_dates_to',
						'value'		=> $tomorrow,
						'compare'	=> '<',
				),
		)
	);
	query_posts($args);
	ob_start();
	jigoshop_get_template_part( 'loop', 'shop' );
	if ( $pagination ) do_action( 'jigoshop_pagination' );
	wp_reset_query();
	return ob_get_clean();
}
add_shortcode('sale_products', 'jigoshop_sale_products');




// Add Ingredients Tab & Panel To Jigoshop Products
add_action('jigoshop_product_tabs', 'ingredients_tab');
add_action('jigoshop_product_tab_panels', 'ingredient_panel');

/**
 * Ingredients tabs
 **/
if (!function_exists('ingredients_tab')) {
    function ingredients_tab( $current_tab ) {

	if ( get_post_meta(get_the_ID(), "_cmb_ingredients", true) ) {
        ?>
        <li <?php if ($current_tab=='#tab_ingredients') echo 'class="active"'; ?>><a href="#tab_ingredients"><?php _e('Ingredients', 'jigoshop'); ?></a></li>
        <?php
}
    }
}

/**
 * Ingredients panel
 **/
if (!function_exists('ingredient_panel')) {
    function ingredient_panel() {


		if ( get_post_meta(get_the_ID(), "_cmb_ingredients", true) ) {

        echo '<div class="panel" id="tab_ingredients">';
		echo '<p>' . get_post_meta(get_the_ID(), "_cmb_ingredients", true). '</p>';
        echo '</div>';
    	}

		 else { ?><span></span><?php }
	}
}



// Remove Additional Information Tab & Panel From Jigoshop Products
remove_action( 'jigoshop_product_tabs', 'jigoshop_product_attributes_tab', 20 );
remove_action( 'jigoshop_product_tab_panels', 'jigoshop_product_attributes_panel', 20 );





?>