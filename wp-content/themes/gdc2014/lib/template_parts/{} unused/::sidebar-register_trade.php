<div class="aside">
	<?php 
	$salon_loop = new WP_Query( array( 
	'post_type' => 'sm-location', 
	'posts_per_page' => -1,
	'orderby' => 'title', 
	'order' => 'ASC'
	) );
/*
	echo 'Signed in as: ' . $current_user->display_name . '<br>';
	echo 'Account Number: ' . $accountnumber['0'] . '<br>';
	echo 'Account Name: ' . $accountname['0'] . '<br>';	
	*/
	?>


	<ul>
		<?php 
		while ( $salon_loop->have_posts() ) : $salon_loop->the_post(); 
			$account_number = get_post_meta(get_the_ID(), '_cmb_spa_account_number', true);
			$all_meta = get_post_meta(get_the_ID());
			if($account_number == 'MS0001'){
				echo '<li>' . get_the_title() . '';
				print_r($all_meta );
				echo'</li>';

			}
		endwhile; 
		?>
	</ul>
	
</div>
