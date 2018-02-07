<?php
/* Add Custom Post Types */
add_action( 'init', 'create_post_type' );
 
function create_post_type() {
    /* Add certificate certificate Post Type */
    register_post_type( 'certificate',
        array(
            'labels' => array(
                'name' => __( 'Certificates' ),
                'singular_name' => __( 'Certificate' ),
                'add_new' => __( 'Add Certificate' ),
                'add_new_item' => __( 'Add Certificate' ),
                'edit' => __( 'Edit Certificate' ),
                'edit_item' => __( 'Edit Certificate' ),
                'new_item' => __( 'Add New Certificate' ),
                'view' => __( 'View Certificate' ),
                'view_item' => __( 'View This Certificate' ),
                'search_items' => __( 'Search Certificate' ),
                'not_found' => __( 'No Certificate Found' ),
                'not_found_in_trash' => __( 'No Certificate found in Trash' ),
            ),
            'menu_icon' => 'dashicons-awards',
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => false,
            'query_var'           => true,

            'description' => __('certificate'),
            'public' => false,
            'show_ui' => true, // UI in admin panel
            'capability_type' => 'post',
            'hierarchical' => true,
            'rewrite' => array("slug" => "certificate"), // Permalinks format
           // 'rewrite' => true,
            'publicly_queryable' => false,
            'exclude_from_search' => true,
            'menu_position' => 20,
            'supports' => array( 'title', 'thumbnail' ),
            'menu_position' => '9',
            'can_export' => true, 
            'taxonomies' => array('certificate_categories') // this is IMPORTANT
        )
    );


    register_post_type( 'team_member',
        array(
            'labels' => array(
                'name' => __( 'The Team' ),
                'singular_name' => __( 'Team Member' ),
                'add_new' => __( 'Add Team Member' ),
                'add_new_item' => __( 'Add Team Member' ),
                'edit' => __( 'Edit Team Member' ),
                'edit_item' => __( 'Edit Team Member' ),
                'new_item' => __( 'Add New Team Member' ),
                'view' => __( 'View Team Member' ),
                'view_item' => __( 'View This Team Member' ),
                'search_items' => __( 'Search Team Member' ),
                'not_found' => __( 'No Team Member Found' ),
                'not_found_in_trash' => __( 'No Team Member found in Trash' ),
            ),
            'menu_icon' => 'dashicons-groups',
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => false,
            'query_var'           => true,

            'description' => __('team'),
            'public' => false,
            'show_ui' => true, // UI in admin panel
            'capability_type' => 'post',
            'hierarchical' => true,
            'rewrite' => array("slug" => "team"), // Permalinks format
           // 'rewrite' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'menu_position' => 20,
            'supports' => array( 'title', 'thumbnail' ),
            'menu_position' => '9',
            'can_export' => true, 
            //'taxonomies' => array('certificate_categories') // this is IMPORTANT
        )
    );



    register_post_type( 'hse_download',
        array(
            'labels' => array(
                'name' => __( 'HSE Downloads' ),
                'singular_name' => __( 'HSE Download' ),
                'add_new' => __( 'Add HSE Download' ),
                'add_new_item' => __( 'Add HSE Download' ),
                'edit' => __( 'Edit HSE Download' ),
                'edit_item' => __( 'Edit HSE Download' ),
                'new_item' => __( 'Add New HSE Download' ),
                'view' => __( 'View HSE Download' ),
                'view_item' => __( 'View This HSE Download' ),
                'search_items' => __( 'Search HSE Download' ),
                'not_found' => __( 'No HSE Download Found' ),
                'not_found_in_trash' => __( 'No HSE Download found in Trash' ),
            ),
            'menu_icon' => 'dashicons-download',
            'show_in_admin_bar'   => false,
            'show_in_nav_menus'   => false,
            'query_var'           => true,
            'description' => __('hse_download'),
            'public' => false,
            'show_ui' => true, // UI in admin panel
            'capability_type' => 'post',
            'hierarchical' => true,
            'rewrite' => array("slug" => "download"), // Permalinks format
           // 'rewrite' => true,
            'publicly_queryable' => false,
            'exclude_from_search' => true,
            'menu_position' => 30,
            'supports' => array( 'title', 'thumbnail' ),
            'menu_position' => '9',
            'can_export' => true, 
        )
    );





/*
    //certificate certificate taxonomy
    $labels_certificatecats = array(
        'name' => __( 'certificate Type', 'taxonomy general name' ),
        'singular_name' => __( 'certificate Type', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search certificate Types' ),
        'all_items' => __( 'All certificate Types' ),
        'parent_item' => __( 'Parent certificate Type' ),
        'parent_item_colon' => __( 'Parent certificate Type:' ),
        'edit_item' => __( 'Edit certificate Type' ),
        'update_item' => __( 'Update certificate Type' ),
        'add_new_item' => __( 'Add New certificate Type' ),
        'new_item_name' => __( 'New certificate Type' ),
        'menu_name' => __( 'certificate Types' ),
    );
        register_taxonomy('certificate_categories',array('certificate'), array(
        'hierarchical' => true,
        'labels' => $labels_certificatecats,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'certificate-support' ),
    ));
    register_taxonomy_for_object_type( 'certificate_categories', 'certificate' );
    */
}
?>