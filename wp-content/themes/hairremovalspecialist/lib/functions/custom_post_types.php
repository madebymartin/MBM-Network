<?php
/* Add Custom Post Types */
add_action( 'init', 'create_post_type' );
 
function create_post_type() {


/* Testimonials Post Type */
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
                'view' => __( 'View Testimonial' ),
                'view_item' => __( 'View This Testimonial' ),
                'search_items' => __( 'Search Testimonials' ),
                'not_found' => __( 'No Testimonials Found' ),
                'not_found_in_trash' => __( 'No Testimonials found in Trash' ),
            ),
            'description' => __('Testimonials'),
            'public' => true,
            'show_ui' => true, // UI in admin panel
            'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array("slug" => "testimonial"), // Permalinks format
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'menu_position' => 20,
            'supports' => array( 
            	'title', 'editor'),
            'menu_position' => '1',
            'can_export' => true, 
			'taxonomies' => array('') // this is IMPORTANT
        )
    );

/* Treatments Post Type */
    register_post_type( 'treatment',
        array(
            'labels' => array(
                'name' => __( 'Treatments' ),
                'singular_name' => __( 'Treatment' ),
                'add_new' => __( 'Add Treatment' ),
                'add_new_item' => __( 'Add Treatment' ),
                'edit' => __( 'Edit Treatment' ),
                'edit_item' => __( 'Edit Treatment' ),
                'new_item' => __( 'Add New Treatment' ),
                'view' => __( 'View Treatment' ),
                'view_item' => __( 'View This Treatment' ),
                'search_items' => __( 'Search Treatments' ),
                'not_found' => __( 'No Treatments Found' ),
                'not_found_in_trash' => __( 'No Treatments found in Trash' ),
            ),
            'description' => __('Treatments'),
            'public' => true,
            'show_ui' => true, // UI in admin panel
            'capability_type' => 'post',
            'hierarchical' => false,
            'rewrite' => array("slug" => "Treatment"), // Permalinks format
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'menu_position' => 20,
            'supports' => array( 
                'title', 'editor'),
            'menu_position' => '1',
            'can_export' => true, 
            'taxonomies' => array('') // this is IMPORTANT
        )
    );




}


//ADD TAXONOMIES 
add_action( 'init', 'add_taxonomies', 0 );

//create taxonomy, "Language Categories" for the post type "languages"
function add_taxonomies() 
{


  // Add Spa Testimonials Categories Taxonomy
  $labels = array(
    'name' => _x( 'Treatment Type', 'taxonomy general name' ),
    'singular_name' => _x( 'Treatment Type', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Treatment Types' ),
    'all_items' => __( 'All Treatment Types' ),
    'parent_item' => __( 'Parent Treatment Type' ),
    'parent_item_colon' => __( 'Parent Treatment Type:' ),
    'edit_item' => __( 'Edit Treatment Type' ), 
    'update_item' => __( 'Update Treatment Type' ),
    'add_new_item' => __( 'Add New Treatment Type' ),
    'new_item_name' => __( 'New Treatment Type Name' ),
    'menu_name' => __( 'Treatment Types' ),
  ); 	

  register_taxonomy('treatment_type',array('treatment'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    //'rewrite' => array( 'slug' => 'treatment_type' ),
  ));
}

?>