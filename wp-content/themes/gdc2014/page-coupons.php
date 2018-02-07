<?php
/**
 * Page Template
 *
 * …
 * 
 * @package Thematic
 * @subpackage Templates
 */
 
    // calling the header.php
    get_header();

    //messages...
	//do_action('jigoshop_before_shop_loop');

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

				$couponloop = new WP_Query( array( 
				'post_type' => 'shop_coupon', 
				'posts_per_page' => -1,
				'orderby' => 'date', 
				'order' => 'DESC'

				) ); 


				while ( $couponloop->have_posts() ) : $couponloop->the_post();

				$meta = get_post_meta(get_the_id());

				echo 'Coupon Code: ' . get_the_title() . '<br>';
				print_r($meta);
				echo '<hr>';

				endwhile;



?>



				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> > 

				<?php 
				//get_template_part( 'lib/template_parts/title', 'banner' ); 
				// creating the post header
	                thematic_postheader();
				?>
	                
					<div class="entry-content">
	
						<?php

	                    	the_content();
	                    
	                    	wp_link_pages( "\t\t\t\t\t<div class='page-link'>" . __( 'Pages: ', 'thematic' ), "</div>\n", 'number' );
	                    
	                    	edit_post_link( __( 'Edit', 'thematic' ), "\n\t\t\t\t\t\t" . '<span class="edit-link entypo-pencil">' , '</span>' . "\n" );
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