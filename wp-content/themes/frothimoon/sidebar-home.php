<!-- HOME PAGE SIDEBAR -->
<div class="main-aside">
<ul>
<li class="noborder">
<h3>Latest Special Offers</h3>
</li>
<?php $loop = new WP_Query( array( 
										'post_type' => 'post',
										'cat' => '11',
										'orderby' => 'date',
										'posts_per_page' => '3', 
										'order' => 'DESC'
										) ); ?>
			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
<li class="noborder">

<h4 class="newstitle"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('smallsquare', array('class' => 'news'));?></a>
<a class="newstitle" href="<?php the_permalink(); ?>">Read More ></a>
<div class="clear"></div>

</li>
			<?php endwhile; ?>
</ul>
<ul>
<li>
<h3>Latest News</h3>
</li>

<?php $loop = new WP_Query( array( 
										'post_type' => 'post',
										'cat' => '12, 13, 14',
										'orderby' => 'date',
										'posts_per_page' => '3', 
										'order' => 'DESC'
										) ); ?>
			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
<li class="noborder">

<h4 class="newstitle"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4> 
<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('smallsquare', array('class' => 'news'));?></a>
<a class="newstitle" href="<?php the_permalink(); ?>">Read More ></a>
<div class="clear"></div>

</li>
			<?php endwhile; ?>
</ul>
</div>
<!-- END HOME PAGE SIDEBAR -->