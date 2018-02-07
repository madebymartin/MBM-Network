<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$meta_boxes['test_metabox'] = array(
		'id'         => 'test_metabox',
		'title'      => __( 'Page settings', 'cmb' ),
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name'    => __( 'Logo Width', 'cmb' ),
				'id'      => $prefix . 'logowidth',
				'type'    => 'select',
				'options' => array(
					'1' => __( 'Tiny', 'cmb' ),
					'2'   => __( 'Medium', 'cmb' ),
					'3'     => __( 'Wide', 'cmb' ),
				),
			),
			array(
				'name'    => __( 'Logo Lower Margin', 'cmb' ),
				'id'      => $prefix . 'margin',
				'type'    => 'select',
				'options' => array(
					'margin-tiny' => __( 'Tiny', 'cmb' ),
					'margin-medium'   => __( 'Medium', 'cmb' ),
					'margin-large'     => __( 'Large', 'cmb' ),
				),
			),
			array(
				'name' => __( 'Add background?', 'cmb' ),
				'desc' => __( 'Adds a transparent black behind the content.', 'cmb' ),
				'id'   => $prefix . 'content_background',
				'type' => 'checkbox',
			),
			array(
				'name' => __( 'Link Address', 'cmb' ),
				'id'   => $prefix . 'url',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Link Text', 'cmb' ),
				'id'   => $prefix . 'buttontext',
				'type' => 'text_medium',
			),
			array(
				'name' => __( 'Background Image', 'cmb' ),
				'desc' => __( 'Upload an image or enter a URL.', 'cmb' ),
				'id'   => $prefix . 'background',
				'type' => 'file',
			),
		),
	);


	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';

}
