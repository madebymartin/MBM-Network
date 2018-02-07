<div class="aside">
<?php $current_user = wp_get_current_user();


if ( is_user_logged_in() ) {
?>


<br/>

<?php

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
	?>
	<?php 
}

else { 
	$redirect_to = get_bloginfo('url')."/login";//change this to your custom login url
	wp_safe_redirect($redirect_to);
	exit;	
	}
?>

<div class="note"><a class="" href="<?php echo wp_logout_url( get_permalink('8907') ); ?>" title="Logout">Logout</a></div>


<?php
} else {
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

wp_login_form( $args );
}

if ( !current_user_can( 'access_trade_content' ) ) { ?>
	<br><br><br><div class="note"><a href="<?php echo get_permalink('2298'); ?>">Existing trade customers:<br>Register for trade support here</a></div>
<?php }?>

</div>