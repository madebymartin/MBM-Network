<?php
add_filter('user_contactmethods','adjust_contact_methods',10,1);
function adjust_contact_methods( $contactmethods ) {
  unset($contactmethods['aim']);
  unset($contactmethods['jabber']);
  unset($contactmethods['yim']);
  unset($contactmethods['twitter']);
  unset($contactmethods['googleplus']);
  return $contactmethods;
}


add_action( 'personal_options', array ( 'T5_Hide_Profile_Bio_Box', 'start' ) );
//* Captures the part with the biobox in an output buffer and removes it.
//* @author Thomas Scholz, <info@toscho.de>
class T5_Hide_Profile_Bio_Box
{
     //* Called on 'personal_options'.
     //* @return void
    public static function start()
    {
        $action = ( IS_PROFILE_PAGE ? 'show' : 'edit' ) . '_user_profile';
        add_action( $action, array ( __CLASS__, 'stop' ) );
        ob_start();
    }
    //Strips the bio box from the buffered content.
    //@return void
    public static function stop()
    {
        $html = ob_get_contents();
        ob_end_clean();

        // remove the headline
        $headline = __( IS_PROFILE_PAGE ? 'About Yourself' : 'About the user' );
        $html = str_replace( '<h3>' . $headline . '</h3>', '', $html );

        // remove the table row
        $html = preg_replace( '~<tr>\s*<th><label for="description".*</tr>~imsUu', '', $html );
        print $html;

    }
}

