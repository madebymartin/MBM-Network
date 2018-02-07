<?php
get_header(); 
?>
			
	<div id="content">
	
		<?php
		// if (get_the_content() != '') {
			?>
			<div id="inner-content" class="row">
		
			    <main id="main" class="large-12 medium-12 columns" role="main">
					
					<?php if (have_posts()) : while (have_posts()) : the_post(); 

						get_template_part( 'parts/loop', 'page' );

					endwhile; endif; ?>							

				</main> <!-- end #main -->
			    
			</div> <!-- end #inner-content -->

			<?php
		// }
		?>
	
	</div> <!-- end #content -->

<?php get_footer(); ?>
