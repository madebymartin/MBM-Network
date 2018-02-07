<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Germaine_de_Capuccini
 */

?>

<article id="post-<?php the_ID(); ?>" class="treatment-menu-item">

	<div class="entry-content">
		<?php
			echo '<h3><a class="button" href="'. get_permalink() .'" title="'. get_the_title() .'">'. get_the_title() .'</a>';

			if ( get_edit_post_link() ) {
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'germaine-de-capuccini' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					' <span class="edit-link"><small>',
					'</small></span>'
				);
			} 
			echo '</h3>';

			the_excerpt();
			// the_content();
			echo '<a class="button" href="'. get_permalink() .'" title="'. get_the_title() .'">View Treatment</a>';

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'germaine-de-capuccini' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->


</article><!-- #post-## -->
