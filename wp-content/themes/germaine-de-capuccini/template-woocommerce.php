<?php
/**
 * Template Name: Custom Shop Page
 *
 * …
 * 
 * @package Germaine_de_Capuccini
 * @subpackage Templates
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'woocommerce' );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();