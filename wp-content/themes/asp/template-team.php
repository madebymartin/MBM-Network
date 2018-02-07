<?php
/**
 * Template Name: The Team
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

			while ( have_posts() ) : the_post();

				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php 
						echo '<div class="restrict-width">';
							// if(!$page_sections){ echo '<h1>' . get_the_title() . '</h1>'; }
							the_content();


							$teamloop = new WP_Query( array(
								'post_type' => 'team_member',
								//'posts_per_page' => '-1',
								//'meta_key' => '_cmb_publicationdateunix',
								'orderby' => 'id',
								'order' => 'ASC'
								) 
							);

							if( $teamloop->have_posts() ){
								echo '<div class="section-content"><div class="restrict-width"><ul class="team">';
								while ( $teamloop->have_posts() ) : $teamloop->the_post();
									
									$member_role = get_post_meta( get_the_ID(), 'mbm_member_role', true );
									$member_subtitle = get_post_meta( get_the_ID(), 'mbm_member_subtitle', true );
									$member_content = get_post_meta( get_the_ID(), 'mbm_member_content', true );
									$member_bullets = get_post_meta( get_the_ID(), 'mbm_member_bullet', true );
									$member_email = get_post_meta( get_the_ID(), 'mbm_member_email', true );
									$blurb = get_post_meta( get_the_ID(), 'mbm_member_blurb', true );


									echo '<li>';
										echo '<h2 class="center red">' . get_the_title() . '<br><span class="gray role">(' . $member_role  . ')</span></h2>';
										// echo '<em>' . $member_subtitle . '</em><br>';
										$imgurl = get_the_post_thumbnail_url(get_the_ID());
										echo '<div class="circle" style="background-image:url('. $imgurl .')"></div>';
											// the_post_thumbnail( );
										
										echo '<div class="blurb">' . $blurb . '</div>';
										echo '<ul class="expertise">';
											foreach ( $member_bullets as $member_bullet ){
												echo '<li>' . $member_bullet . '</li>';
											}
										echo '</ul>';
									echo'</li>' ;


								endwhile;

								echo '</ul></div></div>';
							}
						echo '</div>';	



						wp_reset_query();

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

					?>


			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
		<hr><div class="restrict-width center"><?php dynamic_sidebar( 'page-bottom' ); ?></div>
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
