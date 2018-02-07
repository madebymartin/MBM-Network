<?php get_header(); ?>
			
	<div id="content" itemscope itemtype="http://schema.org/WebPage">
	
		<div id="inner-content" class="row">
	
		    <main id="main" class="large-12 medium-12" role="main">


					<div class="row">
						<article>
							<div class="large-12 medium-12 columns">
								<p class="center">NWG Commercial Gardening specialise in commercial gardening and grounds maintenance in Sussex.</p><br>
								<div class="large-2 medium-2 columns"></div>
								<div class="large-8 medium-8 columns greentext">
									<div class="large-4 medium-4 columns center"><img class="pad" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/communication.png" alt="Chalk & Brown Van"><br>EXCELLENT<br>COMMUNICATION</div>
									<div class="large-4 medium-4 columns center"><img class="pad" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/timekeeping.png" alt="Chalk & Brown Van"><br>RELIABILITY</div>
									<div class="large-4 medium-4 columns center"><img class="pad" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/positive.png" alt="Chalk & Brown Van"><br>EXTRAORDINARY<br>SERVICE</div>
								</div>
								<div class="large-2 medium-2 columns"></div>
							</div>
						</article>
					</div> <!-- end .row -->
			
								
			</main> <!-- end #main -->
		    
		</div> <!-- end #inner-content -->







		<div class="row green">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<article <?php post_class(''); ?> role="article">

				    <section class="entry-content center" itemprop="articleBody">
					    <?php the_content(); ?>
					    <?php wp_link_pages(); ?>
					</section> <!-- end article section -->
										
					<footer class="article-footer">
						
					</footer> <!-- end article footer -->

				</article> <!-- end article -->
				
			<?php endwhile; endif; ?>


				
	
				
				
		</div> <!-- end #inner-content -->












	
	</div> <!-- end #content -->

<?php get_footer(); ?>
