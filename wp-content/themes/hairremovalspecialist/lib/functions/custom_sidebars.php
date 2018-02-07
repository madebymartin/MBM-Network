<?php
function customsidebars() { 

// BLOG CATEGORIES SIDEBAR
if(is_home() ) {
	get_template_part( 'lib/template_parts/sidemenu', 'blog' );
}
elseif(is_category()) {
	get_template_part( 'lib/template_parts/sidemenu', 'blog' );
}
elseif(is_single()) {
	get_template_part( 'lib/template_parts/sidemenu', 'blog' );
}



// TREATMENTS SIDEBAR	
if(is_front_page() ) {
}
elseif (is_page('24')){
}
else { 
	get_template_part( 'lib/template_parts/sidemenu', 'spa' );
}



// CONTACT SIDEBAR
if(is_page(6) ) {
}

else { 
	get_template_part( 'lib/template_parts/sidemenu', 'contact' );
}
?>



			<?php if ( get_post_meta(('6'), '_cmb_phone', true) ) { ?>



			<?php } ?>


<?php if ( get_post_meta(('24'), '_cmb_menudownload', true) ) { ?>
	<div class="aside main-aside">
		<ul class="xoxo">
			<li class="widgetcontainer widget_text">
				<h3 class="widgettitle">Download Spa Menu</h3>
				<div class="textwidget">
					<a class="pdf" target="blank" title="Download Spa Brochure" href="<?php echo get_post_meta(('24'), "_cmb_menudownload", true); ?>">Click Here</a>
				</div>
			</li>
		</ul>
	</div>			
<?php } ?>






<?php } 
add_action('thematic_betweenmainasides','customsidebars', 9);
?>