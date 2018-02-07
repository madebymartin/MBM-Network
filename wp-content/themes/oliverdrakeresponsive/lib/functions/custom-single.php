<?php
function childtheme_override_single_post () { ?>


<?php
// action hook for insterting content above #post
				thematic_abovepost();
				?>
			
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> > 

				<?php

	            	// creating the post header
	            	thematic_postheader();
	            ?>
     				
					<div class="entry-content">
						<?php if ( has_post_thumbnail() ) { the_post_thumbnail('200wide'); } ?>
						<?php if ( get_post_meta(get_the_ID(), '_cmb_brand_url', true) ) { ?>
							<br><br><a class="right" href="<?php echo get_post_meta(get_the_ID(), "_cmb_brand_url", true); ?>" title="<?php the_title(); ?>" target="blank">Visit Website...</a>
						<?php } ?>


						<?php thematic_content(); ?>

						<?php wp_link_pages(array('before' => sprintf('<div class="page-link">%s', __('Pages:', 'thematic')),
													'after' => '</div>')); ?>
						
					</div><!-- .entry-content -->
					
					<?php thematic_postfooter(); ?>
					
				</div><!-- #post -->
		<?php
			// action hook for insterting content below #post
			thematic_belowpost();
	                    ?>
<?php }


?>