<?php
// The Search Loop

	function childtheme_override_search_loop() {
		while ( have_posts() ) : the_post(); 
		
				thematic_abovepost(); ?>

				<div id="post-<?php the_ID();
					echo '" ';
					if (!(THEMATIC_COMPATIBLE_POST_CLASS)) {
						post_class();
						echo '>';
					} else {
						echo 'class="';
						thematic_post_class();
						echo '">';
					} ?>

<div class="left"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
<div class="clear"></div>
<div class="entry-content">
<div class="left"><a href="<?php the_permalink(); ?>">
<?php
if(has_post_thumbnail()) { ?>
<?php the_post_thumbnail(thumb); ?>
<?php } else {
    echo '<img src="'.get_bloginfo("stylesheet_directory").'/images/gdc-swan-150-white.png" />';
}
?>
</a></div>


	
	<?php thematic_content(); ?>
</div><!-- .entry-content -->
					<?php thematic_postfooter(); ?>
<div class="clear"></div>
<hr />
				</div><!-- #post -->


			<?php 
		
				thematic_belowpost();
		
		endwhile;
	}
 // end search_loop


?>