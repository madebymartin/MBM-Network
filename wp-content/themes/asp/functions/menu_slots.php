<?php
// register additional custom menu slots
function childtheme_register_menus() {
    if ( function_exists( 'register_nav_menu' )) {
        register_nav_menu( 'mobile-nav', 'Mobile Navigation' );
        register_nav_menu( 'mobile_menu_pro', 'Mobile Menu: Pro' );
        register_nav_menu( 'mobile_menu_shop', 'Mobile Menu: Shop' );
        register_nav_menu( 'mobile_menu_more', 'Mobile Menu: More' );
        register_nav_menu( 'region_select', 'Region Select' );
    }
}
add_action('thematic_child_init', 'childtheme_register_menus');
?>