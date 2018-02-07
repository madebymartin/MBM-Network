<?php
/**
 * Woocommerce Customisations file
 *
 *
 * @package Germaine_de_Capuccini
 */



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


/**
 * Add theme WC support Declaration
 */
add_action( 'after_setup_theme', 'woocommerce_support' );
if ( ! function_exists( 'woocommerce_support' ) ) {
	function woocommerce_support() {
	    add_theme_support( 'woocommerce' );
	}
}


/**
 * Re-wrap product images
 */
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action('woocommerce_before_shop_loop_item_title', 'mbm_woocommerce_template_loop_product_thumbnail', 10);
if ( ! function_exists( 'mbm_woocommerce_template_loop_product_thumbnail' ) ) {
	function mbm_woocommerce_template_loop_product_thumbnail() {
		echo '<div class="mbmimagewrapper">' . woocommerce_get_product_thumbnail() . '</div>';
	}
}


function mbm_cart_link(){
	global $woocommerce;
	echo '<a class="cart-contents" href="'. $woocommerce->cart->get_cart_url() .'" title="View shopping basket">'. $woocommerce->cart->cart_contents_count .'</a>';
}


add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	mbm_cart_link();

	$fragments['a.cart-contents'] = ob_get_clean();

	return $fragments;

}







// Remove Cross sells from cart page until it is improved
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' , 10 );


add_action('woocommerce_before_checkout_form','show_cart_summary',9);
// gets the cart template and outputs it before the form
function show_cart_summary( ) {
	// PUT THIS IN A SIDEBAR OR SOMETHING
  wc_get_template_part( 'cart/cart' );
}








/**
 * SINGLE PRODUCT
 */

/**
 * Insert div used by jQuery to move position of short description in DOM
 */
add_action( 'woocommerce_single_product_summary', 'mbm_mobile_product_description_holder', 41);
if ( ! function_exists( 'mbm_mobile_product_description_holder' ) ) {
	function mbm_mobile_product_description_holder() {
	    echo '<div id="mobile-description"></div>';
	}
}

/**
 * Insert div used by jQuery to move position of short description in DOM
 */
add_action( 'woocommerce_single_product_summary', 'mbm_desktop_product_description_holder', 29);
if ( ! function_exists( 'mbm_desktop_product_description_holder' ) ) {
	function mbm_desktop_product_description_holder() {
	    echo '<div id="desktop-description"></div>';
	}
}

/**
 * Insert div used by jQuery to move position of short description in DOM
 */
add_action( 'woocommerce_single_product_summary', 'mbm_mobile_product_image_holder', 11);
if ( ! function_exists( 'mbm_mobile_product_image_holder' ) ) {
	function mbm_mobile_product_image_holder() {
	    echo '<div id="mobile-product-images"></div>';
	}
}


/**
 * Insert wrapper around summary items
 */
add_action( 'woocommerce_before_single_product_summary', 'mbm_product_summary_wrappper_open', 19);
if ( ! function_exists( 'mbm_product_summary_wrappper_open' ) ) {
	function mbm_product_summary_wrappper_open() {
	    echo '<div class="product-summary">';
	}
}
add_action( 'woocommerce_after_single_product_summary', 'mbm_product_summary_wrappper_close', 1);
if ( ! function_exists( 'mbm_product_summary_wrappper_close' ) ) {
	function mbm_product_summary_wrappper_close() {
	    echo '</div>';
	}
}


/**
 * Insert div used by jQuery to move position of short description in DOM
 */
add_action( 'woocommerce_before_single_product_summary', 'mbm_desktop_product_image_holder', 20);
if ( ! function_exists( 'mbm_desktop_product_image_holder' ) ) {
	function mbm_desktop_product_image_holder() {
	    echo '<div id="desktop-product-images"></div>';
	}
}

/*
add_filter( 'woocommerce_product_tabs', 'woo_custom_description_tab', 98 );
function woo_custom_description_tab( $tabs ) {

	$tabs['description']['callback'] = 'woo_custom_description_tab_content';	// Custom description callback

	return $tabs;
}

function woo_custom_description_tab_content() {
	echo '<h2>Custom Description</h2>';
	echo '<p>Here\'s a custom description</p>';
}
*/




