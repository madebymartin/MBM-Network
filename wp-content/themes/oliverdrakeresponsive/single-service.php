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
				echo apply_filters( 'thematic_open_id_content', '<div id="content" class="feature">' . "\n\n" );
							
	            // start the loop
	            while ( have_posts() ) : the_post();
    	        
    	        // create the navigation above the content
				thematic_navigation_above();
		
    	        // calling the widget area 'single-top'
    	        get_sidebar('single-top');
		
    	        
				// creating the post header
	                thematic_postheader();

if ( has_post_thumbnail() ) { the_post_thumbnail('200wide'); } ?>
						<?php if ( get_post_meta(get_the_ID(), '_cmb_brand_url', true) ) { ?>
							<br><a class="right" href="<?php echo get_post_meta(get_the_ID(), "_cmb_brand_url", true); ?>" title="<?php the_title(); ?>" target="blank">Visit Website...</a><br><br>
						<?php } 


// action hook creating the single post
    	        thematic_content();


    	        // calling the widget area 'single-insert'
    	        get_sidebar('single-insert');

		?><br><br><?php

    	        // create the navigation below the content
				thematic_navigation_below();
		
       			// action hook for calling the comments_template
    	        thematic_comments_template();
    	        
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