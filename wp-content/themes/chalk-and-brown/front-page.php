<?php get_header(); ?>
			
	<div id="content" itemscope itemtype="http://schema.org/WebPage">
	
		<div id="inner-content" class="row">
	
		    <main id="main" class="large-12 medium-12" role="main">
				
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article">

						<header class="article-header">
							<h2 class="page-title">We are Paul Chalk &amp; Gary Brown</h2>
							<span class="subheading">Painting, decorating and carpentry specialists in the South West London area since 1988.</span><br><br>
						</header> <!-- end article header -->

<!-- 						<div class="center">
							<div class="paul face animate stepone"></div>
							<div class="gary face animate steptwo"></div>
						</div> -->
											    										
					</article> <!-- end article -->
					
				<?php endwhile; endif; ?>							

			</main> <!-- end #main -->
		    
		</div> <!-- end #inner-content -->





		<div class="row brown">
	

			    <section itemprop="articleBody">

			    	<a class="servicelink" href="<?php echo get_site_url(); ?>/service/painting-decorating/"><div class="image" style="background-image:url(<?php echo get_stylesheet_directory_uri() ?>/assets/images/painting.jpg)"></div><span>Painting &amp; Decorating</span></a>
			    	<a class="servicelink" href="<?php echo get_site_url(); ?>/service/carpentry/"><div class="image" style="background-image:url(<?php echo get_stylesheet_directory_uri() ?>/assets/images/carpentry.jpg)"></div><span>Carpentry</span></a>
			    	<a class="servicelink" href="<?php echo get_site_url(); ?>/service/repairs-and-restoration/"><div class="image" style="background-image:url(<?php echo get_stylesheet_directory_uri() ?>/assets/images/ourwork.jpg)"></div><span>Repairs &amp; Restoration</span></a>
			    	<a class="servicelink" href="<?php echo get_site_url(); ?>/reviews/"><div class="image" style="background-image:url(<?php echo get_stylesheet_directory_uri() ?>/assets/images/reviews.jpg)"></div><span>Testimonials</span></a>

				</section> <!-- end article section -->
								
				
		</div> <!-- end #inner-content -->







		<div class="row">
				<article <?php post_class(''); ?> role="article">
				    <section class="entry-content center">
					    <?php
					    $testimonials = new wp_query( array(
							'post_type' => 'testimonial',
							'orderby' => 'title',
							'posts_per_page' => '1',
							'orderby' => 'rand'
						) );

						if ( $testimonials->have_posts() ) {
							while ( $testimonials->have_posts() ) : $testimonials->the_post();
								echo '<span class="testimonial">"' . get_the_content(get_the_ID()) . '"<br><span class="name">'. get_the_title() .'</span></span>';
							endwhile;
							// Prevent weirdness
							wp_reset_postdata();
						}

						echo '<a href="'. get_site_url() . '/reviews/" class="button">Read all reviews</a>';

					    ?>
					</section> <!-- end article section -->
				</article> <!-- end article -->
		</div> <!-- end #inner-content -->








		<div class="row brown">
	
				<article <?php post_class(''); ?> role="article">

				    <section class="entry-content center" itemprop="articleBody">
					    <?php the_content(); ?>
					    <?php wp_link_pages(); ?>
					</section> <!-- end article section -->
										
					<footer class="article-footer">
						
					</footer> <!-- end article footer -->

				</article> <!-- end article -->
				
		</div> <!-- end #inner-content -->



		<div class="row">
	
				<article <?php post_class(''); ?> role="article">

				    <section class="entry-content center" itemprop="articleBody">
				    <br><br><p>We are delighted to take all enquiries and offer free, no-obligation advise wherever possible.</p><a class="button" href="<?php echo get_site_url(); ?>/contact">Contact Us Now</a><br><br><br>
					</section> <!-- end article section -->
										
				</article> <!-- end article -->
				
		</div> <!-- end #inner-content -->









	
	</div> <!-- end #content -->

<?php get_footer(); ?>