add_filter( 'woocommerce_product_tabs', 'woo_rename_tab', 98);
function woo_rename_tab($tabs) {
$tabs['description']['title'] = 'Details';
return $tabs;
}


/*   
*
*	Remove tabs
*
*/
add_filter( 'woocommerce_product_tabs', 'mbm_remove_additional_product_tabs', 98 );
function mbm_remove_additional_product_tabs( $tabs ) {
    //unset( $tabs['description'] );      	// Remove the description tab
    //unset( $tabs['reviews'] ); 			// Remove the reviews tab
    unset( $tabs['additional_information'] );  	// Remove the additional information tab
    return $tabs;
}




add_filter( 'woocommerce_product_tabs', 'mbm_additional_product_tabs' );
function mbm_additional_product_tabs( $tabs ) {
	
	$ingredients = get_post_meta(get_the_ID(), 'ingredients', true);
	$instructions = get_post_meta(get_the_ID(), 'instructions', true);
	$sample_id = get_post_meta(get_the_ID(), 'mbm_product_sample_id', true);
	// $linked_treatments = get_post_meta(get_the_ID(), 'mbm_product_related_treatment', true);
	$linked_treatments = p2p_type( 'product-treatment' )->get_connected( get_the_ID() );

	$product = new WC_Product(get_the_ID());
	$sku = $product->get_sku();
	$xml_url = "https://ww2.feefo.com/api/xmlfeedback?merchantidentifier=germaine-de-capuccini&protocol=https&mode=product&negativesanswered=true&sortby=date&order=asc&allcomments=True&since=year&vendorref=" . $sku;
	$xml = simplexml_load_file($xml_url);

	if( ! $xml ) { 
	// COULDNT GET THE XML FROM FEEFO
	} 
	else { 
		// SUCCESSFULLY GOT FEEFO XML FEED
		foreach ($xml as $feedback) {
			//echo $feedback->AVERAGE;
			if($feedback->AVERAGE){$average_rating_percent = $feedback->AVERAGE;}
			if($feedback->TOTALPRODUCTCOUNT){$review_count = $feedback->TOTALPRODUCTCOUNT;}
		}
		$average_rating_of_5 = $average_rating_percent/20;

		if( $review_count == '1' ){$rt = 'review';}
		elseif( $review_count > '1' ){$rt = 'reviews';}

		if( $review_count > 0 ){
			$tabs['reviews'] = array(
				'title' 	=> __( 'Reviews', 'woocommerce' ),
				'priority' 	=> 13,
				'callback' 	=> 'mbm_reviews_tab_contents'
			);
		}

	} 

	if( !empty($ingredients) ){
		$tabs['ingredients'] = array(
			'title' 	=> __( 'Ingredients', 'woocommerce' ),
			'priority' 	=> 12,
			'callback' 	=> 'mbm_ingredients_tab_contents'
		);
	}
	if( !empty($instructions) ){
		$tabs['instructions'] = array(
			'title' 	=> __( 'How to use', 'woocommerce' ),
			'priority' 	=> 11,
			'callback' 	=> 'mbm_instructions_tab_contents'
		);
	}
	if( !empty($sample_id) ){
		$tabs['sample'] = array(
			'title' 	=> __( 'Try a Sample', 'woocommerce' ),
			'priority' 	=> 15,
			'callback' 	=> 'mbm_sample_tab_contents'
		);
	}
	if($linked_treatments->have_posts()){
		$tabs['treatments'] = array(
			'title' 	=> __( 'Related Treatments', 'woocommerce' ),
			'priority' 	=> 14,
			'callback' 	=> 'mbm_treatments_tab_contents'
		);
	}
	if( !empty($linked_treatments) ){
		
	}

	return $tabs;
}




