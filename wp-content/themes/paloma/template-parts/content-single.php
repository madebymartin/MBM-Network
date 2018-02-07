<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package paloma
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php $display_cats = get_theme_mod('display_cats', '1');
		if ($display_cats == '1') {
            	get_template_part( 'template-parts/content', 'category' ); 
		} ?>

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php paloma_posted_on(); ?>
			<?php paloma_entry_author(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

		<?php $single_featured_img = get_theme_mod('display_featured_img', 0);
		if ($single_featured_img != 0){ ?>
			<div class="paloma-featured-img">
				<?php if (has_post_thumbnail()) {
					echo the_post_thumbnail('full'); 
				} ?>
			</div>
		<?php } ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'paloma' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="clear entry-footer">
		<?php paloma_entry_footer(); ?>

			<?php
            $display_share = get_theme_mod('display_share_single', 1);
                if ($display_share == '1'){
                     get_template_part( 'template-parts/content', 'share' );
                 }
             ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

