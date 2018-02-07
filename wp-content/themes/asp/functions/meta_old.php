<?php
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {

	$prefix = 'mbm_';

	// Example of all available fields

	$fields = array(
		array( 'id' => 'title',  'name' => 'Heading', 'type' => 'text', 'cols' => 4 ),
		array( 'id' => 'nav_item_title',  'name' => 'Nav Link', 'type' => 'text', 'cols' => 4 ),
		array( 'id' => 'background_padding', 'name' => 'Breathing Space', 'type' => 'select', 'options' => array( 'padding-small' => 'Small', 'padding-medium' => 'Medium', 'padding-large' => 'Large', 'padding-huge' => 'Huge'), 'allow_none' => false, 'sortable' => false, 'repeatable' => false, 'cols' => 4 ),
		array( 'id' => 'text_colour', 'name' => 'Text Colour', 'type' => 'select', 'options' => array( 'black' => 'Black', 'white' => 'White', 'grey' => 'Grey'), 'allow_none' => false, 'sortable' => false, 'repeatable' => false, 'default' => '#fff', 'cols' => 4 ),
		array( 'id' => 'text_align', 'name' => 'Text Align', 'type' => 'select', 'options' => array( 'left' => 'Left', 'center' => 'Centre', 'right' => 'Right'), 'allow_none' => false, 'sortable' => false, 'repeatable' => false, 'default' => 'center', 'cols' => 4 ),
		array( 'id' => 'background_type',  'name' => 'Background Type', 'type' => 'radio', 'options' => array( 'parallax' => 'Parallax', 'standard' => 'Standard' ), 'default' => 'parallax', 'cols' => 4),
		
		array( 
		    'id'       => 'link_post_id', 
		    'name'     => 'Page to link to:', 
		    'type'     => 'post_select', 
		    'use_ajax' => true,
		    'query' => array( 
		        'post_type' => array( 'page', 'post' ),
		    ),
		    'allow_none' => true,
		    'cols' => 4
		),

		array( 'id' => 'link_url',  'name' => '.. Or paste URL:', 'type' => 'url', 'cols' => 4 ),
		array( 'id' => 'link_text',  'name' => 'Button Text', 'type' => 'text', 'cols' => 4 ),
		array( 'id' => 'section_background_img', 'name' => 'Background Image', 'type' => 'image', 'repeatable' => false, 'show_size' => false, 'cols' => 3 ),
		array( 'id' => 'section_img', 'name' => 'Section Image', 'type' => 'image', 'repeatable' => false, 'show_size' => false, 'cols' => 3 ),
		array( 'id' => 'animation', 'name' => 'Animation Type', 'type' => 'select', 'options' => array( 'none' => 'None', 'fadeIn' => 'Fade In', 'rotateIn' => 'Rotate In'), 'allow_none' => false, 'sortable' => false, 'repeatable' => false, 'default' => 'none', 'cols' => 3 ),
		array( 'id' => 'section_content',  'name' => 'Section  Content', 'type' => 'wysiwyg', 'options' => array( 'editor_height' => '150' ), 'repeatable' => false, 'sortable' => false, 'cols' => 12 ),
 		//array( 'id' => 'field-3', 'name' => 'Repeatable text input field', 'type' => 'text', 'desc' => 'Add up to 5 fields.', 'repeatable' => true, 'repeatable_max' => 5, 'sortable' => true ),
		//array( 'id' => 'field-4',  'name' => 'Small text input field', 'type' => 'text_small' ),
		//array( 'id' => 'field-7',  'name' => 'Checkbox field', 'type' => 'checkbox' ),
	);



	$group_fields = $fields;
	foreach ( $group_fields as &$field ) {
		$field['id'] = str_replace( 'field', 'gfield', $field['id'] );
	}

	$meta_boxes[] = array(
		'title' => 'Add page sections here',
		'pages' => 'page',
		'fields' => array(
			array(
				'id' => 'mbm_page_sections',
				'name' => '',
				'type' => 'group',
				'repeatable' => true,
				'sortable' => true,
				'fields' => $group_fields,
				'desc' => ''
			),
		)
	);



	$certificate_fields = array(
		array( 'id' => $prefix . 'cert_pdf',  'name' => 'PDF for download', 'type' => 'file', 'repeatable' => false, 'cols' => 4 ),
		array( 'id'   => $prefix . 'cert_img', 'name' => 'Image', 'type' => 'image', 'library-type' => array('image' ), 'repeatable' => false, 'cols' => 4 ),
	);
	$meta_boxes[] = array(
		'title' => 'PDF',
		'pages' => 'certificate',
		'fields' => $certificate_fields
	);



	$team_fields = array(
		array( 'id' => $prefix . 'member_role',  'name' => 'Job role / title', 'type' => 'text', 'repeatable' => false, 'cols' => 6 ),
		array( 'id' => $prefix . 'member_email',  'name' => 'Email address', 'type' => 'text', 'repeatable' => false, 'cols' => 6 ),
		array( 'id' => $prefix . 'member_subtitle',  'name' => 'Member subheading', 'type' => 'text', 'repeatable' => false, 'cols' => 12 ),
		array( 'id' => $prefix . 'member_content',  'name' => 'Description', 'type' => 'wysiwyg', 'options' => array( 'editor_height' => '200' ), 'repeatable' => false, 'sortable' => false, 'cols' => 12 ),
		array( 'id'   => $prefix . 'member_bullets', 'name' => 'Bullet Points', 'type' => 'text', 'library-type' => array('image' ), 'repeatable' => true, 'sortable' => true, 'cols' => 12 ),
	);
	$meta_boxes[] = array(
		'title' => 'Member Details',
		'pages' => 'team_member',
		'fields' => $team_fields
	);





/*
	// Examples of Groups and Columns
	$groups_and_cols = array(
		array( 'id' => 'gac-1',  'name' => 'Text input field', 'type' => 'text', 'cols' => 4 ),
		array( 'id' => 'gac-2',  'name' => 'Text input field', 'type' => 'text', 'cols' => 4 ),
		array( 'id' => 'gac-3',  'name' => 'Text input field', 'type' => 'text', 'cols' => 4 ),
		array( 'id' => 'gac-4', 'name' => 'Group (4 columns)', 'type' => 'group', 'cols' => 4, 'fields' => array(
			array( 'id' => 'gac-4-f-1',  'name' => 'Textarea field', 'type' => 'textarea' )
		) ),
		array( 'id' => 'gac-5', 'name' => 'Group (8 columns)', 'type' => 'group', 'cols' => 8, 'fields' => array(
			array( 'id' => 'gac-4-f-1',  'name' => 'Text input field', 'type' => 'text' ),
			array( 'id' => 'gac-4-f-2',  'name' => 'Text input field', 'type' => 'text' ),
		) ),
	);
	$meta_boxes[] = array(
		'title' => 'Groups and Columns',
		'pages' => 'page',
		'fields' => $groups_and_cols
	);
	*/

	return $meta_boxes;

}
add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