add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );
function my_show_extra_profile_fields( $user ) { ?>

		
		<?php
		$connected = new WP_Query( array(
		  'connected_type' => 'salon_staff',
		  'connected_items' => $user,
		  'nopaging' => true,
		  'post_status' => array('publish', 'draft'),
		) );

		// Display connected salon
		if ( $connected->have_posts() ) :
			echo '<hr><h3>Account Information</h3><table class="form-table">';
			?>
			<?php while ( $connected->have_posts() ) : $connected->the_post(); 
			$salon_object = $connected_salon->post;
			$salon_id = $salon_object->ID;
			$salon_account_manager_id = get_post_meta(get_the_ID($salon_id), 'cmb_spa_acc_manager', true);
			$salon_account_manager = get_the_title($salon_account_manager_id);
			$salon_account_manager_phone = get_post_meta($salon_account_manager_id, '_cmb_acc_man_phone', true);
			$salon_account_manager_email = get_post_meta($salon_account_manager_id, '_cmb_acc_man_email', true);
			?>
			<tr>
				<th><label for="salon">Salon:</label></th>
				<td>
					<a target="blank" href="<?php echo get_edit_post_link(); ?>"><?php the_title(); ?></a><br><br>
					<?php echo get_the_post_thumbnail( $salon_id, '200sq', array('class' => '')) ?>
				</td>
			</tr>
			<tr>
				<th><label for="accountmanager">Account Manager:</label></th>
				<td><a target="blank" href="<?php echo get_edit_post_link($salon_account_manager_id); ?>"><?php echo get_the_title($salon_account_manager_id); ?></a></td>
			</tr>
			<?php endwhile; 

				$salon_name = esc_attr( get_the_author_meta( 'accountname', $user->ID ) );
				if($salon_name){
					echo '<tr><th><label for="accountname">Spa / Salon Name (obsolete)</label></th>';
					echo '<td><input type="text" name="accountname" id="accountname" value="' . $salon_name . '" class="regular-text" /><br></td></tr>';
				}
				?>

			<tr>
				<th><label for="jobrole">Job Role</label></th>
				<td>
		            <?php 
		            //get dropdown saved value
		            $selected = get_the_author_meta( 'jobrole', $user->ID ); //there was an extra ) here that was not needed 
		            ?>
		            <select name="jobrole" id="jobrole">
		                <option value="Owner" <?php echo ($selected == "Owner")?  'selected="selected"' : '' ?>>Owner</option>
		                <option value="Therapist" <?php echo ($selected == "Therapist")?  'selected="selected"' : '' ?>>Therapist</option>
		                <option value="Receptionist" <?php echo ($selected == "Receptionist")?  'selected="selected"' : '' ?>>Receptionist</option>
		                <option value="Student" <?php echo ($selected == "Student")?  'selected="selected"' : '' ?>>Student</option>
					</select>
		        </td>
			</tr>


		</table>
			<?php 
			// Prevent weirdness
			wp_reset_postdata();
		endif;
		?>

<hr>


	<?php
//	echo '<tr><th><label for="accountnumber">Account Number</label></th>';
//	echo '<td><input type="text" name="accountnumber" id="accountnumber" value="' . esc_attr( get_the_author_meta( 'accountnumber', $user->ID ) ) . '" class="regular-text" /><br /></td></tr>';
	
$fave_product = esc_attr( get_the_author_meta( 'favourite_product', $user->ID ) );
$fave_product_obj = get_page_by_title( $fave_product, 'ARRAY_A', 'product' );
$fave_product_id = $fave_product_obj['ID'];

	?>
<h3>Personal information</h3>
<table class="form-table">
		<tr>
			<th><label for="accountphone">Telephone</label></th>
			<td><input type="text" name="accountphone" id="accountphone" value="<?php echo esc_attr( get_the_author_meta( 'accountphone', $user->ID ) ); ?>" class="regular-text" /><br /></td>
		</tr>
		
		<tr>
			<th><label for="skx_sex">Sex</label></th>
			<td><input type="text" name="skx_sex" id="skx_sex" value="<?php echo esc_attr( get_the_author_meta( 'skx_sex', $user->ID ) ); ?>" class="regular-text" /><br /></td>
		</tr>

		<tr>
			<th><label for="skx_dob">Date of Birth</label></th>
			<td><input type="text" name="skx_dob" id="skx_dob" value="<?php echo esc_attr( get_the_author_meta( 'skx_dob', $user->ID ) ); ?>" class="regular-text" /><br /></td>
		</tr>

		<tr>
			<th><label for="skx_skintype">Skintype</label></th>
			<td><input type="text" name="skx_skintype" id="skx_skintype" value="<?php echo esc_attr( get_the_author_meta( 'skx_skintype', $user->ID ) ); ?>" class="regular-text" /><br /></td>
		</tr>

		<tr>
			<th><label for="skx_skin_concern1">Skin Concern</label></th>
			<td><input type="text" name="skx_skin_concern1" id="skx_skin_concern1" value="<?php echo esc_attr( get_the_author_meta( 'skx_skin_concern1', $user->ID ) ); ?>" class="regular-text" /><br /></td>
		</tr>

		<tr>
			<th><label for="skx_sensitivity">Skin Sensitivity</label></th>
			<td><input type="text" name="skx_sensitivity" id="skx_sensitivity" value="<?php echo esc_attr( get_the_author_meta( 'skx_sensitivity', $user->ID ) ); ?>" class="regular-text" /><br /></td>
		</tr>



		<?php
		echo '<tr><th><label for="favourite_product">Favourite Product</label></th>';
		echo '<td><b>' . $fave_product . '</b><br><br>' . get_the_post_thumbnail( $fave_product_id, '200sq', array('class' => '')) . '<br></td></tr>';
		?>






<!--
		<tr>
			<th><label for="training_products_only">training_products_only</label></th>
			<td><input type="text" name="training_products_only" id="training_products_only" value="<?php echo esc_attr( get_the_author_meta( 'training_products_only', $user->ID ) ); ?>" class="regular-text" /><br /></td>
		</tr>
		<tr>
			<th><label for="training_initial_face">training_initial_face</label></th>
			<td><input type="text" name="training_initial_face" id="training_initial_face" value="<?php echo esc_attr( get_the_author_meta( 'training_initial_face', $user->ID ) ); ?>" class="regular-text" /><br /></td>
		</tr>
		<tr>
			<th><label for="training_advanced_face">training_advanced_face</label></th>
			<td><input type="text" name="training_advanced_face" id="training_advanced_face" value="<?php echo esc_attr( get_the_author_meta( 'training_advanced_face', $user->ID ) ); ?>" class="regular-text" /><br /></td>
		</tr>
		<tr>
			<th><label for="training_spa_body_foundation">training_spa_body_foundation</label></th>
			<td><input type="text" name="training_spa_body_foundation" id="training_spa_body_foundation" value="<?php echo esc_attr( get_the_author_meta( 'training_spa_body_foundation', $user->ID ) ); ?>" class="regular-text" /><br /></td>
		</tr>
		<tr>
			<th><label for="training_spa_body_rituals">training_spa_body_rituals</label></th>
			<td><input type="text" name="training_spa_body_rituals" id="training_spa_body_rituals" value="<?php echo esc_attr( get_the_author_meta( 'training_spa_body_rituals', $user->ID ) ); ?>" class="regular-text" /><br /></td>
		</tr>
		<tr>
			<th><label for="training_holistic_obsidian">training_holistic_obsidian</label></th>
			<td><input type="text" name="training_holistic_obsidian" id="training_holistic_obsidian" value="<?php echo esc_attr( get_the_author_meta( 'training_holistic_obsidian', $user->ID ) ); ?>" class="regular-text" /><br /></td>
		</tr>
		<tr>
			<th><label for="training_perfect_forms">training_perfect_forms</label></th>
			<td><input type="text" name="training_perfect_forms" id="training_perfect_forms" value="<?php echo esc_attr( get_the_author_meta( 'training_perfect_forms', $user->ID ) ); ?>" class="regular-text" /><br /></td>
		</tr>
		<tr>
			<th><label for="training_kobido">training_kobido</label></th>
			<td><input type="text" name="training_kobido" id="training_kobido" value="<?php echo esc_attr( get_the_author_meta( 'training_kobido', $user->ID ) ); ?>" class="regular-text" /><br /></td>
		</tr>
		<tr>
			<th><label for="training_spa_concept">training_spa_concept</label></th>
			<td><input type="text" name="training_spa_concept" id="training_spa_concept" value="<?php echo esc_attr( get_the_author_meta( 'training_spa_concept', $user->ID ) ); ?>" class="regular-text" /><br /></td>
		</tr>
		<tr>
			<th><label for="training_efficy">training_efficy</label></th>
			<td><input type="text" name="training_efficy" id="training_efficy" value="<?php echo esc_attr( get_the_author_meta( 'training_efficy', $user->ID ) ); ?>" class="regular-text" /><br /></td>
		</tr>
	-->
</table>


<hr>

<table class="form-table">
	<tr>
		<th><label for="training"><h3>Training Completed</h3></label></th>
		<td>
			<ul>
			<?php
				if(esc_attr( get_the_author_meta( 'training_products_only', $user->ID ) )!= ''){echo '<li><img style="margin-right:6px;" width="12" src="' . get_bloginfo( 'stylesheet_directory') . '/images/success2.png">Products</li>';}
				else{echo '<li><img style="margin-bottom:-3px;" width="16" src="' . get_bloginfo( 'stylesheet_directory') . '/images/alert.png"> Products</li>';}

				if(esc_attr( get_the_author_meta( 'training_initial_face', $user->ID ) )!= ''){echo '<li><img style="margin-right:6px;" width="12" src="' . get_bloginfo( 'stylesheet_directory') . '/images/success2.png">Face - Initial</li>';}
				else{echo '<li><img style="margin-bottom:-3px;" width="16" src="' . get_bloginfo( 'stylesheet_directory') . '/images/alert.png"> Face - Initial</li>';}

				if(esc_attr( get_the_author_meta( 'training_advanced_face', $user->ID ) )!= ''){echo '<li><img style="margin-right:6px;" width="12" src="' . get_bloginfo( 'stylesheet_directory') . '/images/success2.png">Face - Advanced</li>';}
				else{echo '<li><img style="margin-bottom:-3px;" width="16" src="' . get_bloginfo( 'stylesheet_directory') . '/images/alert.png"> Face - Advanced</li>';}

				if(esc_attr( get_the_author_meta( 'training_spa_body_foundation', $user->ID ) )!= ''){echo '<li><img style="margin-right:6px;" width="12" src="' . get_bloginfo( 'stylesheet_directory') . '/images/success2.png">Spa Body Foundation</li>';}
				else{echo '<li><img style="margin-bottom:-3px;" width="16" src="' . get_bloginfo( 'stylesheet_directory') . '/images/alert.png"> Spa Body Foundation</li>';}

				if(esc_attr( get_the_author_meta( 'training_spa_body_rituals', $user->ID ) )!= ''){echo '<li><img style="margin-right:6px;" width="12" src="' . get_bloginfo( 'stylesheet_directory') . '/images/success2.png">Spa Body Rituals</li>';}
				else{echo '<li><img style="margin-bottom:-3px;" width="16" src="' . get_bloginfo( 'stylesheet_directory') . '/images/alert.png"> Spa Body Rituals</li>';}

				if(esc_attr( get_the_author_meta( 'training_holistic_obsidian', $user->ID ) )!= ''){echo '<li><img style="margin-right:6px;" width="12" src="' . get_bloginfo( 'stylesheet_directory') . '/images/success2.png">Holistic Obsidian</li>';}
				else{echo '<li><img style="margin-bottom:-3px;" width="16" src="' . get_bloginfo( 'stylesheet_directory') . '/images/alert.png"> Holistic Obsidian</li>';}

				if(esc_attr( get_the_author_meta( 'training_perfect_forms', $user->ID ) )!= ''){echo '<li><img style="margin-right:6px;" width="12" src="' . get_bloginfo( 'stylesheet_directory') . '/images/success2.png">Perfect Forms</li>';}
				else{echo '<li><img style="margin-bottom:-3px;" width="16" src="' . get_bloginfo( 'stylesheet_directory') . '/images/alert.png"> Perfect Forms</li>';}

				if(esc_attr( get_the_author_meta( 'training_kobido', $user->ID ) )!= ''){echo '<li><img style="margin-right:6px;" width="12" src="' . get_bloginfo( 'stylesheet_directory') . '/images/success2.png">Kobido</li>';}
				else{echo '<li><img style="margin-bottom:-3px;" width="16" src="' . get_bloginfo( 'stylesheet_directory') . '/images/alert.png"> Kobido</li>';}

				if(esc_attr( get_the_author_meta( 'training_spa_concept', $user->ID ) )!= ''){echo '<li><img style="margin-right:6px;" width="12" src="' . get_bloginfo( 'stylesheet_directory') . '/images/success2.png">Spa Concept</li>';}
				else{echo '<li><img style="margin-bottom:-3px;" width="16" src="' . get_bloginfo( 'stylesheet_directory') . '/images/alert.png"> Spa Concept</li>';}

				if(esc_attr( get_the_author_meta( 'training_efficy', $user->ID ) )!= ''){echo '<li><img style="margin-right:6px;" width="12" src="' . get_bloginfo( 'stylesheet_directory') . '/images/success2.png">Efficy</li>';}
				else{echo '<li><img style="margin-bottom:-3px;" width="16" src="' . get_bloginfo( 'stylesheet_directory') . '/images/alert.png"> Efficy</li>';}
			?>
			</ul>
		</td>
	</tr>
</table>


<?php 
	// SHIPPING INFO
	$shipping_first_name = esc_attr( get_the_author_meta( 'shipping-first_name', $user->ID ) );
	$shipping_last_name = esc_attr( get_the_author_meta( 'shipping-last_name', $user->ID ) );
	$shipping_company = esc_attr( get_the_author_meta( 'shipping-company', $user->ID ) );
	$shipping_address = esc_attr( get_the_author_meta( 'shipping-address', $user->ID ) );
	$shipping_address2 = esc_attr( get_the_author_meta( 'shipping-address-2', $user->ID ) );
	$shipping_city = esc_attr( get_the_author_meta( 'shipping-city', $user->ID ) );
	$shipping_state = esc_attr( get_the_author_meta( 'shipping-state', $user->ID ) );
	$shipping_postcode = esc_attr( get_the_author_meta( 'shipping-postcode', $user->ID ) );

	if($shipping_first_name){
		echo '<hr><h3>Shipping Information</h3><table class="form-table">';

			if($shipping_first_name){
				echo '<tr><th><label>Name</label></th>';
				echo '<td>' . $shipping_first_name . ' ' . $shipping_last_name . '</td></tr>';
			}
			if($shipping_company){
				echo '<tr><th><label for="shipping-first_name">Company</label></th>';
				echo '<td>' . $shipping_company . '</td></tr>';
			}
			if($shipping_address){
				echo '<tr><th><label for="shipping-first_name">Address</label></th><td>';
				echo $shipping_address . '<br>';
			}
			if($shipping_address2){
				echo $shipping_address2 . '<br>';
			}
			if($shipping_city){
				echo $shipping_city . '<br>';
			}
			if($shipping_state){
				echo $shipping_state . '<br>';
			}
			if($shipping_postcode){
				echo $shipping_postcode . '';
			}
		echo '</td></tr></table>';
	}


	// BILLING INFO
	$billing_first_name = esc_attr( get_the_author_meta( 'billing-first_name', $user->ID ) );
	$billing_last_name = esc_attr( get_the_author_meta( 'billing-last_name', $user->ID ) );
	$billing_company = esc_attr( get_the_author_meta( 'billing-company', $user->ID ) );
	$billing_address = esc_attr( get_the_author_meta( 'billing-address', $user->ID ) );
	$billing_address2 = esc_attr( get_the_author_meta( 'billing-address-2', $user->ID ) );
	$billing_city = esc_attr( get_the_author_meta( 'billing-city', $user->ID ) );
	$billing_state = esc_attr( get_the_author_meta( 'billing-state', $user->ID ) );
	$billing_postcode = esc_attr( get_the_author_meta( 'billing-postcode', $user->ID ) );
	$billing_phone = esc_attr( get_the_author_meta( 'billing-phone', $user->ID ) );

	if($shipping_first_name){
		echo '<hr><h3>Billing Information</h3><table class="form-table">';

			if($billing_first_name){
				echo '<tr><th><label for="billing-first_name">Name</label></th>';
				echo '<td>' . $shipping_first_name . ' ' . $shipping_last_name . '</td></tr>';
			}
			if($billing_company){
				echo '<tr><th><label for="billing-first_name">Company</label></th>';
				echo '<td>' . $shipping_company . '</td></tr>';
			}
			if($billing_address){
				echo '<tr><th><label for="billing-first_name">Address</label></th>';
				echo '<td>' . $shipping_address . '<br>';
			}
			if($billing_address2){
				echo $shipping_address2 . '<br>';
			}
			if($billing_city){
				echo $shipping_city . '<br>';
			}
			if($billing_state){
				echo $shipping_state . '<br>';
			}
			if($billing_postcode){
				echo $shipping_postcode . '<br></td></tr>';
			}
			if($billing_phone){
				echo '<tr><th><label for="billing-phone">Phone</label></th>';
				echo '<td>' . $billing_phone . '</td></tr>';
			}
		echo '</td></tr></table><hr><br>';

	}
}

