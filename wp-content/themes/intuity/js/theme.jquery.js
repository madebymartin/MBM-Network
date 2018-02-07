jQuery( document ).ready( function ( $ ) {

	$("#scroll img").click(function () {
	    $('html, body').animate({
	        scrollTop: $('#main').offset().top
	    }, 'slow');
	});

});