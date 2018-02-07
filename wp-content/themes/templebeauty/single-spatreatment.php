<?php
/**
 * Single Post Template
 *
 * …
 * 
 * @package Thematic
 * @subpackage Templates
 */

    // calling the header.php
    get_header();

    // action hook for placing content above #container
    thematic_abovecontainer();
?>

		<div id="container">
			
			<?php
				// action hook for placing content above #content
				thematic_abovecontent();
						
				// filter for manipulating the element that wraps the content 
				echo apply_filters( 'thematic_open_id_content', '<div id="content">' . "\n\n" );
							
	            // start the loop
	            while ( have_posts() ) : the_post();
    	        
    	        // create the navigation above the content
				thematic_navigation_above();
		
    	        // calling the widget area 'single-top'
    	        get_sidebar('single-top');
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


<h4>See all:
<?php
echo get_the_term_list( $post->ID, 'spacategory', ' ', ', ', '' );
?>
</h4>

</div><!-- #post -->

<?php				
    	        // calling the widget area 'single-insert'
    	        get_sidebar('single-insert');
		
    	        // create the navigation below the content
				//thematic_navigation_below();
		
       			// action hook for calling the comments_template
    	        // thematic_comments_template();
    	        
    	        // end the loop
        		endwhile;
		
    	        // calling the widget area 'single-bottom'
    	        get_sidebar('single-bottom');
			?>
		
			</div><!-- #content -->
			
			<?php
				// action hook for placing content below #content
				thematic_belowcontent();
			?> 
		</div><!-- #container -->
		
<?php 
    // action hook for placing content below #container
    thematic_belowcontainer();

    // calling the standard sidebar 
    thematic_sidebar();
    
    // calling footer.php
    get_footer();
?>