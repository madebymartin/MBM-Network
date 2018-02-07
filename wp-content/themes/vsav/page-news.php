<?php
/**
 * Template Name: News Page
 *
 * Displays posts as the 'posts' page would but allows custom features that are plugged into 'pages'
 *
 * @package Thematic
 * @subpackage Templates
 *
 */
    get_header();
    thematic_abovecontainer();
?>

		<div id="container">
			<?php
				thematic_abovecontent();
				echo apply_filters( 'thematic_open_id_content', '<div id="content">' . "\n" );
	            get_sidebar('page-top');
	
	            while ( have_posts() ) : the_post();
	            thematic_abovepost();
	        ?>
    	     		
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> > 
				<?php 
				//thematic_postheader(); 
				?>
					<div class="entry-content">
						<?php

	                    	the_content();
	                    	wp_link_pages( "\t\t\t\t\t<div class='page-link'>" . __( 'Pages: ', 'thematic' ), "</div>\n", 'number' );
	                    	
	                    ?>
					</div><!-- .entry-content -->


					<?php
					//GET ALL CURRENT USERS BOOKINGS EVER (INCLUDES CANCELLED ONES)
					$blogloop = new WP_Query( array(
						'post_type' => 'post',
						'posts_per_page' => '-1',
						'status' => 'publish',
						'orderby' => 'title',
						'order' => 'ASC',
					));

					if($blogloop->have_posts() ){				
						while ( $blogloop->have_posts() ) : $blogloop->the_post();
							
							echo get_the_date();
							echo '<h2 class="entry-title">' . get_the_title( get_the_id() ) . '' . edit_post_link( __( '> Edit this news story', 'thematic' ), "\n\t\t\t\t\t\t" . '<span class="edit-link">' , '</span>' . "\n" ) .'</h2>';
							echo '<div class="entry-content">' . the_content() . '</div>';
							//edit_post_link( );
							
							echo '<br><hr>';

						endwhile;
					} 
					wp_reset_query();
					?>


				</div><!-- #post -->
			<?php
	        	thematic_belowpost();
//				thematic_comments_template();
        		
	        	// end loop
        		endwhile;
	        
	        	get_sidebar( 'page-bottom' );
	        ?>
			</div><!-- #content -->
			<?php thematic_belowcontent(); ?> 
		</div><!-- #container -->
<?php 
    thematic_belowcontainer();
    thematic_sidebar();
    get_footer();
?>