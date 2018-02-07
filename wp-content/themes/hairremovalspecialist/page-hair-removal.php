<?php
    // calling the header.php
    get_header();

    // action hook for placing content above #container
    thematic_abovecontainer();
?>

		<div id="container">
			<?php
				// action hook for placing content above #content
				thematic_abovecontent();

				// filter for manipulating the element that wraps the content
				echo apply_filters( 'thematic_open_id_content', '<div id="content">' . "\n" );

				// calling the widget area 'page-top'
	            get_sidebar('page-top');

	            // start the loop
	            while ( have_posts() ) : the_post();

				// action hook for placing content above #post
	            thematic_abovepost();
	        ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
				<?php
	                // creating the post header
	                // thematic_postheader();
				?>
					<div class="entry-content">

						<?php
	                    	the_content();
	                    	wp_link_pages( "\t\t\t\t\t<div class='page-link'>" . __( 'Pages: ', 'thematic' ), "</div>\n", 'number' );
	                    	edit_post_link( __( 'Edit page', 'thematic' ), "\n\t\t\t\t\t\t" . '<span class="edit-link">' , '</span>' . "\n" );
	                    ?>

						

						<?php $terms = apply_filters( 'taxonomy-images-get-terms', '', array(
												'taxonomy'     => 'treatment_type',
												'having_images' => 'true',
												'parent'        =>  '0',
										        'hide_empty' => '0',
											) );

						if ( sizeof( $terms ) ) { ?>
								<?php 
								if ( ! empty( $terms ) ) {

									$overlayimg = '' . get_bloginfo('stylesheet_directory') . '/images/page-image-frame2.png';

								    foreach( $terms as $term ) {
										print '<h2>' . esc_html( $term->name ) . '</h2>';
								        print '<div class="imageholder"><img class="imageoverlay" src="'  . $overlayimg .  '" alt="penny turvey"/>' . wp_get_attachment_image( $term->image_id, 'page_image', '', array( 'class'	=> "treatment-type-image") ) . '</div>';
								        print $term->description;
										$query = new WP_Query( 
												array(
												'post_type' => 'treatment',
												'order' => 'DESC',
												'orderby' => 'name',
												'tax_query' => array(
													array(
														'taxonomy' => 'treatment_type',
														'field' => 'slug',
														'terms' => $term->slug
													)
												)
											)
										 );

										while ( $query->have_posts() ) : $query->the_post(); ?>
											<div class="treatment">
												<h3><?php the_title(); ?><span class="small"><?php edit_post_link( __( '(Edit treatment)', 'thematic' ), "\n\t\t\t\t\t\t" . '<span class="edit-link">' , '</span>' . "\n" ); ?></span></h3>
												<?php 
												echo wpautop(get_the_content());

												$pricing = get_post_meta(get_the_ID(), 'mbm_pricing', false);
												if ( ! empty( $pricing ) ) { 
													// Price exist!
													echo '<ul class="prices">';
													foreach( $pricing as $price ) {
														$treatment_price = '' . $price['mbm_treatment_price'];
														$treatment_price_format = $price['mbm_treatment_price_format'] . ' ';
														echo '<li>' . $treatment_price_format . '' . $treatment_price . '</li>';
													}
													echo '</ul>';
												} else{ echo'<em>Please contact Penny for prices</em>';}
												?>
											</div>
										<?php endwhile; 
										wp_reset_postdata();
								        print '<hr>';
								    }
								}
						 } else {}
						echo'<br>'; 
					 ?> 





					</div><!-- .entry-content -->
				</div><!-- #post -->

			<?php
				// action hook for inserting content below #post
	        	thematic_belowpost();

       			// action hook for calling the comments_template
       			// thematic_comments_template();

	        	// end loop
        		endwhile;

	        	// calling the widget area 'page-bottom'
	        	get_sidebar( 'page-bottom' );
	        ?>
			</div><!-- #content -->

			<?php
				// action hook for placing content below #content
				thematic_belowcontent();
			?>
		</div><!-- #container -->
<?php
    // action hook for placing content below #container
    thematic_belowcontainer();

    // calling the standard sidebar
    thematic_sidebar();

    // calling footer.php
    get_footer();
?>