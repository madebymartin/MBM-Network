<?php
/* REMOVE ADMIN MENU ITEMS */
function remove_menu_items() {

/* ADMINISTRATOR CONTENT */
if ( current_user_can('administrator') ) { 
?>
<!-- ADMIN ONLY CONTENT -->
<?php } 

else{ ?>
<?php
  global $menu;
  $restricted = array(__('Posts'), __('Links'), __('Comments'), __('Media'), __('Plugins'), __('Tools'), __('Users'));
  end ($menu);
  while (prev($menu)){
    $value = explode(' ',$menu[key($menu)][0]);
    if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){
      unset($menu[key($menu)]);}
    }
?>
<?php }


  }
add_action('admin_menu', 'remove_menu_items');



/* CUSTOM ADMIN FOOTER */
function modify_footer_admin () {
  echo 'Created by <a href="http://totallydesignandprint.com" target="blank">Totally UK</a> 2012.';
}

add_filter('admin_footer_text', 'modify_footer_admin');





function adminheader() {
/* HEADER CONTENT */
?>

<?php }

add_action( 'admin_head', 'adminheader' ); 

?>