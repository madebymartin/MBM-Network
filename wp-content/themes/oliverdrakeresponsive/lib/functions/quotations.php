<?php
/*  FUNCTIONS TO CREATE ALL FUNCTIONALITY FOR GRAVITY FORMS (FORM ID 2) QUOTATIONS, INCLUDING CUSTOM POST TYPS, CUSTOM USER META ETC */


/* ADDING / EDITING USERS IS HANDLED USING THE USER REGISTRATION EXTENSION. */
add_role( 'customer', 'Customer', 'Subscriber' );


// User/Customer Dropdown - auto populated
add_filter('gform_pre_render', 'populate_posts');
function populate_posts($form){

    foreach($form['fields'] as &$field){      
        if($field['type'] != 'select' || strpos($field['cssClass'], 'users') === false)
            continue;

        $users = get_users( 
            array(
            'role'         => 'customer',
            'meta_key'     => '',
            'meta_value'   => '',
            'meta_compare' => '',
            'meta_query'   => array(),
            'date_query'   => array(),        
            'include'      => array(),
            'exclude'      => array(),
            'orderby'      => 'login',
            'order'        => 'ASC',
            'offset'       => '',
            'search'       => '',
            'number'       => '',
            'count_total'  => false,
            'fields'       => 'all',
            'who'          => ''
            )
        );

        // update 'Select a Post' to whatever you'd like the instructive option to be
        $choices = array(
            array('text' => 'Choose Customer', 'value' => ' '),
            array('text' => 'Add New', 'value' => 'Add New'),
        );

        foreach($users as $user){
            $choices[] = array('text' => esc_html( $user->display_name ), 'value' => esc_html( $user->ID ) );
        }
        $field['choices'] = $choices; 
    }
    return $form;
}


// set content of html field to show confirmation of user details - either from existing user id (field1) or newly added user..
add_filter( 'gform_pre_render_2', 'populate_html' );
function populate_html( $form ) {
    //this is a 2-page form with the data from page one being displayed in an html field on page 2
    $current_page = GFFormDisplay::get_current_page( $form['id'] );
    $html_content = "";
    if ( $current_page == 2 ) {
        foreach ( $form['fields'] as &$field ) {
            //gather form data to save into html field (id 3 on my form), exclude page break
            if ( $field->id != 9 && $field->type != 'page' ) {

            	if($field->id == 1){ $customerid = rgpost( 'input_' . $field->id ); }

            }
        }
        $user_info = get_userdata($customerid);

        //$html_content .= 'customer ID: ' . $customerid;
        $html_content .= '<b>' . $user_info->display_name . '</b>';
        if($user_info->address1){$html_content .= '<br>' .$user_info->address1;}
        if($user_info->address2){$html_content .= '<br>' .$user_info->address2;}
        if($user_info->town){$html_content .= '<br>' .$user_info->town;}
        if($user_info->county){$html_content .= '<br>' .$user_info->county;}
        if($user_info->postcode){$html_content .= '<br>' .$user_info->postcode;}
        $html_content .= '<hr>';
        if($user_info->user_email){$html_content .= '<br>Email: ' . $user_info->user_email;}
        if($user_info->phone){$html_content .= '<br>Phone: ' . $user_info->phone;}


        //loop back through form fields to get html field (id 3 on my form) that we are populating with the data gathered above
        foreach( $form['fields'] as &$field ) {

            //get html field
            if ( $field->id == "9" ) {
                //set the field content to the html
                $field->content = $html_content;
            }

        }
    }







    if ( $current_page == 4 ) {

        foreach ( $form['fields'] as &$field ) {
            //gather form data to save into html field (id 3 on my form), exclude page break
            if($field->id == 2){ 
                 $quote_items = rgpost( 'input_' . $field->id ); 
            }
        }

        foreach ( $form['fields'] as &$field ) {
            //gather form data to save into html field (id 3 on my form), exclude page break
            if($field->id == "11"){ 
                 $project_name = rgpost( 'input_' . $field->id ); 
            }
        }

        $html_content = '';
        $total = 0;
        $count = 0;

        $html_content .= '<h3>Quotation: <b>' . $project_name . '</b></h3>';

        $html_content .= '<table style="width:100%;"><tr class="header-row"><td><b>Description</b></td><td><b>Amount</b></td></tr>';
        foreach($quote_items as $key => $val){

            if ($key % 2 == 0) {
              $html_content .= '<tr><td>' . $val . '</td>';
            }
            else{
                $html_content .= '<td>£' . $val . '</td></tr>';
                $total += $val;
            }
            $total2dp = number_format($total, 2, '.', '');
           // $html_content .= $key . ' = ' . $val . '<hr>';
        }
        $html_content .= '<tr class="footer-row"><td><b>Total</b></td><td><b>£' . $total2dp . '</b></td></tr></table>';

        //loop back through form fields to get html field (id 3 on my form) that we are populating with the data gathered above
        foreach( $form['fields'] as &$field ) {

            //get html field
            if ( $field->id == "14" ) {
                //set the field content to the html
                $field->content = $html_content;
            }
        }
    }



    //return altered form so changes are displayed
    return $form;       
}



