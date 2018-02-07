<?php
/*-----CUSTOM CATEGORY LOOP-----*/
	function childtheme_override_category_loop() {



	while (have_posts()) : the_post(); 
		
				thematic_abovepost(); ?>
	


<a href="<?php echo get_permalink(); ?>" class="download">
<span class="listingtitle"><?php the_title(); ?></span>
<?php 
if ( has_post_thumbnail() ) {
  the_post_thumbnail('posterthumb');
} 
else {?>
<img src="<?php bloginfo('stylesheet_directory');?>/images/ucw-blank.jpg" />
<?php } ?>


<div class="clear"></div>
</a>



	
					<?php thematic_postfooter(); ?>

			<?php 
		
				//thematic_belowpost();
		
		endwhile;
	
} // end category_loop

?>