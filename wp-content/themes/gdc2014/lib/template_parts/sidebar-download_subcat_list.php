<?php if ( current_user_can('access_trade_content') ) { 
	$term =	$wp_query->queried_object;
	$parent_term_id = $term->parent;
	$parent_term= get_term_by( 'id', $parent_term_id, 'download_categories');
	$parent_term_name = $parent_term->name;
	$child_terms = get_term_children( $parent_term_id, $term->taxonomy );
	//print_r($term);
	?>

		<?php 
		$sibling_terms = apply_filters( 'taxonomy-images-get-terms', '', array(
			'taxonomy'     => 'download_categories',
			'having_images' => 'true',
			'term_args' =>	array(
					'parent'    => $parent_term_id,
					'hide_empty' => 0,
					)
			) 
		);
		
		if ( $sibling_terms ) { ?>
			<div class="aside aside-category-list">
				<?php 
				//print_r($sibling_terms); 

				if($parent_term_name){
					echo '<h3>' . $parent_term_name . '</h3>';
				} ?>

				<ul>
				<?php foreach( (array) $sibling_terms as $sibling_term ) {
					if ($sibling_term->parent === '0'){
						// Silence
					} else { 
						// NOT TOP LEVEL TERM
							if(get_queried_object()->name===$sibling_term->name){
								$class='currentitem';
							}else{ $class=''; }
							
							//print '<li>' .  get_queried_object()->name . '</li>';
							print '<li class="asideproductcat '  . $class .  '"><a href="' . esc_url( get_term_link( $sibling_term, $sibling_term->taxonomy ) ) . '"><div class="image-wrap">' . wp_get_attachment_image( $sibling_term->image_id, '200sq' ) . '<span class="info-icon"></span></div><p>' . esc_html( $sibling_term->name ) . '</p></a></li>';
					}
			    } ?>
				</ul>
		    </div>
		<?php } else {} ?>
	

<?php } else{ } ?>