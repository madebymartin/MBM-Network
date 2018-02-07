<?php
/**
 * Single Post Template
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
				echo apply_filters( 'thematic_open_id_content', '<div id="content">' . "\n\n" );
		?>
<div class="hentry">
<?php
	            // start the loop
	            while ( have_posts() ) : the_post();

    	        // create the navigation above the content
				// thematic_navigation_above();

    	        // calling the widget area 'single-top'
    	        get_sidebar('single-top');

    	        // action hook creating the single post
    	        // thematic_singlepost();

$content = get_the_content();
$unixtimestamp = get_post_meta($post->ID, '_cmb_publicationdateunix', true);?>


<h1 class="entry-title"><?php the_title(); ?>
<?php if ( get_post_meta(get_the_ID(), '_cmb_publicationdateunix', true) ) { ?>
<br><span class="date"> (<?php echo date_i18n( 'F Y',$unixtimestamp) ?>)</span></h1>
<?php } else { ?></h1><?php } ?>


<?php if ( get_post_meta(get_the_ID(), '_cmb_articlepdf2', true) ) { 
    $attachment_id = get_post_meta(get_the_ID(), "_cmb_articlepdf2", true);
    $attachment_url = wp_get_attachment_url( $attachment_id );
    ?>
    <p><a target="blank" href="<?php echo $attachment_url ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/pdf-icon.png" alt="High res PDF" width="30"/>Download PDF</a></p>
    <br><p class="">(To download image, right-click on the image below and choose "Save Image")</p>


<?php } elseif ( get_post_meta(get_the_ID(), '_cmb_articlepdf', true) ) { ?>
<p><a target="blank" href="<?php echo get_post_meta(get_the_ID(), "_cmb_articlepdf", true); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/pdf-icon.png" alt="High res PDF" width="30"/>Download PDF</a></p>
<br><p class="">(To download image, right-click on the image below and choose "Save Image")</p>


<?php } else { ?>
<br><p class="">(To download image, right-click on the image below and choose "Save Image")</p>
<?php } ?>


<div style="margin-top:50px;"><?php the_post_thumbnail('posterlarge');?></div>
<br><br>
<?php if($content !=''){ the_content(); } else{} ?>
<br><br>
<?php if (MultiPostThumbnails::has_post_thumbnail(get_post_type(), 'frontcover')) { ?>
	<?php MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'frontcover', NULL,  'medium', array('class' => 'left')); ?>

<?php } ?>
<br><br><br>
<?php 

    	        // calling the widget area 'single-insert'
    	        get_sidebar('single-insert');

    	        // create the navigation below the content
				// thematic_navigation_below();

       			// action hook for calling the comments_template
    	        // thematic_comments_template();

    	        // end the loop
        		endwhile;

    	        // calling the widget area 'single-bottom'
    	        get_sidebar('single-bottom');
			?>
		</div><!-- .hentry-->
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