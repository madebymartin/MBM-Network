<?php if ( current_user_can('access_trade_content') ) { 
	$term =	$wp_query->queried_object;
	?>

	<div class="aside aside-category-list">
		<h3>Image Library</h3>
		<?php 
		$terms = apply_filters( 'taxonomy-images-get-terms', '', array(
			'taxonomy'     => 'media_categories',
			'having_images' => 'true',
			'term_args' =>	array(
					'parent'    => 0,
					'hide_empty' => 0,
					)
			) 
		);

		$product_images_page_link = get_permalink('24774');

		print '<ul>';
		if ( ! empty( $terms ) ) {
		    foreach( (array) $terms as $term ) {


		    	if(get_queried_object()->name===$term->name){
					$class=' currentitem';
				}else{ 
					$class=''; 
				}

		        print '<li class="asideproductcat'  . $class .  '"><a href="' . esc_url( get_term_link( $term, $term->taxonomy ) ) . '"><div class="image-wrap">' . wp_get_attachment_image( $term->image_id, '200sq' ) . '<span class="info-icon"></span></div><p>' . esc_html( $term->name ) . '</p></a></li>';
		    }
		}
		global $wp_query;
		$current_page_id = $wp_query->get_queried_object_id();

		if($current_page_id == '24774'){
			$class=' currentitem';
		}else{ 
			$class=''; 
		}

        print '<li class="asideproductcat'  . $class .  '"><a href="' . $product_images_page_link . '"><div class="image-wrap">' . get_the_post_thumbnail( '24774', '200sq' ) . '<span class="info-icon"></span></div><p>Product Images</p></a></li>';
		print '</ul>'; ?>
	</div>



<?php } else{ } ?>