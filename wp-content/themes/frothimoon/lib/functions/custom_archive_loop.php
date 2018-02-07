<?php
/*---CUSTOM ARCHIVE LOOP---*/

function childtheme_override_archive_loop() {
while ( have_posts() ) : the_post(); 
		
				thematic_abovepost(); ?>

				<div id="post-<?php the_ID(); ?>" class="treatment">

					<span class="treatment_title"><?php the_title(); ?></span>

					<?php if ( get_post_meta(get_the_ID(), '_cmb_treatment_price', true) ) { ?>
					<span class="treatment_price">£<?php echo get_post_meta(get_the_ID(), "_cmb_treatment_price", true); ?></span>
					<div class="clear"></div>
					<?php } else { ?><span></span><?php } ?>



					<?php if ( get_post_meta(get_the_ID(), '_cmb_treatment_subtitle', true) ) { ?>
					<span class="treatment_subtitle"><?php echo get_post_meta(get_the_ID(), "_cmb_treatment_subtitle", true); ?></span>
					<div class="clear"></div>
					<?php } else { ?><span></span><div class="clear"></div><?php } ?>


					<?php the_content();?>
					<?php edit_post_link(__('Edit', 'thematic'),'<span class="edit-link">','</span>') ?>



				</div><!-- #post -->

			<?php 
			
				thematic_belowpost();
		
		endwhile;
}
?>