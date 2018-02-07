<?php
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {

	// REPEATABLE PRICING FIELDS FOR TREATMENTS
	$group_fields = array(
		array( 
			'id' => 'mbm_treatment_price_format',  
			'name' => 'Format (eg. 20 minutes)', 
			'type' => 'text' ,
			'cols' => 6),

		array( 
			'id' => 'mbm_treatment_price',  
			'name' => 'Price (eg. £50)', 
			'type' => 'text_small' ,
			'cols' => 2),		
	);


	foreach ( $group_fields as &$field ) {
		$field['id'] = str_replace( 'field', 'gfield', $field['id'] );
	}

	$meta_boxes[] = array(
		'title' => 'Pricing',
		'pages' => 'treatment',
		'fields' => array(
			array( 
				'id' => 'mbm_pricing', 
				'name' => 'Set Pricing for this treatment', 
				'type' => 'group', 
				'repeatable' => true,
				'sortable' => true,
				'fields' => $group_fields
			)
		)
	);


	return $meta_boxes;

}
add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
