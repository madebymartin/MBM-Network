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




//Remove Jigoshop Breadcrumbs
remove_action( 'jigoshop_before_main_content', 'jigoshop_breadcrumb', 20, 0);



//Customise the shop emails content-------------------------------------
//remove_action('order_status_completed', 'jigoshop_completed_order_customer_notification');

//add_action('order_status_completed', 'ucw_completed_order_customer_notification');

//include ('ucw_emails.php');






// Add Ingredients Tab & Panel To Jigoshop Products
add_action('jigoshop_product_tabs', 'ingredients_tab');
add_action('jigoshop_product_tab_panels', 'ingredient_panel');

/**
 * Ingredients tabs
 **/
if (!function_exists('ingredients_tab')) {
    function ingredients_tab( $current_tab ) {

	if ( get_post_meta(get_the_ID(), "_cmb_product_ingredients", true) ) {
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


		if ( get_post_meta(get_the_ID(), "_cmb_product_ingredients", true) ) {

        echo '<div class="panel" id="tab_ingredients">';
		echo '<p>' . get_post_meta(get_the_ID(), "_cmb_product_ingredients", true). '</p>';
        echo '</div>';
    	}

		 else { ?><span></span><?php }
	}
}



// Remove Additional Information Tab & Panel From Jigoshop Products
remove_action( 'jigoshop_product_tabs', 'jigoshop_product_attributes_tab', 20 );
remove_action( 'jigoshop_product_tab_panels', 'jigoshop_product_attributes_panel', 20 );





?>