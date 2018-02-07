<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Germaine_de_Capuccini
 */

$linked_products = p2p_type( 'product-treatment' )->get_connected( get_the_ID() );

get_header(); ?>

	<div id="primary" class="content-area woocommerce">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			//get_template_part( 'template-parts/content', get_post_format() );

		?>

		<div class="product status-publish treatment">

			<div class="product-summary">

				<div id="desktop-product-images"></div>
				<div class="summary entry-summary">

					<h1 itemprop="name" class="product_title entry-title"><?php the_title();  ?></h1>

					<?php $subheading = get_post_meta(get_the_ID(), 'mbm_treatment_subheading', true);
					if( !empty($subheading) ){
						echo '<span class="subheading">' . $subheading . '</span>';
					} ?>

					<div id="mobile-product-images"></div>


					<div class="images">
						<?php
						if ( has_post_thumbnail() ) {
						    the_post_thumbnail();
						}
						else {

							$terms = wp_get_object_terms( $post->ID, 'treatment_category', array('fields' => 'all') ); // get all the terms on that post
							$images = get_option('taxonomy_image_plugin'); // get the taxonomy images array
							if(!empty($terms)){
								foreach($terms as $term) { // iterate through each term
								    $term_id = $term->term_taxonomy_id; // get the ID of the term
								    if( array_key_exists( $term_id, $images ) ) { // check if term has an image
								        $img = wp_get_attachment_image( $images[$term_id], 'Shop_single' ); // if it does, echo that image
								    }
								}
								echo $img;
							}
							else{
								echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/img/thumbnail-default-treatment.jpg" />';
							}
							
						} ?>
					</div>


					<hr>
					<div id="desktop-description"></div>
					<div id="shortdescription" itemprop="description">
						<?php  
						the_excerpt();  

						$benefits = get_post_meta(get_the_ID(), 'mbm_treatment_key_points', true);
						if( !empty($benefits) ){
							echo '<ul class="benefits">';
							foreach ($benefits as $key => $benefit) {
								echo '<li>';
								echo $benefit;
								echo '</li>';
							}
							echo '</ul>';
						}


						?>
					</div>
					<div id="mobile-description"></div>

					<hr> 
					<?php 
					if ( is_active_sidebar( 'single-treatment' ) ){
						dynamic_sidebar( 'single-treatment' );
					} 
					?>

				</div><!-- .summary -->

		</div>


		<article id="post-<?php the_ID(); ?>" class="treatment-details">
			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- .entry-content -->
		</article><!-- #post-## -->

		<?php

		if($linked_products->have_posts()){
			?><br><br>
			<article class="treatment-details">
				<div class="entry-content">
				<h2 class="center">Related Products</h3>
					<ul class="products">
						<?php 
						while( $linked_products->have_posts() ) : $linked_products->the_post();
						wc_get_template_part( 'content', 'product' );
							// $id = get_the_ID();			
							// echo '<a href="'. get_permalink($id) .'" title="'. get_the_title($id) .'">'. get_the_title($id) .'</a><br>';
						endwhile;
						?>
					</ul>
				</div><!-- .entry-content -->
			</article><!-- #post-## -->

			<?php
			
		}




			the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar('treatments');
get_footer();
