<?php
/**
 * Single Post Template
 *
 * …
 * 
 * @package Thematic
 * @subpackage Templates
 */
    get_header();
    thematic_abovecontainer();
?>
		<div id="container">
			
			<?php
			thematic_abovecontent();
			echo apply_filters( 'thematic_open_id_content', '<div id="content">' . "\n\n" );
	            while ( have_posts() ) : the_post();
					thematic_navigation_above();
	    	        get_sidebar('single-top');
	    	        thematic_singlepost();
	    	        get_sidebar('single-insert');
					thematic_navigation_below();
	    	        thematic_comments_template();
    	        // end the loop
        		endwhile;
    	        get_sidebar('single-bottom');
				?>
			</div><!-- #content -->
			<?php thematic_belowcontent(); ?> 
		</div><!-- #container -->
		
<?php 
    thematic_belowcontainer();
    thematic_sidebar();
    get_footer();
?>