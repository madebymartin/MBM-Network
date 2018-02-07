<?php


function my_sm_custom_single_template( $default ) {



$return  = "<div class='sm-single-location-default-template'>";


if ( get_post_meta(get_the_ID(), 'location_special', true) ) { 
$return .= '(Platinum Spa)';
} else { }
                
	$return .= "<div class='sm-single-location-data'>";





	$return .= "<p>[sm-location data='location_address']";
	$return .= "</br>[sm-location data='location_address2']";
	$return .= "</br>[sm-location data='location_city']";
	$return .= "</br>[sm-location data='location_state']";
	$return .= "</br>[sm-location data='location_zip']</p>";
	$return .= "</div>";



if ( get_post_meta(get_the_ID(), 'location_phone', true) ) { 
$return .= "<div class='sm-phone'>[sm-location data='phone' before='' after='']</div>";
} else { }

if ( get_post_meta(get_the_ID(), 'location_email', true) ) { 
$return .= "<div class='sm-email'>[sm-location data='email' before='<a href=\"mailto:%self%\">' after='</a>']</div>";
} else { }

if ( get_post_meta(get_the_ID(), 'location_url', true) ) { 
$return .= "<a class='sm-url' href=\"[sm-location data='url' ]\" target='blank'>Visit Website</a>";
} else { }
	
	
	$return .= "<a class='sm-directions' target='blank' href=\"[sm-location data='directions' ]\">Get Directions</a>";

  /*  $return .= "<ul class='sm-single-location-data-ul'>[sm-location data='sm_category' format='csv' before='<li>Categories: ' after='</li>'] [sm-location data='sm_tag' format='csv' before='<li>Tags: ' after='</li>']</ul>"; */
			
	$return .= "<div class='clear'></div>";




/* $return .= '<a href="'.get_permalink( 1281 ).'" class="clear contactlink">'.'Contact This Spa'.'</a>'; */

	$return .= "<p class='clear'>[sm-location data='description']</p>";
	$return .= "<div class='sm-single-map'>[sm-location data='iframe-map' map_width='600px' map_height='350px']</div>";
$return .= "</div>";
                 

return $return;
}
add_filter( 'sm-single-location-default-template', 'my_sm_custom_single_template' );
?>