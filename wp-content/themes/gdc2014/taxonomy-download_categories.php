<?php
    // calling the header.php
    get_header();

    // action hook for placing content above #container
    thematic_abovecontainer();
?>
<div id="container">


<?php if ( current_user_can('access_trade_content') ) { 


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
	$term =	$wp_query->queried_object; 
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
			<div class="panel"><p><?php echo $termDiscription; ?></p></div>
			<?php endif; ?>


			<?php 
			$termslug = $term->slug;
			$loop = new WP_Query( array( 
				'post_type' => 'downloads', 
				'tax_query' => array(
					array(
						'taxonomy' => 'download_categories',
						'field' => 'slug',
						'terms' => $termslug,
						'include_children' => 'false'
					)
				), 
				'posts_per_page' => -1, 
				'paged' => $paged,
				'orderby' => 'date', 
				'order' => 'DESC' ,
				'parent' => '0',
				'hide_empty' => 1,
				) 
			); 
	
		$subcategories = apply_filters( 'taxonomy-images-get-terms', '', array(
			'taxonomy'     => $term->taxonomy, 
			'having_images' => 'true',
			'term_args' =>	array(
					'parent'    => $term->term_id,
					)
			) 
		);

		print '<ul class="margin0 padding0">';
		if ( ! empty( $subcategories ) ) {
			//Sub Cats Exist
		    foreach( (array) $subcategories as $subcategory ) {
		    	//print_r($subcategory);
		        print '<li class="tradesupport"><a href="' . esc_url( get_term_link( $subcategory, $subcategory->taxonomy ) ) . '">' . wp_get_attachment_image( $subcategory->image_id, 'thumb' ) . '<h3>' . esc_html( $subcategory->name ) . '</h3><p>' . $subcategory->description . '</p></a></li>';
		    }
		}
		else{
			//NO Sub Cats - Show posts
			?>
				<ul class="margin0 padding0 support">
						<?php query_posts($query_string . '&orderby=title&order=ASC');?>
						<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
					

							<li class="tradesupport">
									<?php 
									if ( has_post_thumbnail() ) { ?>
										<a href="<?php the_permalink(); ?>" title="<?php printf( __('%s', 'your-theme'), the_title_attribute('echo=0') ); ?>" rel="bookmark" id="post-<?php the_ID(); ?>">
											<?php the_post_thumbnail('medium'); ?>
										</a>

									<?php } else { ?>

										<a href="<?php the_permalink(); ?>" title="<?php printf( __('%s', 'your-theme'), the_title_attribute('echo=0') ); ?>" rel="bookmark" id="post-<?php the_ID(); ?>">
											<img src="<?php bloginfo("stylesheet_directory"); ?>/images/GDC-swan-white.png" alt="gdc swan">
										</a><?php } ?>


										<a class="viewlarge" href="<?php the_permalink(); ?>" title="<?php printf( __('%s', 'your-theme'), the_title_attribute('echo=0') ); ?>" rel="bookmark" id="post-<?php the_ID(); ?>">
											<img src="<?php bloginfo('stylesheet_directory'); ?>/images/view.png" width="25" style="width:25px; padding:1px; margin:0;">View
										</a>

										<div class="inset">
											<h3><?php the_title(); ?></h3>
											<?php the_excerpt(); ?>

											<ul class="margin0 padding0 downloads">
							                    <?php if ( get_post_meta(get_the_ID(), '_cmb_generic', true) ) { ?>
							                    <li><a target="blank" href="<?php echo get_post_meta(get_the_ID(), "_cmb_generic", true); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/download-icon.png" alt="High res PDF" width="30" style="width:30px;"/>Download</a></li>
							                    <?php } else { ?><?php } ?>

							                    <?php if ( get_post_meta(get_the_ID(), '_cmb_generic2', true) ) { 
							                      $attachment_id = get_post_meta(get_the_ID(), "_cmb_generic2", true);
							                      $attachment_url = wp_get_attachment_url( $attachment_id );
							                    ?>
							                    <li><a target="blank" href="<?php echo $attachment_url ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/download-icon.png" alt="High res PDF" width="30" style="width:30px;"/>Download</a></li>
							                    <?php } else { ?><?php } ?>



							                    <?php if ( get_post_meta(get_the_ID(), '_cmb_high_res', true) ) { ?>
							                    <li><a target="blank" href="<?php echo get_post_meta(get_the_ID(), "_cmb_high_res", true); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/download-icon.png" alt="High res PDF" width="30" style="width:30px;"/>Download to print in-house</a></li>
							                    <?php } else { ?><?php } ?>

							                    <?php if ( get_post_meta(get_the_ID(), '_cmb_high_res2', true) ) { 
							                      $attachment_id = get_post_meta(get_the_ID(), "_cmb_high_res2", true);
							                      $attachment_url = wp_get_attachment_url( $attachment_id );
							                    ?>
							                    <li><a target="blank" href="<?php echo $attachment_url ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/download-icon.png" alt="High res PDF" width="30" style="width:30px;"/>Download to print in-house</a></li>
							                    <?php } else { ?><?php } ?>



							                    <?php if ( get_post_meta(get_the_ID(), '_cmb_print-ready', true) ) { ?>
							                    <li><a target="blank" href="<?php echo get_post_meta(get_the_ID(), "_cmb_print-ready", true); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/download-icon.png" alt="High res PDF" width="30" style="width:30px;"/>Download to print professionally</a></li>
							                    <?php } else { ?><?php } ?>

							                    <?php if ( get_post_meta(get_the_ID(), '_cmb_print-ready2', true) ) { 
							                      $attachment_id = get_post_meta(get_the_ID(), "_cmb_print-ready2", true);
							                      $attachment_url = wp_get_attachment_url( $attachment_id );
							                    ?>
							                    <li><a target="blank" href="<?php echo $attachment_url ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/download-icon.png" alt="High res PDF" width="30" style="width:30px;"/>Download to print professionally</a></li>
							                    <?php } else { ?><?php } ?>



							                    <?php if ( get_post_meta(get_the_ID(), '_cmb_low_res', true) ) { ?>
							                    <li><a target="blank" href="<?php echo get_post_meta(get_the_ID(), "_cmb_low_res", true); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/download-icon.png" alt="High res PDF" width="30" style="width:30px;"/>Download to view on-screen</a></li>
							                    <?php } else { ?><?php } ?>

							                    <?php if ( get_post_meta(get_the_ID(), '_cmb_low_res2', true) ) { 
							                      $attachment_id = get_post_meta(get_the_ID(), "_cmb_low_res2", true);
							                      $attachment_url = wp_get_attachment_url( $attachment_id );
							                    ?>
							                    <li><a target="blank" href="<?php echo $attachment_url ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/download-icon.png" alt="High res PDF" width="30" style="width:30px;"/>Download to view on-screen</a></li>
							                    <?php } else { ?><?php } ?>


							                </ul>	
										</div>						
									<br>
						    </li>


						<?php endwhile; ?>
				</ul>
				<?php wp_reset_query(); ?>

			<?php
		}
		print '</ul>'; 
		?>

		
		<?php thematic_belowpost();
	    // calling the widget area 'page-bottom'
	    get_sidebar('page-bottom');
	    ?>
		</div>
	</div><!-- #content -->
	<?php thematic_belowcontent(); 

} 
else{
	// Shouldn't be here!
	echo 'Marketing Support material is for existing <strong>trade</strong> customers only. Please log in using your trade customer account.';
} ?>


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