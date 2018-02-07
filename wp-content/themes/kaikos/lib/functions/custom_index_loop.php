<?php
	function childtheme_override_index_loop() {
		
		// Count the number of posts so we can insert a widgetized area
		$count = 1;
		while ( have_posts() ) : the_post();

				// action hook for inserting content above #post
				thematic_abovepost();
				?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> > 



<div class="date">
<span class="month"><?php echo get_the_date( 'M' ); ?></span>
<span class="year"><?php echo get_the_date( 'Y' ); ?></span>
<span class="day"><?php echo get_the_date( 'd' ); ?></span>
</div>	

     				
<div class="blog-content">	
	<h2><?php the_title(); ?></h2>
<?php the_post_thumbnail( 'thumb' ); ?>
<?php thematic_content(); ?>




						<?php wp_link_pages(array('before' => sprintf('<div class="page-link">%s', __('Pages:', 'thematic')),
													'after' => '</div>')); 
edit_post_link( __( 'Edit', 'thematic' ), "\n\t\t\t\t\t\t" . '<span class="edit-link">' , '</span>' . "\n" );
?>				
					</div><!-- .entry-content -->
					
					<?php thematic_postfooter(); ?>
					
				</div><!-- #post -->

			<?php 
				// action hook for insterting content below #post
				thematic_belowpost();
				
				comments_template();

				if ( $count == thematic_get_theme_opt( 'index_insert' ) ) {
					get_sidebar('index-insert');
				}
				$count = $count + 1;
		endwhile;
	} // end index_loop
?>