<?php
    get_header();
    thematic_abovecontainer();
    ?>
		<div id="container">		
			<?php thematic_abovecontent(); ?>
			<div id="content">
    	        <?php 
    	        the_post();
    	        get_sidebar('single-top');
    ?>

	<h1 class="entry-title"><?php the_title()?></h1>
	<div class="sm-single-location-default-template result">

		<?php if ( get_post_meta(get_the_ID(), 'location_special', true) ) { ?>
		<div class="special"></div>
		<?php } else { }

		if(get_post_meta( get_the_id(), 'cmb_slide_image', false )){
			// HAS AT LEAST ONE SLIDE IMAGE
			$slides = get_post_meta( get_the_id(), 'cmb_slide_image', false );

?>

		<section class="slider">
            <div class="flexslider">
                <ul class="slides">
                <?php 

                // FIRST SLIDE IS FEATURED IMAGE IF SET
                if ( has_post_thumbnail() ) { 
                	echo '<li>';
                	the_post_thumbnail('banner'); 
                	echo '</li>';
                } 

                // ADD SLIDE FOR EACH SLIDER IMAGE ADDED
                foreach ($slides as $key => $slide){
                    echo '<li><img src="';
                    echo wp_get_attachment_url( $slide );
                    echo '"></li>';
                } ?>
                </ul>
            </div>
        </section>


          <!-- FlexSlider -->
          <script type="text/javascript">
            jQuery(window).load(function(){
              jQuery('.flexslider').flexslider({
                animation: "fade",
                easing: "swing",
                allowOneSlide: "true",
                slideshowSpeed: 3000,
                animationSpeed: 1000,
                pauseOnAction: false, //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
                pauseOnHover: false,
                directionNav: false,
                start: function(slider){
                  jQuery('body').removeClass('loading');
                }
              });
            });
          </script>


<?php
		} else{
			// NO SLIDE IMAGES
			if ( has_post_thumbnail() ) { the_post_thumbnail('banner'); }  
			else{ 
                //echo '<img style="margin:0 auto; max-width:8em;" src="' . bloginfo( 'stylesheet_directory' ) . '/images/placeholder.png " width="50%" />'; 
            } 
		}
		
        the_content();
        ?>
	</div>
    
<?php				
    	        get_sidebar('single-insert');
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