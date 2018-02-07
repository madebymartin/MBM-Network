<?php
/**
 * RE-WRAP WOOCOMMERCE IN THEME CONTAINER & DECLARE WOO SUPPORT
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);
if ( ! function_exists( 'my_theme_wrapper_start' ) ) {
	function my_theme_wrapper_start() {
	  echo '<div id="primary" class="content-area"><main id="main" class="site-main" role="main">';
	}
}
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
if ( ! function_exists( 'my_theme_wrapper_end' ) ) {
	function my_theme_wrapper_end() {
	  echo '</main></div>';
	}
}
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}


if ( ! function_exists( 'mbm_woocommerce_product_archive_description' ) ) {
	function mbm_woocommerce_product_archive_description() {
		// Exact copy of WC template V2.5.0 with added div wrapper around div.page-description"
		if ( is_search() ) {
			return;
		}

		if ( is_post_type_archive( 'product' ) && 0 === absint( get_query_var( 'paged' ) ) ) {
			$shop_page   = get_post( wc_get_page_id( 'shop' ) );
			if ( $shop_page ) {
				$description = wc_format_content( $shop_page->post_content );
				if ( $description ) {
					echo '<div class="full-width"><div class="page-description">' . $description . '</div></div>';
				}

				?>
				<!-- <div class="overlay" onClick="style.pointerEvents='none'"></div> -->
				<div class="overlay"></div>
				<iframe id="base-location" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d158944.6980588048!2d-0.5928218639299498!3d51.50384219488371!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4876720df36c078b%3A0x4ae695ab1830cb08!2sWest+Drayton+UB7+9BW!5e0!3m2!1sen!2suk!4v1511301600651" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>

				<?php

			}
		}
	}
}

if ( ! function_exists( 'mbm_woocommerce_taxonomy_archive_description' ) ) {
	// Exact copy of WC template V2.5.0 with added div wrapper around div.page-description"
	function mbm_woocommerce_taxonomy_archive_description() {
		if ( is_product_taxonomy() && 0 === absint( get_query_var( 'paged' ) ) ) {
			$description = wc_format_content( term_description() );
			if ( $description ) {
				echo '<div class="full-width"><div class="term-description">' . $description . '</div></div>';
			}
		}
	}
}



if ( ! function_exists( 'mbm_woocommerce_gross_price' ) ) {
	// Exact copy of WC template V2.5.0 with added div wrapper around div.page-description"
	function mbm_woocommerce_gross_price() {
		$_product = wc_get_product( get_the_ID() );
		$gross_price = $_product->get_regular_price();
		$gross_price = number_format($gross_price, 2);
		echo '<span class="price"><i><small style="font-size:65%;">£' . $gross_price . ' (ex vat)</small></i><br><br></span>';
	}
}


add_action('init', 'mbm_remove_wc_actions');
if(!function_exists('mbm_remove_wc_actions')){
	function mbm_remove_wc_actions(){

		// top of archive page
		remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);
		remove_action('woocommerce_archive_description', 'woocommerce_product_archive_description', 10);
		remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
		remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
		remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);



		// product content

		// product link
		remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
		remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);

		// add to cart
		remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);


		if( isset($_POST['mbm_check_address'])){
			$data_arr = geocode($_POST['mbm_check_address']);
			if($data_arr){
		        $within_area = $data_arr[3];
		        if( $within_area == 'yes' ){
		        	// add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 11);
		        	add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
		        	// add_action('book_now_button', 'woocommerce_template_loop_add_to_cart', 10);
		        }
		    }
		}
		elseif( isset($_COOKIE['ls_in_area']) && $_COOKIE['ls_in_area'] == 'yes' ){
			// add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 11);
	    	add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
	    	// add_action('book_now_button', 'woocommerce_template_loop_add_to_cart', 10);

	    	
		}
		


		// if( isset($_POST['mbm_check_address']) || isset($_COOKIE['ls_in_area']) ){ add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 11); }
		// if( isset($_POST['mbm_check_address']) || isset($_COOKIE['ls_add']) ){ add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10); }
		
		// remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
		// add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 1);
		add_action('woocommerce_after_shop_loop_item_title', 'mbm_woocommerce_gross_price', 10);



		add_action('woocommerce_before_shop_loop_item_title', 'mbm_details_open', 99);

		add_action('woocommerce_after_shop_loop_item_title', 'mbm_modal', 12);

		add_action('woocommerce_after_shop_loop_item', 'mbm_details_close', 11);




		add_action('woocommerce_after_shop_loop', 'mbm_woocommerce_taxonomy_archive_description', 1);
		add_action('woocommerce_after_shop_loop', 'mbm_woocommerce_product_archive_description', 1);

	}
}

function mbm_details_open(){
	echo '<div class="details">';
}
function mbm_details_close(){
	echo '</div>';
}

if(!function_exists('mbm_skip_spec')){
	function mbm_skip_spec(){
		if( get_post_meta(get_the_ID(), 'mbm_vol_imp') ){ $vol_imp = get_post_meta(get_the_ID(), 'mbm_vol_imp', true) . 'yd<sup>3</sup>'; } else{ $vol_imp = '-'; }
		if( get_post_meta(get_the_ID(), 'mbm_vol_met') ){ $vol_met = get_post_meta(get_the_ID(), 'mbm_vol_met', true) . 'm<sup>3</sup>'; } else{ $vol_met = '-'; }
		if( get_post_meta(get_the_ID(), 'mbm_length_imp') ){ $length_imp = get_post_meta(get_the_ID(), 'mbm_length_imp', true); } else{ $length_imp = '-'; }
		if( get_post_meta(get_the_ID(), 'mbm_length_met') ){ $length_met = get_post_meta(get_the_ID(), 'mbm_length_met', true) . 'm'; } else{ $length_met = '-'; }
		if( get_post_meta(get_the_ID(), 'mbm_width_imp') ){ $width_imp = get_post_meta(get_the_ID(), 'mbm_width_imp', true); } else{ $width_imp = '-'; }
		if( get_post_meta(get_the_ID(), 'mbm_width_met') ){ $width_met = get_post_meta(get_the_ID(), 'mbm_width_met', true) . 'm'; } else{ $width_met = '-'; }
		if( get_post_meta(get_the_ID(), 'mbm_height_imp') ){ $height_imp = get_post_meta(get_the_ID(), 'mbm_height_imp', true); } else{ $height_imp = '-'; }
		if( get_post_meta(get_the_ID(), 'mbm_height_met') ){ $height_met = get_post_meta(get_the_ID(), 'mbm_height_met', true) . 'm'; } else{ $height_met = '-'; }
		if( get_post_meta(get_the_ID(), 'mbm_bins') ){ $bins = get_post_meta(get_the_ID(), 'mbm_bins', true); } else{ $bins = '-'; }


		echo '<div class="row"><span class="spec">Volume:</span>' . $vol_imp . ' <small>('. $vol_met .')</small></div>';
		echo '<div class="row"><span class="spec">Length:</span>' . $length_imp . ' <small>('. $length_met .')</small></div>';
		echo '<div class="row"><span class="spec">Width:</span>' . $width_imp . ' <small>('. $width_met .')</small></div>';
		echo '<div class="row"><span class="spec">Height:</span>' . $height_imp . ' <small>('. $height_met .')</small></div>';
		
		echo '<div class="row bags"><span class="spec binbags"><img class="icon" src="'. get_stylesheet_directory_uri() .'/img/bag.png" alt="bin">: x'. $bins .' <small> approx</small></span>';
		// for ($i=0; $i < $bins; $i++) { echo '<img class="icon" src="'. get_stylesheet_directory_uri() .'/img/bag.png" alt="bin">'; }
		echo '</div>';

	}
}




function mbm_modal(){
	$id = get_the_ID();
	echo '    <div class="effeckt-modal-wrap md-effect-8" id="modal-'. $id .'" style="display: block;"> <!-- for centering transform -->
      <div class="effeckt-modal" id="effeckt-modal">
        <h3>'. get_the_title($id) .'</h3>
        <div class="effeckt-modal-content">';
        mbm_skip_spec();

        echo '</div>
      </div><button class="effeckt-modal-close"></button>';
      
      // echo '<div class="booknow">';
	     //  do_action('book_now_button');
      // echo'</div>';
      echo '</div>';
      echo '<div class="effeckt-overlay" id="effeckt-overlay"></div> 
    <!-- overlay coming after is important for ~ selector -->
    <div class="effeckt-overlay no-transitions" id="effeckt-overlay"></div>
	<br><button class="modal2-button showmodal" data-modal-type="modal-8" data-modal="modal-'. $id .'">Show Details</button>';

}









// change add to cart button text on single product
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text' );    // 2.1 +
function woo_custom_cart_button_text() {
        return __( 'Hire This Skip', 'woocommerce' );
}

// change add to cart button text on archive pages
add_filter( 'woocommerce_product_add_to_cart_text', 'woo_archive_custom_cart_button_text' );    // 2.1 +
function woo_archive_custom_cart_button_text() {
        return __( 'Hire This Skip', 'woocommerce' );
}




//skip cart - staright to checkout
add_filter('woocommerce_add_to_cart_redirect', 'mbm_add_to_cart_redirect');
function mbm_add_to_cart_redirect() {
 global $woocommerce;
 $checkout_url = $woocommerce->cart->get_checkout_url();
 return $checkout_url;
}

add_filter ( 'wc_add_to_cart_message_html', 'wc_add_to_cart_message_filter', 10, 2 );
function wc_add_to_cart_message_filter($message, $products) {

	$message = 'Your ';
	foreach ($products as $product_id => $qty) {
		$message .= get_the_title($product_id);
	}
	$message .= ' is ready to book, please choose a delivery date.';

    // $titles[] = get_the_title( $product_id );

    // $titles = array_filter( $titles );
    // $added_text = sprintf( _n( '%s has been added to your cart.', '%s have been added to your cart.', sizeof( $titles ), 'woocommerce' ), wc_format_list_of_items( $titles ) );

    // $message = sprintf( '%s <a href="%s" class="button">%s</a>&nbsp;<a href="%s" class="button">%s</a>',
    //              $message =   esc_html( $added_text ),
    //                 esc_url( wc_get_page_permalink( 'checkout' ) ),
    //                 esc_html__( 'Checkout', 'woocommerce' ),
    //                 esc_url( wc_get_page_permalink( 'cart' ) ),
    //                 esc_html__( 'View Cart', 'woocommerce' ));

    // $message = 'Your ' . wc_format_list_of_items( $titles ) . ' is ready to book, please choose a delivery date.';

    return $message;
}







/* Redirect single product page back to home page */
add_action('template_redirect', 'mbm_redirect_single_to_home');
if ( ! function_exists( 'mbm_redirect_single_to_home' ) ) {
	function mbm_redirect_single_to_home() {
		if(is_product()){
			$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
			wp_redirect($shop_page_url);
			exit;
		}
	}
}


























