<?php
/**
 * Page Template
 *
 * …
 * 
 * @package Thematic
 * @subpackage Templates
 */
set_time_limit(0);
ini_set("memory_limit", "1024M");


    get_header();
    $report = $_GET['report'];
    $skintype_gender_slug = $_GET['skintypeslug'];
    $skintype_gender_name = $_GET['skintype'];
    thematic_abovecontainer();
?>
		<div id="container">
		
			<?php
				thematic_abovecontent();
				echo apply_filters( 'thematic_open_id_content', '<div id="content">' . "\n" );
	            get_sidebar('page-top');
	            while ( have_posts() ) : the_post();

	            thematic_abovepost(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> > 
				<?php 
				// thematic_postheader(); 
				?>
					<div class="entry-content">
						<?php

			          if ( current_user_can('access_management') ) { //only 'STAFF' user can see this

			          mbm_write_log('Management Page Used!');

	/*	                    	the_content();
		                    	wp_link_pages( "\t\t\t\t\t<div class='page-link'>" . __( 'Pages: ', 'thematic' ), "</div>\n", 'number' );
		                    	edit_post_link( __( 'Edit', 'thematic' ), "\n\t\t\t\t\t\t" . '<span class="edit-link entypo-pencil">' , '</span>' . "\n" );*/

		                    	if( $report == '' ){
		                    		
		                    		echo '<h3>Spa Vouchers</h3>';
			                    	echo '<a class="button" href="' . get_permalink() . '?report=6">Spa Vouchers Overview</a>';
			                    	echo '<br><a class="button" href="' . get_permalink() . '?report=9">Activate Spa Voucher</a>';
			                    	echo '<br><a target="blank" class="button" href="' . get_permalink("69467") . '">Redeem Spa Voucher</a>';

			                    	echo '<br><br><hr><h3>Accounts</h3>';
			                    	echo '<br><a class="button" href="' . get_permalink() . '?report=7">Account Names &amp; Numbers</a>';
			                    	echo '<br><a class="button" href="' . get_permalink() . '?report=8">Add a Salon or Spa</a>';

			                    	echo '<br><br><hr><h3>Skincare Expert</h3>';
			                    	echo '<br><a class="button" href="' . get_permalink() . '?report=3">Skincare Expert Product Report</a>';
			                    	echo '<br><a class="button" href="' . get_permalink() . '?report=4">Skincare Expert Combo Reports</a>';
			                    	echo '<br><a class="button" href="' . get_permalink() . '?report=5">Skincare Expert Coupon ROI</a>';

			                    	echo '<br><br><hr><h3>Other tools</h3>';
			                    	echo '<br><a class="button" href="' . get_permalink() . '?report=1">Product Image URLs in order of product ID</a>';
			                    	echo '<br><a class="button" href="' . get_permalink() . '?report=2">Current public coupon promotions</a>';
			                    	echo '<br><a class="button" href="' . get_permalink() . '?report=10">Out of Stock Products</a>';

			                    	echo '<br><a class="button" href="' . get_permalink() . '?report=11">Customer order history</a>';
			                    	
		                    	}else{
		                    		echo '<a class="button" href="' . get_permalink() . '">Back to management options</a><br><br><hr>';
		                    	}







		                    	// Customer orders report
		                   		if( $report == '11' ){

		                   			$customer_to_show = $_GET['custid'];
		                   			$this_user_id = $customer_to_show;					
									

		                   			// Queried User's Details
		                   			$this_user = new WP_User($this_user_id);
								 	$this_name = $this_user->first_name . ' ' . $this_user->last_name;
								 	$this_name = ucwords($this_name);
								 	$usermeta = get_user_meta($this_user_id);

									$customer_orders = get_posts( array(
									    'numberposts' => -1,
									    'meta_key'    => '_customer_user',
									    'meta_value'  => $this_user_id,
									    'post_type'   => wc_get_order_types(),
									    'post_status' => array_keys( wc_get_order_statuses() ),
									) );


									// No user selected yet
									if(empty($this_user_id)){ 
									}
									else{ 
										echo '<h2>Order History: ' . $this_name . '</h2>';
									}
									

									//GET ALL CUSTOMERS / TRADE CUSTOMERS
									$customers = get_users( [ 'role__in' => [ 'customer', 'trade_user', 'administrator' ] ] );
									//$allcustomers = array();

									// BUILD ARRAY OF THESE GUYS, STORING JUST WHAT WE NEED
									foreach ($customers as $customer) {
							            $user = get_userdata($customer->ID); 
							            $user_id = $user->ID;
							            $billing_fname = get_user_meta( $user_id, 'shipping_first_name', true );
							            $billing_lname = get_user_meta( $user_id, 'shipping_last_name', true );

							            if($billing_fname){ $firstname = $billing_fname;}
							            elseif($user->user_firstname){$firstname = $user->user_firstname;}
							            else{$firstname = '';}

							            if($billing_lname){ $lastname = $billing_lname;}
							            elseif($user->user_lastname){$lastname = $user->user_lastname;}
							            else{$lastname = '';}

							            //$order_count = wc_get_customer_order_count( $user_id );
							            $order_count = get_user_meta($user_id, '_order_count', true);


							            $name = $firstname . '' . $lastname;
							            if(!empty($name)){
							            	$allcustomers[$user->ID] = array(
								                'fname'     	=>	$firstname,
								                'lname'     	=>	$lastname,
								                'id'			=>	$user_id,
								                'order_count'	=> $order_count
								            );
										}
							            
							        }

							        // Sort
							        sort($allcustomers); 


							        // Build drop-down from users that are customers or trade customers and have at least 1 order...
									echo '<select name="custid" form="all_customers" onchange="this.form.submit()">';
										$customer_list = array('<option value="0">Choose Customer</option>');

										foreach ($allcustomers as $key => $customer) {
										 	$id = $customer['id'];
										 	$order_count = $customer['order_count'];
										 	$name = $customer['fname'] . ' ' . $customer['lname'];
										 	$name = strtolower($name);
										 	$name = ucwords($name);
										 	if($id == $this_user_id){$selected = ' selected';} else{$selected = '';}

										 	$customer_list[] = '<option' . $selected . ' value="' . $id . '">' . $name . '</option>';
										}

										echo implode('', $customer_list);
									echo '</select>';
									echo '<form action="" id="all_customers"><input type="hidden" value="11" name="report"></form>';



									if(!empty($this_user_id)){ 

										if(get_user_meta($this_user_id, 'skx_dob', true)){ echo 'DOB: ' . get_user_meta($this_user_id, 'skx_dob', true) . '<br>'; }
										if(get_user_meta($this_user_id, 'skx_sex', true)){ echo 'Sex: ' . get_user_meta($this_user_id, 'skx_sex', true) . '<br>'; }
										if(get_user_meta($this_user_id, 'skx_skintype', true)){ echo 'Skintype: ' . get_user_meta($this_user_id, 'skx_skintype', true) . '<br>'; }
										if(get_user_meta($this_user_id, 'skx_skin_concern1', true)){ echo 'Skin Concern: ' . get_user_meta($this_user_id, 'skx_skin_concern1', true) . '<br>'; }
										if(get_user_meta($this_user_id, 'skx_sensitivity', true)){ echo 'Sensitivity: ' . get_user_meta($this_user_id, 'skx_sensitivity', true) . '<br>'; }
										

										echo '<table style="width:100%;"><thead><tr><td>Order</td><td>Items</td><td>Coupons used</td><td>Order Total</td></tr></thead>';
										$totalspend = '';
										foreach ($customer_orders as $key => $order) {

											$order_id = $order->ID;
											$order = new WC_Order($order_id);
											$order_date = $order->order_date;
											$items = $order->get_items();
											$edit_url = get_edit_post_link( $order_id );
											$coupons = $order->get_used_coupons();
											$coupons = implode(', ', $coupons);
											$ordertotal = $order->get_total();
											$ordertotal = number_format($ordertotal, 2);
											$totalspend = $totalspend + $ordertotal;
											$totalspend = number_format($totalspend, 2);

											echo '<tr>';
												
												echo '<td><a href="'. $edit_url  .'">'. $order_id .'</a></td>';
												echo '<td>';
													echo '<ul>';
													foreach ($items as $key => $product ) {

														$line_name = $product['name'];
														$line_qty = $product['qty'];
														$line_subtotal = $product['_line_subtotal'];
														$line_discount = '';

														echo '<li style="margin:0;font-size:0.75em;">';
															echo $product['qty'] . 'x ' . $product['name'] . '<br>';
															//print_r($product);
														echo '</li>';

													}
													echo '</ul>';
												echo '</td>';
												echo '<td>'. $coupons .'</td>';
												echo '<td>£' . $ordertotal . '</td>';

											echo '</tr>';
										}
										echo '<tfoot><td>'. count($customer_orders) .' orders</td><td></td><td></td><td><b>TOTAL: £'. $totalspend .'<b></td></tfoot>';
										echo '</table>';
									}


		                   		}



		                    	// Out of Stock Products
		                   		if( $report == '10' ){
		                    		echo '<h2>Out of stock products</h2>';

		                    		$prod_loop = new WP_Query( 
										array(
							            'post_type' => 'product',
							            'posts_per_page' => '-1',
							            'orderby' => 'title',
							            'order' => 'ASC',
							            'post_status' => 'publish',
							            'meta_query' => array(
												array(
													'key'     => '_stock_status',
													'value'   => 'outofstock',
													'compare' => '=',
												),
											),
								        ) 
							        );
							        wp_reset_postdata();

							        if ( $prod_loop->have_posts() ) {
							        	echo '<small>(' . $prod_loop->post_count . ' products are out of stock)</small><br><ul>';
											while ( $prod_loop->have_posts() ) : $prod_loop->the_post();
												// show prod list
											$id = get_the_ID();
											echo '<li><a href="' . get_permalink($id) . '">' . get_the_title($id) . '</a></li>';
											endwhile;
										echo '</ul>';
									}
									else{echo 'No products are currently out of stock';}

		                    	}



		                    	// Sell Spa Voucher Form
		                   		if( $report == '9' ){
		                    		echo do_shortcode('[gravityform id="42" title="false" description="false"]');
		                    	}


		                    	// Add Salon Form
		                    	if( $report == '8' ){
		                    		echo do_shortcode('[gravityform id="41" title="false" description="false"]');
		                    	}


		                    	// Show all salons:
		                    	// * name
		                    	// * acc no
		                    	// * acc manager
		                    	// * registered user count
		                    	if( $report == '7' ){

		                    		$account_manager_to_show = $_GET['accmanid'];
		                    		$acc_man_args = array(
										'post_type'			=> 'account_manager',
										'post_status' 		=> array('publish', 'draft'),
								        'posts_per_page' => -1,
								        'orderby' => 'title',
								        'order' => 'ASC',
									);
									$account_managers = new WP_Query( $acc_man_args );

									if( empty($account_manager_to_show) ){ 
										$compare = '!='; 
									}else{ $compare = '='; }



									echo '<select name="accmanid" form="account_managers">';
										$options = array();
										$options[] = '<option value="' . $acc_man_id . '">All Account Managers</option>';
										while ( $account_managers->have_posts() ) : $account_managers->the_post();
											$acc_man_id = get_the_ID();
											if( $acc_man_id == $account_manager_to_show ){ $selected = ' selected'; } else{ $selected = ''; }
											$options[] = '<option' . $selected . ' value="' . $acc_man_id . '">' . get_the_title($acc_man_id) . '</option>';
										endwhile;

										echo implode('', $options);
									echo '</select>';
									?>
									
									<form action="" id="account_managers">
										<input type="hidden" value="7" name="report">
									  <input style="float:left" type="submit" value="Filter Accounts">
									</form>


									<?php
		                    		$args = array(
										'post_type'			=> 'sm-location',
										'post_status' 		=> array('publish', 'draft'),
								        'posts_per_page' => -1,
								        'orderby' => 'title',
								        'order' => 'ASC',
								        'meta_query' => array(
											array(
												'key'     => 'cmb_spa_acc_manager',
												'compare' => $compare,
												'value' => $account_manager_to_show,
											),
										),
									);
									$accounts = new WP_Query( $args );
									$accounts_count = count($accounts);
									echo '<h3>' . $accounts->post_count . ' Accounts:</h3>';
									
									echo '<table><tr><th>Account Number</th><th>Name</th><th>Account Manager</th><th>Registered Users</th><th>In Spa Finder</th></tr>';
									while ( $accounts->have_posts() ) : $accounts->the_post();
										$acc_id = get_the_ID();
										$acc_no = get_post_meta($acc_id, 'cmb_spa_account_number', true);
										$acc_manager_id = get_post_meta($acc_id, 'cmb_spa_acc_manager', true);
										$acc_special = get_post_meta($acc_id, 'location_special', true);
										if( $acc_special == "1"){ $rowclass = ' class="retreat" '; } else{ $rowclass = ''; }
										$acc_manager = get_the_title($acc_manager_id);
										$acc_name = get_the_title($acc_id);
										$edit_url = get_edit_post_link( $acc_id );
										$status = get_post_status( $acc_id );
										if( $status == 'publish' ){ $included = '<span style="color:#53af0f;">&#10003;</span>'; } else{ $included = '<span style="color:#af0f0f;">&#10008;</span>'; }

										$users = get_users( array(
										  'connected_type' => 'salon_staff',
										  'connected_items' => $post
										) );
										$user_count = count($users);
										echo '<tr' . $rowclass . '><td>' . $acc_no . '</td><td><a target="blank" href="' . $edit_url . '">' . $acc_name . '</a></td><td>' . $acc_manager . '</td><td>' . $user_count . '</td><td>' . $included . '</td></tr>';

									endwhile;
									echo '</table>';

		                    	}









		                    	if( $report == '6' ){

		                    		$args_bought = array(
										'post_type'			=> 'spa_voucher',
										'post_status' 		=> 'publish',
								        'posts_per_page' => -1,
								        'meta_key' => 'gdcspv_voucher_value',
								        'meta_type' => 'NUMERIC',
								        'orderby' => 'meta_value_num',
								        'order' => 'ASC',
								        'meta_query' => array(
								        	'relation' => 'AND',
											array(
												'key'     => 'gdcspv_voucher_order',
												'compare' => 'EXISTS',
											),
											array(
												'key'     => 'gdcspv_used_date',
												'compare' => 'NOT EXISTS',
											),
										),
									);
									$spa_vouchers_bought_not_used = new WP_Query( $args_bought );

		                    		$args_used = array(
										'post_type'			=> 'spa_voucher',
										'post_status' 		=> 'publish',
								        'posts_per_page' => -1,
								        'meta_key' => 'gdcspv_voucher_value',
								        'meta_type' => 'NUMERIC',
								        'orderby' => 'meta_value_num',
								        'order' => 'ASC',
								        'meta_query' => array(
											array(
												'key'     => 'gdcspv_used_date',
												'compare' => 'EXISTS',
											),
										),
									);
									$spa_vouchers_used = new WP_Query( $args_used );

									$args_not_used = array(
										'post_type'			=> 'spa_voucher',
										'post_status' 		=> 'publish',
								        'posts_per_page' => -1,
								        'meta_key' => 'gdcspv_voucher_value',
								        'meta_type' => 'NUMERIC',
								        'orderby' => 'meta_value_num',
								        'order' => 'ASC',
								        'meta_query' => array(
								        	'relation' => 'AND',
											array(
												'key'     => 'gdcspv_used_date',
												'compare' => 'NOT EXISTS',
											),
											array(
												'key'     => 'gdcspv_voucher_order',
												'compare' => 'NOT EXISTS',
											),
										),
									);
									$spa_vouchers_not_used = new WP_Query( $args_not_used );



									echo '<h3>Activated Vouchers: ' . $spa_vouchers_bought_not_used->post_count . '</h3>';
									echo '<table><tr><th>Voucher Code</th><th>Value</th><th>Order Date</th><th>Order Number</th></tr>';
									while ( $spa_vouchers_bought_not_used->have_posts() ) : $spa_vouchers_bought_not_used->the_post();
										$voucher_id = get_the_ID();
										$voucher_code = get_the_title($voucher_id);
										$voucher_meta = get_post_meta($voucher_id);
										$order_id = $voucher_meta["gdcspv_voucher_order"]["0"];
										$order = new WC_Order($order_id);
										$order_date = $order->order_date;
										$order_url = get_edit_post_link( $order_id );
										$value = $voucher_meta["gdcspv_voucher_value"]["0"];
										echo '<tr><td>' . $voucher_code . '</td><td>' . $value . '</td><td>' . $order_date . '</td><td><a target="blank" href="' . $order_url . '">' . $order_id . '</a></td></tr>';
									endwhile;
									echo '</table>';





									echo '<h3>Used Vouchers : ' . $spa_vouchers_used->post_count . '</h3>';
									echo '<table><tr><th>Voucher Code</th><th>Value</th><th>Used on</th><th>Used by</th></tr>';
									while ( $spa_vouchers_used->have_posts() ) : $spa_vouchers_used->the_post();
										$voucher_id = get_the_ID();
										$voucher_code = get_the_title($voucher_id);
										$voucher_meta = get_post_meta($voucher_id);
										$used_date_time = $voucher_meta["gdcspv_used_date"]["0"];
										$value = $voucher_meta["gdcspv_voucher_value"]["0"];
										$usedby_name = $voucher_meta["gdcspv_voucher_value"]["0"];
										$account_no = $voucher_meta["gdcspv_used_account_no"]["0"];
										$timestamp = strtotime($used_date_time);
										$used_date = date("jS M Y", $timestamp);
										echo '<tr><td>' . $voucher_code . '</td><td>' . $value . '</td><td>' . $used_date . '</td><td>' . $account_no . '</td></tr>';
									endwhile;
									echo '</table>';

									echo '<h3>Unsold Vouchers: ' . $spa_vouchers_not_used->post_count . '</h3>';
									echo '<table><tr><th>Voucher Code</th><th>Value</th><th>Used on</th><th>Used by</th></tr>';
									while ( $spa_vouchers_not_used->have_posts() ) : $spa_vouchers_not_used->the_post();
										$voucher_id = get_the_ID();
										$voucher_code = get_the_title($voucher_id);
										$voucher_meta = get_post_meta($voucher_id);
										$used_date_time = $voucher_meta["gdcspv_used_date"]["0"];
										$value = $voucher_meta["gdcspv_voucher_value"]["0"];
										$usedby_name = $voucher_meta["gdcspv_voucher_value"]["0"];
										$account_no = $voucher_meta["gdcspv_used_account_no"]["0"];
										$timestamp = strtotime($used_date_time);
										$used_date = date("jS M Y", $timestamp);
										echo '<tr><td>' . $voucher_code . '</td><td>' . $value . '</td><td>-</td><td>-</td></tr>';
									endwhile;
									echo '</table>';

		                    	}

		                    	



		                    	
		                    	// Skincare Expert Combinations Report
		                    	if( $report == '5' ){
		                    		
		                    		// CURRENT TIME
									date_default_timezone_set("Europe/London");
									$nowtimestamp = time();
									$yearago = strtotime('-1 year', $nowtimestamp);
									$beginningOfThisWeek = strtotime('Last Sunday', $nowtimestamp);
									$endOfThisWeek = strtotime('+1 week', $beginningOfThisWeek);

									$lastYearDay = date('l', $yearago);
									if($lastYearDay == 'Sunday'){ $beginningOfWeekLastYear = $yearago; }
									else{ $beginningOfWeekLastYear = $beginningOfThisWeek = strtotime('Last Sunday', $yearago); }

									$yearstart_date = date('Y-m-d', $beginningOfWeekLastYear);
									$end_date = date('Y-m-d', $endOfThisWeek);

		                    		echo '<h2>SKX Coupon ROI Report</h2>';
		                    		echo 'Right now, it\'s ' . date('l jS F Y H:i', $nowtimestamp)  . '<br>';
		                    		//echo 'One year ago exactly it was: ' . date('l jS F Y H:i', $yearago) . '<br>';
		                    		//echo 'The start of this week last year was: ' . date('l jS F Y H:i', $beginningOfWeekLastYear);
									echo '<br>Year to date: ' . $yearstart_date . ' - ' . $end_date . '<hr>';


									global $woocommerce;


									$yearstart_date = date('Y-m-d', 1389189925);
										
									$args = array(
										'post_type'			=> 'shop_order',
										'post_status' 		=> 'publish',
								        'posts_per_page' => -1,
								        'orderby' => 'date',
								        'order' => 'DESC',
								        'date_query' => array(
											array(
												'column' => 'post_date_gmt',
												'after'    => $yearstart_date . '00:00:00',
												),
											array(
												'column' => 'post_date_gmt',
												'before'    => $end_date . '23:59:59',
												//'inclusive' => true,
											),
										),

									);
									$orders = new WP_Query( $args );
									$skx_orders = array();
									$orders_array = $orders->posts;

									foreach($orders_array as $order){
									}

									while ( $orders->have_posts() ) : $orders->the_post();
									// ALL ORDERS WITHIN LAST 12 MONTHS IN THIS LOOP

										$order_id = $orders->post->ID;
										$order = new WC_Order($order_id);
										$couponsarray = $order->get_used_coupons();
										$skx = array();
										foreach($couponsarray as $coupon){
											$coupon_prefix = mb_substr($coupon, 0, 3);
											if( $coupon_prefix == 'skx' ){ $skx[] = 'yes'; }
										}
										
										if( in_array("yes", $skx) ){
											// ONLY ORDERS IN LAST 12 MONTHS THAT USED SKX COUPON IN THIS LOOP
											$order_number = $order->get_order_number();
											$order_date = $order->order_date;
											$order_date = mb_substr($order_date, 0, 10);
											$order_total = $order->get_total();
											$skx_code = implode($couponsarray, "-");
							                //$order_status = $order->get_status();
							                $skx_orders[] = array("order_number" => $order_number, "order_date"=> $order_date, "order_total" => $order_total, "skx_code" => $skx_code);
										}
									
									endwhile;

									echo '<h3>' . count($skx_orders) . ' SKX Orders in last 12 months</h3>';

									//Returns an array containing the years, months and week numbers between two dates
								    $begin = new DateTime( $yearstart_date );
								    $end = new DateTime( $end_date);
								    $end->add(new DateInterval('P1D')); //Add 1 day to include the end date as a day
								    $interval = new DateInterval('P1W'); //Add 1 week
								    $period = new DatePeriod($begin, $interval, $end);
								    $weeksArray = array();
								   
							    	foreach ( $period as $dt ){ 
								    	$weeksArray[]['date'] = $dt->format('Y') . '-' . $dt->format('m') . '-' . $dt->format('d');
								    	//$weeksArray[]['date'] = $dt;
								    }

								    echo '<table>';
								    echo '<tr class="headerrow">
											<th>Week Starting</th>
											<th>Coupons Issued</th>
											<th>Coupons Redemed</th>
											<th>Order Total</th>
										</tr>';

									$year_total = 0;
									$year_coupon_count = 0;
									$year_coupons_used = 0;
								    foreach ($weeksArray as $week) {
								    	$startdate = $week['date'];
										$enddate = strtotime($startdate);
										$enddate = strtotime("+6 day", $enddate);
										$enddate = date('Y-m-d', $enddate);

								    	$couponsloop = new WP_Query( array(
								            'post_type' => 'shop_coupon',
								            'posts_per_page' => '-1',
								            'orderby' => 'date',
								            'order' => 'ASC',
								            'date_query' => array(
												array(
													'column' => 'post_date_gmt',
													'after'    => $startdate . '00:00:00',
													),
												array(
													'column' => 'post_date_gmt',
													'before'    => $enddate . '23:59:59',
													//'inclusive' => true,
												),
											),
								        ) );

										$usedcouponsarray = array();
										$all_week_coupons = array();
										$couponCount = 0;
										$usedCouponsCount = 0;

										if ( $couponsloop->have_posts() ) {
											while ( $couponsloop->have_posts() ) : $couponsloop->the_post();
												$prefix = mb_substr(get_the_title(), 0, 3);
												if($prefix == 'skx'){
													//$couponsarray[$couponCount]['used'] = get_post_meta( get_the_ID(), 'usage_count', true );
													if (get_post_meta( get_the_ID(), 'usage_count', true )){ 
														$usedCouponsCount ++;
														$usedcouponsarray[$couponCount]['code'] = get_the_title();
														$usedcouponsarray[$couponCount]['date'] = get_the_date( 'Y-m-d', $id );
													}
													$couponCount ++;
													$all_week_coupons[$couponCount]['code'] = get_the_title();
													$all_week_coupons[$couponCount]['date'] = get_the_date( 'Y-m-d', $id );
												}
											endwhile;
										}
							
										$percentUsed = ($usedCouponsCount / $couponCount) *100;
										$percentUsed = number_format($percentUsed, 2);

										$this_week_total = 0;


										echo '<tr>';
								    		echo '<td>' . $startdate . '</td>';
									    	echo '<td>' . $couponCount;
										    	//echo '<br>';
									    		//print_r($all_week_coupons);
									    	echo '</td>';
									    	echo '<td>' . $usedCouponsCount . ' (' . $percentUsed . '%)<br>';
									    	if( !empty($usedcouponsarray)){
									    		foreach($usedcouponsarray as $usedcoupon){
									    			foreach($skx_orders as $key => $skx_order){
														$skx_order_number = $skx_order["order_number"];
														$skx_order_date = $skx_order["order_date"];
														$skx_order_total = $skx_order["order_total"];
														$skx_order_code = $skx_order["skx_code"];

														if( $skx_order_code ==  $usedcoupon['code']){ 
															//echo $skx_order_code . ' (£' . $skx_order_total . ')<br>'; 
															$this_week_total = $this_week_total + $skx_order_total;
														}
													}
										    		//echo $usedcoupon['code'] . '<br>';
										    	}
									    	}
									    	$year_total = $year_total + $this_week_total;
									    	$year_coupon_count = $year_coupon_count + $couponCount;
											$year_coupons_used = $year_coupons_used + $usedCouponsCount;
											$year_percentUsed = ($year_coupons_used / $year_coupon_count) *100;
											$year_percentUsed = number_format($year_percentUsed, 2);
									   							    		
									    	echo '</td>';
									    	echo '<td>£' . number_format($this_week_total, 2) . '</td>';

									    	

								    	echo '</tr>';
								    }
								    echo '<tr class="footerrow">
								    <td></td>
								    <td>Total Coupons: <b>' . $year_coupon_count . '</b></td>
								    <td>Total Used: <b>' . $year_coupons_used . ' (' . $year_percentUsed . '%)</b></td>
								    <td>Total: <b>£' . $year_total . '</b></td>

								    </tr>';
								    echo '</table>';

								    echo'<h3 style="text-align:center;">Average return per coupon: <b>£' . number_format($year_total / $year_coupon_count, 2) . '</b></h3>';

		                    	}







		                    	// Skincare Expert Combinations Report
		                    	if( $report == '4' ){


		                    		echo '<h2>Skincare Expert Combinations Report</h2>(Highlights Possible issues for any option combinations)<br>';
		                    		
		                    		$skx_taxonomies = array( 
		                    			'Acne' => 'acne', 
		                    			'Combination Oily' => 'combination_oily', 
		                    			'Dry' => 'dry', 
		                    			'Normal / Combination' => 'normal_combination', 
		                    			'Normal / Dry' => 'normal_dry', 
		                    			'Oily' => 'oily', 
		                    			'Acne (male)' => 'male_acne', 
		                    			'Combination Oily (male)' => 'male_combination_oily', 
		                    			'Dry (male)' => 'male_dry', 
		                    			'Normal / Combination (male)' => 'male_normal_combination', 
		                    			'Normal / Dry (male)' => 'male_normal_dry', 
		                    			'Oily (male)' => 'male_oily' 
	                    			);

	                    			foreach ($skx_taxonomies as $name => $tax_slug) {
	                    				echo '<a class="" href="' . get_permalink() . '?report=4&skintypeslug=' . $tax_slug . '&skintype=' . $name . '">Skincare Expert Product Report - ' . $name . '</a><br>';
	                    			}
		                    		
		                    		

		                    		//foreach ($skx_taxonomies as $name => $tax_slug) {
									if($skintype_gender_slug){

										$name = $skintype_gender_name;
										$tax_slug = $skintype_gender_slug;
					
		                    			$skin_type_terms = get_terms( $tax_slug, array(
										    'orderby'           => 'name', 
										    'order'             => 'ASC',
										    'hide_empty'        => true, 
										    'fields'            => 'all', 
										    'cache_domain'      => 'core'
											)
										);
		                    			echo '<h3>' . $name . '</h3>';

		                    			foreach ($skin_type_terms as $key => $skin_type_term) {
		                    				echo $skin_type_term->name . '<br>';
		                    				$term_slug = $skin_type_term->slug;

		                    				$prod_loop = new WP_Query( 
												array(
									            'post_type' => 'product',
									            'posts_per_page' => '-1',
									            'orderby' => 'title',
									            'order' => 'ASC',
									            'post_status' => 'publish',
									            'tax_query' => array(
														'relation' => 'AND',
														array(
															'taxonomy' => 'product_cat',
															'field'    => 'slug',
															'terms'    => array( 'samples' ),
															'operator' => 'NOT IN',
														),
														array(
															'taxonomy' => $tax_slug,
															'field'    => 'slug',
															'terms'    => array($term_slug),
															'operator' => 'IN',
														),
														array(
															'taxonomy' => 'recommendation_type',
															'field'    => 'slug',
															'terms'    => array('cleanser', 'toner', 'daily-treatment-cream', 'eye-treatment'),
															'operator' => 'IN',
														),
													),

										        ) 
									        );
									        wp_reset_postdata();

									        if ( $prod_loop->have_posts() ) {
									        	echo '<small>(' . $prod_loop->post_count . ' products)</small><br>';
									        	echo '<table>';
												while ( $prod_loop->have_posts() ) : $prod_loop->the_post();
												echo'<tr>';
													$rec_types_terms= wp_get_post_terms( get_the_ID(), 'recommendation_type' );
													$rec_types_array = '';
													foreach ($rec_types_terms as $key => $rec_types_term) {
														$rec_types_array[] = $rec_types_term->name;
													}
													$rec_type = implode(" ", $rec_types_array);
													echo '<td>' . $rec_type . '</td>';
													echo '<td><a target="blank" href="' . get_edit_post_link( get_the_ID(), '' ) . '">' . get_the_title(get_the_ID()) . '</a></td>';
													echo '</tr>';
												endwhile;
												echo '</table>';
											}

		                    				echo '<hr>';
		                    			}
		                    			echo '<br><hr>';
		                    		} else echo 'Please select a skintype to report on';

		                    	}









		                    	// SKINCARE EXPERT PRODUCTS REPORT
		                    	if( $report == '3' ){
		                    		$tax = 'product_range';
									$tax_terms = get_terms($tax,'hide_empty=0');

									foreach($tax_terms as $tax_term){
										echo '<h3 style="color:#ccc;">' . $tax_term->name . '</h3>';
										$prod_loop = new WP_Query( 
											array(
								            'post_type' => 'product',
								            'posts_per_page' => '-1',
								            'orderby' => 'title',
								            'order' => 'ASC',
								            'post_status' => 'any',
								            'tax_query' => array(
													'relation' => 'AND',
													array(
														'taxonomy' => 'product_cat',
														'field'    => 'slug',
														'terms'    => array( 'samples' ),
														'operator' => 'NOT IN',
													),
													array(
														'taxonomy' => $tax,
														'field'    => 'slug',
														'terms'    => $tax_term->slug,
														'operator' => 'IN',
													),
												),

									        ) 
								        );
								        wp_reset_postdata();


								        if ( $prod_loop->have_posts() ) {
											while ( $prod_loop->have_posts() ) : $prod_loop->the_post();
												$recommendation_type_terms = wp_get_post_terms( get_the_ID(), 'recommendation_type', array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all') );
												
												$acne_terms_f = wp_get_post_terms( get_the_ID(), 'acne', array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all') );
												$comb_oily_f = wp_get_post_terms( get_the_ID(), 'combination_oily', array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all') );
												$dry_f = wp_get_post_terms( get_the_ID(), 'dry', array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all') );
												$norm_comb_f = wp_get_post_terms( get_the_ID(), 'normal_combination', array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all') );
												$norm_dry_f = wp_get_post_terms( get_the_ID(), 'normal_dry', array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all') );
												$oily_f = wp_get_post_terms( get_the_ID(), 'oily', array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all') );

												$acne_terms_m = wp_get_post_terms( get_the_ID(), 'male_acne', array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all') );
												$comb_oily_m = wp_get_post_terms( get_the_ID(), 'male_combination_oily', array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all') );
												$dry_m = wp_get_post_terms( get_the_ID(), 'male_dry', array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all') );
												$norm_comb_m = wp_get_post_terms( get_the_ID(), 'male_normal_combination', array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all') );
												$norm_dry_m = wp_get_post_terms( get_the_ID(), 'male_normal_dry', array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all') );
												$oily_m = wp_get_post_terms( get_the_ID(), 'male_oily', array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all') );
												
												if( !empty($recommendation_type_terms) ){
													$rec_types_array = array();
													foreach ($recommendation_type_terms as $key => $recommendation_type_term) {
														$rec_types_array[] = $recommendation_type_term->name;
													}
													$rec_types = implode(" ", $rec_types_array);
													echo '<br><h3 style="font-weight:bold;">' . get_the_title() . '</h3><small>' . $rec_types . '</small><br>';
													//echo woocommerce_get_product_thumbnail('shop_catalog');
													echo '<a target="blank" href="' . get_edit_post_link( get_the_ID(), '' ) . '">';
													the_post_thumbnail('thumbnail');
													echo '</a><br><br>';

													if( !empty($acne_terms_f) ){ echo '<b>Female Acne Skin:</b><br>'; foreach ($acne_terms_f as $key => $acne_term_f) { echo $acne_term_f->name . '<br>'; } echo '<br>'; }
													if( !empty($comb_oily_f) ){ echo '<b>Female Combination / Oily Skin:</b><br>'; foreach ($comb_oily_f as $key => $comb_oily_f_term) { echo $comb_oily_f_term->name . '<br>'; } echo '<br>'; }
													if( !empty($dry_f) ){ echo '<b>Female Dry Skin:</b><br>'; foreach ($dry_f as $key => $dry_f_term) { echo $dry_f_term->name . '<br>'; } echo '<br>'; }
													if( !empty($norm_comb_f) ){ echo '<b>Female Normal / Combination Skin:</b><br>'; foreach ($norm_comb_f as $key => $norm_comb_f_term) { echo $norm_comb_f_term->name . '<br>'; } echo '<br>'; }
													if( !empty($norm_dry_f) ){ echo '<b>Female Normal / Dry Skin:</b><br>'; foreach ($norm_dry_f as $key => $norm_dry_f_term) { echo $norm_dry_f_term->name . '<br>'; } echo '<br>'; }
													if( !empty($oily_f) ){ echo '<b>Female Oily Skin:</b><br>'; foreach ($oily_f as $key => $oily_f_term) { echo $oily_f_term->name . '<br>'; } echo '<br>'; }

													if( !empty($acne_terms_m) ){ echo '<b>Male Acne Skin:</b><br>'; foreach ($acne_terms_m as $key => $acne_term_m) { echo $acne_term_m->name . '<br>'; } echo '<br>'; }
													if( !empty($comb_oily_m) ){ echo '<b>Male Combination / Oily Skin:</b><br>'; foreach ($comb_oily_m as $key => $comb_oily_m_term) { echo $comb_oily_m_term->name . '<br>'; } echo '<br>'; }
													if( !empty($dry_m) ){ echo '<b>Male Dry Skin:</b><br>'; foreach ($dry_m as $key => $dry_m_term) { echo $dry_m_term->name . '<br>'; } echo '<br>'; }
													if( !empty($norm_comb_m) ){ echo '<b>Male Normal / Combination Skin:</b><br>'; foreach ($norm_comb_m as $key => $norm_comb_m_term) { echo $norm_comb_m_term->name . '<br>'; } echo '<br>'; }
													if( !empty($norm_dry_m) ){ echo '<b>Male Normal / Dry Skin:</b><br>'; foreach ($norm_dry_m as $key => $norm_dry_m_term) { echo $norm_dry_m_term->name . '<br>'; } echo '<br>'; }
													if( !empty($oily_m) ){ echo '<b>Male Oily Skin:</b><br>'; foreach ($oily_m as $key => $oily_m_term) { echo $oily_m_term->name . '<br>'; } echo '<br>'; }

													//
												}
											endwhile;
										}
									echo '<hr>';
									}

								}








		                    	if( $report == '1' ){
		                    		ini_set('max_execution_time', 600);


		                    		$prod_loop = new WP_Query( array(
						            'post_type' => 'product',
						            'posts_per_page' => '-1',
						            'orderby' => 'title',
						            'order' => 'ASC',
						            'post_status' => 'any',
							        ) );


							        if ( $prod_loop->have_posts() ) {
							        	echo '<h2>Product Image URLs in order of product ID</h2>';
										while ( $prod_loop->have_posts() ) : $prod_loop->the_post();
											$product_image_id = get_post_thumbnail_id(  );
											$product_image_url = wp_get_attachment_thumb_url( $product_image_id );
											$prod_name = get_the_title($product_image_id);
											/*
											$filename = 'https://germaine-de-capuccini.co.uk/imgs/' . $prod_name . '.jpg';
											copy( $product_image_url , $filename);*/

											//if( !empty($product_image_url) ){ echo $product_image_url . '<br>'; } else{ echo '<br>'; }

											//if( !empty($product_image_url) ){ echo '<img src="' . $product_image_url . '" alt="' . $prod_name . '"><br>'; } else{ echo '<br>'; }
											the_post_thumbnail( 'medium' );
											echo '<br>';
										endwhile;
									}
									wp_reset_postdata();
		                    	}








						        
		                    	if( $report == '2' ){

								    // LOOP ALL COUPONS THAT ARE SET TO 'PUBLIC PROMO'
							        $coupon_promos = new WP_Query( array(
							            'post_type' => 'shop_coupon',
							            'posts_per_page' => '-1',
							            'orderby' => 'date',
							            'order' => 'DESC',
							            'meta_query' => array(
							                array(
							                    'key'     => 'public_promo',
							                    'value'   => '1',
							                    'compare' => 'IN',
							                ),
							            ),
							        ) );

							        // GET LATEST 'PUBLIC PROMO' COUPON
							        date_default_timezone_set('Europe/London');
							        $current_date = date("Y-m-d");
									echo '<h3>Today\'s Date: ' . $current_date . '</h3>';


									if ( $coupon_promos->have_posts() ) {
										echo '<h2>Current public coupon promotions:</h3><ul>';
										while ( $coupon_promos->have_posts() ) : $coupon_promos->the_post();

										// DEFINE THIS COUPON CODE & ITS META FIELDS
							                $auto_coupon_code = get_the_title();
											$all_meta = get_post_meta( get_the_id() );
											$coupon_type = $all_meta[discount_type][0];
											$coupon_amount = $all_meta[coupon_amount][0];

											$coupon_free_gifts_ids = $all_meta[gift_ids][0];
											$free_gifts_arr = explode(',', $coupon_free_gifts_ids);
							                $free_gifts = new WP_Query(
							                array(
							                    'post_type' => 'product',
							                    'posts_per_page' => -1,
							                    'post__in' => $free_gifts_arr
							                    )
							                );
							                $all_free_gifts = array();
							                while ( $free_gifts->have_posts() ) : $free_gifts->the_post();
							                    global $product;
							                    $price = $product->get_price();
							                    $all_free_gifts[] = '<b><a href="' . get_permalink() . '">' . get_the_title() . '</a></b> (worth £' . $price . ')';
							                endwhile;
							                $prizes_links_list = implode(" and ", $all_free_gifts);

											$minimum_spend = $all_meta[minimum_amount][0];
											$required_products = $all_meta[product_ids][0];
											$required_categories = $all_meta[product_categories][0];
											$excluded_products = $all_meta[exclude_product_ids][0];
											$excluded_categories = $all_meta[exclude_product_categories][0];
											$expiry_date = $all_meta[expiry_date][0];
											$usagecount = $all_meta[usage_count][0];

											if($current_date < $expiry_date){ 
												$expired = 'VALID';
											} else {
												$expired = 'EXPIRED';
											}

											// DO STUFF WITH DEFINED VARIABLES..
											echo '<li><h3>' . $auto_coupon_code . '</h3>';
											echo '<br>Expiry Date: ' . $expiry_date . ' - <b>' . $expired . '</b>';
											echo '<br>Used: <b>' . $usagecount . '</b> times';
											echo '<br>Type: ' . $coupon_type;
											if ($coupon_amount){echo '<br>Amount: ' . $coupon_amount;}
											if ($coupon_free_gifts_ids){echo '<br>Free gift(s): ' . $prizes_links_list;}
											echo '<br>min spend: £' . $minimum_spend;
											echo '<br>required products: ' . $required_products;
											echo '<br>required categories: ' . $required_categories;
											echo '<br>excluded products: ' . $excluded_products;
											echo '<br>excluded categories: ' . $excluded_categories;
											echo '<br>';
											//print_r($all_meta);
											echo '<hr></li>';


										endwhile;
										echo '</ul>';
										// Prevent weirdness
										wp_reset_postdata();
									}
								}



							} else{
								echo '<h3>You must be a staff member to view this!</h3>';
								$args = array(
									'value_remember' => true
								);
								wp_login_form( $args );
								
							}
	                    ?>
					</div><!-- .entry-content -->
				</div><!-- #post -->
			<?php
	        	thematic_belowpost();        		
        		endwhile;
	        	get_sidebar( 'page-bottom' );
	        ?>
			</div><!-- #content -->
			<?php thematic_belowcontent(); ?> 
		</div><!-- #container -->
<?php 
    thematic_belowcontainer();
    //thematic_sidebar();
    get_footer();
?>