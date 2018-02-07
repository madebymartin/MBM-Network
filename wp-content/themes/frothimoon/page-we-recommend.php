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

	                    <ul>
						<?php $loop = new WP_Query( array( 
																'post_type' => 'recommendations',
																'cat' => '',
																'orderby' => 'date',
																'posts_per_page' => '3', 
																'order' => 'DESC'
																) ); ?>
									<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>



						<li class="no-list-style hentry">
							
						<h3><?php the_title();?>
						 

						<?php if ( get_post_meta(get_the_ID(), '_cmb_recommendation_phone', true) ) { ?>
						<span style="font-size:14px;"><br/><br/><br/>Phone: <?php echo get_post_meta(get_the_ID(), "_cmb_recommendation_phone", true); ?></span>
						<?php } else { ?><span></span><?php } ?>


						<?php if ( get_post_meta(get_the_ID(), '_cmb_recommendation_url', true) ) { ?>
						<br/><a class="no-text-decoration" style="font-size:14px;" target="blank" href="http://<?php echo get_post_meta(get_the_ID(), "_cmb_recommendation_url", true); ?>"><?php echo get_post_meta(get_the_ID(), "_cmb_recommendation_url", true); ?></a>
						<?php } else { ?><span></span><?php } ?>
						</h3>

						<div class="shadowpic"><?php the_post_thumbnail('news', array('class' => 'news'));?></div>
						<div class="clear"></div>

						<?php the_content(); ?>

						<?php edit_post_link(__('Edit', 'thematic'),'<span class="edit-link">','</span>') ?>




								
								<div class="clear"></div>
							
						</li>
									<?php endwhile; ?>
						</ul>



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