if(!function_exists('mbm_get_distance')){
	function mbm_get_distance($lat=null, $lng=null){
		if( $lat != null && $lng != null ){
			$base_lat = '51.45647';
			$base_lng = '-0.41735';
            $theta = $lng - $base_lng;
            $dist = sin(deg2rad($lat)) * sin(deg2rad($base_lat)) +  cos(deg2rad($lat)) * cos(deg2rad($base_lat)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            // $unit = strtoupper($unit);
            $mbm_miles = round($miles, 0);
            return $mbm_miles;
		}
		else{ return false; }
	}
}


if(!function_exists('is_within_catchment_area')){
	function is_within_catchment_area($lat=null, $lng=null){
		if( $lat != null && $lng != null ){

			if(mbm_get_distance($lat, $lng)){
				$allowed_radius = 20;
				$distance = mbm_get_distance($lat, $lng);
				if($distance <= $allowed_radius){ return true; }
	        	else{ return false; }
			}    
		}
		else{ return false; }
		
	}
}



add_action('init', 'mbm_set_location_cookie');
if(!function_exists('mbm_set_location_cookie')){
	function mbm_set_location_cookie(){
		if( !is_checkout() && isset($_POST['mbm_check_address']) ){
			$data_arr = geocode($_POST['mbm_check_address']);
			if($data_arr){
		        $latitude = $data_arr[0];
		        $longitude = $data_arr[1];
		        $formatted_address = $data_arr[2];
		        $formatted_address = substr($formatted_address, 0, -4);
		        $within_area = $data_arr[3];

		        setcookie('ls_lat', $latitude, time()+1209600, '/', null, false);
		        setcookie('ls_lng', $longitude, time()+1209600, '/', null, false);
		        setcookie('ls_add', $formatted_address, time()+1209600, '/', null, false);
		        setcookie('ls_in_area', $within_area, time()+1209600, '/', null, false);

		    	if( is_within_catchment_area($latitude, $longitude) ){ 
		    		$notice = 'Great, we have skips available in ' . $formatted_address . ', please choose your skip size.';
		    		wc_add_notice($notice, 'success');
		    	} else{ 
		    		$notice = 'Sorry, nothing available in ' . $formatted_address . '. Please try a different address';
		    		wc_add_notice($notice, 'error');
		    	}

		    }
			
		}
	}
}










if(!function_exists('mbm_location_search')){
	function mbm_location_search(){

		if(is_shop()){


			?>
			<div class="locationsearch">
				<?php

				if( isset($_POST['mbm_check_address']) ){
	 
				    // get latitude, longitude and formatted address
				    $data_arr = geocode($_POST['mbm_check_address']);
				 
				    // if able to geocode the address
				    if($data_arr){
				         
				        $latitude = $data_arr[0];
				        $longitude = $data_arr[1];
				        $formatted_address = $data_arr[2];
				        $formatted_address = substr($formatted_address, 0, -4);
				        $placeholder = $formatted_address;
				        if(is_within_catchment_area($latitude, $longitude)){ $status = 'yes'; }else{ $status = 'no'; }

				    }else{
				        echo '<img class="start" src="'. get_stylesheet_directory_uri() .'/img/start.png" alt="TO BOOK A SKIP, PLEASE ENTER A POSTCODE TO CHECK AVAILABILITY">';
				        $status = 'transparent';
				        $placeholder = 'Enter Postcode'; 
				    }
				    
				}
				elseif (isset($_COOKIE['ls_add'])) { 
					$placeholder = $_COOKIE['ls_add']; 
					$latitude = $_COOKIE['ls_lat'];
			        $longitude = $_COOKIE['ls_lng'];
			        if(is_within_catchment_area($latitude, $longitude)){ $status = 'yes'; }else{ $status = 'no'; }
				}else{ 
					$placeholder = 'Enter Postcode'; 
					$latitude = '';
			        $longitude = '';
			        $status = 'transparent';
			        echo '<img class="start" src="'. get_stylesheet_directory_uri() .'/img/start.png" alt="TO BOOK A SKIP, PLEASE ENTER A POSTCODE TO CHECK AVAILABILITY">';
				}


				?>
				
				<form action="" method="POST" class="address">
					<?php
					echo '<input class="checklocation" size="30" type="text" name="mbm_check_address" value="'. $placeholder .'" style="background-image:url('. get_stylesheet_directory_uri() .'/img/'. $status .'.png);" />';
					?>
				    <input class="check" type='submit' value='Check' />


				</form>
			</div>
			<?php












		}
	}
}




























// add_action('woocommerce_before_main_content', 'mbm_postcode_geocoder');
if(!function_exists('mbm_postcode_geocoder')){
	function mbm_postcode_geocoder(){

		?>
		<form action="" method="POST" class="address">
		    <input size='30' type='text' name='mbm_check_address' placeholder='Enter Postcode' />
		    <input type='submit' value='Check' />
		</form>
		<?php

		if($_POST){
 
		    // get latitude, longitude and formatted address
		    $data_arr = geocode($_POST['mbm_check_address']);
		 
		    // if able to geocode the address
		    if($data_arr){
		         
		        $latitude = $data_arr[0];
		        $longitude = $data_arr[1];
		        $formatted_address = $data_arr[2];
		                     
			    ?>
			 
			    <!-- google map will be shown here -->
			    <div id="gmap_canvas">Loading map...</div>
<!-- 			    <div id='map-label'>Map shows approximate location.</div>
 -->			 
			    <!-- JavaScript to show google map -->
<!-- 			    <script async="" defer="" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCH7wbp0YNzfPQuUddWBYNo3tZQpgysAXU" type="text/javascript"></script>
 -->			    
			    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCH7wbp0YNzfPQuUddWBYNo3tZQpgysAXU" type="text/javascript"></script>
 				<script type="text/javascript">
			        function init_map() {
			            var myOptions = {
			                zoom: 14,
			                scrollwheel: false,
			                center: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>),
			                mapTypeId: google.maps.MapTypeId.ROADMAP
			            };
			            map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
			            marker = new google.maps.Marker({
			                map: map,
			                position: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>)
			            });
			            infowindow = new google.maps.InfoWindow({
			                content: "<?php echo $formatted_address; ?>"
			            });
			            google.maps.event.addListener(marker, "click", function () {
			                infowindow.open(map, marker);
			            });
			            infowindow.open(map, marker);
			        }
			        google.maps.event.addDomListener(window, 'load', init_map);
			    </script>
			 
			    <?php
	            echo '<pre>';
			    	print_r($data_arr);
			    	if( mbm_get_distance($latitude, $longitude) ){ echo 'Distance: ' . mbm_get_distance($latitude, $longitude) . ' miles<hr>';}
			    	if( is_within_catchment_area($latitude, $longitude) ){ echo 'This IS WITHIN our delivery zone, wahey!'; } else{ echo 'sorry, we don\'t deliver there :('; }
			    echo '</pre>';
		 
		    // if unable to geocode the address
		    }else{
		        echo "No map found.";
		    }
		    
		}
		// else{echo 'please enter location';}

	}
}










