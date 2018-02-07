<?php
/**
 * The template for displaying all pages.
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

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php 
				while ( have_posts() ) : the_post();
					echo '<div class="restrict-width">';
					the_content();
					echo '</div>';	
				endwhile;



				if(get_post_meta(get_the_ID(), 'mbm_home_homelinks', true)){
					$homelinks = get_post_meta(get_the_ID(), 'mbm_home_homelinks', true);

					if(($key = array_search(get_the_ID(), $homelinks)) !== false) {
					    unset($homelinks[$key]);
					}

					echo '<div class="center">';
						$count = count($homelinks);
						if($count === 1){ $widthclass = ' cols cols12'; }
						if($count === 2){ $widthclass = ' cols cols6'; }
						if($count === 3){ $widthclass = ' cols cols4'; }
						if($count === 4){ $widthclass = ' cols cols3'; }
						if($count === 5){ $widthclass = ' cols cols6'; }
						if($count === 6){ $widthclass = ' cols cols6'; }

						foreach ($homelinks as $key => $id) {
							$img_url = get_the_post_thumbnail_url($id, 'large');
							// echo $img_url . '<br>';
							echo '<a href="'. get_permalink($id) .'" class="featuredlink'. $widthclass .'"><div class="background" style="background-image:url('. $img_url .');"></div><span>'. get_the_title($id) .'</span></a>';
						}
					echo '</div>';
				}
				

				if(get_post_meta(get_the_ID(), 'mbm_more', true)){
					echo '<div class="restrict-width">';
					echo apply_filters('the_content', get_post_meta(get_the_ID(), 'mbm_more', true));
					// echo get_post_meta(get_the_ID(), 'mbm_more', true);
					echo '</div>';
				}
				?>


			<!-- 				
				<footer class="entry-footer">
					<div class="restrict-width">
						
					</div>
				</footer> 
							-->


			</article><!-- #post-## -->

		</main><!-- #main -->
		<hr>
		<div class="restrict-width center"><?php dynamic_sidebar( 'page-bottom' ); ?></div>

		

	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
