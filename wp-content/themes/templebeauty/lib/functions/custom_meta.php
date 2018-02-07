<?php
// CUSTOM META ---------------------------------------------------------------------------------------------------------


//CONTACT PAGE META
	$meta_boxes[] = array(
		'id'         => 'HOMEPAGEMETA',
		'title'      => 'Contact details',
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'show_on'    => array( 'key' => 'id', 'value' => array( 6 ), ), // Specific post IDs to display this metabox
		'fields' => array(
			array(
				'name' => 'Address 1',
				'desc' => '',
				'id'   => $prefix . 'add1',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Address 2',
				'desc' => '',
				'id'   => $prefix . 'add2',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Town',
				'desc' => '',
				'id'   => $prefix . 'add3',
				'type' => 'text_medium',
			),
			array(
				'name' => 'County',
				'desc' => '',
				'id'   => $prefix . 'add4',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Postcode',
				'desc' => '',
				'id'   => $prefix . 'add5',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Phone Number',
				'desc' => '',
				'id'   => $prefix . 'phone',
				'type' => 'text_medium',
			),

		)
	);
//TREATMENT PAGE META
	$meta_boxes[] = array(
		'id'         => 'HOMEPAGEMETA',
		'title'      => 'Spa Menu Brochure',
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'show_on'    => array( 'key' => 'id', 'value' => array( 24 ), ), // Specific post IDs to display this metabox
		'fields' => array(
			array(
				'name' => 'Brochure PDF',
				'desc' => 'upload the brochure pdf here',
				'id'   => $prefix . 'menudownload',
				'type' => 'file',
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