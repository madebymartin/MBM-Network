<?php
// http://www.gravityhelp.com/documentation/page/Gform_pre_render#Example_3
add_filter("gform_pre_render_41", "populate_account_manager_dropdown");
function populate_account_manager_dropdown($form){

	$fields_to_cap = array('input_2');
    foreach ($fields_to_cap as $each) {
            // for each field, convert the submitted value to uppercase and assign back to the POST variable
            // the rgpost function strips slashes
            $_POST[$each] = strtoupper(rgpost($each));
    }



	foreach ( $form['fields'] as &$field ) { 
    	if($field->id == 2){ $acc_no = rgpost( 'input_' . $field->id ); }
    }


    $args_marching_accounts = array(
		'post_type'			=> 'sm-location',
		'post_status' 		=> array('publish', 'draft'),
        'posts_per_page' => -1,
        'meta_query' => array(
			array(
				'key'     => 'cmb_spa_account_number',
				'compare' => '=',
				'value'	  => $acc_no
			),
		),
	);
	$matching_accounts = new WP_Query( $args_marching_accounts );
	$salons_array = array();

	while ( $matching_accounts->have_posts() ) : $matching_accounts->the_post();
		$salons_array[] = get_the_title( get_the_ID() );
	endwhile;
	$existing_account_list = implode(", ", $salons_array);


	$message = '';
	if(empty($salons_array)){ 
		$account_exists = 'no';
		$show_field = 'show';
	}else{
		$account_exists = 'yes';
		$show_field = 'hide';
		$message = 'Account Number ' . $acc_no . ' already exists: ' . $existing_account_list . '.<br>Please use a different account number.';
	}

    // Define account number validation message
    

	// Define account manager drop down options - text & value
	$choices = array();
	$acc_managers = get_posts(array(
        'post_type' => 'account_manager',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
        )
    );
    foreach($acc_managers as $acc_manager){
        $choices[] = array('text' => $acc_manager->post_title, 'value' => $acc_manager->ID);
    }


	// Hide Submit button if account number already exists
	$form["button"]["conditionalLogic"]["rules"]["0"]["fieldId"] = '2';
	$form["button"]["conditionalLogic"]["rules"]["0"]["logicType"] = 'all';
	$form["button"]["conditionalLogic"]["rules"]["0"]["operator"] = 'isnot';
	$form["button"]["conditionalLogic"]["rules"]["0"]["value"] = '';
	$form["button"]["conditionalLogic"]["actionType"] = $show_field;


	foreach($form['fields'] as &$field){  

		// Hide page 2 fields if account number already exists
        if ( $field->id == "1" || $field->id == "3" || $field->id == "10" ) {
			//$html_content .= print_r($field); 
			$field->conditionalLogic = 
	        array(
	            'actionType' => $show_field,
	            'logicType' => 'all',
	            'rules' => 
	                array( 
	                	array( 
	                		'fieldId' => 2, 
	                		'operator' => 'isnot', 
	                		'value' => '' 
	            		),

	            	)
	        );  
        }     
	            
        // set drop down options to account managers
        if($field['id'] == '3'){ $field['choices'] = $choices; }

        // set html message content
        if($field['id'] == '16'){ $field->content = $message; }
    }

    //return altered form so changes are displayed
      return $form;  
}



add_filter( 'gform_confirmation', 'salon_added_confirmation', 10, 4 );
function salon_added_confirmation( $confirmation, $form, $entry, $ajax ) {
    if( $form['id'] == '41' ) {
    	$Salon_name = $entry["1"];
    	$acc_no = $entry["2"];
    	$add_to_spa_finder = $entry["10"];

    	$confirmation = '';
        $confirmation .= $Salon_name .' has been added.<br>';
        if( $add_to_spa_finder == "Yes" ){ $confirmation .= 'It will appear on the spa finder within 2 working days.<br>'; }
        $confirmation .= '<br><a class="button" href="https://germaine-de-capuccini.co.uk/management/?report=8">Add another</a>';
    } 
    return $confirmation;
}













?>