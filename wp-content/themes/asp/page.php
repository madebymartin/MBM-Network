<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package _s
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php 

			while ( have_posts() ) : the_post();
				get_template_part( 'content', 'page' );

					
				/*
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				*/


				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
		<hr><div class="restrict-width center"><?php dynamic_sidebar( 'page-bottom' ); ?></div>
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
