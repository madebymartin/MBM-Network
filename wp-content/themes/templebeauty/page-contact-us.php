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

					<div class="entry-content">



			<?php if ( get_post_meta(('6'), '_cmb_phone', true) ) { ?>
			<h3>Telephone: <?php echo get_post_meta(('6'), "_cmb_phone", true); ?></h3>
			<?php } ?>
	
	
		<p>
			<?php if ( get_post_meta(('6'), '_cmb_add1', true) ) { ?>
			<?php echo get_post_meta(('6'), "_cmb_add1", true); ?><br>
			<?php } ?>
	
			<?php if ( get_post_meta(('6'), '_cmb_add2', true) ) { ?>
			<?php echo get_post_meta(('6'), "_cmb_add2", true); ?><br>
			<?php } ?>
	
			<?php if ( get_post_meta(('6'), '_cmb_add3', true) ) { ?>
			<?php echo get_post_meta(('6'), "_cmb_add3", true); ?><br>
			<?php } ?>
	
			<?php if ( get_post_meta(('6'), '_cmb_add4', true) ) { ?>
			<?php echo get_post_meta(('6'), "_cmb_add4", true); ?><br>
			<?php } ?>
	
			<?php if ( get_post_meta(('6'), '_cmb_add5', true) ) { ?>
			<?php echo get_post_meta(('6'), "_cmb_add5", true); ?><br>
			<?php } ?>
		</p>


						<?php
	                    	the_content();

	                    	wp_link_pages( "\t\t\t\t\t<div class='page-link'>" . __( 'Pages: ', 'thematic' ), "</div>\n", 'number' );

	                    	edit_post_link( __( 'Edit', 'thematic' ), "\n\t\t\t\t\t\t" . '<span class="edit-link">' , '</span>' . "\n" );
	                    ?>


<iframe width="520" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.uk/maps?oe=utf-8&amp;client=firefox-a&amp;q=PR3+0ZB&amp;ie=UTF8&amp;hq=&amp;hnear=PR3+0ZB,+United+Kingdom&amp;gl=uk&amp;t=m&amp;ll=53.947196,-2.864685&amp;spn=0.282879,0.714111&amp;z=10&amp;iwloc=A&amp;output=embed"></iframe>

<br /><small><a href="https://maps.google.co.uk/maps?oe=utf-8&amp;client=firefox-a&amp;q=PR3+0ZB&amp;ie=UTF8&amp;hq=&amp;hnear=PR3+0ZB,+United+Kingdom&amp;gl=uk&amp;t=m&amp;ll=53.947196,-2.864685&amp;spn=0.282879,0.714111&amp;z=10&amp;iwloc=A&amp;source=embed" style="color:#0000FF;text-align:left">View Larger Map</a></small>




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