	<div class="aside"><h3>Trade Customer Support</h3>
		<?php 
		$current_user = wp_get_current_user();
		$currentuserid = get_current_user_id();
		$all_user_meta = get_user_meta($currentuserid);
		$accountnumber = get_user_meta($currentuserid, 'accountnumber');
		$accountname =  get_user_meta($currentuserid, 'accountname');

		echo '<div class="note">';
		echo 'Signed in as: ' . $current_user->display_name . '<br>';
		echo 'Account Number: ' . $accountnumber['0'] . '<br>';
		echo 'Account Name: ' . $accountname['0'] . '<br>';
		print_r($all_user_meta);
		echo '</div>';

		if ( ! is_page( 'trade-ordering' ) || ! is_page( '6610' )){?>
			<a class="button" href="<?php echo get_permalink('6610'); ?>">Trade Ordering</a>
		
	</div>
<?php } ?>