<?php
/**
 * Template Name: Full Width
 *
 * This Full Width template removes the primary and secondary asides so that content
 * can be displayed the entire width of the #content area.
 * 
 * @package Thematic
 * @subpackage Templates
 */

    // calling the header.php
    get_header();

    // action hook for placing content above #container
    thematic_abovecontainer();

    if(get_post_meta( get_the_id(), '_cmb_feature1_heading', true )){$feature1_title = get_post_meta( get_the_id(), '_cmb_feature1_heading', true ); } else { $feature1_title = 'Feature One'; }
    $feature1_wording = get_post_meta( get_the_id(), '_cmb_feature1_wording', true );    
    $feature1_linktext = get_post_meta( get_the_id(), '_cmb_feature1_link_text', true );
    $feature1_linkurl_id = get_post_meta( get_the_id(), '_cmb_feature1_linked_page', true );
    $feature1_linkurl = get_the_permalink($feature1_linkurl_id);
    if(get_post_meta( get_the_id(), '_cmb_feature1_image', true )){ 
        $feature1_image_att_id = get_post_meta( get_the_id(), '_cmb_feature1_image', true );
        $feature1_image = wp_get_attachment_url( $feature1_image_att_id ); 
    } else{ $feature1_image = get_bloginfo('stylesheet_directory') . '/images/vsav_symbol-grey.png'; }


    if(get_post_meta( get_the_id(), '_cmb_feature2_heading', true )){$feature2_title = get_post_meta( get_the_id(), '_cmb_feature2_heading', true ); } else { $feature2_title = 'Feature Two'; }
    $feature2_wording = get_post_meta( get_the_id(), '_cmb_feature2_wording', true );
    $feature2_linktext = get_post_meta( get_the_id(), '_cmb_feature2_link_text', true );
    $feature2_linkurl_id = get_post_meta( get_the_id(), '_cmb_feature2_linked_page', true );
    $feature2_linkurl = get_the_permalink($feature2_linkurl_id);
    
    if(get_post_meta( get_the_id(), '_cmb_feature2_image', true )){
        $feature2_image_att_id = get_post_meta( get_the_id(), '_cmb_feature2_image', true ); 
        $feature2_image = wp_get_attachment_url( $feature2_image_att_id ); 
    } else{ $feature2_image = get_bloginfo('stylesheet_directory') . '/images/vsav_symbol-grey.png'; }


    if(get_post_meta( get_the_id(), '_cmb_feature3_heading', true )){$feature3_title = get_post_meta( get_the_id(), '_cmb_feature3_heading', true ); } else { $feature3_title = 'Feature Three'; }
    $feature3_wording = get_post_meta( get_the_id(), '_cmb_feature3_wording', true );
    $feature3_linktext = get_post_meta( get_the_id(), '_cmb_feature3_link_text', true );
    $feature3_linkurl_id = get_post_meta( get_the_id(), '_cmb_feature3_linked_page', true );
    $feature3_linkurl = get_the_permalink($feature3_linkurl_id);
    
    if(get_post_meta( get_the_id(), '_cmb_feature3_image', true )){ 
        $feature3_image_att_id = get_post_meta( get_the_id(), '_cmb_feature3_image', true );
        $feature3_image = wp_get_attachment_url( $feature3_image_att_id ); 
    } else{ $feature3_image = get_bloginfo('stylesheet_directory') . '/images/vsav_symbol-grey.png'; }


    echo '<div class="floatfix">';
    echo '<div class="feature first">';
        echo '<h2>' . $feature1_title . '</h2>';
        echo '<div class="feature_wording">' . $feature1_wording . '</div>';
        echo '<a href="' . $feature1_linkurl . '"><img class="feature_image" src="' . $feature1_image . '"></a>';
        //echo '<img class="feature_image" src="' . $feature1_image . '">';
        echo '<a class="button" href="' . $feature1_linkurl . '">' . $feature1_linktext . '</a>';
    echo '</div>';

    echo '<div class="feature">';
        echo '<h2>' . $feature2_title . '</h2>';
        echo '<div class="feature_wording">' . $feature2_wording . '</div>';
        echo '<a href="' . $feature2_linkurl . '"><img class="feature_image" src="' . $feature2_image . '"></a>';
        echo '<a class="button" href="' . $feature2_linkurl . '">' . $feature2_linktext . '</a>';
    echo '</div>';

    echo '<div class="feature last">';
        echo '<h2>' . $feature3_title . '</h2>';
        echo '<div class="feature_wording">' . $feature3_wording . '</div>';
        echo '<a href="' . $feature3_linkurl . '"><img class="feature_image" src="' . $feature3_image . '"></a>';
        echo '<a class="button" href="' . $feature3_linkurl . '">' . $feature3_linktext . '</a>';
    echo '</div>';

?>


		<br>
        </div>
		<br><br>
	
		<?php
			// action hook for inserting content above #content
			thematic_abovecontent();		
    	
			// filter for manipulating the element that wraps the content 
			echo apply_filters( 'thematic_open_id_content', '<div id="content">' . "\n\n" );
		
			// calling the widget area 'page-top'
            get_sidebar('page-top');

            // start the loop
            while ( have_posts() ) : the_post();
            
            // action hook for inserting content above #post
            thematic_abovepost();
        ?>

			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> > 

			<?php

            	// creating the post header
            	// thematic_postheader();
            ?>
                
				<div class="entry-content">

                    <?php
                    	the_content();
                    	wp_link_pages( "\t\t\t\t\t<div class='page-link'>" . __( 'Pages: ', 'thematic' ), "</div>\n", 'number' );
                    	edit_post_link( __( 'Edit', 'thematic' ), '<span class="edit-link">','</span>' );
                    ?>

				</div>
				
			</div><!-- .post -->

		<?php
			// calls the do_action for inserting content below #post
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
			// action hook for inserting content below #content
			thematic_belowcontent(); 
		?> 

<?php 
    // action hook for placing content below #container
    thematic_belowcontainer();
    
    // calling footer.php
    get_footer();
?>