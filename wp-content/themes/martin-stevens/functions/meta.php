<?php
function cmb_sample_metaboxes( array $meta_boxes ) {
	$prefix = '_cmb_';
	// ADD DFINITIONS HERE - REFERENCE "CMB/example-functions.php"


	// REPEATABLE PARALLAX PAGE SECTIONS - PAGES, PRODUCTS
	$fields = array(
		array( 'id' => $prefix . 'photo', 'name' => 'Photo', 'type' => 'image', 'repeatable' => false, 'show_size' => false, 'cols' => 3 ),
		array( 'id' => $prefix . 'wording',  'name' => 'Wording', 'type' => 'wysiwyg', 'options' => array( 'editor_height' => '200' ), 'repeatable' => false, 'sortable' => false, 'cols' => 9 ),
	);

	$group_fields = $fields;
	foreach ( $group_fields as &$field ) {
		$field['id'] = str_replace( 'field', 'gfield', $field['id'] );
	}

	$meta_boxes[] = array(
		'title' => 'Photos &amp; Wording',
		'pages' => array('project'),
		'fields' => array(
			array( 
				'id' => $prefix . 'project_pics', 
				'name' => '', 
				'type' => 'group', 
				'repeatable' => true,
				'sortable' => true,
				'fields' => $group_fields,
				'desc' => 'Add photos and explanations'
			)
		)
	);


	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
?>