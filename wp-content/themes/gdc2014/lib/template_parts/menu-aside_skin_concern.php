<?php $categories = apply_filters( 'taxonomy-images-get-terms', '', array(
						'taxonomy'     => 'skin_concern',
						'having_images' => 'false',
						'parent'        =>  '0',
				        'hide_empty' => '0',
				        // 'exclude'   => '239',
					) );

$queried_object = get_queried_object();
$current_term = $queried_object->name;

if ( sizeof( $categories ) ) { ?>
	<div class="aside-category-list">
		<?php $terms = apply_filters( 'taxonomy-images-get-terms', '', array(
			'taxonomy'     => 'skin_concern',
			'having_images' => 'false',
		) );
		print '<ul>';
		if ( ! empty( $terms ) ) {
		    foreach( (array) $terms as $term ) {
		    	$term_name = $term->name;
		    	if ($term_name == $current_term){
		        print '<li class="asideproductcat currentitem"><a href="' . esc_url( get_term_link( $term, $term->taxonomy ) ) . '"><div class="image-wrap">' . wp_get_attachment_image( $term->image_id, '200sq' ) . '<span class="info-icon"></span></div><p>' . esc_html( $term->name ) . '</p></a></li>';
		    	}
		    	else {
		        print '<li class="asideproductcat"><a href="' . esc_url( get_term_link( $term, $term->taxonomy ) ) . '"><div class="image-wrap">' . wp_get_attachment_image( $term->image_id, '200sq' ) . '<span class="info-icon"></span></div><p>' . esc_html( $term->name ) . '</p></a></li>';
		    	}
		    }
		}
		print '</ul>'; ?>
	</div>

<?php } else {} ?>