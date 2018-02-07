<?php
/**
 * Single Post Template
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
				echo apply_filters( 'thematic_open_id_content', '<div id="content">' . "\n\n" );
							
	            // start the loop
	            while ( have_posts() ) : the_post();
    	        
    	        // create the navigation above the content
				// thematic_navigation_above();
		
    	        // calling the widget area 'single-top'
    	        get_sidebar('single-top');
		
    	        // action hook creating the single post
    	        //thematic_singlepost();
	?>			


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


<?php

    	        // calling the widget area 'single-insert'
    	        get_sidebar('single-insert');
		
    	        // create the navigation below the content
				// thematic_navigation_below();
		
       			// action hook for calling the comments_template
    	        // thematic_comments_template();
    	        
    	        // end the loop
        		endwhile;
		
    	        // calling the widget area 'single-bottom'
    	        get_sidebar('single-bottom');
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