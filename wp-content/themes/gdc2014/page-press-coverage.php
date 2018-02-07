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
	               // thematic_postheader();
				?>
					<div class="homebanner">
					    <?php the_post_thumbnail( 'banner', array( 'class'	=> "mobile_feature_image", ) ); ?>
					    <div id="bannerwrapouter">
					            <h1 class="page-title keymessage"><?php echo the_title(); ?></h1>
					    </div>
					</div>

				
					<div class="entry-content">


	                    <?php

	                    the_content();

	                    //wp_link_pages("\t\t\t\t\t<div class='page-link'>".__('Pages: ', 'thematic'), "</div>\n", 'number');

	                    //edit_post_link(__('Edit', 'thematic'),'<span class="edit-link">','</span>')
?>
<br>


<?php $loop = new WP_Query( array(
'post_type' => 'pressarticle',
'posts_per_page' => '-1',
'meta_key' => '_cmb_publicationdateunix',
'orderby' => 'meta_value_num',
'order' => 'DESC'
) ); ?>

<ul class="margin0 padding0">
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

	<li class="cols-1">		
		<a href="<?php echo get_permalink(); ?>" class="">
			<?php
			$content = get_the_content();
			$unixtimestamp = get_post_meta($post->ID, '_cmb_publicationdateunix', true);?>
			<h3><?php the_title(); ?><span><br>(<?php echo date_i18n( 'F Y',$unixtimestamp) ?>)</span></h3>


			<?php if (MultiPostThumbnails::has_post_thumbnail(get_post_type(), 'frontcover')) { ?>
				<?php MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'frontcover', NULL,  'medium', array('class' => '')); ?>

			<?php } else { ?>
				<?php if ( has_post_thumbnail() ) {
					echo get_the_post_thumbnail( $id, 'medium', array('class' => ''));
				} else { ?>
					<img src="<?php bloginfo('stylesheet_directory');?>/images/gdc-swan-150-white.png" /><?php } ?>
				<?php } ?>
			
			<div class="entry-summary">
				<?php if ( ! has_excerpt() ) {
				// NO EXCURPT 
				?>
					<?php if($content !=''){ ?><div class="excerpt"><?php the_content(); ?></div>
					<?php } else{} ?>

				<?php } else { 
				// YES EXCURPT
				?><div class="excerpt"><?php echo get_the_excerpt(); ?></div><?php } ?>

			</div>
		</a>
	</li>

<?php endwhile; ?>
</ul>


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