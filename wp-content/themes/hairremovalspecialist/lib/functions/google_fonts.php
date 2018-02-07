<?php
// script manager template for registering and enqueuing files
function childtheme_fonts_manager() {
    // register styles which are to be queued in the theme
    wp_register_style('google-fonts', 'http://fonts.googleapis.com/css?family=Fjalla+One|Lato:400,300');

    // enqueue the styles for use in theme
    wp_enqueue_style ('google-fonts');
}
add_action('wp_enqueue_scripts', 'childtheme_fonts_manager');
?>
