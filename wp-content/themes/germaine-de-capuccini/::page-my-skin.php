<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Germaine_de_Capuccini
 */


/*
* User Info
*/
$user_id = get_current_user_id();
$userdata = get_userdata($user_id);
$first_name = $userdata->first_name;
$user_meta = get_user_meta(get_current_user_id() );
$user_eye_concern_id = 'skx_' . $user_meta['skx_eye_concern'][0];
$user_gender = $user_meta['skx_gender'][0];
$user_concern = $user_meta['skx_concern'][0];
$user_skintype = $user_meta['skx_skintype'][0];
$user_combo = 'skx_' . $user_gender . '_' . $user_concern . '_' . $user_skintype;


/*
* SKX Info
*/
$max_recommendations = get_option( 'skx_max_products' );
$genders = get_skx_options()['skx_gender'];
$concerns = get_skx_options()['skx_concern'];
$comment_id = $user_combo . '_comment';
$skx_comment = get_option( $comment_id );


/*
*	Get Recommended Products
*	Main Products
*/
$recommended_products = array();
for ($i = 1; $i <= $max_recommendations; $i++) {
	$option_id = $user_combo . '_' . $i;
	$recommended_products[] = get_option( $option_id );
}


/*
*	Eye Product
*/
$eye_concern_product = get_option( $user_eye_concern_id);
if( $eye_concern_product != 0 ){ $recommended_products[] = $eye_concern_product;}



get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
			while ( have_posts() ) : the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>













				<?php
				if( is_user_logged_in() ){
					?>
					<header class="entry-header">
						<?php echo '<h1 class="entry-title">'. $first_name .'\'s Skin</h1>'; ?>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php
							the_content();
							wc_print_notices();


							echo $first_name . ', these are the perfect products for you!';

							if($skx_comment){ echo '<hr>' . $skx_comment . '<hr>'; }


							echo '<ul class="margin0 padding0 skx">';
							foreach ($recommended_products as $key => $product_id) {
								if($product_id != 0){
									$product = new WC_Product( $product_id );
									$price = $product->price;
									$product_meta = get_post_meta($product_id);
									$add_to_cart_url = get_permalink() . '?add-to-cart=' . $product_id . '' ;
									$prodprice = number_format($price, 2, '.', '');
									
									// else { $instructions = term_description( '155', 'recommendation_type' ); }

									echo '<li>';
										
										echo '<h3>'. get_the_title($product_id) .'</h3>';
										echo '<a href="'. get_permalink($product_id) .'">Go to product ></a>';
										echo '<div class="image-wrap">' . get_the_post_thumbnail( $product_id, 'large' ) . '</div>';
										if( get_the_excerpt( $product_id ) ){ echo '<div class="decription">'. get_the_excerpt( $product_id ) .'</div>'; }
										if ( get_post_meta($product_id, "instructions", true) ) { echo '<div class="instructions">' . get_post_meta($product_id, "instructions", true) . '</div>'; } 
										echo '<a href="'. $add_to_cart_url .'" class="button" rel="nofollow">Add to Bag (£'.$prodprice.')</a>';
									echo '</li>';
								}

							}
							echo '</ul>';



/*							echo '<pre><small>';
								echo 'Combo: ' . $user_combo;
								echo '<br>Eye concern: ' . $user_eye_concern_id;
								echo '<br>Eye product: ' . $eye_concern_product;
								echo '<br>Comment: ' . $skx_comment;

								print_r($recommended_products);

								foreach ($recommended_products as $key => $product_id) {
									if($product_id != 0){
										$product = new WC_Product($product_id);
										echo get_the_title($product_id) . '<br>';
										// echo $product->get_title . '<br>';
									}
									
								}

							echo '</small></pre>';
							echo '<hr>';*/




/*							echo '<pre>';

							$skx_eye_options = get_skx_eye_options();
					        foreach ($skx_eye_options as $skx_eye_option_key => $skx_eye_option_val) {
					        	if($skx_eye_option_key != 'skx_none'){
					        		$field_id = $skx_eye_option_key;
						        	$field_name = $skx_eye_option_val;
						        	echo 'id: ' . $field_id . '<br>name: ' . $field_name . '<hr>';

					        	}
					        }


							print_r($recommended_products);
					        foreach ($genders as $gender_key => $gender_val) {
					        	foreach ($concerns as $concern_key => $concern_val) {
					        		$tab_id = $gender_key . '-' . $concern_key;
					        		$tab_title = $gender_val . ' ' . $concern_val;
					        		$skx_options = get_skx_options($gender_key, $concern_key);
					        		$combos = get_combinations($skx_options);
					        		$fields = array();
					        		foreach ($combos as $key => $combo) {
					        			//print_r($combo);
					        			
					        			
					        			for ($i = 1; $i <= $max_recommendations; $i++) {

					        				$field_id = implode( '_', array_keys($combo) ). '_' . $i;
						        			echo $field_id . '<br>';
										}
										echo '<b>' . implode( '_', array_keys($combo) ). '_comment</b><hr>';

					        		}
					        	}

					        }

							echo '</pre>';*/

							wp_link_pages( array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'germaine-de-capuccini' ),
								'after'  => '</div>',
							) );
						?>
					</div><!-- .entry-content -->

					<?php if ( get_edit_post_link() ) : ?>
						<footer class="entry-footer">
							<?php
								edit_post_link(
									sprintf(
										/* translators: %s: Name of current post */
										esc_html__( 'Edit %s', 'germaine-de-capuccini' ),
										the_title( '<span class="screen-reader-text">"', '"</span>', false )
									),
									'<span class="edit-link">',
									'</span>'
								);
							?>
						</footer><!-- .entry-footer -->
					<?php endif; ?>













				<?php
				}else{
					// NOT LOGGED IN
					?>


					<header class="entry-header">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php
							the_content();

							wp_link_pages( array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'germaine-de-capuccini' ),
								'after'  => '</div>',
							) );
						?>
					</div><!-- .entry-content -->

					<?php if ( get_edit_post_link() ) : ?>
						<footer class="entry-footer">
							<?php
								edit_post_link(
									sprintf(
										/* translators: %s: Name of current post */
										esc_html__( 'Edit %s', 'germaine-de-capuccini' ),
										the_title( '<span class="screen-reader-text">"', '"</span>', false )
									),
									'<span class="edit-link">',
									'</span>'
								);
							?>
						</footer><!-- .entry-footer -->
					<?php endif; 


				} ?>






				</article><!-- #post-## -->



				<?php

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
