<?php
add_action( 'init', 'create_post_types_and_taxonomies' );
function create_post_types_and_taxonomies() {


    /* Add Spa Treatments Post Type */
    register_post_type( 'treatment',
        array(
            'labels' => array(
                'name' => __( 'Spa Treatments' ),
                'singular_name' => __( 'Spa Treatment' ),
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
            //'hierarchical' => false,
            'rewrite' => array("slug" => "treatment"), // Permalinks format
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'menu_position' => 20,
            'menu_icon' => 'dashicons-clock',
            'supports' => array(
                'title', 'editor', 'thumbnail', 'excerpt'),
            'menu_position' => '9',
            'can_export' => true,
           // 'taxonomies' => array('treatment_category', 'excerpt') // this is IMPORTANT
        )
    );

    // Spa Treatment Category Taxonomy
    register_taxonomy('treatment_category',array('treatment'), array(
        'hierarchical' => true,
        'labels' => array(
            'name' => __( 'Treatment Categories', 'taxonomy general name' ),
            'singular_name' => __( 'Treatment Category', 'taxonomy singular name' ),
            'search_items' =>  __( 'Search Treatment Categories' ),
            'all_items' => __( 'All Treatment Categories' ),
            'parent_item' => __( 'Parent Treatment Category' ),
            'parent_item_colon' => __( 'Parent Treatment Category:' ),
            'edit_item' => __( 'Edit Treatment Category' ),
            'update_item' => __( 'Update Treatment Category' ),
            'add_new_item' => __( 'Add New Treatment Category' ),
            'new_item_name' => __( 'New Treatment Category Name' ),
            'menu_name' => __( 'Treatment Categories' ),
        ),
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'treatments' ),
    ));
    //register_taxonomy_for_object_type( 'pa_range', 'treatment' );



    /* Add Spa Treatments Post Type */
    register_post_type( 'salon',
        array(
            'labels' => array(
                'name' => __( 'Salon / Spa' ),
                'singular_name' => __( 'Salon / Spa' ),
                'add_new' => __( 'Add Salon / Spa' ),
                'add_new_item' => __( 'Add Salon / Spa' ),
                'edit' => __( 'Edit Salon / Spa' ),
                'edit_item' => __( 'Edit Salon / Spa' ),
                'new_item' => __( 'Add New Salon / Spa' ),
                'view' => __( 'View This Salon / Spa' ),
                'view_item' => __( 'View This Salon / Spa' ),
                'search_items' => __( 'Search Salon / Spa' ),
                'not_found' => __( 'No Salon or Spa Found' ),
                'not_found_in_trash' => __( 'No Salon / Spa found in Trash' ),
            ),
            'description' => __('Salon / Spa'),
            'public' => true,
            'show_ui' => true, // UI in admin panel
            'capability_type' => 'post',
            //'hierarchical' => false,
            'rewrite' => array("slug" => "spa"), // Permalinks format
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'menu_position' => 20,
            'menu_icon' => 'dashicons-clock',
            'supports' => array(
                'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
            'menu_position' => '10',
            'can_export' => true,
           // 'taxonomies' => array('treatment_category', 'excerpt') // this is IMPORTANT
        )
    );

}