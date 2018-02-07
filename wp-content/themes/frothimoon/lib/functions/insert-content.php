<?php
// Add Content into anywhere by using the Thematic Hooks, listed below
function additional_content() {
if (is_singular('bridal')) {?>

<?php
{ the_post_thumbnail('headerimage', array('class' => 'headerimage'));  }
 }

else if (is_page('')) {
the_post_thumbnail('headerimage', array('class' => 'headerimage'));
}

else if (is_single('')) {

?>
<div class="headerimage"><img src="<?php bloginfo('stylesheet_directory') ?>/images/frothimoon-news-banner.jpg" /></div>
<?php
}

else if (is_category('')) {

?>
<div class="headerimage"><img src="<?php bloginfo('stylesheet_directory') ?>/images/frothimoon-news-banner.jpg" /></div>
<?php
}

else {
the_post_thumbnail('headerimage', array('class' => 'headerimage'));
}

} // end of our new function childtheme_contact_blurb

// Now we add our new function to our Thematic Action Hook
// THIS EXAMPLE HOOKS INTO THE BRANDING DIV, JUST BEFORE THE CLOSE
add_action('thematic_header','additional_content', 6);




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