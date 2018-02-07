<?php
function childtheme_override_page_title() {

	// paste original function contents and edit to please
global $post;
		
		$content = '';
		if (is_attachment()) {
				$content .= '<h2 class="page-title"><a href="';
				$content .= apply_filters('the_permalink',get_permalink($post->post_parent));
				$content .= '" rev="attachment"><span class="meta-nav">&laquo; </span>';
				$content .= get_the_title($post->post_parent);
				$content .= '</a></h2>';
		} elseif (is_author()) {
				$content .= '<h1 class="page-title author">';
				$author = get_the_author_meta( 'display_name' );
				$content .= __('Author Archives: ', 'thematic');
				$content .= '<span>';
				$content .= $author;
				$content .= '</span></h1>';
		} elseif (is_category()) {
				$content .= '<h1 class="page-title">';
				$content .= __('Category Archives:', 'thematic');
				$content .= ' <span>';
				$content .= single_cat_title('', FALSE);
				$content .= '</span></h1>' . "\n";
				$content .= '<div class="archive-meta">';
				if ( !(''== category_description()) ) : $content .= apply_filters('archive_meta', category_description()); endif;
				$content .= '</div>';
		} elseif (is_search()) {
				$content .= '<h1 class="page-title">';
				$content .= __('Search Results for:', 'thematic');
				$content .= ' <span id="search-terms">';
				$content .= esc_html(stripslashes($_GET['s']));
				$content .= '</span></h1>';
		} elseif (is_tag()) {
				$content .= '<h1 class="page-title">';
				$content .= __('Tag Archives:', 'thematic');
				$content .= ' <span>';
				$content .= __(thematic_tag_query());
				$content .= '</span></h1>';
		} elseif (is_tax()) {
			    global $taxonomy;
				$content .= '<h1 class="entry-title">';
				$content .= 'Frothimoon Beauty: ';
				$content .= $tax->labels->name . ' ';
				$content .= thematic_get_term_name();
				$content .= '</h1>';
		}	elseif (is_day()) {
				$content .= '<h1 class="page-title">';
				$content .= sprintf(__('Daily Archives: <span>%s</span>', 'thematic'), get_the_time(get_option('date_format')));
				$content .= '</h1>';
		} elseif (is_month()) {
				$content .= '<h1 class="page-title">';
				$content .= sprintf(__('Monthly Archives: <span>%s</span>', 'thematic'), get_the_time('F Y'));
				$content .= '</h1>';
		} elseif (is_year()) {
				$content .= '<h1 class="page-title">';
				$content .= sprintf(__('Yearly Archives: <span>%s</span>', 'thematic'), get_the_time('Y'));
				$content .= '</h1>';
		} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
				$content .= '<h1 class="page-title">';
				$content .= __('Blog Archives', 'thematic');
				$content .= '</h1>';
		}
		$content .= "\n";
		echo apply_filters('thematic_page_title', $content);
	

}
?>