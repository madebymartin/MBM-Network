<?php 
//thematic_postheader(); 
?>
<div class="category-list">
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
        print '<li class="productcat"><a href="' . esc_url( get_term_link( $term, $term->taxonomy ) ) . '"><div class="image-wrap">' . wp_get_attachment_image( $term->image_id, '200sq' ) . '<span class="info-icon"></span></div><h3>' . esc_html( $term->name ) . '</h3><div class="prodcatinfo"><p class="mobilehide">' . esc_html( $term->description ) . '</p></div></a></li>';
	    }
	}
	print '</ul>';
	?>
</div>