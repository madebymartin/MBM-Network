<div class="aside">

	<?php $current_user = wp_get_current_user();
	if ( current_user_can('access_trade_content') ) { 
		$user_id = get_current_user_id();
		$usermeta = get_user_meta($user_id);
		$jobrole = esc_attr( get_the_author_meta( 'jobrole', $user_id ) );

		$fave_product = esc_attr( get_the_author_meta( 'favourite_product', $user_id ) );
		$fave_product_obj = get_page_by_title( $fave_product, 'ARRAY_A', 'product' );
	    $fave_product_id = $fave_product_obj['ID'];

	    $connected_salon = new WP_Query( array(
		  'connected_type' => 'salon_staff',
		  'post_status' => array('publish', 'draft'),
		  'connected_items' => $user_id,
		  'nopaging' => true,
		) );

	//	echo '<a class="button" href="' . ( get_permalink('6516') ) . '" title="Trade Support Home">Trade Support Home</a><hr>';

		if ( $connected_salon->have_posts() ) :
			while ( $connected_salon->have_posts() ) : $connected_salon->the_post();
				$salon_object = $connected_salon->post;
				$salon_id = $salon_object->ID;
				$salon_account_manager_id = get_post_meta(get_the_ID($salon_id), 'cmb_spa_acc_manager', true);
				$salon_account_manager = get_the_title($salon_account_manager_id);
				$salon_account_manager_phone = get_post_meta($salon_account_manager_id, '_cmb_acc_man_phone', true);
				$salon_account_manager_email = get_post_meta($salon_account_manager_id, '_cmb_acc_man_email', true);

				echo '<h3>Account Manager:</h3>';
				
				if ( has_post_thumbnail($salon_account_manager_id)){
					echo get_the_post_thumbnail( $salon_account_manager_id, 'large', array( 'alt' => get_the_title($salon_account_manager_id), 'class' =>"headnshoulders" ) );
				} else {
					echo '<img class="headnshoulders" src="' . get_bloginfo('stylesheet_directory') . '/images/account_manager.png">';
				}

				echo 'Name: ' . $salon_account_manager . '<br>';
				echo 'Phone: ' . $salon_account_manager_phone . '<br>';
				echo 'Email: <a href="mailto:' . $salon_account_manager_email . '">' . $salon_account_manager_email . '</a><br><br>';
				//echo 'Phone: [variable number]<br>';
			endwhile;
			// Prevent weirdness
			wp_reset_postdata();
		endif;


		// Display connected pages
		if ( $connected_salon->have_posts() ) :
			while ( $connected_salon->have_posts() ) : $connected_salon->the_post();
				$salon_object = $connected_salon->post;
				$salon_id = $salon_object->ID;

				$salon_name = get_the_title($salon_id);
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

				echo '<br><br><h3>Spa / Salon</h3>';
			//	echo 'Salon id: ' . $salon_id . '<br>';
				echo 'Account Number: ' . $salon_account_number . '<br>';
			//	echo 'Salon Name: ' . $salon_name . '<br>';
				if ( get_post_status ( $salon_id ) == 'publish' ) {echo '<a target="blank" href="' . get_the_permalink($salon_id) . '">' . $salon_name . '</a><br>';}
				else{echo $salon_name . '<br>';}
				if($salon_address){ echo $salon_address . '<br>';}
				if($salon_address2){ echo $salon_address2 . '<br>';}
				if($salon_city){ echo $salon_city . '<br>';}
				if($salon_county){ echo $salon_county . '<br>';}
				if($salonpostcode){ echo $salonpostcode . '<br><br>';}

				if($salon_phone){ echo 'Phone: ' . $salon_phone . '<br>';}
				if($salon_email){ echo 'Email: ' . $salon_email . '<br>';}
			//	echo 'Salon longitude: ' . $salon_long . '<br>';
			//	echo 'Salon latitude: ' . $salon_lat . '<br>';
				if ( get_post_status ( $salon_id ) == 'publish' ) { echo '<br><iframe src="//germaine-de-capuccini.co.uk/?sm_map_iframe=1&map_width=90%25&map_height=200px&location_ids=' . $salon_id . '"></iframe><br><br>';}

			endwhile;
			// Prevent weirdness
			wp_reset_postdata();
		endif;	

			if($fave_product){
				echo '<br><br><h3>Favourite Product</h3>';
				echo 'Favourite product: ' . $fave_product . '<br><br><div class="main-product-image"><a href="' . get_permalink($fave_product_id) . '">' . get_the_post_thumbnail( $fave_product_id, '500sq', array('class' => 'attachment-500sq')) . '</a></div>';
			}
		} // END USER CAN ACCESS TRADE CONTENT
		else{
			// USER CANNOT ACCESS TRADE CONTENT
	} ?>
</div>