if(!function_exists('geocode')){
	// function to geocode address, it will return false if unable to geocode address
	function geocode($address){
	 
	    // url encode the address
	    $address = urlencode($address);
	     
	    // google map geocode api url
	    $url = "https://maps.google.co.uk/maps/api/geocode/json?address={$address}";
	 
	    // get the json response
	    $resp_json = file_get_contents($url);

	    // decode the json
	    $resp = json_decode($resp_json, true);
	    
	    // response status will be 'OK', if able to geocode given address 
	    if($resp['status']=='OK'){
	 
	        // get the important data
	        $lati = $resp['results'][0]['geometry']['location']['lat'];
	        $longi = $resp['results'][0]['geometry']['location']['lng'];
	        $formatted_address = $resp['results'][0]['formatted_address'];
	        if(is_within_catchment_area($lati, $longi)){ $within_area = 'yes'; } else{ $within_area = 'no'; }

	        // verify if data is complete
	        if($lati && $longi && $formatted_address){

	            // put the data in the array
	            $data_arr = array(); 

	            array_push(
	                $data_arr, 
	                    $lati, 
	                    $longi, 
	                    $formatted_address,
	                    $within_area
	                );

	            return $data_arr;
	             
	        }else{
	            return false;
	        }
	         
	    }else{
	        return false;
	    }
	}
}





































