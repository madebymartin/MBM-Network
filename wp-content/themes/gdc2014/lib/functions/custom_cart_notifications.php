<?php
function gdc_promotions(){
global $woocommerce;
$woocommerce->cart->calculate_totals();
$cart = $woocommerce->cart;
$cart_contents = $cart->cart_contents;
$gdc_cart_subtotal = $cart->total;

	        $cross_sells = array();
	        $in_cart = array();

			
	// PROMOTIONS
			$loop = new WP_Query( array(
			'post_type' => 'promotion',
			'posts_per_page' => '-1',
			'orderby' => 'date',
			'order' => 'DESC'
			) ); 
			wp_reset_query();
			?>

			<div class="aside" style="margin-top:-1em;">
				<ul class="margin0 padding0">


				<?php

				foreach ( $cart_contents as $item ) {
					echo $item['product_id'] . '<br>';
					//print_r($item);
				}

				// ALL PROMOS
				while ( $loop->have_posts() ) : $loop->the_post();
				$promo_name = get_the_title();
				$promo_id = get_the_id();
				$promo_gift_id = get_post_meta( get_the_id(), '_cmb_promo_gift', true );
				$promo_required_spend = get_post_meta( get_the_id(), '_cmb_promo_required_spend', true );
				$promo_required_spend_remaining = $promo_required_spend - $gdc_cart_subtotal;
				$promo_required_spend_remaining_2dp = number_format($promo_required_spend_remaining, 2, '.', '');
				$promo_required_product_id = get_post_meta( get_the_id(), '_cmb_promo_required_product', true );
				$current_time = (int) current_time( 'timestamp' );
				$current_pretty_time = date_i18n( 'l j F Y',$current_time);
				$promo_start = get_post_meta( get_the_id(), '_cmb_promo_start_date', true );
				$promo_start_pretty = date_i18n( 'l j F Y',$promo_start);
				$promo_end = get_post_meta( get_the_id(), '_cmb_promo_end_date', true );
				$promo_end_pretty = date_i18n( 'l j F Y',$promo_end);
				//$_product = new woocommerce_product( $promo_required_product_id );
				//$prodprice = $_product->get_price_html();
				//$jigoshop_options = Jigoshop_Base::get_options();
				



				if (($promo_end > $current_time) && ($promo_start < $current_time)){
					echo '<br><br>promo name: ' . $promo_name . '<br>';
				}


				echo '<br><br>promo name: ' . $promo_name . '<br>';
				echo 'promo id: ' . $promo_id . '<br>';
				echo 'promo gift id: ' . $promo_gift_id . '<br>';
				echo 'req spend: ' . $promo_required_spend . '<br>';
				echo 'req spend remaining: ' . $promo_required_spend_remaining . '<br>';
				echo 'req spend remaining 2dp: ' . $promo_required_spend_remaining_2dp . '<br>';
				echo 'promo_required_product_id: ' . $promo_required_product_id . '<br>';
				echo 'current_time: ' . $current_time . '<br>';
				echo 'current_pretty_time: ' . $current_pretty_time . '<br>';
				echo 'promo_start: ' . $promo_start . '<br>';
				echo 'promo_start_pretty: ' . $promo_start_pretty . '<br>';
				echo 'promo_end: ' . $promo_end . '<br>';
				echo 'promo_end_pretty: ' . $promo_end_pretty . '<br>';






				endwhile;


				 // QUALIFIED PROMOS
				while ( $loop->have_posts() ) : $loop->the_post();
				/*
					$promo_name = get_the_title();
					$promo_id = get_the_id();
					$promo_gift_id = get_post_meta( get_the_id(), '_cmb_promo_gift', true );
					$promo_required_spend = get_post_meta( get_the_id(), '_cmb_promo_required_spend', true );
					$promo_required_spend_remaining = $promo_required_spend - $gdc_cart_subtotal;
					$promo_required_spend_remaining_2dp = number_format($promo_required_spend_remaining, 2, '.', '');
					$promo_required_product_id = get_post_meta( get_the_id(), '_cmb_promo_required_product', true );
					$current_time = (int) current_time( 'timestamp' );
					$current_pretty_time = date_i18n( 'l j F Y',$current_time);
					$promo_start = get_post_meta( get_the_id(), '_cmb_promo_start_date', true );
					$promo_start_pretty = date_i18n( 'l j F Y',$promo_start);
					$promo_end = get_post_meta( get_the_id(), '_cmb_promo_end_date', true );
					$promo_end_pretty = date_i18n( 'l j F Y',$promo_end);
					$_product = new woocommerce_product( $promo_required_product_id );
					$prodprice = $_product->get_price_html();
					$jigoshop_options = Jigoshop_Base::get_options();
					
					if (($promo_end > $current_time) && ($promo_start < $current_time)){
						if($promo_required_spend){ //Spend Promo
							if ($promo_required_spend_remaining > 0){ // NEED TO SPEND
							}
							else { // CONGRATULATIONS
								echo '<li class="product promotion qualified">';
								echo '<div class="excurpt"><p><img style="margin:0 0.35em 0 0;" width="20" src="' . get_stylesheet_directory_uri() . '/images/success2.png" alt="success">Congratulations! You will receive a free <a href="' . get_the_permalink($promo_gift_id) . '">' . get_the_title($promo_gift_id) . '</a> for spending over £' . $promo_required_spend . '</p></div>';
								echo '</li>';

							}
						}// End of Spend Promo

						else { // Product Promo
							foreach(jigoshop_cart::get_cart() as $item){
								if($item['product_id'] == $promo_required_product_id){
									$qualify = 'yes-' . $promo_id;
								}
								else{}
							} // end of foreach

							if($qualify == 'yes-' . $promo_id){ //QUALIFIES
								echo '<li class="product promotion qualified">';
									echo '<div class="excurpt"><p><img style="margin:0 0.35em 0 0;" width="20" src="' . get_stylesheet_directory_uri() . '/images/success2.png" alt="success">Congratulations! You will receive a free <a href="' . get_the_permalink($promo_gift_id) . '">' . get_the_title($promo_gift_id) . '</a> for buying <a href="' . get_the_permalink($promo_gift_id) . '">' . get_the_title($promo_required_product_id) . '</a></p></div>';
								echo '</li>';
							}
							else{ //DOESNT QUALIFY
							}
						} // end of Product Promo
					}
					*/
				endwhile; ?>



				<?php // NOT YET QUALIFIED PROMOS
				while ( $loop->have_posts() ) : $loop->the_post();
				/*
					$promo_name = get_the_title();
					$promo_id = get_the_id();
					$promo_gift_id = get_post_meta( get_the_id(), '_cmb_promo_gift', true );
					$promo_required_spend = get_post_meta( get_the_id(), '_cmb_promo_required_spend', true );
					$promo_required_spend_remaining = $promo_required_spend - $gdc_cart_subtotal;
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
								echo '<li class="product promotion">';
								echo '<h3>Spend just £' . $promo_required_spend_remaining_2dp . ' more for a free <a href="' . get_the_permalink($promo_gift_id) . '">' . get_the_title($promo_gift_id) . '</a></h3>';
//								echo 'Offer ends: ' . $promo_end_pretty;
								echo'<div class="main-product-image"><a href="' . esc_attr( get_permalink($promo_gift_id) ) . '" title="' . esc_attr( get_the_title() ) . '">';
		//						echo ( has_post_thumbnail($promo_gift_id) )
								echo get_the_post_thumbnail($promo_gift_id);
		//							: jigoshop_get_image_placeholder();
								echo '</a></div>';
								echo '<a class="button" href="' . get_permalink( '5793' ) . '">Continue Shopping</a>';
								echo '</li>';
							}
							else { // CONGRATULATIONS
							}
						}// End of Spend Promo




						else { // Product Promo
							foreach(jigoshop_cart::get_cart() as $item){
								if($item['product_id'] == $promo_required_product_id){
									$qualify = 'yes-' . $promo_id;
								}
								else{}
							} // end of foreach


							if($qualify == 'yes-' . $promo_id){
							}
							else{
								echo '<li class="product promotion">';
									echo '<h3>Free <a href="' . get_the_permalink($promo_gift_id) . '">' . get_the_title($promo_gift_id) . '</a> with purchase of <a href="' . get_the_permalink($promo_required_product_id) . '">' . get_the_title($promo_required_product_id) . '</a></h3>';
									echo'<div class="main-product-image"><a href="' . esc_attr( get_permalink() ) . '" title="' . esc_attr( get_the_title($promo_required_product_id) ) . '">';
									echo ( has_post_thumbnail() )
										? the_post_thumbnail('medium')
										: jigoshop_get_image_placeholder();
									echo '</a></div>';
									echo'<a href="'.esc_url($_product->add_to_cart_url()).'" class="button" rel="nofollow">Add to Bag ('.$prodprice.')</a>';
								echo '</li>';
							}
						} // end of Product Promo
					}
					*/
				endwhile; ?>



				</ul>
			</div>
<?php }










