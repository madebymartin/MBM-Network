<?php
/*
Template Name: Portfolio
*/
get_header(); 
$term = get_queried_object();
$term_id = $term->term_id;
// var_dump($term);
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

		if( term_description() != '' ){
			echo '<div class="row center"><section class="entry-content">'. term_description() .'</section></div>';
		}

		$projects = new wp_query( array(
			'post_type' => 'project',
			'orderby' => 'title',
			'posts_per_page' => -1,
			'orderby' => 'date',
			'order'	=>	'DESC',
			'tax_query' => array(
				array(
					'taxonomy' => 'services',
					'field'    => 'term_id',
					'terms'    => $term_id,
				),
			),
		) );

		if ( $projects->have_posts() ) {
			$div_id = 1;
			while ( $projects->have_posts() ) : $projects->the_post();
			?>


			<div class="row alternate project" id="<?php echo $div_id; ?>">
				<article <?php post_class(''); ?> role="article">
				    <section class="entry-content center">
				    <?php
				    echo '<h2>' . get_the_title() . '</h2>';
				    edit_post_link();
				    the_content();
					$photos = get_post_meta(get_the_ID(), 'mbm_photos_group', true);
					foreach ($photos as $key => $photo) {
						
						echo '<div class="photo">';
						if( !empty($photo['photo_id']) ){
							$img_id = $photo['photo_id'];
							echo wp_get_attachment_image( $img_id, 'large', '', array( 'class' => 'full-width' ) );
						}
						if( !empty($photo['description']) ){
							echo '<div class="description">' . $photo['description'] . '</div>';
						}
						echo '</div>';

					}

					
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
