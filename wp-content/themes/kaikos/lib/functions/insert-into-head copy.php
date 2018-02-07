<?php
function anythingsliderscripts() { 
if(is_front_page() ) { 

	wp_enqueue_script( 'as_jquery', get_stylesheet_directory_uri() . '/lib/scripts/jquery.min.js', '', '');
	wp_enqueue_script( 'anythingslider', get_stylesheet_directory_uri() . '/lib/scripts/jquery.anythingslider.js', '', '');
	wp_enqueue_script( 'as_easing', get_stylesheet_directory_uri() . '/lib/scripts/jquery.easing.1.2.js', '', '');
} 

elseif(is_page( 33 )){
wp_deregister_script( 'jigoshop_frontend' );
wp_deregister_script( 'jigoshop_script' );
wp_deregister_script( 'jqueryui' );
wp_deregister_script( 'fancybox' );
}

else { }

}
add_action('wp_enqueue_scripts','anythingsliderscripts');





function insert_anythingsliderscript() { 

if(is_front_page() ) {   ?>
	<!-- AnythingSlider initialization -->
	<script type='text/javascript'>
		// DOM Ready
		jQuery(function(){
			jQuery('#slider').anythingSlider();
		});
	</script>
<?php } }

add_action('wp_head','insert_anythingsliderscript');


?>