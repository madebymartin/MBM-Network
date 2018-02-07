<?php
/**
 * The template for displaying treatment taxonomy archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Germaine_de_Capuccini
 */

get_header('shop'); ?>
	<header class="entry-header">
		<?php 
		echo '<h1 class="page-title center">' . str_replace('Treatment Category: ','',get_the_archive_title()) . '</h1>';
		the_archive_description( '<div class="center archive-intro">', '</div>' );
		?>
	</header><!-- .entry-header -->


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'treatments' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar('treatments');
get_footer();
