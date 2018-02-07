<?php
/**
 * Template part for displaying featured posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package paloma
 */

?>

<article class="paloma-featured" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="index-content">

		<header class="entry-header">
			<?php $display_cats = get_theme_mod('display_cats', '1');
			if ($display_cats == '1') {
	            	get_template_part( 'template-parts/content', 'category' ); 
			} ?>

			<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
		
			<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php paloma_posted_on(); ?>
			</div>
			<?php endif; ?>

		</header><!-- .entry-header -->

		<?php $single_featured_img = get_theme_mod('display_featured_img', 0);
		if ($single_featured_img != 0){ ?>
			<div class="paloma-featured-img">
				<?php if (has_post_thumbnail()) {
					echo '<a href="' , the_permalink() , '">' , the_post_thumbnail('full') , '</a>';
				} ?>
			</div>
		<?php } ?>

		<div class="entry-content">
			<?php
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'paloma' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );
			?>

			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'paloma' ),
					'after'  => '</div>',
				) );
			?>

		</div><!-- .entry-content -->

		<footer class="clear entry-footer">
			<div class="footer-meta">
				<?php $display_byline_featured = get_theme_mod('display_byline_featured', 1);
                if ($display_byline_featured == 1){
					paloma_entry_author();
				}
				//paloma_entry_footer(); ?>
			</div>

			<?php //display share icons
            	$display_share = get_theme_mod('display_share_single', 1);
                if ($display_share == '1'){
                     get_template_part( 'template-parts/content', 'share' );
                 }
             ?>
		</footer>
	
	</div><!-- .index-content -->
</article><!-- #post-## -->
