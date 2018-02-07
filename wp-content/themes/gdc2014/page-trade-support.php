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



				
				


				// TRADE SUPPORT MENU
				?>
				<div class="aside aside-category-list">

					<?php
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


							//	echo '(' . $jobrole . ', ' . $salon_name . ')<br>';
							echo '</div>';
							echo '<a class="button" href="' .  get_permalink('9030') . '">Edit my details</a>';
							echo '<div class="note"><a class="" href="' . wp_logout_url( get_permalink('6516') ) . '" title="Logout">Logout</a></div><br><br>';
					//	echo '</div>';
					?>


					<h3>Support Categories</h3>
					<?php 
					$terms = apply_filters( 'taxonomy-images-get-terms', '', array(
						'taxonomy'     => 'download_categories',
						'having_images' => 'true',
						'term_args' =>	array(
							'parent'    => 0,
							'hide_empty' => 0,
							)
						) 
					);
					
					if ( ! empty( $terms ) ) {
						print '<ul>';
					    foreach( (array) $terms as $term ) {
					    	if(get_queried_object()->name===$term->name){ $class='currentitem'; }
					    	else{ $class=''; }
					        print '<li class="asideproductcat '  . $class .  '">';
						        print '<a href="' . esc_url( get_term_link( $term, $term->taxonomy ) ) . '">';
							        print '<div class="image-wrap">' . wp_get_attachment_image( $term->image_id, '200sq' ) . '<span class="info-icon"></span></div>';
							        print '<p>' . esc_html( $term->name ) . '</p>';
						        print '</a>';
					        print '</li>';
					    }
					    print '</ul>';
					} ?>
				</div>

		<?php
			} else {
				// USER IS LOGGED IN BUT DOES NOT HAVE TRADE ACCESS
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
		echo '<div class="note"><a href="' . get_permalink('9028') . '">Existing trade customers:<br>Register your trade account here</a></div>';
		echo '</div>';
		} ?>


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
		                /* ACCESS TO TRADE SECTION */
		                if ( current_user_can('access_trade_content') ) { 
		                	get_template_part( '/lib/template_parts/trade', 'loggedin' ); 
		                }

		                /* NO ACCESS */
		                else{ 
		                	the_content();
		                	wp_link_pages( "\t\t\t\t\t<div class='page-link'>" . __( 'Pages: ', 'thematic' ), "</div>\n", 'number' );
				            edit_post_link( __( 'Edit', 'thematic' ), "\n\t\t\t\t\t\t" . '<span class="edit-link entypo-pencil">' , '</span>' . "\n" );
		                	//get_template_part( '/lib/template_parts/trade', 'loggedout' ); 
		                } ?>
					
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
    // thematic_sidebar();
    get_template_part( 'lib/template_parts/sidebar', 'image_library' );
	get_template_part( 'lib/template_parts/sidebar', 'trade2' );
    
    // calling footer.php
    get_footer();
?>