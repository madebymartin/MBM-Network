<?php
// adds custom header section in Admin, good for static images in header, needs default
// http://make.wordpress.org/themes/2012/04/06/updating-custom-backgrounds-and-custom-headers-for-wordpress-3-4/
$headerargs = array(
    'flex-width'     => true,
    'width'          => 960,
    'flex-height'    => true,
    'height'         => 150,
    'default-image'  => get_stylesheet_directory_uri() . '/images/header.png',
);
add_theme_support( 'custom-header', $headerargs );


function childtheme_add_header_image() { ?> 
    <img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" /> 
<?php }
add_action('thematic_header', 'childtheme_add_header_image', 6);

// adds custom background section in the Admin, good for super easy options
$backgroundargs = array( 
    'default-image'          => '',
    'default-color'          => '',
    'wp-head-callback'       => '_custom_background_cb',
    'admin-head-callback'    => '',
    'admin-preview-callback' => ''
);
add_theme_support( 'custom-background', array(
    // bgcolor default
    'default-color' => '000',
    // image default
    'default-image' => get_stylesheet_directory_uri() . '/images/background.jpg'
) );
?>