<?php

/* Add Custom Post Types */
add_action( 'init', 'create_post_type' );
 
function create_post_type() {
	/* Add Spa Treatments Post Type */
    register_post_type( 'treatments',
        array(
            'labels' => array(
                'name' => __( 'Spa Treatments' ),
                'singular_name' => __( 'Treatment' ),
                'add_new' => __( 'Add Spa Treatment' ),
                'add_new_item' => __( 'Add Spa Treatment' ),
                'edit' => __( 'Edit Treatment' ),
                'edit_item' => __( 'Edit Treatment' ),
                'new_item' => __( 'Add New Spa Treatment' ),
                'view' => __( 'View This Treatment' ),
                'view_item' => __( 'View This Treatment' ),
                'search_items' => __( 'Search Spa Treatments' ),
                'not_found' => __( 'No Treatment Found' ),
                'not_found_in_trash' => __( 'No Treatment found in Trash' ),
            ),
            'description' => __('Spa Treatments'),
            'public' => true,
            'show_ui' => true, // UI in admin panel
            'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array("slug" => "treatments"), // Permalinks format
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'menu_position' => 20,
            'supports' => array( 
            	'title', 'editor'),
            'menu_position' => '5',
            'can_export' => true
        )
    );
    /* Add Spa Packages Post Type */
    register_post_type( 'packages',
        array(
            'labels' => array(
                'name' => __( 'Spa Packages' ),
                'singular_name' => __( 'Package' ),
                'add_new' => __( 'Add Spa Package' ),
                'add_new_item' => __( 'Add Spa Package' ),
                'edit' => __( 'Edit Package' ),
                'edit_item' => __( 'Edit Package' ),
                'new_item' => __( 'Add New Spa Package' ),
                'view' => __( 'View This Package' ),
                'view_item' => __( 'View This Package' ),
                'search_items' => __( 'Search Spa Packages' ),
                'not_found' => __( 'No Package Found' ),
                'not_found_in_trash' => __( 'No Package found in Trash' ),
            ),
            'description' => __('Spa Packages'),
            'public' => true,
            'show_ui' => true, // UI in admin panel
            'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array("slug" => "packages"), // Permalinks format
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'menu_position' => 20,
            'supports' => array( 
            	'title', 'editor'),
            'menu_position' => '7',
            'can_export' => true
        )
    );
	
	/* Add Spa Brands Post Type */
    register_post_type( 'spabrands',
        array(
            'labels' => array(
                'name' => __( 'Spa Brands' ),
                'singular_name' => __( 'Spa Brand' ),
                'add_new' => __( 'Add Spa Brand' ),
                'add_new_item' => __( 'Add Spa Brand' ),
                'edit' => __( 'Edit Brand' ),
                'edit_item' => __( 'Edit Brand' ),
                'new_item' => __( 'Add New Spa Brand' ),
                'view' => __( 'View This Spa Brand' ),
                'view_item' => __( 'View This Spa Brand' ),
                'search_items' => __( 'Search Spa Brand' ),
                'not_found' => __( 'No Spa Brand Found' ),
                'not_found_in_trash' => __( 'No Spa Brand found in Trash' ),
            ),
            'description' => __('Spa Brands'),
            'public' => true,
            'show_ui' => true, // UI in admin panel
            'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array("slug" => "spabrands"), // Permalinks format
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'menu_position' => 20,
            'supports' => array( 
            	'title', 'thumbnail', 'editor'),
            'menu_position' => '8',
            'can_export' => true
        )
    );

}
?>