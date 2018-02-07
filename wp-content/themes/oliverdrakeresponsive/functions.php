<?php
// ADD HEADER META
/*function child_meta_keywords($description) {
$keywords_meta = "\t" . '<meta name="keywords" content="Your keywords go here!" />' . "\n\n";
$description_meta = "\t" . '<meta name="description" content="Decription goes in here!" />' . "\n\n";
$child_meta = $description . $keywords_meta . $description_meta;
return $child_meta;
return $description;
}
add_filter ('thematic_create_description','child_meta_keywords');*/


/* Include library functions */
require_once ('lib/functions/00childsplayfunctions00.php');
require_once ('lib/functions/00mbmfunctions00.php');
require_once ('lib/functions/theme_activation.php');
require_once ('lib/tgm-plugin-activation/class-tgm-plugin-activation.php');
require_once ('lib/tgm-plugin-activation/plugin_activation.php');
require_once ('lib/functions/html5doctype.php');
require_once ('lib/functions/custom_siteinfo.php');
require_once ('lib/functions/insert_into_head.php');
require_once ('lib/functions/insert_content.php');
include ('lib/functions/custom-user-meta.php');
require_once ('lib/functions/quotations.php');
// require_once ('lib/functions/custom_login.php');
require_once ('lib/functions/custom_post_types.php');
require_once ('lib/functions/add_thumbnails.php');



//CUSTOM TAXONOMY META 
require_once ('lib/bainternet-Tax-Meta-Class/tax-meta-class.php');



/*require_once ('lib/Custom-Meta-Boxes-master/custom-meta-boxes.php');
require_once ('lib/Custom-Meta-Boxes-master/meta.php');
*/



//CUSTOM POST META
add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
function cmb_sample_metaboxes( array $meta_boxes ) {
// Start with an underscore to hide fields from custom fields list

$prefix = '_cmb_';

require_once ('lib/functions/custom-meta.php');
return $meta_boxes;
}
add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );


//Initialize the metabox class.
function cmb_initialize_cmb_meta_boxes() {
    if ( ! class_exists( 'cmb_Meta_Box' ) )
        require_once 'lib/metaboxes/init.php';
}








function childtheme_override_blogtitle() {
?>
<div id="logo">
        <a href="<?php echo home_url() ?>/" title="<?php bloginfo('name') ?>" rel="home">
            <img src="<?php bloginfo('stylesheet_directory') ?>/images/odpah_logo.png" alt="<?php bloginfo('name') ?>" />
        </a>
</div>
<?php
}










if (class_exists('MultiPostThumbnails')) {


    new MultiPostThumbnails(
        array(
            'label' => 'Image 2',
            'id' => 'mbm_image2',
            'post_type' => 'project'
        )
    );
    new MultiPostThumbnails(
        array(
            'label' => 'Image3',
            'id' => 'mbm_image3',
            'post_type' => 'project'
        )
    );
    new MultiPostThumbnails(
        array(
            'label' => 'Image 4',
            'id' => 'mbm_image4',
            'post_type' => 'project'
        )
    );
    new MultiPostThumbnails(
        array(
            'label' => 'Image 5',
            'id' => 'mbm_image5',
            'post_type' => 'project'
        )
    );
    new MultiPostThumbnails(
        array(
            'label' => 'Image 6',
            'id' => 'mbm_image6',
            'post_type' => 'project'
        )
    );
    new MultiPostThumbnails(
        array(
            'label' => 'Image 7',
            'id' => 'mbm_image7',
            'post_type' => 'project'
        )
    );
    new MultiPostThumbnails(
        array(
            'label' => 'Image 8',
            'id' => 'mbm_image8',
            'post_type' => 'project'
        )
    );

}









add_action( 'wp_enqueue_scripts', 'stylesheets', 99 );
function stylesheets(){
//wp_dequeue_style('jqueryui_styles');
//wp_dequeue_style('jigoshop_fancybox_styles');
if(!current_user_can('switch_themes')){ wp_enqueue_script( 'odph-ga', get_stylesheet_directory_uri() . '/js/google_analytics.js', array(), '2016-12-01', true ); }
wp_enqueue_style( 'googlefonts', 'http://fonts.googleapis.com/css?family=Quattrocento+Sans:400,400italic,700|Open+Sans+Condensed:300' );

}




/**
 * WordPress register with email only, make it possible to register with email 
 * as username in a multisite installation
 * @param  Array $result Result array of the wpmu_validate_user_signup-function
 * @return Array         Altered result array
 */
function custom_register_with_email($result) {
 
   if ( $result['user_name'] != '' && is_email( $result['user_name'] ) ) {
 
      unset( $result['errors']->errors['user_name'] );
 
   }
 
   return $result;
}
add_filter('wpmu_validate_user_signup','custom_register_with_email');
 




?>