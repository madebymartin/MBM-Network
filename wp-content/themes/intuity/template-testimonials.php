<?php
/**
 * Template Name: Testimonials
 *
 * …
 * 
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Intuity
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php 
					//the_title( '<h1 class="entry-title">', '</h1>' ); 
					?>
				</header><!-- .entry-header -->

				<div class="entry-content">

					<?php
					$loop = new WP_Query( array( 
						'post_type' => 'testimonial',
						'orderby' => 'date',
						'posts_per_page' => '-1', 
						'order' => 'DESC'
						) ); ?>
					<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
							<div class="testimonial">
								<div class="bubble">
									<?php the_content(); ?>
								</div>
								<p class="speech"><?php the_title(); ?></p>
							</div>
					<?php endwhile; ?>
				
				</div><!-- .entry-content -->

			</article><!-- #post-## -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
