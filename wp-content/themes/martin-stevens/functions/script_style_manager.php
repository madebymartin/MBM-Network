<?php
// script manager template for registering and enqueuing files
function mbm_script_manager() {
    //  wp_register_script template ( $handle, $src, $deps, $ver, $in_footer );
    //  wp_register_style( $handle, $src, $deps, $ver, $media );

    /*HEADER SCRIPTS*/
    wp_register_script('modernizr_js', 'http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js', 'jquery', false, false);
    wp_register_script('layzr_js', get_stylesheet_directory_uri() . '/js/layzr.js', 'jquery', false, false);


    /*FOOTER SCRIPTS*/
    wp_register_script('autohideheader_js', get_stylesheet_directory_uri() . '/js/autohideheader.js', 'jquery', 'false', false);
   



    wp_enqueue_script ('modernizr_js');
    wp_enqueue_script ('layzr_js');
/*    wp_enqueue_style ('animate-css');
*/
/*    
    if ( is_page_template( 'template-salon-finder.php' ) ) {
        wp_register_script('simplemap_custom_markers_js', get_stylesheet_directory_uri() . '/lib/js/simplemap_custom_markers.js', false, false, true);
        wp_enqueue_script ('simplemap_custom_markers_js');
        wp_register_script('sm_fb_tracking', get_stylesheet_directory_uri() . '/lib/js/jquery.sm_fb_script.js', array('jquery'), false, true);
        wp_enqueue_script ('sm_fb_tracking');
    }
*/

}
add_action('wp_enqueue_scripts', 'mbm_script_manager');



// Move Jquery to footer - seems to slow site though?!?!
function move_jquery_to_footer() {
    if (!is_admin()) 
    {
        wp_deregister_script('jquery');
        wp_register_script('jquery', '/wp-includes/js/jquery/jquery.js', false, '1.11.0', true);
        wp_enqueue_script('jquery');
    }
}
//add_action('init', 'move_jquery_to_footer');




/*
// deregister styles loaded by plugins
function childtheme_deregister_styles() {
    // removes contact form 7 styling
    wp_dequeue_style('gforms_reset_css');
	//wp_dequeue_style('gforms_datepicker_css');
	wp_dequeue_style('gforms_formsmain_css');
	wp_dequeue_style('gforms_ready_class_css');
	//wp_dequeue_style('gforms_browsers_css');
	wp_dequeue_style('taxonomy-image-plugin-public');
}
add_action('wp_print_styles', 'childtheme_deregister_styles', 100);*/
?>