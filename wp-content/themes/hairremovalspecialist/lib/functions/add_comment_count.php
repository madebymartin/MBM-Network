<?php
// add the comment count to the title, for comment bubbles - appears in category and single
function childtheme_postheader_posttitle($title) {
    return '<div class="comment-count"><a href="' . get_permalink() . '"><span class="count">' . get_comments_number() . '</span></a></div>' . $title;
}
add_filter('thematic_postheader_posttitle', 'childtheme_postheader_posttitle');

?>