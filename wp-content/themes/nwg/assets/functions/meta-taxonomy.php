<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB Taxonomy directory)
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jcchavezs/cmb2-taxonomy
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */
if ( !file_exists(  dirname(__FILE__) .'/cmb2-taxonomy/init.php' ) ) {
	exit;
}

require_once  dirname(__FILE__) .'/cmb2-taxonomy/init.php';

add_filter('cmb2-taxonomy_meta_boxes', 'cmb2_taxonomy_sample_metaboxes');

/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb2_taxonomy_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'mbm_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$meta_boxes['test_metabox'] = array(
		'id'            => 'test_metabox',
		'title'         => __( 'Slideshow', 'cmb2' ),
		'object_types'  => array( 'services', ), // Taxonomy
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		'fields'        => array(
			array(
				'name'         => __( 'Slideshow Images', 'cmb2' ),
				'desc'         => __( 'Set a single image or multiples for a slideshow.', 'cmb2' ),
				'id'           => $prefix . 'slides',
				'type'         => 'file_list',
				'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
			),
		),
	);

	return $meta_boxes;
}
