<?php 
/**
 * Main Sidebar Template
 *
 * …
 * 
 * @package Thematic
 * @subpackage Templates
 */

    // action hook for placing content above the main asides
    thematic_abovemainasides();



    // Conditional Primary Asides

    if ( is_page( 'horsham' ) || is_page( '54' ) || '54' == $post->post_parent ){ ?>
        <div id="primary" class="aside main-aside"><?php wp_nav_menu( array('menu' => 'Horsham Menu' )); ?></div>
    
    <?php 
    } else{ thematic_widget_area_primary_aside(); }






    // action hook for placing content between primary and secondary aside
    thematic_betweenmainasides();

    // action hook creating the secondary aside
    thematic_widget_area_secondary_aside();     

    // action hook for placing content below the main asides
    thematic_belowmainasides(); 

?>