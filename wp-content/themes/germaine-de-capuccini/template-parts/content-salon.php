<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Germaine_de_Capuccini
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content();

			$salon_long = get_wpgeo_longitude();
            $salon_lat = get_wpgeo_latitude();

            echo '<pre>';
            	echo 'LNG: ' . $salon_long . '<br>';
            	echo 'LAT: ' . $salon_lat . '<br>';
            echo '</pe>';


            // if ( isset($wpgeo) ) $wpgeo->categoryMap();

			if ( function_exists( 'wpgeo_post_map' ) ) {
				// $query = array(
				//     'post_type'       => 'salon',
				// );
				//wpgeo_post_map();
				echo get_wpgeo_post_map();

				/*echo get_wpgeo_map( array(
					'post_type' => 'salon',
					'orderby' => 'post_title',
					'numberposts' => -1,
					// 'polylines' => true,
					// 'polyline_colour' => red
				) );*/

			}





			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'germaine-de-capuccini' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'germaine-de-capuccini' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->
