<?php
function cmb_sample_metaboxes( array $meta_boxes ) {
	$prefix = '_cmb_';
	// ADD DFINITIONS HERE - REFERENCE "CMB/example-functions.php"




	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
?>