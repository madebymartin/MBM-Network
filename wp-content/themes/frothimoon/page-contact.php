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

						<?php if ( get_post_meta(get_the_ID(), '_cmb_salonaddress1', true) ) { ?>
						<div class="contact"><h1>Address:</h1>
						<h2><?php echo get_post_meta(get_the_ID(), "_cmb_salonaddress1", true); ?><br/>
						<?php echo get_post_meta(get_the_ID(), "_cmb_salonaddress2", true); ?><br/>
						<?php echo get_post_meta(get_the_ID(), "_cmb_salontown", true); ?><br/>
						<?php echo get_post_meta(get_the_ID(), "_cmb_saloncounty", true); ?><br/>
						<?php echo get_post_meta(get_the_ID(), "_cmb_salonpostcode", true); ?></h2>
						</div>
						<?php } else { ?><?php } ?>



						<?php if ( get_post_meta(get_the_ID(), '_cmb_salonphone', true) ) { ?>
						<div class="contact">
						<h1>Phone:</h1>
						<h2><?php echo get_post_meta(get_the_ID(), "_cmb_salonphone", true); ?></h2>
						</div>
						<?php } else { ?><?php } ?>




						<div class="clear"></div>


						<?php
	                    	the_content();
	                    	wp_link_pages( "\t\t\t\t\t<div class='page-link'>" . __( 'Pages: ', 'thematic' ), "</div>\n", 'number' );
	                    	edit_post_link( __( 'Edit', 'thematic' ), "\n\t\t\t\t\t\t" . '<span class="edit-link">' , '</span>' . "\n" );
	                    ?>

	                    <iframe width="600" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.co.uk/maps?oe=utf-8&amp;client=firefox-a&amp;ie=UTF8&amp;q=frothimoon&amp;fb=1&amp;gl=uk&amp;hq=frothimoon&amp;cid=0,0,2373115137222849609&amp;t=m&amp;ll=54.332641,-2.746153&amp;spn=0.020018,0.051413&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe>

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