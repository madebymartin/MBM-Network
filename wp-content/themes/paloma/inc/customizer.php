<?php
/**
 * paloma Theme Customizer.
 *
 * @package paloma
 */



/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function paloma_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'refresh';
    $wp_customize->get_setting( 'header_textcolor' )->default = '#222222';
    $wp_customize->get_section( 'header_image' )->description = __('Use this area to upload a video or image to your home page. When uploading a video, <strong>you must also upload an image below</strong> that will be used as a fallback and on mobile devices.', 'paloma');
    $wp_customize->get_section( 'header_image' )->priority = 20;
    $wp_customize->get_control( 'header_video' )->description = __('Upload your video in .mp4 format. We recommend a 16:9 aspect ratio, and max file size of 8mb.', 'paloma');
    $wp_customize->get_control( 'header_image' )->description = __('We recommend image dimensions of 2000 x 1200px. This image will also be used as a fallback for video headers.', 'paloma');
    $wp_customize->get_setting( 'header_image' )->transport = 'refresh';
    $wp_customize->get_setting( 'header_video' )->transport = 'refresh';
    $wp_customize->get_setting( 'external_header_video' )->transport = 'refresh';
}
add_action( 'customize_register', 'paloma_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function paloma_customize_preview_js() {
	wp_enqueue_script( 'paloma_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'paloma_customize_preview_js' );

/**
 * Configure Stnsvn theme customizer
 *
 * 
 */
function paloma_customizer( $wp_customize ) {
//-----------------------Title Tagline Section -----------------------//

	    //Logo upload section
	    $wp_customize->add_setting( 
	        'logo_upload',
	        array(
	            'transport'         => 'refresh',
	            )
	    );
	     
	    $wp_customize->add_control(
	        new WP_Customize_Image_Control(
	            $wp_customize,
	            'logo_upload',
	            array(
	                'label' => __('Logo Upload', 'paloma'),
	                'section' => 'title_tagline',
	                'settings' => 'logo_upload'
	            )
	        )
	    );

        //Logo size
        $wp_customize->add_setting( 'stnsvn_logo_size', array(
            'default' => '100',
            'sanitize_callback' => 'paloma_absint',
        ) );

        $wp_customize->add_control( 'stnsvn_logo_size', array(
            'type' => 'range',
            'section' => 'title_tagline',
            'label' => __( 'Logo Size', 'paloma' ),
            'description' => '',
            'default' => '100',
            'input_attrs' => array(
                'min' => 1,
                'max' => 200,
                'step' => 5,
                'style' => 'color: #0a0',
            ),
        ) );

//-----------------------Header Media Section -----------------------//
         
        // Number of boxes to display
        $wp_customize->add_setting(
            'stnsvn_header_style',
            array(
            'default' => 'height',
            )
        );

        $wp_customize->add_control(
            'stnsvn_header_style',
            array(
                'type' => 'select',
                'label' => __('Header Display Style', 'paloma'),
                'section' => 'header_image',
                'description' => __('Choose how to display the header on the home page.', 'paloma'),
                'choices' => array(
                    'height' => __('Full height', 'paloma'),
                    'ratio' => __('Maintain ratio', 'paloma'),
                ),
            )
        );

        //Landing header overlay
        $wp_customize->add_setting( 
            'stnsvn_header_overlay',
            array(
                'default' => '#222222',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
            $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'stnsvn_header_overlay',
                array(
                    'label' => __('Landing Header Overlay Color', 'paloma'),
                    'section' => 'header_image',
                    'settings' => 'stnsvn_header_overlay',
                )
            )
        );

        //Landing header overlay opacity
        $wp_customize->add_setting( 'stnsvn_overlay_opacity', array(
            'default' => '0',
            'sanitize_callback' => 'paloma_absint',
        ) );

        $wp_customize->add_control( 'stnsvn_overlay_opacity', array(
            'type' => 'range',
            'section' => 'header_image',
            'label' => __( 'Overlay Opacity', 'paloma' ),
            'description' => '',
            'default' => '0',
            'input_attrs' => array(
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'style' => 'color: #0a0',
            ),
        ) );

        //Header overlay text
        $wp_customize->add_setting(
            'stnsvn_header_text',
            array(
            'sanitize_callback' => 'paloma_sanitize_text',
            'default' => '',
            )
        );

        $wp_customize->add_control(
            'stnsvn_header_text',
            array(
                'description' => __('Add optional overlay text to your header here. Accepts html tags like &#12296;h1&#12297;&#12296;strong&#12297;&#12296;img&#12297;&#12296;a&#12297; etc.', 'paloma'),
                'label' => __('Header Overlay Text', 'paloma'),
                'section' => 'header_image',
                'type' => 'textarea',
            )
        );

        //"Scroll to Content" text
        $wp_customize->add_setting(
            'stnsvn_scroll_text',
            array(
            'sanitize_callback' => 'paloma_sanitize_text',
            'default' => '',
            )
        );

        $wp_customize->add_control(
            'stnsvn_scroll_text',
            array(
                'label' => __('"Scroll to Content" Text', 'paloma'),
                'section' => 'header_image',
            )
        );

        //Activate scroll to content arrow
         $wp_customize->add_setting(
            'stnsvn_scroll_arrow',
                array(
                'sanitize_callback' => 'sanitize_checkbox',
                'default'   => 1
                )
        );
        $wp_customize->add_control(
            'stnsvn_scroll_arrow',
            array(
                'type' => 'checkbox',
                'label' => __('Enable "Scroll to Content" arrow', 'paloma'),
                'section' => 'header_image',
            )
        );

//-----------------------Navigation Menu -----------------------//
      // Add Navigation section  
        $wp_customize->add_section(
            'navigation',
            array(
                'title' => __('Navigation Style', 'paloma'),
                'description' => __('Customize the look of the nav menus here.', 'paloma'),
                'priority' => 100,
            )
        );

        //Nav background color
            $wp_customize->add_setting(
            'nav-background-color',
            array(
                'default' => '#fbf9f5',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
            $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'nav-background-color',
                array(
                    'label' => __('Navigation Background Color', 'paloma'),
                    'section' => 'navigation',
                    'settings' => 'nav-background-color',
                )
            )
        );

        //Nav menu text color
            $wp_customize->add_setting(
            'nav_text_color',
            array(
                'default' => '#222222',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
            $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'nav_text_color',
                array(
                    'label' => __('Navigation Text Color', 'paloma'),
                    'section' => 'navigation',
                    'settings' => 'nav_text_color',
                )
            )
        );

        //Nav secondary background color
            $wp_customize->add_setting(
            'nav-secondary-bg-color',
            array(
                'default' => '#fff4ec',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
            $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'nav-secondary-bg-color',
                array(
                    'label' => __('Navigtation Secondary Background Color', 'paloma'),
                    'description' => __('Applies to mobile nav background and dropdown menu hover backgrounds.', 'paloma'),
                    'section' => 'navigation',
                    'settings' => 'nav-secondary-bg-color',
                )
            )
        );

        //Activate sticky menu   
         $wp_customize->add_setting(
            'sticky_primary_menu',
                array(
                'sanitize_callback' => 'sanitize_checkbox',
                'default'   => 1
                )
        );
        $wp_customize->add_control(
            'sticky_primary_menu',
            array(
                'type' => 'checkbox',
                'label' => __('Enable sticky nav bar', 'paloma'),
                'section' => 'navigation',
            )
        );

        //Activate nav bar search form
         $wp_customize->add_setting(
            'nav_search_form',
                array(
                'sanitize_callback' => 'sanitize_checkbox',
                'default'   => 1
                )
        );
        $wp_customize->add_control(
            'nav_search_form',
            array(
                'type' => 'checkbox',
                'label' => __('Display search form in upper nav bar', 'paloma'),
                'section' => 'navigation',
            )
        );

//----------------------- Social Icons -----------------------//

        //Social icons panel
        $wp_customize->add_panel( 'social_media_icons', array(
            'priority'       => 45,
            'title'          => __('Social Media Icons', 'paloma'),
        ) );

        // Add Social Icons section  
        $wp_customize->add_section(
            'stnsvn_social_icons',
            array(
                'title' => __('Standard Icons & Settings', 'paloma'),
                'description' => __('Edit the social media icons here. Fields left blank will not display. Make sure to include the "http://" for links to be valid. <br/><br/> Social icons can also be displayed in custom locations using the dedicated widget or the shortcode: [stnsvn-social]', 'paloma'),
                'panel' => 'social_media_icons'
            )
        );

            //Set target _blank or not
                $wp_customize->add_setting(
                'stnsvn_social_location',
                    array(
                    'sanitize_callback' => 'sanitize_checkbox',
                    'default' => 1,
                )
            );

            $wp_customize->add_control(
                'stnsvn_social_location',
                array(
                    'type' => 'checkbox',
                    'label' => __('Display icons in header bar', 'paloma'),
                    'section' => 'stnsvn_social_icons',
                )
            );

            //Set target _blank or not
                $wp_customize->add_setting(
                'stnsvn_target_blank',
                    array(
                    'sanitize_callback' => 'sanitize_checkbox',
                    'default' => 1,
                )
            );

            $wp_customize->add_control(
                'stnsvn_target_blank',
                array(
                    'type' => 'checkbox',
                    'label' => __('Open links in new tab', 'paloma'),
                    'section' => 'stnsvn_social_icons',
                )
            );

            //Facebook Link
            $wp_customize->add_setting(
                'stnsvn_fb_link',
                array(
                'sanitize_callback' => 'paloma_sanitize_text',
                'default' => '',
                )
            );

            $wp_customize->add_control(
                'stnsvn_fb_link',
                array(
                    'label' => __('Facebook link', 'paloma'),
                    'section' => 'stnsvn_social_icons',
                )
            );

            //Pinterest Link
            $wp_customize->add_setting(
                'stnsvn_pinterest_link',
                array(
                'sanitize_callback' => 'paloma_sanitize_text',
                'default' => '',
                )
            );

            $wp_customize->add_control(
                'stnsvn_pinterest_link',
                array(
                    'label' => __('Pinterest link', 'paloma'),
                    'section' => 'stnsvn_social_icons',
                )
            );

            //Instagram Link
            $wp_customize->add_setting(
                'stnsvn_instagram_link',
                array(
                'sanitize_callback' => 'paloma_sanitize_text',
                'default' => '',
                )
            );

            $wp_customize->add_control(
                'stnsvn_instagram_link',
                array(
                    'label' => __('Instagram link', 'paloma'),
                    'section' => 'stnsvn_social_icons',
                )
            );

            //Twitter Link
            $wp_customize->add_setting(
                'stnsvn_twitter_link',
                array(
                'sanitize_callback' => 'paloma_sanitize_text',
                'default' => '',
                )
            );

            $wp_customize->add_control(
                'stnsvn_twitter_link',
                array(
                    'label' => __('Twitter link', 'paloma'),
                    'section' => 'stnsvn_social_icons',
                )
            );

            //Google+ Link
            $wp_customize->add_setting(
                'stnsvn_google_link',
                array(
                'sanitize_callback' => 'paloma_sanitize_text',
                'default' => '',
                )
            );

            $wp_customize->add_control(
                'stnsvn_google_link',
                array(
                    'label' => __('Google+ link', 'paloma'),
                    'section' => 'stnsvn_social_icons',
                )
            );

            //Bloglovin' Link
            $wp_customize->add_setting(
                'stnsvn_bloglovin_link',
                array(
                'sanitize_callback' => 'paloma_sanitize_text',
                'default' => '',
                )
            );

            $wp_customize->add_control(
                'stnsvn_bloglovin_link',
                array(
                    'label' => __('Bloglovin\' link', 'paloma'),
                    'section' => 'stnsvn_social_icons',
                )
            );

        //-----------------------Social Icons Custom Icons Sub-Panel -----------------------//
        // Add Social Icons section  
        $wp_customize->add_section(
            'stnsvn_custom_icons',
            array(
                'title' => __('Custom Icons', 'paloma'),
                'description' => __('Enter the name of the Font Awesome icon to be displayed (e.g., youtube); all icons can be <a href="https://fortawesome.github.io/Font-Awesome/icons/" target="_blank">viewed here</a>.', 'paloma'),
                'panel' => 'social_media_icons'
            )
        );

            //Custom Icon 1
            $wp_customize->add_setting(
                'stnsvn_custom_icon_1',
                array(
                'sanitize_callback' => 'paloma_sanitize_text',
                'default' => '',
                )
            );

            $wp_customize->add_control(
                'stnsvn_custom_icon_1',
                array(
                    'label' => __('Custom icon 1', 'paloma'),
                    'section' => 'stnsvn_custom_icons',
                )
            );

            //Custom Icon 1 Link
            $wp_customize->add_setting(
                'stnsvn_custom_icon_1_link',
                array(
                'sanitize_callback' => 'paloma_sanitize_text',
                'default' => '',
                )
            );

            $wp_customize->add_control(
                'stnsvn_custom_icon_1_link',
                array(
                    'label' => __('Custom icon 1 link', 'paloma'),
                    'section' => 'stnsvn_custom_icons',
                )
            );

            //Custom Icon 2
            $wp_customize->add_setting(
                'stnsvn_custom_icon_2',
                array(
                'sanitize_callback' => 'paloma_sanitize_text',
                'default' => '',
                )
            );

            $wp_customize->add_control(
                'stnsvn_custom_icon_2',
                array(
                    'label' => __('Custom icon 2', 'paloma'),
                    'section' => 'stnsvn_custom_icons',
                )
            );

            //Custom Icon 2 Link
            $wp_customize->add_setting(
                'stnsvn_custom_icon_2_link',
                array(
                'sanitize_callback' => 'paloma_sanitize_text',
                'default' => '',
                )
            );

            $wp_customize->add_control(
                'stnsvn_custom_icon_2_link',
                array(
                    'label' => __('Custom icon 2 link', 'paloma'),
                    'section' => 'stnsvn_custom_icons',
                )
            );

            //Custom Icon 3
            $wp_customize->add_setting(
                'stnsvn_custom_icon_3',
                array(
                'sanitize_callback' => 'paloma_sanitize_text',
                'default' => '',
                )
            );

            $wp_customize->add_control(
                'stnsvn_custom_icon_3',
                array(
                    'label' => __('Custom icon 3', 'paloma'),
                    'section' => 'stnsvn_custom_icons',
                )
            );

            //Custom Icon 3 Link
            $wp_customize->add_setting(
                'stnsvn_custom_icon_3_link',
                array(
                'sanitize_callback' => 'paloma_sanitize_text',
                'default' => '',
                )
            );

            $wp_customize->add_control(
                'stnsvn_custom_icon_3_link',
                array(
                    'label' => __('Custom icon 3 link', 'paloma'),
                    'section' => 'stnsvn_custom_icons',
                )
            );

            //Custom Icon 4
            $wp_customize->add_setting(
                'stnsvn_custom_icon_4',
                array(
                'sanitize_callback' => 'paloma_sanitize_text',
                'default' => '',
                )
            );

            $wp_customize->add_control(
                'stnsvn_custom_icon_4',
                array(
                    'label' => __('Custom icon 4', 'paloma'),
                    'section' => 'stnsvn_custom_icons',
                )
            );

            //Custom Icon 4 Link
            $wp_customize->add_setting(
                'stnsvn_custom_icon_4_link',
                array(
                'sanitize_callback' => 'paloma_sanitize_text',
                'default' => '',
                )
            );

            $wp_customize->add_control(
                'stnsvn_custom_icon_4_link',
                array(
                    'label' => __('Custom icon 4 link', 'paloma'),
                    'section' => 'stnsvn_custom_icons',
                )
            );

            //Custom Icon 5
            $wp_customize->add_setting(
                'stnsvn_custom_icon_5',
                array(
                'sanitize_callback' => 'paloma_sanitize_text',
                'default' => '',
                )
            );

            $wp_customize->add_control(
                'stnsvn_custom_icon_5',
                array(
                    'label' => __('Custom icon 5', 'paloma'),
                    'section' => 'stnsvn_custom_icons',
                )
            );

            //Custom Icon 5 Link
            $wp_customize->add_setting(
                'stnsvn_custom_icon_5_link',
                array(
                'sanitize_callback' => 'paloma_sanitize_text',
                'default' => '',
                )
            );

            $wp_customize->add_control(
                'stnsvn_custom_icon_5_link',
                array(
                    'label' => __('Custom icon 5 link', 'paloma'),
                    'section' => 'stnsvn_custom_icons',
                )
            );

            //Custom Icon 6
            $wp_customize->add_setting(
                'stnsvn_custom_icon_6',
                array(
                'sanitize_callback' => 'paloma_sanitize_text',
                'default' => '',
                )
            );

            $wp_customize->add_control(
                'stnsvn_custom_icon_6',
                array(
                    'label' => __('Custom icon 6', 'paloma'),
                    'section' => 'stnsvn_custom_icons',
                )
            );

            //Custom Icon 6 Link
            $wp_customize->add_setting(
                'stnsvn_custom_icon_6_link',
                array(
                'sanitize_callback' => 'paloma_sanitize_text',
                'default' => '',
                )
            );

            $wp_customize->add_control(
                'stnsvn_custom_icon_6_link',
                array(
                    'label' => __('Custom icon 6 link', 'paloma'),
                    'section' => 'stnsvn_custom_icons',
                )
            );

//-----------------------Featured Slider Section -----------------------//

      // Add featured slider 
        $wp_customize->add_section(
            'featured_slider',
            array(
                'title' => __('Slider Settings', 'paloma'),
                'description' => __('The following settings apply to the slider on the main blog page only.', 'paloma'),
                'priority' => 45,
            )
        );

      // Add slide subtext settings
        $wp_customize->add_setting(
            'paloma_slide_subtext',
            array(
            'sanitize_callback' => 'paloma_sanitize_text',
            'default' => 'Read Now',
            )
        );

        $wp_customize->add_control(
            'paloma_slide_subtext',
            array(
                'description' => __('Enter the slide subtext here.', 'paloma'),
                'label' => __('Blog Slider Settings', 'paloma'),
                'section' => 'featured_slider',
            )
        );

      //Set slide limit
        $wp_customize->add_setting(
            'paloma_slide_limit',
            array(
            'sanitize_callback' => 'paloma_absint',
            'default' => '0',
            )
        );

        $wp_customize->add_control(
            'paloma_slide_limit',
            array(
                'section' => 'featured_slider',
                'description' => __('Set the maximum number of slides here. Set "0" to have no limit.', 'paloma'),
            )
        );

        //Display on main blog page
            $wp_customize->add_setting(
            'slider_home',
                array(
                'sanitize_callback' => 'sanitize_checkbox',
                'default' => 1
            )
        );
        $wp_customize->add_control(
            'slider_home',
            array(
                'type' => 'checkbox',
                'label' => __('Display slider on main blog page', 'paloma' ),
                'section' => 'featured_slider',
            )
        );

      // Add featured slider auto scroll settings
        $wp_customize->add_setting(
            'paloma_autoscroll',
            array(
            'sanitize_callback' => 'paloma_absint',
            'default' => '0',
            )
        );

        $wp_customize->add_control(
            'paloma_autoscroll',
            array(
                'label' => __('Global Slider Settings', 'paloma'),
                'section' => 'featured_slider',
                'description' => __('The following settings will affect the slider on the blog page, as well as any sliders on the Page Builder template. <br/><br/>Set the auto scroll delay length here (in milliseconds eg. 5000). Set "0" to disable auto scroll.', 'paloma'),
            )
        );

        //Control draggability
            $wp_customize->add_setting(
            'paloma_draggable',
                array(
                'sanitize_callback' => 'sanitize_checkbox',
            )
        );

        $wp_customize->add_control(
            'paloma_draggable',
            array(
                'type' => 'checkbox',
                'label' => __('Disable draggability', 'paloma'),
                'description' => __('Disables the slides ability to be dragged by the user\'s cursor (or finger on mobile).', 'paloma'),
                'section' => 'featured_slider',
            )
        );

        //Control navigation arrows
            $wp_customize->add_setting(
            'paloma_slider_arrows',
                array(
                'sanitize_callback' => 'sanitize_checkbox',
            )
        );

        $wp_customize->add_control(
            'paloma_slider_arrows',
            array(
                'type' => 'checkbox',
                'label' => __('Disable navigation arrows', 'paloma'),
                'description' => __('Hides the slider navigation arrows.', 'paloma'),
                'section' => 'featured_slider',
            )
        );

//-----------------------Call to Action Boxes Section -----------------------//

      // Add Calls to Action section
        $wp_customize->add_section(
            'cta_boxes',
            array(
                'title' => __('Call to Action Boxes', 'paloma'),
                'description' => __('Edit the content of the Call to Action boxes on the main blog page.', 'paloma'),
                'priority' => 50,
            )
        );

        //Display on main blog page
            $wp_customize->add_setting(
            'stnsvn_cta_display',
                array(
                'sanitize_callback' => 'sanitize_checkbox',
                'default' => 0
            )
        );
        $wp_customize->add_control(
            'stnsvn_cta_display',
            array(
                'type' => 'checkbox',
                'label' => __('Display call to action boxes on main blog page', 'paloma' ),
                'section' => 'cta_boxes',
            )
        );

        // Number of boxes to display
            $wp_customize->add_setting(
                'stnsvn_cta_cols',
                array(
                'default' => '3',
                )
            );

            $wp_customize->add_control(
                'stnsvn_cta_cols',
                array(
                    'type' => 'select',
                    'label' => __('Number of boxes', 'paloma'),
                    'section' => 'cta_boxes',
                    'description' => __('Choose number of boxes to display', 'paloma'),
                    'choices' => array(
                        '2' => __('Two boxes', 'paloma'),
                        '3' => __('Three boxes', 'paloma'),
                    ),
                )
            );

        //CTA 1 image upload 
        $wp_customize->add_setting( 
            'stnsvn_cta1_upload',
            array(
                'transport'         => 'refresh',
                'sanitize_callback' => 'absint'
                )
        );
         
        $wp_customize->add_control(
            new WP_Customize_Cropped_Image_Control(
                $wp_customize,
                'stnsvn_cta1_upload',
                array(
                    'label' => __('Box 1 image upload', 'paloma'),
                    'section' => 'cta_boxes',
                        'width' => 900,
                        'height' => 745
                )
            )
        );

        //CTA 1 Text
        $wp_customize->add_setting(
            'stnsvn_cta1_text',
            array(
            'sanitize_callback' => 'paloma_sanitize_text',
            'default' => '',
            )
        );

        $wp_customize->add_control(
            'stnsvn_cta1_text',
            array(
                'label' => __('Box 1 text', 'paloma'),
                'section' => 'cta_boxes',
            )
        );

        //CTA 1 URL
        $wp_customize->add_setting(
            'stnsvn_cta1_url',
            array(
            'sanitize_callback' => 'paloma_sanitize_text',
            'default' => '',
            )
        );

        $wp_customize->add_control(
            'stnsvn_cta1_url',
            array(
                'label' => __('Box 1 link', 'paloma'),
                'section' => 'cta_boxes',
            )
        );

        //CTA 1 Tab 
         $wp_customize->add_setting(
            'stnsvn_cta1_tab',
                array(
                'sanitize_callback' => 'sanitize_checkbox',
                'default'   => 0
                )
        );
        $wp_customize->add_control(
            'stnsvn_cta1_tab',
            array(
                'type' => 'checkbox',
                'label' => __('Open link in new tab', 'paloma'),
                'section' => 'cta_boxes',
            )
        );

        //CTA 2 image upload 
        $wp_customize->add_setting( 
            'stnsvn_cta2_upload',
            array(
                'transport'         => 'refresh',
                'sanitize_callback' => 'absint'
                )
        );
         
        $wp_customize->add_control(
            new WP_Customize_Cropped_Image_Control(
                $wp_customize,
                'stnsvn_cta2_upload',
                array(
                    'label' => __('Box 2 image upload', 'paloma'),
                    'section' => 'cta_boxes',
                        'width' => 900,
                        'height' => 745
                )
            )
        );

        //CTA 2 Text
        $wp_customize->add_setting(
            'stnsvn_cta2_text',
            array(
            'sanitize_callback' => 'paloma_sanitize_text',
            'default' => '',
            )
        );

        $wp_customize->add_control(
            'stnsvn_cta2_text',
            array(
                'label' => __('Box 2 text', 'paloma'),
                'section' => 'cta_boxes',
            )
        );

        //CTA 2 URL
        $wp_customize->add_setting(
            'stnsvn_cta2_url',
            array(
            'sanitize_callback' => 'paloma_sanitize_text',
            'default' => '',
            )
        );

        $wp_customize->add_control(
            'stnsvn_cta2_url',
            array(
                'label' => __('Box 2 link', 'paloma'),
                'section' => 'cta_boxes',
            )
        );

        //CTA 2 Tab 
         $wp_customize->add_setting(
            'stnsvn_cta2_tab',
                array(
                'sanitize_callback' => 'sanitize_checkbox',
                'default'   => 0
                )
        );
        $wp_customize->add_control(
            'stnsvn_cta2_tab',
            array(
                'type' => 'checkbox',
                'label' => __('Open link in new tab', 'paloma'),
                'section' => 'cta_boxes',
            )
        );

        //CTA 3 image upload 
        $wp_customize->add_setting( 
            'stnsvn_cta3_upload',
            array(
                'transport'         => 'refresh',
                'sanitize_callback' => 'absint'
                )
        );
         
        $wp_customize->add_control(
            new WP_Customize_Cropped_Image_Control(
                $wp_customize,
                'stnsvn_cta3_upload',
                array(
                    'label' => __('Box 3 image upload', 'paloma'),
                    'section' => 'cta_boxes',
                        'width' => 900,
                        'height' => 745
                )
            )
        );

        //CTA 3 Text
        $wp_customize->add_setting(
            'stnsvn_cta3_text',
            array(
            'sanitize_callback' => 'paloma_sanitize_text',
            'default' => '',
            )
        );

        $wp_customize->add_control(
            'stnsvn_cta3_text',
            array(
                'label' => __('Box 3 text', 'paloma'),
                'section' => 'cta_boxes',
            )
        );

        //CTA 3 URL
        $wp_customize->add_setting(
            'stnsvn_cta3_url',
            array(
            'sanitize_callback' => 'paloma_sanitize_text',
            'default' => '',
            )
        );

        $wp_customize->add_control(
            'stnsvn_cta3_url',
            array(
                'label' => __('Box 3 link', 'paloma'),
                'section' => 'cta_boxes',
            )
        );

        //CTA 3 Tab 
         $wp_customize->add_setting(
            'stnsvn_cta3_tab',
                array(
                'sanitize_callback' => 'sanitize_checkbox',
                'default'   => 0
                )
        );
        $wp_customize->add_control(
            'stnsvn_cta3_tab',
            array(
                'type' => 'checkbox',
                'label' => __('Open link in new tab', 'paloma'),
                'section' => 'cta_boxes',
            )
        );

//-----------------------Layout Panel -----------------------//

$wp_customize->add_panel( 'layout_settings', array(
    'priority'       => 40,
    'title'          => __('Layout Settings', 'paloma'),
) );


	//-----------------------Single Pages Section -----------------------//
	      // Add single pages section  
	        $wp_customize->add_section(
	            'single_pages',
	            array(
	                'title' => __('Single Pages', 'paloma'),
	                'description' => __('These settings apply to static pages only.', 'paloma'),
	                'priority' => 70,
	                'panel'  => 'layout_settings',
	            )
	        );

	        // Add content display style selector
	        $wp_customize->add_setting(
	            'paloma_page_display_style',
	            array(
	                'default' => 'full_width',
	            )
	        );
	         
	        $wp_customize->add_control(
	            'paloma_page_display_style',
	            array(
	                'type' => 'select',
	                'label' => __('Select layout style for single pages:', 'paloma'),
	                'section' => 'single_pages',
	                'choices' => array(
	                    'full_width' => __('Full Width Content', 'paloma'),
	                    'sidebar' => __('Sidebar Layout', 'paloma'),
	                ),
	            )
	        );

            //Display featured image
                $wp_customize->add_setting(
                'paloma_page_featured',
                    array(
                    'sanitize_callback' => 'sanitize_checkbox',
                    'default' => 1,
                )
            );

            $wp_customize->add_control(
                'paloma_page_featured',
                array(
                    'type' => 'checkbox',
                    'label' => __('Display featured image', 'paloma'),
                    'section' => 'single_pages',
                )
            );


	//-----------------------Blog Page Section -----------------------//
	      // Add Blog Page section  
	        $wp_customize->add_section(
	            'blog_page',
	            array(
	                'title' => __('Blog Page', 'paloma'),
	                'description' => __('These settings apply to the main blog only.', 'paloma'),
	                'priority' => 75,
	                'panel'  => 'layout_settings',
	            )
	        );

	        // Add content display style selector
	        $wp_customize->add_setting(
	            'paloma_blog_display_style',
	            array(
	                'default' => 'sidebar',
	            )
	        );
	         
	        $wp_customize->add_control(
	            'paloma_blog_display_style',
	            array(
	                'type' => 'select',
	                'label' => __('Select layout style for the blog page:', 'paloma'),
	                'section' => 'blog_page',
	                'choices' => array(
	                    'full_width' => __('Full Width Content', 'paloma'),
	                    'sidebar' => __('Sidebar Layout', 'paloma'),
	                ),
	            )
	        );

            // Add content display style selector
            $wp_customize->add_setting(
                'paloma_blog_layout',
                array(
                    'default' => 'grid_featured',
                )
            );
             
            $wp_customize->add_control(
                'paloma_blog_layout',
                array(
                    'type' => 'select',
                    'label' => __('Select post layout for the blog page:', 'paloma'),
                    'section' => 'blog_page',
                    'choices' => array(
                        'grid_featured' => __('Featured + Grid Layout', 'paloma'),
                        'grid' => __('Grid Layout', 'paloma'),
                        'featured' => __('Featured + Row Posts', 'paloma'),
                        'row' => __('Row Posts', 'paloma'),
                        'standard' => __('Standard Posts', 'paloma'),
                    ),
                )
            );

            //Excerpt custom length
            $wp_customize->add_setting(
                'paloma_excerpt_length',
                array(
                'sanitize_callback' => 'paloma_absint',
                'default' => '35'
                )
            );

            $wp_customize->add_control(
                'paloma_excerpt_length',
                array(
                    'label' => __('Blog excerpt length', 'paloma'),
                    'section' => 'blog_page',
                    'description' => __('Set a custom excerpt length here, in words (default is 35 words). The following settings apply to Row and Grid style posts only.', 'paloma'),
                )
            );

            //Display post category
                $wp_customize->add_setting(
                'blog_display_cats',
                    array(
                    'sanitize_callback' => 'sanitize_checkbox',
                    'default' => 1,
                )
            );

            $wp_customize->add_control(
                'blog_display_cats',
                array(
                    'type' => 'checkbox',
                    'label' => __('Display post category', 'paloma'),
                    'section' => 'blog_page',
                )
            );

            //Display post date
                $wp_customize->add_setting(
                'blog_display_date',
                    array(
                    'sanitize_callback' => 'sanitize_checkbox',
                    'default' => 1,
                )
            );

            $wp_customize->add_control(
                'blog_display_date',
                array(
                    'type' => 'checkbox',
                    'label' => __('Display post date', 'paloma'),
                    'section' => 'blog_page',
                )
            );

            //Read More text
            $wp_customize->add_setting( 
                'paloma_readmore',
                            array(
                    'sanitize_callback' => 'paloma_sanitize_text',
                    'default' => 'Read More',
                )
            );
             
            $wp_customize->add_control(
                new WP_Customize_Control(
                    $wp_customize,
                    'paloma_readmore',
                    array(
                        'description' => __('Leave empty to hide button', 'paloma'),
                        'label' => __('Read More button text', 'paloma'),
                        'section' => 'blog_page',
                        'settings' => 'paloma_readmore',
                        'type' => 'text'
                    )
                )
            );

    //-----------------------Accent Squiggle Section -----------------------//
          // Add Archives section  
            $wp_customize->add_section(
                'accent_squiggle',
                array(
                    'title' => __('Accent Image', 'paloma'),
                    'description' => __('These settings apply to the accent image (the squiggly line underneath Page Builder section titles and "Read More") .', 'paloma'),
                    'priority' => 80,
                )
            );

            //Display read more accent
                $wp_customize->add_setting(
                'display_read_more_accent',
                    array(
                    'sanitize_callback' => 'sanitize_checkbox',
                    'default' => 1,
                )
            );

            $wp_customize->add_control(
                'display_read_more_accent',
                array(
                    'type' => 'checkbox',
                    'label' => __('Display accent under Read More', 'paloma'),
                    'section' => 'accent_squiggle',
                )
            );


            //Accent color
            $wp_customize->add_setting(
                'accent_color',
                array(
                    'default' => '#c58f69',
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );
            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'accent_color',
                    array(
                        'label' => __('Accent image color', 'paloma'),
                        'section' => 'accent_squiggle',
                        'settings' => 'accent_color',
                    )
                )
            );

	//-----------------------Archives Section -----------------------//
	      // Add Archives section  
	        $wp_customize->add_section(
	            'archives',
	            array(
	                'title' => __('Post Archives', 'paloma'),
	                'description' => __('These settings apply to post archives only.', 'paloma'),
	                'priority' => 80,
	                'panel'  => 'layout_settings',
	            )
	        );

	        // Add content display style selector
	        $wp_customize->add_setting(
	            'paloma_archive_display_style',
	            array(
	                'default' => 'full_width',
	            )
	        );
	         
	        $wp_customize->add_control(
	            'paloma_archive_display_style',
	            array(
	                'type' => 'select',
	                'label' => __('Select layout style for post archives:', 'paloma'),
	                'section' => 'archives',
	                'choices' => array(
	                    'full_width' => __('Full Width Content', 'paloma'),
	                    'sidebar' => __('Sidebar Layout', 'paloma'),
	                ),
	            )
	        );

            // Add content display style selector
            $wp_customize->add_setting(
                'paloma_archive_layout',
                array(
                    'default' => 'grid',
                )
            );
             
            $wp_customize->add_control(
                'paloma_archive_layout',
                array(
                    'type' => 'select',
                    'label' => __('Select post layout for archives:', 'paloma'),
                    'section' => 'archives',
                    'choices' => array(
                        'grid' => __('Grid Layout', 'paloma'),
                        'standard' => __('Standard Layout', 'paloma'),
                        'row' => __('Row Posts', 'paloma')
                    ),
                )
            );

            //Archives number of posts
            $wp_customize->add_setting(
                'paloma_archive_number_posts',
                array(
                'sanitize_callback' => 'paloma_absint',
                'default' => '9'
                )
            );

            $wp_customize->add_control(
                'paloma_archive_number_posts',
                array(
                    'label' => __('Number of posts', 'paloma'),
                    'section' => 'archives',
                    'description' => __('Choose number of posts to display on archive pages.', 'paloma'),
                )
            );

            //Archives excerpt custom length
            $wp_customize->add_setting(
                'paloma_archive_excerpt_length',
                array(
                'sanitize_callback' => 'paloma_absint',
                'default' => '35'
                )
            );

            $wp_customize->add_control(
                'paloma_archive_excerpt_length',
                array(
                    'label' => __('Archive excerpt length', 'paloma'),
                    'section' => 'archives',
                    'description' => __('Set a custom excerpt length here, in words (default is 35 words). The following settings apply to Row and Grid style posts only.', 'paloma'),
                )
            );

            //Display post category
                $wp_customize->add_setting(
                'archive_display_cats',
                    array(
                    'sanitize_callback' => 'sanitize_checkbox',
                    'default' => 1,
                )
            );

            $wp_customize->add_control(
                'archive_display_cats',
                array(
                    'type' => 'checkbox',
                    'label' => __('Display post category', 'paloma'),
                    'section' => 'archives',
                )
            );

            //Display post date
                $wp_customize->add_setting(
                'archive_display_date',
                    array(
                    'sanitize_callback' => 'sanitize_checkbox',
                    'default' => 1,
                )
            );

            $wp_customize->add_control(
                'archive_display_date',
                array(
                    'type' => 'checkbox',
                    'label' => __('Display post date', 'paloma'),
                    'section' => 'archives',
                )
            );

            //Archives Read More text
            $wp_customize->add_setting( 
                'paloma_archive_readmore',
                            array(
                    'sanitize_callback' => 'paloma_sanitize_text',
                    'default' => 'Read More',
                )
            );
             
            $wp_customize->add_control(
                new WP_Customize_Control(
                    $wp_customize,
                    'paloma_archive_readmore',
                    array(
                        'description' => __('Leave empty to hide button', 'paloma'),
                        'label' => __('Read More button text', 'paloma'),
                        'section' => 'archives',
                        'settings' => 'paloma_archive_readmore',
                        'type' => 'text'
                    )
                )
            );

	//-----------------------Blog Posts Section -----------------------//
	      // Add blog posts section  
	        $wp_customize->add_section(
	            'blog_post',
	            array(
	                'title' => __('Blog Posts', 'paloma'),
	                'description' => __('These settings apply to individual blog posts and blog layouts with featured posts only.', 'paloma'),
	                'priority' => 85,
	                'panel'  => 'layout_settings',
	            )
	        );

	        // Add content display style selector
	        $wp_customize->add_setting(
	            'paloma_display_style',
	            array(
	                'default' => 'sidebar',
	            )
	        );
	         
	        $wp_customize->add_control(
	            'paloma_display_style',
	            array(
	                'type' => 'select',
	                'label' => __('Select layout style for single posts:', 'paloma'),
	                'section' => 'blog_post',
	                'choices' => array(
	                    'full_width' => __('Full Width Content', 'paloma'),
	                    'sidebar' => __('Sidebar Layout', 'paloma'),
	                ),
	            )
	        );

            //Display featured image
                $wp_customize->add_setting(
                'display_featured_img',
                    array(
                    'sanitize_callback' => 'sanitize_checkbox',
                    'default' => 0,
                )
            );

            $wp_customize->add_control(
                'display_featured_img',
                array(
                    'type' => 'checkbox',
                    'label' => __('Display featured image', 'paloma'),
                    'section' => 'blog_post',
                )
            );

	       	//Display post category
	            $wp_customize->add_setting(
	            'display_cats',
	                array(
	                'sanitize_callback' => 'sanitize_checkbox',
                    'default' => 1,
	            )
	        );

	        $wp_customize->add_control(
	            'display_cats',
	            array(
	                'type' => 'checkbox',
	                'label' => __('Display post category', 'paloma'),
	                'section' => 'blog_post',
	            )
	        );

	        //Display post date
	            $wp_customize->add_setting(
	            'display_date',
	                array(
	                'sanitize_callback' => 'sanitize_checkbox',
                    'default' => 1,
	            )
	        );

	        $wp_customize->add_control(
	            'display_date',
	            array(
	                'type' => 'checkbox',
	                'label' => __('Display post date', 'paloma'),
	                'section' => 'blog_post',
	            )
	        );

	        //Display author by line
	            $wp_customize->add_setting(
	            'display_byline',
	                array(
	                'sanitize_callback' => 'sanitize_checkbox',
                    'default' => 0,
	            )
	        );

	        $wp_customize->add_control(
	            'display_byline',
	            array(
	                'type' => 'checkbox',
	                'label' => __('Display author byline (single posts only)', 'paloma'),
	                'section' => 'blog_post',
	            )
	        );

            //Display author by line
                $wp_customize->add_setting(
                'display_byline_featured',
                    array(
                    'sanitize_callback' => 'sanitize_checkbox',
                )
            );

            $wp_customize->add_control(
                'display_byline_featured',
                array(
                    'type' => 'checkbox',
                    'label' => __('Display author byline (featured posts only)', 'paloma'),
                    'section' => 'blog_post',
                )
            );

            //Display author box
                $wp_customize->add_setting(
                'display_author_box',
                    array(
                    'sanitize_callback' => 'sanitize_checkbox',
                    'default' => 1,
                )
            );

            $wp_customize->add_control(
                'display_author_box',
                array(
                    'type' => 'checkbox',
                    'label' => __('Display author info box (single posts only)', 'paloma'),
                    'section' => 'blog_post',
                )
            );

            //Display post tags
                $wp_customize->add_setting(
                'display_tags',
                    array(
                    'sanitize_callback' => 'sanitize_checkbox',
                    'default' => 1,
                )
            );

            $wp_customize->add_control(
                'display_tags',
                array(
                    'type' => 'checkbox',
                    'label' => __('Display post tags (single posts only)', 'paloma'),
                    'section' => 'blog_post',
                )
            );

            //Display share buttons
                $wp_customize->add_setting(
                'display_share_single',
                    array(
                    'sanitize_callback' => 'sanitize_checkbox',
                    'default' => '1'
                )
            );

            $wp_customize->add_control(
                'display_share_single',
                array(
                    'type' => 'checkbox',
                    'label' => __('Display share buttons', 'paloma'),
                    'section' => 'blog_post',
                )
            );

        //-----------------------Jetpack Portfolio Pages Section -----------------------//
        //Check if Jetpack installed and Portfolio CCT enabled
        if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'custom-content-types' ) ) {
          // Add single pages section  
            $wp_customize->add_section(
                'portfolio_pages',
                array(
                    'title' => __('Portfolio Pages', 'paloma'),
                    'description' => __('These settings apply to portfolio pages only.', 'paloma'),
                    'priority' => 200,
                    'panel'  => 'layout_settings',
                )
            );

            // Add content display style selector
            $wp_customize->add_setting(
                'paloma_portfolio_display_style',
                array(
                    'default' => 'full_width',
                )
            );
             
            $wp_customize->add_control(
                'paloma_portfolio_display_style',
                array(
                    'type' => 'select',
                    'label' => __('Select layout style for portfolio pages:', 'paloma'),
                    'section' => 'portfolio_pages',
                    'choices' => array(
                        'full_width' => __('Full Width Content', 'paloma'),
                        'sidebar' => __('Sidebar Layout', 'paloma'),
                    ),
                )
            );

            //Display featured image
            $wp_customize->add_setting(
                'paloma_portfolio_featured',
                    array(
                    'sanitize_callback' => 'sanitize_checkbox',
                    'default' => 1,
                )
            );

            $wp_customize->add_control(
                'paloma_portfolio_featured',
                array(
                    'type' => 'checkbox',
                    'label' => __('Display featured image', 'paloma'),
                    'section' => 'portfolio_pages',
                )
            );

        } //end conditional check

