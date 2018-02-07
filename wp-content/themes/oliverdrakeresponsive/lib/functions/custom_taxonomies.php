<?php
/**
 * Add custom taxonomies
 *
 * Additional custom taxonomies can be defined here
 * http://codex.wordpress.org/Function_Reference/register_taxonomy
 */
function add_custom_taxonomies() {
	// Add new "Treatment Categories" taxonomy to Treatments
	register_taxonomy('treatment_category', 'treatment', array(
		// Hierarchical taxonomy (like Treatment Categories)
		'hierarchical' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => _x( 'Treatment Categories', 'taxonomy general name' ),
			'singular_name' => _x( 'Treatment Category', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Treatment Categories' ),
			'all_items' => __( 'All Treatment Categories' ),
			'parent_item' => __( 'Parent treatment category' ),
			'parent_item_colon' => __( 'Parent treatment category:' ),
			'edit_item' => __( 'Edit treatment category' ),
			'update_item' => __( 'Update treatment category' ),
			'add_new_item' => __( 'Add New treatment category' ),
			'new_item_name' => __( 'New treatment category Name' ),
			'menu_name' => __( 'Treatment Categories' ),
		),
		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'treatment-categories', // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/Treatment Categories/"
			'hierarchical' => true // This will allow URL's like "/Treatment Categories/boston/cambridge/"
		),
	));
	// Add new "Concern" taxonomy to Treatments
	register_taxonomy('concern', 'treatment', array(
		// Hierarchical taxonomy (like Treatment Categories)
		'hierarchical' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => _x( 'Concerns', 'taxonomy general name' ),
			'singular_name' => _x( 'Concern', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Concerns' ),
			'all_items' => __( 'All Concerns' ),
			'parent_item' => __( 'Parent Concern' ),
			'parent_item_colon' => __( 'Parent Concern:' ),
			'edit_item' => __( 'Edit Concern' ),
			'update_item' => __( 'Update Concern' ),
			'add_new_item' => __( 'Add New Concern' ),
			'new_item_name' => __( 'New Concern Name' ),
			'menu_name' => __( 'Concerns' ),
		),
		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'concerns', // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/Treatment Categories/"
			'hierarchical' => true // This will allow URL's like "/Treatment Categories/boston/cambridge/"
		),
	));

}
add_action( 'init', 'add_custom_taxonomies', 0 );
?>