add_filter( 'woocommerce_show_page_title' , 'mbm_hide_page_title' );
function mbm_hide_page_title() {
	return false;
}



add_filter( 'woocommerce_product_tabs', 'wcs_woo_remove_reviews_tab', 98 );
    function wcs_woo_remove_reviews_tab($tabs) {
    unset($tabs['reviews']);
    return $tabs;
}














// http://stackoverflow.com/questions/35018044/adding-a-datepicker-to-woocommerce-checkout-page

// ADD Custom Fields to Checkout Page
/**
 * Add the field to the checkout
 **/

add_action('woocommerce_checkout_before_customer_details', 'my_custom_checkout_field', 1);

function my_custom_checkout_field( $checkout ) {

	global $woocommerce;
	$checkout = $woocommerce->checkout;
	$now_unix = time();
	$now = date('Y-m-d', $now_unix);
	$this_year = date('Y', $now_unix);
	$two_years = date('Y', strtotime('+2 years', strtotime($now)));

	echo '<div class="delivery-date center">
		<input id="mbm_delivery_date" name="mbm_delivery_date" type="text" data-lock="from" data-min-year="'. $this_year .'" data-max-year="'. $two_years .'" data-large-mode="true" data-large-default="true"></input>
		</div>';

/*    // date_default_timezone_set('London/Europe');
    $mydateoptions = array('' => __('Select DeliveryDate', 'woocommerce' )); 

    echo '<div id="deliverydate"><h3>'.__('Delivery Info').'</h3>';

   woocommerce_form_field( 'mbm_delivery_date', array(
        'type'          => 'text',
        'class'         => array('my-field-class form-row-wide'),
        'id'            => 'datepicker',
        'required'      => true,
        'label'         => __('Delivery Date'),
        'placeholder'       => __('Select Date'),
        'options'     =>   $mydateoptions
        ),$checkout->get_value( 'mbm_delivery_date' ));

    echo '</div>';

    */
    ?>
    
    <script>
	    jQuery(document).ready(function($) {
	        $('input#mbm_delivery_date').dateDropper();
	    });
	</script>
<?php

}