if (class_exists( "WooCommerce" )) {
//-----------------------WooCommerce Layout Section -----------------------//
          // Add WooCommerce section  
            $wp_customize->add_section(
                'paloma_woocommerce',
                array(
                    'title' => __('WooCommerce', 'paloma'),
                    'description' => __('These settings apply to WooCommerce pages only.', 'paloma'),
                    'priority' => 95,
                    'panel'  => 'layout_settings',
                )
            );

            // Add content display style selector
            $wp_customize->add_setting(
                'paloma_woocommerce_style',
                array(
                    'default' => 'full_width',
                )
            );
             
            $wp_customize->add_control(
                'paloma_woocommerce_style',
                array(
                    'type' => 'select',
                    'label' => __('Select layout style for WooCommerce pages:', 'paloma'),
                    'section' => 'paloma_woocommerce',
                    'choices' => array(
                        'full_width' => __('Full Width Content', 'paloma'),
                        'sidebar' => __('Sidebar Layout', 'paloma'),
                    ),
                )
            );

            //Number of products
            $wp_customize->add_setting(
                'wc_number_products',
                array(
                'sanitize_callback' => 'paloma_absint',
                'default' => '6',
                'transport' => 'refresh',
                )
            );

            $wp_customize->add_control(
                'wc_number_products',
                array(
                    'label' => __('Number of Products', 'paloma'),
                    'section' => 'paloma_woocommerce',
                    'description' => __('Select number of products to display on WooCommerce shop pages', 'paloma'),
                )
            );

             //Disable back to top checkbox
            $wp_customize->add_setting( 
                'stnsvn_cart_display',
                            array(
                    'sanitize_callback' => 'sanitize_checkbox',
                    'default'   => 1,
                )
            );
             
            $wp_customize->add_control(
                new WP_Customize_Control(
                    $wp_customize,
                    'stnsvn_cart_display',
                    array(
                        'label' => __('Display cart button in upper nav bar', 'paloma'),
                        'section' => 'navigation',
                        'settings' => 'stnsvn_cart_display',
                        'type' => 'checkbox',
                    )
                )
            );
   
}//End WC conditional

