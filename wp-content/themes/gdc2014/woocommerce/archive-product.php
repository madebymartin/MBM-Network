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

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @unhooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<?php if(!is_shop()){ 
			echo '<h1 class="page-title">';
			woocommerce_page_title(); 
			echo '</h1>';
		} ?>
			
		<?php endif; ?>

		<?php do_action( 'woocommerce_archive_description' ); ?>

		<?php if ( have_posts() ) : ?>


			<?php if(is_shop()){


$currentuser = wp_get_current_user();
    if(in_array( 'trade_user', (array) $currentuser->roles )){
        	}else{
				date_default_timezone_set('Europe/London');
				$current_date = date("Y-m-j");

				// GET LATEST 'PUBLIC PROMO' COUPON AND DISPLAY THE BANNER IF IT EXISTS
		        $coupon_promos = new WP_Query( array(
		            'post_type' => 'shop_coupon',
		            'posts_per_page' => '1',
		            'orderby' => 'date',
		            'order' => 'DESC',
		            'meta_query' => array(
		            	'relation' => 'AND',
		                array(
	                    'key'     => 'public_promo',
	                    'value'   => '1',
	                    'compare' => 'IN',
		                ),
		                array(
						'key' => 'expiry_date',
						'value' => $current_date,
						'compare' => '>'
						),
		            ),
		        ) );
		        if ( $coupon_promos->have_posts() ) {
		            while ( $coupon_promos->have_posts() ) : $coupon_promos->the_post();
		            $coupon_description = get_the_excerpt();
		            if(get_post_meta(get_the_id(), '_cmb_promo_coupon_banner', true)){
		            	$banner_id = get_post_meta(get_the_id(), '_cmb_promo_coupon_banner', true);
		            	echo wp_get_attachment_image( $banner_id, 'full', '', array('alt'   => trim(strip_tags( $coupon_description )), ) );
		            }else{// NO BANNER SET
		            	echo '<div class="notification">' . $coupon_description . '</div><br>';
		            } 
		            	
		            endwhile;
		            // Prevent weirdness
		            wp_reset_postdata();
		        }
	        }



		        // CROWBARRED BANNERS
				//	echo'<a href="//germaine-de-capuccini.co.uk/signup/"><img src="' . get_bloginfo('stylesheet_directory') . '/images/12days-banner.gif" alt="12 Days of Christmas is coming"></a>';
				//	echo'<a href="//germaine-de-capuccini.co.uk/product-category/gifts/"><img src="//germaine-de-capuccini.co.uk/files/germaine-de-capuccini-christmas-gifts1.jpg" alt="Germaine de Capuccini Christmas Gifts"></a>';
//				echo'<a title="Product of the month: Excel Therapy O2 365 Scrub" href="//germaine-de-capuccini.co.uk/product/365-soft-scrub/"><img src="//germaine-de-capuccini.co.uk/files/product-of-the-month.jpg" alt="Product of the month: 365 Scrub"></a>';
//				echo'<img src="//germaine-de-capuccini.co.uk/files/free-serum.jpg" alt="Free Serum">';





				// FEATURED PRODUCTS WITH THEIR BANNERS LINKING TO THE PRODUCT PAGE
					$args = array(
					'post_type' => 'product',
					'posts_per_page' => -1,
					'meta_query' => array(
						array(
						'key' => '_featured',
						'value' => 'yes',
						'compare' => 'IN'
						),
					)
					);
					$loop = new WP_Query( $args );

					if ( $loop->have_posts() ) {

						//echo '<h3>Featured Products</h3>';
						echo '<div class="featured">';
						echo '<ul class="products">';

						while ( $loop->have_posts() ) : $loop->the_post();

							// SHOW FEATURED BANNER - NO ADD TO CART BUTTON ETC
							echo '<li class="featured_product"><a href="';
							echo the_permalink();
							echo '" title="';
							echo the_title();
							echo '">';
								if (MultiPostThumbnails::has_post_thumbnail(get_post_type(), 'feature')) { MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'feature', NULL,  '700sq', array('class' => '')); }
								else{the_title();} 								            
							echo '</a></li>';


							// STANDARD PRODUCT LIST FOR FEATURED PRODUCTS
							// woocommerce_get_template_part( 'content', 'product' );


						endwhile;
						echo '</ul><!--/.products-->';
						echo '</div>';

					} else {
						echo __( 'No products found' );
					}
						wp_reset_postdata();
					?>
				
			<?php
			//do_action( 'woocommerce_after_shop_loop' );
			} else{

				//woocommerce_before_shop_loop hook
				//@hooked woocommerce_result_count - 20
				//@hooked woocommerce_catalog_ordering - 30
				do_action( 'woocommerce_before_shop_loop' );

					woocommerce_product_loop_start();
						woocommerce_product_subcategories();
						while ( have_posts() ) : the_post();
							wc_get_template_part( 'content', 'product' );
						endwhile; // end of the loop. 
					woocommerce_product_loop_end(); 

				//woocommerce_after_shop_loop hook
				//@hooked woocommerce_pagination - 10
				do_action( 'woocommerce_after_shop_loop' );

			}




			
				

				
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php

		// action hook for placing content below #container
	    thematic_belowcontainer();
       

		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		//do_action( 'woocommerce_sidebar' );


		//echo '<div class="aside">boo</div>';
		// calling the standard sidebar 
	    thematic_sidebar();

	?>

<?php get_footer( 'shop' ); ?>