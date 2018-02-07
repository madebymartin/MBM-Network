<?php
/**
 * @package Thematic
 * @subpackage Templates
 */
     get_header();
    //messages...
	//do_action('jigoshop_before_shop_loop');
    thematic_abovecontainer();
?>
		<div id="container">
			<?php
				thematic_abovecontent();
				echo apply_filters( 'thematic_open_id_content', '<div id="content">' . "\n" );
	            get_sidebar('page-top');
	
	            while ( have_posts() ) : the_post();
		            thematic_abovepost();
			        ?>
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> > 
					<?php 
					//thematic_postheader(); 
					?>
						<div class="entry-content">
							<?php

							if ( is_user_logged_in() ) { echo do_shortcode('[gravityform id="46" title="false" description="true" tabindex="0"]'); }

							else{ echo do_shortcode('[gravityform id="47" title="false" description="true" tabindex="0"]'); }

							//echo 'This service will be back up and running shortly - Sorry for any inconvenience.';

	                    	//the_content();
	                    	//wp_link_pages( "\t\t\t\t\t<div class='page-link'>" . __( 'Pages: ', 'thematic' ), "</div>\n", 'number' );
	                    	//edit_post_link( __( 'Edit', 'thematic' ), "\n\t\t\t\t\t\t" . '<span class="edit-link entypo-pencil">' , '</span>' . "\n" );
	                    	
		                    ?>
						</div><!-- .entry-content -->
					</div><!-- #post -->
					<?php
		        	thematic_belowpost();
           		endwhile;
	        	get_sidebar( 'page-bottom' );
	        ?>
			</div><!-- #content -->
			<?php thematic_belowcontent(); ?> 
		</div><!-- #container -->
<?php 
    thematic_belowcontainer();
    //thematic_sidebar();
    get_footer();
?>