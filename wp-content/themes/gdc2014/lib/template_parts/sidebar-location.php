<div class="aside">

	<h3>Spa Contact Details</h3>
	<?php
	wp_reset_query();
		$meta = get_post_meta(get_the_ID());
		//print_r($meta) ;
	?>

	<?php if ( get_post_meta(get_the_ID(), 'location_address', true) ) { ?>
		<span><?php echo get_post_meta(get_the_ID(), 'location_address', true); ?></span><br>
	<?php } else { } ?>

	<?php if ( get_post_meta(get_the_ID(), 'location_address2', true) ) { ?>
		<span><?php echo get_post_meta(get_the_ID(), 'location_address2', true); ?></span><br>
	<?php } else { } ?>

	<?php if ( get_post_meta(get_the_ID(), 'location_city', true) ) { ?>
		<span><?php echo get_post_meta(get_the_ID(), 'location_city', true); ?></span><br>
	<?php } else { } ?>

	<?php if ( get_post_meta(get_the_ID(), 'location_state', true) ) { ?>
		<span><?php echo get_post_meta(get_the_ID(), 'location_state', true); ?></span><br>
	<?php } else { } ?>

	<?php if ( get_post_meta(get_the_ID(), 'location_zip', true) ) { ?>
		<span><?php echo get_post_meta(get_the_ID(), 'location_zip', true); ?></span><br>
	<?php } else { } ?>

<br><hr>

	<?php if ( get_post_meta(get_the_ID(), 'location_phone', true) ) { ?>
		<span>Telephone: <?php echo get_post_meta(get_the_ID(), 'location_phone', true); ?></span><br>
	<?php } else { } ?>

<br><hr>

	<?php if ( get_post_meta(get_the_ID(), 'location_url', true) ) { ?>
		<span class='entypo-email'><a target="blank" href="<?php echo get_post_meta(get_the_ID(), 'location_url', true); ?>">Visit Website</a></span><br>
	<?php } else { } ?>


	<?php if ( get_post_meta(get_the_ID(), 'location_email', true) ) { ?>
		<span><a href="mailto:<?php echo get_post_meta(get_the_ID(), 'location_email', true); ?>">Email Spa</a></span><br>
	<?php } else { } ?>


	<?php if ( get_post_meta(get_the_ID(), 'location_special', true) ) { ?>
		<a href="//germaine-de-capuccini.co.uk/product-category/spa-vouchers/">Buy Vouchers for This Spa</a>
	<?php } else { } ?>
</div>

<div class="aside">
<h3>All Spa Retreats</h3>
<?php $loop = new WP_Query( array( 
'post_type' => 'sm-location', 
'posts_per_page' => -1,
'orderby' => 'title', 
'order' => 'ASC'

) ); ?>
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<?php if ( get_post_meta(get_the_ID(), 'location_special', true) ) { ?>

				<a class="listing" href="<?php echo get_permalink(); ?>">
					<?php if ( has_post_thumbnail() ) { ?>
						<?php the_post_thumbnail('banner'); ?>
					<?php } else{ ?>
						<img src="<?php bloginfo( stylesheet_directory); ?>/images/placeholder.png " width="36px" />
					<?php } ?>
					<?php the_title(); ?>
				</a>


			
	<?php } else { ?><?php } ?>
	<?php endwhile; ?>



</div>