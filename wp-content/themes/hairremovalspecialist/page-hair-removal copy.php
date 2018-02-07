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

						<?php $args = array(
							'type'                     => 'treatment',
							'child_of'                 => 0,
							'parent'                   => '',
							'orderby'                  => 'name',
							'order'                    => 'DESC',
							'hide_empty'               => 0,
							'hierarchical'             => 1,
							'exclude'                  => '',
							'include'                  => '',
							'number'                   => '',
							'taxonomy'                 => 'treatment_type',
							'pad_counts'               => false 

						);
						$categories = get_categories( $args ); 
						foreach($categories as $category) { 
						    echo '<h2>' . $category->name . '</h2>';
						    
						    print apply_filters( 'taxonomy-images-queried-term-image', '', array( 'image_size' => 'full' )  );
						    echo $category->description;

							$query = new WP_Query( 
								array(
								'post_type' => 'treatment',
								'tax_query' => array(
									array(
										'taxonomy' => 'treatment_type',
										'field' => 'slug',
										'terms' => $category->slug
									)
								)
							)
						 );

						while ( $query->have_posts() ) : $query->the_post(); ?>
						
							<h3><?php the_title(); ?><span class="small"><?php edit_post_link( __( '(Edit treatment', 'thematic' ), "\n\t\t\t\t\t\t" . '<span class="edit-link">' , '</span>' . "\n" ); ?></span></h3>
							
							<?php $pricing = get_post_meta(get_the_ID(), 'mbm_pricing', false);
							if ( ! empty( $pricing ) ) { 
								// Price exist!
								echo '<ul class="prices">';
								foreach( (array) $pricing as $price ) {
									$treatment_price = '' . $price['mbm_treatment_price'];
									$treatment_price_format = $price['mbm_treatment_price_format'] . ' ';
									echo '<li>' . $treatment_price_format . '' . $treatment_price . '</li>';
								}
								echo '</ul>';
							} else{ echo'<em>Please contact Penny for prices</em>';}
							?>
						
						<?php endwhile; 
						wp_reset_postdata();

						echo'<br><hr>'; } ?> 





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