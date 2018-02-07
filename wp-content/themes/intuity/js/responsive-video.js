jQuery(document).ready(function($) {

	var $all_oembed_videos = $("iframe[src*='youtube'], iframe[src*='vimeo']");
	
	$all_oembed_videos.each(function() {
	
		$(this).removeAttr('height').removeAttr('width').wrap( "<div class='embed-container'></div>" );
 	
 	});

});