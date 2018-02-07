<?php
/* Add Custom Post Types */
add_action( 'init', 'create_post_type' );

function create_post_type() {

/* SERVICE POST TYPE */
    register_post_type( 'service',
        array(
            'labels' => array(
                'name' => __( 'Services' ),
                'singular_name' => __( 'Service' ),
                'add_new' => __( 'Add Service' ),
                'add_new_item' => __( 'Add Service' ),
                'edit' => __( 'Edit Service' ),
                'edit_item' => __( 'Edit Service' ),
                'new_item' => __( 'Add New Service' ),
                'view' => __( 'View Service on Single Page' ),
                'view_item' => __( 'View this Service on a single page' ),
                'search_items' => __( 'Search Services' ),
                'not_found' => __( 'No Services Found' ),
                'not_found_in_trash' => __( 'No Services found in Trash' ),
            ),
            'description' => __('Services'),
            'public' => true,
            'show_ui' => true, // UI in admin panel
            'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array("slug" => "service"), // Permalinks format
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'menu_position' => 20,
            'supports' => array(
            	'title', 'editor', 'thumbnail'),
            'menu_position' => '9',
            'can_export' => true,
			'taxonomies' => array('servicetype') // this is IMPORTANT
        )
    );



/* PROJECT PORTFOLIO POST TYPE */
    register_post_type( 'project',
        array(
            'labels' => array(
                'name' => __( 'Projects' ),
                'singular_name' => __( 'Project' ),
                'add_new' => __( 'Add Project' ),
                'add_new_item' => __( 'Add Project' ),
                'edit' => __( 'Edit Project' ),
                'edit_item' => __( 'Edit Project' ),
                'new_item' => __( 'Add New Project' ),
                'view' => __( 'View Project on its own Page' ),
                'view_item' => __( 'View this Project on a single page' ),
                'search_items' => __( 'Search Projects' ),
                'not_found' => __( 'No projects Found' ),
                'not_found_in_trash' => __( 'No projects found in Trash' ),
            ),
            'description' => __('projects'),
            'public' => true,
            'show_ui' => true, // UI in admin panel
            'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array("slug" => "project"), // Permalinks format
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'menu_position' => 20,
            'supports' => array(
            	'title', 'editor', 'thumbnail'),
            'menu_position' => '9',
            'can_export' => true,
			'taxonomies' => array() // this is IMPORTANT
        )
    );

    /* BRAND POST TYPE */
    register_post_type( 'brand',
        array(
            'labels' => array(
                'name' => __( 'Brands' ),
                'singular_name' => __( 'Brand' ),
                'add_new' => __( 'Add Brand' ),
                'add_new_item' => __( 'Add Brand' ),
                'edit' => __( 'Edit Brand' ),
                'edit_item' => __( 'Edit Brand' ),
                'new_item' => __( 'Add New Brand' ),
                'view' => __( 'View Brand on its own Page' ),
                'view_item' => __( 'View this Brand on a single page' ),
                'search_items' => __( 'Search Brands' ),
                'not_found' => __( 'No Brands Found' ),
                'not_found_in_trash' => __( 'No Brands found in Trash' ),
            ),
            'description' => __('brands'),
            'public' => true,
            'show_ui' => true, // UI in admin panel
            'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array("slug" => "brand"), // Permalinks format
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'menu_position' => 20,
            'supports' => array(
            	'title', 'thumbnail'),
            'menu_position' => '9',
            'can_export' => true,
			'taxonomies' => array('servicetype') // this is IMPORTANT
        )
    );


    /* TESTIMONIAL POST TYPE */
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
                'view' => __( 'View Testimonial on its own Page' ),
                'view_item' => __( 'View this Testimonial on a single page' ),
                'search_items' => __( 'Search Testimonials' ),
                'not_found' => __( 'No Testimonial Found' ),
                'not_found_in_trash' => __( 'No Testimonial found in Trash' ),
            ),
            'description' => __('testimonials'),
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
            'menu_position' => '9',
            'can_export' => true,
			'taxonomies' => array('') // this is IMPORTANT
        )
    );

/* slide POST TYPE */
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
                'view' => __( 'View Slide on its own Page' ),
                'view_item' => __( 'View this Slide on a single page' ),
                'search_items' => __( 'Search Slides' ),
                'not_found' => __( 'No Slide Found' ),
                'not_found_in_trash' => __( 'No Slide found in Trash' ),
            ),
            'description' => __('slides'),
            'public' => true,
            'show_ui' => true, // UI in admin panel
            'capability_type' => 'post',
            'hierarchical' => false,
            //'rewrite' => array("slug" => "slide"), // Permalinks format
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


    /* document POST TYPE */
/*    register_post_type( 'document',
        array(
            'labels' => array(
                'name' => __( 'Quotes' ),
                'singular_name' => __( 'Quote' ),
                'add_new' => __( 'Add Quote' ),
                'add_new_item' => __( 'Add Quote' ),
                'edit' => __( 'Edit Quote' ),
                'edit_item' => __( 'Edit Quote' ),
                'new_item' => __( 'Add New Quote' ),
                'view' => __( 'View Quote on its own Page' ),
                'view_item' => __( 'View this Quote on a single page' ),
                'search_items' => __( 'Search Quotes' ),
                'not_found' => __( 'No Quote Found' ),
                'not_found_in_trash' => __( 'No Quote found in Trash' ),
            ),
            'description' => __('Quotes'),
            'public' => false,
            'show_ui' => true, // UI in admin panel
            'capability_type' => 'post',
            'hierarchical' => false,
            //'rewrite' => array("slug" => "document"), // Permalinks format
            'publicly_queryable' => true,
            'exclude_from_search' => true,
            'menu_position' => 20,
            'supports' => array(
                'title', 'editor'),
            'menu_position' => '9',
            'can_export' => true,
            'taxonomies' => array('') // this is IMPORTANT
        )
    );*/

}





//SERVICE TYPES TAX
add_action( 'init', 'create_tax_servicetype', 0 );

//create taxonomy, "treatment Categories" for the post type "treatments"
function create_tax_servicetype()
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => _x( 'Service Type', 'taxonomy general name' ),
    'singular_name' => _x( 'Service Type', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search These Service Types' ),
    'all_items' => __( 'All Service Types' ),
    'parent_item' => __( 'Parent Service Type' ),
    'parent_item_colon' => __( 'Parent Service Type' ),
    'edit_item' => __( 'Edit Service Type' ),
    'update_item' => __( 'Update Service Type' ),
    'add_new_item' => __( 'Add New Service Type' ),
    'new_item_name' => __( 'New Service Type Name' ),
    'menu_name' => __( 'Service Types' ),
  );

  register_taxonomy('servicetype',array('servicetype', 'service', 'brand'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'service' ),
  ));

}







?>