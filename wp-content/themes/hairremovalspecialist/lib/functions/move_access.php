<?php
// ----- Remove default Thematic actions for Access Navigation ------ //
function remove_thematic_actions() {
remove_action('thematic_header','thematic_access',9);
}
add_action('init','remove_thematic_actions');

function child_add_menuclass($ulclass) {
return preg_replace('/

    /', '<ul class="sf-menu sf-vertical">', $ulclass, 1);
    }
    add_filter('wp_page_menu', 'child_add_menuclass');

// Create #access above the main asides
    function my_access() {
    thematic_access();
    }
    add_action('thematic_header','my_access', '5');
?>