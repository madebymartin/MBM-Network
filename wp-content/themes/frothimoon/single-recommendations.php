<?php

    // calling the header.php
    get_header();

    // action hook for placing content above #container
    thematic_abovecontainer();

?>

		<div id="container">
			
			<?php thematic_abovecontent(); ?>
			
			<div id="content">
		
    	        <?php 
    	        
    	        the_post();
    	        
    	        // create the navigation above the content
				thematic_navigation_above();
		
    	        // calling the widget area 'single-top'
    	        get_sidebar('single-top');
		
    	        // action hook creating the single post
    	        thematic_singlepost();


if ( get_post_meta(get_the_ID(), '_cmb_recommendation_phone', true) ) { ?>
<span style="font-size:14px;"></br></br></br>Phone: <?php echo get_post_meta(get_the_ID(), "_cmb_recommendation_phone", true); ?></span>
<?php } else { ?><span></span><?php } ?>


<?php if ( get_post_meta(get_the_ID(), '_cmb_recommendation_url', true) ) { ?>
</br><a class="no-text-decoration" style="font-size:14px;" target="blank" href="http://<?php echo get_post_meta(get_the_ID(), "_cmb_recommendation_url", true); ?>"><?php echo get_post_meta(get_the_ID(), "_cmb_recommendation_url", true); ?></a>
<?php } else { ?><span></span><?php } 

				
    	        // calling the widget area 'single-insert'
    	        get_sidebar('single-insert');
		
    	        // create the navigation below the content
				// thematic_navigation_below();
		
/* Remove Comments from default page template */
	        
	        // calling the comments template
       		// if (THEMATIC_COMPATIBLE_COMMENT_HANDLING) {
			//	if ( get_post_custom_values('comments') ) {
			//		// Add a key/value of "comments" to enable comments on pages!
			//		thematic_comments_template();
			//	}
			// } else {
			//	thematic_comments_template();
			// }
		
    	        // calling the widget area 'single-bottom'
    	        get_sidebar('single-bottom');
    	        
    	        ?>
		
			</div><!-- #content -->
			
			<?php thematic_belowcontent(); ?> 
			
		</div><!-- #container -->
		
<?php 

    // action hook for placing content below #container
    thematic_belowcontainer();

    // calling the standard sidebar 
    thematic_sidebar();
    
    // calling footer.php
    get_footer();

?>