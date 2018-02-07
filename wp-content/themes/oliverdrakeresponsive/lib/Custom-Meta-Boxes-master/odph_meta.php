<?php
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {

	$prefix = '_cmb_';

	// Example of all available fields

	$fields = array(
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
	);

	$meta_boxes[] = array(
		'id' => 'project_details',
		'title' => 'Project Details',
		'pages' => array('project'), // post type
		'context' => 'normal',
		'priority' => 'default',
		'show_names' => true, // Show field names on the left
		'fields' => $fields
	);

	return $meta_boxes;

}
add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
