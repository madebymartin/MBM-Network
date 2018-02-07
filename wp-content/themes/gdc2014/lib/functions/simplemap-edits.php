<?php
//Simplemap Edits// ---------------------------------------------------------------------------------------------------------
function change_sm_state_label( $original_value ) {
    return 'County:';
}
add_filter( 'sm-search-label-state', 'change_sm_state_label' );

function change_sm_zip_label( $original_value ) {
    return 'Search town or postcode';
}
add_filter( 'sm-search-label-zip', 'change_sm_zip_label' );



// Change the default template for single location pages
//function change_sm_single_location_template( $default ) {
    // Whatever you put in the modified variable will be your new template
//    $modified = '<h1>This replaces the default template</h1>';
//    return $modified;
//}
//add_filter( 'sm-single-location-default-template', 'change_sm_single_location_template' );


function sm_insert_custom_markers() { 
if(is_page('57')){ ?>
    <script type='text/javascript'>
    function simplemapCustomMarkers( locationData ) {
        // http://code.google.com/apis/maps/documentation/javascript/overlays.html#ComplexIcons

        var options = {};
        // The if statement here causes custom markers only if is spa retreat
       if ( locationData.special ) {
            options.icon = new google.maps.MarkerImage( 
                '<?php bloginfo('stylesheet_directory');?>/images/marker-gdc-platinum.png', // URL of the marker image
                new google.maps.Size(32, 36), 
                new google.maps.Point(0,0),
                new google.maps.Point(0,36)
            );
        }
        return options;
    }
    </script>

<?php }
}
add_action('wp_head','sm_insert_custom_markers');
?>