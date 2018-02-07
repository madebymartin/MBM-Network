<?php
get_header(); 
?>
			
	<div id="content">
	
		<?php
		// if (get_the_content() != '') {
			?>
		
			    <main id="main" role="main">
					
					<?php if (have_posts()) : while (have_posts()) : the_post(); 

						get_template_part( 'parts/loop', 'page' );

					endwhile; endif; ?>							

				</main> <!-- end #main -->
			    

			<?php
		// }
		?>
	
	</div> <!-- end #content -->

<?php get_footer(); ?>
