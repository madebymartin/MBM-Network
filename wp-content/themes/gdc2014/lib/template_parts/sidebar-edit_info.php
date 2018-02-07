<div class="aside">
<?php $current_user = wp_get_current_user();


if ( is_user_logged_in() ) {

	global $user_ID, $user_identity, $user_level;

	if ($user_ID) {
		if($_POST) {

			$message = "<div class='success'>Your profile updated successfully &#10003;</div>";
			$first = $wpdb->escape($_POST['first_name']);
			$last = $wpdb->escape($_POST['last_name']);
			$email = $wpdb->escape($_POST['email']);

			$password = $wpdb->escape($_POST['pwd']);
			$confirm_password = $wpdb->escape($_POST['confirm']);
			
			update_user_meta( $user_ID, 'first_name', $first );
			update_user_meta( $user_ID, 'last_name', $last );

			wp_update_user( array ('ID' => $user_ID, 'user_url' => $user_url) );
			
			if(isset($email)) {
				if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email)){ 
					wp_update_user( array ('ID' => $user_ID, 'user_email' => $email) ) ;
				}

				else { $message = "<div class='error'>Please enter a valid email id &#x2718</div>"; }
			}

			if($password) {
				if (strlen($password) < 5 || strlen($password) > 15) {
					$message = "<div class='error'>Password must be 5 to 15 characters in length &#x2718</div>";
					}

				//elseif( $password == $confirm_password ) {
				elseif(isset($password) && $password != $confirm_password) {
					$message = "<div class='error'>Password Mismatch &#x2718</div>";

				} elseif ( isset($password) && !empty($password) ) {
					$update = wp_set_password( $password, $user_ID );
					$message = "<div class='success'>Your profile updated successfully &#10003;</div>";
				}
			}	
		}
	}



	if ($user_ID) {
		$user_info = get_userdata($user_ID);
		get_header();
		?>

		   <h3>Edit your details</h3>
		   

				<form action="" method="post">
					<label>First name:</label><br /><input type="text" name="first_name" class="text" value="<?php echo $user_info->first_name; ?>" maxlength="30" /> 
					<label>Last name:</label><br /><input type="text" name="last_name" class="text" value="<?php echo $user_info->last_name; ?>" maxlength="30" />
					<label>Email address:</label><br /><input type="text" name="email" class="text" value="<?php echo $user_info->user_email; ?>" maxlength="30" />	
					<br/>
					<br/>

					<h3>Change password</h3>
					<label>New password</label><br /><input type="password" name="pwd" class="text"/>
					<label>Retype new password</label><br /><input type="password" name="confirm" class="text"/>
					<br /><br />


					<?php if($_POST) { echo "<div id='result'><div class='message'>".$message."</div></div>"; } ?>


					<input type="submit" name="Update" value="Update" id="submit" />
				</form>
		<?php 
	}

	else { 
		$redirect_to = get_bloginfo('url')."/login";//change this to your custom login url
		wp_safe_redirect($redirect_to);
		exit;	
		}
	?>

	<div class="note"><a class="" href="<?php echo wp_logout_url( ); ?>" title="Logout">Logout</a></div>


<?php
} else {
// USER NOT LOGGED IN
}
?>
</div>