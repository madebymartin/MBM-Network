<?php
/** CUSTOM META ----------------------------------------------------*/

// TREATMENTS META
$meta_boxes[] = array(
		'id'         => 'treatment_details',
		'title'      => 'Treatment Details',
		'pages'      => array( 'treatments' ), // Post type
		'context'    => 'normal',
		'priority'   => 'core',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'Subtitle',
				'desc' => 'enter a subtitle or leave this blank',
				'id'   => $prefix . 'treatment_subtitle',
				'type' => 'text',
			),array(
				'name' => 'Price',
				'desc' => 'how much does this treatment cost the client? - Leave out the £ sign',
				'id'   => $prefix . 'treatment_price',
				'type' => 'text_small',
			),
			array(
				'name'    => 'Price fixed or from',
				'desc'    => 'is the price a starting price or fixed price?',
				'id'      => $prefix . 'treatment_price_from',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Fixed Price', 'value' => 'fixed_price', ),
					array( 'name' => 'Starting Price', 'value' => 'starting_price', ),
				),
			),
			array(
				'name' => 'Duration',
				'desc' => 'how long does this treatment last? - Enter number of minutes',
				'id'   => $prefix . 'treatment_duration',
				'type' => 'text_small',
			),
			array(
				'name' => 'Signature Treatment?',
				'desc' => 'tick if this is a Frothimoon signature treatment',
				'id'   => $prefix . 'treatment_signature',
				'type' => 'checkbox',
			),			
		),
	);

// BROCHURE PDF META
$meta_boxes[] = array(
		'id'         => 'recommendations',
		'title'      => 'Recommendation Details',
		'pages'      => array( 'recommendations', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			
			array(
				'name' => 'Phone Number',
				'desc' => 'enter the telephone number of this recommendation',
				'id'   => $prefix . 'recommendation_phone',
				'type' => 'text',
			),array(
				'name' => 'Website',
				'desc' => 'enter the web address of this recommendation (make sure you DONT include http://)',
				'id'   => $prefix . 'recommendation_url',
				'type' => 'text',
			),
						
		),
	);

// BROCHURE PDF META
$meta_boxes[] = array(
		'id'         => 'brochure',
		'title'      => 'Brochure PDF',
		'pages'      => array( 'page', ), // Post type
'show_on' => array( 'key' => 'id', 'value' => array( 2, ) ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'Brochure',
				'desc' => 'upload the latest brochure here so it can be downloaded by visiters',
				'id'   => $prefix . 'brochure',
				'type' => 'file',
			),
						
		),
	);

// CONTACT US META
$meta_boxes[] = array(
		'id'         => 'contact',
		'title'      => 'Frothimoon Contact Details',
		'pages'      => array( 'page', ), // Post type
'show_on' => array( 'key' => 'id', 'value' => array( 33, ) ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'Phone Number',
				'desc' => '',
				'id'   => $prefix . 'salonphone',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Address Line 1',
				'desc' => '',
				'id'   => $prefix . 'salonaddress1',
				'type' => 'text',
			),
			array(
				'name' => 'Address Line 2',
				'desc' => '',
				'id'   => $prefix . 'salonaddress2',
				'type' => 'text',
			),
			array(
				'name' => 'Town',
				'desc' => '',
				'id'   => $prefix . 'salontown',
				'type' => 'text',
			),
			array(
				'name' => 'County',
				'desc' => '',
				'id'   => $prefix . 'saloncounty',
				'type' => 'text',
			),
			array(
				'name' => 'Postcode',
				'desc' => '',
				'id'   => $prefix . 'salonpostcode',
				'type' => 'text',
			),
						
		),
	);



?>