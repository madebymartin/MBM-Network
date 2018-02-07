<?php
/* Add Custom Post Types */
add_action( 'init', 'create_post_type' );
 
function create_post_type() {


	/* Hair Treatment Post Type */
    register_post_type( 'hairtreatment',
        array(
            'labels' => array(
                'name' => __( 'Hair Treatments' ),
                'singular_name' => __( 'Hair Treatment' ),
                'add_new' => __( 'Add Hair Treatment' ),
                'add_new_item' => __( 'Add Hair Treatment' ),
                'edit' => __( 'Edit Hair Treatment' ),
                'edit_item' => __( 'Edit Hair Treatment' ),
                'new_item' => __( 'Add New Hair Treatment' ),
                'view' => __( 'View Hair Treatment' ),
                'view_item' => __( 'View This Hair Treatment' ),
                'search_items' => __( 'Search Hair Treatments' ),
                'not_found' => __( 'No Hair Treatment Found' ),
                'not_found_in_trash' => __( 'No Hair Treatments found in Trash' ),
            ),
            'description' => __('Hair Treatments'),
            'public' => true,
            'show_ui' => true, // UI in admin panel
            'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array("slug" => "hair"), // Permalinks format
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'menu_position' => 20,
            'supports' => array( 
            	'title', 'editor', 'thumbnail'),
            'menu_position' => '9',
            'can_export' => true, 
			'taxonomies' => array('hair-category') // this is IMPORTANT
        )
    );


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
            	'title', 'editor', 'thumbnail'),
            'menu_position' => '9',
            'can_export' => true, 
			'taxonomies' => array('spacategory') // this is IMPORTANT
        )
    );


/* Beauty Treatment Post Type */
    register_post_type( 'beautytreatment',
        array(
            'labels' => array(
                'name' => __( 'Beauty Treatments' ),
                'singular_name' => __( 'Beauty Treatment' ),
                'add_new' => __( 'Add Beauty Treatment' ),
                'add_new_item' => __( 'Add Beauty Treatment' ),
                'edit' => __( 'Edit Beauty Treatment' ),
                'edit_item' => __( 'Edit Beauty Treatment' ),
                'new_item' => __( 'Add New Beauty Treatment' ),
                'view' => __( 'View Beauty Treatment' ),
                'view_item' => __( 'View This Beauty Treatment' ),
                'search_items' => __( 'Search Beauty Treatments' ),
                'not_found' => __( 'No Beauty Treatment Found' ),
                'not_found_in_trash' => __( 'No Beauty Treatments found in Trash' ),
            ),
            'description' => __('Beauty Treatments'),
            'public' => true,
            'show_ui' => true, // UI in admin panel
            'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array("slug" => "beauty"), // Permalinks format
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'menu_position' => 20,
            'supports' => array( 
            	'title', 'editor', 'thumbnail'),
            'menu_position' => '9',
            'can_export' => true, 
			'taxonomies' => array('beautycategory') // this is IMPORTANT
        )
    );


/* Beauty Treatment Post Type */
    register_post_type( 'teammember',
        array(
            'labels' => array(
                'name' => __( 'Team Members' ),
                'singular_name' => __( 'Team Member' ),
                'add_new' => __( 'Add Team Member' ),
                'add_new_item' => __( 'Add Team Member' ),
                'edit' => __( 'Edit Team Member' ),
                'edit_item' => __( 'Edit Team Member' ),
                'new_item' => __( 'Add New Team Member' ),
                'view' => __( 'View Team Member' ),
                'view_item' => __( 'View This Team Member' ),
                'search_items' => __( 'Search Team Members' ),
                'not_found' => __( 'No Team Members Found' ),
                'not_found_in_trash' => __( 'No Team Members found in Trash' ),
            ),
            'description' => __('Team Members'),
            'public' => true,
            'show_ui' => true, // UI in admin panel
            'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array("slug" => "team"), // Permalinks format
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'menu_position' => 20,
            'supports' => array( 
            	'title', 'editor', 'thumbnail'),
            'menu_position' => '9',
            'can_export' => true, 
			'taxonomies' => array('') // this is IMPORTANT
        )
    );

/* Homepage Slide Post Type */
    register_post_type( 'slide',
        array(
            'labels' => array(
                'name' => __( 'Slides' ),
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

  // Add Hair Treatment Categories Taxonomy
  $labels = array(
    'name' => _x( 'Hair Category', 'taxonomy general name' ),
    'singular_name' => _x( 'Hair Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Hair Categories' ),
    'all_items' => __( 'All Hair Categories' ),
    'parent_item' => __( 'Parent Hair Category' ),
    'parent_item_colon' => __( 'Parent Hair Category:' ),
    'edit_item' => __( 'Edit Hair Category' ), 
    'update_item' => __( 'Update Hair Category' ),
    'add_new_item' => __( 'Add New Hair Category' ),
    'new_item_name' => __( 'New Hair Category Name' ),
    'menu_name' => __( 'Hair Categories' ),
  ); 	

  register_taxonomy('haircategory',array('hairtreatment'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'hair-category' ),
  ));



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


  // Add Beauty Treatment Categories Taxonomy
  $labels = array(
    'name' => _x( 'Beauty Category', 'taxonomy general name' ),
    'singular_name' => _x( 'Beauty Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Beauty Categories' ),
    'all_items' => __( 'All Beauty Categories' ),
    'parent_item' => __( 'Parent Beauty Category' ),
    'parent_item_colon' => __( 'Parent Beauty Category:' ),
    'edit_item' => __( 'Edit Beauty Category' ), 
    'update_item' => __( 'Update Beauty Category' ),
    'add_new_item' => __( 'Add New Beauty Category' ),
    'new_item_name' => __( 'New Beauty Category Name' ),
    'menu_name' => __( 'Beauty Categories' ),
  ); 	

  register_taxonomy('beautycategory',array('beautycategory'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'beauty-category' ),
  ));





}
?>