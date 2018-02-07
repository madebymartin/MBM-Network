<?php
/* Add Custom Post Types */
add_action( 'init', 'create_post_type' );
 
function create_post_type() {


/* Spa Treatment Post Type */
    register_post_type( 'spatreatment',
        array(
            'labels' => array(
                'name' => __( 'Spa Treatments' ),
                'singular_name' => __( 'Spa Treatment' ),
                'add_new' => __( 'Add Spa Treatment' ),
                'add_new_item' => __( 'Add Spa Treatment' ),
                'edit' => __( 'Edit Spa Treatment' ),
                'edit_item' => __( 'Edit Spa Treatment' ),
                'new_item' => __( 'Add New Spa Treatment' ),
                'view' => __( 'View Spa Treatment' ),
                'view_item' => __( 'View This Spa Treatment' ),
                'search_items' => __( 'Search Spa Treatments' ),
                'not_found' => __( 'No Spa Treatment Found' ),
                'not_found_in_trash' => __( 'No Spa Treatments found in Trash' ),
            ),
            'description' => __('Spa Treatments'),
            'public' => true,
            'show_ui' => true, // UI in admin panel
            'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array("slug" => "spa"), // Permalinks format
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'menu_position' => 20,
            'supports' => array( 
            	'title', 'editor'),
            'menu_position' => '1',
            'can_export' => true, 
			'taxonomies' => array('spacategory') // this is IMPORTANT
        )
    );


/* Homepage Slide Post Type */
    register_post_type( 'slide',
        array(
            'labels' => array(
                'name' => __( 'Slideshow' ),
                'singular_name' => __( 'Slide' ),
                'add_new' => __( 'Add Slide' ),
                'add_new_item' => __( 'Add Slide' ),
                'edit' => __( 'Edit Slide' ),
                'edit_item' => __( 'Edit Slide' ),
                'new_item' => __( 'Add New Slide' ),
                'view' => __( 'View Slide' ),
                'view_item' => __( 'View This Slide' ),
                'search_items' => __( 'Search Slides' ),
                'not_found' => __( 'No Slides Found' ),
                'not_found_in_trash' => __( 'No Slides found in Trash' ),
            ),
            'description' => __('Slides'),
            'public' => false,
            'show_ui' => true, // UI in admin panel
            'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array("slug" => "slide"), // Permalinks format
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'menu_position' => 20,
            'supports' => array( 
            	'title', 'thumbnail'),
            'menu_position' => '9',
            'can_export' => true, 
			'taxonomies' => array('') // this is IMPORTANT
        )
    );



}

//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'add_taxonomies', 0 );

//create taxonomy, "Language Categories" for the post type "languages"
function add_taxonomies() 
{


  // Add Spa Treatment Categories Taxonomy
  $labels = array(
    'name' => _x( 'Spa Category', 'taxonomy general name' ),
    'singular_name' => _x( 'Spa Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Spa Categories' ),
    'all_items' => __( 'All Spa Categories' ),
    'parent_item' => __( 'Parent Spa Category' ),
    'parent_item_colon' => __( 'Parent Spa Category:' ),
    'edit_item' => __( 'Edit Spa Category' ), 
    'update_item' => __( 'Update Spa Category' ),
    'add_new_item' => __( 'Add New Spa Category' ),
    'new_item_name' => __( 'New Spa Category Name' ),
    'menu_name' => __( 'Spa Categories' ),
  ); 	

  register_taxonomy('spacategory',array('spacategory'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'spa-category' ),
  ));

}
?>