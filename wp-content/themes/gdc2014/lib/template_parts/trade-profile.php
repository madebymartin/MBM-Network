<h2>Trade Profile Page</h2>
<?php 
the_content();
//thematic_postheader();
$user_id = get_current_user_id();
$usermeta = get_user_meta($user_id);

echo 'User id: ' . $user_id .'<br>';

// Find connected pages
$connected_salon = new WP_Query( array(
  'connected_type' => 'salon_staff',
  'connected_items' => $user_id,
  'nopaging' => true,
) );

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

		$salon_account_number = get_post_meta(get_the_ID($salon_id), '_cmb_spa_account_number', true);
		$salon_account_manager = get_post_meta(get_the_ID($salon_id), '_cmb_spa_account_manager', true);
		$salon_spa_retreat = get_post_meta(get_the_ID($salon_id), 'location_special', true);

		$salon_long = get_post_meta(get_the_ID($salon_id), 'location_lng', true);
		$salon_lat = get_post_meta(get_the_ID($salon_id), 'location_lat', true);

	endwhile;
	// Prevent weirdness
	wp_reset_postdata();
endif;



?>
