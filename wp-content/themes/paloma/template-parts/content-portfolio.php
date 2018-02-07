<?php
/**
 * Template part for displaying portfolio content in single-jetpack-portfolio.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package paloma
 */

?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

			<?php if (!has_post_thumbnail()) {  //If no post thumbnail, just do normal page title ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('no-featured'); ?>>
			<?php } else { ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php } ?>

			     <?php //display featured image if present
			      $paloma_portfolio_featured = get_theme_mod('paloma_portfolio_featured', 1);
			      if (has_post_thumbnail() && ($paloma_portfolio_featured == 1)) {
                        the_post_thumbnail();
                    } 
                ?>

				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->

			<div class="entry-content">
				<?php the_content(); ?>
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'paloma' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->

		</article><!-- #post-## -->

	</main><!-- #main -->
</div><!-- #primary -->

