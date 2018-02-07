<?php
function my_sm_custom_single_template( $default ) {
$return  = "";
$return .= "[sm-location data='description']";
$return .= "<div class='sm-single-map'>[sm-location data='iframe-map' map_width='100%' map_height='300px']</div>";
$return .= "<a target='blank' class='sm-directions' href=\"[sm-location data='directions' ]\">Get Directions</a>";       


return $return;
}
add_filter( 'sm-single-location-default-template', 'my_sm_custom_single_template' );
?>