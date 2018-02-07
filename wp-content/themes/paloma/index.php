<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package paloma
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php elseif ( is_search() ) : ?>
				<header>
					<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'paloma' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header>

			<?php endif; ?>

			<div class="posts-container clear">
				
				<?php do_action('paloma_index_layout'); //do action to display posts in the desired layout (see functions.php)	?>
				
			</div><!-- .posts-container -->

			<?php the_posts_navigation(); ?> 

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php do_action('blog_sidebar'); //do action to display sidebar (see functions.php)	?>

<?php get_footer(); ?>
