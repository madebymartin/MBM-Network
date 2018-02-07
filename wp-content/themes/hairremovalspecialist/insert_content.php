<?php

// PAGE TOP
function pagetop() { ?>
	<div id="pagetop">This is the page-top</div>
<?php }
add_action('thematic_header','pagetop', 7);


// PAGE BOTTOM
function pagebottom() { ?>
	<div id="pagebottom">This is the page-bottom</div>
<?php }
add_action('thematic_abovefooter','pagebottom', 7);


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

thematic_footer()

thematic_after()

*/


?>