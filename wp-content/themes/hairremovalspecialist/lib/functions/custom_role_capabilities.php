<?php

function add_theme_caps() {
    $role = get_role( 'editor' );
    $role->remove_cap( 'manage_options' ); 
	$role->add_cap( 'edit_theme_options' );
}
add_action( 'admin_init', 'add_theme_caps');








  //  Using jQuery: How to allow Editors to edit only Menus (or more!)  [by Chris Lemke aka PrettySickPuppy|gmail]

function role_specific_restricted_admin_menus() {


  if ( is_user_logged_in() ) { // This IF may be redundant, but safe is better than sorry...
    if ( current_user_can('edit_theme_options') && !current_user_can('manage_options') ) { // Check if non-Admin
?>
      <script>
	jQuery.noConflict();
	jQuery(document).ready(function() {
	  //  Comment out the line you WANT to enable, so it displays (is NOT removed).
	  //  For example, the jQuery line for MENUS is commented out below so it's not removed.

	  // THEMES:  If you want to allow THEMES, also comment out APPEARANCE if you want it to display Themes when clicked. (Default behaviour)
	  jQuery('li#menu-appearance.wp-has-submenu li a[href="themes.php"]').remove();
	  jQuery('li#menu-appearance.wp-has-submenu a.wp-has-submenu').removeAttr("href");

	  // Theme Options:
	  jQuery('li#menu-appearance.wp-has-submenu li a[href="themes.php?page=thematic_opt"]').remove();

	// Customise:
	  jQuery('li#menu-appearance.wp-has-submenu li a[href="customize.php"]').remove();




		// WIDGETS:
	  //jQuery('li#menu-appearance.wp-has-submenu li a[href="widgets.php"]').remove();

	  // MENUS:
	  // jQuery('li#menu-appearance.wp-has-submenu li a[href="nav-menus.php"]').remove();

	  // BACKGROUND:
	  jQuery('li#menu-appearance.wp-has-submenu li a[href="themes.php?page=custom-background"]').remove();
	});
      </script>
<?php
    } // End IF current_user_can...
  } // End IF is_user_logged_in...
?>


<?php
  //  Using jQuery: How to allow Editors to edit only Menus (or more!)
  //  Placed in THEME's footer.php as the Admin Bar is added when a user is logged in

  if ( is_user_logged_in() ) { // This IF may be redundant, but safe is better than sorry...
    if ( current_user_can('edit_theme_options') && !current_user_can('manage_options') ) { // Check if non-Admin
?>
      <script>
    jQuery.noConflict();
    jQuery(document).ready(function() {
      //  Comment out the line you WANT to enable, so it displays (is NOT removed).
      //  For example, the jQuery line for MENUS is commented out below so it's not removed.

      // THEMES:
      jQuery('li#wp-admin-bar-themes').remove();

      // CUSTOMIZE:
      jQuery('li#wp-admin-bar-customize').remove();

      // WIDGETS:
      jQuery('li#wp-admin-bar-widgets').remove();

      // MENUS:
      // jQuery('li#wp-admin-bar-menus').remove();

      // BACKGROUND:
      jQuery('li#wp-admin-bar-background').remove();
    });
      </script>
<?php
    } // End IF current_user_can...
  } // End IF is_user_logged_in...


}

add_action('in_admin_footer', 'role_specific_restricted_admin_menus');
?>