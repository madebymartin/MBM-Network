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

				<?php if ( has_post_thumbnail() ) { ?>
				<div class="banner"><?php the_post_thumbnail('banner'); ?></div>

				<?php } else{ ?>
				<?php } ?>


					<div class="entry-content">


						<?php
	                    	the_content();

	                    	wp_link_pages( "\t\t\t\t\t<div class='page-link'>" . __( 'Pages: ', 'thematic' ), "</div>\n", 'number' );

	                    	edit_post_link( __( 'Edit', 'thematic' ), "\n\t\t\t\t\t\t" . '<span class="edit-link">' , '</span>' . "\n" );
	                    ?>



<?php $loop = new WP_Query( array(
'post_type' => 'project',
'posts_per_page' => -1,
'meta_key' => '_cmb_projectdate',
'orderby' => 'meta_value_num',
'order' => 'DESC'
) ); ?>



<ul class="portfolio">
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
<?php $unixtimestamp = get_post_meta($post->ID, '_cmb_projectdate', true);?>
<li><div class="feature">
	<a href="<?php echo get_permalink(); ?>" class="download">
		<h3><?php the_title(); ?><span> (<?php echo date_i18n( 'F Y',$unixtimestamp) ?>)</span></h3>

	</a>



		<?php if ( has_post_thumbnail() ) { ?>
		<div class="polaroidholder">
			<div class="polaroidoverlay1"></div>
		<?php the_post_thumbnail('polaroid'); ?>
		</div>
		<?php } ?>



		<?php if (MultiPostThumbnails::has_post_thumbnail(get_post_type(), 'mbm_image2')) { ?>
		<div class="polaroidholder">
			<div class="polaroidoverlay2"></div>
			<?php MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'mbm_image2', NULL,  'polaroid'); ?>
		</div>
		<?php } ?>



		<?php if (MultiPostThumbnails::has_post_thumbnail(get_post_type(), 'mbm_image3')) { ?>
		<div class="polaroidholder">
			<div class="polaroidoverlay1"></div>
			<?php MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'mbm_image3', NULL,  'polaroid'); ?>
		</div>
		<?php } ?>



		<?php if (MultiPostThumbnails::has_post_thumbnail(get_post_type(), 'mbm_image4')) { ?>
		<div class="polaroidholder">
			<div class="polaroidoverlay2"></div>
			<?php MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'mbm_image4', NULL,  'polaroid'); ?>
		</div>
		<?php } ?>

<div class="clearfix"></div>
</div></li>

<?php endwhile; ?>
</ul>


					</div><!-- .entry-content -->

				</div><!-- #post -->

			<?php
				// action hook for inserting content below #post
	        	thematic_belowpost();

       			// action hook for calling the comments_template
       			thematic_comments_template();

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