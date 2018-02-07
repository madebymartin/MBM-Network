<?php
// PROJECTS META
	$meta_boxes[] = array(
		'id' => 'project_details',
		'title' => 'Project Details',
		'pages' => array('project'), // post type
		'context' => 'normal',
		'priority' => 'default',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
			'name' => 'Date of Project',
			'desc' => '',
			'id' => $prefix . 'projectdate',
			'type' => 'text_date_timestamp',
			),
			array(
			'name' => 'Client Name',
			'desc' => '',
			'id' => $prefix . 'clientname',
			'type' => 'text_medium',
			),
			array(
			'name' => 'Client Location',
			'desc' => '',
			'id' => $prefix . 'clientlocation',
			'type' => 'text_medium',
			),
			array(
			'name' => 'Testimonial',
			'desc' => '',
			'id' => $prefix . 'testimonial',
			'type' => 'textarea',
			),
			array(
				'name'    => 'Services Provided',
				'desc'    => '',
				'id'      => $prefix . 'projectservices',
				'type'    => 'multicheck',
				'options' => array(
					'Boiler breakdown' => 'Boiler breakdown',
					'Boiler Installation' => 'Boiler Installation',
					'Design full plumbing and heating install' => 'Design full plumbing and heating install',
					'Full bathroom install' => 'Full bathroom install',
					'Gas check certificate' => 'Gas check certificate',
					'Heating' => 'Heating',
					'Heating Controls installed and wired in' => 'Heating Controls installed and wired in',
					'Hot and Cold water install' => 'Hot and Cold water install',
					'Landlord certificate' => 'Landlord certificate',
					'Maintenance' => 'Maintenance',
					'Power flush' => 'Power flush',
					'Underfloor heating' => 'Underfloor heating',
					'Unvented Hot Water installation' => 'Unvented Hot Water installation',
					'Water Main' => 'Water Main',
					'Water softener Installed' => 'Water softener Installed',
					'Wet room tray installed' => 'Wet room tray installed',

				),
			),

	),
);


//Quotes
/**
	 * Repeatable Field Groups
	 */
	$meta_boxes['field_group'] = array(
		'id'         => $prefix . 'quote_details',
		'title'      => __( 'Repeating Field Group', 'cmb' ),
		'pages'      => array( 'document', ),
		'fields'     => array(


			array(
				'name' => 'Customer',
				'id'   => $prefix . 'customer_id',
				'type' => 'text',
				// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
			),
			array(
				'name' => 'Customer Name',
				'id'   => $prefix . 'customer_name',
				'type' => 'text',
				// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
			),


			array(
				'id'          => $prefix . 'quote_items',
				'type'        => 'group',
				'description' => __( 'Add each item for the quotation', 'cmb' ),
				'options'     => array(
					'group_title'   => __( 'Item {#}', 'cmb' ), // {#} gets replaced by row number
					'add_button'    => __( 'Add Another Item', 'cmb' ),
					'remove_button' => __( 'Remove Iem', 'cmb' ),
					'sortable'      => true, // beta
				),
				// Fields array works the same, except id's only need to be unique for this group. Prefix is not needed.
				'fields'      => array(
					array(
						'name' => 'Description',
						'description' => 'Write a short description for this item',
						'id'   => $prefix . 'item_description',
						'type' => 'textarea_small',
					),
					array(
						'name' => 'Entry Title',
						'description' => 'Write a short description for this item',
						'id'   => $prefix . 'item_amount',
						'type' => 'text',
						// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
					),
				),
			),

		),
	);




// HOMEPAGE META
	$meta_boxes[] = array(
		'id' => 'promotion',
		'title' => 'Current Promotion',
		'pages' => array('page'), // post type
		'context' => 'normal',
		'priority' => 'default',
		'show_names' => true, // Show field names on the left
		'show_on'    => array( 'key' => 'id', 'value' => array( 4 ), ), // Specific post IDs to display this metabox
		'fields' => array(
	array(
		'name' => 'Promotion Name',
		'desc' => 'Short, descriptove name for promotion',
		'id' => $prefix . 'promo_name',
		'type' => 'text',
		),
	array(
		'name' => 'Promo Details',
		'desc' => 'Protion information (details of special offer etc)',
		'id' => $prefix . 'promo_details',
		'type' => 'wysiwyg',
		),
		array(
				'name' => 'Image',
				'desc' => 'Upload an image or enter an URL.',
				'id'   => $prefix . 'promo_image',
				'type' => 'file',
			),


	),
);


