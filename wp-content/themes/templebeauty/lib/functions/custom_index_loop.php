<?php
	function childtheme_override_index_loop() {
		
		// Count the number of posts so we can insert a widgetized area
		$count = 1;
		while ( have_posts() ) : the_post();

				// action hook for inserting content above #post
				thematic_abovepost();
				?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> > 


     				
<div class="blog-content">	
	<h2><?php the_title(); ?><span class="date"> (<?php echo get_the_date( 'jS F Y' ); ?>)</span></h2>

<?php 
if ( has_post_thumbnail() ) { ?>
<div class="imageholder">
	<span class="homebuttonoverlay"></span>
	<?php the_post_thumbnail( 'button' ); ?>
</div>
<?php } ?>


	


<?php the_content(); ?>




						<?php wp_link_pages(array('before' => sprintf('<div class="page-link">%s', __('Pages:', 'thematic')),
													'after' => '</div>')); 
edit_post_link( __( 'Edit', 'thematic' ), "\n\t\t\t\t\t\t" . '<span class="edit-link">' , '</span>' . "\n" );
?>				
					</div><!-- .blog-content -->
					
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