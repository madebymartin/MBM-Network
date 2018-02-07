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
	            // start the loop
	            while ( have_posts() ) : the_post();

				thematic_navigation_above();
    	        get_sidebar('single-top');
    	        thematic_singlepost();


				$services = get_post_meta(get_the_ID(), '_cmb_projectservices', false);
			    if ($services){ ?>
			    <div class="feature projectservices"><h4>Services Provided:</h4>
				    <ul>
					   <?php
					  foreach ($services as $service)
					  	foreach($service as $val){
					  		echo '<li>' . $val . '</li>';
					  	} ?>
				    </ul></div>
				<?php } 
				

				if ( get_post_meta(get_the_ID(), '_cmb_testimonial', true) ) { ?>
	    	        <div class="feature projecttestimonial"><p>"<?php echo get_post_meta(get_the_ID(), "_cmb_testimonial", true); ?>"</p>
	    	        	<?php if ( get_post_meta(get_the_ID(), '_cmb_clientname', true) ) { ?>
	    	        		- <?php echo get_post_meta(get_the_ID(), "_cmb_clientname", true); ?>
	    	        	<?php } ?>

	    	        	<?php if ( get_post_meta(get_the_ID(), '_cmb_clientlocation', true) ) { ?>
	    	        		, <?php echo get_post_meta(get_the_ID(), "_cmb_clientlocation", true); ?>
	    	        	<?php } ?>
	    	        </div>
    	        <?php }


    	        if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>

    	        <?php if (MultiPostThumbnails::has_post_thumbnail(get_post_type(), 'mbm_image2')) { ?>
	    	    <?php MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'mbm_image2', NULL,  ''); ?>
	    	    <?php } ?>

    	        <?php if (MultiPostThumbnails::has_post_thumbnail(get_post_type(), 'mbm_image3')) { ?>
	    	    <?php MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'mbm_image3', NULL,  ''); ?>
	    	    <?php } ?>

	    	    <?php if (MultiPostThumbnails::has_post_thumbnail(get_post_type(), 'mbm_image4')) { ?>
	    	    <?php MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'mbm_image4', NULL,  ''); ?>
	    	    <?php } ?>

	    	    <?php if (MultiPostThumbnails::has_post_thumbnail(get_post_type(), 'mbm_image5')) { ?>
	    	    <?php MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'mbm_image5', NULL,  ''); ?>
	    	    <?php } ?>

	    	    <?php if (MultiPostThumbnails::has_post_thumbnail(get_post_type(), 'mbm_image6')) { ?>
	    	    <?php MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'mbm_image6', NULL,  ''); ?>
	    	    <?php } ?>

	    	    <?php if (MultiPostThumbnails::has_post_thumbnail(get_post_type(), 'mbm_image7')) { ?>
	    	    <?php MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'mbm_image7', NULL,  ''); ?>
	    	    <?php } ?>

	    	    <?php if (MultiPostThumbnails::has_post_thumbnail(get_post_type(), 'mbm_image8')) { ?>
	    	    <?php MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'mbm_image8', NULL,  ''); ?>
	    	    <?php } 


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