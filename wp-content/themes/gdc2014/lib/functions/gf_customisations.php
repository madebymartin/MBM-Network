<?php

// TRADE REGISTRATION FORM NOTIFICATION
add_filter('gform_notification_28', 'gdc_trade_registration_notification', 10, 3);
function gdc_trade_registration_notification( $notification, $form, $entry ) {

    if($notification["name"] == "Admin Notification"){

        $mbm_acc_no = $entry['3'];

        $salon_loop = new WP_Query( array( 
            'post_type' => 'sm-location', 
            'posts_per_page' => 1,
            'orderby' => 'title', 
            'order' => 'ASC',
            'post_status' => array('publish', 'draft'),
            'meta_query' => array(
               array(
                   'key' => 'cmb_spa_account_number',
                   'value' => $mbm_acc_no,
                   'compare' => 'IN',
                   )
                )
            ) 
        );
        while ( $salon_loop->have_posts() ) : $salon_loop->the_post(); 
            $salon_name = get_the_title();
            $salon_id = get_the_id();
            $salon_acc_no = get_post_meta(get_the_id(), 'cmb_spa_account_number', true);
            $salonaddress = get_post_meta(get_the_id(), 'location_address', true);
            $salonaddress2 = get_post_meta(get_the_id(), 'location_address2', true);
            $saloncity = get_post_meta(get_the_id(), 'location_city', true);
            $saloncounty = get_post_meta(get_the_id(), 'location_state', true);
            $salonpostcode = get_post_meta(get_the_id(), 'location_zip', true);
            $salonphone = get_post_meta(get_the_id(), 'location_phone', true);
            $salonemail = get_post_meta(get_the_id(), 'location_email', true);
            $salon_acc_manager_id = get_post_meta(get_the_id(), 'cmb_spa_acc_manager', true);
            $salon_acc_manager = get_the_title($salon_acc_manager_id);
        endwhile;

        $email = $entry['2'];
        $phone = $entry['16'];
        $dob = $entry['14'];
        $role = $entry['8'];
        $fave_product = $entry['20'];
        $username = $entry['5'];
        $user = get_user_by( 'login', $username );
        $user_id = $user->ID;

    //  $firstname = $user->first_name;
    //  $surname = $user->last_name;
        $firstname = $entry['24'];
        $surname = $entry['25'];


        $needs_more_training = $entry['15'];

        $training_products = $entry['19.1'];
        $training_face_initial = $entry['19.2'];
        $training_face_advanced = $entry['19.3'];
        $training_spa_body_foundation = $entry['19.4'];
        $training_spa_body_rituals = $entry['19.5'];
        $training_holistic_obsidian = $entry['19.6'];
        $training_perfect_forms = $entry['19.7'];
        $training_kobido = $entry['19.8'];
        $training_spa_concept = $entry['19.9'];
        $training_efficy = $entry['19.10'];



        $notification['message'] = '';

        $notification['message'] .= '<b>name: ' . $firstname . ' ' . $surname . '</b><br>';
        $notification['message'] .= '(' . $role . ' at ' . $salon_name . ')<br>';
        $notification['message'] .= 'WEBSITE USERNAME: <b>' . $username . '</b><br><br>';
    //    $notification['message'] .= 'WEBSITE USERNAME: <b><a href="' . get_edit_user_link( $user_id ) . '">' . $username . '</a></b><br><br>';
        $notification['message'] .= 'Phone: ' . $phone . '<br>';
        $notification['message'] .= 'Email: ' . $email . '<br>';
        $notification['message'] .= 'DOB: ' . $dob . '<br>';
        $notification['message'] .= '<br><hr><br>';


        $notification['message'] .= '<b>Salon Details:</b><br>' . $salon_name . '<br>';
        if($salonaddress){$notification['message'] .= $salonaddress . '<br>';}
        if($salonaddress2){$notification['message'] .= $salonaddress2 . '<br>';}
        $notification['message'] .= $saloncity . '<br>';
        $notification['message'] .= $saloncounty . '<br>';
        $notification['message'] .= $salonpostcode . '<br><br>';

        $notification['message'] .= 'Salon Telephone: <b>' . $salonphone . '</b><br>';
        $notification['message'] .= 'Salon Email: <b><a href="mailto:' . $salonemail . '">' . $salonemail . '</a></b><br>';
        $notification['message'] .= 'Account Manager: ' . $salon_acc_manager . '<br><br><hr><br>';
        
        $notification['message'] .= 'Favourite Product: ' . $fave_product . '<br>';

        $notification['message'] .= '<br><br><b>Training Completed:</b><br><ul>';
        if($training_products){$notification['message'] .= '<li>' . $training_products . '</li>';}
        if($training_face_initial){$notification['message'] .= '<li>' . $training_face_initial . '</li>';}
        if($training_face_advanced){$notification['message'] .= '<li>' . $training_face_advanced . '</li>';}
        if($training_spa_body_foundation){$notification['message'] .= '<li>' . $training_spa_body_foundation . '</li>';}
        if($training_spa_body_rituals){$notification['message'] .= '<li>' . $training_spa_body_rituals . '</li>';}
        if($training_holistic_obsidian){$notification['message'] .= '<li>' . $training_holistic_obsidian . '</li>';}
        if($training_perfect_forms){$notification['message'] .= '<li>' . $training_perfect_forms . '</li>';}
        if($training_kobido){$notification['message'] .= '<li>' . $training_kobido . '</li>';}
        if($training_spa_concept){$notification['message'] .= '<li>' . $training_spa_concept . '</li>';}
        if($training_efficy){$notification['message'] .= '<li>' . $training_efficy . '</li>';}
        $notification['message'] .= '</ul>';

        if($needs_more_training == 'Yes'){$notification['message'] .= '<b>' . $firstname . ' feels that he/she needs more training.</b>';}


    //  $notification['message'] .= 'Username: ' . $username . '<br>';  
    //  $notification['message'] .= 'User ID: ' . $user_id . '<br>';

                


    }
    return $notification;
}






