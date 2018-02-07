<?php
/**
 * Page Template
 *
 * …
 * 
 * @package Thematic
 * @subpackage Templates
 */
	global $woocommerce;

    get_header('shop');
    thematic_abovecontainer();
    
    
    do_action( 'woocommerce_before_main_content' );


				thematic_abovecontent();
	            get_sidebar('page-top');
	
	            while ( have_posts() ) : the_post();
	            thematic_abovepost();
		        ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> > 
				<?php 
				//thematic_postheader(); 
				?>
					<div class="entry-content">
						<?php 
						
							
							// Logged in, lets get the user meta for their skin details
							if ( is_user_logged_in() ) {
								$user_id = get_current_user_id();
								$user_meta = get_user_meta($user_id);
							    $page_url = rtrim(get_permalink(),'/');
								$user_firstname = get_user_meta($user_id, 'first_name', true);
								if(empty($user_firstname)){$user_firstname = 'there';} else{ $user_firstname = $user_firstname; }
								
								$skx_results = get_skx_product_results();
								$recommendations = $skx_results['recommendations'];
								$skx_product_ids = $skx_results['all_ids'];

								$cart_url = $woocommerce->cart->get_checkout_url();
								$skx_sample_set_product = get_product_by_sku( 'SKX' );
								$sample_set_id = $skx_sample_set_product->id;

								$user_dob = get_user_meta($user_id, 'skx_dob', true);
								$user_dob_timestamp = strtotime($user_dob);
								$currenttimestamp = current_time( 'timestamp');
								$today = strtotime('today', $currenttimestamp);
								$user_age_sec = $today - $user_dob_timestamp;
								$user_age = computeAge($user_dob_timestamp,$today);
								//	echo '<div style="font-size:8px;">'. $user_age .'</div>';



								echo '<div id="message">';
								wc_print_notices();
								echo '</div>';



								if( empty($skx_product_ids) ){ 
									if($user_age < 16){
										echo '<div id="autoexpert"><p>"Hi ' . $user_firstname . ', we\'re very sorry but our products are not designed for people under the age of 16.</p><p>Please please do not hesitate to call us for advise on your skin: <b>0845 094 9460</b> (local rate).</p></div>';
									}else{
										echo '<div id="autoexpert"><p>"Hi ' . $user_firstname . ', we don\'t yet have enough information about your skin to give you good advise.</p><p>Please visit the <a href="'. get_permalink('3432') .'">Skincare Expert</a> page where we will ask you a few questions.</p></div>'; 
									}
									
								}





								else{
									echo '<div id="autoexpert"><p>"Hi ' . $user_firstname . ', below are the products that are perfect for your particular skin.</p><p>We can send you free sample versions of these products (excluding cleansers &amp; toners) although we do charge for delivery. <b>For your first order of samples, the delivery charge is credited to your account</b> for use against any full-sized product order within 2 months."</p><a class="button" href="' . $cart_url  . '?add-to-cart=' . $sample_set_id . '">Send me free samples</a><p><br><small><a href="'. get_permalink('3432') .'">Update the details we have about your skin</a></small></p></div>';

									echo '<ul class="margin0 padding0 skx">';
									foreach ($recommendations as $type => $id) {
										foreach ($id as $key => $value) {

											$product_id = $value;
											$product = new WC_Product( $product_id );
											$price = $product->price;
											$product_meta = get_post_meta($product_id);
											$add_to_cart_url = $page_url . '/?add-to-cart=' . $product_id . '' ;
											$prodprice = number_format($price, 2, '.', '');
											if ( get_post_meta($product_id, "_cmb_instructions", true) ) { $instructions = '<p>' . get_post_meta($product_id, "_cmb_instructions", true) . '</p>'; } 
											else { $instructions = term_description( '155', 'recommendation_type' ); }

											echo '<li>';
												
												echo '<h3>'. $type .':<span><br>'. get_the_title($product_id) .'</span></h3>';
												echo '<div class="image-wrap">' . get_the_post_thumbnail( $product_id, 'large' ) . '</div>';
												echo '<div class="instructions">'. $instructions . '<a href="'. $add_to_cart_url .'" class="button right" rel="nofollow">Add to Bag (£'.$prodprice.')</a></div>';
											echo '</li>';

										}
									}
									echo '</ul>';
									//$woocommerce->cart->add_to_cart('4331');
								}
								
							}



							//not logged in, send them to the skincare expert page.
							else{
								echo '<h2>Please log in so we can show your recommended products:</h2>';
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
								?>
								<a href="<?php echo wp_lostpassword_url( get_permalink() ); ?>" title="Lost Password">Lost Password</a>
								<?php
							}
							wp_reset_query();
							the_content();
	                    	wp_link_pages( "\t\t\t\t\t<div class='page-link'>" . __( 'Pages: ', 'thematic' ), "</div>\n", 'number' );
	                    	edit_post_link( __( 'Edit', 'thematic' ), "\n\t\t\t\t\t\t" . '<span class="edit-link entypo-pencil">' , '</span>' . "\n" );
	                    ?>
					</div><!-- .entry-content -->
				</div><!-- #post -->
			<?php
	        	thematic_belowpost();
        		endwhile;
	        	get_sidebar( 'page-bottom' );
	        ?>
			<?php thematic_belowcontent(); ?> 
<?php 
	do_action( 'woocommerce_after_main_content' );
    thematic_belowcontainer();
    //thematic_sidebar();
    get_footer();
?>