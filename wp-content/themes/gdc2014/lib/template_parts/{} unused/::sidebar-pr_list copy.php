<?php

	// query to create loop
	$loop = new WP_Query( array( 
		'post_type' => 'pressarticle',
		'posts_per_page' => '-1',
		'meta_key' => '_cmb_publicationdateunix',
		'orderby' => 'meta_value_num',
		'order' => 'DESC'
		) 
	); ?>
	<h3>All press articles:</h3>

	<?php while ( $loop->have_posts() ) : $loop->the_post(); 
	$unixtimestamp = get_post_meta($post->ID, '_cmb_publicationdateunix', true);
	?>
		<a href="<?php the_permalink(); ?>" title="<?php printf( __('%s', 'your-theme'), the_title_attribute('echo=0') ); ?>" rel="bookmark" id="post-<?php the_ID(); ?>" class="listing entypo-right-dir">
			<?php the_title(); ?><span class="date"> (<?php echo date_i18n( 'F Y',$unixtimestamp) ?>)</span>
		</a>
	<?php endwhile; ?>
	<?php wp_reset_query(); ?>
	<br>
</div>