<?php
add_filter( 'cmb_meta_boxes', 'cmb_gdc_metaboxes' );
function cmb_gdc_metaboxes( array $meta_boxes ) {

	$prefix = '_cmb_';

// Product Subheading
	$meta_boxes[] = array(
		'id' => 'size',
		'title' => 'Size (Millilitres)',
		'pages' => array('product'), // post type
		'context' => 'side',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => '',
				'desc' => 'just add the number (not "ml.")',
				'id' => $prefix . 'size',
				'type' => 'text',
			),
	),
);

// Product Ingredients
	$meta_boxes[] = array(
		'id' => 'ingredients',
		'title' => 'Ingredients',
		'pages' => array('product'), // post type
		'context' => 'normal',
		'priority' => 'low',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Ingredients',
				'desc' => 'Ingredients"',
				'id' => $prefix . 'ingredients',
				'type' => 'wysiwyg'
			),
	),
);

	// Product Instructions
	$meta_boxes[] = array(
		'id' => 'instructions',
		'title' => 'Instructions',
		'pages' => array('product'), // post type
		'context' => 'normal',
		'priority' => 'low',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'instructions',
				'desc' => 'instructions"',
				'id' => $prefix . 'instructions',
				'type' => 'wysiwyg'
			),
	),
);

		// Sample Link
	$meta_boxes[] = array(
		'id' => 'sample',
		'title' => 'Sample',
		'pages' => array('product'), // post type
		'context' => 'side',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array( 
				'id' => 'sample_version', 
				'type' => 'post_select', 
				'use_ajax' => false, 
				'query' => array( 
					'post_type' => 'product',
					'posts_per_page' => '-1',
					'tax_query' => array(
							array(
								'taxonomy' => 'product_cat',
								'field'    => 'slug',
								'terms'    => 'samples',
							),
						),					), 
				'multiple' => false,
				'allow_none' => true,
			),
	),
);



	

// Meta For Short Description (Plat Spa)
	$meta_boxes[] = array(
		'id' => 'spadescription',
		'title' => 'Spa Info',
		'pages' => array('sm-location'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Account Number',
				'desc' => 'IMPORTANT! Make sure this is correct',
				'id' => 'cmb_spa_account_number',
				'type' => 'text',
				'cols' => 6
			),
			array( 
				'id' => 'cmb_spa_acc_manager', 
				'name' => 'Account Manager', 
				'desc' => 'Select account manager', 
				'type' => 'post_select', 
				'use_ajax' => false, 
				'query' => array( 
							'post_type' => 'account_manager',
							'posts_per_page' => '-1',
							'orderby' => 'title',
							'order' => 'ASC' 
							),
				'cols' => '6' 
			),
			array(
				'name' => 'Short description',
				'desc' => 'This short description will show up on the Platinum Spa listing page',
				'id' => 'cmb_spadescription',
				'type' => 'wysiwyg',
				'cols' => 12
			),
			array( 
			'id' => 'cmb_slide_image', 
			'name' => 'Slide Image', 
			'type' => 'image', 
			'repeatable' => true,
			'size' => 'height=360&width=800&crop=1',
			'show_size' => true 
			),
		),
	);
// Treatment Of The Month Checkbox
	$meta_boxes[] = array(
		'id' => 'treatmentofmonth',
		'title' => 'Treatment Specifics',
		'pages' => array('treatments'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
			'name' => 'Treatment Duration',
			'desc' => 'enter number of minutes only (leave out the word "minutes"',
			'id' => $prefix . 'treatmentduration',
			'type' => 'text',
			'cols' => '3'
			),
			array(
				'name' => 'Featured Treatment?',
				'desc' => 'Is this a "Treatment Of The Month?"',
				'id' => $prefix . 'treatmentofmonth',
				'type' => 'checkbox',
				'cols' => '3'
			),
			array(
				'name' => 'Video URL',
				'desc' => 'enter url of youtube video - include https://"',
				'id' => $prefix . 'treatmentvideo',
				'type' => 'text',
				'cols' => '6'
			),
	),
);
// Treatment Of The Month Checkbox
	$meta_boxes[] = array(
		'id' => 'treatmentimage',
		'title' => 'Product Range Image',
		'pages' => array('treatments'), // post type
		'context' => 'side',
		'priority' => 'default',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name'     => 'Choose Product Range',
				'desc'     => 'This sets the page background using the product range image',
				'id'       => $prefix . 'product_range_image',
				'type'     => 'taxonomy_select',
				'taxonomy' => 'product_range', // Taxonomy Slug
			),

	),
);

