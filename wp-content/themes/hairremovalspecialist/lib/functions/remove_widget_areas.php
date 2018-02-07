<?php
// hide unused widget areas inside the WordPress admin
function childtheme_hide_widgetized_areas($content) {
//    unset($content['Primary Aside']);
//    unset($content['Secondary Aside']);
//    unset($content['1st Subsidiary Aside']);
//    unset($content['2nd Subsidiary Aside']);
//    unset($content['3rd Subsidiary Aside']);
    unset($content['Index Top']);
    unset($content['Index Insert']);
    unset($content['Index Bottom']);
    unset($content['Single Top']);
    unset($content['Single Insert']);
    unset($content['Single Bottom']);
    unset($content['Page Top']);
    unset($content['Page Bottom']);
    return $content;
}
add_filter('thematic_widgetized_areas', 'childtheme_hide_widgetized_areas');
?>