<?php
/**
 * Template Name: Store Finder
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
				echo do_shortcode("[simplemap search_form_cols='1' search_fields='labelsp_zip||labelsp_distance||submit']");
				//echo '<div id="map-canvas"></div>';
				?>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
