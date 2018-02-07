<?php 
if ( is_user_logged_in() ) {
	if ( current_user_can('access_trade_content') ) {

		$current_user = wp_get_current_user();
		$currentuserid = get_current_user_id();
		$usermeta = get_user_meta($current_user);
		$jobrole = esc_attr( get_the_author_meta( 'jobrole', $currentuserid ) );
		$term =	$wp_query->queried_object;

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
				$salon_account_manager = get_the_title($salon_account_manager_id);
				$salon_account_manager_phone = get_post_meta($salon_account_manager_id, '_cmb_acc_man_phone', true);
				$salon_account_manager_email = get_post_meta($salon_account_manager_id, '_cmb_acc_man_email', true);
				$salon_phone = get_post_meta(get_the_ID($salon_id), 'location_phone', true);
				$salon_email = get_post_meta(get_the_ID($salon_id), 'location_email', true);
				$salon_url = get_post_meta(get_the_ID($salon_id), 'location_url', true);
				$salon_address = get_post_meta(get_the_ID($salon_id), 'location_address', true);
				$salon_address2 = get_post_meta(get_the_ID($salon_id), 'location_address2', true);
				$salon_city = get_post_meta(get_the_ID($salon_id), 'location_city', true);
				$salon_county = get_post_meta(get_the_ID($salon_id), 'location_state', true);
				$salonpostcode = get_post_meta(get_the_ID($salon_id), 'location_zip', true);
				$salon_account_number = get_post_meta(get_the_ID($salon_id), 'cmb_spa_account_number', true);
				$salon_spa_retreat = get_post_meta(get_the_ID($salon_id), 'location_special', true);
				$salon_long = get_post_meta(get_the_ID($salon_id), 'location_lng', true);
				$salon_lat = get_post_meta(get_the_ID($salon_id), 'location_lat', true);
			endwhile;
			// Prevent weirdness
			wp_reset_postdata();

		} else { 
			// JUST IN CASE THIS IS AN OLD USER, NOT CONNECTED TO A SALON - USE OLD USER META VALUES
			$acc_no = get_user_meta($currentuserid, 'accountnumber');
			$accountnumber = $acc_no['0'];
			$salon_name_array = get_user_meta($currentuserid, 'accountname');
			$salon_name = $salon_name_array['0'];
		}


		// USER IS CONNECTED TO A SALON
		if ( $connected_salon->have_posts() ) :
			echo '<div class="aside">';
			while ( $connected_salon->have_posts() ) : $connected_salon->the_post();
				echo '<h3>Account Manager:</h3>';

				if ( has_post_thumbnail($salon_account_manager_id)){
					echo get_the_post_thumbnail( $salon_account_manager_id, 'large', array( 'alt' => get_the_title($salon_account_manager_id), 'class' =>"headnshoulders" ) );
				} else {
					echo '<img class="headnshoulders" src="' . get_bloginfo('stylesheet_directory') . '/images/account_manager.png">';
				}
				
				echo 'Name: ' . $salon_account_manager . '<br>';
				echo 'Phone: ' . $salon_account_manager_phone . '<br>';
				echo 'Email: <a href="mailto:' . $salon_account_manager_email . '">' . $salon_account_manager_email . '</a><br>';

				echo '<div class="clearfix"><br></div>' . do_shortcode('[gravityform id="31" name="contact Account Manager" title="false" description="false"]');

				echo '<br><br><h3>Spa / Salon</h3>';
				echo 'Account Number: ' . $salon_account_number . '<br>';
				if ( get_post_status ( $salon_id ) == 'publish' ) {echo '<a target="blank" href="' . get_the_permalink($salon_id) . '">' . $salon_name . '</a><br>';}
				else{echo $salon_name . '<br>';}
				if($salon_address){ echo $salon_address . '<br>';}
				if($salon_address2){ echo $salon_address2 . '<br>';}
				if($salon_city){ echo $salon_city . '<br>';}
				if($salon_county){ echo $salon_county . '<br>';}
				if($salonpostcode){ echo $salonpostcode . '<br><br>';}
				if($salon_phone){ echo 'Phone: ' . $salon_phone . '<br>';}
				if($salon_email){ echo 'Email: ' . $salon_email . '<br>';}
				if ( get_post_status ( $salon_id ) == 'publish' ) { echo '<br><iframe src="//germaine-de-capuccini.co.uk/?sm_map_iframe=1&map_width=90%25&map_height=200px&location_ids=' . $salon_id . '"></iframe><br><br>';}
			endwhile;
			// Prevent weirdness
			wp_reset_postdata();
			echo '</div>';
		endif;


	} else {
		// USER IS LOGGED IN BUT DOES NOT HAVE TRADE ACCESS
	}



} else {
	/*
	// USER IS NOT LOGGED IN
     $args = array(
        'echo' => true,
        'redirect' => site_url( $_SERVER['REQUEST_URI'] ), 
        'form_id' => 'loginform',
        'label_username' => __( 'Username' ),
        'label_password' => __( 'Password' ),
        'label_remember' => __( 'Remember Me' ),
        'label_log_in' => __( 'Log In' ),
        'id_username' => 'user_login',
        'id_password' => 'user_pass',
        'id_remember' => 'rememberme',
        'id_submit' => 'wp-submit',
        'remember' => true,
        'value_username' => NULL,
        'value_remember' => false );
echo '<div class="aside">';
wp_login_form( $args );
echo '<div class="note"><a href="' . get_permalink('2298') . '">Existing trade customers:<br>Register for trade support here</a></div>';
echo '</div>';
*/
} 




?>