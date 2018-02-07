<?php
/*Remove Author details on single posts
function remove_author($postmeta) {
    global $id, $post, $authordata;

    $author = '<span class="author vcard">';
    $author .= __('Written By ', 'thematic') . '<a class="url fn n" href="';
    $author .= get_author_posts_url(false, $authordata->ID, $authordata->user_nicename);
    $author .= '" title="' . __('View all posts by ', 'thematic') . get_the_author() . '">';
    $author .= get_the_author();
    $author .= '</span>';
    $postmeta = str_replace($author, '', $postmeta);
    return $postmeta;
}
add_filter('thematic_postheader_postmeta', 'remove_author');
*/

function childtheme_remove_author($postmeta) {
    $postmeta = ''; /* bye vcard, b/c no output specified - blank return */
	$postmeta .= the_date('','<h3>','</h3>','true');
	return $postmeta;
}
add_filter('thematic_postheader_postmeta', 'childtheme_remove_author');
?>