<div class="aside category-list">
	<h3 class="boxheading"><?php echo date('F'); ?>'s Featured Treatments</h3>
	<div class="product_summary panel">
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
		?>

		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
			<a href="<?php the_permalink(); ?>" title="<?php printf( __('%s', 'your-theme'), the_title_attribute('echo=0') ); ?>" rel="bookmark" id="post-<?php the_ID(); ?>" class="listing">
				

				<h4><?php the_title(); ?>

				<?php if ( get_post_meta(get_the_ID(), '_cmb_treatmentduration', true) ) { ?>
				<span class="duration entypo-clock"> <?php echo get_post_meta(get_the_ID(), "_cmb_treatmentduration", true); ?> minutes</span></h4>
				<?php } else { ?></h4><?php } ?>

<?php the_post_thumbnail( 'thumb', array( 'class'	=> "mobilehide asidethumb", ) ); ?>


				<?php if ( ! has_excerpt() ) {?>
					<span class="excerpt"><?php the_content(); ?></span>
				<?php } else { ?>
					<span class="excerpt"><?php echo get_the_excerpt(); } ?></span>

				<span class="entypo-right-dir right">More info</span>





			</a>
		<?php endwhile; ?>
		<?php wp_reset_query(); ?>
	</div>
</div>