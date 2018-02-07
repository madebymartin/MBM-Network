<?php
/**
 * Template Name: Packages: Godalming
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
					
					
			<?php $loop = new WP_Query( array( 'post_type' => 'packages', 'posts_per_page' => 100, '&orderby=title&order=asc' ) ); ?>
			
			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
			<?php if ( get_post_meta(get_the_ID(), 'rw_godalming', true) ) { ?>
			<h1 class="treatment-name"><?php the_title(); ?>
			
				<?php if ( get_post_meta(get_the_ID(), 'rw_fulldayprice', true) ) { ?>
				<p class="price">Full Day £<?php echo get_post_meta(get_the_ID(), "rw_fulldayprice", true); ?></p>
				<?php } else { ?><?php } ?>
				
				<?php if ( get_post_meta(get_the_ID(), 'rw_halfdayprice', true) ) { ?>
				<p class="price">Half Day £<?php echo get_post_meta(get_the_ID(), "rw_halfdayprice", true); ?></p>
				<?php } else { ?><?php } ?>
			</h1>
				<?php // calling the widget area 'single-insert'
    	        get_sidebar('single-insert');
	            the_content(); 
	            ?>
			<p class="price"><?php edit_post_link(__('Edit', 'thematic'),'<span class="edit-link">','</span>') ?></p>
			<?php } else { ?><?php } ?>
			
			
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