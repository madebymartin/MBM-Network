<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'kylawilliams_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */



/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 *
 * @param  CMB2 object $cmb CMB2 object
 *
 * @return bool             True if metabox should show
 */
function kylawilliams_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's not the front page template
	if ( $cmb->object_id !== get_option( 'page_on_front' ) ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field object $field Field object
 *
 * @return bool                     True if metabox should show
 */
function kylawilliams_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a message if the $post_id is 2
 *
 * @param  array             $field_args Array of field parameters
 * @param  CMB2_Field object $field      Field object
 */
function kylawilliams_before_row_if_2( $field_args, $field ) {
	if ( 2 == $field->object_id ) {
		echo '<p>Testing <b>"before_row"</b> parameter (on $post_id 2)</p>';
	} else {
		echo '<p>Testing <b>"before_row"</b> parameter (<b>NOT</b> on $post_id 2)</p>';
	}
}







add_action( 'cmb2_admin_init', 'kylawilliams_register_demo_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function kylawilliams_register_demo_metabox() {
	$prefix = 'mbm_';

	if ( class_exists( 'WooCommerce' ) ) {
		/**
		 * Sample metabox to demonstrate each field type included
		 */
		$product_cmb = new_cmb2_box( array(
			'id'            => $prefix . 'options',
			'title'         => __( 'Options', 'cmb2' ),
			'object_types'  => array( 'product', ), // Post type
			// 'show_on_cb' => 'kylawilliams_show_if_front_page', // function should return a bool value
			 'context'    => 'side',
			// 'priority'   => 'high',
			// 'show_names' => true, // Show field names on the left
			// 'cmb_styles' => false, // false to disable the CMB stylesheet
			// 'closed'     => true, // true to keep the metabox closed by default
		) );

		$product_cmb->add_field( array(
			'name'             => __( 'Show Image', 'cmb2' ),
			// 'desc'             => __( 'field description (optional)', 'cmb2' ),
			'id'               => $prefix . 'showimage',
			'type'             => 'checkbox',
		) );

		$product_cat_ids = $terms = get_terms( array(
		    'taxonomy' => 'product_cat',
		    'hide_empty' => false,
		    'fields'	=> 'ids'
		) );
		$options = array();
		foreach ($product_cat_ids as $key => $id) {
			$term = get_term_by('id', $id, 'product_cat');
			$options[$id] = $term->name;
		}
		$testimonial_cmb = new_cmb2_box( array(
			'id'            => $prefix . 'testimonial_for',
			'title'         => __( 'Praise for:', 'cmb2' ),
			'object_types'  => array( 'testimonial', ), // Post type
			 'context'    => 'side',
		) );
		$testimonial_cmb->add_field( array(
			// 'name'    => esc_html__( 'Test Multi Checkbox', 'cmb2' ),
			// 'desc'    => esc_html__( 'field description (optional)', 'cmb2' ),
			'id'      => $prefix . 'praise_for',
			'type'    => 'multicheck',
			'options' => $options,
		) );
	}
	
}












// add_action( 'cmb2_admin_init', 'kylawilliams_register_repeatable_group_field_metabox' );
// /**
//  * Hook in and add a metabox to demonstrate repeatable grouped fields
//  */
// function kylawilliams_register_repeatable_group_field_metabox() {
// 	$prefix = 'kylawilliams_group_';

// 	/**
// 	 * Repeatable Field Groups
// 	 */
// 	$cmb_group = new_cmb2_box( array(
// 		'id'           => $prefix . 'metabox',
// 		'title'        => __( 'Repeating Field Group', 'cmb2' ),
// 		'object_types' => array( 'page', ),
// 	) );

// 	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
// 	$group_field_id = $cmb_group->add_field( array(
// 		'id'          => $prefix . 'demo',
// 		'type'        => 'group',
// 		'description' => __( 'Generates reusable form entries', 'cmb2' ),
// 		'options'     => array(
// 			'group_title'   => __( 'Entry {#}', 'cmb2' ), // {#} gets replaced by row number
// 			'add_button'    => __( 'Add Another Entry', 'cmb2' ),
// 			'remove_button' => __( 'Remove Entry', 'cmb2' ),
// 			'sortable'      => true, // beta
// 			// 'closed'     => true, // true to have the groups closed by default
// 		),
// 	) );

// 	/**
// 	 * Group fields works the same, except ids only need
// 	 * to be unique to the group. Prefix is not needed.
// 	 *
// 	 * The parent field's id needs to be passed as the first argument.
// 	 */
// 	$cmb_group->add_group_field( $group_field_id, array(
// 		'name'       => __( 'Entry Title', 'cmb2' ),
// 		'id'         => 'title',
// 		'type'       => 'text',
// 		// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
// 	) );

// 	$cmb_group->add_group_field( $group_field_id, array(
// 		'name'        => __( 'Description', 'cmb2' ),
// 		'description' => __( 'Write a short description for this entry', 'cmb2' ),
// 		'id'          => 'description',
// 		'type'        => 'textarea_small',
// 	) );

// 	$cmb_group->add_group_field( $group_field_id, array(
// 		'name' => __( 'Entry Image', 'cmb2' ),
// 		'id'   => 'image',
// 		'type' => 'file',
// 	) );

// 	$cmb_group->add_group_field( $group_field_id, array(
// 		'name' => __( 'Image Caption', 'cmb2' ),
// 		'id'   => 'image_caption',
// 		'type' => 'text',
// 	) );

// }

// add_action( 'cmb2_admin_init', 'kylawilliams_register_user_profile_metabox' );
// /**
//  * Hook in and add a metabox to add fields to the user profile pages
//  */
// function kylawilliams_register_user_profile_metabox() {
// 	$prefix = 'kylawilliams_user_';

// 	/**
// 	 * Metabox for the user profile screen
// 	 */
// 	$cmb_user = new_cmb2_box( array(
// 		'id'               => $prefix . 'edit',
// 		'title'            => __( 'User Profile Metabox', 'cmb2' ), // Doesn't output for user boxes
// 		'object_types'     => array( 'user' ), // Tells CMB2 to use user_meta vs post_meta
// 		'show_names'       => true,
// 		'new_user_section' => 'add-new-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
// 	) );

// 	$cmb_user->add_field( array(
// 		'name'     => __( 'Extra Info', 'cmb2' ),
// 		'desc'     => __( 'field description (optional)', 'cmb2' ),
// 		'id'       => $prefix . 'extra_info',
// 		'type'     => 'title',
// 		'on_front' => false,
// 	) );

// 	$cmb_user->add_field( array(
// 		'name'    => __( 'Avatar', 'cmb2' ),
// 		'desc'    => __( 'field description (optional)', 'cmb2' ),
// 		'id'      => $prefix . 'avatar',
// 		'type'    => 'file',
// 	) );

// 	$cmb_user->add_field( array(
// 		'name' => __( 'Facebook URL', 'cmb2' ),
// 		'desc' => __( 'field description (optional)', 'cmb2' ),
// 		'id'   => $prefix . 'facebookurl',
// 		'type' => 'text_url',
// 	) );

// 	$cmb_user->add_field( array(
// 		'name' => __( 'Twitter URL', 'cmb2' ),
// 		'desc' => __( 'field description (optional)', 'cmb2' ),
// 		'id'   => $prefix . 'twitterurl',
// 		'type' => 'text_url',
// 	) );

// 	$cmb_user->add_field( array(
// 		'name' => __( 'Google+ URL', 'cmb2' ),
// 		'desc' => __( 'field description (optional)', 'cmb2' ),
// 		'id'   => $prefix . 'googleplusurl',
// 		'type' => 'text_url',
// 	) );

// 	$cmb_user->add_field( array(
// 		'name' => __( 'Linkedin URL', 'cmb2' ),
// 		'desc' => __( 'field description (optional)', 'cmb2' ),
// 		'id'   => $prefix . 'linkedinurl',
// 		'type' => 'text_url',
// 	) );

// 	$cmb_user->add_field( array(
// 		'name' => __( 'User Field', 'cmb2' ),
// 		'desc' => __( 'field description (optional)', 'cmb2' ),
// 		'id'   => $prefix . 'user_text_field',
// 		'type' => 'text',
// 	) );

// }

// add_action( 'cmb2_admin_init', 'kylawilliams_register_taxonomy_metabox' );
// /**
//  * Hook in and add a metabox to add fields to taxonomy terms
//  */
// function kylawilliams_register_taxonomy_metabox() {
// 	$prefix = 'kylawilliams_term_';

// 	/**
// 	 * Metabox to add fields to categories and tags
// 	 */
// 	$cmb_term = new_cmb2_box( array(
// 		'id'               => $prefix . 'edit',
// 		'title'            => __( 'Category Metabox', 'cmb2' ), // Doesn't output for term boxes
// 		'object_types'     => array( 'term' ), // Tells CMB2 to use term_meta vs post_meta
// 		'taxonomies'       => array( 'category', 'post_tag' ), // Tells CMB2 which taxonomies should have these fields
// 		// 'new_term_section' => true, // Will display in the "Add New Category" section
// 	) );

// 	$cmb_term->add_field( array(
// 		'name'     => __( 'Extra Info', 'cmb2' ),
// 		'desc'     => __( 'field description (optional)', 'cmb2' ),
// 		'id'       => $prefix . 'extra_info',
// 		'type'     => 'title',
// 		'on_front' => false,
// 	) );

// 	$cmb_term->add_field( array(
// 		'name' => __( 'Term Image', 'cmb2' ),
// 		'desc' => __( 'field description (optional)', 'cmb2' ),
// 		'id'   => $prefix . 'avatar',
// 		'type' => 'file',
// 	) );

// 	$cmb_term->add_field( array(
// 		'name' => __( 'Arbitrary Term Field', 'cmb2' ),
// 		'desc' => __( 'field description (optional)', 'cmb2' ),
// 		'id'   => $prefix . 'term_text_field',
// 		'type' => 'text',
// 	) );

// }






// add_action( 'cmb2_admin_init', 'kylawilliams_register_theme_options_metabox' );
// /**
//  * Hook in and register a metabox to handle a theme options page
//  */
// function kylawilliams_register_theme_options_metabox() {

// 	$option_key = 'kylawilliams_theme_options';

// 	/**
// 	 * Metabox for an options page. Will not be added automatically, but needs to be called with
// 	 * the `cmb2_metabox_form` helper function. See wiki for more info.
// 	 */
// 	$cmb_options = new_cmb2_box( array(
// 		'id'      => $option_key . 'page',
// 		'title'   => __( 'Theme Options Metabox', 'cmb2' ),
// 		'hookup'  => false, // Do not need the normal user/post hookup
// 		'show_on' => array(
// 			// These are important, don't remove
// 			'key'   => 'options-page',
// 			'value' => array( $option_key )
// 		),
// 	) );

// 	/**
// 	 * Options fields ids only need
// 	 * to be unique within this option group.
// 	 * Prefix is not needed.
// 	 */
// 	$cmb_options->add_field( array(
// 		'name'    => __( 'Site Background Color', 'cmb2' ),
// 		'desc'    => __( 'field description (optional)', 'cmb2' ),
// 		'id'      => 'bg_color',
// 		'type'    => 'colorpicker',
// 		'default' => '#ffffff',
// 	) );

// }
