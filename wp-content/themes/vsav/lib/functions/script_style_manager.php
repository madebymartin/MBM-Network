<?php
// script manager template for registering and enqueuing files
function childtheme_script_manager() {
    // wp_register_script template ( $handle, $src, $deps, $ver, $in_footer );
    // registers modernizr script, stylesheet local path, no dependency, no version, loads in header
    wp_register_script('modernizr-js', get_stylesheet_directory_uri() . '/lib/js/modernizr.js', false, false, false);
    // registers fitvids script, local stylesheet path, yes dependency is jquery, no version, loads in footer
    wp_register_script('fitvids-js', get_stylesheet_directory_uri() . '/lib/js/jquery.fitvids.js', array('jquery'), false, true);
    // registers misc custom script, local stylesheet path, yes dependency is jquery, no version, loads in footer
    wp_register_script('custom-js', get_stylesheet_directory_uri() . '/lib/js/custom.js', array('jquery'), false, true);
    // registers flexslider script, local stylesheet path, yes dependency is jquery, no version, loads in footer
    wp_register_script('flexslider-js', get_stylesheet_directory_uri() . '/lib/flexslider/jquery.flexslider-min.js', array('jquery'), false, true);
    // registers flexslider styles, local stylesheet path
    wp_register_style('flexslider-css', get_stylesheet_directory_uri() . '/lib/flexslider/flexslider.css');
    // registers weloveiconfonts.com icon font styles
    wp_register_style('icon-fonts-css', 'http://weloveiconfonts.com/api/?family=entypo');

    wp_register_style('google_fonts', 'http://fonts.googleapis.com/css?family=Roboto:400,300,500');


    // enqueue the scripts for use in theme
    wp_enqueue_script ('modernizr-js');
    wp_enqueue_script ('fitvids-js');
    wp_enqueue_style ('icon-fonts-css');
    wp_enqueue_script ('flexslider-js');
    wp_enqueue_style ('flexslider-css');
    wp_enqueue_style ('google_fonts');


if(get_post_meta( get_the_id(), '_cmb_sidebar_pics', false )){
    // registers lightbox script, local stylesheet path, yes dependency is jquery, no version, loads in header
    wp_register_script('lightbox-js', get_stylesheet_directory_uri() . '/lib/lightbox/js/lightbox.min.js', array('jquery'), false, false);
    // registers lightbox styles, local stylesheet path
    wp_register_style('lightbox-css', get_stylesheet_directory_uri() . '/lib/lightbox/css/lightbox.css');

    wp_enqueue_script ('lightbox-js');
    wp_enqueue_style ('lightbox-css');
}
        

    //always enqueue this last, helps with conflicts
    wp_enqueue_script ('custom-js');

}
add_action('wp_enqueue_scripts', 'childtheme_script_manager');



/*
// CONDITIONALLY LOAD IF LESS THAN IE8
function mbm_enqueue_ie8_styles() {
    // DESKTOP STYLE FOR IE8 AND BELOW 
    wp_register_style( 'wide-ie8', get_stylesheet_directory_uri() . '/lib/css/wide-ie.css', array('thematic_style'), '', 'screen' );

    // Apply IE conditionals
    $GLOBALS['wp_styles']->add_data( 'wide-ie8', 'conditional', 'lte IE 8' );

    wp_enqueue_style ('wide-ie8');

}
add_action( 'wp_enqueue_scripts', 'mbm_enqueue_ie8_styles' );
*/

// deregister styles loaded by plugins
function childtheme_deregister_styles() {
    // removes contact form 7 styling
    wp_dequeue_style('gforms_reset_css');
	wp_dequeue_style('gforms_datepicker_css');
	wp_dequeue_style('gforms_formsmain_css');
	wp_dequeue_style('gforms_ready_class_css');
	wp_dequeue_style('gforms_browsers_css');
	wp_dequeue_style('taxonomy-image-plugin-public');
}
add_action('wp_print_styles', 'childtheme_deregister_styles', 100);
?>