<?php
function childtheme_remove_superfish() {
    $superfish = false;
    return $superfish;
}
add_filter('thematic_use_superfish', 'childtheme_remove_superfish');
?>