// CUSTOM CONFIRMATION - SOON TO INCLUDE DETAILS OF SENT QUOTE
add_filter( 'gform_confirmation_2', 'custom_confirmation', 10, 4 );
function custom_confirmation( $confirmation, $form, $entry, $ajax ) {

    $confirmation = 'Quotation Sent!<br><a class="button" href="http://oliverdrake.plumbing/quotations/">Send another</a>';
    return $confirmation;
}


// CHANGE LIST FIELD (COLUMN 1) TO TEXTAREA
add_filter( 'gform_column_input_content_2_2_1', 'change_column1_content', 10, 6 );
function change_column1_content( $input, $input_info, $field, $text, $value, $form_id ) {
    //build field name, must match List field syntax to be processed correctly
    $input_field_name = 'input_' . $field->id . '[]';
    $tabindex = GFCommon::get_tabindex();
    $new_input = '<textarea name="' . $input_field_name . '" ' . $tabindex . ' class="textarea medium" cols="50" rows="10">' . $value . '</textarea>';
    return $new_input;
}



//MIGHT NOT NEED THIS BUT LEFT FOR NOW...
/**
* Better Pre-submission Confirmation
* http://gravitywiz.com/2012/08/04/better-pre-submission-confirmation/
*/
class GWPreviewConfirmation {
    private static $lead;
    public static function init() {
        add_filter( 'gform_pre_render', array( __class__, 'replace_merge_tags' ) );
    }
    public static function replace_merge_tags( $form ) {
        $current_page = isset(GFFormDisplay::$submission[$form['id']]) ? GFFormDisplay::$submission[$form['id']]['page_number'] : 1;
        $fields = array();
        // get all HTML fields on the current page
        foreach($form['fields'] as &$field) {
            // skip all fields on the first page
            if(rgar($field, 'pageNumber') <= 1)
                continue;
            $default_value = rgar($field, 'defaultValue');
            preg_match_all('/{.+}/', $default_value, $matches, PREG_SET_ORDER);
            if(!empty($matches)) {
                // if default value needs to be replaced but is not on current page, wait until on the current page to replace it
                if(rgar($field, 'pageNumber') != $current_page) {
                    $field['defaultValue'] = '';
                } else {
                    $field['defaultValue'] = self::preview_replace_variables($default_value, $form);
                }
            }
            // only run 'content' filter for fields on the current page
            if(rgar($field, 'pageNumber') != $current_page)
                continue;
            $html_content = rgar($field, 'content');
            preg_match_all('/{.+}/', $html_content, $matches, PREG_SET_ORDER);
            if(!empty($matches)) {
                $field['content'] = self::preview_replace_variables($html_content, $form);
            }
        }
        return $form;
    }
    /**
    * Adds special support for file upload, post image and multi input merge tags.
    */
    public static function preview_special_merge_tags($value, $input_id, $merge_tag, $field) {
        
        // added to prevent overriding :noadmin filter (and other filters that remove fields)
        if( ! $value )
            return $value;
        
        $input_type = RGFormsModel::get_input_type($field);
        
        $is_upload_field = in_array( $input_type, array('post_image', 'fileupload') );
        $is_multi_input = is_array( rgar($field, 'inputs') );
        $is_input = intval( $input_id ) != $input_id;
        
        if( !$is_upload_field && !$is_multi_input )
            return $value;
        // if is individual input of multi-input field, return just that input value
        if( $is_input )
            return $value;
            
        $form = RGFormsModel::get_form_meta($field['formId']);
        $lead = self::create_lead($form);
        $currency = GFCommon::get_currency();
        if(is_array(rgar($field, 'inputs'))) {
            $value = RGFormsModel::get_lead_field_value($lead, $field);
            return GFCommon::get_lead_field_display($field, $value, $currency);
        }
        switch($input_type) {
        case 'fileupload':
            $value = self::preview_image_value("input_{$field['id']}", $field, $form, $lead);
            $value = self::preview_image_display($field, $form, $value);
            break;
        default:
            $value = self::preview_image_value("input_{$field['id']}", $field, $form, $lead);
            $value = GFCommon::get_lead_field_display($field, $value, $currency);
            break;
        }
        return $value;
    }
    public static function preview_image_value($input_name, $field, $form, $lead) {
        $field_id = $field['id'];
        $file_info = RGFormsModel::get_temp_filename($form['id'], $input_name);
        $source = RGFormsModel::get_upload_url($form['id']) . "/tmp/" . $file_info["temp_filename"];
        if(!$file_info)
            return '';
        switch(RGFormsModel::get_input_type($field)){
            case "post_image":
                list(,$image_title, $image_caption, $image_description) = explode("|:|", $lead[$field['id']]);
                $value = !empty($source) ? $source . "|:|" . $image_title . "|:|" . $image_caption . "|:|" . $image_description : "";
                break;
            case "fileupload" :
                $value = $source;
                break;
        }
        return $value;
    }
    public static function preview_image_display($field, $form, $value) {
        // need to get the tmp $file_info to retrieve real uploaded filename, otherwise will display ugly tmp name
        $input_name = "input_" . str_replace('.', '_', $field['id']);
        $file_info = RGFormsModel::get_temp_filename($form['id'], $input_name);
        $file_path = $value;
        if(!empty($file_path)){
            $file_path = esc_attr(str_replace(" ", "%20", $file_path));
            $value = "<a href='$file_path' target='_blank' title='" . __("Click to view", "gravityforms") . "'>" . $file_info['uploaded_filename'] . "</a>";
        }
        return $value;
    }
    /**
    * Retrieves $lead object from class if it has already been created; otherwise creates a new $lead object.
    */
    public static function create_lead( $form ) {
        
        if( empty( self::$lead ) ) {
            self::$lead = GFFormsModel::create_lead( $form );
            self::clear_field_value_cache( $form );
        }
        
        return self::$lead;
    }
    public static function preview_replace_variables( $content, $form ) {
        $lead = self::create_lead($form);
        // add filter that will handle getting temporary URLs for file uploads and post image fields (removed below)
        // beware, the RGFormsModel::create_lead() function also triggers the gform_merge_tag_filter at some point and will
        // result in an infinite loop if not called first above
        add_filter('gform_merge_tag_filter', array('GWPreviewConfirmation', 'preview_special_merge_tags'), 10, 4);
        $content = GFCommon::replace_variables($content, $form, $lead, false, false, false);
        // remove filter so this function is not applied after preview functionality is complete
        remove_filter('gform_merge_tag_filter', array('GWPreviewConfirmation', 'preview_special_merge_tags'));
        return $content;
    }
    
