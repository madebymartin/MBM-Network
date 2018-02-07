<?php

// PAGE TOP
function aside_testimonial() { 
if (!is_page( 19 ) ) {
	$loop = new WP_Query( array( 
	'post_type' => 'testimonial',
	'orderby' => 'rand',
	'posts_per_page' => '1', 
	'order' => 'ASC'
	) ); ?>
			
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
	<div class="aside">
		<div class="testimonial">
			<?php the_content(); ?>
		</div>
		<span class="speech"><?php the_title(); ?></span>
		<?php if (!is_page( 27 ) ) { ?>
			<br><p style="text-align:center;">(If you have some feedback you'd like to share,<br><a href="<?php echo get_permalink('27'); ?>">please let us know here.</a>)</p>
		<?php } ?>
		
	</div>
<?php endwhile; ?>
<?php
} ?>



<?php }
add_action('thematic_betweenmainasides','aside_testimonial');






/*
Thematic Position Hooks


thematic_before()
	Located in header.php just after the opening body tag, before anything else.


thematic_aboveheader()
	Located in header.php just before the header div.


thematic_header()
	This hook builds the content of the header div and loads the following actions:
	Action 	Position Number
	thematic_brandingopen() 	1
	thematic_blogtitle() 		3
	thematic_blogdescription() 	5
	thematic_brandingclose() 	7
	thematic_access() 			9

thematic_belowheader()
	Located in header.php just after the header div.

thematic_abovecomments()

thematic_abovecommentslist()

thematic_belowcommentslist()

thematic_abovetrackbackslist()

thematic_belowtrackbackslist()

thematic_abovecommentsform()

thematic_show_subscription_checkbox()

thematic_belowcommentsform()

thematic_show_manual_subscription_form()

thematic_belowcomments()

thematic_abovemainasides()

thematic_betweenmainasides()

thematic_belowmainasides()

thematic_abovefooter()

thematic_footer()

thematic_after()

*/


?>