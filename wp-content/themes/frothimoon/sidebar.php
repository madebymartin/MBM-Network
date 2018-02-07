<?php 

    // action hook for placing content above the main asides
    thematic_abovemainasides();

if(is_front_page() ) { include ('sidebar-home.php'); } 





else if(is_singular( 'treatments' ) ) { include ('sidebar-beauty.php'); }
else if(is_page(2) ) { include ('sidebar-beauty.php'); }
else if(is_tax( 'treatment_category' ) ) { include ('sidebar-beauty.php'); }



else if(is_singular( 'bridal' ) ) { include ('sidebar-bridal.php'); }
else if(is_page(24) ) { include ('sidebar-bridal.php'); }
else if ( $post->post_parent == '24' ) { include ('sidebar-bridal.php'); }
else if ( $post->post_parent == '220' ) { include ('sidebar-bridal.php'); }
else if ( $post->post_parent == '218' ) { include ('sidebar-bridal.php'); }
else if ( $post->post_parent == '206' ) { include ('sidebar-bridal.php'); }
else if ( $post->post_parent == '222' ) { include ('sidebar-bridal.php'); }


else if(is_single() ) { include ('sidebar-news.php'); }
else if(is_page(27) ) { include ('sidebar-news.php'); }
else if(is_category() ) { include ('sidebar-news.php'); }


else { include ('sidebar-home.php'); }

    // action hook creating the primary aside
    widget_area_primary_aside();	
	
    // action hook for placing content between primary and secondary aside
    thematic_betweenmainasides();

    // action hook creating the secondary aside
    widget_area_secondary_aside();		
	
    // action hook for placing content below the main asides
    thematic_belowmainasides(); 
    
?>