// PAGE FEATURES META
	$meta_boxes[] = array(
		'id' => 'page_features',
		'title' => 'Optional Page Features',
		'pages' => array('page'), // post type
		'context' => 'normal',
		'priority' => 'default',
		'show_names' => true, // Show field names on the left
		'fields' => array(
		array(
			'name' => 'Feature Box 1',
			'desc' => '',
			'id' => $prefix . 'feature1_title',
			'type' => 'title',
			),
		array(
			'name' => 'Feature Title',
			'desc' => '',
			'id' => $prefix . 'feature1_name',
			'type' => 'text',
			),
		array(
			'name' => 'Image',
			'desc' => 'Upload an image or enter an URL.',
			'id'   => $prefix . 'feature1_image',
			'type' => 'file',
		),
		array(
			'name' => 'Feature Content',
			'desc' => '',
			'id' => $prefix . 'feature1_content',
			'type' => 'wysiwyg',
			),

		array(
			'name' => 'Feature Box 2',
			'desc' => '',
			'id' => $prefix . 'feature2_title',
			'type' => 'title',
			),
		array(
			'name' => 'Feature Title',
			'desc' => '',
			'id' => $prefix . 'feature2_name',
			'type' => 'text',
			),
		array(
			'name' => 'Image',
			'desc' => 'Upload an image or enter an URL.',
			'id'   => $prefix . 'feature2_image',
			'type' => 'file',
		),
		array(
			'name' => 'Feature Content',
			'desc' => '',
			'id' => $prefix . 'feature2_content',
			'type' => 'wysiwyg',
			),

		array(
			'name' => 'Feature Box 3',
			'desc' => '',
			'id' => $prefix . 'feature3_title',
			'type' => 'title',
			),
		array(
			'name' => 'Feature Title',
			'desc' => '',
			'id' => $prefix . 'feature3_name',
			'type' => 'text',
			),
		array(
			'name' => 'Image',
			'desc' => 'Upload an image or enter an URL.',
			'id'   => $prefix . 'feature3_image',
			'type' => 'file',
		),
		array(
			'name' => 'Feature Content',
			'desc' => '',
			'id' => $prefix . 'feature3_content',
			'type' => 'wysiwyg',
			),

		array(
			'name' => 'Feature Box 4',
			'desc' => '',
			'id' => $prefix . 'feature4_title',
			'type' => 'title',
			),
		array(
			'name' => 'Feature Title',
			'desc' => '',
			'id' => $prefix . 'feature4_name',
			'type' => 'text',
			),
		array(
			'name' => 'Image',
			'desc' => 'Upload an image or enter an URL.',
			'id'   => $prefix . 'feature4_image',
			'type' => 'file',
		),
		array(
			'name' => 'Feature Content',
			'desc' => '',
			'id' => $prefix . 'feature4_content',
			'type' => 'wysiwyg',
			),

		array(
			'name' => 'Feature Box 5',
			'desc' => '',
			'id' => $prefix . 'feature5_title',
			'type' => 'title',
			),
		array(
			'name' => 'Feature Title',
			'desc' => '',
			'id' => $prefix . 'feature5_name',
			'type' => 'text',
			),
		array(
			'name' => 'Image',
			'desc' => 'Upload an image or enter an URL.',
			'id'   => $prefix . 'feature5_image',
			'type' => 'file',
		),
		array(
			'name' => 'Feature Content',
			'desc' => '',
			'id' => $prefix . 'feature5_content',
			'type' => 'wysiwyg',
			),

		array(
			'name' => 'Feature Box 6',
			'desc' => '',
			'id' => $prefix . 'feature6_title',
			'type' => 'title',
			),
		array(
			'name' => 'Feature Title',
			'desc' => '',
			'id' => $prefix . 'feature6_name',
			'type' => 'text',
			),
		array(
			'name' => 'Image',
			'desc' => 'Upload an image or enter an URL.',
			'id'   => $prefix . 'feature6_image',
			'type' => 'file',
		),
		array(
			'name' => 'Feature Content',
			'desc' => '',
			'id' => $prefix . 'feature6_content',
			'type' => 'wysiwyg',
			),

	),
);




// BRAND META
	$meta_boxes[] = array(
		'id' => 'testimonial_details',
		'title' => 'Testimonial Details',
		'pages' => array('testimonial'), // post type
		'context' => 'normal',
		'priority' => 'default',
		'show_names' => true, // Show field names on the left
		'fields' => array(
	array(
		'name' => 'Person from',
		'desc' => 'appears in brackets next to their name - eg. Martin (Staines)',
		'id' => $prefix . 'testimonial_from',
		'type' => 'text_medium',
		),

	),
);






// BRAND META
	$meta_boxes[] = array(
		'id' => 'brand_details',
		'title' => 'Brand Details',
		'pages' => array('brand'), // post type
		'context' => 'normal',
		'priority' => 'default',
		'show_names' => true, // Show field names on the left
		'fields' => array(
	array(
		'name' => 'Website URL',
		'desc' => 'paste url of brand website (including http://)',
		'id' => $prefix . 'brand_url',
		'type' => 'text',
		),

	),
);
?>