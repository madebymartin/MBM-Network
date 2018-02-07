<div class="aside category-list">
	<?php 
	$terms = apply_filters( 'taxonomy-images-get-terms', '', array(
	'taxonomy'     => 'treatment_category',
	'having_images' => 'true',
	) );
	print '<ul>';
	if ( ! empty( $terms ) ) {
	    foreach( (array) $terms as $term ) {
	        print '<li class="productcat"><a href="' . esc_url( get_term_link( $term, $term->taxonomy ) ) . '"><div class="image-wrap">' . wp_get_attachment_image( $term->image_id, '200sq' ) . '<span class="info-icon"></span></div><p>' . esc_html( $term->name ) . '</p></a></li>';
	    }
	}
	print '</ul>';
	?>
</div>