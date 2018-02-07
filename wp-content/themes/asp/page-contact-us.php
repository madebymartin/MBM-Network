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

			<?php 

			while ( have_posts() ) : the_post();
				// get_template_part( 'content', 'page' );

				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php 



					echo '<div class="restrict-width">';
						the_content();
							
						?>
						
						<div id="map" style="width: 100%; height: 600px;margin-top:1.5rem;"></div>
						<script src="http://maps.google.com/maps/api/js?key=AIzaSyAaRIdeivBs_6DI0TwyxyaS6RPsgaSJGe8&sensor=false" type="text/javascript"></script>
						  <script type="text/javascript">
						    var locations = [
						      ['<b>ASP</b><br>906 Yeovil Road<br>Slough<br>SL1 4JG', 51.5268910, -0.6396980, 4],
						      ['<b>ASP</b><br>2 The Old Court House<br>Eightlands Road<br>Dewsbury<br>WF13 2AX', 53.6929860, -1.6333140, 5],
						      // ['Cronulla Beach', -34.028249, 151.157507, 3],
						      // ['Manly Beach, eifbgefiogefluyegf<p>reglerih</p>', -33.80010128657071, 151.28747820854187, 2],
						      // ['Maroubra Beach', -33.950198, 151.259302, 1]
						    ];

						    var bounds = new google.maps.LatLngBounds();

						    var map = new google.maps.Map(document.getElementById('map'), {
						      zoom: 6,
						      center: new google.maps.LatLng(),
						      mapTypeId: google.maps.MapTypeId.ROADMAP
						    });

						    var infowindow = new google.maps.InfoWindow();

						    var marker, i;

						    for (i = 0; i < locations.length; i++) {  
						      marker = new google.maps.Marker({
						        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
						        map: map
						      });

						      google.maps.event.addListener(marker, 'click', (function(marker, i) {
						        return function() {
						          infowindow.setContent(locations[i][0]);
						          infowindow.open(map, marker);
						        }
						      })(marker, i));

						      loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
						        bounds.extend(loc)
						    }
						    map.fitBounds(bounds);
						    map.panToBounds(bounds); 
						</script>

					<?php

					echo '</div>';





					/*
					** Pagelinks
					*/
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
					

					/*
					** More content
					*/
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

				<?php
					
				/*
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				*/


				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