    public static function clear_field_value_cache( $form ) {
        
        if( ! class_exists( 'GFCache' ) )
            return;
            
        foreach( $form['fields'] as &$field ) {
            if( GFFormsModel::get_input_type( $field ) == 'total' )
                GFCache::delete( 'GFFormsModel::get_lead_field_value__' . $field['id'] );
        }
        
    }
}
GWPreviewConfirmation::init();




//add_action("gform_after_submission_2", "create_quote_from_submission", 10, 2);
//add_action("gform_entry_post_save", "create_quote_from_submission", 10, 2);
/*function create_quote_from_submission($entry, $form){

    $submitted_email = ($entry[4]);
    $new_user_name = $submitted_email;
    $existing_customer_id = ($entry[1]);
    $project_title = ($entry[11]);
    $new_user_firstname = ($entry[1.3]);
    $new_user_lastname = ($entry[1.6]);
    $new_user_phone = ($entry[5]);
    $new_user_address1 = ($entry[6.1]);
    $new_user_address2 = ($entry[6.2]);
    $new_user_address3 = ($entry[6.3]);
    $new_user_address4 = ($entry[6.4]);
    $new_user_address5 = ($entry[6.5]);
    $quote_items = ($entry[2]);
    $unserialized_items = unserialize($quote_items);

    if($submitted_email){
        // New User Info Entered..

        $user_id = username_exists( $new_user_name );
        if ( !$user_id and email_exists($submitted_email) == false ) {
            $random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );

            // CREATE USER AND GRAB ID
            $user_id = wp_create_user( $new_user_name, $random_password, $submitted_email );

            add_user_meta( $user_id, 'phone', $new_user_phone, true );
            add_user_meta( $user_id, 'address1', $new_user_address1, true );
            add_user_meta( $user_id, 'address2', $new_user_address2, true );
            add_user_meta( $user_id, 'town', $new_user_address3, true );
            add_user_meta( $user_id, 'county', $new_user_address4, true );
            add_user_meta( $user_id, 'postcode', $new_user_address5, true );

        } else {
            $random_password = __('User already exists.  Password inherited.');
        }

    }

    // existing user chosen
    else{$user_id = $existing_customer_id;}
    $user = get_user_by( 'id', $user_id );
    $displayname = $user->display_name;
    $quote_title = $displayname . ' - ' .$project_title;
    $post_content = '';
    $post_content .= print_r($quote_items);

    foreach ($quote_items as $key => $value) {
        $post_content .= $key . ': ' . $value . '<br>';
        # code...
    }

    $post_content .= 'Anything else here yet!?';


    //First need to create the post in its basic form
    $new_doc = array(
        'post_title' => ucwords($quote_title),
        'post_status' => 'publish',
        //'post_date' => date('Y-m-d H:i:s'),
        'post_type' => 'document',
        'post_content' => $post_content,
    );
    //From creating it, we now have its ID
    $quote_id = wp_insert_post($new_doc);
    //Now we add the meta
    $prefix = '_cmb_';

    add_post_meta($quote_id, $prefix . 'customer_id', $user_id, true);

    
    // UPDATE HIDDEN FIELD "RECOMMENDATION ID" (ID: 39)...
    $lead_id = $entry["id"];
    $update_to = $quote_id;
    $update_link_to = '<a target="blank" href="' . get_permalink($quote_id) . '">' . get_the_title($quote_id) . '</a>';

    $con=mysqli_connect("cust-mysql-123-20","oliverdrk","Ol1verDrak3","oliverdrk");
    // Check connection
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    else{
        mysqli_query($con,"UPDATE mbmwp_rg_lead_detail SET value='$update_link_to'
        WHERE lead_id=$lead_id AND field_number='12'");
        mysqli_close($con);

    }

    // REQUIRED FOR ALL FORMS TO WORK ACCROSS THE SITE
    return $entry;
}*/


