<?php
/* Add Custom Post Types */
add_action( 'init', 'create_post_type' );
 
function create_post_type() {
	/* Add Treatments Post Type */
    register_post_type( 'treatments',
        array(
            'labels' => array(
                'name' => __( 'Treatments' ),
                'singular_name' => __( 'Treatment' ),
                'add_new' => __( 'Add Treatment' ),
                'add_new_item' => __( 'Add Treatment' ),
                'edit' => __( 'Edit Treatment' ),
                'edit_item' => __( 'Edit Treatment' ),
                'new_item' => __( 'Add New Treatment' ),
                'view' => __( 'View This Treatment' ),
                'view_item' => __( 'View This Treatment' ),
                'search_items' => __( 'Search Treatments' ),
                'not_found' => __( 'No Treatment Found' ),
                'not_found_in_trash' => __( 'No Treatment found in Trash' ),
            ),
            'description' => __('Treatments'),
            'public' => true,
            'show_ui' => true, // UI in admin panel
            'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array("slug" => "treatments"), // Permalinks format
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'menu_position' => 20,
            'supports' => array( 
            	'title', 'editor', 'thumbnail'),
            'menu_position' => '9',
            'can_export' => true,
			'has_archive' => true, 
			'taxonomies' => array('treatment_category', 'excerpt') // this is IMPORTANT
        )
    );



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

/* Add Bridal Post Type */
    register_post_type( 'bridal',
        array(
            'labels' => array(
                'name' => __( 'Bride & Groom' ),
                'singular_name' => __( 'Bridal Page' ),
                'add_new' => __( 'Add Bridal Page' ),
                'add_new_item' => __( 'Add Bridal Page' ),
                'edit' => __( 'Edit Bridal Page' ),
                'edit_item' => __( 'Edit Bridal Page' ),
                'new_item' => __( 'Add New Bridal Page' ),
                'view' => __( 'View This Bridal Page' ),
                'view_item' => __( 'View This Bridal Page' ),
                'search_items' => __( 'Search Bridal Page' ),
                'not_found' => __( 'No Bridal Page Found' ),
                'not_found_in_trash' => __( 'No Bridal Page found in Trash' ),
            ),
            'description' => __('Bridal Page'),
            'public' => true,
            'show_ui' => true, // UI in admin panel
            'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array("slug" => "bridal"), // Permalinks format
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'menu_position' => 20,
            'supports' => array( 
            	'title', 'editor', 'thumbnail'),
            'menu_position' => '5',
            'can_export' => true, 
			'taxonomies' => array('')
        )
    );





/* Add Testimonials Post Type */
    register_post_type( 'testimonial',
        array(
            'labels' => array(
                'name' => __( 'Testimonials' ),
                'singular_name' => __( 'Testimonial' ),
                'add_new' => __( 'Add Testimonial' ),
                'add_new_item' => __( 'Add Testimonial' ),
                'edit' => __( 'Edit Testimonial' ),
                'edit_item' => __( 'Edit Testimonial' ),
                'new_item' => __( 'Add New Testimonial' ),
                'view' => __( 'View This Testimonial' ),
                'view_item' => __( 'View This Testimonial' ),
                'search_items' => __( 'Search Testimonial' ),
                'not_found' => __( 'No Testimonial Found' ),
                'not_found_in_trash' => __( 'No Testimonial found in Trash' ),
            ),
            'description' => __('Testimonials'),
            'public' => true,
            'show_ui' => true, // UI in admin panel
            'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array("slug" => "testimonials"), // Permalinks format
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'menu_position' => 20,
            'supports' => array( 
            	'title', 'editor', 'thumbnail'),
            'menu_position' => '5',
            'can_export' => true, 
			'taxonomies' => array('bridal_categories')
        )
    );


/* Add Rcommendations Post Type */
    register_post_type( 'recommendations',
        array(
            'labels' => array(
                'name' => __( 'Recommendation' ),
                'singular_name' => __( 'Recommendation' ),
                'add_new' => __( 'Add Recommendation' ),
                'add_new_item' => __( 'Add Recommendation' ),
                'edit' => __( 'Edit Recommendation' ),
                'edit_item' => __( 'Edit Recommendation' ),
                'new_item' => __( 'Add New Recommendation' ),
                'view' => __( 'View This Recommendation' ),
                'view_item' => __( 'View This Recommendation' ),
                'search_items' => __( 'Search Recommendation' ),
                'not_found' => __( 'No Recommendation Found' ),
                'not_found_in_trash' => __( 'No Recommendation found in Trash' ),
            ),
            'description' => __('Recommendations'),
            'public' => true,
            'show_ui' => true, // UI in admin panel
            'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array("slug" => "recommendation"), // Permalinks format
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'menu_position' => 20,
            'supports' => array( 
            	'title', 'editor', 'thumbnail'),
            'menu_position' => '5',
            'can_export' => true, 
			'taxonomies' => array('')
        )
    );






}


// CUSTOM TAXONOMIES BELOW HERE----------------//


// TREATMENT CATEGORY TAXONOMY-----------------//

//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_treatment_categories', 0 );

//create taxonomy, "treatment Categories" for the post type "treatments"
function create_treatment_categories() 
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => _x( 'Treatment Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'Treatment Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Treatment Categories' ),
    'all_items' => __( 'All Treatment Categories' ),
    'parent_item' => __( 'Parent Treatment Category' ),
    'parent_item_colon' => __( 'Parent Treatment Category:' ),
    'edit_item' => __( 'Edit Treatment Category' ), 
    'update_item' => __( 'Update Treatment Category' ),
    'add_new_item' => __( 'Add New Treatment Category' ),
    'new_item_name' => __( 'New Treatment Category Name' ),
    'menu_name' => __( 'Treatment Categories' ),
  ); 	

  register_taxonomy('treatment_category',array('treatments'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'treatment_category' ),
  ));
}

// BRIDAL CATEGORY TAXONOMY-----------------//

//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_bridal_categories', 0 );

//create taxonomy, "treatment Categories" for the post type "treatments"
function create_bridal_categories() 
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => _x( 'Bridal Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'Bridal Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Bridal Categories' ),
    'all_items' => __( 'All Bridal Categories' ),
    'parent_item' => __( 'Parent Bridal Category' ),
    'parent_item_colon' => __( 'Parent Bridal Category:' ),
    'edit_item' => __( 'Edit Bridal Category' ), 
    'update_item' => __( 'Update Bridal Category' ),
    'add_new_item' => __( 'Add New Bridal Category' ),
    'new_item_name' => __( 'New Bridal Category Name' ),
    'menu_name' => __( 'Bridal Categories' ),
  ); 	

  register_taxonomy('bridal_category',array('bridal'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'bridal_category' ),
  ));
}



?>