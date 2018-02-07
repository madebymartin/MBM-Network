<?php 
$terms = apply_filters( 'taxonomy-images-get-terms', '', array(
	'taxonomy'     => 'product_range',
	'having_images' => 'true',
) );

/*
print '<ul>';
if ( ! empty( $terms ) ) {
    foreach( (array) $terms as $term ) {
        print '<li class="productcat">';
        	print '<a href="' . esc_url( get_term_link( $term, $term->taxonomy ) ) . '">';
	        	print '<div class="image-wrap">';
			        print wp_get_attachment_image( $term->image_id, '200sq' );
			        print '<span class="info-icon"></span>';
		        print '</div>';

		        print '<h3>' . esc_html( $term->name ) . '</h3></a>';
		        print '<p class="mobilehide">' . esc_html( $term->description ) . '</p>';
	        print '</a>';
        print '</li>';
    }
}
print '</ul>';
*/


$terms = apply_filters( 'taxonomy-images-get-terms', '', array(
	'taxonomy'     => 'product_range',
	'having_images' => 'true',
) );
print '<ul>';
if ( ! empty( $terms ) ) {
    foreach( (array) $terms as $term ) {
        print '<li class="productcat">';

		        print '<a href="' . esc_url( get_term_link( $term, $term->taxonomy ) ) . '">';
			        print '<div class="image-wrap">';
				        print wp_get_attachment_image( $term->image_id, '200sq' );
				        print '<span class="info-icon"></span>';
			        print '</div>';
					print '<h3>' . esc_html( $term->name ) . '</h3>';
		        print '</a>';


	        print '<div class="prodcatinfo">';
	        print '<p class="mobilehide">' . esc_html( $term->description ) . '</p>';
	        print '</div>';

        print '</li>';
    }
}
print '</ul>'; 
?>