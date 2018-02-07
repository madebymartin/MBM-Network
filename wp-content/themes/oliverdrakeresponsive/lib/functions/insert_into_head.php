<?php
function insert_into_head() { ?>
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
<?php }
add_action('wp_head','insert_into_head');



function enqueue_opph_styles() {
	wp_enqueue_style( 'mygravityforms', get_stylesheet_directory_uri() . '/lib/css/forms.css', '', '');
	//if(is_front_page()){ wp_enqueue_script( 'flexslider', get_stylesheet_directory_uri() . '/lib/FlexSlider-master/jquery.flexslider.js', 'jQuery', false, true ); }
}
add_action('wp_enqueue_scripts','enqueue_opph_styles');

?>