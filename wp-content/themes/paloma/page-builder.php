<?php
/*
Template Name: Page Builder
*/
/**
 * Template used for the custom static landing page
 * 
 * @package paloma
 * @author Station Seven <hello@stnsvn.com> 
 * @copyright Copyright (c) 2017, Station Seven
 * 
 */ 

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" <?php post_class('site-main'); ?> role="main">


			<?php //Optionally display page title
			if (get_field('page_title_display')){ ?>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->
			<?php } 

// check if the flexible content field has rows of data
if( have_rows('landing_content_sections') ):

     // loop through the rows of data
    while ( have_rows('landing_content_sections') ) : the_row();
        
        if( get_row_layout() == 'content_columns' ): 
        	//vars
			$column_title = get_sub_field('column_title', false, false);
			$number_of_content_cols = get_sub_field('number_of_content_columns');
        	$col1_content = get_sub_field('column_1_content');
        	$column_1_width_2_column = get_sub_field('column_1_width_2_column');
        	$column_1_width_3_column = get_sub_field('column_1_width_3_column');
           	$column_2_width = get_sub_field('column_2_width');
        	$col2_content = get_sub_field('column_2_content');
        	$col3_content = get_sub_field('column_3_content');
        	$column_bg = get_sub_field('column_bg');
        	$column_bg_image = get_sub_field('column_bg_image');
        	$column_text_color = get_sub_field('column_text_color');
        	$column_content_width = get_sub_field('column_content_width');
        	$column_button_text = get_sub_field('column_button_text');
        	$column_button_url = get_sub_field('column_button_url');
        	$column_section_id = strtolower(str_replace(" ","-", get_sub_field('column_title')));//use the section title as section id. Replace spaces with dashes and convert to lowercase
        	?>
        	 <div class="landing-content-columns landing-section" style="
        	 	<?php //add inline style based on page editor settings	
        	 		if ($column_bg) { echo 'background-color:' , $column_bg , ';';} 
        	 		if ($column_bg_image) { echo 'background: url(\'' , $column_bg_image , '\'); background-size: cover; background-position: 50%;';} 
        	 		if ($column_text_color) { echo 'color:' , $column_text_color , ';';} 
        	 	?>
        	 "
        	 <?php //add section title as id
        	 	if ($column_title) { echo 'id="' , $column_section_id , '"';} ?>
        	 >
		        	 <div class="landing-inner "
		        	 	<?php if ($column_content_width){ //Add custom content width if set in page editor
		        	 		echo 'style="max-width:' , $column_content_width , 'px;"';
		        	 	} ?>
		        	>

    	 				<?php if ($column_title){ //Do section title if set ?>
		        	 		<div class="section-title">
		        	 			<h3><?php echo $column_title; ?></h3>
		        	 			<?php echo paloma_accent_small(); ?>
		        	 		</div>
		        	 	<?php } ?>

			        	 	<div class="clear paloma-columns-<?php echo $number_of_content_cols; ?>">
				        	 	<div class="content-column paloma-column" 
		        	 				<?php //Adds column width inline style, taking into account the gutter size
		        	 					if ($number_of_content_cols == '2'){ //set column width for 2 column layout
		        	 						echo 'style=width:' , ($column_1_width_2_column - '3') , '%;';
		        	 					} 
		        	 					if ($number_of_content_cols == '3'){ //set column width for 3 column layout
		        	 						echo 'style=width:' , ($column_1_width_3_column - ('8' / '3')) , '%;';
		        	 					} ?>
				        	 	>
				        	 		<?php echo $col1_content; ?>
				        	 	</div>

				        	 	<?php if ($number_of_content_cols != '1'): //display column 2, if active?>
					        	 	<div class="content-column paloma-column" 
					        	 		<?php //Adds column width inline style, taking into account the gutter size
					        	 			if ($number_of_content_cols == '2'){echo 'style=width:' , ('100' - $column_1_width_2_column - '3') , '%;';} 
					        	 			if ($number_of_content_cols == '3'){echo 'style=width:' , ($column_2_width - ('8' / '3')) , '%;';}?>
					        	 	>
					        	 		<?php echo $col2_content; ?>
					        	 	</div>
				        	 	<?php endif; ?>

				        	 	<?php if ($number_of_content_cols == '3'): //display column 3, if active?>
					        	 	<div class="content-column paloma-column" 
					        	 		<?php //Adds column width inline style, taking into account the gutter size
					        	 			if ($number_of_content_cols == '3'){echo 'style=width:' , ('100' - $column_1_width_3_column - $column_2_width - ('8' / '3') ) , '%;';} ?>
					        	 	>
					        	 		<?php echo $col3_content; ?>
					        	 	</div>
				        	 	<?php endif; ?>
				        	 </div>
			      	
				        	<?php if( $column_button_text ) { ?>
				            	<div class="paloma-button large-button landing-button">

					            <?php if( $column_button_url ){ ?>
				                    <a href="<?php echo $column_button_url; ?>">
				                <?php } ?>

					                    <h4><?php echo $column_button_text; ?></h4>
					                
				                <?php if( $column_button_url ) { ?>
				                    </a>
				                <?php } ?>

				            	</div>
			                <?php } ?>

		        	 </div>

        	 </div>

    	<?php 

    	elseif( get_row_layout() == 'masonry_grid' ): 
							//vars
							$masonry_title = get_sub_field('masonry_title_text');
							$masonry_items = get_sub_field('masonry_items');
							$masonry_content = get_sub_field('masonry_content');
							$masonry_bg = get_sub_field('masonry_bg');
							$masonry_title_style = get_sub_field('masonry_title_style');
							$masonry_section_id = strtolower(str_replace(" ","-", get_sub_field('masonry_title_text')));//use the section title as section id. Replace spaces with dashes and convert to lowercase
							?>

							<div class="landing-section" style="background-color: <?php echo $masonry_bg; ?>;"
								 <?php //add section title as id
								 	if ($masonry_title) { echo 'id="' , $masonry_section_id , '"';} ?>
							>
								<div class="landing-inner">

									<?php if ($masonry_title){ //Do section title if set ?>
					        	 		<div class="section-title">
					        	 			<h3><?php echo $masonry_title; ?></h3>
					        	 			<?php echo paloma_accent_small(); ?>
					        	 		</div>
					        	 	<?php } ?>

									<?php if ($masonry_content){ ?>
									 	<div class="masonry-content">
									 		<?php echo $masonry_content; ?>
									 	</div>
								 	<?php } ?>


									<?php //Only do the grid if items are selected
									if ($masonry_items){ ?>

										<div class="grid">
											<div class="grid-sizer"></div>
									 		<div class="gutter-sizer"></div>

												<?php foreach( $masonry_items as $p ): // variable must NOT be called $post (IMPORTANT) ?>
												    <div class="grid-item">
												    	<a href="<?php echo get_permalink( $p->ID ); ?>">
												    		<?php if (has_post_thumbnail($p->ID)) { //Only display thumbnail if it has one
												    					echo get_the_post_thumbnail( $p->ID, 'large' ); 
												    				} ?>

													    		<div class="masonry-overlay <?php if ($masonry_title_style){ echo $masonry_title_style; } ?>">
														    		<h4 class="masonry-title">
														    			<?php echo get_the_title( $p->ID ); ?>
														    		</h4>
														    	</div>

												    	</a>
												    </div>
												<?php endforeach; ?>

										</div>
									<?php } //end conditional ?>
									
								</div>
							</div>
								<?php

			
		elseif( get_row_layout() == 'landing_slider' ): 

				//vars
	          	$slider_section_id = strtolower(str_replace(" ","-", get_sub_field('slider_title')));//use the section title as section id. Replace spaces with dashes and convert to lowercase
	          	?>

			     <div class="main-gallery landing-slider landing-section" 								 
			     	<?php //add section title as id
						if ($slider_section_id) { echo 'id="' , $slider_section_id , '"';} ?>
				>

			     <?php while( have_rows('landing_slide') ): the_row();

			     			// vars
	          				$image = get_sub_field('slide_image'); ?>

								<div class="home-gallery-cell">

			                        		<div class="home-gallery-img">

			                        			<?php if( !empty($image) ): 
			                        				
			                        				//Set slider image size
			                        				$size = 'slider-image';
													$slide = $image['sizes'][ $size ]; ?>

													<img src="<?php echo $slide; ?>" alt="<?php echo $image['alt']; ?>" />

												<?php endif; ?>

			                          		</div>
								
								</div>

				<?php endwhile; ?>

			     </div>
			     <?php

		elseif( get_row_layout() == 'testimonial_slider' ):
				// vars
		          $testimonial_title = get_sub_field('testimonial_title');
		          $testimonial_bg_image = get_sub_field('testimonial_bg_image');
		          $testimonial_section_id = strtolower(str_replace(" ","-", get_sub_field('testimonial_title')));//use the section title as section id. Replace spaces with dashes and convert to lowercase
		          ?>

			     <div class="landing-testimonial landing-section" style="background: url('<?php echo $testimonial_bg_image; ?>'); background-position: 50%; background-size: cover;"
			     	<?php //add section title as id
			     		if ($testimonial_title) { echo 'id="' , $testimonial_section_id , '"';} ?>
			     >
			     	<div class="testimonial-inner">

						<?php if ($testimonial_title){ //Do section title if set ?>
		        	 		<div class="section-title">
		        	 			<h3><?php echo $testimonial_title; ?></h3>
		        	 			<?php echo paloma_accent_small(); ?>
		        	 		</div>
		        	 	<?php } ?>

						<div class="main-gallery testimonials">

						     <?php while( have_rows('testimonial_slide') ): the_row();

						          // vars
						          $testimonial_content = get_sub_field('testimonial_content');
						          $testimonial_attribution = get_sub_field('testimonial_attribution'); ?>
						          

											<div class="home-gallery-cell">

						                        		<div class="testimonial-content">
						                          			<?php if( $testimonial_content ): ?>
							                          					<?php echo $testimonial_content; ?>
							                          					<?php echo '<h4>' , $testimonial_attribution . '</h4>'; ?>
															<?php endif; ?>
						                          		</div>
											
											</div>

							<?php endwhile; ?>

						</div>
					</div>
			     </div>
			     <?php

        elseif( get_row_layout() == 'latest_posts' ): 
		        	//vars
					$latest_title = get_sub_field('latest_title');
					$latest_content = get_sub_field('latest_content');
					$content_after_posts = get_sub_field('content_after_posts');
				    $number_of_posts = get_sub_field('number_of_posts');
				    $latest_background_color = get_sub_field('latest_background_color');
				    $category_filter = get_sub_field('latest_categories');
				    $latest_section_id = strtolower(str_replace(" ","-", get_sub_field('latest_title')));//use the section title as section id. Replace spaces with dashes and convert to lowercase
		        	?>

		        	 <div class="landing-latest-posts landing-section" style="background-color: <?php echo $latest_background_color; ?>;"
		        	 	<?php //add section title as id
		        	 		if ($latest_title) { echo 'id="' , $latest_section_id , '"';} ?>
		        	 >
		        	 	<div class="landing-inner">

						    <?php if ($latest_title){ //Do section title if set ?>
			        	 		<div class="section-title">
			        	 			<h3><?php echo $latest_title; ?></h3>
			        	 			<?php echo paloma_accent_small(); ?>
			        	 		</div>
			        	 	<?php } ?>
		        	 		
		        	 		<?php if( $latest_content ): ?>
		        	 			<div class="latest-posts-precontent">
		        	 				<?php echo $latest_content; ?>
		        	 			</div>
		        	 		<?php endif; ?>

			        	 		<?php //run the loop for latest posts
				        	 		// WP_Query arguments
			        	 			// If no categories set, query all
			        	 			if (get_sub_field('latest_categories') == ""){
										$args = array (
										'post_type'              => 'post',
										'order'                  => 'DESC',
										'orderby'                => 'date',
										'posts_per_page'         => $number_of_posts,
										);
									} 

									// Else if categories selected, add them to query
									else {
										$post_category_arr = get_sub_field('latest_categories');

										$args = array (
											'post_type'              => 'post',
											'order'                  => 'DESC',
											'orderby'                => 'date',
											'posts_per_page'         => $number_of_posts,
											'cat'   				 =>	$post_category_arr
										);

									}

									//--------------------------------//
						
									$latests_query = new WP_Query( $args );
									if ( $latests_query->have_posts() ) {
									?>
					                	<div class="paloma-latest-posts">

					                <?php	 
										
										while ( $latests_query->have_posts() ) { 

											$latests_query->the_post();
												
											?>
					                            
					                            <div class="paloma-latest-single">
					                            	
					                                <a href="<?php the_permalink(); ?>">
					                                	<?php
					                                    	if ( has_post_thumbnail() ) {

																	the_post_thumbnail('landscape-featured');
															
															}

														?>
													</a>

														<header class="entry-header">
															<?php //display post category 	
										            			get_template_part( 'template-parts/content', 'category' ); 
															?>

													 		<a href="<?php the_permalink(); ?>">
													 			<h5><?php the_title(); ?></h5>
													 		</a>
												 		</header>
												 
					                            </div>              
								
					                <?php }	?>

									 </div>

									<?php wp_reset_postdata();
								}
									//--------------------------------//

								?>

							<?php if( $content_after_posts ): ?>
		        	 			<div class="latest-posts-content">
		        	 				<?php echo $content_after_posts; ?>
		        	 			</div>
		        	 		<?php endif; ?>

						</div>
		        	 </div>

		        <?php

        endif;

    endwhile;

else :

    // no layouts found

endif;

?>



		</main><!-- #main -->
	</div><!-- #primary -->


<?php get_footer(); ?>
<?php get_footer(); ?>