function gdc_free_shipping_notification(){
global $woocommerce;
$cart = $woocommerce->cart;
$cart_contents = $cart->cart_contents;
$gdc_cart_subtotal = $cart->subtotal;
$free_ship_settings = get_option( 'woocommerce_free_shipping_settings' );


$roles = array('trade_user');
$in_role = check_user_role($roles); 
if ($in_role) {$gdc_freeshipping_threshold_net = '62.50';}else{$gdc_freeshipping_threshold_net = $free_ship_settings['min_amount'];}


$gdc_freeshipping_threshold_tax = $gdc_freeshipping_threshold_net * 0.2;
$gdc_freeshipping_threshold = $gdc_freeshipping_threshold_net + $gdc_freeshipping_threshold_tax;
$gdc_freeshipping_threshold = number_format($gdc_freeshipping_threshold, 2, '.', '');
$gdc_need_to_spend = $gdc_freeshipping_threshold - $gdc_cart_subtotal;
$gdc_need_to_spend_2dp = number_format($gdc_need_to_spend, 2, '.', '');

/*
foreach ( $cart_contents as $item ) {
	echo $item['product_id'] . '<br>';
	//print_r($item);
}
*/
	if ( ! empty( $cart_contents )) :
		if ($gdc_cart_subtotal < $gdc_freeshipping_threshold){
			echo '<div class="aside"><div class="note">';
			//	echo 'FS threshold: ' . $gdc_freeshipping_threshold . '<br>';
			//	echo 'Amount working from: ' . $gdc_cart_subtotal . '<br>';
				echo '<h3><img style="margin:0 0.35em -0.35em 0;" width="22" src="' . get_stylesheet_directory_uri() . '/images/alert.png" alt="success">spend just £' . $gdc_need_to_spend_2dp . ' more for FREE SHIPPING</h3>';
			echo '</div></div>';
		} else{
			echo '<div class="aside"><div class="note">';
			//	echo 'FS threshold: ' . $gdc_freeshipping_threshold . '<br>';
			//	echo 'Amount working from: ' . $gdc_cart_subtotal . '<br>';
				echo '<h3><img style="margin:0 0.25em 0 0;" width="18" src="' . get_stylesheet_directory_uri() . '/images/success2.png" alt="success">Shipping for this order is FREE OF CHARGE</h3>';
			echo '</div></div>';
		}
	endif;

	if ( empty( $cart_contents )) :
		echo '<div class="aside"><div class="note">';
			echo '<h3>Free shipping on all orders over £' . $gdc_freeshipping_threshold .  '</h3>';
		echo '</div></div>';
	endif;

}









add_action('thematic_abovemainasides', 'gdc_customer_notifications');
function gdc_customer_notifications(){
	if ( is_plugin_active( 'woocommerce-dynamic-pricing/woocommerce-dynamic-pricing.php' ) ) {

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
			//	CUSTOMER DISCOUNT EXISTS FOR CURRENT USER - tell them!
				if ( is_page( 'shopping-bag' ) || is_page( 'cart' ) || is_page( '5' )){ 
					gdc_free_shipping_notification();
				}
			 // echo '<div class="aside"><div class="note">All products are discounted by 40%!</div></div';
			} else {
			// NO CUSTOMER DISCOUNT FOR CURRENT USER - show promotions
				if ( is_page( 'shopping-bag' ) || is_page( 'cart' ) || is_page( '5' )){ 
					gdc_free_shipping_notification();
					//gdc_promotions();
				}
			}

		endwhile ;		
	} else{
		// CUSTOMER DISCOUNTS PLUGIN NOT ACTIVE
		if ( is_cart()){ 
			gdc_free_shipping_notification();
			//gdc_promotions();
		}
	}
}
?>