//-----------------------Sidebar Section -----------------------//
          // Add sidebar section  
            $wp_customize->add_section(
                'layout_sidebar',
                array(
                    'title' => __('Sidebar', 'paloma'),
                    'description' => __('These settings only apply if sidebars are configured.', 'paloma'),
                    'priority' => 105,
                    'panel'  => 'layout_settings',
                )
            );

            //Toggle sidebar sticky
                $wp_customize->add_setting( 
                    'stnsvn_sidebar_sticky',
                                array(
                        'sanitize_callback' => 'sanitize_checkbox',
                        'default'   => 0,
                    )
                );
                 
                $wp_customize->add_control(
                    new WP_Customize_Control(
                        $wp_customize,
                        'stnsvn_sidebar_sticky',
                        array(
                            'label' => __('Disable sidebar stickiness', 'paloma'),
                            'section' => 'layout_sidebar',
                            'settings' => 'stnsvn_sidebar_sticky',
                            'type' => 'checkbox',
                        )
                    )
                );

//-----------------------Colors Section -----------------------//

        //Header alternate text color
            $wp_customize->add_setting(
            'header_alt_textcolor',
            array(
                'default' => '#ffffff',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
            $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'header_alt_textcolor',
                array(
                    'label' => __('Header Text Color (when header image/video active)', 'paloma'),
                    'section' => 'colors',
                    'settings' => 'header_alt_textcolor',
                )
            )
        );

        //Primary background color
            $wp_customize->add_setting(
            'primary-background-color',
            array(
                'default' => '#fbf9f5',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
            $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'primary-background-color',
                array(
                    'label' => __('Primary Background Color', 'paloma'),
                    'section' => 'colors',
                    'settings' => 'primary-background-color',
                )
            )
        );

        //Secondary background color
            $wp_customize->add_setting(
            'secondary_background_color',
            array(
                'default' => '#ffffff',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
            $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'secondary_background_color',
                array(
                    'label' => __('Secondary Background Color', 'paloma'),
                    'section' => 'colors',
                    'settings' => 'secondary_background_color',
                )
            )
        );

        //Footer background color
            $wp_customize->add_setting(
            'footer-background-color',
            array(
                'default' => '#fff4ec',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
            $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'footer-background-color',
                array(
                    'label' => __('Footer Background Color', 'paloma'),
                    'section' => 'colors',
                    'settings' => 'footer-background-color',
                )
            )
        );

        //Prefooter background color
            $wp_customize->add_setting(
            'prefooter-background-color',
            array(
                'default' => '#c58f69',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
            $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'prefooter-background-color',
                array(
                    'label' => __('Prefooter Background Color', 'paloma'),
                    'section' => 'colors',
                    'settings' => 'prefooter-background-color',
                )
            )
        );

        //Button color
            $wp_customize->add_setting(
            'button_color',
            array(
                'default' => '#34483d',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
            $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'button_color',
                array(
                    'label' => __('Button Color', 'paloma'),
                    'section' => 'colors',
                    'settings' => 'button_color',
                )
            )
        );

        //Button hover color
            $wp_customize->add_setting(
            'button_hover_color',
            array(
                'default' => '#fff4ec',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
            $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'button_hover_color',
                array(
                    'label' => __('Button Hover Color', 'paloma'),
                    'section' => 'colors',
                    'settings' => 'button_hover_color',
                )
            )
        );

        //Divider line color
            $wp_customize->add_setting(
            'divider_line_color',
            array(
                'default' => '#dddddd',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
            $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'divider_line_color',
                array(
                    'label' => __('Divider Line Color', 'paloma'),
                    'section' => 'colors',
                    'settings' => 'divider_line_color',
                )
            )
        );  

