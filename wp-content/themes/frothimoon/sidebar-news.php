<!-- NEWS SIDEBAR -->
<div class="main-aside">
<ul>
<li>
<h3>Recent News</h3>
</li>

<?php $loop = new WP_Query( array( 
										'post_type' => 'post',
										'cat' => '10',
										'orderby' => 'date',
										'posts_per_page' => '8', 
										'order' => 'DESC'
										) ); ?>
			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
<li class="noborder">
<a href="<?php the_permalink(); ?>"><?php the_title();?></a>
</li>
<?php endwhile; ?>
</ul>

<ul>
<?php wp_list_categories( array(
							'orderby' 	=>	'date',
							'title_li'           => __( '<h3>Read About</h3>' )
	)
); ?> 

</ul>





</div>
<!-- END NEWS PAGE SIDEBAR -->