function mbm_treatments_tab_contents() {
	$linked_treatments = p2p_type( 'product-treatment' )->get_connected( get_the_ID() );
	

	if($linked_treatments->have_posts()){
		echo '<h2>Related Treatments</h2>';
		echo '<h3>You may like these treatments too</h3>';
		while( $linked_treatments->have_posts() ) : $linked_treatments->the_post();
			$id = get_the_ID();			
			echo '<a href="'. get_permalink($id) .'" title="'. get_the_title($id) .'">'. get_the_title($id) .'</a><br>';
		endwhile;
	}

}
function mbm_ingredients_tab_contents() {
	$ingredients = get_post_meta(get_the_ID(), 'ingredients', true);
	echo '<h2>Ingredients</h2>';
	echo $ingredients;
}
function mbm_instructions_tab_contents() {
	$instructions = get_post_meta(get_the_ID(), 'instructions', true);
	echo '<h2>Instructions</h2>';
	echo $instructions;
}
function mbm_sample_tab_contents() {
	$sample_id = get_post_meta(get_the_ID(), 'mbm_product_sample_id', true);
	$sample_size = get_post_meta($sample_id, 'mbm_product_size', true) . ' ';
	$sample_product = new WC_product($sample_id);
	$sample_price = woocommerce_price($sample_product->get_price_including_tax());
	echo '<h2>Try a Sample</h2><p>A '. $sample_size  .'sample version of '. get_the_title(get_the_ID()) .' is available for just '. $sample_price .'</p>';
	$sample_name = get_the_title($sample_id);
	$add_to_cart_url = get_permalink(get_the_ID()) . '?add-to-cart=' . $sample_id;
	echo '<a class="button" href="'. $add_to_cart_url .'" title="'. $sample_name .'">Add Sample to Basket</a>';
}

function mbm_reviews_tab_contents() {
	$product = new WC_Product(get_the_ID());
	$sku = $product->get_sku();
	$xml_url = "https://ww2.feefo.com/api/xmlfeedback?merchantidentifier=germaine-de-capuccini&protocol=https&mode=product&negativesanswered=true&sortby=date&order=asc&allcomments=True&since=year&vendorref=" . $sku;
	$xml = simplexml_load_file($xml_url);
	$theme_dir = get_stylesheet_directory_uri();	

	if( ! $xml ) { 
	// COULDNT GET THE XML FROM FEEFO
	} 
	else { 
		// SUCCESSFULLY GOT FEEFO XML FEED

		?>
		
		<?php
		foreach ($xml as $key => $feedback) {
			if($key == 'SUMMARY'){
				if($feedback->AVERAGE){$average_rating_percent = $feedback->AVERAGE;}
				if($feedback->TOTALPRODUCTCOUNT){$review_count = $feedback->TOTALPRODUCTCOUNT;}
			}
		}

		if( $review_count == '1' ){$rt = 'review';}
		elseif( $review_count > '1' ){$rt = 'reviews';}

		echo '<h3 class="reviews center">' . $review_count . ' ' . $rt . ', powered by <img width="110" class="feefologo" src="' . $theme_dir . '/img/feefo/feefo-logo.png" alt="Powered by Feefo" title="Powered by Feefo"></h3>';
		echo '<table class="reviews"><thead><tr><td>Date</td><td>Score</td><td>Customer Feedback</td></tr></thead><tbody>';

		foreach ($xml as $key => $feedback) {		
			if($key == 'FEEDBACK'){
				//if($feedback->NAME){$review_name = $feedback->NAME;}
				if($feedback->DATE){$review_date = $feedback->DATE;}
				if($feedback->HREVIEWDATE){$review_datetime = $feedback->HREVIEWDATE;}
				if($feedback->HREVIEWRATING){$review_rating = $feedback->HREVIEWRATING;}
				if($feedback->HREVIEWRATING){$review_rating_icon_url =  get_stylesheet_directory_uri() . '/img/feefo/rating' . $review_rating . '.png';}
				if($feedback->CUSTOMERCOMMENT){$review_comment = $feedback->CUSTOMERCOMMENT;}
				if($feedback->FURTHERCOMMENTSTHREAD){$review_further_comments = $feedback->FURTHERCOMMENTSTHREAD;}

				echo '<tr itemtype="https://schema.org/Review" itemscope="itemscope" itemprop="review">';
					echo '<td class="review-date"><time itemprop="datePublished" datetime="'. $review_datetime .'">'. $review_date .'</time></td>';
					echo '<td>
						<img src="' . $review_rating_icon_url . '" alt="rating: '. $review_rating .'">
						<div itemtype="https://schema.org/Rating" itemscope="itemscope" itemprop="reviewRating">
							<meta content="1" itemprop="worstRating">
							<span itemprop="ratingValue" content="'. $review_rating .'"></span>
							<meta content="5" itemprop="bestRating">
						</div>
					</td>';
					echo '<td><span itemprop="description">'. $review_comment . '</span><span class="hidden" itemprop="author" itemtype="https://schema.org/Person"> - <span itemprop="name">Happy Customer</span></span>';

					if($feedback->FURTHERCOMMENTSTHREAD){
						foreach ($review_further_comments as $key => $review_further_comment) {
							$post = $review_further_comment->POST;
							$reply = $post->VENDORCOMMENT;
							//print_r($post);
							echo '<blockquote class="triangle-isosceles">' . $reply . '</blockquote>';
						}
					}
					echo '</td>';
				echo '</tr>';
			}
		} 
		echo '</tbody></table>';
		$average_rating_of_5 = $average_rating_percent/20;
	}
}












