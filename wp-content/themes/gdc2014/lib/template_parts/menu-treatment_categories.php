<?php 
$terms = apply_filters( 'taxonomy-images-get-terms', '', array(
	'taxonomy'     => 'treatment_category',
	'having_images' => 'true',
) );
print '<ul>';
if ( ! empty( $terms ) ) {
    foreach( (array) $terms as $term ) {
        //print '<li class="productcat"><a href="' . esc_url( get_term_link( $term, $term->taxonomy ) ) . '"><div class="prodcatinfo"><h3>' . esc_html( $term->name ) . '</h3><p>' . esc_html( $term->description ) . '</p></div><div class="image-wrap">' . wp_get_attachment_image( $term->image_id, '200sq' ) . '<span class="info-icon"></span></div></a></li>';


/* SUPERCEEDS ABOVE COMMENTED LINE */
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
/* SUPERCEEDS ABOVE COMMENTED LINE */



    }
}
print '</ul>';
?>