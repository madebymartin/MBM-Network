<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Intuity
 */

get_header(); 
$trainer_id = get_the_ID();
$dates = mbm_get_all_bookable_dates($trainer_id);
$trainer_img = get_the_post_thumbnail($trainer_id, "thumbnail", array( 'class' => 'circle' ));
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php

		echo $trainer_img;

		
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );
			//the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
/*			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;*/

		endwhile; // End of the loop.


		echo '<div class="hentry">';
		echo '<h2>'. get_the_title($trainer_id) .' has the following available:</h2>';

			//print_r($dates );
			//echo '<hr>';
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
				
				$location_id = get_post_meta( $product_id, 'mbm_location', true );
				$location_img = get_the_post_thumbnail($location_id, "thumbnail", array( 'class' => 'circle' ));
				$location_link = get_permalink($location_id);
				$location_name = get_the_title($location_id);
				

				$date_output = '<div class="date"><span class="month">'. $month .'</span> <span class="day">'. $day .'<sup>'. $daynth .'</sup></span> <span class="year">'. $year .'</span></div>';
				$title_link = '<a class="heading" href="'. $product_url .'"><h2>'. $product_title .'</h2></a>';
				$category_list = $product->get_categories( ', ', '<span class="categories">' . _n( '', '', $cat_count, 'woocommerce' ) . ' ', '</span><br>' ); 
				$short_desc = apply_filters("the_excerpt", get_post_field("post_excerpt", $product_id));

				
				$image_link = '<a class="image" href="'. $product_url .'">'. $image .'</a>';
				$trainer_output = '<a class="extralink" href="'. $trainer_link .'">'. $trainer_img .' With '. $trainer_name .'</a>';
				$location_output = '<a class="extralink" href="'. $location_link .'">'. $location_img .' In '. $location_name .'</a>';
				
				$button = '<a class="button" href="'. $product_url .'">Info / Book</a>';



				

				//print_r($date);
				echo '<li>';



					echo '<div class="col-date">' . $date_output . '</div>';
					echo '<div class="col-img">' . $image_link . '</div>';

					echo '<div class="col-info">';
						echo $title_link;
						echo $category_list;
						echo $short_desc;
						echo $location_output . '<br>';
					echo'</div>';

					echo $button;
				echo '</li>';

			}
			echo '</ul>';



			$other_trainers = new WP_Query( array (
			    'orderby'               => 'date',
			    'posts_per_page'        => -1,
			    'fields' => 'ids',
			    'post_type' => 'trainer',
			    'post__not_in' => array($trainer_id)
			));
			if ( $other_trainers->have_posts() ) {
				echo 'Also see  ';
				$other_trainer_links = array();
				while ( $other_trainers->have_posts() ) : $other_trainers->the_post();
					$other_trainer_links[] = '<a href="'. get_permalink(get_the_ID()) .'">'. get_the_post_thumbnail(get_the_ID(), "thumbnail", array( 'class' => 'circle smallcircle' )) . ' ' . get_the_title(get_the_ID()) .'</a>';
						//echo '<a href="'. get_permalink(get_the_ID()) .'">'. get_the_title(get_the_ID()) .'</a>';
				endwhile;
				// Prevent weirdness
				wp_reset_postdata();
				echo implode(', ', $other_trainer_links);
			}


			
		echo '</div>';


		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