// CONTACT ACCOUNT MANAGER FORM - SENDS TO CORRECT ACC MANAGER
add_filter('gform_notification_31', 'gdc_contact_acc_manager', 10, 3);
function gdc_contact_acc_manager( $notification, $form, $entry ) {

    $current_user = wp_get_current_user();
    $currentuserid = get_current_user_id();

    // Find connected pages
    $connected_salon = new WP_Query( array(
      'connected_type' => 'salon_staff',
      'post_status' => array('publish', 'draft'),
      'connected_items' => $currentuserid,
      'nopaging' => true,
    ) );

    // DEFINE VARIABLES BASED ON CONNECT SALON
    if ( $connected_salon->have_posts() ) {
        while ( $connected_salon->have_posts() ) : $connected_salon->the_post();
            $salon_object = $connected_salon->post;
            $salon_id = $salon_object->ID;
            $accountnumber = get_post_meta(get_the_ID($salon_id), 'cmb_spa_account_number', true);
            $salon_name = get_the_title($salon_id);
            $salon_account_manager_id = get_post_meta(get_the_ID($salon_id), 'cmb_spa_acc_manager', true);
            $salon_account_manager_email = get_post_meta($salon_account_manager_id, '_cmb_acc_man_email', true);
            $notification['to'] = $salon_account_manager_email;
        endwhile;
        // Prevent weirdness
        wp_reset_postdata();
    }
    $notification['from'] = $current_user->user_firstname . ' ' . $current_user->user_lastname . ' ' . $salon_name;
    $notification['replyTo'] = $current_user->user_email;
    $notification['subject'] = 'Trade message: ' . $salon_name;
    $notification['message'] = $entry['1'];
    $notification['message'] .= '<hr>';
    $notification['message'] .= 'From: ' . $current_user->user_firstname . ' ' . $current_user->user_lastname;
    $notification['message'] .= '<br>Email: <a href="mailto:' . $current_user->user_email . '">' . $current_user->user_email . '</a>';
    $notification['message'] .= '<br>Account: ' . $accountnumber;
    $notification['message'] .= '<br>' . $salon_name;
    return $notification;
}






// Trade order notification filter - inserts trade customers account number etc into admin notification
add_filter('gform_notification_27', 'gdc_order_art_beauty_collection', 10, 3);
function gdc_order_art_beauty_collection( $notification, $form, $entry ) {

    $current_user = wp_get_current_user();
    $currentuserid = get_current_user_id();
    $accountnumber = get_user_meta($currentuserid, 'accountnumber');
    $accountname =  get_user_meta($currentuserid, 'accountname');
    $firstname = get_user_meta($currentuserid, 'first_name');
    $surname = get_user_meta($currentuserid, 'last_name');
    $telephone = get_user_meta($currentuserid, 'accountphone');

    $_gdc_order_form_email = "<br><br>"; //initialize your variable
    $_gdc_order_form_email .='Account Number: ' . $accountnumber['0'] . '<br>';
    $_gdc_order_form_email .='Salon / Spa Name: ' . $accountname['0'] . '<br>';
    $_gdc_order_form_email .='Telephone: ' . $telephone['0'] . '<br>';
    $_gdc_order_form_email .='Name: ' . $firstname['0'] . ' ' . $surname['0'] . '<br><br><br>';

    $notification['message'] .= $_gdc_order_form_email;
    return $notification;
}





