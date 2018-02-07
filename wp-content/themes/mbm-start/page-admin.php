<?php
/**
 * Page Template
 *
 * …
 * 
 * @package Thematic
 * @subpackage Templates
 */
 
    // calling the header.php
    get_header();

    // action hook for placing content above #container
    thematic_abovecontainer();
?>

		<div id="container">
		
			<?php
				// action hook for placing content above #content
				thematic_abovecontent();

				// filter for manipulating the element that wraps the content 
				echo apply_filters( 'thematic_open_id_content', '<div id="content">' . "\n" );
			
				// calling the widget area 'page-top'
	            get_sidebar('page-top');
	
	            // start the loop
	            while ( have_posts() ) : the_post();

				// action hook for placing content above #post
	            thematic_abovepost();
	        ?>
    	     		
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> > 

				<?php
	                
	                // creating the post header
	                thematic_postheader();
				?>
	                
					<div class="entry-content">
	
						<?php
	                    	the_content();
	                    
	                    	wp_link_pages( "\t\t\t\t\t<div class='page-link'>" . __( 'Pages: ', 'thematic' ), "</div>\n", 'number' );
	                    
	                    	edit_post_link( __( 'Edit', 'thematic' ), "\n\t\t\t\t\t\t" . '<span class="edit-link">' , '</span>' . "\n" );



if ( is_user_logged_in() ) {
?>
<h2>Welcome back
<?php
    $current_user = wp_get_current_user();
    /**
     * @example Safe usage: $current_user = wp_get_current_user();
     * if ( !($current_user instanceof WP_User) )
     *     return;
     */
    echo '' . $current_user->display_name . '<br />';
?>
</h2>

<br/>

<?php

global $user_ID, $user_identity, $user_level;

if ($user_ID) {

	if($_POST)

	{

		$message = "Your profile updated successfully &#10003;";

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

			else { $message = "<div id='error'>Please enter a valid email id.</div>"; }

		}

		if($password) {

			if (strlen($password) < 5 || strlen($password) > 15) {

				$message = "<div id='error'>Password must be 5 to 15 characters in length.</div>";

				}

			//elseif( $password == $confirm_password ) {

			elseif(isset($password) && $password != $confirm_password) {

				$message = "<div class='error'>Password Mismatch</div>";

			} elseif ( isset($password) && !empty($password) ) {

				$update = wp_set_password( $password, $user_ID );

				$message = "<div id='success'>Your profile updated successfully.</div>";

			}

		}



	}

}

/*

Template Name: Your account

*/

if ($user_ID) {

	$user_info = get_userdata($user_ID);

	get_header();

	?>

	<div id="user-interact">

	 <div class="indent">

	  <div>

	   <h4>Edit your account</h4>

	   <?php if($_POST) {

		echo "<div id='result'><div class='message'>".$message."</div></div>";

	}

	?>

			<form action="" method="post">
			<label>First name:</label><br /><input type="text" name="first_name" class="text" value="<?php echo $user_info->first_name; ?>" maxlength="30" /> <br />

				<label>Last name:</label><br /><input type="text" name="last_name" class="text" value="<?php echo $user_info->last_name; ?>" maxlength="30" /> <br />

				<label>Email address:</label><br /><input type="text" name="email" class="text" value="<?php echo $user_info->user_email; ?>" maxlength="30" /><br />


<br/>
<br/>
				<h4 class="grey">You can change your password below</h4>

				<label>New password</label><br /><input type="password" name="pwd" class="text" maxlength="15" /> <br />

				<label>Retype new password</label><br /><input type="password" name="confirm" class="text" maxlength="15" /><br />


				<br /><br />

				<input type="submit" name="Update" value="Update My Details" id="submit" />
			</form>





	  </div>

	 </div>

	</div>

	<?php


}

else {

	$redirect_to = get_bloginfo('url')."/login";//change this to your custom login url

	wp_safe_redirect($redirect_to);

	exit;

}

?>
<br/>
<a class="" href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Logout">Logout</a>




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




	                    ?>

					</div><!-- .entry-content -->
					
				</div><!-- #post -->
	
			<?php
				// action hook for inserting content below #post
	        	thematic_belowpost();
	        		        
       			// action hook for calling the comments_template
       			// thematic_comments_template();
        		
	        	// end loop
        		endwhile;
	        
	        	// calling the widget area 'page-bottom'
	        	get_sidebar( 'page-bottom' );
	        ?>
	
			</div><!-- #content -->
			
			<?php 
				// action hook for placing content below #content
				thematic_belowcontent(); 
			?> 
			
		</div><!-- #container -->

<?php 
    // action hook for placing content below #container
    thematic_belowcontainer();

    // calling the standard sidebar 
    thematic_sidebar();
    
    // calling footer.php
    get_footer();
?>