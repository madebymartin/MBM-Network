<h1>Pages</h1>
<ul>
<?php
// Add pages you'd like to exclude in the exclude here
wp_list_pages(
  array(
    'exclude' => 'sm-location','shop_coupon',
    'title_li' => '',
  )
);
?>
</ul>



<h1>Products</h1>
<ul class="">
<?php $loop = new WP_Query( array( 
										'post_type' => 'product',
										'orderby' => 'name',
										'posts_per_page' => '-1', 
										'order' => 'ASC'
										) ); ?>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
<li><a href="<?php echo get_permalink(); ?>"><?php the_title();?></a></li>
<?php endwhile; ?>
</ul>


<h1>Customer Stories</h1>
<ul class="">
<?php $loop = new WP_Query( array( 
										'post_type' => 'story',
										'orderby' => 'date',
										'posts_per_page' => '-1', 
										'order' => 'DESC'
										) ); ?>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
<li><a href="<?php echo get_permalink(); ?>"><?php the_title();?></a></li>
<?php endwhile; ?>
</ul>