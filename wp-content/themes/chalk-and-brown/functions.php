<?php
// Theme support options
require_once(get_template_directory().'/assets/functions/theme-support.php'); 

// WP Head and other cleanup functions
require_once(get_template_directory().'/assets/functions/cleanup.php'); 

// Register scripts and stylesheets
require_once(get_template_directory().'/assets/functions/enqueue-scripts.php'); 

// Register custom menus and menu walkers
require_once(get_template_directory().'/assets/functions/menu.php'); 

// Register sidebars/widget areas
require_once(get_template_directory().'/assets/functions/sidebar.php'); 

// Makes WordPress comments suck less
require_once(get_template_directory().'/assets/functions/comments.php'); 

// Replace 'older/newer' post links with numbered navigation
require_once(get_template_directory().'/assets/functions/page-navi.php'); 

// Adds support for multiple languages
require_once(get_template_directory().'/assets/translation/translation.php'); 




// Remove 4.2 Emoji Support
// require_once(get_template_directory().'/assets/functions/disable-emoji.php'); 

// Adds site styles to the WordPress editor
//require_once(get_template_directory().'/assets/functions/editor-styles.php'); 

// Related post function - no need to rely on plugins
// require_once(get_template_directory().'/assets/functions/related-posts.php'); 

// Use this as a template for custom post types
require_once(get_template_directory().'/assets/functions/custom-post-type.php');

// Customize the WordPress login menu
require_once(get_template_directory().'/assets/functions/login.php'); 

// Customize the WordPress admin
require_once(get_template_directory().'/assets/functions/admin.php'); 




// Register custom meta - requires Meta Plugin
// require_once(get_template_directory().'/assets/cmb2/init.php');
require_once(get_template_directory().'/assets/functions/meta.php'); 

// require_once(get_template_directory().'/assets/cmb2-taxonomy/init.php');
require_once(get_template_directory().'/assets/functions/meta-taxonomy.php'); 




add_action( 'after_setup_theme', 'mbm_flexslider_image_size' );
function mbm_flexslider_image_size() {
    add_image_size( 'banner', 1000, 415, true ); // (cropped)
}

add_filter( 'image_size_names_choose', 'mbm_flexslider_image_sizes_into_admin' );
function mbm_flexslider_image_sizes_into_admin( $sizes ) {
    return array_merge( $sizes, array(
        'banner' => __( 'Banner' ),
    ) );
}



/**
 * Sample template tag function for outputting a cmb2 file_list
 *
 * @param  string  $file_list_meta_key The field meta key. ('wiki_test_file_list')
 * @param  string  $img_size           Size of image to show
 */
function mbm_flex_slider( ) {

    if(is_page() && get_post_meta(get_the_ID(), 'mbm_slides')){

        if(is_front_page()){
            $heading = get_bloginfo('description');
        }
        else{
            $heading = get_the_title(get_the_ID());
        }

        echo '<div class="sliderwrapper"><div class="frame"><h1>'. $heading .'</h1></div>';

        $slides = get_post_meta(get_the_ID(), 'mbm_slides', true);
        if(count($slides) ==1 ){
            reset($slides);
            $img_id = key($slides);
            echo wp_get_attachment_image( $img_id, 'banner', '', array( 'class' => 'full-width' ) );
        }
        else{
            echo '<section class="slider"><div class="flexslider"><ul class="slides">';

            foreach ( $slides as $attachment_id => $url ) {
                echo '<li>';
                echo wp_get_attachment_image( $attachment_id, 'banner' );
                echo '</li>';
            }
            echo '</ul></div></section>';
            ?>
            <script type="text/javascript">
            jQuery(window).load(function(){
              jQuery(".flexslider").flexslider({
                slideshow: true,
                animation: "fade",
                easing: "swing",
                controlNav: "false",
                directionNav: "false",
                animationSpeed: 500,
                slideshowSpeed: 2500,
                start: function(slider){
                  jQuery("body").removeClass("loading");
                }
              });
            });
            </script>
            <?php
        }

        echo '</div>';
        
    }
    elseif(is_tax('services')){
        $q = get_queried_object();
        $term_id = $q->term_id;

        if( get_term_meta($term_id, 'mbm_slides') ){
            $slides = get_term_meta($term_id, 'mbm_slides', true);
            $heading = $q->name;
            echo '<div class="sliderwrapper"><div class="frame"><h1>'. $heading .'</h1></div>';

            if(count($slides) ==1 ){
                reset($slides);
                $img_id = key($slides);
                echo wp_get_attachment_image( $img_id, 'banner', '', array( 'class' => 'full-width' ) );
            }
            else{
                echo '<section class="slider"><div class="flexslider"><ul class="slides">';

                foreach ( $slides as $attachment_id => $url ) {
                    echo '<li>';
                    echo wp_get_attachment_image( $attachment_id, 'banner' );
                    echo '</li>';
                }
                echo '</ul></div></section>';
                ?>
                <script type="text/javascript">
                    jQuery(window).load(function(){
                      jQuery(".flexslider").flexslider({
                        slideshow: true,
                        animation: "fade",
                        easing: "swing",
                        controlNav: "false",
                        directionNav: "false",
                        animationSpeed: 500,
                        slideshowSpeed: 2500,
                        start: function(slider){
                          jQuery("body").removeClass("loading");
                        }
                      });
                    });
                  </script>

              <?php
            }

            echo '</div>';
        }
        
    }
}



function replace_uploaded_image($image_data) {
    // if there is no large image : return
    if (!isset($image_data['sizes']['large'])) return $image_data;

    // paths to the uploaded image and the large image
    $upload_dir = wp_upload_dir();
    $uploaded_image_location = $upload_dir['basedir'] . '/' .$image_data['file'];
    // $large_image_location = $upload_dir['path'] . '/'.$image_data['sizes']['large']['file']; // ** This only works for new image uploads - fixed for older images below.
    $current_subdir = substr($image_data['file'],0,strrpos($image_data['file'],"/"));
    $large_image_location = $upload_dir['basedir'] . '/'.$current_subdir.'/'.$image_data['sizes']['large']['file'];

    // delete the uploaded image
    unlink($uploaded_image_location);

    // rename the large image
    rename($large_image_location,$uploaded_image_location);

    // update image metadata and return them
    $image_data['width'] = $image_data['sizes']['large']['width'];
    $image_data['height'] = $image_data['sizes']['large']['height'];
    unset($image_data['sizes']['large']);

    return $image_data;
}

add_filter('wp_generate_attachment_metadata','replace_uploaded_image');