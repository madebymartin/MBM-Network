<?php 
function remove_thematic_panel() {
  remove_action('admin_menu' , 'thematic_opt_add_page');
}
add_action('init', 'remove_thematic_panel');
?>