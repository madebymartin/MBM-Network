<?php

//include the main class file
require_once("Tax-meta-class/Tax-meta-class.php");
if (is_admin()){
  /* 
   * prefix of meta keys, optional
   */
  $prefix = 'ba_';
  /* 
   * configure your meta box
   */
  $config = array(
    'id' => 'faq',          // meta box id, unique per meta box
    'title' => 'FAQ Page',          // meta box title
    'pages' => array('treatment_category', 'concern'),        // taxonomy name, accept categories, post_tag and custom taxonomies
    'context' => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'fields' => array(),            // list of meta fields (can be added by field arrays)
    'local_images' => true,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
   * Initiate your meta box
   */
  $my_meta =  new Tax_Meta_Class($config);
  
  /*
   * Add fields to your meta box
   */
  //posts field
  $my_meta->addPosts($prefix.'posts_field_id',array('args' => array('post_type' => 'treatment_info')),array('name'=> 'FAQ Page'));

  //checkbox field
  $my_meta->addCheckbox($prefix.'checkbox_remove_link',array('name'=> 'Add MORE INFO button?'));


   /*
   * Don't Forget to Close up the meta box decleration
   */
  //Finish Meta Box Decleration
  $my_meta->Finish();
}
?>