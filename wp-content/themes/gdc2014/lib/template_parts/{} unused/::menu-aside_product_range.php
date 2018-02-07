<div class="aside buyit">
	<?php $categories = apply_filters( 'taxonomy-images-get-terms', '', array(
							'taxonomy'     => 'product_range',
							'having_images' => 'true',
							'parent'        =>  '0',
					        'hide_empty' => '0',
					        // 'exclude'   => '239',
						) );

	if ( sizeof( $categories ) ) { ?>
		<div class="aside-category-list">
			<?php $terms = apply_filters( 'taxonomy-images-get-terms', '', array(
				'taxonomy'     => 'product_range',
				'having_images' => 'true',
			) );
			print '<ul>';
			if ( ! empty( $terms ) ) {
			    foreach( (array) $terms as $term ) {
			        print '<li class="asideproductcat"><a href="' . esc_url( get_term_link( $term, $term->taxonomy ) ) . '"><div class="image-wrap">' . wp_get_attachment_image( $term->image_id, '200sq' ) . '<span class="info-icon"></span></div><p>' . esc_html( $term->name ) . '</p></a></li>';
			    }
			}
			print '</ul>'; ?>
		</div>


		<br><div class="note"><a href="<?php echo get_permalink('5808'); ?>">Shop by Category</a></div>

	<?php } else {} ?>
</div>
