<?php

add_action( 'init', 'custom_post_type_testimonial');
function custom_post_type_testimonial() { 
	// creating (registering) the custom type 
	register_post_type( 'testimonial', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Testimonials', 'nwg'), /* This is the Title of the Group */
			'singular_name' => __('Testimonial', 'nwg'), /* This is the individual type */
			'all_items' => __('All Testimonials', 'nwg'), /* the all items menu item */
			'add_new' => __('Add New', 'nwg'), /* The add new menu item */
			'add_new_item' => __('Add New Testimonial', 'nwg'), /* Add New Display Title */
			'edit' => __( 'Edit', 'nwg' ), /* Edit Dialog */
			'edit_item' => __('Edit Testimonial', 'nwg'), /* Edit Display Title */
			'new_item' => __('New Testimonial', 'nwg'), /* New Display Title */
			'view_item' => __('View Testimonial', 'nwg'), /* View Display Title */
			'search_items' => __('Search Testimonials', 'nwg'), /* Search Custom Type Title */ 
			'not_found' =>  __('No testimonials found.', 'nwg'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('Nothing found in Trash', 'nwg'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Kind words from happy customers', 'nwg' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => 'dashicons-heart', /* the icon for the custom post type menu. uses built-in dashicons (CSS class name) */
			'rewrite'	=> array( 'slug' => 'testimonial', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'testimonial', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			'supports' => array( 'title', 'editor', 'custom-fields')
	 	) /* end of options */
	); /* end of register post type */
	

	// register_post_type( 'project', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
 // 	// let's now add all the options for this post type
	// 	array('labels' => array(
	// 		'name' => __('Projects', 'nwg'), /* This is the Title of the Group */
	// 		'singular_name' => __('Project', 'nwg'), /* This is the individual type */
	// 		'all_items' => __('All Projects', 'nwg'), /* the all items menu item */
	// 		'add_new' => __('Add New', 'nwg'), /* The add new menu item */
	// 		'add_new_item' => __('Add New Project', 'nwg'), /* Add New Display Title */
	// 		'edit' => __( 'Edit', 'nwg' ), /* Edit Dialog */
	// 		'edit_item' => __('Edit Project', 'nwg'), /* Edit Display Title */
	// 		'new_item' => __('New Project', 'nwg'), /* New Display Title */
	// 		'view_item' => __('View Project', 'nwg'), /* View Display Title */
	// 		'search_items' => __('Search Projects', 'nwg'), /* Search Custom Type Title */ 
	// 		'not_found' =>  __('No projects found.', 'nwg'),  This displays if there are no entries yet  
	// 		'not_found_in_trash' => __('Nothing found in Trash', 'nwg'), /* This displays if there is nothing in the trash */
	// 		'parent_item_colon' => ''
	// 		), /* end of arrays */
	// 		'description' => __( 'Kind words from happy customers', 'nwg' ), /* Custom Type Description */
	// 		'public' => true,
	// 		'publicly_queryable' => true,
	// 		'exclude_from_search' => false,
	// 		'show_ui' => true,
	// 		'query_var' => true,
	// 		'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
	// 		'menu_icon' => 'dashicons-admin-customizer', /* the icon for the custom post type menu. uses built-in dashicons (CSS class name) */
	// 		'rewrite'	=> array( 'slug' => 'project', 'with_front' => false ), /* you can specify its url slug */
	// 		'has_archive' => 'project', /* you can rename the slug here */
	// 		'capability_type' => 'post',
	// 		'hierarchical' => false,
	// 		'supports' => array( 'title', 'editor', 'custom-fields')
	//  	) /* end of options */
	// ); /* end of register post type */

	
	/* this adds your post categories to your custom post type */
	// register_taxonomy_for_object_type('category', 'testimonial');
	/* this adds your post tags to your custom post type */
	// register_taxonomy_for_object_type('post_tag', 'testimonial');
	
} 


	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// // now let's add Services (these act like categories)
 //    register_taxonomy( 'services', 
 //    	array('project'), /* if you change the name of register_post_type( 'testimonial', then you have to change this */
 //    	array('hierarchical' => true,     /* if this is true, it acts like categories */             
 //    		'labels' => array(
 //    			'name' => __( 'Services', 'nwg' ), /* name of the custom taxonomy */
 //    			'singular_name' => __( 'Service', 'nwg' ), /* single taxonomy name */
 //    			'search_items' =>  __( 'Search Services', 'nwg' ), /* search title for taxomony */
 //    			'all_items' => __( 'All Services', 'nwg' ), /* all title for taxonomies */
 //    			'parent_item' => __( 'Parent Service', 'nwg' ), /* parent title for taxonomy */
 //    			'parent_item_colon' => __( 'Parent Service:', 'nwg' ), /* parent taxonomy title */
 //    			'edit_item' => __( 'Edit Service', 'nwg' ), /* edit custom taxonomy title */
 //    			'update_item' => __( 'Update Service', 'nwg' ), /* update title for taxonomy */
 //    			'add_new_item' => __( 'Add New Service', 'nwg' ), /* add new title for taxonomy */
 //    			'new_item_name' => __( 'New Service Name', 'nwg' ) /* name title for taxonomy */
 //    		),
 //    		'show_admin_column' => true, 
 //    		'show_ui' => true,
 //    		'query_var' => true,
 //    		'rewrite' => array( 'slug' => 'service' ),
 //    	)
 //    );   



 	// global $wp_rewrite;
	// $wp_rewrite->init(); //important...
	// $wp_rewrite->flush_rules();
    
	// // now let's add custom tags (these act like categories)
 //    register_taxonomy( 'custom_tag', 
 //    	array('testimonial'), /* if you change the name of register_post_type( 'testimonial', then you have to change this */
 //    	array('hierarchical' => false,    /* if this is false, it acts like tags */                
 //    		'labels' => array(
 //    			'name' => __( 'Custom Tags', 'nwg' ), /* name of the custom taxonomy */
 //    			'singular_name' => __( 'Custom Tag', 'nwg' ), /* single taxonomy name */
 //    			'search_items' =>  __( 'Search Custom Tags', 'nwg' ), /* search title for taxomony */
 //    			'all_items' => __( 'All Custom Tags', 'nwg' ), /* all title for taxonomies */
 //    			'parent_item' => __( 'Parent Custom Tag', 'nwg' ), /* parent title for taxonomy */
 //    			'parent_item_colon' => __( 'Parent Custom Tag:', 'nwg' ), /* parent taxonomy title */
 //    			'edit_item' => __( 'Edit Custom Tag', 'nwg' ), /* edit custom taxonomy title */
 //    			'update_item' => __( 'Update Custom Tag', 'nwg' ), /* update title for taxonomy */
 //    			'add_new_item' => __( 'Add New Custom Tag', 'nwg' ), /* add new title for taxonomy */
 //    			'new_item_name' => __( 'New Custom Tag Name', 'nwg' ) /* name title for taxonomy */
 //    		),
 //    		'show_admin_column' => true,
 //    		'show_ui' => true,
 //    		'query_var' => true,
 //    	)
 //    ); 
    
    /*
    	looking for custom meta boxes?
    	check out this fantastic tool:
    	https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
    */