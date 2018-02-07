<?php /*---CUSTOM ARCHIVE LOOP---*/


function childtheme_override_archive_loop() {



global $query_string; // required


$posts = query_posts($query_string.'&meta_key=_cmb_treatment_price&orderby=meta_value_num&order=ASC');
				

while ( have_posts() ) : the_post(); 
		
?>

<div class="entry-content treatment">

<h3><?php the_title(); ?>



<?php if ( get_post_meta(get_the_ID(), '_cmb_treatment_price', true) ) { ?>
<span class="treatment_price">£<?php echo get_post_meta(get_the_ID(), "_cmb_treatment_price", true); ?></span>
<?php } else { ?><?php } ?>

<?php if ( get_post_meta(get_the_ID(), '_cmb_treatment_duration', true) ) { ?>
<span class="treatment_duration">(<?php echo get_post_meta(get_the_ID(), "_cmb_treatment_duration", true); ?> minutes)</span>
<?php } else { ?> <?php } ?>


</h3>
<div class="clearfix"></div>
<?php the_content();?>
<?php edit_post_link(__('Edit', 'thematic'),'<span class="edit-link">','</span>') ?>

</div><!-- #post -->

			<?php 
			
				thematic_belowpost();
		
		endwhile;

wp_reset_query(); // reset the query


}
?>