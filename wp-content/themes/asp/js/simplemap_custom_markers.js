function simplemapCustomMarkers( locationData ) {
    // custome marker for 'special' locations
    var options = {};
    if ( locationData.special ) {
        options.icon = new google.maps.MarkerImage( 
            '<?php bloginfo('stylesheet_directory');?>/images/ucw_map_marker.png', // URL of the marker image
            new google.maps.Size(32, 36),   // Size of image is 20px wide by 30px tall
            new google.maps.Point(0,0),     // We're just creating a base point here
            new google.maps.Point(0,36)     // This is the anchor of the image... the part of the image that points to the location
        );
    }
    return options;
}