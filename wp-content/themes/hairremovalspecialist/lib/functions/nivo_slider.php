<?php
// nivo gallery example, no longer load scripts this way, needs an update, prefer to enqueue, then register (do both although this way totally works fine).
// script manager template for deregestering and registering files.
function childtheme_nivo_script_manager() {
    // wp_enqueue_script template ( $handle, $src, $deps, $ver, $in_footer );

        if ( is_home() || is_front_page() ) {

        wp_enqueue_script('nivo-gallery', get_stylesheet_directory_uri() . '/nivo/jquery.nivo.gallery.min.js', array('jquery'), true);
        wp_enqueue_style('nivo-gallery-style', get_bloginfo('stylesheet_directory') . '/nivo/nivo-gallery.css');
        }
}
add_action('wp_enqueue_scripts', 'childtheme_nivo_script_manager');


// nivo gallery options on home/frontpage - http://nivogallery.dev7studios.com/documentation/options/
function childtheme_nivo_gallery_options(){
    if ( is_home() || is_front_page() ) { ?>
        <script type="text/javascript">
            jQuery('#gallery').nivoGallery({
                pauseTime: 3000,
                animSpeed: 300,
                effect: 'fade',
                startPaused: false,
                directionNav: true,
                progressBar: false
            });
            // pause on hover (stops slides completely)
            // jQuery('#gallery').hover(function(){
            // jQuery(this).data('nivoGallery').pause();
            // });
        </script>
    <?php }
}
add_action('wp_footer', 'childtheme_nivo_gallery_options');

// niva gallery running off static content inserted into header, not super flexible, but works
function childtheme_nivo_gallery() {
    if ( is_home() || is_front_page() ) { ?>
        <div id="gallery" class="nivoGallery">
            <ul>
                <li data-type="html" data-title="Lorem ipsum 5" data-caption="dolor sit amet, consectetur adipiscing elit">
                    <h1>Nesting Test</h1>
                    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
                </li>
                <li data-type="video" data-title="Vimeo Video">
                    <iframe src="http://player.vimeo.com/video/29950141?portrait=0&amp;color=ffffff" width="670" height="377" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>
                </li>
                <li data-type="video" data-title="YouTube Video">
                    <iframe width="560" height="315" src="http://www.youtube.com/embed/72hTSFkYVAo?wmode=opaque" frameborder="0" allowfullscreen></iframe>
                </li>
                <li data-type="video" data-title="HTML5 Video">
                    <video width="700" height="390" controls="control" preload="none">
                        <source src="http://mediaelementjs.com/media/echo-hereweare.mp4" type="video/mp4" />
                        <source src="http://mediaelementjs.com/media/echo-hereweare.webm" type="video/webm" />
                        <source src="http://mediaelementjs.com/media/echo-hereweare.ogv" type="video/ogg" />
                    </video>
                </li>
            </ul>
        </div>
    <?php }
}
add_action('thematic_header', 'childtheme_nivo_gallery', 10);
?>