// CUSTOM NOTIFICATION CONTENT
add_filter( 'gform_notification_2', 'notification_routing', 10, 3 );
function notification_routing( $notification, $form, $entry ) {
    if ( $notification['name'] == 'Customer Email' ) {

        // DEFINE VARIABLES
        $existing_customer_id = ($entry["1"]);
        $existing_userinfo = get_userdata( $existing_customer_id );
        $existing_user = get_user_by( 'id', $existing_customer_id );
        $submitted_name = ($entry["3.3"]) . ' ' . ($entry["3.6"]);
        $submitted_email = ($entry["4"]);
        $submitted_phone = ($entry["5"]);
        $submitted_address = ($entry["6"]);
        $submitted_address1 = ($entry["6.1"]);
        $submitted_address2 = ($entry["6.2"]);
        $submitted_address3 = ($entry["6.3"]);
        $submitted_address4 = ($entry["6.4"]);
        $submitted_address5 = ($entry["6.5"]);
        $project_name = ($entry["11"]);
        $quote_items = ($entry["2"]);
        $custom_message = ($entry["15"]);


        // NEW CUSTOMER ADDED
        if($existing_customer_id === 'Add New'){ 
            $user_email = $submitted_email;
            $user_fullname = $submitted_name;
            $user_phone = $submitted_phone;
            $user_address1 = $submitted_address1;
            $user_address2 = $submitted_address2;
            $user_address3 = $submitted_address3;
            $user_address4 = $submitted_address4;
            $user_address5 = $submitted_address5;

        // EXISTING CUSTOMER CHOSEN
        }else{
            $user_email = $existing_user->user_email;
            $user_fullname = $existing_userinfo->first_name . ' ' . $existing_userinfo->last_name;
            $user_phone = $existing_userinfo->phone;
            $user_address1 = $existing_userinfo->address1;
            $user_address2 = $existing_userinfo->address2;
            $user_address3 = $existing_userinfo->address3;
            $user_address4 = $existing_userinfo->address4;
            $user_address5 = $existing_userinfo->address5;
        }


        $notification['message'] = '';
        if($custom_message){
            $notification['message'] .= $custom_message;
        }else{
            $notification['message'] .= 'Dear ' . $user_fullname . ', thank you for your valued enquiry.<br><br>We are pleased to provide you with our quotation which you will find attached. We hope our quotation will be of interest to you.<br><br>Please do not hesitate to call should you have any questions.
<br><br>Yours faithfully,<br>Oliver Drake<br><br>';
        }

        $notification['message'] .= '<hr><br><img style="width:320px; height:auto;" src="' . get_bloginfo("stylesheet_directory") . '/images/odpah_logo.png" width="320" alt="Oliver Drake Plumbing &amp; Heating"><br><br><br>Mobile: 07974 660992<br><a href="http://oliverdrake.plumbing">www.oliverdrake.plumbing</a><br><small>e: ' . $user_email . '</small>';

        $notification['toType'] = 'email';
        $notification['to'] = $user_email;

    }
    return $notification;
}
?>