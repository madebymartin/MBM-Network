<?php
//Simplemap Edits// 

//State to County//
function change_sm_state_label( $original_value ) {
    return 'County:';
}
add_filter( 'sm-search-label-state', 'change_sm_state_label' );

//Zip to blank//
function change_sm_zip_label( $original_value ) {
    return '';
}
add_filter( 'sm-search-label-zip', 'change_sm_zip_label' );

//Category to This Salon Offers//
function change_sm_category_label( $original_value ) {
    return 'UCW Services Available';
}
add_filter( 'sm_category-text', 'change_sm_category_label' );





// Change the default template for single location pages
//function change_sm_single_location_template( $default ) {
    // Whatever you put in the modified variable will be your new template
//    $modified = '<h1>This replaces the default template</h1>';
//    return $modified;
//}
//add_filter( 'sm-single-location-default-template', 'change_sm_single_location_template' );


function sm_insert_custom_markers() {
    ?>
     <script type='text/javascript'>
    function simplemapCustomMarkers( locationData ) {
        // http://code.google.com/apis/maps/documentation/javascript/overlays.html#ComplexIcons

        var options = {};
        // The if statement here causes custom markers only if the zip code for the location is 12345
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
    </script>
    <?php
}
add_action('wp_head','sm_insert_custom_markers');
?>