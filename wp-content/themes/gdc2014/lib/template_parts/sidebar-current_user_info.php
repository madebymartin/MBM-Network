<?php 

if ( is_user_logged_in() ) {
	if ( current_user_can('access_trade_content') ) { ?>
		<div class="aside"><h3>Trade Customer Support</h3>
			<?php 
			$current_user = wp_get_current_user();
			$currentuserid = get_current_user_id();
			$jobrole = esc_attr( get_the_author_meta( 'jobrole', $currentuserid ) );


			// Find connected pages
			$connected_salon = new WP_Query( array(
			  'connected_type' => 'salon_staff',
			  'post_status' => array('publish', 'draft'),
			  'connected_items' => $currentuserid,
			  'nopaging' => true,
			) );
			// Display connected pages
			if ( $connected_salon->have_posts() ) {
				while ( $connected_salon->have_posts() ) : $connected_salon->the_post();
					$salon_object = $connected_salon->post;
					$salon_id = $salon_object->ID;
					$accountnumber = get_post_meta(get_the_ID($salon_id), 'cmb_spa_account_number', true);
					$salon_name = get_the_title($salon_id);
				endwhile;
				// Prevent weirdness
				wp_reset_postdata();
			} else { 
				$acc_no = get_user_meta($currentuserid, 'accountnumber');
				$accountnumber = $acc_no['0'];
				$salon_name_array = get_user_meta($currentuserid, 'accountname');
				$salon_name = $salon_name_array['0'];
			}


	// WELCOME NOTE
	//	echo '<div class="aside aside-category-list">';
			echo '<div class="note">';
				echo '<b>Welcome back ' . $current_user->first_name . '</b><br>';
				if($jobrole || $salon_name){
					echo '(';
						if($jobrole){ echo $jobrole;}
						
						if($jobrole && $salon_name != ''){ echo ', ';}
						if($salon_name){ echo $salon_name;}
					echo ')';
				}
//				echo '(' . $jobrole . ', ' . $salon_name . ')<br>';
			//	echo '<br>Account Number: ' . $accountnumber . '<br>';
			echo '</div>';
		//	echo '<a class="button" href="' .  get_permalink('9030') . '">Edit my details</a>';
			echo '<div class="note">';
			echo '<a class="button" href="' . get_permalink('6516') . '">Trade Support Home</a><br><br>';
			echo '<a class="" href="' . wp_logout_url( get_permalink('6516') ) . '" title="Logout">Logout</a>';
			echo '</div>';
	//	echo '</div>';

	?>
				
		</div>
	<?php 
	} 
} else {
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
		} 
?>