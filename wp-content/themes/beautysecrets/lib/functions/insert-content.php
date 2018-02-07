<?php
// Add Content into anywhere by using the Thematic Hooks, listed below
function insert_header_content() {
?>

<div id="shoppinginfo">
	<div id="bagdetails">
	<div id="bagitems"> <a href="<?php echo jigoshop_cart::get_cart_url(); ?>">
	<?php echo sprintf(_n('%d item &ndash; ', '%d items &ndash; ', jigoshop_cart::$cart_contents_count, 'jigoshop'), jigoshop_cart::$cart_contents_count);
    //echo jigoshop_cart::get_cart_total();
	?> in the shopping bag</a></div>
	
<a href="<?php echo jigoshop_cart::get_cart_url(); ?>" class="bagicon"></a>

	<div id="userlinks"> 
	<a class="firstlink" href="<?php echo get_permalink(7); ?>">My Account</a><span>|</span>
	<a href="<?php echo jigoshop_cart::get_cart_url(); ?>">View Bag</a><span>|</span>
	<a href="<?php echo get_permalink(11); ?>">Checkout</a>
	</div>
	
	</div>

	
	
</div>

<?php
}
add_action('thematic_header','insert_header_content', 9);



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