// Trade order notification filter - inserts trade customers account number etc into admin notification
add_filter('gform_notification_26', 'gdc_preorder_cplus_email', 10, 3);
function gdc_preorder_cplus_email( $notification, $form, $entry ) {

    $current_user = wp_get_current_user();
    $currentuserid = get_current_user_id();
    $accountnumber = get_user_meta($currentuserid, 'accountnumber');
    $accountname =  get_user_meta($currentuserid, 'accountname');
    $firstname = get_user_meta($currentuserid, 'first_name');
    $surname = get_user_meta($currentuserid, 'last_name');
    $telephone = get_user_meta($currentuserid, 'accountphone');

    $_gdc_order_form_email = ""; //initialize your variable
    $_gdc_order_form_email .='Account Number: ' . $accountnumber['0'] . '<br>';
    $_gdc_order_form_email .='Salon / Spa Name: ' . $accountname['0'] . '<br>';
    $_gdc_order_form_email .='Telephone: ' . $telephone['0'] . '<br>';
    $_gdc_order_form_email .='Name: ' . $firstname['0'] . ' ' . $surname['0'] . '<br><br><br>';
    $_gdc_order_form_email .= '<h3>Please put me down for a pre order of the new Timexpert C+ A.G.E Products!</h3>';

    $notification['message'] = $_gdc_order_form_email;
    return $notification;
}





// Trade order notification filter - inserts trade customers account number etc into admin notification
add_filter('gform_notification_25', 'gdc_order_form_upload_email', 10, 3);
function gdc_order_form_upload_email( $notification, $form, $entry ) {

    $current_user = wp_get_current_user();
    $currentuserid = get_current_user_id();
    $all_user_meta = get_user_meta($currentuserid);
    $accountname =  get_user_meta($currentuserid, 'accountname');
    $firstname = get_user_meta($currentuserid, 'first_name');
    $surname = get_user_meta($currentuserid, 'last_name');
    $telephone = get_user_meta($currentuserid, 'accountphone');
    $orderform = $entry["2"];
    $comments = $entry["3"];

    // Find connected pages
    $connected_salon = new WP_Query( array(
      'connected_type' => 'salon_staff',
      'post_status' => array('publish', 'draft'),
      'connected_items' => $currentuserid,
      'nopaging' => true,
    ) );

    // DEFINE VARIABLES BASED ON CONNECT SALON
    if ( $connected_salon->have_posts() ) {
        while ( $connected_salon->have_posts() ) : $connected_salon->the_post();
            $salon_object = $connected_salon->post;
            $salon_id = $salon_object->ID;
            $accountnumber = get_post_meta(get_the_ID($salon_id), 'cmb_spa_account_number', true);
            $salon_name = get_the_title($salon_id);
            $salon_account_manager_id = get_post_meta(get_the_ID($salon_id), 'cmb_spa_acc_manager', true);
            $salon_account_manager_email = get_post_meta($salon_account_manager_id, '_cmb_acc_man_email', true);
            $notification['to'] = $salon_account_manager_email;
        endwhile;
        // Prevent weirdness
        wp_reset_postdata();
    }



    $_gdc_order_form_email = ""; //initialize your variable
    $_gdc_order_form_email .='Account Number: ' . $accountnumber . '<br>';
    $_gdc_order_form_email .='Salon / Spa Name: ' . $salon_name . '<br>';
    $_gdc_order_form_email .='Telephone: ' . $telephone['0'] . '<br>';
    $_gdc_order_form_email .='Name: ' . $firstname['0'] . ' ' . $surname['0'] . '<br>';
    $_gdc_order_form_email .= '<br><b>Please see the order attached.</b><br>';
    $_gdc_order_form_email .= '<br><h3>Customer comments:</h3>' . $comments;

    $notification['message'] = $_gdc_order_form_email;



    $fileupload_fields = GFCommon::get_fields_by_type( $form, array( 'fileupload' ) );

    if(!is_array($fileupload_fields))
        return $notification;

    $attachments = array();
    $upload_root = RGFormsModel::get_upload_root();
    foreach( $fileupload_fields as $field ) {
        $url = $entry[ $field['id'] ];
        $attachment = preg_replace( '|^(.*?)/gravity_forms/|', $upload_root, $url );
        if ( $attachment ) {
            $attachments[] = $attachment;
        }
    }

    $notification['attachments'] = $attachments;




    return $notification;
}
?>