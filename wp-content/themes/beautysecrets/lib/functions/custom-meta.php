<?php
// CUSTOM META ---------------------------------------------------------------------------------------------------------

// Packages Meta
	$meta_boxes[] = array(
		'id' => 'package-details',
		'title' => 'Package Details',
		'pages' => array('packages'), // post type
		'context' => 'advanced',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
			'name' => 'Full Day Price (£)',
			'desc' => 'Enter the price of the Full-Day Package (Leave out the £)',
			'id' => $prefix . 'fulldayprice',
			'type' => 'text'
			),
			array(
				'name' => 'Half Day Price (£)',
				'desc' => 'Enter the price of the Half-Day Package (Leave out the £)',
				'id' => $prefix . 'halfdayprice',
				'type' => 'text'
			),
			array(
            'name' => 'Featured Package?',
            'desc' => 'select if you wish this Package to appear on the Packages of the Month page',
            'id' => $prefix . 'packageofthemonth',
            'type' => 'checkbox',
            'std' => ''
        ),
	),
);


// Availability Box
$meta_boxes[] = array(
    'id' => 'availability',
    'title' => 'Available at',
    'pages' => array('treatments', 'packages', 'spabrands'),
	'context' => 'advanced',
	'priority' => 'high',
	'show_names' => true, // Show field names on the left

    'fields' => array(
        array(
            'name' => 'Horsham',
            'id' => $prefix . 'horsham',
            'type' => 'checkbox'
        ),
        array(
            'name' => 'Godalming',
            'id' => $prefix . 'godalming',
            'type' => 'checkbox'
        ),
        array(
            'name' => 'Hove',
            'id' => $prefix . 'hove',
            'type' => 'checkbox'
        )
    )
);




// Treatment Details
$meta_boxes[] = array(
    'id' => 'treatment-details',                            // meta box id, unique per meta box
    'title' => 'Treatment Details',            				// meta box title
    'pages' => array('treatments'),    						// post types, accept custom post types as well, default is array('post'); optional
	'context' => 'advanced',
	'priority' => 'high',
	'show_names' => true, // Show field names on the left

    'fields' => array(
		array(
            'name' => 'Price',
            'desc' => '',
            'id' => $prefix . 'treatmentprice',
            'type' => 'text',
            'std' => ''
        ),
        array(
            'name' => 'Duration',
            'desc' => '',
            'id' => $prefix . 'treatmentduration',
            'type' => 'text',
            'std' => ''
        ),
    )
);


// Footer Links
$meta_boxes[] = array(
    'id' => 'footer-links',                            // meta box id, unique per meta box
    'title' => 'Footer Link',            				// meta box title
    'pages' => array('page'),    						// post types, accept custom post types as well, default is array('post'); optional
	'context' => 'advanced',
	'priority' => 'high',
	'show_names' => true, // Show field names on the left
	'show_on'    => array( 'key' => 'id', 'value' => array( 203, 477, 251, 249 ), ), // Specific post IDs to display this metabox

    'fields' => array(
		array(
            'name' => 'Caption',
            'desc' => '',
            'id' => $prefix . 'caption',
            'type' => 'wysiwyg',
            'std' => ''
        ),
    )
);


?>