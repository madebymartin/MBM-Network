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
	                // thematic_postheader();
				?>
	                
<h1 class="entry-title"><?php the_title(); ?></h1>

					<div class="entry-content">
	
						<?php
	                    	the_content();
	                    
	                    	wp_link_pages( "\t\t\t\t\t<div class='page-link'>" . __( 'Pages: ', 'thematic' ), "</div>\n", 'number' );
	                    
	                    	edit_post_link( __( 'Edit', 'thematic' ), "\n\t\t\t\t\t\t" . '<span class="edit-link">' , '</span>' . "\n" );
	                    ?>




<?php $loop = new WP_Query( array( 
										'post_type' => 'teammember',
										'orderby' => 'date',
										'posts_per_page' => '-1', 
										'order' => 'ASC'
										) ); ?>
			
			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

<div class="memberinfo">

<?php 
if ( has_post_thumbnail() ) { ?>
	<span class="profileoverlay"></span>
	<?php the_post_thumbnail( 'profile' );
} 
?>





	<h2><?php the_title(); 
edit_post_link( __( 'Edit', 'thematic' ), "\n\t\t\t\t\t\t" . '<span class="edit-link">' , '</span>' . "\n" );
?></h2>
	
	<?php if ( get_post_meta(get_the_ID(), '_cmb_teammembember_position', true) ) { ?>
	<h4 class="position">(<?php echo get_post_meta(get_the_ID(), "_cmb_teammembember_position", true); ?>)</h4>
	<?php } else { ?><?php } ?>

<div class="spacer">
	<?php if ( get_post_meta(get_the_ID(), '_cmb_teammembember_likes', true) ) { ?>
	<span class="likes">Likes: <?php echo get_post_meta(get_the_ID(), "_cmb_teammembember_likes", true); ?></span>
	<?php } else { ?><?php } ?>

	<?php if ( get_post_meta(get_the_ID(), '_cmb_teammembember_dislikes', true) ) { ?>
	<span class="dislikes">Dislikes: <?php echo get_post_meta(get_the_ID(), "_cmb_teammembember_dislikes", true); ?></span>
	<?php } else { ?><?php } ?>

</div>
	
	<span class="speechbubbletop"></span>
	<div class="speechbubble">		
			<?php 
			the_content(); 
			?> 		
	</div>
	<span class="speechbubblebottom"></span>
</div>

<?php endwhile; ?>





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