/**
 * Remove Breadcrumbs - Is this wise? Elemis do it..
 Perhaps Yoast breadcrumbs are better!?
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);


/**
 * Remove Product image, show it further down
 */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
add_action( 'woocommerce_single_product_summary', 'woocommerce_show_product_images', 11);

/**
 * Remove rating - this will be replaced with the Feefo rating
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 12);


/**
 * Display Product Subheading
 */
add_action( 'woocommerce_single_product_summary', 'mbm_woocommerce_show_product_subheading', 6);
if ( ! function_exists( 'mbm_woocommerce_show_product_subheading' ) ) {
	function mbm_woocommerce_show_product_subheading() {
		$subheading = get_post_meta(get_the_ID(), 'mbm_product_subheading', true);
		if( !empty($subheading) ){
			echo '<span class="subheading">' . $subheading . '</span>';
		}
	}
}


/**
 * Display Product Subheading
 */
add_action( 'woocommerce_single_product_summary', 'mbm_woocommerce_show_product_benefits', 41);
if ( ! function_exists( 'mbm_woocommerce_show_product_benefits' ) ) {
	function mbm_woocommerce_show_product_benefits() {
		$benefits = get_post_meta(get_the_ID(), 'mbm_product_key_points', true);
		if( !empty($benefits) ){
			echo '<ul class="benefits">';
			foreach ($benefits as $key => $benefit) {
				echo '<li>';
				echo $benefit;
				echo '</li>';
			}
			echo '</ul>';
		}
	}
}




/**
 * Remove Meta
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);




/**
 * Move Summary to underneath the 'buy box'
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 31);


/**
 * FOR NOW - Remove upsells & cross sells until we have better sorted which products are linked (also rename as 'partner with' or 'use with'.)
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);







//add_action( 'woocommerce_after_single_product_summary', 'mbm_woocommerce_tabs', 20);
if ( ! function_exists( 'mbm_woocommerce_tabs' ) ) {
	function mbm_woocommerce_tabs() {
		?>

		    <div id="tabInfo">
		        Selected tab: <span class="tabName"></span>
		    </div>

		<?php
	}
}















/**
* ARCHIVE PAGES
*/

function override_page_title() {
return false;
}
add_filter('woocommerce_show_page_title', 'override_page_title');


remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );

add_action( 'mbm_archive_intro_content', 'woocommerce_taxonomy_archive_description', 10 );
add_action( 'mbm_archive_intro_content', 'woocommerce_product_archive_description', 10 );


add_action( 'mbm_before_main_content', 'mbm_add_archive_intro_block', 10 );
if ( ! function_exists( 'mbm_add_archive_intro_block' ) ) {
	function mbm_add_archive_intro_block(){
		?>
		<div class="archive-intro center">
			<h1 class="page-title">
				<?php 
				if(is_woocommerce() ){woocommerce_page_title(); }
				else{the_title();}
				?>
			</h1>
			<?php do_action( 'mbm_archive_intro_content' ); ?>
		</div>
		<?php
	}
}


