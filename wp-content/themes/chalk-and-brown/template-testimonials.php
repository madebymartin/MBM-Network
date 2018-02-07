<?php
/*
Template Name: Testimonials
*/
get_header(); 
?>
			
	<div id="content">
		<?php
		if (get_the_content() != '') {
			?>
			<div id="inner-content" class="row">
		
			    <main id="main" class="large-12 medium-12 columns" role="main">
					
					<?php if (have_posts()) : while (have_posts()) : the_post(); 

						get_template_part( 'parts/loop', 'page' );

					endwhile; endif; ?>							

				</main> <!-- end #main -->
			    
			</div> <!-- end #inner-content -->

			<?php
		}
		$projects = new wp_query( array(
			'post_type' => 'testimonial',
			'orderby' => 'title',
			'posts_per_page' => -1,
			'orderby' => 'date',
			'order'	=>	'DESC'
		) );

		if ( $projects->have_posts() ) {
			$div_id = 1;
			while ( $projects->have_posts() ) : $projects->the_post();
			?>


			<div class="row alternate testimonial" id="<?php echo $div_id; ?>">
				<article role="article">
				    <section class="entry-content center">
				    <?php
					echo '<span>"' . get_the_content(get_the_ID()) . '"<br><span class="name">'. get_the_title() .'</span></span>';
					?>
					</section> <!-- end article section -->
				</article> <!-- end article -->
			</div> <!-- end #inner-content -->

			<?php
			$div_id ++;

			endwhile;
			wp_reset_postdata();
		}
		?>

	</div> <!-- end #content -->

<?php get_footer(); ?>
