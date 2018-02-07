<?php
// add a search form to the header (inside branding div)
function childtheme_header_searchform() {
    get_search_form();
}
add_action('thematic_header', 'childtheme_header_searchform', 7);
?>