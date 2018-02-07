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
	           // while ( have_posts() ) : the_post();

				// action hook for placing content above #post
	            thematic_abovepost();
	        ?>


				<?php
	                
	                // creating the post header
	                // thematic_postheader();
				?>
	

<div id="homeslider"><?php if ( function_exists('show_nivo_slider') ) { show_nivo_slider(); }  ?></div>


     

	<?php if ( get_post_meta(get_the_ID(), '_cmb_cta_active', true) ) { ?>

<div class="calltoaction">
<h2>
	<?php if ( get_post_meta(get_the_ID(), '_cmb_cta_title', true) ) { ?>
	<?php echo get_post_meta(get_the_ID(), "_cmb_cta_title", true); ?>
	<?php } else { ?>We're waiting to help<?php } ?>
</h2>


<p>
	<?php if ( get_post_meta(get_the_ID(), '_cmb_cta_text', true) ) { ?>
	<?php echo get_post_meta(get_the_ID(), "_cmb_cta_text", true); ?>
	<?php } else { ?>Our friendly staff are on hand to help you find the perfect treatment for your hair, spa or beauty needs.<?php } ?>

</p>
<a class="button" href="<?php if ( get_post_meta(get_the_ID(), '_cmb_cta_link', true) ) { echo get_post_meta(get_the_ID(), "_cmb_cta_link", true); } else { ?><?php echo get_permalink( '5' ); ?><?php } ?>">	<?php if ( get_post_meta(get_the_ID(), '_cmb_cta_button', true) ) { ?>
	<?php echo get_post_meta(get_the_ID(), "_cmb_cta_button", true); ?>
	<?php } else { ?>Enquire Now<?php } ?></a>
</div>

	<?php } else { ?><?php } ?>










<div id="features">
	<div class="aside">
		<a href="<?php echo get_permalink( '32' ); ?>">
		<?php echo get_the_post_thumbnail( '32', 'featurebutton' ); ?>
		Hair		
		</a>
<p>Your hair is the ultimate fashion accessory</p>
	</div>



	<div class="aside">
		<a href="<?php echo get_permalink( '33' ); ?>">
		<?php echo get_the_post_thumbnail( '33', 'featurebutton' ); ?>
		Spa
		</a>
<p>Spa experiences from Germaine De Capuccini</p>
	</div>



	<div class="aside third">
		<a href="<?php echo get_permalink( '35' ); ?>">
		<?php echo get_the_post_thumbnail( '35', 'featurebutton' ); ?>
		Beauty
		</a>
<p>Everything from waxing and nails to hands and feet</p>
	</div>

</div>       




<div class="homecontent">
<?php the_content(); ?>
	                    
	                    <?php	wp_link_pages( "\t\t\t\t\t<div class='page-link'>" . __( 'Pages: ', 'thematic' ), "</div>\n", 'number' );
	                    
	                    	edit_post_link( __( 'Edit', 'thematic' ), "\n\t\t\t\t\t\t" . '<span class="edit-link">' , '</span>' . "\n" );
	                    ?>

</div>



						






			<?php
				// action hook for inserting content below #post
	        	thematic_belowpost();
	        		        
       			// action hook for calling the comments_template
       			// thematic_comments_template();
        		
	        	// end loop
        	//	endwhile;
	        
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