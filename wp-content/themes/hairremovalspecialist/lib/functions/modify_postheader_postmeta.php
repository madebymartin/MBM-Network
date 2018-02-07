<?php
/* Modify postheader_postmeta */
function childtheme_postheader_postmeta() {

	$postmeta = '<div class="entry-meta">';
	$postmeta .= '<span class="cat-links">';

		if (is_single()) {
			$postmeta .= __('Categories: ', 'thematic') . get_the_category_list(' | ');
			$postmeta .= '</span>';
		} elseif ( is_category() && $cats_meow = thematic_cats_meow(' | ') ) { /* Returns categories other than the one queried */
			$postmeta .= __('Also posted in ', 'thematic') . $cats_meow;
			$postmeta .= '</span> <span class="meta-sep meta-sep-tag-links"></span>';
		} else {
			$postmeta .= __('Posted in ', 'thematic') . get_the_category_list(' | ');
			$postmeta .= '</span> <span class="meta-sep meta-sep-entry-date"></span>';
		}
	$postmeta .= '<br>';
	$postmeta .= thematic_postmeta_entrydate();
	$postmeta .= '<br>';
	$postmeta .= thematic_postmeta_editlink();

	$postmeta .= "</div><!-- .entry-meta -->\n";

	return apply_filters('childtheme_postheader_postmeta',$postmeta); 

}
add_filter('thematic_postheader_postmeta', 'childtheme_postheader_postmeta');
?>