<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Germaine_de_Capuccini
 */

$linked_treatments = p2p_type( 'spa-treatment' )->get_connected( get_the_ID() );
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );

			if($linked_treatments->have_posts()){
				while( $linked_treatments->have_posts() ) : $linked_treatments->the_post();
					$id = get_the_ID();			
					echo '<a href="'. get_permalink($id) .'" title="'. get_the_title($id) .'">'. get_the_title($id) .'</a><br>';
				endwhile;
			}
			

			the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
