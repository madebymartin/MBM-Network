<?php
/**
 * Template Name: Spa Finder
 *
 * …
 * 
 * @package Germaine_de_Capuccini
 * @subpackage Templates
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">


			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->

<!-- 				<div class="entry-content">
 -->	

	 				<?php
						//the_content();
						echo do_shortcode('[gmw form="1"]');

						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'germaine-de-capuccini' ),
							'after'  => '</div>',
						) );
					?>
				<!-- </div> -->

				<?php if ( get_edit_post_link() ) : ?>
					<footer class="entry-footer">
						<?php
							edit_post_link(
								sprintf(
									/* translators: %s: Name of current post */
									esc_html__( 'Edit %s', 'germaine-de-capuccini' ),
									the_title( '<span class="screen-reader-text">"', '"</span>', false )
								),
								'<span class="edit-link">',
								'</span>'
							);
						?>
					</footer><!-- .entry-footer -->
				<?php endif; ?>
			</article><!-- #post-## -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
