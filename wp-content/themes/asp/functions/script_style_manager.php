<?php
/**
 * Enqueue scripts and styles.
 */
function _s_scripts() {
    // wp_register_script( $handle, $src, $deps, $ver, $in_footer );

	wp_enqueue_style( '_s-style', get_stylesheet_uri() );
    
	wp_enqueue_script( '_s-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( '_s-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

    wp_register_script('asp_theme_jquery', get_stylesheet_directory_uri() . '/js/theme_jquery.js', array('jquery'), false, true);
    wp_register_script('google_maps', 'https://maps.googleapis.com/maps/api/js', false, false, false);
    wp_register_script('google_maps_options', get_stylesheet_directory_uri() . '/js/googlemaps_init.js', array('google_maps'), false, false);
    wp_register_style('google-fonts', 'http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600');


    wp_enqueue_script ('asp_theme_jquery');
    wp_enqueue_style ('google-fonts');

    wp_register_script('asp_team_classie', get_stylesheet_directory_uri() . '/js/classie.js', array('jquery'), true, true);
    wp_register_script('asp_team_modal_effects', get_stylesheet_directory_uri() . '/js/modalEffects.js', array('asp_team_classie'), true, true);
    wp_register_script('asp_team_modal_parser', get_stylesheet_directory_uri() . '/js/cssParser.js', array('asp_team_modal_effects'), true, true);
    wp_register_script('asp_team_modal_filter', get_stylesheet_directory_uri() . '/js/css-filters-polyfill.js', array('asp_team_modal_parser'), true, true);


    
    
    if(  is_page_template('template-team.php')  ||  is_page_template('template-team2.php') || get_post_meta(get_the_ID(), 'mbm_group_reveal_group', true) ){ 
        wp_enqueue_style( 'nifty-style', get_stylesheet_directory_uri() . '/css/component.css' ); 
        wp_enqueue_script ('asp_team_classie');
        wp_enqueue_script ('asp_team_modal_effects');
        wp_enqueue_script ('asp_team_modal_parser');
        wp_enqueue_script ('asp_team_modal_filter');
    }

    //wp_enqueue_script ('bootstrap_js');


}
add_action( 'wp_enqueue_scripts', '_s_scripts' );
?>
