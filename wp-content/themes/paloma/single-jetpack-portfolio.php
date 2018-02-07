<?php
/**
 * The template for displaying single portfolio projects
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package paloma
 */

get_header(); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'portfolio' ); ?>

			<?php endwhile; // End of the loop. ?>


	<?php do_action('single_sidebar'); //do action to display sidebar (see functions.php)	?>

<?php get_footer(); ?>
