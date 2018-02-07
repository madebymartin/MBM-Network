<?php
function enqueue_my_css() {

/* GRAVITY FORMS CSS */
wp_enqueue_style( 'form_styles', get_stylesheet_directory_uri() . '/lib/css/forms.css', '', '','');



/* SELECT JUST ONE LAYOUT!!  */
//wp_enqueue_style( 'layout_2c-l-fixed', get_stylesheet_directory_uri() . '/lib/layouts/2c-l-fixed.css', '', '');
wp_enqueue_style( 'layout_2c-r-fixed', get_stylesheet_directory_uri() . '/lib/layouts/2c-r-fixed.css', '', '');
//wp_enqueue_style( 'layout_3c-fixed', get_stylesheet_directory_uri() . '/lib/layouts/3c-fixed.css', '', '');
//wp_enqueue_style( 'layout_3c-r-fixed-primary', get_stylesheet_directory_uri() . '/lib/layouts/3c-r-fixed-primary.css', '', '');
//wp_enqueue_style( 'layout_3c-r-fixed', get_stylesheet_directory_uri() . '/lib/layouts/3c-r-fixed', '', '');

}


add_action('wp_enqueue_scripts','enqueue_my_css'); ?>