// Promotion Period
	$meta_boxes[] = array(
		'id' => 'promo-period',
		'title' => 'Promotion Period',
		'pages' => array('downloads'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Promotion Start Date',
				'desc' => 'field description (optional)',
				'id' => $prefix . 'start-date',
				'type' => 'date'
			),
			array(
				'name' => 'Promotion End Date',
				'desc' => 'field description (optional)',
				'id' => $prefix . 'end-date',
				'type' => 'date'
			),

	),
);
// Files - OLD, from Jaredatch's CMBs - Kept for now so old files can be unset within the admin
	/*
	$meta_boxes[] = array(
		'id' => 'downloadfiles',
		'title' => 'Download Files DO NOT USE! Use "Download Files NEW" instead',
		'pages' => array('downloads'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'General Download',
				'desc' => 'Upload an image or enter an URL.',
				'id' => $prefix . 'generic',
				'type' => 'file',
				'save_id' => true, // save ID using true
				'cols' => 3,
				'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
			),
			array(
				'name' => 'View on screen',
				'desc' => 'Upload an image or enter an URL.',
				'id' => $prefix . 'low_res',
				'type' => 'file',
				'save_id' => true, // save ID using true
				'cols' => 3,
				'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
			),
			array(
				'name' => 'Print in-house',
				'desc' => 'Upload an image or enter an URL.',
				'id' => $prefix . 'high_res',
				'type' => 'file',
				'save_id' => true, // save ID using true
				'cols' => 3,
				'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
			),
			array(
				'name' => 'Print professionally',
				'desc' => 'Upload an image or enter an URL.',
				'id' => $prefix . 'print-ready',
				'type' => 'file',
				'save_id' => true, // save ID using true
				'cols' => 3,
				'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
				),
			array(
				'name' => 'Video URL',
				'desc' => 'enter url of youtube video - include https://"',
				'id' => $prefix . 'tradevideo',
				'type' => 'text'
			),
		),
);
*/
// Files - USE THIS FROM HERE ON OUT
	$meta_boxes[] = array(
		'id' => 'downloadfiles2',
		'title' => 'Download Files NEW',
		'pages' => array('downloads'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'General Download',
				'desc' => 'Upload an image or enter an URL.',
				'id' => $prefix . 'generic2',
				'type' => 'file',
				'save_id' => true, // save ID using true
				'cols' => 3,
				'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
			),
			array(
				'name' => 'View on screen',
				'desc' => 'Upload an image or enter an URL.',
				'id' => $prefix . 'low_res2',
				'type' => 'file',
				'save_id' => true, // save ID using true
				'cols' => 3,
				'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
			),
			array(
				'name' => 'Print in-house',
				'desc' => 'Upload an image or enter an URL.',
				'id' => $prefix . 'high_res2',
				'type' => 'file',
				'save_id' => true, // save ID using true
				'cols' => 3,
				'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
			),
			array(
				'name' => 'Print professionally',
				'desc' => 'Upload an image or enter an URL.',
				'id' => $prefix . 'print-ready2',
				'type' => 'file',
				'save_id' => true, // save ID using true
				'cols' => 3,
				'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
				),
			array(
				'name' => 'Video URL',
				'desc' => 'enter url of youtube video - include https://"',
				'id' => $prefix . 'tradevideo2',
				'type' => 'text'
			),
		),
);

// Press Articles
	$meta_boxes[] = array(
		'id' => 'pressarticle-details',
		'title' => 'Article Details',
		'pages' => array('pressarticle'), // post type
		'context' => 'normal',
		'priority' => 'default',
		'show_names' => true, // Show field names on the left
//		'show_on'    => array( 'key' => 'id', 'value' => array( '450' ), ),
		'fields' => array(
			array(
				'name' => 'Date of publication',
				'desc' => 'Approximate date is fine',
				'id' => $prefix . 'publicationdateunix',
				'type' => 'date_unix',
				),
			array(
				'name' => 'A4 PDF - DONT USE!',
				'desc' => 'Upload a PDF for customers to use in their GdC PR Folders',
				'id' => $prefix . 'articlepdf',
				'type' => 'file',
				'save_id' => true, // save ID using true
				'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
				),
			array(
				'name' => 'A4 PDF - USE THIS!',
				'desc' => 'Upload a PDF for customers to use in their GdC PR Folders',
				'id' => $prefix . 'articlepdf2',
				'type' => 'file',
				'save_id' => true, // save ID using true
				'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
				),
		),
	);

