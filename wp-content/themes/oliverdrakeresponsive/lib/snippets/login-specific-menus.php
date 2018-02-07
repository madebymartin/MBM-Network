<?php
//Different menus for logged-in users
//This example would cause a menu to show for logged-in users and a different menu for users not logged-in.

if ( is_user_logged_in() ) {
     wp_nav_menu( array( 'theme_location' => 'logged-in-menu' ) );
} else {
     wp_nav_menu( array( 'theme_location' => 'logged-out-menu' ) );
}
?>