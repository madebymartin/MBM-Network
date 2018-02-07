<?php
/**
 * Suzie\'s Little Monkeys Theme Customizer.
 *
 * @package Suzie\'s_Little_Monkeys
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function slm_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'slm_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function slm_customize_preview_js() {
	wp_enqueue_script( 'slm_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'slm_customize_preview_js' );




/**
 * Add logo upload to the customizer
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function slm_theme_customizer( $wp_customize ) {
    $wp_customize->add_section( 'slm_logo_section' , array(
	    'title'       => __( 'Logo', 'slm' ),
	    'priority'    => 30,
	    'description' => 'Upload a logo to replace the default site name and description in the header',
	) );

	$wp_customize->add_setting( 'slm_logo' );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'slm_logo', array(
	    'label'    => __( 'Logo', 'slm' ),
	    'section'  => 'slm_logo_section',
	    'settings' => 'slm_logo',
	) ) );
		
}
add_action( 'customize_register', 'slm_theme_customizer' );
