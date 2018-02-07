<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' );
//wp_reset_query();

global $product;

if(get_post_meta( get_the_ID(), '_cmb_first_name', true )){ $_gdc_fname = get_post_meta( get_the_ID(), '_cmb_first_name', true ); } else { $_gdc_fname = get_post_meta( get_the_ID(), 'First Name', true ); }
if(get_post_meta( get_the_ID(), '_cmb_last_name', true )){ $_gdc_sname = get_post_meta( get_the_ID(), '_cmb_last_name', true ); } else { $_gdc_sname = get_post_meta( get_the_ID(), 'Surname', true ); }
if(get_post_meta( get_the_ID(), '_cmb_age', true )){ $_gdc_age = get_post_meta( get_the_ID(), '_cmb_age', true ); } else { $_gdc_age = get_post_meta( get_the_ID(), 'Age', true ); }
if(get_post_meta( get_the_ID(), '_cmb_sex', true )){ $_gdc_sex = get_post_meta( get_the_ID(), '_cmb_sex', true ); } else { $_gdc_sex = get_post_meta( get_the_ID(), 'Sex', true ); }
if(get_post_meta( get_the_ID(), '_cmb_add1', true )){ $_gdc_address1 = get_post_meta( get_the_ID(), '_cmb_add1', true ); } else { $_gdc_address1 = get_post_meta( get_the_ID(), 'Address 1', true ); }
if(get_post_meta( get_the_ID(), '_cmb_add2', true )){ $_gdc_address2 = get_post_meta( get_the_ID(), '_cmb_add2', true ); } else { $_gdc_address2 = get_post_meta( get_the_ID(), 'Address 2', true ); }
if(get_post_meta( get_the_ID(), '_cmb_add3', true )){ $_gdc_address3 = get_post_meta( get_the_ID(), '_cmb_add3', true ); } else { $_gdc_address3 = get_post_meta( get_the_ID(), 'Address 3', true ); }
if(get_post_meta( get_the_ID(), '_cmb_add4', true )){ $_gdc_address4 = get_post_meta( get_the_ID(), '_cmb_add4', true ); } else { $_gdc_address4 = get_post_meta( get_the_ID(), 'Address 4', true ); }
if(get_post_meta( get_the_ID(), '_cmb_add5', true )){ $_gdc_address5 = get_post_meta( get_the_ID(), '_cmb_add5', true ); } else { $_gdc_address5 = get_post_meta( get_the_ID(), 'Address 5', true ); }
if(get_post_meta( get_the_ID(), '_cmb_email', true )){ $_gdc_email = get_post_meta( get_the_ID(), '_cmb_email', true ); } else { $_gdc_email = get_post_meta( get_the_ID(), 'Email Address', true ); }
if(get_post_meta( get_the_ID(), '_cmb_sensitivity', true )){ $_gdc_sensitivity = get_post_meta( get_the_ID(), '_cmb_sensitivity', true ); } else { $_gdc_sensitivity = get_post_meta( get_the_ID(), 'Skin Sensitivity', true ); }
if(get_post_meta( get_the_ID(), '_cmb_concern', true )){ $_gdc_concern = get_post_meta( get_the_ID(), '_cmb_concern', true ); } else { $_gdc_concern = get_post_meta( get_the_ID(), 'Skin Concern', true ); }
if(get_post_meta( get_the_ID(), '_cmb_skintype', true )){ $_gdc_skintype = get_post_meta( get_the_ID(), '_cmb_skintype', true ); } else { $_gdc_skintype = get_post_meta( get_the_ID(), 'Skin Type', true ); }
if(get_post_meta( get_the_ID(), '_cmb_coupon_id', true )){ $_gdc_coupon_id = get_post_meta( get_the_ID(), '_cmb_coupon_id', true ); } else { $_gdc_coupon_id = get_post_meta( get_the_ID(), 'Coupon ID', true ); }
$_gdc_coupon_code = get_post_meta( get_the_ID(), '_cmb_coupon_code', true );

$page_url = rtrim(get_permalink(),'/');

// COMPILE $_GDC_COMBINATION VARIABLE - USED TO MATCH TAXONOMY TERMS IN THE TAX_QUERY OF THE WP QUERY IN PRODUCTS_LOOP.PHP
$_gdc_combination = $_gdc_concern . '-' . $_gdc_age . '-' .$_gdc_sensitivity. '';

// DEFINE PRODUCT LOOP VARIABLE
require_once('lib/functions/gf_autoexpert/product_loops.php');


//	@hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
//	@unhooked woocommerce_breadcrumb - 20
do_action( 'woocommerce_before_main_content' );
//do_action( 'woocommerce_before_single_product' );


echo '<div id="message">';
wc_print_notices();
echo '</div>';


	echo '<div id="autoexpert"><p>"Hi ' . $_gdc_fname . ', below are the products that are perfect for your particular skin. We have emailed these recomendations to you for your reference."</p><p>';
	
	echo '</p></div>';


