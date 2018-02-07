<?php
/**
 * Page Template
 *
 * …
 * 
 * @package Thematic
 * @subpackage Templates
 */
 
    // calling the header.php
    get_header();

    // action hook for placing content above #container
    thematic_abovecontainer();
?>


		<div class="container content">
		<?php get_template_part( 'lib/template_parts/title', 'banner' ); ?>
		<div class="panel"><?php the_content(); ?></div>
		</div>


		<?php get_template_part( 'lib/template_parts/menu', 'aside_treatment_categories' ); ?>


		<div id="container">
		
			<?php
				// action hook for placing content above #content
				thematic_abovecontent();

				// filter for manipulating the element that wraps the content 
				echo apply_filters( 'thematic_open_id_content', '<div id="content">' . "\n" );
			
				// calling the widget area 'page-top'
	            get_sidebar('page-top');
	
	            // start the loop
	            while ( have_posts() ) : the_post();

				// action hook for placing content above #post
	            thematic_abovepost();
	        ?>
    	     		
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> > 
	                
					<div class="entry-content">

					<?php 
					//get_template_part( 'lib/template_parts/menu', 'featured_treatments' ); 
					//?>


					<?php
							// Set up query
									$query_args = array( 
									'post_type' => 'treatments', 
									'posts_per_page' => -1, 
									'orderby' => 'date', 
									'order' => 'DESC',
									   'meta_query' => array(
										       array(
									           'key' => '_cmb_treatmentofmonth',
									           'value' => '1',
									           'compare' => 'IN',
										       )

									   )
									
								); 

									// Run the query
									$q = new WP_Query( $query_args );

									if ( $q->have_posts() ) {

										echo '<ul class="margin0 padding0">';

											// Print each product
											while( $q->have_posts() ) : $q->the_post();

												echo '<li class="featured_product">';
												echo'<a href="';
												echo the_permalink();
												echo '" title="';
												echo the_title();
												echo '">';
													if (MultiPostThumbnails::has_post_thumbnail(get_post_type(), 'featured_treatment')) { MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'featured_treatment', NULL,  '700sq', array('class' => '')); }
													else{the_title();} 		
													//echo get_post_meta(get_the_id(), '_cmb_treatmentofmonth', true);						            
												echo '</a></li>';
											endwhile;

										echo '</ul>';

									} else {}
							?>



					</div><!-- .entry-content -->
					
				</div><!-- #post -->
	
			<?php
				// action hook for inserting content below #post
	        	thematic_belowpost();
	        		        
       			// action hook for calling the comments_template
       			// thematic_comments_template();
        		
	        	// end loop
        		endwhile;
	        
	        	// calling the widget area 'page-bottom'
	        	get_sidebar( 'page-bottom' );
	        ?>
	
			</div><!-- #content -->
			
			<?php 
				// action hook for placing content below #content
				thematic_belowcontent(); 
			?> 
			
		</div><!-- #container -->

<?php 
    // action hook for placing content below #container
    thematic_belowcontainer();

    // calling the standard sidebar 
    thematic_sidebar();
    
    // calling footer.php
    get_footer();
?>