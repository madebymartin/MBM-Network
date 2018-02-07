<?php
function enqueue_my_css() {
wp_enqueue_style( 'mygravityforms', get_stylesheet_directory_uri() . '/lib/css/forms.css', '', '');

if (is_front_page()){
wp_enqueue_style( 'anythingslider', get_stylesheet_directory_uri() . '/lib/css/anythingslider.css', '', '');

}



/* SELECT JUST ONE LAYOUT!!  */
//wp_enqueue_style( 'layout_2c-l-fixed', get_stylesheet_directory_uri() . '/lib/layouts/2c-l-fixed.css', '', '');
wp_enqueue_style( 'layout_2c-r-fixed', get_stylesheet_directory_uri() . '/lib/layouts/2c-r-fixed.css', '', '');
//wp_enqueue_style( 'layout_3c-fixed', get_stylesheet_directory_uri() . '/lib/layouts/3c-fixed.css', '', '');
//wp_enqueue_style( 'layout_3c-r-fixed-primary', get_stylesheet_directory_uri() . '/lib/layouts/3c-r-fixed-primary.css', '', '');
//wp_enqueue_style( 'layout_3c-r-fixed', get_stylesheet_directory_uri() . '/lib/layouts/3c-r-fixed', '', '');

// Google Fonts
wp_enqueue_style( 'google_fonts', 'http://fonts.googleapis.com/css?family=Oswald', '', '');
wp_enqueue_style( 'google_fonts', 'http://fonts.googleapis.com/css?family=open+sans', '', '');
}
add_action('wp_enqueue_scripts','enqueue_my_css');





/*
function custom_admin_style() {
wp_enqueue_style( 'mbm_admin_style', get_stylesheet_directory_uri() . '/lib/css/custom_admin.css', '', '');
echo'boo';
}
add_action('admin_head', 'custom_admin_style');
*/



?>