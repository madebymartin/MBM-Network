<?php
// CUSTOM META ---------------------------------------------------------------------------------------------------------


// Reviews - Customer Details
	$meta_boxes[] = array(
		'id' => 'customer_details',
		'title' => 'Customer Details',
		'pages' => array('story'), // post type
		'context' => 'normal',
		'priority' => 'default',
		'show_names' => true, // Show field names on the left
		'fields' => array(
	array(
		'name' => 'Reviewing',
		'desc' => '',
		'id' => $prefix . 'customer_reviewing',
		'type' => 'radio',
		'options' => array(
			array('name' => 'Classic Pro Treatment', 'value' => 'pro'),
			array('name' => 'Classic Elite Treatment', 'value' => 'elite'),
			array('name' => 'Apres Care Products', 'value' => 'aprescare'),
			array('name' => 'Self Slim Products', 'value' => 'selfslim')				
		)
),

	array(
		'name' => 'Age',
		'desc' => '',
		'id' => $prefix . 'customer_age',
		'type' => 'text_small',	
		),
	array(
		'name' => 'From',
		'desc' => '',
		'id' => $prefix . 'customer_from',
		'type' => 'text_medium',	
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
		'fields' => array(
	array(
		'name' => 'Date of publication',
		'desc' => '',
		'id' => $prefix . 'publicationdate',
		'type' => 'text_date',	
)
		),
);


// Files
	$meta_boxes[] = array(
		'id' => 'downloadfiles',
		'title' => 'Download Files',
		'pages' => array('downloads'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'High Res PDF (No Printer Marks)',
				'desc' => 'Upload an image or enter an URL.',
				'id' => $prefix . 'high_res',
				'type' => 'file',
				'save_id' => true, // save ID using true
				'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
),
			array(
				'name' => 'Print-ready PDF (With Printer Marks)',
				'desc' => 'Upload an image or enter an URL.',
				'id' => $prefix . 'print-ready',
				'type' => 'file',
				'save_id' => true, // save ID using true
				'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
				),

		),
);

// HOMEPAGE SLIDES
	$meta_boxes[] = array(
		'id' => 'slides',
		'title' => 'Homepage Slide',
		'pages' => array('post', 'page', 'product', 'productinfo'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Create Slide',
				'desc' => 'check to create a hompage slide linking to this page.',
				'id' => $prefix . 'createslide',
				'type' => 'checkbox'
			),
			array(
				'name' => 'Button Text',
				'desc' => 'this overrides [Find Out More] on the button. Keep it short!',
				'id' => $prefix . 'buttontext',
				'type' => 'text_medium'
			),
			array(
				'name' => 'Slide image: English',
				'desc' => 'upload image for the English slide [780px x 350px]',
				'id' => $prefix . 'slideimage_en',
				'type' => 'file'
			),



			array(
				'name' => 'Slide image: Belgian French',
				'desc' => 'upload image for the Belgian French slide [780px x 350px]',
				'id' => $prefix . 'slideimage_be_fr',
				'type' => 'file'
			),
			array(
				'name' => 'Slide image: Belgian Flemish',
				'desc' => 'upload image for the Belgian Flemish slide [780px x 350px]',
				'id' => $prefix . 'slideimage_be_nl',
				'type' => 'file'
			),



			array(
				'name' => 'Slide image: Arabic',
				'desc' => 'upload image for the Arabic slide [780px x 350px]',
				'id' => $prefix . 'slideimage_ar',
				'type' => 'file'
			),
			array(
				'name' => 'Slide image: Czech',
				'desc' => 'upload image for the Czech slide [780px x 350px]',
				'id' => $prefix . 'slideimage_cs',
				'type' => 'file'
			),
			array(
				'name' => 'Slide image: Danish',
				'desc' => 'upload image for the Danish slide [780px x 350px]',
				'id' => $prefix . 'slideimage_da',
				'type' => 'file'
			),
			array(
				'name' => 'Slide image: German',
				'desc' => 'upload image for the German slide [780px x 350px]',
				'id' => $prefix . 'slideimage_de',
				'type' => 'file'
			),
			array(
				'name' => 'Slide image: Spanish',
				'desc' => 'upload image for the Spanish slide [780px x 350px]',
				'id' => $prefix . 'slideimage_es',
				'type' => 'file'
			),
			array(
				'name' => 'Slide image: French',
				'desc' => 'upload image for the French slide [780px x 350px]',
				'id' => $prefix . 'slideimage_fr',
				'type' => 'file'
			),
			array(
				'name' => 'Slide image: Italian',
				'desc' => 'upload image for the Italian slide [780px x 350px]',
				'id' => $prefix . 'slideimage_it',
				'type' => 'file'
			),
			array(
				'name' => 'Slide image: Maltese',
				'desc' => 'upload image for the Maltese slide [780px x 350px]',
				'id' => $prefix . 'slideimage_mt',
				'type' => 'file'
			),
			array(
				'name' => 'Slide image: Dutch',
				'desc' => 'upload image for the Dutch slide [780px x 350px]',
				'id' => $prefix . 'slideimage_nl',
				'type' => 'file'
			),
			array(
				'name' => 'Slide image: Norwegian',
				'desc' => 'upload image for the Norwegian slide [780px x 350px]',
				'id' => $prefix . 'slideimage_no',
				'type' => 'file'
			),
			array(
				'name' => 'Slide image: Romanian',
				'desc' => 'upload image for the Romanian slide [780px x 350px]',
				'id' => $prefix . 'slideimage_ro',
				'type' => 'file'
			),
			array(
				'name' => 'Slide image: Swedish',
				'desc' => 'upload image for the Swedish slide [780px x 350px]',
				'id' => $prefix . 'slideimage_sv',
				'type' => 'file'
			),

	),
);

// Product Ingredients
	$meta_boxes[] = array(
		'id' => 'ingredients',
		'title' => 'Product Ingredients',
		'pages' => array('product', 'productinfo'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Ingredients',
				'desc' => '',
				'id' => $prefix . 'product_ingredients',
				'type' => 'textarea'
			),
	),
);


?>