// Change number or products per row to 3
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}




















/**
 * MINI CART WIDGET
 */

// Creating the widget 
class mbm_login_account_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
// Base ID of your widget
            'mbm_login_account_widget', 

// Widget name will appear in UI
            __('Login / Account Link', 'mbm_login_account_widget_domain'), 

// Widget description
            array( 'description' => __( 'Widget to display login / account link', 'mbm_login_account_widget_domain' ), ) 
            );
    }

// Creating widget front-end
// This is where the action happens
    public function widget( $args, $instance ) {

        if($instance){$title = $instance['title'];}else{$title = 'Credit';}
        $title = apply_filters( 'widget_title', $title );

        if($instance){$text = $instance['text'];}else{$text = 'You currently have';}
        $text = apply_filters( 'widget_text', $text );

// before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) ){
            echo $args['before_title'] . $title . $args['after_title'];
        }

// This is where you run the code and display the output
        // $user_id = get_current_user_id();
        // $users_credit = get_users_total_credit($user_id);
        // $users_credit = number_format((float)$users_credit, 2, '.', '');
        //echo 'Your current credit: £' . $users_credit . '.<br>';

        //if ( ! empty( $text ) ){
            //echo __( $text . ' <span class="creditamount">£' . $users_credit . '<span>', 'mbm_login_account_widget_domain' );
        //}
        //if(is_user_logged_in(){ } else{ }
        $user = wp_get_current_user();
        if($user->exists()){
        	$text = 'Account';
        	$logoutlink = ' <a href="'. wp_logout_url(get_permalink()) . '">Logout</a>';
        } 
        else{ 
        	$text = 'Log in';
        	$logoutlink = '';
        }

        $myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
		if ( $myaccount_page_id ) { $url = get_permalink( $myaccount_page_id ); } else{ $url = wp_login_url(); }

        if(is_account_page()){ echo $logoutlink; }
        else{ echo '<a href="'. $url .'">'. $text .'</a>' . $logoutlink; }
        

        echo $args['after_widget'];
    }


// Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Credit', 'mbm_login_account_widget_domain' );
        }

        if ( isset( $instance[ 'text' ] ) ) {
            $text = $instance[ 'text' ];
        }
        else {
            $text = __( 'You currently have', 'mbm_login_account_widget_domain' );
        }


// Widget admin form

    }
    
// Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['text'] = ( ! empty( $new_instance['text'] ) ) ? strip_tags( $new_instance['text'] ) : '';
        return $instance;
    }
} // Class mbm_login_account_widget ends here








/**
 * Layered Nav Filter Reset
 */

// Creating the widget 
class mbm_reset_woo_filters extends WP_Widget {

    function __construct() {
        parent::__construct(
// Base ID of your widget
            'mbm_reset_woo_filters', 

// Widget name will appear in UI
            __('Reset Woocommerce Layered Nav Filters', 'mbm_reset_woo_filters_domain'), 

// Widget description
            array( 'description' => __( 'Shows link to reset filters', 'mbm_reset_woo_filters_domain' ), ) 
            );
    }

// Creating widget front-end
// This is where the action happens
    public function widget( $args, $instance ) {

        if($instance){$title = $instance['title'];}else{$title = 'Reset Filters';}
        $title = apply_filters( 'widget_title', $title );

        if($instance){$text = $instance['text'];}else{$text = 'Reset dem badboys';}
        $text = apply_filters( 'widget_text', $text );


        if (strpos($_SERVER['REQUEST_URI'], "?filter") !== false){
			// This is where you run the code and display the output
	        $filterreset = $_SERVER['REQUEST_URI'];
	        $filterreset = strtok($filterreset, '?');

	        // before and after widget arguments are defined by themes
	        echo $args['before_widget'];
	        if ( ! empty( $title ) ){
	            echo $args['before_title'] . $title . $args['after_title'];
	        }

	        echo '<a href="'. $filterreset .'">'. $text .'</a>';
	        echo $args['after_widget'];
		}

        if ( isset($_GET['filter_range']) ) {
        	
        }
    }



// Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Reset Filters', 'mbm_reset_woo_filters_domain' );
        }

        if ( isset( $instance[ 'text' ] ) ) {
            $text = $instance[ 'text' ];
        }
        else {
            $text = __( 'Reset dem', 'mbm_reset_woo_filters_domain' );
        }


// Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Preceeding text:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" type="text" value="<?php echo esc_attr( $text ); ?>" />
        </p>
        <?php 

    }
    
// Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['text'] = ( ! empty( $new_instance['text'] ) ) ? strip_tags( $new_instance['text'] ) : '';
        return $instance;
    }
} // Class mbm_reset_woo_filters ends here







/**
 * Feefo Mini WIDGET
 */

// Creating the widget 
class mbm_feefo_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
// Base ID of your widget
            'mbm_feefo_widget', 

// Widget name will appear in UI
            __('Feefo Widget', 'mbm_feefo_widget_domain'), 

// Widget description
            array( 'description' => __( 'Displays Realtime Feefo Service Rating', 'mbm_feefo_widget_domain' ), ) 
            );
    }

// Creating widget front-end
// This is where the action happens
    public function widget( $args, $instance ) {

        if($instance){$text = $instance['text'];}else{$text = 'Customer Satisfaction';}
        $text = apply_filters( 'widget_text', $text );

        $xml_url = "http://ww2.feefo.com/api/xmlfeedback?merchantidentifier=germaine-de-capuccini&protocol=https&mode=service&negativesanswered=true&limit=1000&sortby=date&order=desc&allcomments=True&since=year";
		$xml = simplexml_load_file($xml_url);
		if( ! $xml ) { 
		// COULDNT GET THE XML FROM FEEFO
		} 
		else { 
			// SUCCESSFULLY GOT FEEFO XML FEED
			foreach ($xml as $key => $feedback) {
				if($key == 'SUMMARY'){if($feedback->AVERAGE){$review_count = $feedback->AVERAGE;}}
			}
		}


// This is where you run the code and display the output
        echo $args['before_widget'];
        echo '<a href="'. get_site_url() .'/reviews/"><span class="feefo-yellow">' . $review_count . '%</span> <img style="width:80px;" width="80" src="' . get_stylesheet_directory_uri() . '/img/feefo/feefo-logo-white.png"><br><span class="feefo-text">'. $text .'</span></a>';
        echo $args['after_widget'];
    }


// Widget Backend 
    public function form( $instance ) {

        if ( isset( $instance[ 'text' ] ) ) {
            $text = $instance[ 'text' ];
        }
        else {
            $text = __( 'Customer Satisfaction', 'mbm_feefo_widget_domain' );
        }


// Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Preceeding text:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" type="text" value="<?php echo esc_attr( $text ); ?>" />
        </p>
        <?php 

    }
    
// Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['text'] = ( ! empty( $new_instance['text'] ) ) ? strip_tags( $new_instance['text'] ) : '';
        return $instance;
    }
} // Class mbm_feefo_widget ends here




// Exclude sample category from search results (except for admin)
function mbm_exclude_samples_from_search_results( $query ) {
   if (! is_admin() && $query->is_main_query() && $query->is_search() ) {

	       $query->set( 'post_type', array( 'product' ) );
	    	// https://codex.wordpress.org/Class_Reference/WP_Query#Taxonomy_Parameters
	       $tax_query = array(
	           array(
	               'taxonomy' => 'product_cat',
	               'field'   => 'slug',
	               'terms'   => 'samples',
	               'operator' => 'NOT IN',
	           ),
	       );
	       $query->set( 'tax_query', $tax_query );
	}
}

add_action( 'pre_get_posts', 'mbm_exclude_samples_from_search_results' );





// Register and load the widget
function wpb_load_widget() {
    register_widget( 'mbm_login_account_widget' );
    register_widget( 'mbm_reset_woo_filters' );
    register_widget( 'mbm_feefo_widget' );    
}
add_action( 'widgets_init', 'wpb_load_widget' );






