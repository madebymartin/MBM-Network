<?php
/*-----CUSTOM CATEGORY LOOP-----*/
	function childtheme_override_category_loop() {



	while (have_posts()) : the_post(); 
		
				thematic_abovepost(); ?>
	


				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> > 


     				
<div class="blog-content">	
	<h3><?php the_title(); ?><span class="date"> (<?php echo get_the_date( 'jS F Y' ); ?>)</span></h3>

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


	
					<?php thematic_postfooter(); ?>

			<?php 
		
				//thematic_belowpost();
		
		endwhile;
	
} // end category_loop

?>