//-----------------------Typography Section -----------------------//
      // Add Typography section  
        $wp_customize->add_section(
            'typography',
            array(
                'title' => __('Typography', 'paloma'),
                'description' => __('Customize the site typography here. Insert <a href="https://www.google.com/fonts" target="_blank">Google Fonts</a> code (eg. http://fonts.googleapis.com/css?family=Lora) and then enter the font name (eg. Lora) in the desired section.', 'paloma'),
                'priority' => 40,
            )
        );
      //Typography Settings
      //Google Font Link Field
        $wp_customize->add_setting(
            'google_font_code',
            array(
            'sanitize_callback' => 'esc_url_raw',
            )
        );
        $wp_customize->add_control(
            'google_font_code',
            array(
                'type' => 'text',
                'label' => __('Google Font Link Code', 'paloma'),
                'section' => 'typography',
            )
        );
        //Primary Header Font
        $wp_customize->add_setting(
            'primary_font_family',
            array(
            'sanitize_callback' => 'paloma_sanitize_text',
            )
        );
        $wp_customize->add_control(
            'primary_font_family',
            array(
                'label' => __('Primary Header Font Family', 'paloma'),
                'section' => 'typography',
            )
        );

        //Primary font size
        $wp_customize->add_setting( 'primary_font_size', array(
            'default' => '150',
            'sanitize_callback' => 'paloma_absint',
        ) );

        $wp_customize->add_control( 'primary_font_size', array(
            'type' => 'range',
            'section' => 'typography',
            'label' => __( 'Primary Header Font Size', 'paloma' ),
            'description' => '',
            'default' => '150',
            'input_attrs' => array(
                'min' => 10,
                'max' => 300,
                'step' => 5,
                'style' => 'color: #0a0',
            ),
        ) );

        //Secondary Header Font
        $wp_customize->add_setting(
            'secondary_font_family',
            array(
            'sanitize_callback' => 'paloma_sanitize_text',
            )
        );
        $wp_customize->add_control(
            'secondary_font_family',
            array(
                'label' => __('Secondary Header Font Family', 'paloma'),
                'section' => 'typography',
            )
        );

        //Secondary font size
        $wp_customize->add_setting( 'secondary_font_size', array(
            'default' => '70',
            'sanitize_callback' => 'paloma_absint',
        ) );

        $wp_customize->add_control( 'secondary_font_size', array(
            'type' => 'range',
            'section' => 'typography',
            'label' => __( 'Secondary Header Font Size', 'paloma' ),
            'description' => '',
            'input_attrs' => array(
                'min' => 5,
                'max' => 140,
                'step' => 5,
                'style' => 'color: #0a0',
            ),
        ) );

        //BodyFont
        $wp_customize->add_setting(
            'body_font_family',
            array(
            'sanitize_callback' => 'paloma_sanitize_text',
            )
        );
        $wp_customize->add_control(
            'body_font_family',
            array(
                'label' => __('Body Text Font Family', 'paloma'),
                'section' => 'typography',
            )
        );

        //Body font size
        $wp_customize->add_setting( 'body_font_size', array(
            'default' => '85',
            'sanitize_callback' => 'paloma_absint',
        ) );

        $wp_customize->add_control( 'body_font_size', array(
            'type' => 'range',
            'section' => 'typography',
            'label' => __( 'Body Font Size', 'paloma' ),
            'description' => '',
            'input_attrs' => array(
                'min' => 5,
                'max' => 170,
                'step' => 5,
                'style' => 'color: #0a0',
            ),
        ) );

         //Primary text color
            $wp_customize->add_setting(
            'primary-text-color',
            array(
                'default' => '#222222',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
            $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'primary-text-color',
                array(
                    'label' => __('Text Color', 'paloma'),
                    'section' => 'typography',
                    'settings' => 'primary-text-color',
                )
            )
        );

        //Footer text color
            $wp_customize->add_setting(
            'secondary-text-color',
            array(
                'default' => '#222222',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
            $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'secondary-text-color',
                array(
                    'label' => __('Footer Text Color', 'paloma'),
                    'section' => 'typography',
                    'settings' => 'secondary-text-color',
                )
            )
        );

        //Link text color
            $wp_customize->add_setting(
            'link_text_color',
            array(
                'default' => '#C58F69',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
            $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'link_text_color',
                array(
                    'label' => __('Link Text Color', 'paloma'),
                    'section' => 'typography',
                    'settings' => 'link_text_color',
                )
            )
        );

