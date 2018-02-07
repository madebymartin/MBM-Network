<?php
/**
 * Page Template
 *
 * …
 * 
 * @package Thematic
 * @subpackage Templates
 */
 
    get_header();
    thematic_abovecontainer();
?>

		<div id="container">
			<?php
				thematic_abovecontent();
				// filter for manipulating the element that wraps the content 
				echo apply_filters( 'thematic_open_id_content', '<div id="content">' . "\n" );
	            get_sidebar('page-top');

	            //start loop
	            while ( have_posts() ) : the_post();
	            thematic_abovepost();
	        ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> > 
				<?php
	                thematic_postheader();
				?>
					<div class="entry-content">
						<?php
	                    	the_content();
	                    	wp_link_pages( "\t\t\t\t\t<div class='page-link'>" . __( 'Pages: ', 'thematic' ), "</div>\n", 'number' );
	                    	edit_post_link( __( 'Edit', 'thematic' ), "\n\t\t\t\t\t\t" . '<span class="edit-link">' , '</span>' . "\n" );
	                    ?>
					</div><!-- .entry-content -->
				</div><!-- #post -->
			<?php
	        	thematic_belowpost();
       		
	        	// end loop
        		endwhile;
	        
	        	get_sidebar( 'page-bottom' );
	        ?>
			</div><!-- #content -->
			<?php 
				thematic_belowcontent(); 
			?> 
		</div><!-- #container -->
<?php 
    thematic_belowcontainer();
    thematic_sidebar();
    get_footer();
?>