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
	                thematic_postheader();
				?>
	          

<ul id="slider1">	


<?php $loop = new WP_Query( array( 
'post_type' => 'slide',
'posts_per_page' => '-1', 
'orderby' => 'rand',
) ); ?>

<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>


	<?php if ( get_post_meta(get_the_ID(), '_cmb_homeslide_link', true) ) { ?>
		<a href="<?php echo get_post_meta(get_the_ID(), "_cmb_homeslide_link", true); ?>">
			<?php if ( has_post_thumbnail() ) { 
			echo "<li>";
			the_post_thumbnail('bannerimage'); 
			echo "</li>";
			} ?>
		</a>


	<?php } else{ 

		if ( has_post_thumbnail() ) { 
		echo "<li>";
		the_post_thumbnail('bannerimage'); 
		echo "</li>";
		} 

	} ?>

	
<?php endwhile; ?>

 <?php wp_reset_query(); ?> 

</ul>



		<div class="entry-content">			
	
						<?php
	                    	the_content();
	                    
	                    	wp_link_pages( "\t\t\t\t\t<div class='page-link'>" . __( 'Pages: ', 'thematic' ), "</div>\n", 'number' );
	                    
	                    	edit_post_link( __( 'Edit', 'thematic' ), "\n\t\t\t\t\t\t" . '<span class="edit-link">' , '</span>' . "\n" );
	                    ?>





<div id="homecategories">
	<?php 
	$terms = apply_filters( 'taxonomy-images-get-terms', '', array(
	'taxonomy'     => 'spacategory',
	'having_images' => 'true',
	) );
	print '<ul class="">';
	if ( ! empty( $terms ) ) {
	    foreach( (array) $terms as $term ) {
	        print '<li><a href="' . esc_url( get_term_link( $term, $term->taxonomy ) ) . '"><span class="homebuttonoverlay"></span>' . wp_get_attachment_image( $term->image_id, 'button' ) . '<span class="title">' . esc_html( $term->name ) . '</span></a></li>';
	    }
	}
	print '</ul>';
	?>
</div>


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