<?php // HIDE ADMIN BAR FROM USER PROFILE PAGE
function hideAdminBar() { ?>
<style type="text/css">.show-admin-bar { display: none; }</style>
<?php }
add_action('admin_print_scripts-profile.php', 'hideAdminBar');

if( !is_admin()){
   wp_deregister_script('jquery');
   wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"), false, '1.3.2');
   wp_enqueue_script('jquery');
}
?>