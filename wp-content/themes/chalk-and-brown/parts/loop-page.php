<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
<?php
if( !get_post_meta(get_the_ID(), 'mbm_slides') ){
?>
	<header class="article-header">
		<h1 class="page-title">
		<?php 
		if( is_front_page() ){
			// mbm_flex_slider();
			// echo get_bloginfo('description');
		}else{
			the_title();
		} ?>
		</h1>
	</header> <!-- end article header -->

<?php
}
	?>
					
    <section class="entry-content" itemprop="articleBody">
	    <?php the_content(); ?>
	    <?php wp_link_pages(); ?>
	</section> <!-- end article section -->
						
	<footer class="article-footer">
		
	</footer> <!-- end article footer -->
						    
	<?php comments_template(); ?>
					
</article> <!-- end article -->