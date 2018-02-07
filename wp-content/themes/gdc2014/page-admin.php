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

    //messages...
	do_action('jigoshop_before_shop_loop');

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
					<?php get_template_part( 'lib/template_parts/title', 'banner' ); ?>
					<div class="entry-content">
							<?php if ( is_user_logged_in() ) { ?>
								<h2>Welcome back 
									<?php wp_get_current_user();
								    echo '' . $current_user->display_name . '<br>'; ?> 
								</h2>
								<?php the_content(); ?>
							<?php } else {
							// Nothing for now
							}
							?>

					</div><!-- .entry-content -->
				</div><!-- #post -->
			<?php thematic_belowpost();
        		endwhile;
	        	get_sidebar( 'page-bottom' ); ?>
			</div><!-- #content -->
			<?php thematic_belowcontent(); ?> 
		</div><!-- #container -->
<?php 
    thematic_belowcontainer();
    thematic_sidebar();
    get_footer();
?>