//CLEANSER LOOP
	if ( $_gdc_cleanserloop->have_posts() ) {
			// Print each product
			while( $_gdc_cleanserloop->have_posts() ) : $_gdc_cleanserloop->the_post();
			
			$product_id = $product->id;
			$product_meta = get_post_meta($product_id);
			//$product = new WC_product( get_the_ID() );
			//$add_to_cart_url = $page_url . '/?add-to-cart=' . $product_id . '#message' ;
			$add_to_cart_url = $page_url . '/?add-to-cart=' . $product_id . '' ;
			$prodprice = number_format($product->price, 2, '.', '');

			if ( get_post_meta(get_the_ID(), "_cmb_instructions", true) ) { 
				$instructions = '<p>' . get_post_meta(get_the_ID(), "_cmb_instructions", true) . '</p>';
			} else {
				$instructions = term_description( '155', 'recommendation_type' );
			}

			// Title
				echo '<div class="panel"><h1>Cleanser:<br>';
				echo'<a href="' . esc_attr( get_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '">' . get_the_title() . '</a></h1>';
				echo '<h3>Instructions for use:</h3>';
				echo $instructions;
				echo '<div class="excurpt">';
			// LINK TO ASSOCIATED PRODUCT RANGE(S)
				echo get_the_term_list( $post->ID, 'product_range', '<em style="text-align:center;">From range: ', ', ', '</em><br><br>' );
			//THE EXCURPT
				the_excerpt();
				echo '</div>';
				echo'<div class="main-product-image"><a href="' . esc_attr( get_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '">';
			// Print the product image
				the_post_thumbnail( 'thumb' );
				echo '</a></div>';
				echo '<div class="buttons">';
				// MORE INFO BUTTON
					echo'<a href="';
					echo the_permalink();
					echo '" class="button">More Info</a>';
				// ADD TO CART BUTTON
					echo'<a href="'. $add_to_cart_url .'" class="button" rel="nofollow">Add to Bag (£'.$prodprice.')</a></div>';
				echo '</div><br><br>';

			endwhile;
	} else {}
	wp_reset_query();


	// TONER LOOP
	if ( $_gdc_tonerloop->have_posts() ) {
			// Print each product
			while( $_gdc_tonerloop->have_posts() ) : $_gdc_tonerloop->the_post();
			$product_id = $product->id;
			$product_meta = get_post_meta($product_id);
			$add_to_cart_url = $page_url . '/?add-to-cart=' . $product_id . '' ;
			$price = $product->price;
			if ($price){$prodprice = number_format($product->price, 2, '.', '');} else{$prodprice = 'TBA';}
			

			if ( get_post_meta(get_the_ID(), "_cmb_instructions", true) ) { 
				$instructions = '<p>' . get_post_meta(get_the_ID(), "_cmb_instructions", true) . '</p>';
			} else {
				$instructions = term_description( '158', 'recommendation_type' );
			}
			// Title
				echo '<div class="panel"><h1>Toner:<br>';
				echo'<a href="' . esc_attr( get_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '">' . get_the_title() . '</a></h1>';
				echo '<h3>Instructions for use:</h3>';
				echo $instructions;
				echo '<div class="excurpt">';
			// LINK TO ASSOCIATED PRODUCT RANGE(S)
				echo get_the_term_list( $post->ID, 'product_range', '<em style="text-align:center;">From range: ', ', ', '</em><br><br>' );
			//THE EXCURPT
				the_excerpt();
				echo '</div>';
				echo'<div class="main-product-image"><a href="' . esc_attr( get_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '">';
			// Print the product image
				the_post_thumbnail( 'thumb' );
				echo '</a></div>';
				echo '<div class="buttons">';
				// MORE INFO BUTTON
					echo'<a href="';
					echo the_permalink();
					echo '" class="button">More Info</a>';
				// ADD TO CART BUTTON
					echo'<a href="'. $add_to_cart_url .'" class="button" rel="nofollow">Add to Bag (£'.$prodprice.')</a></div>';
				echo '</div><br><br>';

			endwhile;
	} else {}
	wp_reset_query();


	// Daily Treatment LOOP
	if ( $_gdc_dailytreatmentloop->have_posts() ) {
			// Print each product
			while( $_gdc_dailytreatmentloop->have_posts() ) : $_gdc_dailytreatmentloop->the_post();
			$product_id = $product->id;
			$product_meta = get_post_meta($product_id);
			$add_to_cart_url = $page_url . '/?add-to-cart=' . $product_id . '' ;
			$price = $product->price;
			if ($price){$prodprice = number_format($product->price, 2, '.', '');} else{$prodprice = 'TBA';}
			

			if ( get_post_meta(get_the_ID(), "_cmb_instructions", true) ) { 
				$instructions = '<p>' . get_post_meta(get_the_ID(), "_cmb_instructions", true) . '</p>';
			} else {
				$instructions = term_description( '156', 'recommendation_type' );
			}
			// Title
				echo '<div class="panel"><h1>Daily Treatment:<br>';
				echo'<a href="' . esc_attr( get_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '">' . get_the_title() . '</a></h1>';
				echo '<h3>Instructions for use:</h3>';
				echo $instructions;
				echo '<div class="excurpt">';
			// LINK TO ASSOCIATED PRODUCT RANGE(S)
				echo get_the_term_list( $post->ID, 'product_range', '<em style="text-align:center;">From range: ', ', ', '</em><br><br>' );
			//THE EXCURPT
				the_excerpt();
				echo '</div>';
				echo'<div class="main-product-image"><a href="' . esc_attr( get_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '">';
			// Print the product image
				the_post_thumbnail( 'thumb' );
				echo '</a></div>';
				echo '<div class="buttons">';
				// MORE INFO BUTTON
					echo'<a href="';
					echo the_permalink();
					echo '" class="button">More Info</a>';
				// ADD TO CART BUTTON
					echo'<a href="'. $add_to_cart_url .'" class="button" rel="nofollow">Add to Bag (£'.$prodprice.')</a></div>';
				echo '</div><br><br>';

			endwhile;
	} else {}
	wp_reset_query();


	// Eye Treatment LOOP
	if ( $_gdc_eyetreatmentloop->have_posts() ) {
			// Print each product
			while( $_gdc_eyetreatmentloop->have_posts() ) : $_gdc_eyetreatmentloop->the_post();
			$product_id = $product->id;
			$product_meta = get_post_meta($product_id);
			$add_to_cart_url = $page_url . '/?add-to-cart=' . $product_id . '' ;
			$price = $product->price;
			if ($price){$prodprice = number_format($product->price, 2, '.', '');} else{$prodprice = 'TBA';}
			

			if ( get_post_meta(get_the_ID(), "_cmb_instructions", true) ) { 
				$instructions = '<p>' . get_post_meta(get_the_ID(), "_cmb_instructions", true) . '</p>';
			} else {
				$instructions = term_description( '157', 'recommendation_type' );
			}
			// Title
				echo '<div class="panel"><h1>Eye Treatment:<br>';
				echo'<a href="' . esc_attr( get_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '">' . get_the_title() . '</a></h1>';
				echo '<h3>Instructions for use:</h3>';
				echo $instructions;
				echo '<div class="excurpt">';
			// LINK TO ASSOCIATED PRODUCT RANGE(S)
				echo get_the_term_list( $post->ID, 'product_range', '<em style="text-align:center;">From range: ', ', ', '</em><br><br>' );
			//THE EXCURPT
				the_excerpt();
				echo '</div>';
				echo'<div class="main-product-image"><a href="' . esc_attr( get_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '">';
			// Print the product image
				the_post_thumbnail( 'thumb' );
				echo '</a></div>';
				echo '<div class="buttons">';
				// MORE INFO BUTTON
					echo'<a href="';
					echo the_permalink();
					echo '" class="button">More Info</a>';
				// ADD TO CART BUTTON
					echo'<a href="'. $add_to_cart_url .'" class="button" rel="nofollow">Add to Bag (£'.$prodprice.')</a></div>';
				echo '</div><br><br>';

			endwhile;
	} else {}
	wp_reset_query();



		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );

		// action hook for placing content below #container
	    thematic_belowcontainer();

?>

<div class="aside">
	<?php
	if ($_gdc_fname){ echo 'Name: ' . $_gdc_fname . ' ' . $_gdc_sname . '<br>'; }
	if ($_gdc_sex){ echo 'Sex: ' . $_gdc_sex . '<br>'; }
	if ($_gdc_age){ echo 'Age: ' . $_gdc_age . '<br>'; }



	// Rename Sensitivity to pretty language
	if ($_gdc_sensitivity == "S"){ $skinsensitivity = "Sensitive"; }
	elseif ($_gdc_sensitivity == "NS"){ $skinsensitivity = "Non-Sensitive"; }
	

	// Rename Skin Type to pretty language
	if ($_gdc_skintype == "normal_dry"){ $skintype = "Normal / Dry"; }
	elseif ($_gdc_skintype == "dry"){ $skintype = "Dry"; }
	elseif ($_gdc_skintype == "normal_combination"){ $skintype = "Normal / Combination"; }
	elseif ($_gdc_skintype == "combination_oily"){ $skintype = "Combination / Oil"; }
	elseif ($_gdc_skintype == "oily"){ $skintype = "Oily"; }
	elseif ($_gdc_skintype == "acne"){ $skintype = "Acne"; }

	if ($_gdc_sensitivity){ echo 'Skin Sensitivity: ' . $skinsensitivity . '<br>'; }
	if ($_gdc_concern){ echo 'Skin Concern: ' . $_gdc_concern . '<br>'; }
	if ($_gdc_skintype){ echo 'Skin Type: ' . $skintype . '<br>'; }
	// if ($_gdc_taxonomy){ echo 'Taxonomy:' . $_gdc_taxonomy . '<br>'; }

	//if ($_gdc_coupon_id){ echo 'Coupon Code: ' . get_the_title( $_gdc_coupon_id ) . '<br>'; }
	?>
</div>


<?php


		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
		//echo '<div class="aside">boo</div>';
		// calling the standard sidebar 
	    //thematic_sidebar();
	?>

<?php get_footer( 'shop' ); ?>