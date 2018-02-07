<?php
// CUSTOM META ---------------------------------------------------------------------------------------------------------



	$meta_boxes[] = array(
		'id'         => 'test_metabox',
		'title'      => 'Test Metabox',
		'pages'      => array( '', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'Test Text',
				'desc' => 'field description (optional)',
				'id'   => $prefix . 'test_text',
				'type' => 'text',
			),
			array(
				'name' => 'Test Text Small',
				'desc' => 'field description (optional)',
				'id'   => $prefix . 'test_textsmall',
				'type' => 'text_small',
			),
			array(
				'name' => 'Test Text Medium',
				'desc' => 'field description (optional)',
				'id'   => $prefix . 'test_textmedium',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Test Date Picker',
				'desc' => 'field description (optional)',
				'id'   => $prefix . 'test_textdate',
				'type' => 'text_date',
			),
			array(
				'name' => 'Test Date Picker (UNIX timestamp)',
				'desc' => 'field description (optional)',
				'id'   => $prefix . 'test_textdate_timestamp',
				'type' => 'text_date_timestamp',
			),
			array(
				'name' => 'Test Date/Time Picker Combo (UNIX timestamp)',
				'desc' => 'field description (optional)',
				'id'   => $prefix . 'test_datetime_timestamp',
				'type' => 'text_datetime',
			),
			array(
	            'name' => 'Test Time',
	            'desc' => 'field description (optional)',
	            'id'   => $prefix . 'test_time',
	            'type' => 'text_time',
	        ),
			array(
				'name' => 'Test Money',
				'desc' => 'field description (optional)',
				'id'   => $prefix . 'test_textmoney',
				'type' => 'text_money',
			),
			array(
	            'name' => 'Test Color Picker',
	            'desc' => 'field description (optional)',
	            'id'   => $prefix . 'test_colorpicker',
	            'type' => 'colorpicker',
				'std'  => '#ffffff'
	        ),
			array(
				'name' => 'Test Text Area',
				'desc' => 'field description (optional)',
				'id'   => $prefix . 'test_textarea',
				'type' => 'textarea',
			),
			array(
				'name' => 'Test Text Area Small',
				'desc' => 'field description (optional)',
				'id'   => $prefix . 'test_textareasmall',
				'type' => 'textarea_small',
			),
			array(
				'name' => 'Test Text Area Code',
				'desc' => 'field description (optional)',
				'id'   => $prefix . 'test_textarea_code',
				'type' => 'textarea_code',
			),
			array(
				'name' => 'Test Title Weeeee',
				'desc' => 'This is a title description',
				'id'   => $prefix . 'test_title',
				'type' => 'title',
			),
			array(
				'name'    => 'Test Select',
				'desc'    => 'field description (optional)',
				'id'      => $prefix . 'test_select',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Option One', 'value' => 'standard', ),
					array( 'name' => 'Option Two', 'value' => 'custom', ),
					array( 'name' => 'Option Three', 'value' => 'none', ),
				),
			),
			array(
				'name'    => 'Test Radio inline',
				'desc'    => 'field description (optional)',
				'id'      => $prefix . 'test_radio_inline',
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name' => 'Option One', 'value' => 'standard', ),
					array( 'name' => 'Option Two', 'value' => 'custom', ),
					array( 'name' => 'Option Three', 'value' => 'none', ),
				),
			),
			array(
				'name'    => 'Test Radio',
				'desc'    => 'field description (optional)',
				'id'      => $prefix . 'test_radio',
				'type'    => 'radio',
				'options' => array(
					array( 'name' => 'Option One', 'value' => 'standard', ),
					array( 'name' => 'Option Two', 'value' => 'custom', ),
					array( 'name' => 'Option Three', 'value' => 'none', ),
				),
			),
			array(
				'name'     => 'Test Taxonomy Radio',
				'desc'     => 'Description Goes Here',
				'id'       => $prefix . 'text_taxonomy_radio',
				'type'     => 'taxonomy_radio',
				'taxonomy' => '', // Taxonomy Slug
			),
			array(
				'name'     => 'Test Taxonomy Select',
				'desc'     => 'Description Goes Here',
				'id'       => $prefix . 'text_taxonomy_select',
				'type'     => 'taxonomy_select',
				'taxonomy' => '', // Taxonomy Slug
			),
			array(
				'name' => 'Test Checkbox',
				'desc' => 'field description (optional)',
				'id'   => $prefix . 'test_checkbox',
				'type' => 'checkbox',
			),
			array(
				'name'    => 'Test Multi Checkbox',
				'desc'    => 'field description (optional)',
				'id'      => $prefix . 'test_multicheckbox',
				'type'    => 'multicheck',
				'options' => array(
					'check1' => 'Check One',
					'check2' => 'Check Two',
					'check3' => 'Check Three',
				),
			),
			array(
				'name'    => 'Test wysiwyg',
				'desc'    => 'field description (optional)',
				'id'      => $prefix . 'test_wysiwyg',
				'type'    => 'wysiwyg',
				'options' => array(	'textarea_rows' => 5, ),
			),
			array(
				'name' => 'Test Image',
				'desc' => 'Upload an image or enter an URL.',
				'id'   => $prefix . 'test_image',
				'type' => 'file',
			),
		),
	);


