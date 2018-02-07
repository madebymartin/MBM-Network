<?php 
// query to create loop
$loop = new WP_Query( array( 
	'post_type' => 'treatments', 
	'posts_per_page' => -1, 
	'orderby' => 'title', 
	'order' => 'ASC',
	   'meta_query' => array(
		       array(
	           'key' => '_cmb_treatmentofmonth',
	           'value' => 'on',
	           'compare' => 'IN',
		       )

	   )
	) 
); 

while ( $loop->have_posts() ) : $loop->the_post(); ?>
	<a href="<?php the_permalink(); ?>" title="<?php printf( __('%s', 'your-theme'), the_title_attribute('echo=0') ); ?>" rel="bookmark" id="post-<?php the_ID(); ?>">
		<?php
		if (MultiPostThumbnails::has_post_thumbnail(get_post_type(), 'featured_treatment')) { MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'featured_treatment', NULL,  '', array('class' => '')); }
		else{the_title();} 
		?>
	</a>
<?php endwhile; 
wp_reset_query(); ?>