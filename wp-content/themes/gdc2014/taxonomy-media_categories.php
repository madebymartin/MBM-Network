<?php if ( current_user_can('access_trade_content') ) { 
    // calling the header.php
	    get_header();

	    // action hook for placing content above #container
	    thematic_abovecontainer();
	?>
	<div id="container">

<?php
		thematic_abovecontent(); ?>
		<div id="content">

			<div class="hentry">
			<?php
			// calling the widget area 'page-top'
			get_sidebar('page-top');
			the_post();
			thematic_abovepost();

			$term =	$wp_query->queried_object;

			$bannerimage = apply_filters( 'taxonomy-images-queried-term-image', '', array(
		    'after' => '',
		    'attr' => array(
		        'alt'   => $term->name,
		        'class' => 'mobile_feature_image',
		        'title' => $term->name,
		        ),
		    'before' => '',
		    'image_size' => 'banner',
		    ) );
			?>

			<div class="homebanner">
			    <?php echo $bannerimage; ?>
			    <div id="bannerwrapouter">
			            <h1 class="page-title keymessage"><?php echo $term->name; ?></h1>
			    </div>
			</div>
					
			<div class="clear"></div>

			<?php $termDiscription = term_description( '', get_query_var( 'taxonomy' ) );
			if($termDiscription != '') : ?>
			<div class="panel"><?php echo $termDiscription; ?></div>
			<?php endif;

			$termslug = $term->slug;
			$medialoop = new WP_Query( array( 

				//'post_parent' => $post->ID,
				'orderby'           => 'title', 
			    'order'             => 'ASC',
                'post_status' => 'any',
                'post_type'=> 'attachment',
                'post_mime_type' => 'image/jpeg,image/gif,image/jpg,image/png',
                'paged' => false,
                'posts_per_page' => -1,

				'tax_query' => array(
					array(
						'taxonomy' => 'media_categories',
						'field' => 'slug',
						'terms' => $termslug,
						'include_children' => 'false'
					)
				), 
				

				) 
			); 

			$args = array(
			    'orderby'           => 'name', 
			    'order'             => 'ASC',
			    'hide_empty'        => false, 
			    'exclude'           => array(), 
			    'exclude_tree'      => array(), 
			    'include'           => array(),
			    'number'            => '', 
			    'fields'            => 'all', 
			    'slug'              => '', 
			    'parent'            => '',
			    'hierarchical'      => true, 
			    'child_of'          => 0, 
			    'get'               => '', 
			    'name__like'        => '',
			    'description__like' => '',
			    'pad_counts'        => false, 
			    'offset'            => '', 
			    'search'            => '', 
			    'cache_domain'      => 'core'
			); 
			$media_categories = get_terms( 'media_categories', $args );

			if( !empty($medialoop) ){
				echo '<ul class="margin0 padding0">';
					while ( $medialoop->have_posts() ) : $medialoop->the_post();
					$media_id = get_the_id();
					$meta = get_post_meta($media_id);
					$filename = $meta['_wp_attached_file'][0];
					$media_url = wp_get_attachment_url( $media_id );
					echo '<li class="image_download">';
						echo '<a href="' . $media_url .'" download="' . $filename . '" title="' . get_the_title() . '">';
							echo '<span class="icon"></span>';
							echo '<div class="square ' . $term->name . '">' . wp_get_attachment_image( $media_id, array(400,400)) . '</div>';
							echo '<br>' . get_the_title();
						echo '</a>';
					echo '</li>';					
					endwhile;
				echo '</ul>';
			}
			

			thematic_belowpost();
		    // calling the widget area 'page-bottom'
		    get_sidebar('page-bottom');
		    ?>
			</div>
		</div><!-- #content -->
	<?php thematic_belowcontent(); 

} 
else{
	// Shouldn't be here!
	wp_redirect( home_url() ); exit;
}?>


</div><!-- #container -->


<?php 

    // action hook for placing content below #container
    thematic_belowcontainer();
    
    //	thematic_sidebar();
    get_template_part( 'lib/template_parts/sidebar', 'current_user_info' );
	get_template_part( 'lib/template_parts/sidebar', 'image_library' );
	get_template_part( 'lib/template_parts/sidebar', 'download_subcat_list' );
	get_template_part( 'lib/template_parts/sidebar', 'download_cat_list' );
    ?>

    
<?php get_footer(); ?>