<?php
/*-----CUSTOM CATEGORY LOOP-----*/
	function childtheme_override_category_loop() {
	while (have_posts()) : the_post(); 
		
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
					}
     				 ?>
					<div class="entry-content">


<h1><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h1>
<br/>
<!-- HIDE DATE

<h5 style="margin:0 0 30px;"><?php the_time('F jS, Y'); ?></h5> -->
<a class="shadowpic" href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail(news); ?></a>
<div class=""><?php the_content(); ?></div>



	
					</div><!-- .entry-content -->
					<?php thematic_postfooter(); ?>
				</div><!-- #post -->

			<?php 
		
				//thematic_belowpost();
		
		endwhile;
	
} // end category_loop

?>