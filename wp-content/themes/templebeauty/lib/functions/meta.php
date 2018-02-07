<?php
// CUSTOM META ----------------------------


//FRONT PAGE META
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

?>