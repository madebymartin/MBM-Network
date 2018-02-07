<?php

function insert_background_image() { 

	if (is_page('production')){
		$background_class = 'production';

	} elseif (is_page('events')){
		$background_class = 'events';

	} elseif (is_page('installations')){
		$background_class = 'installations';

	} elseif (is_page('equipment-hire')){
		$background_class = 'equipment';

	} elseif (is_page('education')){
		$background_class = 'education';

	} else { // ANY OTHER PAGE
		$background_class = 'vsav';
	}


	echo '<div id="vsav_background" class="' . $background_class . '"></div>';
}
add_action('thematic_before','insert_background_image', 7);



function footer_logos() { 
}
add_action('thematic_footer','footer_logos', 7);



function sidebar_thumbs() { 

	if(get_post_meta( get_the_id(), '_cmb_sidebar_pics', false )){
        $slides = get_post_meta( get_the_id(), '_cmb_sidebar_pics', false );

        echo '<aside class="aside">';
			echo '<section>';
				echo '<h3 class="widgettitle">' . get_the_title() . ' Gallery</h3>';

				foreach ($slides as $key => $slide){
					$icon = '';
                    echo '<li>';
                            $thumbnail_url =  wp_get_attachment_image_src( $slide, 'sidebarthumb' )[0];
                            $fullsize_url =  wp_get_attachment_image_src( $slide, 'full' )[0];
                            $caption = get_the_title( $slide );
                            echo '<a data-title="' . $caption . '" href="' . $fullsize_url . '" data-lightbox="lightbox"><img class="sidebar_thumb" src="' . $thumbnail_url . '"></a>';
                    echo '</li>';
                }




			echo '</section>';
		echo '</div>';
	}

	
}
add_action('thematic_betweenmainasides','sidebar_thumbs', 7);





/*
Thematic Position Hooks


thematic_before()
	Located in header.php just after the opening body tag, before anything else.


thematic_aboveheader()
	Located in header.php just before the header div.


thematic_header()
	This hook builds the content of the header div and loads the following actions:
	Action 	Position Number
	thematic_brandingopen() 	1
	thematic_blogtitle() 		3
	thematic_blogdescription() 	5
	thematic_brandingclose() 	7
	thematic_access() 			9

thematic_belowheader()
	Located in header.php just after the header div.

thematic_abovecomments()

thematic_abovecommentslist()

thematic_belowcommentslist()

thematic_abovetrackbackslist()

thematic_belowtrackbackslist()

thematic_abovecommentsform()

thematic_show_subscription_checkbox()

thematic_belowcommentsform()

thematic_show_manual_subscription_form()

thematic_belowcomments()

thematic_abovemainasides()

thematic_betweenmainasides()

thematic_belowmainasides()

thematic_abovefooter()

thematic_footer()

thematic_after()

*/


?>