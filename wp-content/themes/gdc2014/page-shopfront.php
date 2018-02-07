<?php
/**
 * Page Template
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
				echo apply_filters( 'thematic_open_id_content', '<div id="content">' . "\n" );
			
				// calling the widget area 'page-top'
	            get_sidebar('page-top');
	
	            // start the loop
	            while ( have_posts() ) : the_post();

				// action hook for placing content above #post
	            thematic_abovepost();
	        ?>
    	     		

				<?php
	                
	                // creating the post header
	                thematic_postheader();
				?>
	    
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> > 
            
					<div class="entry-content">
	
<?php if ( function_exists( 'meteor_slideshow' ) ) { meteor_slideshow("Products", "width: 600, height: 218, random: 1, pause:0"); } 


	                    	the_content();
	                    
	                    	wp_link_pages( "\t\t\t\t\t<div class='page-link'>" . __( 'Pages: ', 'thematic' ), "</div>\n", 'number' );
	                    
	                    	edit_post_link( __( 'Edit', 'thematic' ), "\n\t\t\t\t\t\t" . '<span class="edit-link">' , '</span>' . "\n" );
	                    ?>




					</div><!-- .entry-content -->


<div class="related">
	<h1 class="shopfronttitle">Top Products</h1>
	<?php echo do_shortcode('[featured_products per_page="-1" columns="3" pagination="no"]'); ?>
<div class="clear"></div>
</div>


<div class="related">
	<h1 class="shopfronttitle">Special Offers</h1>
	<?php echo do_shortcode('[sale_products per_page="-1" columns="3" pagination="no"]'); ?>
<div class="clear"></div>
</div>


					
				</div><!-- #post -->
	
			<?php
				// action hook for inserting content below #post
	        	thematic_belowpost();
	        		        
       			// action hook for calling the comments_template
       			// thematic_comments_template();
        		
	        	// end loop
        		endwhile;
	        
	        	// calling the widget area 'page-bottom'
	        	get_sidebar( 'page-bottom' );
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
    // thematic_sidebar();

require_once('sidebar-treatments.php'); 
    
    // calling footer.php
    get_footer();
?>