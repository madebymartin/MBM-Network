<?php
function customsidebars() { 

?>
<div class="aside main-aside">

	<h3 class="phone">Telephone
		<span><br>0121 421 3243</span>
	</h3>


	<h3 class="address">Find Us
		<span><br>
		282 Hagley Road West<br>
		Quinton<br>
		Birmingham<br>
		B68 0NR</span>
	</h3>

	<?php
		
if(! is_page('461') ) {
	echo '<h3 class="booknow"><a href="' . get_permalink('461') . '">Book Now</a></h3>';
}

?>

</div>

<?php 	
if(is_tax('haircategory') ) {
	get_template_part( 'lib/template_parts/sidemenu', 'hair' );
}
elseif(is_page('32') ) {
	get_template_part( 'lib/template_parts/sidemenu', 'hair' );
}



elseif(is_tax('spacategory') ) { 
get_template_part( 'lib/template_parts/sidemenu', 'spa' ); 
}
elseif(is_page('33') ) { 
get_template_part( 'lib/template_parts/sidemenu', 'spa' ); 
}


elseif(is_tax('beautycategory') ) { 
get_template_part( 'lib/template_parts/sidemenu', 'beauty' ); 
}
elseif(is_page('35') ) { 
get_template_part( 'lib/template_parts/sidemenu', 'beauty' ); 
}





} 
add_action('thematic_betweenmainasides','customsidebars', 9);
?>