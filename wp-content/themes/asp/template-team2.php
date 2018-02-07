<?php
/**
 * Template Name: The Team 2
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
				echo '<div class="restrict-width">';
					the_content();
				echo '</div>';
			endwhile; // end of the loop. 


			echo '<div class="restrict-width">';
				// if(!$page_sections){ echo '<h1>' . get_the_title() . '</h1>'; }
				?>

				<script>
					var polyfilter_scriptpath = '/js/';
				</script>

				<?php

				$teamloop = new WP_Query( array(
					'post_type' => 'team_member',
					//'posts_per_page' => '-1',
					//'meta_key' => '_cmb_publicationdateunix',
					'orderby' => 'id',
					'order' => 'ASC'
					) 
				);

				if( $teamloop->have_posts() ){
					while ( $teamloop->have_posts() ) : $teamloop->the_post();
						
						$member_role = get_post_meta( get_the_ID(), 'mbm_member_role', true );
						if(get_post_meta( get_the_ID(), 'mbm_member_subtitle', true )){$member_subtitle = '<br><em>' . get_post_meta( get_the_ID(), 'mbm_member_subtitle', true ) . '</em><br>';} else{$member_subtitle = '';}
						$member_subtitle = get_post_meta( get_the_ID(), 'mbm_member_subtitle', true );
						$member_content = get_post_meta( get_the_ID(), 'mbm_member_content', true );
						$member_bullets = get_post_meta( get_the_ID(), 'mbm_member_bullet', true );
						$member_email = get_post_meta( get_the_ID(), 'mbm_member_email', true );
						$blurb = get_post_meta( get_the_ID(), 'mbm_member_blurb', true );
						$imgurl = get_the_post_thumbnail_url(get_the_ID());
						// $imgurl = str_replace(' ', '/', $imgurl);
						// echo '<li>'. get_the_title() .'</li>';

						echo '<div class="md-modal md-effect-8" id="modal-'. $id .'">';
							echo '<div class="md-content">';

								echo '<div class="column photo" style="background-image:url('. $imgurl .');"></div>';
								echo '<div class="column details">';
									echo '<h2 class="center red">' . get_the_title() . '<br><span class="gray role">(' . $member_role  . ')</span></h2>' . $member_subtitle;
									echo '<p class="block">'. $blurb .'</p>';
									echo '<ul class="expertise1">';
										foreach ( $member_bullets as $member_bullet ){
											echo '<li>' . $member_bullet . '</li>';
										}
									echo '</ul>';
								echo '</div>';
								echo '<button class="md-close dismiss" title="close">X</button>';
								echo '<div class="clearfix"></div>';
							echo '</div>';
						echo '</div>';


					endwhile;

					echo '<div class="md-modal md-effect-8" id="modal-0">';
						echo '<div class="md-content">';
							echo '<div class="column photo" style="background-image: url('. get_stylesheet_directory_uri() .'/images/join.jpg);"></div>';
							echo '<div class="column details">';
								echo '<h2 class="center red">We\'re Hiring<br><span class="gray role">Got What it Takes?</span></h2>';
								echo '<div class="center"><p>If you have what it takes to join our fast-paced, dynamic team, we want to hear from you.</p>';
								echo '<br><br><a class="button" href="https://asp.madebymartin.co.uk/join-the-team/">Join the Team</a></div>';
								echo '<button class="md-close dismiss" title="close">X</button>';
							echo '</div>';
						echo '</div>';
					echo '</div>';



					echo '<div class="md-overlay"></div>';

				}
				echo '<br><br><br><hr class="clearfix">';	






				$teamloop->rewind_posts(); 
				while ($teamloop->have_posts()) : $teamloop->the_post();
					$id = get_the_ID();
					$imgurl = get_the_post_thumbnail_url(get_the_ID());
					echo '<button class="md-trigger" data-modal="modal-'. $id .'"><span class="pic" style="background-image: url('. $imgurl .');"></span><span class="name">' . get_the_title() . '</span></button>';
				endwhile;


				echo '<button class="md-trigger" data-modal="modal-0"><span class="pic" style="background-image: url('. get_stylesheet_directory_uri() .'/images/join.jpg);"></span></span><span class="name">You?</span></button>';
				echo '<div class="clearfix"></div>';

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







		</main><!-- #main -->
		<hr><div class="restrict-width center"><?php dynamic_sidebar( 'page-bottom' ); ?></div>
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