//-----------------------Footer Settings Section -----------------------//
        // Add Footer Settings section  
        $wp_customize->add_section(
            'footer_settings',
            array(
                'title' => __('Footer', 'paloma'),
                'priority' => 200,
            )
        );

        //Prefooter newsletter section BG upload
        $wp_customize->add_setting( 
            'stnsvn_prefooter_upload',
            array(
                'transport'         => 'refresh',
                )
        );
         
        $wp_customize->add_control(
            new WP_Customize_Image_Control(
                $wp_customize,
                'stnsvn_prefooter_upload',
                array(
                    'label' => __('Prefooter Newsletter Section', 'paloma'),
                    'section' => 'footer_settings',
                    'description' => __('Background image upload', 'paloma'),
                    'settings' => 'stnsvn_prefooter_upload'
                )
            )
        );

        //Toggle prefooter background lines
        $wp_customize->add_setting( 
            'stnsvn_prefooter_accent',
                        array(
                'sanitize_callback' => 'sanitize_checkbox',
                'default'   => 0,
            )
        );
         
        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'stnsvn_prefooter_accent',
                array(
                    'label' => __('Disable line accents on Prefooter Newsletter Section background (when no custom background image is used)', 'paloma'),
                    'section' => 'footer_settings',
                    'settings' => 'stnsvn_prefooter_accent',
                    'type' => 'checkbox',
                )
            )
        );

        //Change number of columns
         $wp_customize->add_setting(
            'footer_col_number',
            array(
                'default' => '0',
            )
        );
         
        $wp_customize->add_control(
            'footer_col_number',
            array(
                'type' => 'select',
                'label' => __('Traditional Footer', 'paloma'),
                'description' => __('You can enable a traditional style footer here. Choose how many columns to display then add widgets under the Widgets panel.', 'paloma'),
                'section' => 'footer_settings',
                'choices' => array(
                    '0' => __('None (hidden)', 'paloma'),
                    '1' => __('1 column', 'paloma'),
                    '2' => __('2 columns', 'paloma'),
                    '3' => __('3 columns', 'paloma'),
                    '4' => __('4 columns', 'paloma'),
                ),
            )
        );

        //Back to top settings
        //BTT image upload section
        $wp_customize->add_setting( 
            'stnsvn_btt_upload',
            array(
                'transport'         => 'refresh',
                )
        );
         
        $wp_customize->add_control(
            new WP_Customize_Image_Control(
                $wp_customize,
                'stnsvn_btt_upload',
                array(
                    'label' => __('Custom back to top upload', 'paloma'),
                    'section' => 'footer_settings',
                    'settings' => 'stnsvn_btt_upload'
                )
            )
        );
        
        //Toggle btt sticky
        $wp_customize->add_setting( 
            'stnsvn_btt_sticky',
                        array(
                'sanitize_callback' => 'sanitize_checkbox',
                'default'   => 0,
            )
        );
         
        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'stnsvn_btt_sticky',
                array(
                    'label' => __('Disable Back to Top stickiness', 'paloma'),
                    'section' => 'footer_settings',
                    'settings' => 'stnsvn_btt_sticky',
                    'type' => 'checkbox',
                )
            )
        );

        //Disable back to top checkbox
        $wp_customize->add_setting( 
            'stnsvn_btt_display',
                        array(
                'sanitize_callback' => 'sanitize_checkbox',
                'default'   => 0,
            )
        );
         
        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'stnsvn_btt_display',
                array(
                    'label' => __('Disable Back to Top button', 'paloma'),
                    'section' => 'footer_settings',
                    'settings' => 'stnsvn_btt_display',
                    'type' => 'checkbox',
                )
            )
        );

        //Copyright footer text section
        $wp_customize->add_setting( 
            'copyright-footer',
                        array(
                'sanitize_callback' => 'paloma_sanitize_text',
            )
        );
         
        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'copyright-footer',
                array(
                    'label' => __('Footer Copyright Text', 'paloma'),
                    'section' => 'footer_settings',
                    'settings' => 'copyright-footer',
                    'type' => 'text',
                    'description' => __('Add text to display in the footer copyright area.', 'paloma')
                )
            )
        );
        

        //Remove stnsvn footer credit
        $wp_customize->add_setting( 
            'stnsvn-credit',
                        array(
                'sanitize_callback' => 'sanitize_checkbox',
                'default'   => 0
            )
        );
         
        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'stnsvn-credit',
                array(
                    'label' => __('Hide Station Seven credit?', 'paloma'),
                    'section' => 'footer_settings',
                    'settings' => 'stnsvn-credit',
                    'type' => 'checkbox',
                    'description' => __('While of course not required, we appreciate any support as we grow our small business :)', 'paloma')
                )
            )
        );

    //-----------------------Development Section -----------------------//
      // Add Development section 
        $wp_customize->add_section(
            'paloma_development',
            array(
                'title' => __('Development', 'paloma'),
                'priority' => 200,
            )
        );
        //Activate ACF Pro menu items
         $wp_customize->add_setting(
            'paloma_acf_pro',
                array(
                'sanitize_callback' => 'sanitize_checkbox',
                'default'   => 0
                )
        );
        $wp_customize->add_control(
            'paloma_acf_pro',
            array(
                'type' => 'checkbox',
                'label' => __('Display ACF Pro admin menu', 'paloma'),
                'description' => __('The Advanced Custom Fields Pro plugin is included free with this theme. Check this box to enable and access the configuration area in your WP dashboard.', 'paloma'),
                'section' => 'paloma_development',
            )
        );

} //End Customizer

