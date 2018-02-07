<?php
/**
 * Template Name: Treatments
 *
 * …
 * 
 * @package Germaine_de_Capuccini
 * @subpackage Templates
 */

get_header('shop'); ?>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div class="center archive-intro"><?php the_content(); ?></div>
	</header><!-- .entry-header -->

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			$args = array(
				'post_type' => 'treatment',
				'posts_per_page' => -1, 
				'orderby' => 'date', 
				'post_status' => 'publish',
			);
		    $treatments = new WP_Query($args);

			if($treatments->have_posts()){
				while( $treatments->have_posts() ) : $treatments->the_post();
					get_template_part( 'template-parts/content', 'treatments' );
				endwhile;
			}
			?>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_sidebar('treatments');
get_footer();
