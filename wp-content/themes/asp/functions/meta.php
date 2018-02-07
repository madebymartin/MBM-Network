<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'mbm_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}

/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 *
 * @param  CMB2 object $cmb CMB2 object.
 *
 * @return bool             True if metabox should show
 */
function mbm_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's not the front page template.
	if ( get_option( 'page_on_front' ) !== $cmb->object_id ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field object $field Field object.
 *
 * @return bool                     True if metabox should show
 */
function mbm_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category.
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

/**
 * Manually render a field.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object.
 */
function mbm_render_row_cb( $field_args, $field ) {
	$classes     = $field->row_classes();
	$id          = $field->args( 'id' );
	$label       = $field->args( 'name' );
	$name        = $field->args( '_name' );
	$value       = $field->escaped_value();
	$description = $field->args( 'description' );
	?>
	<div class="custom-field-row <?php echo esc_attr( $classes ); ?>">
		<p><label for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $label ); ?></label></p>
		<p><input id="<?php echo esc_attr( $id ); ?>" type="text" name="<?php echo esc_attr( $name ); ?>" value="<?php echo $value; ?>"/></p>
		<p class="description"><?php echo esc_html( $description ); ?></p>
	</div>
	<?php
}

/**
 * Manually render a field column display.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object.
 */
function mbm_display_text_small_column( $field_args, $field ) {
	?>
	<div class="custom-column-display <?php echo esc_attr( $field->row_classes() ); ?>">
		<p><?php echo $field->escaped_value(); ?></p>
		<p class="description"><?php echo esc_html( $field->args( 'description' ) ); ?></p>
	</div>
	<?php
}

/**
 * Conditionally displays a message if the $post_id is 2
 *
 * @param  array             $field_args Array of field parameters.
 * @param  CMB2_Field object $field      Field object.
 */
function mbm_before_row_if_2( $field_args, $field ) {
	if ( 2 == $field->object_id ) {
		echo '<p>Testing <b>"before_row"</b> parameter (on $post_id 2)</p>';
	} else {
		echo '<p>Testing <b>"before_row"</b> parameter (<b>NOT</b> on $post_id 2)</p>';
	}
}








add_action( 'cmb2_init', 'mbm_register_certificate_cmb' );
function mbm_register_certificate_cmb() {
	$prefix = 'mbm_';

	$cmb_certificate_cmb = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Certificate PDF', 'cmb2' ),
		'object_types'  => array( 'certificate', ), // Post type
	) );
	$cmb_certificate_cmb->add_field( array( 'id' => $prefix . 'cert_pdf',  'name' => 'PDF for download', 'type' => 'file', 'repeatable' => false, 'cols' => 4 ) );
	$cmb_certificate_cmb->add_field( array( 'id'   => $prefix . 'cert_img', 'name' => 'Image', 'type' => 'file', 'library-type' => array('image' ), 'repeatable' => false, 'cols' => 4 ) );
}




add_action( 'cmb2_init', 'mbm_register_team_cmb' );
function mbm_register_team_cmb() {
	$prefix = 'mbm_member_';

	$cmb_team_cmb = new_cmb2_box( array(
		'id'            => $prefix . 'member',
		'title'         => esc_html__( 'Member Details', 'cmb2' ),
		'object_types'  => array( 'team_member', ), // Post type
	) );
	$cmb_team_cmb->add_field( array( 'id' => $prefix . 'role',  'name' => 'Role', 'type' => 'text', 'repeatable' => false, 'cols' => 4 ) );
	$cmb_team_cmb->add_field( array( 'id' => $prefix . 'blurb', 'description' => 'Short description of this team member',  'name' => 'About', 'type' => 'textarea', 'repeatable' => false, 'cols' => 4 ) );
	// $cmb_team_cmb->add_field( array( 'id' => $prefix . 'subtitle',  'name' => 'Subtitle', 'type' => 'text', 'repeatable' => false, 'cols' => 4 ) );
	$cmb_team_cmb->add_field( array( 'id'   => $prefix . 'bullet', 'name' => 'Qualifications &amp; Expertise', 'type' => 'text', 'repeatable' => true, 'cols' => 4 ) );
}




