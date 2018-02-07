<?php

/* ADD CUSTOM POST TYPE */
add_action( 'init', 'create_post_types' );
function create_post_types() {

    register_post_type( 'testimonial',
        array(
            'labels' => array(
                'name' => __( 'Praise' ),
                'singular_name' => __( 'Praise' ),
                'add_new' => __( 'Add Praise' ),
                'add_new_item' => __( 'Add Praise' ),
                'edit' => __( 'Edit Praise' ),
                'edit_item' => __( 'Edit Praise' ),
                'new_item' => __( 'Add New Praise' ),
                'view' => __( 'View This Praise' ),
                'view_item' => __( 'View This Praise' ),
                'search_items' => __( 'Search Praise' ),
                'not_found' => __( 'No Praise Found' ),
                'not_found_in_trash' => __( 'No Praise found in Trash' ),
            ),
            'description' => __('Praise'),
            'public' => true,
            'show_ui' => true, // UI in admin panel
            'capability_type' => 'post',
            'hierarchical' => false,
            'rewrite' => array("slug" => "Praise"), // Permalinks format
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'supports' => array(
                'title', 'editor', 'custom-fields'),
            'menu_position' => '10',
            'menu_icon' => 'dashicons-thumbs-up',
            'can_export' => true,
            // 'taxonomies' => array('Praise_category', 'excerpt') // this is IMPORTANT
        )
    );
    // flush_rewrite_rules();
}
?>