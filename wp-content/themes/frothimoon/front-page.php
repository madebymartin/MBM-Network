<?php
/**
 * Page Template
 *
 * …
 * 
 * @package Thematic
 * @subpackage Templates
 */
 
    get_header();
    thematic_abovecontainer();
?>

		<div id="container">
			<?php
				thematic_abovecontent();
				// filter for manipulating the element that wraps the content 
				echo apply_filters( 'thematic_open_id_content', '<div id="content">' . "\n" );
	            get_sidebar('page-top');

	            //start loop
	            while ( have_posts() ) : the_post();
	            thematic_abovepost();
	        ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> > 
				<?php
	                thematic_postheader();

	                if ( function_exists( 'meteor_slideshow' ) ) { 
	                	echo '<div class="" id="homeslides">';
	                	meteor_slideshow( "", "pause: 0, random: 1" ); 
	                	echo '</div>';
	                }
				?>
					<div class="entry-content">
						<?php
	                    	the_content();
	                    	wp_link_pages( "\t\t\t\t\t<div class='page-link'>" . __( 'Pages: ', 'thematic' ), "</div>\n", 'number' );
	                    	edit_post_link( __( 'Edit', 'thematic' ), "\n\t\t\t\t\t\t" . '<span class="edit-link">' , '</span>' . "\n" );
	                    ?>
					</div><!-- .entry-content -->
					<div class="clear"></div>

					<?php
					$the_query = new WP_Query(
					array (
					'post_type' => 'testimonial',
					'posts_per_page' => '1',
					'orderby' => 'rand',
					'order' => 'ASC'
					));
					while ( $the_query->have_posts() ) : $the_query->the_post();

						echo '<div id="testimonial">';
							echo '<div id="quotemark1"></div>';
							the_content();
							echo '<div class="author">';
								the_title();
							echo '</div>';
							echo '<div id="quotemark2"></div>';
						echo '</div>';

					endwhile;
					wp_reset_postdata();

					?>
				</div><!-- #post -->
			<?php
	        	thematic_belowpost();
       		
	        	// end loop
        		endwhile;
	        
	        	get_sidebar( 'page-bottom' );
	        ?>
			</div><!-- #content -->
			<?php 
				thematic_belowcontent(); 
			?> 
		</div><!-- #container -->
<?php 
    thematic_belowcontainer();
    thematic_sidebar();
    get_footer();
?>