// Account Manager
	$meta_boxes[] = array(
		'id' => 'acc_manager_details',
		'title' => 'Details',
		'pages' => array('account_manager'), // post type
		'context' => 'normal',
		'priority' => 'default',
		'show_names' => true, // Show field names on the left
//		'show_on'    => array( 'key' => 'id', 'value' => array( '450' ), ),
		'fields' => array(
			array(
				'name' => 'Phone Number',
				'desc' => '',
				'id' => $prefix . 'acc_man_phone',
				'type' => 'text',
				'cols' => '3',
			),
			array(
				'name' => 'Email',
				'desc' => '',
				'id' => $prefix . 'acc_man_email',
				'type' => 'text',
				'cols' => '5',
			),
		),
	);



	// Contact Details
	$meta_boxes[] = array(
		'id' => 'contact_info',
		'title' => 'Contact Details',
		'pages' => array('page'), // post type
		'show_on'    => array( 'key' => 'id', 'value' => array( '450' ), ),
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Address Line 1',
				'desc' => '',
				'id' => $prefix . 'contact_details_1',
				'type' => 'text'
			),
			array(
				'name' => 'Address Line 2',
				'desc' => '',
				'id' => $prefix . 'contact_details_2',
				'type' => 'text'
			),
			array(
				'name' => 'Address Line 3',
				'desc' => '',
				'id' => $prefix . 'contact_details_3',
				'type' => 'text'
			),
			array(
				'name' => 'Address Line 4',
				'desc' => '',
				'id' => $prefix . 'contact_details_4',
				'type' => 'text'
			),
			array(
				'name' => 'Postcode',
				'desc' => '',
				'id' => $prefix . 'contact_details_5',
				'type' => 'text'
			),
			array(
				'name' => 'Telephone',
				'desc' => '',
				'id' => $prefix . 'contact_details_6',
				'type' => 'text'
			),
			array(
				'name' => 'Additional Info',
				'desc' => '',
				'id' => $prefix . 'contact_details_additional',
				'type' => 'wysiwyg'
			),
		),
	);


// Press Articles
	$meta_boxes[] = array(
		'id' => 'promotion-details',
		'title' => 'Promotion Details',
		'pages' => array('promotion'), // post type
		'context' => 'normal',
		'priority' => 'default',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array( 
				'id' => $prefix . 'promo_gift', 
				'name' => 'Free Gift Product', 
				'type' => 'post_select', 
				'use_ajax' => false, 
				'query' => array( 
							'post_type' => 'product',
							'posts_per_page' => '-1',
							'orderby' => 'title',
							'order' => 'ASC' 
							),
				'cols' => '12' 
			),
			array(
				'name' => 'Required Spend (leave blank for product promotion)',
				'desc' => '',
				'id' => $prefix . 'promo_required_spend',
				'type' => 'text',
				'default' => '',
				'cols' => '6' 
			),
			array( 
				'id' => $prefix . 'promo_required_product', 
				'name' => 'Required Product (Ignored if required spend is entered)', 
				'type' => 'post_select', 
				'use_ajax' => false, 
				'query' => array( 
							'post_type' => 'product',
							'posts_per_page' => '-1',
							'orderby' => 'title',
							'order' => 'ASC' 
							),
				'cols' => '6' 
			),
			array(
				'name' => 'Promotion Start Date',
				'desc' => 'Set start date',
				'id' => $prefix . 'promo_start_date',
				'type' => 'date_unix',
				'cols' => '6' 
			),
			array(
				'name' => 'Promotion End Date',
				'desc' => 'Set end date',
				'id' => $prefix . 'promo_end_date',
				'type' => 'date_unix',
				'cols' => '6' 
			),
		),
	);


// Press Articles
	$meta_boxes[] = array(
		'id' => 'recommendation_details',
		'title' => 'Details',
		'pages' => array('recommendation'), // post type
		'context' => 'normal',
		'priority' => 'default',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'First Name',
				'desc' => '',
				'id' => $prefix . 'first_name',
				'type' => 'text',
				'default' => '',
				'cols' => '6' 
			),
			array(
				'name' => 'Surname',
				'desc' => '',
				'id' => $prefix . 'last_name',
				'type' => 'text',
				'default' => '',
				'cols' => '6' 
			),
			array(
				'name' => 'Email Address',
				'desc' => '',
				'id' => $prefix . 'email',
				'type' => 'text',
				'default' => '',
				'cols' => '4' 
			),
			array(
				'name' => 'Age',
				'desc' => '',
				'id' => $prefix . 'age',
				'type' => 'text',
				'default' => '',
				'cols' => '4' 
			),
			array(
				'name' => 'Sex',
				'desc' => '',
				'id' => $prefix . 'sex',
				'type' => 'text',
				'default' => '',
				'cols' => '4' 
			),
			array(
				'name' => 'Address 1',
				'desc' => '',
				'id' => $prefix . 'add1',
				'type' => 'text',
				'default' => '',
				'cols' => '3' 
			),
			array(
				'name' => 'Address 2',
				'desc' => '',
				'id' => $prefix . 'add2',
				'type' => 'text',
				'default' => '',
				'cols' => '3' 
			),
			array(
				'name' => 'Address 3',
				'desc' => '',
				'id' => $prefix . 'add3',
				'type' => 'text',
				'default' => '',
				'cols' => '3' 
			),
			array(
				'name' => 'Address 4',
				'desc' => '',
				'id' => $prefix . 'add4',
				'type' => 'text',
				'default' => '',
				'cols' => '3' 
			),
			array(
				'name' => 'Postcode',
				'desc' => '',
				'id' => $prefix . 'add5',
				'type' => 'text',
				'default' => '',
				'cols' => '3' 
			),
			
			array(
				'name' => 'Skin Sensitivity',
				'desc' => '',
				'id' => $prefix . 'sensitivity',
				'type' => 'text',
				'default' => '',
				'cols' => '3' 
			),
			array(
				'name' => 'Skin Concern',
				'desc' => '',
				'id' => $prefix . 'concern',
				'type' => 'text',
				'default' => '',
				'cols' => '3' 
			),
			array(
				'name' => 'Skin Type',
				'desc' => '',
				'id' => $prefix . 'skintype',
				'type' => 'text',
				'default' => '',
				'cols' => '3' 
			),
			array(
				'name' => 'Coupon ID',
				'desc' => '',
				'id' => $prefix . 'coupon_id',
				'type' => 'text',
				'default' => '',
				'cols' => '6' 
			),
			array(
				'name' => 'Coupon Code',
				'desc' => '',
				'id' => $prefix . 'coupon_code',
				'type' => 'text',
				'default' => '',
				'cols' => '6' 
			),

		),
	);

