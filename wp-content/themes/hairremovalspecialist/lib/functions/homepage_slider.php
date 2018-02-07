<?php
function anythingsliderscripts() { 
if(is_front_page() ) { 

//wp_deregister_script( 'jquery' );

	wp_enqueue_script( 'as_jquery', get_stylesheet_directory_uri() . '/lib/scripts/jquery.min.js', '', '');
	wp_enqueue_script( 'anythingslider', get_stylesheet_directory_uri() . '/lib/scripts/jquery.anythingslider.js', '', '');
	wp_enqueue_script( 'as_easing', get_stylesheet_directory_uri() . '/lib/scripts/jquery.easing.1.2.js', '', '');
} 

else { }

}
add_action('wp_enqueue_scripts','anythingsliderscripts');



function anythingslider_init(){ 
if(is_front_page() ) { 	?>
	<!-- AnythingSlider initialization -->
	<script>
		// DOM Ready
		$(function(){
			$('#slider').anythingSlider();
		});
	</script>




	<script>
		// Set up Sliders
		// **************
		$(function(){


			$('#slider1').anythingSlider({
  mode                : 'f',   // fade mode - new in v1.8!
  buildNavigation     : false,      // If true, builds a list of anchor links to link to each panel
  delay               : 4000,      // How long between slideshow transitions in AutoPlay mode (in milliseconds)
  animationTime       : 600,       // How long the slideshow transition takes (in milliseconds)
  delayBeforeAnimate  : 0,         // How long to pause slide animation before going to the desired slide (used if you want your "out" FX to show).
  resizeContents      : false, // If true, solitary images/objects in the panel will expand to fit the viewport
  navigationSize      : false,     // Set this to the maximum number of visible navigation tabs; false to disable
  navigationFormatter : function(index, panel){ // Format navigation labels with text
					return ['Recipe', 'Quote', 'Image', 'Quote #2', 'Image #2'][index - 1];
				},
				onSlideBegin: function(e,slider) {
					// keep the current navigation tab in view
					slider.navWindow( slider.targetPage );
				}
			});



		});
	</script>




	<!-- Older IE stylesheet, to reposition navigation arrows, added AFTER the theme stylesheet -->
	<!--[if lte IE 7]>
	<link rel="stylesheet" href="css/anythingslider-ie.css" type="text/css" media="screen" />
	<![endif]-->

<?php } }

add_action( 'wp_head', 'anythingslider_init' ); 


?>