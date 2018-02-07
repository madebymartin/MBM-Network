<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if(isset($_GET['view'])){$view = $_GET['view'];}

$page=strtok($_SERVER["REQUEST_URI"],'?');
$site_url = get_site_url();
$full_url = $site_url . $page;



get_header( 'shop' ); 

/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	


// SHOP FRONT SHOWS ALL DATES IN ORDER, ALONG WITH DETAILS FOR EACH PRODUCT/EVENT/WORKSHOP/COURSE ETC..
// USER CAN FILTER LIST BY EVENT TYPE (PRODUCT CATEGORY), TRAINER, LOCATION ETC
if (is_shop()) {

	$dates = mbm_get_all_bookable_dates();


	if($view == 'calendar'){
		$link_to_other_view = $full_url . '?view=list';
		echo '<div class="switch mobilehide"><span class="button">Calendar View</span><a class="button" href="'. $link_to_other_view .'">List View</a></div>';

		// echo 'This is the calendar view<br><a href="'. $link_to_other_view .'">List View</a>';

/*
		$bookable_events = mbm_get_all_bookable_dates($trainer_id, $location_id);
		echo '<pre>';
			// print_r($bookable_events);
			foreach ($bookable_events as $key => $event) {
				$ts = $event['timestamp'];
				echo date('Y-m-d', $ts) . '<br>';
			}
		echo '</pre>';
		*/


        $calendar = new Calendar();
        echo $calendar->show();


		
/*		echo '<pre>';
		foreach ($dates as $key => $date) {
			print_r($date);
		}
		echo '</pre>';*/

	}

	else{

		$link_to_other_view = $full_url . '?view=calendar';

		echo '<div class="switch mobilehide"><a class="button" href="'. $link_to_other_view .'">Calendar View</a><span class="button">List View</span></div>';


		// echo 'This is the list view<br><a href="'. $link_to_other_view .'">Calendar View</a>';


		//echo '<a href="'. get_permalink() .'?type=overview">Show Overview</a>';
		
		echo '<ul class="events">';
		foreach ($dates as $key => $date) {
			$timestamp = $date['timestamp'];
			$day = date('j', $timestamp);
			$daynth = date('S', $timestamp);
			$month = date('F', $timestamp);
			$year = date('Y', $timestamp);
			$product_id = $date['product_id'];
			$product_url = get_permalink($product_id);
			$product = wc_get_product( $product_id );
			$product_title = get_the_title($product_id);
			$image = $product->get_image();
			$trainer_id = get_post_meta( $product_id, 'mbm_trainer', true );
			$trainer_img = get_the_post_thumbnail($trainer_id, "thumbnail", array( 'class' => 'circle' ));
			$trainer_link = get_permalink($trainer_id);
			$trainer_name = get_the_title($trainer_id);
			$location_id = get_post_meta( $product_id, 'mbm_location', true );
			$location_img = get_the_post_thumbnail($location_id, "thumbnail", array( 'class' => 'circle' ));
			$location_link = get_permalink($location_id);
			$location_name = get_the_title($location_id);
			$date_output = '<div class="date"><span class="month">'. $month .'</span> <span class="day">'. $day .'<sup>'. $daynth .'</sup></span> <span class="year">'. $year .'</span></div>';
			$title_link = '<a class="heading" href="'. $product_url .'"><h2>'. $product_title .'</h2></a><br>';
			$category_list = $product->get_categories( ', ', '<span class="categories">' . _n( '', '', $cat_count, 'woocommerce' ) . ' ', '</span><br>' ); 
			$short_desc = apply_filters("the_excerpt", get_post_field("post_excerpt", $product_id));
			$image_link = '<a class="image" href="'. $product_url .'">'. $image .'</a>';
			$trainer_output = '<a class="extralink" href="'. $trainer_link .'">'. $trainer_img .' With '. $trainer_name .'</a>';
			$location_output = '<a class="extralink" href="'. $location_link .'">'. $location_img .' In '. $location_name .'</a>';
			$button = '<a class="button" href="'. $product_url .'">Info / Book</a>';

			echo '<li>';
				echo '<div class="col-date">' . $date_output . '</div>';
				echo '<div class="col-img">' . $image_link . '</div>';
				echo '<div class="col-info">';
					echo $title_link;
					echo $category_list;
					echo $short_desc;
					echo $trainer_output . '<br>';
					echo $location_output . '<br>';
				echo'</div>';
				echo $button;
			echo '</li>';
		}
		echo '</ul>';
	}	
}














else{

		/**
		 * woocommerce_archive_description hook.
		 *
		 * @hooked woocommerce_taxonomy_archive_description - 10
		 * @hooked woocommerce_product_archive_description - 10
		 */
		do_action( 'woocommerce_archive_description' );
	
	if ( have_posts() ) :

			/**
			 * woocommerce_before_shop_loop hook.
			 *
			 * @hooked woocommerce_result_count - 20
			 * @hooked woocommerce_catalog_ordering - 30
			 */
			do_action( 'woocommerce_before_shop_loop' );
		
		woocommerce_product_loop_start();
		woocommerce_product_subcategories();

			while ( have_posts() ) : the_post();
				wc_get_template_part( 'content', 'product' );
			endwhile; // end of the loop. 
			woocommerce_product_loop_end();

			/**
			 * woocommerce_after_shop_loop hook.
			 *
			 * @hooked woocommerce_pagination - 10
			 */
			do_action( 'woocommerce_after_shop_loop' );
		
		elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) :
			wc_get_template( 'loop/no-products-found.php' );
		endif;
}


		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );

		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );


get_footer( 'shop' ); ?>