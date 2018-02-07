<?php
/**
 * Template part for displaying the paloma slider
 *
 * @package paloma
 */

// Run loop to display featured slider

$slider_style = get_theme_mod( 'slider_style', 'multi_slide' );
			$max_slides = get_theme_mod('paloma_slide_limit', '0');
			$args = array(
			'post_type' => 'post',
			'posts_per_page' => $max_slides,
			'meta_key' => 'slide_order',
			'orderby'  => array( 'meta_value_num' => 'ASC', 'date' => 'DESC' ),
			'meta_query' => array(
				array(
					'key' => 'display_post_in_slider',
					'value' => '1',
					'compare' => '=='
				)
			)
			);

			$paloma_slider_query = new WP_Query( $args );
			if ( $paloma_slider_query->have_posts() ) { 

					echo '<div class="main-gallery full-slide">';

					while ( $paloma_slider_query->have_posts() ) { 
					$paloma_slider_query->the_post();
					$slider_image = get_field('slider_image');
					$thumb_id = get_post_thumbnail_id();
					$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
					$thumb_url = $thumb_url_array[0];	
					$paloma_subtext = get_theme_mod('paloma_slide_subtext', 'Read Now');
								?>
								<div class="home-gallery-cell">					                    
		                        		<div class="home-gallery-img" style="background: url('<?php if ($slider_image != '') { echo $slider_image; } else echo $thumb_url; ?>'); background-position: 50%; background-size: cover;">
			                          			<div class="entry-header">

			                          						<?php //display category link
												            	get_template_part( 'template-parts/content', 'category' ); 
															?>

														<a href="<?php the_permalink(); ?>">
										                    <h2 class="entry-title"><?php echo the_title(); ?></h2>
										                </a>

									                	<h4 class="read-more">
									                		<a href="<?php the_permalink(); ?>"><?php echo $paloma_subtext; ?></a>
									                	</h4>
									                	
									                	<?php //Do accent image
									                		echo paloma_accent_small(); ?>
									                		
												</div>
		                          		</div>
								</div>
							<?php
						}
				echo '</div>';
			} 
			wp_reset_postdata();

 // End slider