//FONT PAGE META
	$meta_boxes[] = array(
		'id'         => 'HOMEPAGEMETA',
		'title'      => 'Call To Action',
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'show_on'    => array( 'key' => 'id', 'value' => array( 4 ), ), // Specific post IDs to display this metabox
		'fields' => array(
			array(
				'name' => 'Create Call To Action?',
				'desc' => 'tick to create the Call-To-Action section underneath the slider',
				'id'   => $prefix . 'cta_active',
				'type' => 'checkbox',
			),
			array(
				'name' => 'Title',
				'desc' => '',
				'id'   => $prefix . 'cta_title',
				'type' => 'text',
			),
			array(
				'name' => 'Text',
				'desc' => 'A short paragraph about where the button will take you to',
				'id'   => $prefix . 'cta_text',
				'type' => 'textarea_small',
			),
array(
				'name' => 'Button Text',
				'desc' => '',
				'id'   => $prefix . 'cta_button',
				'type' => 'text',
			),
array(
				'name' => 'Link',
				'desc' => '',
				'id'   => $prefix . 'cta_link',
				'type' => 'text',
			),
		)
	);

//TREATMENT SPECIFIC META
	$meta_boxes[] = array(
		'id'         => 'treatmentinfo',
		'title'      => 'Treatment Details',
		'pages'      => array('spatreatment', 'beautytreatment' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Price',
				'desc' => 'Enter price for this hair treatment',
				'id'   => $prefix . 'treatment_price',
				'type' => 'text_money',
			),
			array(
				'name' => 'Treatment Time',
				'desc' => 'Enter the number of minutes if applicable - eg 2 hours = 120',
				'id'   => $prefix . 'treatment_duration',
				'type' => 'text_small',
			),

		)
	);

//HAIR TREATMENT SPECIFIC META
	$meta_boxes[] = array(
		'id'         => 'hairtreatmentinfo',
		'title'      => 'Pricing',
		'pages'      => array( 'hairtreatment' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Salon Director',
				'desc' => 'Enter price for this hair treatment',
				'id'   => $prefix . 'treatment_price_sd',
				'type' => 'text_money',
			),
			array(
				'name' => 'Stylist',
				'desc' => 'Enter price for this hair treatment',
				'id'   => $prefix . 'treatment_price_st',
				'type' => 'text_money',
			),

		)
	);


//TEAM MEMBER SPECIFIC META
	$meta_boxes[] = array(
		'id'         => 'teammemberinfo',
		'title'      => 'Team Member Details',
		'pages'      => array( 'teammember' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Position',
				'desc' => 'Enter the position - eg stylist',
				'id'   => $prefix . 'teammembember_position',
				'type' => 'text',
			),
			array(
				'name' => 'Likes',
				'desc' => '',
				'id'   => $prefix . 'teammembember_likes',
				'type' => 'text',
			),
			array(
				'name' => 'Dislikes',
				'desc' => '',
				'id'   => $prefix . 'teammembember_dislikes',
				'type' => 'text',
			),

		)
	);

//HOMESLIDES SPECIFIC META
	$meta_boxes[] = array(
		'id'         => 'slidemeta',
		'title'      => 'Home Slide Link',
		'pages'      => array( 'slide' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Link',
				'desc' => 'URL of page you want this slide to link to - include http://',
				'id'   => $prefix . 'homeslide_link',
				'type' => 'text',
			),

		)
	);


?>