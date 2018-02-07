<?php
/*Add Custom Thumbnail Sizes*/
//add_image_size('posterthumb', 130, 500);
//add_image_size('posterlarge', 600, 2000);
add_image_size('homebutton', 200, 130, true);
add_image_size('200sq', 200, 200, true);
add_image_size('2550sq', 500, 500, true);
add_image_size('700sq', 700, 700, true);
//add_image_size('listing', 160, 2000);
//add_image_size('tiny', 80, 80, true);
add_image_size('slide', 800, 550, true);
add_image_size('banner', 800, 360, true);

// post thumbnail sizing for the flexslider, best if 750px by 425px to look decent.
add_image_size( 'featured-slider', 750, 425 ); // width and height



// MULTIPLE THUMBNAILS PLUGIN
if (class_exists('MultiPostThumbnails')) {
    new MultiPostThumbnails(
        array(
            'label' => 'Front Cover Image',
            'id' => 'frontcover',
            'post_type' => 'pressarticle'
        )
    );
    new MultiPostThumbnails(
        array(
            'label' => 'Shop Front Feature Banner',
            'id' => 'feature',
            'post_type' => 'product'
        )
    );
     new MultiPostThumbnails(
        array(
            'label' => 'Shop Front Feature Banner',
            'id' => 'promo_feature',
            'post_type' => 'promotion'
        )
    );
    new MultiPostThumbnails(
        array(
            'label' => 'Treatments Page Feature Banner',
            'id' => 'featured_treatment',
            'post_type' => 'treatments'
        )
    );


}
?>
