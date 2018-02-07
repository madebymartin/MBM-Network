<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Intuity
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer center" role="contentinfo">

		<?php
		if(! is_page_template('template-testimonials.php')){
			$loop = new WP_Query( array( 
				'post_type' => 'testimonial',
				'orderby' => 'rand',
				'posts_per_page' => '1', 
				) );

			if($loop->have_posts()){
				while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<div class="testimonial">
						<div class="bubble">
							<?php the_content(); ?>
						</div>
						<p class="speech"><?php the_title(); ?></p>
					</div>
				<?php
				endwhile;

				echo '<a class="button" href="http://intuityhealingacademy.com/testimonials/">Read more testimonials</a>';
				echo '<br><br>';
			}

		} ?>

		
		<div class="site-info">

			<aside id="footer-widgets" class="widget-area" role="complementary">
				<?php dynamic_sidebar( 'footer' ); ?>
			</aside><!-- #secondary -->
			<?php 
				
				// intuity_copyright();
		$year = date( 'Y', time() );
		if($year > '2016'){ echo '<div class="copyright">Copyright 2016-' . $year . ' Intuity Healing Academy™</div>'; }
		else{ echo '<div class="copyright">Copyright ' . $year . ' Intuity Healing Academy™</div>'; }


			?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
