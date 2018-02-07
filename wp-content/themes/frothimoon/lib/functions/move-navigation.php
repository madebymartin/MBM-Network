<?php
// Remove default Thematic actions for Access Navigation
function remove_thematic_actions() {
remove_action('thematic_header','thematic_access',9);
}
add_action('init','remove_thematic_actions');

function child_add_menuclass($ulclass) {
return preg_replace('/

    /', '<ul class="sf-menu sf-vertical">', $ulclass, 1);
    }
    add_filter('wp_page_menu', 'child_add_menuclass');

// Create #access above the main asides
    function my_access() {
    thematic_access();
    }
    add_action('thematic_header','my_access', 2); 




/*
Thematic Position Hooks


thematic_before()
	Located in header.php just after the opening body tag, before anything else.


thematic_aboveheader()
	Located in header.php just before the header div.


thematic_header()
	This hook builds the content of the header div and loads the following actions:
	Action 	Position Number
	thematic_brandingopen() 	1
	thematic_blogtitle() 		3
	thematic_blogdescription() 	5
	thematic_brandingclose() 	7
	thematic_access() 			9

thematic_belowheader()
	Located in header.php just after the header div.

thematic_abovecomments()

thematic_abovecommentslist()

thematic_belowcommentslist()

thematic_abovetrackbackslist()

thematic_belowtrackbackslist()

thematic_abovecommentsform()

thematic_show_subscription_checkbox()

thematic_belowcommentsform()

thematic_show_manual_subscription_form()

thematic_belowcomments()

thematic_abovemainasides()

thematic_betweenmainasides()

thematic_belowmainasides()

thematic_abovefooter()

thematic_after()

*/


?>