/**
 * Process the checkout
 **/
add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');
function my_custom_checkout_field_process() {
    global $woocommerce;

    // Check if set, if its not set add an error.
    if (!$_POST['mbm_delivery_date'])
         wc_add_notice( 'We need a <strong>Delivery Date</strong> ' . __( ' to book a skip for you.', 'woocommerce' ), 'error' );
}


/**
 * Update the order meta with field value
 **/
add_action('woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta');
function my_custom_checkout_field_update_order_meta( $order_id ) {
    if ($_POST['mbm_delivery_date']) update_post_meta( $order_id, 'DeliveryDate', esc_attr($_POST['mbm_delivery_date']));
}


// add_filter('woocommerce_email_order_meta_keys', 'mbm_woocommerce_email_order_meta_keys');
// function mbm_woocommerce_email_order_meta_keys( $keys ) {
//     $keys['Delivery Date'] = 'DeliveryDate';
//     return $keys;
// }


add_action( "woocommerce_email_before_order_table", "custom_woocommerce_email_after_order_table", 10, 1);
function custom_woocommerce_email_after_order_table( $order ) {
	$orig_date_format = get_post_meta( $order->id, "DeliveryDate", true );
	$time = strtotime($orig_date_format);
	$new_date_format = date('jS F Y', $time);
    echo '<h2 style="color: #6a1016; display: block; font-family: &quot;Helvetica Neue&quot;, Helvetica, Roboto, Arial, sans-serif; font-size: 18px; font-weight: bold; line-height: 130%; margin: 16px 0 8px; text-align: left;">Delivery Date: '. $new_date_format .'</h2>';
}







