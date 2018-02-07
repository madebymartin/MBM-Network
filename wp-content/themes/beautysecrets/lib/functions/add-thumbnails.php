<?php
// Add Custom thumnbnails
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 150, 150 ); // default Post Thumbnail dimensions   
}

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'logo', 135, 55 ); // Logo thumbnail size - uncropped
	add_image_size( 'feature', 150, 100, true ); // Feature thumbnail size - cropped
	add_image_size( 'pagefeature', 200, 300); // Page Feature thumbnail size - cropped
}
?>