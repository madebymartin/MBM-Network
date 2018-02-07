<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Intuity
 */

get_header('home'); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();
			?>
			<section id="section1">
				<div class="container">
					<header class="entry-header">
						<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php
							the_content();
							wp_link_pages( array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'intuity' ),
								'after'  => '</div>',
							) );
						?>
					</div><!-- .entry-content -->

				</div>
			</section><!-- #post-## -->
			<?php
			endwhile; // End of the loop.
			?>

			<section id="where" class="center">
			<!-- <div class="container"> -->
			  <h2>Where we work</h2>
			  <h4>Based at 19B Chapel Avenue, Addlestone KT15 1UH, we operate within 25 miles</h4><br><br>
			  <div id="map"></div>
				
				<script>

				  function initMap() {
				    var myLatLng = {lat: 51.3733360, lng: -0.4950400};

				    var map = new google.maps.Map(document.getElementById('map'), {
				      zoom: 9,
				      // zoomControl: false,
					  scaleControl: false,
					  scrollwheel: false,
					  // disableDoubleClickZoom: true,
				      center: myLatLng,
				    });

				    var marker = new google.maps.Marker({
				      position: myLatLng,
				      map: map,
				      title: '<b>LA Plumbing</b><br>19B Chapel Avenue<br>Addlestone<br>KT15 1UH',
				    });

				    // Add circle overlay and bind to marker
					var circle = new google.maps.Circle({
					  map: map,
					  radius: 40232.5,    // 10 miles in metres
					  fillColor: '#0085ca',
					  strokeColor: 'TRANSPARENT'
					});
					circle.bindTo('center', marker, 'position');
				  }
				</script>
				<script src="//maps.google.com/maps/api/js?key=AIzaSyAaRIdeivBs_6DI0TwyxyaS6RPsgaSJGe8&callback=initMap" type="text/javascript"></script>
			<!-- </div> -->
			</section>


			<section id="work">
			<div class="container" style="text-align:center;">
			  <h2>Our Work</h2>
				 <script>
				    lightbox.option({
				      'resizeDuration': 200,
				      'wrapAround': true,
				      'fadeDuration': 100
				    })
				</script>
			  <?php

			  $query_images_args = array(
				    'post_type'      => 'attachment',
				    'post_mime_type' => 'image',
				    'post_status'    => 'inherit',
				    'posts_per_page' => - 1,
				);
				$query_images = new WP_Query( $query_images_args );
				foreach ( $query_images->posts as $image ) {
				    $url_fullsize = wp_get_attachment_url( $image->ID );
				    $thumbnail = wp_get_attachment_image($image->ID, 'thumbnail', false);
				    echo '<a class="lightboxlink" href="'. $url_fullsize .'" data-lightbox="roadtrip">'. $thumbnail .'</a>';
				}
			  ?>
			</div>
			</section>


			<section id="contact"><div class="container"><?php dynamic_sidebar( 'sidebar-1' ); ?></div></section>




		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
