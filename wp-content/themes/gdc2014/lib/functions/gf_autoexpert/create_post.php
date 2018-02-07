<?php
function create_recommendation_post(){
include_once"wp-config.php";
include_once"wp-load.php";
include_once"wp-includes/wp-db.php";

	global $post;
	global $_gdc_concern;
	global $_gdc_sensitivity;
	global $_gdc_age;
	global $_gdc_skintype;
	global $_gdc_sex;
	global $_gdc_fname;
	global $_gdc_sname;
	global $_gdc_address1;
	global $_gdc_address2;
	global $_gdc_address3;
	global $_gdc_address4;
	global $_gdc_address5;
	global $_gdc_email;
	global $_gdc_cleanserloop;
	global $_gdc_tonerloop;
	//global $_gdc_exfoliatorloop;
	global $_gdc_dailytreatmentloop;
	global $_gdc_eyetreatmentloop;
	global $_gdc_combination;


	// GENERATE PRODUCT LOOPS BASED ON USER SUMBITTED ENTRIES
	require_once('product_loops.php');

	// create post object
	class wm_mypost {
	var $post_title;
	var $post_content;
	var $post_status;
	var $post_author; /* author user id (optional) */
	var $post_name; /* slug (optional) */
	var $post_type; /* 'page' or 'post' (optional, defaults to 'post') */
	var $comment_status; /* open or closed for commenting (optional) */
	}

	// initialize post object
	$wm_mypost = new wm_mypost();

	//CONSTRUCT PAGE CONTENT
	$mbm_post_content = '<div id="autoexpert">';
	$mbm_post_content .= '"<p>Hi ';
	$mbm_post_content .= $_gdc_fname;
	$mbm_post_content .= ', below are the products that are perfect for your particular skin.<br>';
	$mbm_post_content .= 'We have emailed these recomendations to you for your reference.</p>"';
	$mbm_post_content .= '<p>Bookmark this page for future reference. If we launch any products that are even better for your exact skincare needs, they will appear below!</p></div>';

	// fill object
	$wm_mypost->post_title = $_gdc_fname. '-' . $_gdc_sname . '-' . rand(1,100000);
	$wm_mypost->post_content = $mbm_post_content;
	$wm_mypost->post_status = 'publish';
	$wm_mypost->post_author = 1;
	$wp_rewrite->feeds = 'no';

	// Optional; uncomment as needed
	 $wm_mypost->post_type = 'recommendation';
	 $wm_mypost->comment_status = 'closed';

	// feed object to wp_insert_post
	//wp_insert_post($wm_mypost);

	global $recommendation_post_id;
	$recommendation_post_id = wp_insert_post($wm_mypost);
	add_post_meta($recommendation_post_id, 'First Name', $_gdc_fname, true);
	add_post_meta($recommendation_post_id, 'Surname', $_gdc_sname, true);
	add_post_meta($recommendation_post_id, 'Sex', $_gdc_sex, true);
	add_post_meta($recommendation_post_id, 'Age', $_gdc_age, true);
	add_post_meta($recommendation_post_id, 'Address 1', $_gdc_address1, true);
	add_post_meta($recommendation_post_id, 'Address 2', $_gdc_address2, true);
	add_post_meta($recommendation_post_id, 'Address 3', $_gdc_address3, true);
	add_post_meta($recommendation_post_id, 'Address 4', $_gdc_address4, true);
	add_post_meta($recommendation_post_id, 'Address 5', $_gdc_address5, true);
	add_post_meta($recommendation_post_id, 'Email Address', $_gdc_email, true);
	add_post_meta($recommendation_post_id, 'Skin Sensitivity', $_gdc_sensitivity, true);
	add_post_meta($recommendation_post_id, 'Skin Concern', $_gdc_concern, true);
	add_post_meta($recommendation_post_id, 'Skin Type', $_gdc_skintype, true);

} ?>