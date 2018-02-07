<?php
// modify user profile contact info in wordpress admin
// http://wp-snippets.com/addremove-contact-info-fields/
function childtheme_contactmethods( $contactmethods ) {
    $contactmethods['twitter'] = 'Twitter Username'; // add twitter
    $contactmethods['facebook'] = 'Facebook Link <span class="description">(http:// required)</span>'; // add facebook

    unset($contactmethods['yim']); // remove yahoo instant messenger
    unset($contactmethods['aim']); // remove aol instant messenger
    unset($contactmethods['jabber']); // remove google talk / jabber services

    return $contactmethods;
}
add_filter('user_contactmethods','childtheme_contactmethods', 10,1);

// add a author box for thematic above the comment section
// http://themeshaper.com/forums/topic/thematic-author-box
function childtheme_authorbox() {
    if ( is_single () ) { ?>
        <div class="authorbox cf">
            <h4><span>About</span> <?php the_author_meta('nickname'); ?></h4>
            <div class="authorbox-image"><?php echo get_avatar( get_the_author_meta('email'), '80' ); ?></div>
            <div class="authorbox-info">
                
                <?php if ( get_the_author_meta('description')) { ?>
                <p><?php the_author_meta('description'); ?></p>
                <?php } ?>
            </div>
        </div>
    <?php }
}
add_action('thematic_abovecomments','childtheme_authorbox');
?>