add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );
function my_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	/* Copy and paste this line for additional fields. */
	update_usermeta( $user_id, 'accountnumber', $_POST['accountnumber'] );
	update_usermeta( $user_id, 'accountname', $_POST['accountname'] );
	update_usermeta( $user_id, 'accountphone', $_POST['accountphone'] );
	update_usermeta( $user_id, 'jobrole', $_POST['jobrole'] );
	update_usermeta( $user_id, 'skx_dob', $_POST['skx_dob'] );

	update_usermeta( $user_id, 'skx_sex', $_POST['skx_sex'] );
	update_usermeta( $user_id, 'skx_skintype', $_POST['skx_skintype'] );
	update_usermeta( $user_id, 'skx_skin_concern1', $_POST['skx_skin_concern1'] );
	update_usermeta( $user_id, 'skx_sensitivity', $_POST['skx_sensitivity'] );
	
	update_usermeta( $user_id, 'shipping-first_name', $_POST['shipping-first_name'] );
	update_usermeta( $user_id, 'shipping-last_name', $_POST['shipping-last_name'] );
	update_usermeta( $user_id, 'shipping-company', $_POST['shipping-company'] );
	update_usermeta( $user_id, 'shipping-address', $_POST['shipping-address'] );
	update_usermeta( $user_id, 'shipping-address-2', $_POST['shipping-address-2'] );
	update_usermeta( $user_id, 'shipping-city', $_POST['shipping-city'] );
	update_usermeta( $user_id, 'shipping-state', $_POST['shipping-state'] );
	update_usermeta( $user_id, 'shipping-postcode', $_POST['shipping-postcode'] );

	update_usermeta( $user_id, 'billing-first_name', $_POST['billing-first_name'] );
	update_usermeta( $user_id, 'billing-last_name', $_POST['billing-last_name'] );
	update_usermeta( $user_id, 'billing-company', $_POST['billing-company'] );
	update_usermeta( $user_id, 'billing-address', $_POST['billing-address'] );
	update_usermeta( $user_id, 'billing-address-2', $_POST['billing-address-2'] );
	update_usermeta( $user_id, 'billing-city', $_POST['billing-city'] );
	update_usermeta( $user_id, 'billing-state', $_POST['billing-state'] );
	update_usermeta( $user_id, 'billing-postcode', $_POST['billing-postcode'] );

//	update_usermeta( $user_id, 'training_products_only', $_POST['training_products_only'] );
//	update_usermeta( $user_id, 'training_initial_face', $_POST['training_initial_face'] );
//	update_usermeta( $user_id, 'training_advanced_face', $_POST['training_advanced_face'] );
//	update_usermeta( $user_id, 'training_spa_body_foundation', $_POST['training_spa_body_foundation'] );
//	update_usermeta( $user_id, 'training_spa_body_rituals', $_POST['training_spa_body_rituals'] );
//	update_usermeta( $user_id, 'training_holistic_obsidian', $_POST['training_holistic_obsidian'] );
//	update_usermeta( $user_id, 'training_perfect_forms', $_POST['training_perfect_forms'] );
//	update_usermeta( $user_id, 'training_kobido', $_POST['training_kobido'] );
//	update_usermeta( $user_id, 'training_spa_concept', $_POST['training_spa_concept'] );
//	update_usermeta( $user_id, 'training_efficy', $_POST['training_efficy'] );

//	update_usermeta( $user_id, 'salon', $_POST['salon'] );
//	update_usermeta( $user_id, 'favourite_product', $_POST['favourite_product'] );

}
?>