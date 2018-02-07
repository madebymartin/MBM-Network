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

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> >

				<?php

	                // creating the post header
	                thematic_postheader();
				?>

					<?php if ( get_post_meta(get_the_ID(), '_cmb_promo_name', true) ) { ?>
						<div class="box gradient offer">
						<h3><?php echo get_post_meta(get_the_ID(), "_cmb_promo_name", true); ?></h3>



							<?php if ( get_post_meta(get_the_ID(), '_cmb_promo_image', true) ) { ?>
							<img src="<?php echo get_post_meta(get_the_ID(), "_cmb_promo_image", true); ?> " alt="promotion image"/>
							<?php } ?>


							<?php if ( get_post_meta(get_the_ID(), '_cmb_promo_details', true) ) { ?>
							<div class="offerdetails"><?php echo get_post_meta(get_the_ID(), "_cmb_promo_details", true); ?></div>
							<?php } ?>



						</div>
					<?php } ?>



					<div class="entry-content">

<?php if ( get_post_meta(get_the_ID(), '_cmb_promo_name', true) ) { ?>

	<?php the_content();
   	wp_link_pages( "\t\t\t\t\t<div class='page-link'>" . __( 'Pages: ', 'thematic' ), "</div>\n", 'number' );
	edit_post_link( __( 'Edit', 'thematic' ), "\n\t\t\t\t\t\t" . '<span class="edit-link">' , '</span>' . "\n" );
    ?>

<?php } else { ?>

<div class="box gradient offer">
	<?php the_content();
  	wp_link_pages( "\t\t\t\t\t<div class='page-link'>" . __( 'Pages: ', 'thematic' ), "</div>\n", 'number' );
	edit_post_link( __( 'Edit', 'thematic' ), "\n\t\t\t\t\t\t" . '<span class="edit-link">' , '</span>' . "\n" );
    ?>
</div>
<?php } ?>



<?php if ( get_post_meta(get_the_ID(), '_cmb_feature1_name', true) ) { ?>
	<div class="feature">
		<h3><?php echo get_post_meta(get_the_ID(), "_cmb_feature1_name", true); ?></h3>
		<?php if ( get_post_meta(get_the_ID(), '_cmb_feature1_image', true) ) { ?>
		<img class="alignright" width="134" src="<?php echo get_post_meta(get_the_ID(), '_cmb_feature1_image', true); ?>" alt="<?php get_post_meta($thumb_id, '_wp_attachment_image_alt', true); ?> ">
		<?php } ?>
		<?php echo get_post_meta(get_the_ID(), "_cmb_feature1_content", true); ?>			
	</div>
<?php } ?>


<?php if ( get_post_meta(get_the_ID(), '_cmb_feature2_name', true) ) { ?>
<div class="feature">
		<h3><?php echo get_post_meta(get_the_ID(), "_cmb_feature2_name", true); ?></h3>	
		<?php if ( get_post_meta(get_the_ID(), '_cmb_feature2_image', true) ) { ?>
		<img class="alignright" width="134" src="<?php echo get_post_meta(get_the_ID(), '_cmb_feature2_image', true); ?>" alt="<?php get_post_meta($thumb_id, '_wp_attachment_image_alt', true); ?> ">
		<?php } ?>
<?php echo get_post_meta(get_the_ID(), "_cmb_feature2_content", true); ?>
	
			
	</div>
<?php } ?>


<?php if ( get_post_meta(get_the_ID(), '_cmb_feature3_name', true) ) { ?>
<div class="feature">
		<h3><?php echo get_post_meta(get_the_ID(), "_cmb_feature3_name", true); ?></h3>
		<?php if ( get_post_meta(get_the_ID(), '_cmb_feature3_image', true) ) { ?>
		<img class="alignright" width="134" src="<?php echo get_post_meta(get_the_ID(), '_cmb_feature3_image', true); ?>" alt="<?php get_post_meta($thumb_id, '_wp_attachment_image_alt', true); ?> ">
		<?php } ?>
		<?php echo get_post_meta(get_the_ID(), "_cmb_feature3_content", true); ?>
	
			
	</div>
<?php } ?>


<?php if ( get_post_meta(get_the_ID(), '_cmb_feature4_name', true) ) { ?>
<div class="feature">
		<h3><?php echo get_post_meta(get_the_ID(), "_cmb_feature4_name", true); ?></h3>	
		<?php if ( get_post_meta(get_the_ID(), '_cmb_feature4_image', true) ) { ?>
		<img class="alignright" width="134" src="<?php echo get_post_meta(get_the_ID(), '_cmb_feature4_image', true); ?>" alt="<?php get_post_meta($thumb_id, '_wp_attachment_image_alt', true); ?> ">
		<?php } ?>
		<?php echo get_post_meta(get_the_ID(), "_cmb_feature4_content", true); ?>			
	</div>
<?php } ?>


<?php if ( get_post_meta(get_the_ID(), '_cmb_feature5_name', true) ) { ?>
<div class="feature">
		<h3><?php echo get_post_meta(get_the_ID(), "_cmb_feature5_name", true); ?></h3>	
		<?php if ( get_post_meta(get_the_ID(), '_cmb_feature5_image', true) ) { ?>
		<img class="alignright" width="134" src="<?php echo get_post_meta(get_the_ID(), '_cmb_feature5_image', true); ?>" alt="<?php get_post_meta($thumb_id, '_wp_attachment_image_alt', true); ?> ">
		<?php } ?>
		<?php echo get_post_meta(get_the_ID(), "_cmb_feature5_content", true); ?>			
	</div>
<?php } ?>


<?php if ( get_post_meta(get_the_ID(), '_cmb_feature6_name', true) ) { ?>
<div class="feature">
		<h3><?php echo get_post_meta(get_the_ID(), "_cmb_feature6_name", true); ?></h3>	
		<?php if ( get_post_meta(get_the_ID(), '_cmb_feature6_image', true) ) { ?>
		<img class="alignright" width="134" src="<?php echo get_post_meta(get_the_ID(), '_cmb_feature6_image', true); ?>" alt="<?php get_post_meta($thumb_id, '_wp_attachment_image_alt', true); ?> ">
		<?php } ?>
		<?php echo get_post_meta(get_the_ID(), "_cmb_feature6_content", true); ?>			
	</div>
<?php } ?>




					</div><!-- .entry-content -->

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
    thematic_sidebar();

    // calling footer.php
    get_footer();
?>