<?php
/**
 * Template Name: Treatments: Godalming
 *
 * This Full Width template removes the primary and secondary asides so that content
 * can be displayed the entire width of the #content area.
 *
 */

    // calling the header.php
    get_header();

    // action hook for placing content above #container
    thematic_abovecontainer();

?>

<div id="container">
	<div class="salonslides">
		<?php if ( function_exists( 'meteor_slideshow' ) ) { meteor_slideshow("godalming", "width: 230, height: 300"); } ?>
	</div><!-- salonslides -->
		
				
			<?php thematic_abovecontent(); ?>
	<div id="narrowcontent">
	<?php
	// calling the widget area 'page-top'
	get_sidebar('page-top');
	the_post();
	thematic_abovepost();
	?>
	            
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
					
	    	// creating the post header
	    	thematic_postheader();
	    	?>
	                
			<div class="entry-content">
	        	<?php
	        	the_content(); 
	        	?>
			</div><!-- .entry-content -->
					
					
			<?php $loop = new WP_Query( array( 'post_type' => 'treatments', 'posts_per_page' => 100, '&orderby=title&order=asc' ) ); ?>
			
			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
			
			<?php if ( get_post_meta(get_the_ID(), 'rw_godalming', true) ) { ?>
			<h1 class="treatment-name"><?php the_title(); ?>
				
				<?php if ( get_post_meta(get_the_ID(), 'rw_treatmentprice', true) ) { ?>
				<span class="price"><?php echo get_post_meta(get_the_ID(), "rw_treatmentprice", true); ?>
				<?php } else { ?><span></span><?php } ?>
				
				<?php if ( get_post_meta(get_the_ID(), 'rw_treatmentduration', true) ) { ?>
				<span class="price">(<?php echo get_post_meta(get_the_ID(), "rw_treatmentduration", true); ?>)
				<?php } else { ?><span></span><?php } ?>
				
			</span></h1>
			
			<p><?php echo get_post_meta(get_the_ID(), "rw_treatmentdescription", true); ?></p>
			<p><?php the_content(); ?></p>
			
			<?php } else { ?><span></span><?php } ?>
			<?php edit_post_link(__('Edit', 'thematic'),'<span class="edit-link">','</span>') ?>
			<?php endwhile; ?>
		
		</div><!-- #post -->
		
		<?php thematic_belowpost();
	    // calling the widget area 'page-bottom'
	    get_sidebar('page-bottom');
	    ?>

	</div><!-- #narrowcontent -->
	<?php thematic_belowcontent(); ?> 
</div><!-- #container -->



<?php 
    // action hook for placing content below #container
    thematic_belowcontainer();
?>



<div id="primary" class="aside main-aside">
<?php wp_nav_menu( array('menu' => 'Godalming Menu' )); ?> 
</div>


<?php


    
    // calling footer.php
    get_footer();

?>