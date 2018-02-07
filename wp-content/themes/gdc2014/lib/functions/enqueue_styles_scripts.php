<?php
// script manager template for registering and enqueuing files
function childtheme_script_manager() {
    // wp_register_script template ( $handle, $src, $deps, $ver, $in_footer );
    wp_register_script('modernizr-js', get_stylesheet_directory_uri() . '/lib/js/modernizr.js', false, false, false);
    wp_register_script('fitvids-js', get_stylesheet_directory_uri() . '/lib/js/jquery.fitvids.js', array('jquery'), false, true);
    wp_register_script('custom-js', get_stylesheet_directory_uri() . '/lib/js/custom.js', array('jquery'), false, true);
    wp_register_script('bgfallback-js', get_stylesheet_directory_uri() . '/lib/js/bg_ie_fallback.js', array('jquery'), false, true);
    wp_register_script('flexslider-js', get_stylesheet_directory_uri() . '/flexslider/jquery.flexslider-min.js', array('jquery'), false, true);
    wp_register_style('flexslider-css', get_stylesheet_directory_uri() . '/flexslider/flexslider.css');

    wp_register_script('jquery_easing', get_stylesheet_directory_uri() . '/lib/js/jquery.easing.min.js', array('jquery'), false, true);
    //wp_register_script('dynamic_classes_js', get_stylesheet_directory_uri() . '/lib/js/scroll_dependant_classes.js', array('jquery'), false, true);
    //wp_register_script('scrollspy_js', get_stylesheet_directory_uri() . '/lib/js/scrollspy.js', array('jquery'), false, true);

    wp_register_script('hotjar-js', get_stylesheet_directory_uri() . '/lib/js/hotjar_tracking.js', false, false, false);




    // enqueue the scripts for use in theme
    wp_enqueue_script ('modernizr-js');
    wp_enqueue_script ('hotjar-js');

    //wp_enqueue_script ('scrollspy_js');
    wp_enqueue_script ('jquery_easing');
    //wp_enqueue_script ('dynamic_classes_js');

    wp_enqueue_script ('fitvids-js');
    wp_enqueue_script ('bgfallback-js');

    wp_enqueue_style ('icon-fonts-css');
    wp_enqueue_style ('tabs-css');
    if ( !is_admin() ) {
        //wp_enqueue_script ('jquery-tabs');
    }

        if ( is_singular('sm-location') ) {
             wp_enqueue_script ('flexslider-js');
             wp_enqueue_style ('flexslider-css');
        }
    //always enqueue this last, helps with conflicts
    wp_enqueue_script ('custom-js');
}
add_action('wp_enqueue_scripts', 'childtheme_script_manager');






/* WIDE MEDIA QUERY */
/*
function mbm_enqueue_media_query_styles() {


    
    wp_register_style( 'wide',
    get_stylesheet_directory_uri() . '/lib/css/wide.css',
    array('thematic_style'),
    '',
    'only screen and (min-width: 45em)' );

    wp_enqueue_style ('wide');
}
add_action( 'wp_enqueue_scripts', 'mbm_enqueue_media_query_styles' );
*/







function mbm_enqueue_ie8_styles() {
    /* DESKTOP STYLE FOR IE8 AND BELOW */
    wp_register_style( 'wide-ie8',
    get_stylesheet_directory_uri() . '/lib/css/wide-ie.css',
    array('thematic_style'),
    '',
    'screen' );

    // Apply IE conditionals
    $GLOBALS['wp_styles']->add_data( 'wide-ie8', 'conditional', 'lte IE 8' );

    wp_enqueue_style ('wide-ie8');

}
add_action( 'wp_enqueue_scripts', 'mbm_enqueue_ie8_styles' );









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