add_action( 'cmb2_admin_init', 'mbm_register_page_links_metabox' );
function mbm_register_page_links_metabox() {
	$prefix = 'mbm_home_';

	$args = array( 'exclude' => $_GET['post'] );
	$pages = get_pages($args);
	$options = array();
	foreach ($pages as $key => $page) {
		$id = $page->ID;
		$title = get_the_title($id);
		$options[$id] = $title;
	}

	$cmb_home_page = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => esc_html__( 'Page Links', 'cmb2' ),
		'object_types' => array( 'page', ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
		// 'show_on_cb'      => 'mbm_show_if_front_page', 
	) );

	$cmb_home_page->add_field( array(
		'name'             => 'Page Links',
		'desc'             => 'choose the pages for which you want featured links on the homepage',
		'id'               => $prefix . 'homelinks',
		'type'             => 'select',
		'show_option_none' => true,
		'default'          => 'custom',
		'options'          => $options,
		'repeatable'	=>	true
	));

}



add_action( 'cmb2_init', 'mbm_register_more_page_content_cmb' );
function mbm_register_more_page_content_cmb() {
	$prefix = 'mbm_';

	$cmb_content2 = new_cmb2_box( array(
		'id'            => $prefix . 'content2',
		'title'         => esc_html__( 'More Content', 'cmb2' ),
		'object_types'  => array( 'page', ), // Post type
	) );
	$cmb_content2->add_field( 
		array( 
			'id' => $prefix . 'hidden',  
			'name' => 'Hidden Content', 
			'type' => 'wysiwyg', 
			'repeatable' => false, 
			'cols' => 4 ) 
	);
	$cmb_content2->add_field( 
		array( 
			'id' => $prefix . 'more',  
			'name' => 'Lower Content', 
			'type' => 'wysiwyg', 
			'repeatable' => false, 
			'cols' => 4 ) 
	);
}





add_action( 'cmb2_init', 'mbm_register_page_hse_download' );
function mbm_register_page_hse_download() {
	$prefix = 'mbm_';

	$downloads = new WP_Query( array(
		'post_type' => 'hse_download',
		'posts_per_page' => '-1',
		'order' => 'ASC'
		) 
	);
	$dl_array = array();

	if( $downloads->have_posts() ){
		while ( $downloads->have_posts() ) : $downloads->the_post();
			$id = get_the_id();
			$title = get_the_title( $id );
			$code = get_post_meta( $id, 'mbm_code', true );
			$dl_array[$id] = $code;
		endwhile;
	}

	$hse_download_link = new_cmb2_box( array(
		'id'            => $prefix . 'hse_downloads',
		'title'         => esc_html__( 'HSE Download', 'cmb2' ),
		'object_types'  => array( 'page', ), // Post type
		'context'      => 'side',
	) );
	$hse_download_link->add_field( array(
		'name'             => 'HSE Download',
		'id'               => $prefix . 'hse',
		'type'             => 'radio',
		'show_option_none' => true,
		'options'          => $dl_array,
	) );
}


