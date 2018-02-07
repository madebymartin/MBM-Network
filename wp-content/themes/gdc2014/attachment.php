<?php
/**
 * Attachments Template
 *
 * Displays singular WordPress Media Library items.
 *
 * @package Thematic
 * @subpackage Templates
 *
 * @link http://codex.wordpress.org/Using_Image_and_File_Attachments Codex:Using Attachments
 */
	get_header();
	thematic_abovecontainer();
?>
		<div id="container">
			<?php
				//thematic_abovecontent();
				echo apply_filters( 'thematic_open_id_content', '<div id="content">' . "\n\n" );
	            while ( have_posts() ) : the_post();
				//thematic_page_title();
				//thematic_abovepost();
			?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> > 
				<?php
	            	thematic_postheader();
	            ?>
					<div class="entry-content">
						<div class="entry-attachment"><?php the_attachment_link( $post->ID, true ) ?></div>
	                        <?php 
	                        	the_content( thematic_more_text() );
	                        	wp_link_pages( 'before=<div class="page-link">' . __( 'Pages:', 'thematic' ) . '&after=</div>' );
	                        ?>
					</div><!-- .entry-content -->
					<?php
	                	thematic_postfooter();
	                ?>
				</div><!-- #post -->
	            <?php
					thematic_belowpost();
        			endwhile;
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