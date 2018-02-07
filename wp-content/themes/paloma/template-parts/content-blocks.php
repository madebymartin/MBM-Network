<?php
/**
 * Template part for displaying posts in block format
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package paloma
 */

?>

<li class="block-article">

	<article id="post-<?php the_ID(); ?>">
		<div class="block-featured">
				<?php if (has_post_thumbnail()) { ?>
					<a href="<?php echo the_permalink();?>">
					<?php echo the_post_thumbnail('landscape-featured'); ?>
					</a>
				<?php } ?>
		</div>

			<header class="entry-header">
				<?php //Display post category if set in customizer
					$blog_display_cats = get_theme_mod('blog_display_cats', 1);
					$archive_display_cats = get_theme_mod('archive_display_cats', 1);	
					if ( (is_home() && ($blog_display_cats == 1) ) || (is_archive() && ($archive_display_cats == 1) ) ) {
	            		get_template_part( 'template-parts/content', 'category' ); 
	            	}
				?>

				<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

				<?php if ( 'post' === get_post_type() ) : ?>
					<?php //Display post date if set in customizer
					$blog_display_date = get_theme_mod('blog_display_date', 1);
					$archive_display_date = get_theme_mod('archive_display_date', 1);
					if ( (is_home() && ($blog_display_date == 1) ) || (is_archive() && ($archive_display_date == 1) ) ) { ?>
	            		<div class="entry-meta">
							<?php paloma_posted_on(); ?>
						</div>
	            	<?php } ?>
				<?php endif; ?>

			</header><!-- .entry-header -->	

			<div class="entry-content">
				<?php
					the_excerpt( sprintf(
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
		
	</article>

</li>

