<?php get_header(); ?>
			
<div id="content">

	<div id="inner-content" class="row">

		<main id="main" class="" role="main">
		
		    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		    	<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
					<header class="article-header">	
						<h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>
				    </header> <!-- end article header -->
									
				    <section class="entry-content center" itemprop="articleBody">
						<?php 
						// the_post_thumbnail('full'); 
						?>
						<?php 
						the_content();
						$photos = get_post_meta(get_the_ID(), 'mbm_photos_group', true);
						foreach ($photos as $key => $photo) {
	
							echo '<div class="photo">';
							if( !empty($photo['photo_id']) ){
								$img_id = $photo['photo_id'];
								echo wp_get_attachment_image( $img_id, 'banner', '', array( 'class' => 'full-width' ) );
							}
							if( !empty($photo['description']) ){
								echo '<div class="description">' . $photo['description'] . '</div>';
							}
							echo '</div>';

						} ?>
					</section> <!-- end article section -->
										
					<footer class="article-footer">
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'jointswp' ), 'after'  => '</div>' ) ); ?>
						<p class="tags"><?php the_tags('<span class="tags-title">' . __( 'Tags:', 'jointswp' ) . '</span> ', ', ', ''); ?></p>	
					</footer> <!-- end article footer -->
										
					<?php comments_template(); ?>	
																	
				</article> <!-- end article -->
		    	
		    <?php endwhile; else : ?>
		
		   		<?php 
		   		get_template_part( 'parts/content', 'missing' ); 
		   		?>

		    <?php endif; ?>

		</main> <!-- end #main -->

	</div> <!-- end #inner-content -->

</div> <!-- end #content -->

<?php get_footer(); ?>