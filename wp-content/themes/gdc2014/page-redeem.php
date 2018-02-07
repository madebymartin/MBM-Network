<?php
/**
 *
 * …
 * 
 * @package Thematic
 * @subpackage Templates
 */
    get_header('redeem');
    thematic_abovecontainer();
?>

		<div id="container">
		
			<?php
				thematic_abovecontent();
				echo apply_filters( 'thematic_open_id_content', '<div id="content">' . "\n" );
	            get_sidebar('page-top');
	            while ( have_posts() ) : the_post();
	            thematic_abovepost();
		        
		        if ( current_user_can('access_trade_content') ) { 
		        	
		        	$current_user = wp_get_current_user();
				    $currentuserid = get_current_user_id();
				    $current_user_fname = $current_user->user_firstname;
				    $current_user_lname = $current_user->user_lastname;
				    if( !empty($current_user_fname) ){ 
				    	$name = $current_user_fname;
				    	if( !empty($current_user_lname) ){ $name .= $current_user_fname; }
				    }else{ $name =  $current_user->display_name; }


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

					?>
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> > 
					<?php 
					//thematic_postheader(); 
					?>
						<div class="entry-content">
							<?php
								echo 'Welcome ' . $name . '<br>';
								echo '<small>Your Account Number: ' . $accountnumber . '</small><br>';
								echo '<small>Your Spa / Salon: ' . $salon_name . '</small><br><br><br>';
		                    	the_content();
		                    ?>
						</div><!-- .entry-content -->
					</div><!-- #post -->
					<?php
				}
				else{
					echo'<h2>Please log in with a trade account</h3>';
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
				        'value_remember' => false 
			        );
					wp_login_form( $args );

					echo '<div class="note"><a href="' . get_permalink('2298') . '">Register here to create a website trade user account if you don\'t have one.</a></div>';

				}

	        	thematic_belowpost();
	        		       
	        	// end loop
        		endwhile;
	        	get_sidebar( 'page-bottom' );
	        ?>
			</div><!-- #content -->
			<?php thematic_belowcontent(); ?> 
		</div><!-- #container -->
<?php 
    thematic_belowcontainer();
    //thematic_sidebar();
    get_footer('redeem');
?>