<?php

//SAVE ALL INFO AND DEFINE LOOPS ON FORM SUBMISSION
//add_filter("gform_entry_post_save", "recommendations", 10, 2);
function recommendations($entry, $form){

// SET GLOBALS FOR USER ENTRIES
// SKIN SPECIFICS
	global $_gdc_concern;
	global $_gdc_sensitivity;
	global $_gdc_age;
	global $_gdc_skintype;
	$_gdc_concern = $entry["26"];
	$_gdc_sensitivity = $entry["27"];
	$_gdc_skintype = $entry["24"];
	$_gdc_age = $entry["25"];

//USER DETAILS
	global $_gdc_sex;
	$_gdc_sex = $entry["35"];
	global $_gdc_fname;
	global $_gdc_sname;
	global $_gdc_address1;
	global $_gdc_address2;
	global $_gdc_address3;
	global $_gdc_address4;
	global $_gdc_address5;
	$_gdc_fname = $entry["19.3"];
	$_gdc_sname = $entry["19.6"];
	$_gdc_address1 = $entry["29.1"];
	$_gdc_address2 = $entry["29.2"];
	$_gdc_address3 = $entry["29.3"];
	$_gdc_address4 = $entry["29.4"];
	$_gdc_address5 = $entry["29.5"];

	global $_gdc_email;
	global $_gdc_samples;
	$_gdc_samples = $entry["36"];
	if ($_gdc_samples === 'yes'){
		$_gdc_email = $entry["2"];
	}
	else{
		$_gdc_email = $entry["38"];
	}

// DECLARE GLOBALS FOR EACH PRODUCT TYPE LOOP
	global $_gdc_cleanserloop;
	global $_gdc_tonerloop;
	//global $_gdc_exfoliatorloop;
	global $_gdc_dailytreatmentloop;
	global $_gdc_eyetreatmentloop;

// COMPILE $_GDC_COMBINATION VARIABLE - USED TO MATCH TAXONOMY TERMS IN THE TAX_QUERY OF THE WP QUERY IN PRODUCTS_LOOP.PHP
	global $_gdc_combination;
	$_gdc_combination = $_gdc_concern . '-' . $_gdc_age . '-' .$_gdc_sensitivity. '';


// GENERATE PRODUCT LOOPS BASED ON USER SUMBITTED ENTRIES
	require_once('product_loops.php');
	wp_reset_query();




	if ($form["id"] == 20){

		include_once"wp-config.php";
		include_once"wp-load.php";
		include_once"wp-includes/wp-db.php";


		if($_gdc_address1){
		// create COUPON post object - ONLY IF REQUESTING SAMPLES
			class mbm_coupon_post {
			var $post_title;
			var $post_content;
			var $post_status;
			var $post_author; /* author user id (optional) */
			var $post_name; /* slug (optional) */
			var $post_type; /* 'page' or 'post' (optional, defaults to 'post') */
			var $comment_status; /* open or closed for commenting (optional) */
			}

			// initialize COUPON post object
			$mbm_coupon_post = new mbm_coupon_post();

			// fill COUPON object
			$mbm_coupon_post->post_title = 'skx' . substr(md5(rand()), 0, 7);
			$mbm_coupon_post->post_status = 'publish';
			$mbm_coupon_post->post_author = 1;
			$mbm_coupon_post->post_type = 'shop_coupon';
			$mbm_coupon_post->comment_status = 'closed';
			$mbm_coupon_post->post_excerpt = 'Skincare Expert: ' . $_gdc_fname . ' ' . $_gdc_sname;

			//	DEFINE VARIABLES FOR COUPON META
			$coupon_amount = '20';
			$current_time = (int) current_time( 'timestamp' );
			//$current_date = date_i18n( 'l j F Y',$current_time);
			$time_in_2_weeks = $current_time + '604800';
			$time_in_40_days = $current_time + '3456000';
			$date_in_40_days = date_i18n( 'Y-m-d',$time_in_40_days);

			global $mbm_coupon_post_id;
			$mbm_coupon_post_id = wp_insert_post($mbm_coupon_post);
			$mbm_coupon_code = get_the_title($mbm_coupon_post_id);
			add_post_meta($mbm_coupon_post_id, 'individual_use', 'yes', true);
			add_post_meta($mbm_coupon_post_id, 'discount_type', 'percent_product', true);
			add_post_meta($mbm_coupon_post_id, 'coupon_amount', $coupon_amount, true);

			add_post_meta($mbm_coupon_post_id, 'expiry_date', $date_in_40_days, true);
			// temp custom field to check expiry date format:
			add_post_meta($mbm_coupon_post_id, 'expiry_date_temp', $date_in_40_days, true);

			add_post_meta($mbm_coupon_post_id, 'usage_limit', '1', true);
			add_post_meta($mbm_coupon_post_id, 'minimum_amount', '25', true);
			add_post_meta($mbm_coupon_post_id, 'free_shipping', 'no', true);
			add_post_meta($mbm_coupon_post_id, 'exclude_sale_items', 'no', true);
			add_post_meta($mbm_coupon_post_id, 'skincare_expert', 'yes', true);

		// END COUPON CREATION
		}

		// create RECOMMENDATION post object
		class wm_mypost {
		var $post_title;
		var $post_content;
		var $post_status;
		var $post_author; /* author user id (optional) */
		var $post_name; /* slug (optional) */
		var $post_type; /* 'page' or 'post' (optional, defaults to 'post') */
		var $comment_status; /* open or closed for commenting (optional) */
		}

		// initialize RECOMMENDATION post object
		$wm_mypost = new wm_mypost();

		//CONSTRUCT RECOMMENDATION CONTENT
		$mbm_post_content = '<div id="autoexpert">';
	//	$mbm_post_content .= 'LEAD ID:  ' . $entry["id"] . '<br>';
		$mbm_post_content .= '<p>"Hello ';
		$mbm_post_content .= $_gdc_fname;
		$mbm_post_content .= ', below are the products that are perfect for your particular skin.<br>';
		$mbm_post_content .= 'We have emailed these recomendations to you for your reference. ';
		$mbm_post_content .= 'Bookmark this page for future reference. If we launch any products that are even better for your exact skincare needs, they will appear below!"</p></div>';

		// fill RECOMMENDATION object
		$wm_mypost->post_title = $_gdc_fname. '-' . $_gdc_sname . '-' . rand(1,100000);
		$wm_mypost->post_content = $mbm_post_content;
		$wm_mypost->post_status = 'publish';
		$wm_mypost->post_author = 1;
		$wm_mypost->post_type = 'recommendation';
		$wm_mypost->comment_status = 'closed';

		// feed object to wp_insert_post
		//wp_insert_post($wm_mypost);

		global $recommendation_post_id;
		$recommendation_post_id = wp_insert_post($wm_mypost);

		add_post_meta($recommendation_post_id, '_cmb_first_name', $_gdc_fname, true);
		add_post_meta($recommendation_post_id, '_cmb_last_name', $_gdc_sname, true);
		add_post_meta($recommendation_post_id, '_cmb_sex', $_gdc_sex, true);
		add_post_meta($recommendation_post_id, '_cmb_age', $_gdc_age, true);
		add_post_meta($recommendation_post_id, '_cmb_add1', $_gdc_address1, true);
		add_post_meta($recommendation_post_id, '_cmb_add2', $_gdc_address2, true);
		add_post_meta($recommendation_post_id, '_cmb_add3', $_gdc_address3, true);
		add_post_meta($recommendation_post_id, '_cmb_add4', $_gdc_address4, true);
		add_post_meta($recommendation_post_id, '_cmb_add5', $_gdc_address5, true);
		add_post_meta($recommendation_post_id, '_cmb_email', $_gdc_email, true);
		add_post_meta($recommendation_post_id, '_cmb_sensitivity', $_gdc_sensitivity, true);
		add_post_meta($recommendation_post_id, '_cmb_concern', $_gdc_concern, true);
		add_post_meta($recommendation_post_id, '_cmb_skintype', $_gdc_skintype, true);
		if($_gdc_address1){add_post_meta($recommendation_post_id, '_cmb_coupon_id', $mbm_coupon_post_id, true);}
		if($_gdc_address1){add_post_meta($recommendation_post_id, '_cmb_coupon_code', $mbm_coupon_code, true);}

		//add_post_meta($recommendation_post_id, 'This Post ID', $recommendation_post_id, true);

	
	} else{ }

	


// UPDATE HIDDEN FIELD "RECOMMENDATION ID" (ID: 39)...
	
	$lead_id = $entry["id"];
	$update_to = $recommendation_post_id;
	$update_link_to = '<a target="blank" href="' . get_permalink($recommendation_post_id) . '">' . get_the_title($recommendation_post_id) . '</a>';

	$con=mysqli_connect("localhost","g_d_c_2463v8yn9","9pRFUzx6SvQq2Bpl","gdc-new65s461832");
	// Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	else{
		mysqli_query($con,"UPDATE mbm_gdc_rg_lead_detail SET value='$update_to'
		WHERE lead_id=$lead_id AND field_number='39'");
		mysqli_close($con);

		mysqli_query($con,"UPDATE mbm_gdc_rg_lead_detail SET value='$update_link_to'
		WHERE lead_id=$lead_id AND field_number='40'");
		mysqli_close($con);
	}




// REQUIRED FOR ALL FORMS TO WORK ACCROSS THE SITE
	return $entry;
}







// redirect to post
add_action("gform_after_submission_20", "recommendation_redirect", 10, 2);
function recommendation_redirect(){
	global $recommendation_post_id;
	$post_uri = get_permalink( $recommendation_post_id );
	wp_redirect( $post_uri );
	exit;
}




//EMAIL CONTENT FOR FORM ID 20 - AUTOEXPERT
add_filter('gform_notification_20', 'my_gform_notification_signature', 10, 3);
function my_gform_notification_signature( $notification, $form, $entry ) {

	global $post;
	global $_gdc_concern;
	global $_gdc_sensitivity;
	global $_gdc_age;
	global $_gdc_skintype;
	global $_gdc_fname;
	global $_gdc_sname;
	global $_gdc_address1;
	global $_gdc_address2;
	global $_gdc_address3;
	global $_gdc_address4;
	global $_gdc_address5;
	global $_gdc_email;
	global $_gdc_combination;
	global $_gdc_cleanserloop;
	global $_gdc_tonerloop;
	//	global $_gdc_exfoliatorloop;
	global $_gdc_dailytreatmentloop;
	global $_gdc_eyetreatmentloop;

	global $mbm_coupon_post_id;
	$mbm_coupon_code = get_the_title($mbm_coupon_post_id);
	global $recommendation_post_id;
	global $_gdc_sex;

	$rec_page_id = get_queried_object_id();

	$_gdc_samples = $entry["36"];


	// MALE
	if ($_gdc_sex === 'male'){ $_gdc_taxonomy = $_gdc_sex . '_' . $_gdc_skintype; }
	// FEMALE
	else { $_gdc_taxonomy = $_gdc_skintype;}



// GENERATE PRODUCT LOOPS BASED ON USER SUMBITTED ENTRIES
	require_once('product_loops.php');
	wp_reset_query();
	


	// DEFINE CUSTOMER EMAIL CONTENT
	if($notification["name"] == "Your Personal Recommendation"){
		require_once('customer_email.php');
		$notification['message'] = $_gdc_email_body;
	    return $notification;
	}




	// DEFINE ADMIN EMAIL CONTENT
	else if($notification["name"] == "Warehouse Notification"){

		if ($_gdc_samples === 'yes'){
			require_once('admin_email.php');
			$notification['message'] = $_gdc_email_body;
		    return $notification;
		}else{}


	}



	// RETURN EMAIL CONTENT FOR ALL EMAILS
} // END gform_notification_20
?>