//Sanitize customizer inputs
        //Checkbox sanitization
        function sanitize_checkbox( $input ) {
            if ( $input == 1 ) {
                return 1;
            } else {
                return '';
            }
        }

        //Textbox sanitation
        function paloma_sanitize_text( $input ) {
            return wp_kses_post( force_balance_tags( $input ) );
        }

        //Integer sanitization
        function paloma_absint( $input ) {
            return absint( $input );
        }

//Register changes from customizer
add_action( 'customize_register', 'paloma_customizer', 20 );


//* Apply CSS options via wp_head
function paloma_customizer_head_styles() {
    echo '<style type="text/css">';

    $stnsvn_logo_size = get_theme_mod( 'stnsvn_logo_size', '100' ); 
    if ( $stnsvn_logo_size != '100' ) :
    ?>
            .header-logo img {
                max-height: <?php echo $stnsvn_logo_size; ?>px;
            }
    <?php
    endif;

    $stnsvn_header_overlay = get_theme_mod( 'stnsvn_header_overlay', '#222222' ); 
    $stnsvn_overlay_opacity = get_theme_mod( 'stnsvn_overlay_opacity', '0' ); 
    $stnsvn_opacity_divisor = '10'
    //if ( $stnsvn_overlay_opacity != '0' ) :
    ?>
            .home .site-header:before {
                background-color: <?php echo $stnsvn_header_overlay; ?>;
                opacity: <?php echo $stnsvn_overlay_opacity / $stnsvn_opacity_divisor; ?>;
            }
    <?php
    //endif;

    $header_textcolor = get_theme_mod( 'header_textcolor', '222222' ); 
    if ( $header_textcolor != '222222' ) :
    ?>
            .site-header {
                color: <?php echo '#' , $header_textcolor; ?>;
            }

    <?php
    endif;

    $header_alt_textcolor = get_theme_mod( 'header_alt_textcolor', '#ffffff' ); 
    if ( $header_alt_textcolor != '#ffffff' ) :
        if ( has_custom_header()) { ?>
            .custom-header-active .site-header,
            .custom-header-active .upper-nav-container.stick.nav-transparent {
                color: <?php echo $header_alt_textcolor; ?>;
            }

            .custom-header-active .upper-nav-container.stick.nav-transparent .search-field::-webkit-input-placeholder {
                color: <?php echo $header_alt_textcolor; ?>;
            }

            .custom-header-active .upper-nav-container.stick.nav-transparent .search-field:-moz-placeholder { /* Firefox 18- */
                color: <?php echo $header_alt_textcolor; ?>;
            }

            .custom-header-active .upper-nav-container.stick.nav-transparent .search-field::-moz-placeholder {  /* Firefox 19+ */
                color: <?php echo $header_alt_textcolor; ?>;
            }

            .custom-header-active .upper-nav-container.stick.nav-transparent .search-field:-ms-input-placeholder {  
                color: <?php echo $header_alt_textcolor; ?>;
            }

            .custom-header-active .stick.nav-transparent .cart-icon path {
                fill: <?php echo $header_alt_textcolor; ?>;
            }
    <?php }
    endif;

    $background_color = get_theme_mod( 'primary-background-color', '#fbf9f5' ); 
    if ( $background_color != '#fbf9f5' ) :
    ?>
            body {
                background-color: <?php echo $background_color; ?>;
            }
    <?php
    endif;

    $secondary_background_color = get_theme_mod( 'secondary_background_color', '#ffffff' ); 
    if ( $secondary_background_color != '#ffffff' ) :
    ?>
            pre,
            .sub-menu,
            #secondary li.cat-item a,
            li.comment article,
            .large-button.light-button a,
            .paloma-latest-single,
            .testimonial-inner,
            #prefooter .null-instagram-feed .widget-title,
            input,
            input[type="text"], 
            input[type="email"], 
            input[type="url"], 
            input[type="password"], 
            input[type="search"], textarea,
            .page .entry-header h1,
            .blog .main-gallery .entry-header,
            .image-block h4,
            article,
            .btt-container {
                background-color: <?php echo $secondary_background_color; ?>;
            }
    <?php
    endif;

    $footer_background_color = get_theme_mod( 'footer-background-color', '#fff4ec' ); 
    if ( $footer_background_color != '#fff4ec' ) :
    ?>
            .site-footer {
                background-color: <?php echo $footer_background_color; ?>;
            }
    <?php
    endif;

    $prefooter_background_color = get_theme_mod( 'prefooter-background-color', '#c58f69' ); 
    if ( $prefooter_background_color != '#c58f69' ) :
    ?>
            #prefooter {
                background-color: <?php echo $prefooter_background_color; ?>;
            }
    <?php
    endif;

    $button_color = get_theme_mod( 'button_color', '#34483d' ); 
    if ( $button_color != '#34483d' ) :
    ?>
            .large-button a, 
            input[type="submit"], 
            .nav-previous, 
            .nav-next, 
            #main #infinite-handle span button{
                background-color: <?php echo $button_color; ?>;
            }

    <?php
    endif;

    $button_hover_color = get_theme_mod( 'button_hover_color', '#fff4ec' ); 
    if ( $button_hover_color != '#fff4ec' ) :
    ?>
            .large-button a:hover,
            .large-button a:focus, 
            .enews #subbutton:hover, 
            .enews #subbutton:focus, 
            .nav-previous:hover, 
            .nav-previous:focus, 
            .nav-next:hover, 
            .nav-next:focus, 
            #main #infinite-handle span button:hover, 
            #main #infinite-handle span button:focus,
            button:hover,
            input[type="button"]:hover,
            input[type="reset"]:hover,
            input[type="submit"]:hover,
            .button:hover,
            button:focus,
            input[type="button"]:focus,
            input[type="reset"]:focus,
            input[type="submit"]:focus,
            .button:focus,
            button:active,
            input[type="button"]:active,
            input[type="reset"]:active,
            input[type="submit"]:active,
            .button:active {
                background-color: <?php echo $button_hover_color; ?>;
            }

    <?php
    endif;

    $divider_line_color = get_theme_mod( 'divider_line_color', '#dddddd' ); 
    if ( $divider_line_color != '#dddddd' ) :
    ?>
            td,
            th,
            .widget,
            blockquote {
                border-color: <?php echo $divider_line_color; ?>;
            }

            hr {
                background-color: <?php echo $divider_line_color; ?>
            }
    <?php
    endif;    

    $nav_background_color = get_theme_mod( 'nav-background-color', '#fbf9f5' ); 
    if ( $nav_background_color != '#fbf9f5' ) :
    ?>      
            .upper-nav-container {
                background-color: <?php echo $nav_background_color; ?>;
            }
    <?php
    endif;

    $nav_secondary_bg_color = get_theme_mod( 'nav-secondary-bg-color', '#fff4ec' ); 
    if ( $nav_secondary_bg_color != '#fff4ec' ) :
    ?>
            .primary-nav .sub-menu li:hover {
                background-color: <?php echo $nav_secondary_bg_color; ?>;
            }

            @media screen and (max-width: 960px){
                .primary-nav {
                    background-color: <?php echo $nav_secondary_bg_color; ?>;
                }
            }
    <?php
    endif;

    $nav_text_color = get_theme_mod( 'nav_text_color', '#222222' ); 
    if ( $nav_text_color != '#222222' ) :
    ?>
            .upper-nav-container,
            button.menu-toggle.activated,
            .activated ~ .primary-nav,
            .activated ~ .navbar-right  {
                color: <?php echo $nav_text_color; ?>;
            }

            .upper-nav-container .search-field::-webkit-input-placeholder,
            .custom-header-active .upper-nav-container.stick.nav-transparent .activated ~ .navbar-right .search-field::-webkit-input-placeholder {
               color: <?php echo $nav_text_color; ?>;
            }

            .upper-nav-container .search-field:-moz-placeholder,
            .custom-header-active .upper-nav-container.stick.nav-transparent .activated ~ .navbar-right .search-field:-moz-placeholder { /* Firefox 18- */
               color: <?php echo $nav_text_color; ?>;
            }

            .upper-nav-container .search-field::-moz-placeholder,
            .custom-header-active .upper-nav-container.stick.nav-transparent .activated ~ .navbar-right .search-field::-moz-placeholder {  /* Firefox 19+ */
               color: <?php echo $nav_text_color; ?>;
            }

            .upper-nav-container .search-field:-ms-input-placeholder,
            .custom-header-active .upper-nav-container.stick.nav-transparent .activated ~ .navbar-right .search-field:-ms-input-placeholder {  
               color: <?php echo $nav_text_color; ?>;
            }

            .custom-header-active .stick.nav-transparent .activated ~ .navbar-right .cart-icon path,
            .cart-icon path {
                fill: <?php echo $nav_text_color; ?>;
            }

    <?php
    endif;

    $primary_text_color = get_theme_mod( 'primary-text-color', '#222222' ); 
    if ( $primary_text_color != '#222222' ) :
    ?>
            body {
               color: <?php echo $primary_text_color; ?>;
            }

            ::-webkit-input-placeholder {
               color: <?php echo $primary_text_color; ?>;;
            }

            :-moz-placeholder { /* Firefox 18- */
               color: <?php echo $primary_text_color; ?>;;  
            }

            ::-moz-placeholder {  /* Firefox 19+ */
               color: <?php echo $primary_text_color; ?>;;  
            }

            :-ms-input-placeholder {  
               color: <?php echo $primary_text_color; ?>;;  
            }

            .flickity-prev-next-button .arrow {
              fill: <?php echo $primary_text_color; ?>;
            }

    <?php 
    endif;

    $secondary_text_color = get_theme_mod( 'secondary-text-color', '#222222' ); 
    if ( $secondary_text_color != '#222222' ) :
    ?>
            .site-footer {
                color: <?php echo $secondary_text_color; ?>;
            }

            .site-footer input::-webkit-input-placeholder {
               color: <?php echo $secondary_text_color; ?>;;
            }

            .site-footer input:-moz-placeholder { /* Firefox 18- */
               color: <?php echo $secondary_text_color; ?>;;  
            }

            .site-footer input::-moz-placeholder {  /* Firefox 19+ */
               color: <?php echo $secondary_text_color; ?>;;  
            }

            .site-footer input:-ms-input-placeholder {  
               color: <?php echo $secondary_text_color; ?>;;  
            }
    <?php 
    endif;

    $link_text_color = get_theme_mod( 'link_text_color', '#C58F69' ); 
    if ( $link_text_color != '#C58F69' ) :
    ?>
            .entry-content a,
            .textwidget a,
            .landing-section p a {  
               color: <?php echo $link_text_color; ?>;;  
            }
    <?php 
    endif;

    $primary_font_family = get_theme_mod( 'primary_font_family', '' ); 
    if ( $primary_font_family != '' ) :
    ?>
                h1, 
                h2, 
                h5,
                .stnsvn-rp-container #jp-relatedposts h3.jp-relatedposts-headline,
                .stnsvn-rp-container #jp-relatedposts .jp-relatedposts-items-visual h4.jp-relatedposts-post-title {
                font-family: <?php echo $primary_font_family; ?>;
            }
    <?php
    endif;

    $primary_font_size = get_theme_mod( 'primary_font_size', '150' ); 
    $font_divisor = '100';
    if ( $primary_font_size != '150' ) :
    ?>
                h1, h2 {
                font-size: <?php echo ($primary_font_size / $font_divisor); ?>em;
                }

                .stnsvn-rp-container #jp-relatedposts h3.jp-relatedposts-headline,
                #reply-title {
                font-size: <?php echo ($primary_font_size / $font_divisor * '0.867'); ?>em;
                }
 
                h5,
                .stnsvn-rp-container #jp-relatedposts .jp-relatedposts-items-visual h4.jp-relatedposts-post-title {
                font-size: <?php echo ($primary_font_size / $font_divisor * '0.733'); ?>em;
                }

                .stnsvn_popular_posts h5 {
                    font-size: 0.95em;
                }

    <?php
    endif;

    $secondary_font_family = get_theme_mod( 'secondary_font_family', '' ); 
    if ( $secondary_font_family != '' ) :
    ?>
                .site-title,
                .site-description,
                h3,
                h4,
                h6,
                .site-description,
                .upper-nav-container, 
                #primary-menu,
                #footer-menu,
                #main #infinite-handle span button, 
                button, 
                .entry-meta,
                .nav-links,
                .woocommerce #respond input#submit, 
                .woocommerce a.button, 
                .woocommerce button.button, 
                .woocommerce input.button,
                .comment-author,
                a.comment-reply-link,
                .stnsvn-rp-container #jp-relatedposts .jp-relatedposts-items p, 
                .entry-footer,
                .share-button,
                .cat-item a,
                input[type="button"], 
                input[type="reset"], 
                input[type="submit"] {
                    font-family: <?php echo $secondary_font_family; ?>;
                }
    <?php
    endif;

    $secondary_font_size = get_theme_mod( 'secondary_font_size', '70' ); 
    $font_divisor = '100';
    if ( $secondary_font_size != '70' ) :
    ?>
                .site-title {
                    font-size: <?php echo ($secondary_font_size / $font_divisor * '3.142'); ?>em;
                }

                h3 {
                    font-size: <?php echo ($secondary_font_size / $font_divisor * '1.143'); ?>em;
                }

                h4,
                .site-description,
                .upper-nav-container, 
                #primary-menu,
                #footer-menu,
                #main #infinite-handle span button, 
                button, 
                .entry-meta,
                .nav-links,
                .woocommerce #respond input#submit, 
                .woocommerce a.button, 
                .woocommerce button.button, 
                .woocommerce input.button,
                .comment-author,
                a.comment-reply-link,
                .stnsvn-rp-container #jp-relatedposts .jp-relatedposts-items p, 
                .entry-footer,
                .share-button,
                .cat-item a,
                input[type="button"], 
                input[type="reset"], 
                input[type="submit"] {
                    font-size: <?php echo ($secondary_font_size / $font_divisor); ?>em;
                }

                h6 {
                    font-size: <?php echo ($secondary_font_size / $font_divisor * '0.857'); ?>em;
                }
                

    <?php
    endif;

    $body_font_family = get_theme_mod( 'body_font_family', '' ); 
    if ( $body_font_family != '' ) :
    ?>
                body, 
                p,
                button,
                input,
                select,
                textarea,
                input[type="text"], 
                input[type="email"], 
                input[type="url"], 
                input[type="password"], 
                input[type="search"] {
                    font-family: <?php echo $body_font_family; ?>;
                }
    <?php
    endif;

    $body_font_size = get_theme_mod( 'body_font_size', '85' ); 
    $font_divisor = '100';
    if ( $body_font_size != '85' ) :
    ?>
                p,
                button,
                input,
                select,
                textarea,
                ol,
                ul,
                .widget ul {
                font-size: <?php echo ($body_font_size / $font_divisor); ?>em;
                }
    <?php
    endif;

    $stnsvn_prefooter_accent = get_theme_mod( 'stnsvn_prefooter_accent', 0 ); 
    if ( $stnsvn_prefooter_accent == 0 ) :
    ?>
                #prefooter-news {
                    background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAPElEQVQoU43MSQoAMAgEwczP83ODgiGLo/a5aIxGIjJROUNADh3pjB5PROGLQhihDzJ0wQxtWCGDHaRwAURyJ4jdhLp6AAAAAElFTkSuQmCC) repeat;
                }
    <?php
    endif;

    $stnsvn_prefooter_upload = get_theme_mod( 'stnsvn_prefooter_upload', '' ); 
    if ( $stnsvn_prefooter_upload != '' ) :
    ?>
                #prefooter-news {
                background-image: url('<?php echo ($stnsvn_prefooter_upload); ?>');
                background-size: cover;
                background-position: 50%;
                }
    <?php
    endif;

    $nav_search_form = get_theme_mod( 'nav_search_form', 1 ); 
    $stnsvn_cart_display = get_theme_mod( 'stnsvn_cart_display', 1 ); 
    if ( $nav_search_form == 1 && $stnsvn_cart_display == 1 ) :
    ?>
                .upper-nav-container .search-form {
                    margin-right: 25px;
                }
    <?php
    endif;

    $accent_color = get_theme_mod( 'accent_color', '#c58f69' ); 
    if ( $accent_color != '#c58f69' ) :
    ?>
                .paloma-accent path,
                .stnsvn-btt path,
                .menu-scroll-down path {
                    stroke: <?php echo $accent_color;?>;
                }

                .primary-nav li:hover > a,
                .primary-nav li.focus > a {
                    border-color: <?php echo $accent_color;?>;
                }


                .stnsvn-social-icons a:hover,
                .stnsvn-social-icons a:focus,
                .cart-icon .cart-contents:hover,
                .cart-icon .cart-contents:focus {
                    color: <?php echo $accent_color;?>;
                }


                .cart-icon .cart-contents:hover path,
                .cart-icon .cart-contents:focus path,
                .custom-header-active .stick.nav-transparent .cart-icon .cart-contents:hover path,
                .custom-header-active .stick.nav-transparent .cart-icon .cart-contents:focus path {
                    fill: <?php echo $accent_color;?>;
                }
    <?php
    endif;

    echo '</style>';

    // Get typography options, add to wp_head
    $ggl_link = get_theme_mod( 'google_font_code' ); 
    if ( $ggl_link != '' ) :
        echo '<link href="' , $ggl_link , '" rel="stylesheet" type="text/css">';
    endif;

}
add_action( 'wp_head', 'paloma_customizer_head_styles' );

