<?php
    // calling the header.php
    get_header();

    // action hook for placing content above #container
    thematic_abovecontainer();
?>
<div id="container">
			<?php thematic_abovecontent(); ?>
			<div id="content">

				<div class="hentry">
	<?php
	// calling the widget area 'page-top'
	get_sidebar('page-top');
	the_post();
	thematic_abovepost();

?>


<?php get_template_part( 'lib/template_parts/title', 'banner' ); ?>
	
					
			<?php 
			$loop = new WP_Query( array( 
			'post_type' => 'treatments', 
			$taxonomy => $term, 
			'posts_per_page' => -1, 
			'paged' => $paged,
			'orderby' => 'title', 
			'order' => 'ASC' 
			) 
		); 
	?>
			

			<div class="clear"></div>

			<?php $termDiscription = term_description( '', get_query_var( 'taxonomy' ) );
			if($termDiscription != '') : ?>
			<p><?php echo $termDiscription; ?></p>
			<?php endif; ?>



	<ul class="treatments">
			<?php query_posts($query_string . '&orderby=title&order=ASC');?>
			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<li>
			<a href="<?php the_permalink(); ?>" title="<?php printf( __('%s', 'your-theme'), the_title_attribute('echo=0') ); ?>" rel="bookmark" id="post-<?php the_ID(); ?>" class="listing">
				<h4><?php the_title(); ?>

				<?php if ( get_post_meta(get_the_ID(), '_cmb_treatmentduration', true) ) { ?>
					<span class="duration entypo-clock"> <?php echo get_post_meta(get_the_ID(), "_cmb_treatmentduration", true); ?> minutes</span></h4>
					<?php } else { ?></h4><?php } ?>


					<?php if ( ! has_excerpt() ) {?>
						<span class="excerpt"><?php the_content(); ?></span>
					<?php } else { ?>
						<span class="excerpt"><?php echo get_the_excerpt(); } ?></span>

					<span class="entypo-right-dir right">More info</span>
			</a>

	        <?php 
	        //edit_post_link( 'Edit this treatment', '<span class="edit-link entypo-pencil">', '</span>', $id ); 
	        ?> 

	    </li>
			<?php endwhile; ?>
	</ul>
		<?php wp_reset_query(); ?>
		
		<?php thematic_belowpost();
	    // calling the widget area 'page-bottom'
	    get_sidebar('page-bottom');
	    ?>
		</div>
	</div><!-- #content -->
	<?php thematic_belowcontent(); ?> 
</div><!-- #container -->


<?php 

    // action hook for placing content below #container
    thematic_belowcontainer();



	 // calling the standard sidebar 
    thematic_sidebar();

    
    // calling footer.php
    get_footer();

?>