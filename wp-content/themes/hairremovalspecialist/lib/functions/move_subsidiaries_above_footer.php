<?php
// move the subsidiary widget area above the footer
function childtheme_move_subsidiaries($content) {
    $content['1st Subsidiary Aside']['action_hook'] = 'thematic_abovefooter';
    $content['2nd Subsidiary Aside']['action_hook'] = 'thematic_abovefooter';
    $content['3rd Subsidiary Aside']['action_hook'] = 'thematic_abovefooter';
    return $content;
}
add_filter('thematic_widgetized_areas', 'childtheme_move_subsidiaries');

// unhook everything else that's related to the subsidiary widget area
function childtheme_move_relatedfunctions() {
    remove_action('widget_area_subsidiaries', 'thematic_subsidiaryopen', 10);
    remove_action('widget_area_subsidiaries', 'thematic_before_first_sub', 20);
    remove_action('widget_area_subsidiaries', 'thematic_between_firstsecond_sub', 40);
    remove_action('widget_area_subsidiaries', 'thematic_between_secondthird_sub', 60);
    remove_action('widget_area_subsidiaries', 'thematic_after_third_sub', 80);
    remove_action('widget_area_subsidiaries', 'thematic_subsidiaryclose', 200);
}
add_action('thematic_child_init', 'childtheme_move_relatedfunctions');

// add the related functions back in to the to abovefooter hook
add_action('thematic_abovefooter', 'thematic_subsidiaryopen', 10);
add_action('thematic_abovefooter', 'thematic_before_first_sub', 20);
add_action('thematic_abovefooter', 'thematic_between_firstsecond_sub', 40);
add_action('thematic_abovefooter', 'thematic_between_secondthird_sub', 60);
add_action('thematic_abovefooter', 'thematic_after_third_sub', 80);
add_action('thematic_abovefooter', 'thematic_subsidiaryclose', 200);
?>