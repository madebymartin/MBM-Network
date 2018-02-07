<?php
/**
 * Template part for displaying single posts.
 *
 * @package Martin Stevens
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</div><!-- .entry-header -->

	<div class="entry-content">

		<?php 

		$project_photos = get_post_meta( get_the_ID(), '_cmb_project_pics', false );


		the_content(); 
		echo '<br><br>';
		if($project_photos){
			foreach( $project_photos as $project_photo ){
				$img_id = $project_photo['_cmb_photo'];
				$image = wp_get_attachment_image( $img_id, 'large' );
				$imagesrc_thumb = wp_get_attachment_image_src( $img_id, 'large' )[0];
				$imagesrc_large = wp_get_attachment_image_src( $img_id, 'full' )[0];

				//echo '<hr>';
				if( !empty($img_id) ){
					echo '<a href="' . $imagesrc_large . '" title="" data-fluidbox><img src="' . $imagesrc_thumb . '" title="" alt=""></a>'; 
				}
				if( !empty($project_photo['_cmb_wording']) ){ echo '<div class="caption"><span class="up">&#8679;</span>' . wpautop($project_photo['_cmb_wording']) . '</div><br>'; }
				//echo wp_get_attachment_image( $attachment_id, $size, $icon, $attr );
			}
		}

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'martin-stevens' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php martin_stevens_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

