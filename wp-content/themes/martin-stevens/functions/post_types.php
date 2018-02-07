<?php

/* ADD CUSTOM POST TYPE */
add_action( 'init', 'create_post_type' );
function create_post_type() {
    register_post_type( 'project',
        array(
            'labels' => array(
                'name' => __( 'Portfolio' ),
                'singular_name' => __( 'Project' ),
                'add_new' => __( 'Add Project' ),
                'add_new_item' => __( 'Add Project' ),
                'edit' => __( 'Edit Project' ),
                'edit_item' => __( 'Edit Project' ),
                'new_item' => __( 'Add New Project' ),
                'view' => __( 'View This Project' ),
                'view_item' => __( 'View This Project' ),
                'search_items' => __( 'Search Project' ),
                'not_found' => __( 'No Projects Found' ),
                'not_found_in_trash' => __( 'No Projects found in Trash' ),
            ),
            'description' => __('Project'),
            'public' => true,
            'show_ui' => true, // UI in admin panel
            'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array("slug" => "portfolio"), // Permalinks format
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'menu_position' => 20,
            'supports' => array(
            	'title', 'editor', 'thumbnail'),
            'menu_position' => '9',
            'can_export' => true,
			//'taxonomies' => array('treatment_category', 'excerpt') // this is IMPORTANT
        )
    );

    /* EDIT ADMIN COLUMNS FOR ABOVE POST TYPE */
    add_filter( 'manage_edit-treatments_columns', 'my_edit_treatments_columns' ) ;
    function my_edit_treatments_columns( $columns ) {
    	$columns = array(
    		'cb' => '<input type="checkbox" />',
    		'title' => __( 'treatments' ),
    		'treatment_category' => __( 'treatment_category' ),
    		'date' => __( 'Date' )
    	);
    	return $columns;
    }


    /* edit columns */
    add_action( 'manage_treatments_posts_custom_column', 'my_manage_treatments_columns', 10, 2 );
    function my_manage_treatments_columns( $column, $post_id ) {
    	global $post;
    	switch( $column ) {
    		/* If displaying the 'treatment_category' column. */
    		case 'treatment_category' :
    			/* Get the treatment_categorys for the post. */
    			$terms = get_the_terms( $post_id, 'treatment_category' );

    			/* If terms were found. */
    			if ( !empty( $terms ) ) {

    				$out = array();

    				/* Loop through each term, linking to the 'edit posts' page for the specific term. */
    				foreach ( $terms as $term ) {
    					$out[] = sprintf( '<a href="%s">%s</a>',
    						esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'treatment_category' => $term->slug ), 'edit.php' ) ),
    						esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'treatment_category', 'display' ) )
    					);
    				}

    				/* Join the terms, separating them with a comma. */
    				echo join( ', ', $out );
    			}

    			/* If no terms were found, output a default message. */
    			else {
    				_e( 'No Category Selected' );
    			}

    			break;

    		/* Just break out of the switch statement for everything else. */
    		default :
    			break;
    	}
    }
}
//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_product_range_tax', 0 );

//create taxonomy, "treatment Categories" for the post type "treatments"
function create_product_range_tax()
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => __( 'Product Ranges', 'taxonomy general name' ),
    'singular_name' => __( 'Product Range', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Product Ranges' ),
    'all_items' => __( 'All Product Ranges' ),
    'parent_item' => __( 'Parent Product Range' ),
    'parent_item_colon' => __( 'Parent Product Range' ),
    'edit_item' => __( 'Edit Product Range' ),
    'update_item' => __( 'Update Product Range' ),
    'add_new_item' => __( 'Add New Product Range' ),
    'new_item_name' => __( 'New Product Range Name' ),
    'menu_name' => __( 'Product Ranges' ),
  );

  register_taxonomy('product_range',array('range', 'product', 'treatments'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'range' ),
  ));
register_taxonomy_for_object_type( 'product_range', 'treatments' );

}
?>