<?php
/*-----CUSTOM CATEGORY LOOP-----*/
	function childtheme_override_category_loop() {
	while (have_posts()) : the_post(); 
		
				thematic_abovepost(); ?>
	


<a href="<?php echo get_permalink(); ?>" class="download">

<?php 
if ( has_post_thumbnail() ) {
  the_post_thumbnail('posterthumb');
} 
else {?>
<img src="<?php bloginfo('stylesheet_directory');?>/images/fallback.jpg" />
<?php } ?>

<h1 class="listingtitle"><?php the_title(); ?></h1>
<div class="clear"></div>
</a>



	
					<?php thematic_postfooter(); ?>

			<?php 
		
				//thematic_belowpost();
		
		endwhile;
	
} // end category_loop

?>