//Add WooCommerce CSS styles to WP_head
function paloma_customizer_WC_head_styles() {
    if (class_exists( 'WooCommerce' ) && (is_woocommerce() || is_checkout() || is_cart())){
        echo '<style type="text/css">';

        $secondary_background_color = get_theme_mod( 'secondary_background_color', '#ffffff' ); 
        if ( $secondary_background_color != '#ffffff' ) :
        ?>
                .woocommerce nav.woocommerce-pagination ul li a:focus, 
                .woocommerce nav.woocommerce-pagination ul li a:hover, 
                .woocommerce nav.woocommerce-pagination ul li span.current,
                .woocommerce-error, 
                .woocommerce-info, 
                .woocommerce-message,
                .woocommerce #reviews #comments ol.commentlist li .comment-text,
                .woocommerce div.product .woocommerce-tabs ul.tabs li.active,
                .woocommerce div.product div.images .woocommerce-product-gallery__trigger,
                .select2-container--default .select2-selection--single {
                    background-color: <?php echo $secondary_background_color; ?>;
                }
        <?php
        endif;

        $button_color = get_theme_mod( 'button_color', '#34483d' ); 
        if ( $button_color != '#34483d' ) :
        ?>
                .woocommerce #respond input#submit, 
                .woocommerce a.button, 
                .woocommerce button.button, 
                .woocommerce input.button,
                .woocommerce #respond input#submit.alt, 
                .woocommerce a.button.alt, 
                .woocommerce button.button.alt, 
                .woocommerce input.button.alt {
                    background-color: <?php echo $button_color; ?>;
                }
        <?php
        endif;

        $button_hover_color = get_theme_mod( 'button_hover_color', '#fff4ec' ); 
        if ( $button_hover_color != '#fff4ec' ) :
        ?>
                .woocommerce #respond input#submit.alt:hover,
                .woocommerce #respond input#submit.alt:focus, 
                .woocommerce a.button.alt:hover, 
                .woocommerce a.button.alt:focus, 
                .woocommerce button.button.alt:hover, 
                .woocommerce button.button.alt:focus, 
                .woocommerce input.button.alt:hover,
                .woocommerce input.button.alt:focus,
                .woocommerce #respond input#submit:hover, 
                .woocommerce #respond input#submit:focus, 
                .woocommerce a.button:hover,
                .woocommerce a.button:focus, 
                .woocommerce button.button:hover,
                .woocommerce button.button:focus, 
                .woocommerce input.button:hover,
                .woocommerce input.button:focus,
                .woocommerce #respond input#submit.disabled:hover, 
                .woocommerce #respond input#submit:disabled:hover, 
                .woocommerce #respond input#submit:disabled[disabled]:hover, 
                .woocommerce a.button.disabled:hover, 
                .woocommerce a.button:disabled:hover, 
                .woocommerce a.button:disabled[disabled]:hover, 
                .woocommerce button.button.disabled:hover, 
                .woocommerce button.button:disabled:hover, 
                .woocommerce button.button:disabled[disabled]:hover, 
                .woocommerce input.button.disabled:hover, 
                .woocommerce input.button:disabled:hover, 
                .woocommerce input.button:disabled[disabled]:hover {
                    background-color: <?php echo $button_hover_color; ?>;
                }

        <?php
        endif;

        $divider_line_color = get_theme_mod( 'divider_line_color', '#dddddd' ); 
        if ( $divider_line_color != '#dddddd' ) :
        ?>
                .woocommerce div.product .woocommerce-tabs ul.tabs li,
                .woocommerce div.product .woocommerce-tabs ul.tabs:before,
                .woocommerce table td,
                .woocommerce table.shop_table td,
                .woocommerce table.shop_table tbody th, 
                .woocommerce table.shop_table tfoot td, 
                .woocommerce table.shop_table tfoot th,
                .woocommerce-cart .cart-collaterals .cart_totals tr td, 
                .woocommerce-cart .cart-collaterals .cart_totals tr th,
                .woocommerce-checkout #payment ul.payment_methods,
                .woocommerce table.shop_table_responsive tr, 
                .woocommerce-page table.shop_table_responsive tr {
                    border-color: <?php echo $divider_line_color; ?>;
                }
        <?php
        endif;    

        $primary_font_size = get_theme_mod( 'primary_font_size', '150' ); 
        $font_divisor = '100';
        if ( $primary_font_size != '150' ) :
        ?>
                    .woocommerce ul.products li.product .woocommerce-loop-category__title, 
                    .woocommerce ul.products li.product .woocommerce-loop-product__title {
                    font-size: <?php echo ($primary_font_size / $font_divisor  * '0.8'); ?>em;
                    }

        <?php
        endif;

        $secondary_font_family = get_theme_mod( 'secondary_font_family', '' ); 
        if ( $secondary_font_family != '' ) :
        ?>
                    .woocommerce #respond input#submit, 
                    .woocommerce a.button, 
                    .woocommerce button.button, 
                    .woocommerce input.button,
                    .woocommerce #respond input#submit,
                    .woocommerce div.product .woocommerce-tabs ul.tabs li a,
                    .woocommerce div.product p.price, 
                    .woocommerce div.product span.price,
                    .woocommerce-message:before,
                    .woocommerce .woocommerce-info:before,
                    .woocommerce ul.products li.product .price,
                    .woocommerce .woocommerce-error, 
                    .woocommerce .woocommerce-info, 
                    .woocommerce-message,
                    .woocommerce table.shop_table th,
                    .woocommerce th,
                    .woocommerce table strong,
                    .woocommerce form .form-row .required,
                    .woocommerce #content table.cart td.actions .input-text, 
                    .woocommerce table.cart td.actions .input-text, 
                    .woocommerce-page #content table.cart td.actions .input-text, 
                    .woocommerce-page table.cart td.actions .input-text,
                    .woocommerce form .form-row label,
                    .woocommerce #review_form #respond .form-submit input,
                    .woocommerce #reviews #comments ol.commentlist li .comment-text p.meta,
                    .woocommerce .order_details li {
                        font-family: <?php echo $secondary_font_family; ?>;
                    }
        <?php
        endif;

        $secondary_font_size = get_theme_mod( 'secondary_font_size', '70' ); 
        $font_divisor = '100';
        if ( $secondary_font_size != '70' ) :
        ?>
                    .woocommerce div.product .woocommerce-tabs ul.tabs li a,
                    .woocommerce div.product p.price, 
                    .woocommerce div.product span.price,
                    .woocommerce-message:before,
                    .woocommerce .woocommerce-info:before,
                    .woocommerce ul.products li.product .price,
                    .woocommerce .woocommerce-error, 
                    .woocommerce .woocommerce-info, 
                    .woocommerce-message,
                    .woocommerce table.shop_table th,
                    .woocommerce th,
                    .woocommerce table strong,
                    .woocommerce form .form-row .required,
                    .woocommerce #content table.cart td.actions .input-text, 
                    .woocommerce table.cart td.actions .input-text, 
                    .woocommerce-page #content table.cart td.actions .input-text, 
                    .woocommerce-page table.cart td.actions .input-text,
                    .woocommerce form .form-row label,
                    .woocommerce #review_form #respond .form-submit input,
                    .woocommerce #reviews #comments ol.commentlist li .comment-text p.meta,
                    .woocommerce .order_details li {
                        font-size: <?php echo ($secondary_font_size / $font_divisor * '1.143'); ?>em;
                    }

                    .woocommerce #respond input#submit, 
                    .woocommerce a.button, 
                    .woocommerce button.button, 
                    .woocommerce input.button,
                    .woocommerce #respond input#submit, 
                    .woocommerce a.button, 
                    .woocommerce button.button, 
                    .woocommerce input.button,
                    .woocommerce #respond input#submit.alt, 
                    .woocommerce a.button.alt, 
                    .woocommerce button.button.alt, 
                    .woocommerce input.button.alt,
                    .woocommerce #content table.cart td.actions .input-text, 
                    .woocommerce table.cart td.actions .input-text, 
                    .woocommerce-page #content table.cart td.actions .input-text, 
                    .woocommerce-page table.cart td.actions .input-text {
                        font-size: <?php echo ($secondary_font_size / $font_divisor); ?>em;
                    }
        <?php
        endif;

        echo '</style>';
    }//End WC conditional
}
add_action( 'wp_head', 'paloma_customizer_WC_head_styles' );
//End WooCommerce CSS styles

//Enable or Disable nav stickiness
add_action('wp_footer','paloma_sticky_nav');
function paloma_sticky_nav() {
    if ( has_nav_menu( 'primary' ) ) {
        $paloma_activate_sticky_menu = get_theme_mod( 'sticky_primary_menu', '1' );
            wp_localize_script( 'main', 'palomaNavParams', array('sticky' => $paloma_activate_sticky_menu) );
      } else {
            wp_localize_script( 'main', 'palomaNavParams', array('sticky' => '0') );
      }
}



