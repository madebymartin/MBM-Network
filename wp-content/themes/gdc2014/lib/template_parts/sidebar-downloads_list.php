<?php if ( current_user_can('access_trade_content') ) { ?>

	<div class="aside category-list">
		<?php 

		//Returns Array of Term ID's for "my_term"
		$term_list = wp_get_post_terms($post->ID, 'download_categories');

		// set variables from returned array objects
		foreach ($term_list as $entry) {
	      $current_term_id = $entry->term_id;
	      $current_term_name = $entry->name;
	      $temp = get_the_ID();
		}
		// query to create loop
		$loop = new WP_Query( array( 
			'post_type' => 'downloads', 
			'posts_per_page' => -1, 
			'orderby' => 'title', 
			'order' => 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => 'download_categories',
					'field' => 'id',
					'terms' => $current_term_id
					)
				)
			) 
		); ?>
		<h3><?php echo $current_term_name; ?>:</h3>

		<?php 
		//print_r($entry); 
		?>

		<?php while ( $loop->have_posts() ) : $loop->the_post(); 
	$class = ( $temp == get_the_ID() ) ? 'currentitem' : '';
	?>
		<a href="<?php the_permalink(); ?>" title="<?php printf( __('%s', 'your-theme'), the_title_attribute('echo=0') ); ?>" rel="bookmark" id="post-<?php the_ID(); ?>" class="listing entypo-right-dir <?php echo $class ?>">
			<?php the_title(); ?>
		</a>
	<?php endwhile; ?>
		<?php wp_reset_query(); ?>
		<br>
	</div>
	
<?php } else { 
	//get_template_part( 'lib/template_parts/sidebar', 'trade' ); 
} ?>