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



				<div class="homebanner">
				    <?php the_post_thumbnail( 'banner', array( 'class'	=> "mobile_feature_image", ) ); ?>
				    <div id="bannerwrapouter">
				            <h1 class="page-title keymessage"><?php echo the_title(); ?></h1>
				    </div>
				</div>


				<div class="entry-content">

					<?php the_content();
	                	wp_link_pages( "\t\t\t\t\t<div class='page-link'>" . __( 'Pages: ', 'thematic' ), "</div>\n", 'number' );
	                	edit_post_link( __( 'Edit', 'thematic' ), "\n\t\t\t\t\t\t" . '<span class="edit-link entypo-pencil">' , '</span>' . "\n" );
	                ?>

<?php $loop = new WP_Query( array( 
'post_type' => 'sm-location', 
'posts_per_page' => -1,
'orderby' => 'title', 
'order' => 'ASC'

) ); ?>

<div class="category-list"></div>




		<ul class="margin0 padding0">
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<?php if ( get_post_meta(get_the_ID(), 'location_special', true) ) { ?>

			<li class="listing">			
				<a href="<?php echo get_permalink(); ?>">
					<h3><?php the_title(); ?></h3>
					
					<?php if ( has_post_thumbnail() ) { ?>
						<?php the_post_thumbnail('banner'); ?>
					<?php } else{ ?>
						<img src="<?php bloginfo( stylesheet_directory); ?>/images/placeholder.png " width="100%" />
					<?php } ?>
				</a>

				<div class="spadescription">
						<?php if ( get_post_meta(get_the_ID(), 'cmb_spadescription', true) ) { ?>
							<p><?php echo get_post_meta(get_the_ID(), "cmb_spadescription", true); ?></p>
						<?php } else { } ?>

						<?php if ( get_post_meta(get_the_ID(), 'location_url', true) ) { ?>
							<a target="blank" href="<?php echo get_post_meta(get_the_ID(), 'location_url', true); ?>">Visit website</a>
						<?php } else { ?><?php } ?><br />
					
						<a class="moreinfo" href="<?php echo get_permalink(); ?>">More info / contact</a>
				</div>
				<br><br>
			</li><!--li.cols-1 -->

			
	<?php } else { ?><?php } ?>
	<?php endwhile; ?>
	</ul>


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