<?php if ( current_user_can('access_trade_content') ) { 
	$term =	$wp_query->queried_object;
	?>

	<div class="aside aside-category-list">
		<h3>Support Categories</h3>
		<?php 
		$terms = apply_filters( 'taxonomy-images-get-terms', '', array(
			'taxonomy'     => 'download_categories',
			'having_images' => 'true',
			'term_args' =>	array(
					'parent'    => 0,
					'hide_empty' => 0,
					)
			) 
		);
		print '<ul>';
		if ( ! empty( $terms ) ) {
		    foreach( (array) $terms as $term ) {


		    	if(get_queried_object()->name===$term->name){
								$class='currentitem';
							}else{ $class=''; }


		        print '<li class="asideproductcat '  . $class .  '"><a href="' . esc_url( get_term_link( $term, $term->taxonomy ) ) . '"><div class="image-wrap">' . wp_get_attachment_image( $term->image_id, '200sq' ) . '<span class="info-icon"></span></div><p>' . esc_html( $term->name ) . '</p></a></li>';
		    }
		}
		print '</ul>'; ?>
	</div>





<?php } else{ 
	//get_template_part( 'lib/template_parts/sidebar', 'trade' ); 
} ?>