add_action( 'cmb2_admin_init', 'mbm_register_repeatable_group_field_metabox' );
/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */
function mbm_register_repeatable_group_field_metabox() {
	$prefix = 'mbm_group_';

	/**
	 * Repeatable Field Groups
	 */
	$reveal_group = new_cmb2_box( array(
		'id'           => $prefix . 'reveal_boxes',
		'title'        => esc_html__( 'Reveal Boxes', 'cmb2' ),
		'object_types' => array( 'page', ),
	) );

	$reveal_group->add_field( array(
		'name'             => 'Transition Type',
		'id'               => $prefix . 'transition',
		'type'             => 'radio',
		'show_option_none' => false,
		'options'          => array(
			'1'	=>	'Fade In &amp; Scale',
			// '2'	=>	'Slide In (Right)',
			'3'	=>	'Slide Up',
			// '4'	=>	'Newspaper',
			'5'	=>	'Fall',
			// '6'	=>	'Side Fall',
			// '7'	=>	'Sticky Up',
			'8'	=>	'3D Flip (horizontal)',
			'9'	=>	'3D Flip (vertical)',
			'10'	=>	'3D Sign',
			'11'	=>	'Super Scaled',
			'12'	=>	'Just Me',
			'13'	=>	'3D Slit',
			'14'	=>	'3D Rotate Bottom',
			'15'	=>	'3D Rotate In Left',
			// '16'	=>	'Blur',
		),
	) );

	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$group_field_id = $reveal_group->add_field( array(
		'id'          => $prefix . 'reveal_group',
		'type'        => 'group',
		'description' => esc_html__( 'Creates boxes with images that, when clicked, spin around to reveal the content (as per the Team page).', 'cmb2' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Box {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add Another Box', 'cmb2' ),
			'remove_button' => esc_html__( 'Remove Entry', 'cmb2' ),
			'sortable'      => true, // beta
			'closed'     => true, // true to have the groups closed by default
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */
	$reveal_group->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Title', 'cmb2' ),
		'id'         => 'title',
		'type'       => 'text',
		// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );

	$reveal_group->add_group_field( $group_field_id, array(
		'name'        => esc_html__( 'Wording', 'cmb2' ),
		// 'description' => esc_html__( 'Write a short description for this entry', 'cmb2' ),
		'id'          => 'wording',
		'type'        => 'wysiwyg',
	) );

	$reveal_group->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Image', 'cmb2' ),
		'id'   => 'image',
		'type' => 'file',
	) );

}








add_action( 'cmb2_init', 'mbm_register_hse_downloads_meta' );
function mbm_register_hse_downloads_meta() {
	$prefix = 'mbm_';

	$cmb_hse_details = new_cmb2_box( array(
		'id'            => $prefix . 'hse',
		'title'         => esc_html__( 'Details', 'cmb2' ),
		'object_types'  => array( 'hse_download', ), // Post type
	) );
	$cmb_hse_details->add_field( 
		array( 
			'id' => $prefix . 'code',  
			'name' => 'Reference Code', 
			'type' => 'text', 
			'repeatable' => false, 
			'cols' => 4 ) 
	);
	$cmb_hse_details->add_field( 
		array( 
			'id' => $prefix . 'url',  
			'name' => 'HSE web address', 
			'type' => 'text_url', 
			'repeatable' => false, 
			'cols' => 4 ) 
	);
}















add_action( 'cmb2_admin_init', 'mbm_register_user_profile_metabox' );
/**
 * Hook in and add a metabox to add fields to the user profile pages
 */
function mbm_register_user_profile_metabox() {
	$prefix = 'mbm_user_';

	/**
	 * Metabox for the user profile screen
	 */
	$cmb_user = new_cmb2_box( array(
		'id'               => $prefix . 'edit',
		'title'            => esc_html__( 'User Profile Metabox', 'cmb2' ), // Doesn't output for user boxes
		'object_types'     => array( 'user' ), // Tells CMB2 to use user_meta vs post_meta
		'show_names'       => true,
		'new_user_section' => 'add-new-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
	) );

	$cmb_user->add_field( array(
		'name'     => esc_html__( 'Extra Info', 'cmb2' ),
		'desc'     => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'       => $prefix . 'extra_info',
		'type'     => 'title',
		'on_front' => false,
	) );

	$cmb_user->add_field( array(
		'name'    => esc_html__( 'Avatar', 'cmb2' ),
		'desc'    => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'      => $prefix . 'avatar',
		'type'    => 'file',
	) );

	$cmb_user->add_field( array(
		'name' => esc_html__( 'Facebook URL', 'cmb2' ),
		'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'facebookurl',
		'type' => 'text_url',
	) );

	$cmb_user->add_field( array(
		'name' => esc_html__( 'Twitter URL', 'cmb2' ),
		'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'twitterurl',
		'type' => 'text_url',
	) );

	$cmb_user->add_field( array(
		'name' => esc_html__( 'Google+ URL', 'cmb2' ),
		'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'googleplusurl',
		'type' => 'text_url',
	) );

	$cmb_user->add_field( array(
		'name' => esc_html__( 'Linkedin URL', 'cmb2' ),
		'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'linkedinurl',
		'type' => 'text_url',
	) );

	$cmb_user->add_field( array(
		'name' => esc_html__( 'User Field', 'cmb2' ),
		'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'user_text_field',
		'type' => 'text',
	) );

}

add_action( 'cmb2_admin_init', 'mbm_register_taxonomy_metabox' );
/**
 * Hook in and add a metabox to add fields to taxonomy terms
 */
function mbm_register_taxonomy_metabox() {
	$prefix = 'mbm_term_';

	/**
	 * Metabox to add fields to categories and tags
	 */
	$cmb_term = new_cmb2_box( array(
		'id'               => $prefix . 'edit',
		'title'            => esc_html__( 'Category Metabox', 'cmb2' ), // Doesn't output for term boxes
		'object_types'     => array( 'term' ), // Tells CMB2 to use term_meta vs post_meta
		'taxonomies'       => array( 'category', 'post_tag' ), // Tells CMB2 which taxonomies should have these fields
		// 'new_term_section' => true, // Will display in the "Add New Category" section
	) );

	$cmb_term->add_field( array(
		'name'     => esc_html__( 'Extra Info', 'cmb2' ),
		'desc'     => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'       => $prefix . 'extra_info',
		'type'     => 'title',
		'on_front' => false,
	) );

	$cmb_term->add_field( array(
		'name' => esc_html__( 'Term Image', 'cmb2' ),
		'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'avatar',
		'type' => 'file',
	) );

	$cmb_term->add_field( array(
		'name' => esc_html__( 'Arbitrary Term Field', 'cmb2' ),
		'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'term_text_field',
		'type' => 'text',
	) );

}

add_action( 'cmb2_admin_init', 'mbm_register_theme_options_metabox' );
/**
 * Hook in and register a metabox to handle a theme options page
 */
function mbm_register_theme_options_metabox() {

	$option_key = 'mbm_theme_options';

	/**
	 * Metabox for an options page. Will not be added automatically, but needs to be called with
	 * the `cmb2_metabox_form` helper function. See https://github.com/WebDevStudios/CMB2/wiki for more info.
	 */
	$cmb_options = new_cmb2_box( array(
		'id'      => $option_key . 'page',
		'title'   => esc_html__( 'Theme Options Metabox', 'cmb2' ),
		'hookup'  => false, // Do not need the normal user/post hookup.
		'show_on' => array(
			// These are important, don't remove.
			'key'   => 'options-page',
			'value' => array( $option_key )
		),
	) );

	/**
	 * Options fields ids only need
	 * to be unique within this option group.
	 * Prefix is not needed.
	 */
	$cmb_options->add_field( array(
		'name'    => esc_html__( 'Site Background Color', 'cmb2' ),
		'desc'    => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'      => 'bg_color',
		'type'    => 'colorpicker',
		'default' => '#ffffff',
	) );

}

/**
 * Only show this box in the CMB2 REST API if the user is logged in.
 *
 * @param  bool                 $is_allowed     Whether this box and its fields are allowed to be viewed.
 * @param  CMB2_REST_Controller $cmb_controller The controller object.
 *                                              CMB2 object available via `$cmb_controller->rest_box->cmb`.
 *
 * @return bool                 Whether this box and its fields are allowed to be viewed.
 */
function mbm_limit_rest_view_to_logged_in_users( $is_allowed, $cmb_controller ) {
	if ( ! is_user_logged_in() ) {
		$is_allowed = false;
	}

	return $is_allowed;
}