// https://pinakibisi.wordpress.com/2014/07/02/woocommerce-one-item-in-cart-at-a-time/
add_filter( 'woocommerce_add_cart_item_data', 'woo_custom_add_to_cart' );
function woo_custom_add_to_cart( $cart_item_data ) {

    global $woocommerce;
    $woocommerce->cart->empty_cart();

    // Do nothing with the data and return
    return $cart_item_data;
}






// Determine if it's an email using the WooCommerce email header
add_action( 'woocommerce_email_header', function(){ add_filter( "better_wc_email", "__return_true" ); } );

// Hide the WooCommerce Email header and footer
add_action( 'woocommerce_email_header', function(){ ob_start(); }, 1 );
add_action( 'woocommerce_email_header', function(){ ob_get_clean(); }, 100 );
add_action( 'woocommerce_email_footer', function(){ ob_start(); }, 1 );
add_action( 'woocommerce_email_footer', function(){ ob_get_clean(); }, 100 );

// Selectively apply WPBE template if it's a WooCommerce email
add_action( 'phpmailer_init', 'better_phpmailer_init', 20 );
function better_phpmailer_init( $phpmailer ){
	// this filter will return true if the woocommerce_email_header action has run
	if ( apply_filters( 'better_wc_email', false ) ){
		global $wp_better_emails;

		// Add template to message
		$phpmailer->Body = $wp_better_emails->set_email_template( $phpmailer->Body );

		// Replace variables in email
		$phpmailer->Body = apply_filters( 'wpbe_html_body', $wp_better_emails->template_vars_replacement( $phpmailer->Body ) );
	}
}





add_action( 'woocommerce_email_order_details', 'mbm_add_email_note', 10, 2 );
// add_action( 'woocommerce_before_email_order', 'mbm_add_email_note', 10, 2 );

function mbm_add_email_note( $order, $sent_to_admin ) {
  
  if ( ! $sent_to_admin ) {

  	echo '<h1>Thank you for your booking</h1><p>We will call shortly to confirm delivery details.</p><p>If we are unable to contact you, please call us on <b>07484 666299</b>.</p><p><br><hr style="border-color:#6A1016;"><b><span style="font-size:1.5rem;color:#6A1016;">IMPORTANT: </span>Your skip delivery will not be arranged until we have confirmed delivery with you.</b><hr style="border-color:#6A1016;"><br><br></p>';
 
    // if ( 'cod' == $order->payment_method ) {
    //   // cash on delivery method
    //   echo '<p><strong>Instructions:</strong> Full payment is due immediately upon delivery: <em>cash only, no exceptions</em>.</p>';
    // } else {
    //   // other methods (ie credit card)
    //   echo '<p><strong>Instructions:</strong> Please look for "Madrigal Electromotive GmbH" on your next credit card statement.</p>';
    // }
  }
}