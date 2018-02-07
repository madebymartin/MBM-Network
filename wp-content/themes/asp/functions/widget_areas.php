<?php
// add a header aside widget, currently set up to be inside the #branding div
function childtheme_add_header_widget($content) {
    $content['Header Aside Widget'] = array(
        'admin_menu_order' => 2,
        'args' => array (
        'name' => 'Header Aside',
        'id' => 'header-aside-widget',
        'description' => __('The widget area in the header.', 'thematic'),
        'before_widget' => thematic_before_widget(),
        'after_widget' => thematic_after_widget(),
        'before_title' => thematic_before_title(),
        'after_title' => thematic_after_title(),
            ),
        'action_hook'   => 'thematic_header',
        'function'      => 'childtheme_header_aside_widget',
        'priority'      => 6
        );
    return $content;
}
add_filter('thematic_widgetized_areas', 'childtheme_add_header_widget');

// set structure for the header aside widget
function childtheme_header_aside_widget() {
    if ( is_active_sidebar('header-aside-widget') ) {
        echo thematic_before_widget_area('header-widget');
        dynamic_sidebar('header-aside-widget');
        echo thematic_after_widget_area('header-widget');
    }
}


// add a shop widget, shows in the sidr mobile menu aside
function childtheme_add_shop_widget($content) {
    $content['Shop Aside Widget'] = array(
        'admin_menu_order' => 3,
        'args' => array (
        'name' => 'Shop Aside',
        'id' => 'shop-aside-widget',
        'description' => __('Showss in the mobile Sidr menu for the shop.', 'thematic'),
        'before_widget' => thematic_before_widget(),
        'after_widget' => thematic_after_widget(),
        'before_title' => thematic_before_title(),
        'after_title' => thematic_after_title(),
            ),
    //    'action_hook'   => 'thematic_after',
        'function'      => 'childtheme_shop_aside_widget',
        'priority'      => 6
        );
    return $content;
}
add_filter('thematic_widgetized_areas', 'childtheme_add_shop_widget');

// set structure for the shop aside widget
function childtheme_shop_aside_widget() {
    if ( is_active_sidebar('shop-aside-widget') ) {
        echo thematic_before_widget_area('shop-widget');
        dynamic_sidebar('shop-aside-widget');
        echo thematic_after_widget_area('shop-widget');
    }
}


// add a shop footer widget for delivery info etc
function childtheme_add_shop_footer_widget($content) {
    $content['Shop Footer Widget'] = array(
        'admin_menu_order' => 4,
        'args' => array (
        'name' => 'Shop Footer',
        'id' => 'shop-footer-widget',
        'description' => __('Shows above the global footer on any shop related pages.', 'thematic'),
        'before_widget' => '<aside class="shop-footer-widget">',
        'after_widget' => '</aside>',
        'before_title' => thematic_before_title(),
        'after_title' => thematic_after_title(),
            ),
    //    'action_hook'   => 'thematic_after',
        'function'      => 'childtheme_shop_footer_aside_widget',
        'priority'      => 6
        );
    return $content;
}
add_filter('thematic_widgetized_areas', 'childtheme_add_shop_footer_widget');

// set structure for the shop aside widget
function childtheme_shop_footer_aside_widget() {
    if ( is_active_sidebar('shop-footer-widget') ) {
        echo '<section class="content-section">';
        dynamic_sidebar('shop-footer-widget');
        echo '</section>';
    }
}









// add 4th subsidiary aside widget, currently set up to be a footer widget (#footer-widget) underneath the 3 subs
function childtheme_add_subsidiary($content) {
    $content['Footer Widget Aside'] = array(
        'admin_menu_order' => 550,
        'args' => array (
        'name' => 'Footer Aside',
        'id' => '4th-subsidiary-aside',
        'description' => __('The 4th bottom widget area in the footer.', 'thematic'),
        'before_widget' => thematic_before_widget(),
        'after_widget' => thematic_after_widget(),
        'before_title' => thematic_before_title(),
        'after_title' => thematic_after_title(),
            ),
        'action_hook'   => 'widget_area_subsidiaries',
        'function'      => 'childtheme_4th_subsidiary_aside',
        'priority'      => 90
        );
    return $content;
}
add_filter('thematic_widgetized_areas', 'childtheme_add_subsidiary');

// set structure for the 4th subsidiary aside, footer widget (#footer-widget)
// this is modified from the original by adding the .sub-wrapper, super hacky!
function childtheme_4th_subsidiary_aside() {
    if ( is_active_sidebar('4th-subsidiary-aside') ) {
        echo thematic_before_widget_area('footer-widget');
        dynamic_sidebar('4th-subsidiary-aside');
        echo thematic_after_widget_area('footer-widget');
    }
    echo "\n" . '</div><!-- .sub-wrapper -->' . "\n";
}

// open the sub-wrapper, super hacky!
function childtheme_subsidiary_wrapper_div () { ?>
    <div class="sub-wrapper">
<?php }
add_action('thematic_footer', 'childtheme_subsidiary_wrapper_div');

// hide unused widget areas inside the WordPress admin
function childtheme_hide_areas($content) {
    unset($content['Index Top']);
    unset($content['Index Insert']);
    unset($content['Index Bottom']);
    unset($content['Single Top']);
    unset($content['Single Insert']);
    unset($content['Single Bottom']);
    unset($content['Page Top']);
    unset($content['Page Bottom']);
    return $content;
}
add_filter('thematic_widgetized_areas', 'childtheme_hide_areas');
?>