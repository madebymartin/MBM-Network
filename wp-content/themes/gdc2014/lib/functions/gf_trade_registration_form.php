<?php

function my_connection_types_users_salons() {
    p2p_register_connection_type( array(
        'name' => 'salon_staff',
        'from' => 'sm-location',
        'to' => 'user',
    //    'to_query_vars' => array( 'role' => 'trade-customer' ),
        'title' => 'Staff Members',
        )
    );
}
add_action( 'p2p_init', 'my_connection_types_users_salons' );




// http://www.gravityhelp.com/documentation/page/Gform_pre_render#Example_3
add_filter("gform_pre_render_28", "populate_html");
function populate_html($form){

    $fields_to_cap = array('input_3');
        foreach ($fields_to_cap as $each) {
                // for each field, convert the submitted value to uppercase and assign back to the POST variable
                // the rgpost function strips slashes
                $_POST[$each] = strtoupper(rgpost($each));
        }       

    $current_page = GFFormDisplay::get_current_page($form["id"]);
    $html_content = "";

    foreach($form["fields"] as &$field)
    {
        //gather form data from field 3 to save into html field (id 11), exclude page break
        if ($field["id"] == 3 && $field["type"] != "page") { $mbm_acc_no = rgpost('input_' . $field['id']); }

    }


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
    endwhile;



if ($current_page == 1){
    
}


    if ($current_page == 2){

        $html_content .= 'Account number: ' . $mbm_acc_no . '<br>';

        if($salon_name){
            //$html_content .= 'Please confirm that you work at ' . $salon_name;
        } else{
            $html_content .= 'No Salon Matching that Account Number';
        }
    //    $html_content .= '<br>Verified Value: ' . $mbm_ver . '<br>';


        foreach($form["fields"] as &$field)
        { //get html field
            if ($field["id"] == 11){ $field["content"] = '<b>' . $html_content . '</b>'; }
        }

        if($salon_name){

        }
        else{
            foreach($form["fields"] as &$field){ 
            /*    $field["conditionalLogic"] = array(
                    'actionType' => 'hide',
                    'rules' => array(
                        'fieldId' => '1',
                        'operator' => 'isnot',
                        'value' => '1',
                        ),
                );
            */
                $field["cssClass"] = 'hidden';
            }
            $form["cssClass"] = "hidden";
            echo '<div id="gf_page_steps_28" class="gf_page_steps">';
                echo '<div id="gf_step_28_1" class="gf_step gf_step_active gf_step_first"><span class="gf_step_number">1</span>&nbsp;Account Number</div>';
                echo '<div id="gf_step_28_2" class="gf_step gf_step_next gf_step_pending"><span class="gf_step_number">2</span>&nbsp;Personal Information</div>';
                echo '<div id="gf_step_28_3" class="gf_step gf_step_last gf_step_pending"><span class="gf_step_number">3</span>&nbsp;Professional Information</div>';
                echo '<div class="gf_step_clear"></div>';
            echo '</div>';
            echo '<h2 class="gfield_description validation_message" >Sorry, that account number does not appear to be valid</h2>';
            echo '<a class="button gform_previous_button" href="">Please correct your account number</a>';
        }
    }



    if ($current_page == 3){

        $html_content .= 'Account number: ' . $mbm_acc_no . '<br>';

        if($salon_name){
            $html_content .= 'Account name: ' . $salon_name;
        } else{
            $html_content .= 'No Salon Matching that Account Number';
        }
    //    $html_content .= '<br>Verified Value: ' . $mbm_ver . '<br>';


        foreach($form["fields"] as &$field)
        { //get html field
            if ($field["id"] == 13){ $field["content"] = '<b>' . $html_content . '</b>'; }
        }
    }




    //return altered form so changes are displayed
      return $form;  
}






// Confirm Salon Dropdown
add_filter('gform_pre_render', 'populate_confirm_dropdown');
function populate_confirm_dropdown($form){
    
    foreach($form['fields'] as &$field){   

        if($field["id"] == 3 && $field["type"] != "page") { 
            $mbm_acc_no = rgpost('input_' . $field['id']); 
        }   

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
        endwhile;

        if($field["id"] == 26 && $field["type"] != "page") { 
            $field['defaultValue'] = $salon_name;
        }


        if($field['type'] != 'radio' || strpos($field['cssClass'], 'confirm-salon') === false)
            continue;


        
        // update 'Select a Post' to whatever you'd like the instructive option to be
        $choices = array(array('text' => 'Select a Product', 'value' => ' '));
        $choices[0] = array('text' => 'text1', 'value' => 'value1');
        $choices[1] = array('text' => 'text2', 'value' => 'value2');
        
       // $field['choices'] = $choices;  
        $field['label'] = 'Please confirm you work for ' . $salon_name;

    }


    return $form;
}





// Product Dropdown - auto populated
add_filter('gform_pre_render', 'populate_posts');
function populate_posts($form){
    
    foreach($form['fields'] as &$field){      
        if($field['type'] != 'select' || strpos($field['cssClass'], 'populate-posts') === false)
            continue;

        // you can add additional parameters here to alter the posts that are retreieved
        // more info: http://codex.wordpress.org/Template_Tags/get_posts
        $posts = get_posts(array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'numberposts' => -1,
            'orderby' => 'title',
            'order' => 'ASC',
            'tax_query' => array(
                'relation' => 'AND',
                    array(
                        'taxonomy' => 'product_cat',
                        'field' => 'slug',
                        'terms' => 'samples',
                        'operator' => 'NOT IN',
                    ),
                    array(
                        'taxonomy' => 'product_cat',
                        'field' => 'slug',
                        'terms' => 'spa-vouchers',
                        'operator' => 'NOT IN',
                    )
                )
            )
        );
        
        // update 'Select a Post' to whatever you'd like the instructive option to be
        $choices = array(array('text' => 'Select a Product', 'value' => ' '));
        
        foreach($posts as $post){
            $choices[] = array('text' => $post->post_title, 'value' => $post->post_title);
        }
        $field['choices'] = $choices;  
    }
    return $form;
}




add_action("gform_user_registered", "add_custom_user_meta", 10, 4);
function add_custom_user_meta($user_id, $config, $entry, $user_pass) {

    $fields_to_cap = array('input_3');
        foreach ($fields_to_cap as $each) {
                // for each field, convert the submitted value to uppercase and assign back to the POST variable
                // the rgpost function strips slashes
                $_POST[$each] = strtoupper(rgpost($each));
    }

    $mbm_acc_no = $entry["3"];
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
        $salon_post_id = get_the_id();
        $salon_name = get_the_title();
        $salon_acc_number = get_post_meta('cmb_spa_account_number');
    endwhile;
        
    update_user_meta( $user_id, 'accountname', $salon_name);
    update_user_meta( $user_id, 'accountnumber', $salon_acc_number);


    //  update_user_meta($user_id, 'user_confirmation_number', $entry[1]);
        $from = $salon_post_id;
        $to = $user_id;
        $role = $entry[8];
        p2p_type( 'salon_staff' )->connect( $from, $to, array(
    //    'date' => current_time('mysql'),
    //    'role' => $role,
    ) ); 
}


?>