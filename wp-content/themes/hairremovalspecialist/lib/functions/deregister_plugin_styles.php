<?php
// deregister styles loaded by plugins
function childtheme_deregister_styles() {
    // removes GF styling
    wp_dequeue_style('gforms_reset_css');
	wp_dequeue_style('gforms_datepicker_css');
	wp_dequeue_style('gforms_formsmain_css');
	wp_dequeue_style('gforms_ready_class_css');
	wp_dequeue_style('gforms_browsers_css');

	wp_dequeue_style('taxonomy-image-plugin-public');


}
add_action('wp_print_styles', 'childtheme_deregister_styles', 100);
?>