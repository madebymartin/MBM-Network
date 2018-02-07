<?php
function page_specific_css() {
if (is_front_page()) {?>
    <link rel="stylesheet" type="text/css" href="<?php echo 
bloginfo('stylesheet_directory') ?>/lib/css/homepage.css" /> <?php }
}

//now we can add our new action to the appropriate place like so:
add_action('wp_head', 'page_specific_css');
?>