<?php
function cmb_sample_metaboxes( array $meta_boxes ) {
	$prefix = '_cmb_';
	// ADD DFINITIONS HERE - REFERENCE "CMB/example-functions.php"

	$page_fields = array(
		array( 
			'id' => $prefix . 'slide_image', 
			'name' => 'Slide Image', 
			'type' => 'image', 
			'repeatable' => true,
			'size' => 'height=280&width=1000&crop=1',
			'show_size' => true ),
	);
	$meta_boxes[] = array(
		'title' => 'Slideshow Images',
		'pages' => 'page',
		'fields' => $page_fields
	);


	$sidebar_pics = array(
	array( 
		'id' => $prefix . 'sidebar_pics', 
		'name' => 'Slide Image', 
		'type' => 'image', 
		'repeatable' => true,
		//'size' => 'height=280&width=1000&crop=1',
		//'show_size' => true, 
		),
	);
	$meta_boxes[] = array(
		'title' => 'Sidebar Images',
		'pages' => 'page',
		'fields' => $sidebar_pics
	);



$homepage_features = array(
	array( 
		'id' => $prefix . 'feature1_title',  
		'name' => 'Feature 1', 
		'type' => 'title' 
		),
	array( 
		'id' => $prefix . 'feature1_heading', 
		'name' => 'Feature 1 Heading', 
		'type' => 'text',
		'cols' => 4,
		'desc' => 'Add a heading'
		),
	array( 
		'id' => $prefix . 'feature1_link_text',   
		'name' => 'Feature 1 Button Text', 
		'type' => 'text',
		'cols' => 4,
		'desc' => 'Appears on button'
		),
	array( 
		'id' => $prefix . 'feature1_linked_page',
		'name' => 'Feature 1 Linked page', 
		'type' => 'post_select', 
		'use_ajax' => true, 
		'query' => array(
		'post_type' => 'page', 
			'posts_per_page' => 8
			), 
		'multiple' => false,
		'cols' => 4,
		'desc' => 'Page that the button links to'
		),
	array( 
		'id' => $prefix . 'feature1_wording',   
		'name' => 'Feature 1 Wording', 
		'type' => 'textarea',
		'cols' => 8, 
		),
	array( 
		'id' => $prefix . 'feature1_image', 
		'name' => 'Feature 1 Image', 
		'type' => 'image', 
		'repeatable' => false,
		'size' => 'height=600&width=600&crop=0', 
		'show_size' => true,
		),



	array( 
		'id' => $prefix . 'feature2_title',  
		'name' => 'Feature 2', 
		'type' => 'title' 
		),
	array( 
		'id' => $prefix . 'feature2_heading', 
		'name' => 'Feature 2 Heading', 
		'type' => 'text',
		'cols' => 4,
		'desc' => 'Add a heading'
		),
	array( 
		'id' => $prefix . 'feature2_link_text',   
		'name' => 'Feature 2 Button Text', 
		'type' => 'text',
		'cols' => 4,
		'desc' => 'Appears on button'
		),
	array( 
		'id' => $prefix . 'feature2_linked_page',
		'name' => 'Feature 2 Linked page', 
		'type' => 'post_select', 
		'use_ajax' => true, 
		'query' => array(
		'post_type' => 'page', 
			'posts_per_page' => 8
			), 
		'multiple' => false,
		'cols' => 4,
		'desc' => 'Page that the button links to'
		),
	array( 
		'id' => $prefix . 'feature2_wording',   
		'name' => 'Feature 2 Wording', 
		'type' => 'textarea',
		'cols' => 8, 
		),
	array( 
		'id' => $prefix . 'feature2_image', 
		'name' => 'Feature 2Image', 
		'type' => 'image', 
		'repeatable' => false,
		'size' => 'height=600&width=600&crop=0', 
		'show_size' => true,
		),


	array( 
		'id' => $prefix . 'feature3_title',  
		'name' => 'Feature 3', 
		'type' => 'title' 
		),
	array( 
		'id' => $prefix . 'feature3_heading', 
		'name' => 'Feature 3 Heading', 
		'type' => 'text',
		'cols' => 4,
		'desc' => 'Add a heading'
		),
	array( 
		'id' => $prefix . 'feature3_link_text',   
		'name' => 'Feature 3 Button Text', 
		'type' => 'text',
		'cols' => 4,
		'desc' => 'Appears on button'
		),
	array( 
		'id' => $prefix . 'feature3_linked_page',
		'name' => 'Feature 3 Linked page', 
		'type' => 'post_select', 
		'use_ajax' => true, 
		'query' => array(
		'post_type' => 'page', 
			'posts_per_page' => 8
			), 
		'multiple' => false,
		'cols' => 4,
		'desc' => 'Page that the button links to'
		),
	array( 
		'id' => $prefix . 'feature3_wording',   
		'name' => 'Feature 3 Wording', 
		'type' => 'textarea',
		'cols' => 8, 
		),
	array( 
		'id' => $prefix . 'feature3_image', 
		'name' => 'Feature 3 Image', 
		'type' => 'image', 
		'repeatable' => false,
		'size' => 'height=600&width=600&crop=0', 
		'show_size' => true,
		),
);


	$meta_boxes[] = array(
		'title' => 'Homepage Features',
		'pages' => 'page',
		'show_on' => array( 'id' => array( 4 ) ),
		'fields' => $homepage_features
	);








	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
?>