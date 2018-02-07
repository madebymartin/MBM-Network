<?php
/**
 * Page Template
 *
 * …
 * 
 * @package Thematic
 * @subpackage Templates
 */
 if ( current_user_can('access_trade_content') ) { 

    // calling the header.php
    get_header();

    //messages...
	do_action('jigoshop_before_shop_loop');

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

				<?php get_template_part( 'lib/template_parts/title', 'banner' ); ?>
	                
					<div class="entry-content">
	
						<?php
	                    	the_content();
	                    
	                    	wp_link_pages( "\t\t\t\t\t<div class='page-link'>" . __( 'Pages: ', 'thematic' ), "</div>\n", 'number' );
	                    
	                    	edit_post_link( __( 'Edit', 'thematic' ), "\n\t\t\t\t\t\t" . '<span class="edit-link entypo-pencil">' , '</span>' . "\n" );


							$post_type = 'product';
							$tax = 'product_range';
							$tax_terms = get_terms($tax,'hide_empty=0');
							$orderby = 'title';


							//list everything
							if ($tax_terms) {
							  foreach ($tax_terms  as $tax_term) {
								    $args=array(
								      'post_type' => $post_type,
								      "$tax" => $tax_term->slug,
								      'post_status' => 'publish',
								      'posts_per_page' => -1,
								      'ignore_sticky_posts'=> 1,
								      'tax_query' => array(
										array(
											'taxonomy' => 'product_cat',
											'field' => 'slug',
											'terms' => 'samples',
											'operator' => 'NOT IN'
										)
									),
									  'orderby' => $orderby
								    );

								    $my_query = null;
								    $my_query = new WP_Query($args);

								    if( $my_query->have_posts() ) { ?>
										<ul class="margin0 padding0">
										<?php
											echo "<li class=\"productimages_range\" id=\"".$tax_term->slug."\"> <h3> $tax_term->name </h3></li>";
										    while ($my_query->have_posts()) : $my_query->the_post();
										      	$media_id = get_post_thumbnail_id( get_the_id() );
										      	$meta = get_post_meta($media_id);
												$filename = $meta['_wp_attached_file'][0];
												$media_url = wp_get_attachment_url( $media_id );

										      	echo '<li class="image_download">';
													echo '<a href="' . $media_url .'" download="' . $filename . '" title="Download ' . get_the_title() . '">';
														echo '<span class="icon"></span>';
														echo '<div class="square">' . wp_get_attachment_image( $media_id, array(400,400)) . '</div>';
														echo '<br>' . get_the_title();
													echo '</a>';
												echo '</li>';

										    endwhile;?>
										</ul>
										<?php
								     // echo "<p><a href=\"#top\">&#923; Back to top &#923;</a></p>";
							    }
							    wp_reset_query();
							  }
							}
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
} else{
	// Shouldn't be here!
	wp_redirect( "//germaine-de-capuccini.co.uk/trade-support/" ); exit;
}
?>