/*
	$meta_boxes[] = array(
		'title' => 'Promotions',
		'pages' => 'page',
		'fields' => array(
		array( 
			'id' => $prefix . 'coupon_promos', 
			'name' => 'Select coupon codes to advertise on front end and apply automatically if cart qualifies',
			'repeatable' => false,
			'type' => 'post_select', 
			'use_ajax' => false, 
			'query' => array( 
				'post_type' => 'shop_coupon',
				'meta_query' => array(
					array(
						'key'     => 'skincare_expert',
						'value'   => 'yes',
						'compare' => 'NOT EXISTS',
					),
				),
			), 
			'multiple' => true  
			),
		),

	);
*/

// Treatment Of The Month Checkbox
	$meta_boxes[] = array(
		'id' => 'public_promo_coupon',
		'title' => 'Make this coupon a public promotion',
		'pages' => array('shop_coupon'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Check to advertise this offer and automatically apply coupon if cart qualifies',
				'desc' => '<b><img style="margin-bottom:-8px;" width="26" src="//germaine-de-capuccini.co.uk/wp-content/themes/gdc2014/images/alert.png"> IMPORTANT: this feature currently ONLY supports the restriction "Minimum spend". DO NOT set any "Product" or "Category" restrictions to the coupon if using this feature!</b><br>Only the newest coupon will be appear on the front end and be applied."',
				'id' => 'public_promo',
				'type' => 'checkbox'
			),
			array( 
			'id' => $prefix . 'promo_coupon_banner', 
			'name' => 'Add a banner to show this promo on the shopfront', 
			'type' => 'image', 
			'repeatable' => false,
			'size' => 'width=800&crop=0',
			//'show_size' => true 
			),
	),
);







// Page redirect fields
	$meta_boxes[] = array(
		'id' => 'page-redirect-fields',
		'title' => 'Redirect Details',
		'pages' => array('page'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'show_on'    => array( 'key' => 'page-template', 'value' => array( 'template-login-redirect.php' ), ),
		'fields' => array(
			array(
				'name' => 'URL to redirect to once user is logged in',
				'desc' => '',
				'id' => $prefix . 'redirect_url',
				'type' => 'url',
				'cols' => '12'
				),
			array( 'id' => $prefix . 'require_login',  'name' => 'User has to log in before redirect?', 'type' => 'checkbox', 'cols' => '6' ),
		),
		
	);


// Press Articles
$meta_boxes[] = array(
	'id' => 'trade_order_form',
	'title' => 'Order Form',
	'pages' => array('page'), // post type
	'context' => 'normal',
	'priority' => 'default',
	'show_names' => true, // Show field names on the left
	'show_on'    => array( 'key' => 'id', 'value' => array( '6610' ), ),
	'fields' => array(
		array(
			'name' => 'Order Form',
			'desc' => 'Upload the latest order form Excel spreadsheet',
			'id' => $prefix . 'trade_order_form_upload',
			'type' => 'file',
			),
	),
);








	return $meta_boxes;
}






/**
 * Hide editor for specific page templates.
 *
 */
/*
add_action( 'admin_init', 'hide_editor' );

function hide_editor() {
	// Get the Post ID.
	$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
	if( !isset( $post_id ) ) return;

	// Get the name of the Page Template file.
	$template_file = get_post_meta($post_id, '_wp_page_template', true);
    
    if($template_file == 'template-login-redirect.php'){ // template name
    	remove_post_type_support('page', 'editor');
    }
}
*/




?>