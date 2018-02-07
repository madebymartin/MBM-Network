<?php

    // calling the header.php
    get_header();

    // action hook for placing content above #container
    thematic_abovecontainer();
?>
<div class="centre"><?php the_content();
	                    wp_link_pages("\t\t\t\t\t<div class='page-link'>".__('Pages: ', 'thematic'), "</div>\n", 'number');
	                    ?>
	                    
	<div id="homeslides"><?php if ( function_exists( 'meteor_slideshow' ) ) { meteor_slideshow('home'); } ?>
	</div><!-- homeslides -->
	
	
</div><!-- centre -->
	        	                    
		<div id="container">
		
			<?php thematic_abovecontent(); ?>
		
			<div id="content">
	            <?php
	            // calling the widget area 'page-top'
	            get_sidebar('page-top');
	            the_post();
	            thematic_abovepost();
	            ?>
				</div><!-- .post -->
	
	        <?php
	        thematic_belowpost();
	        
	        // calling the widget area 'page-bottom'
	        get_sidebar('page-bottom');
	        ?>
			</div><!-- #content -->
			
			
			
			<?php thematic_belowcontent(); ?> 
		</div><!-- #container -->
		
		<div class="block">
	
	
		<div class="footerlink">
			<a id="treatmentofmonth" class="footerpic" href="<?php echo get_permalink(251); ?>" ">
			<?php echo get_the_post_thumbnail('251', 'feature'); ?>
			
			<span>
			<h3><?php echo get_the_title(251) ?> </h3>
			<p class=""><?php echo get_post_meta(251, "rw_caption", true); ?></p>
			</span>
			</a>
		</div>
		
		
    	<div class="footerlink">
    		<a id="productofmonth" class="footerpic" href="<?php echo get_permalink(249); ?>" ">
			<?php echo get_the_post_thumbnail('249', 'feature'); ?>
			
    		<span>
    		<h3><?php echo get_the_title(249) ?> </h3>
<p class=""><?php echo get_post_meta(249, "rw_caption", true); ?></p>
    		    		</span></a>
    		
    					
		</div>
		
		
	</div><!-- #block -->
		
<?php 

    // action hook for placing content below #container
    thematic_belowcontainer();
    
    // calling footer.php
    get_footer();

?>