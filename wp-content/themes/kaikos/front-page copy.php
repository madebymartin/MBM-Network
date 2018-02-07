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
				// echo apply_filters( 'thematic_open_id_content', '<div id="content">' . "\n" );
			
				// calling the widget area 'page-top'
	            get_sidebar('page-top');
	
	            // start the loop
	            while ( have_posts() ) : the_post();

				// action hook for placing content above #post
	            thematic_abovepost();
	        ?>

<div class="slider-wrapper">
		<div id="slider" class="nivoSlider">

				<img src="<?php bloginfo('stylesheet_directory'); ?>/nivo-slider/images/homepageslide-hair01.jpg" alt="" data-transition="slideInLeft" title="Title" />
				<img src="<?php bloginfo('stylesheet_directory'); ?>/nivo-slider/images/homepageslide-makeup01.jpg" alt="" title="Title" />
				<img src="<?php bloginfo('stylesheet_directory'); ?>/nivo-slider/images/homepageslide-men01.jpg" alt="" title="Title" />


		</div>

</div>
					
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/nivo-slider/scripts/jquery-1.6.4.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/nivo-slider/jquery.nivo.slider.pack.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>





    	     		
<div id="homeslider">Slider goes in here</div>
				<?php
	                
	                // creating the post header
	                // thematic_postheader();
				?>
	                
	
						<?php
	                    	the_content();
	                    
	                    	wp_link_pages( "\t\t\t\t\t<div class='page-link'>" . __( 'Pages: ', 'thematic' ), "</div>\n", 'number' );
	                    
	                    	edit_post_link( __( 'Edit', 'thematic' ), "\n\t\t\t\t\t\t" . '<span class="edit-link">' , '</span>' . "\n" );
	                    ?>

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
	
			<!-- </div> #content -->
			
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
    
    // calling footer.php
    get_footer();
?>