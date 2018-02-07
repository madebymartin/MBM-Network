<?php
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


// SHOP SIDEBAR
if ( function_exists('register_sidebar') )
include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
if (is_plugin_active('woocommerce/woocommerce.php')) { 
  
    register_sidebar( array(
   'name' => __( 'Shop Aside'),
   'id' => 'shop_aside',
   'description' => __( 'Sidebar for shop-related pages', 'gdc2014' ),
   'before_widget' => '<div class="aside">',
   'after_widget' => "</div>",
   'before_title' => '<h3 class="widgettitle">',
   'after_title' => '</h3>',
   ) );
   
}
else {}

// SPA FINDER SIDEBAR
if ( function_exists('register_sidebar') )
include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
if (is_plugin_active('simplemap/simplemap.php')) { 
  
    register_sidebar( array(
   'name' => __( 'Spa Finder Aside'),
   'id' => 'spa_finder_sidebar',
   'description' => __( 'Sidebar to contain search box for Spa Finder', 'gdc_childsplay' ),
   'before_widget' => '<div class="aside spafinder">',
   'after_widget' => "</div>",
   'before_title' => '<h3 class="widget-title">',
   'after_title' => '</h3>',
   ) );
   
}
else {}


?>