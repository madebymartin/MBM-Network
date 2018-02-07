$(document).ready(function(e) {
	
	// animates projects section on page load
	
	if($(document).scrollTop() <= 0 )
			{$('#projects').addClass('animated bounce');}
		else
			{}
	
	
	// logo scrolls up on homepage only
	
	if ($('body').data("page") === 'work') {
		$('#logo').addClass('btn1');
		} else {
		$('#logo').removeClass('btn1');
	}
	
	
	// navigation scrolling
	
	enableNavigation();

	function enableNavigation(){
		$('.btn0').click(function(e) {
			e.preventDefault();
			scrollToSection( '#projects');
		});
		$('.btn1').click(function(e) {
			e.preventDefault();
			scrollToSection( 'body');
		});
		$('.btn2').click(function(e) {
			e.preventDefault();
			scrollToSection( '#wrapper');
		});
	}
	
	function scrollToSection( newSection ){
		var positionTo = $(newSection).offset().top - 0;
		$('html,body').stop();
		$('html,body').animate( { scrollTop:positionTo}, 500 );
	}
	
	$(window).scroll(function(){
		if($(document).scrollTop() > $("#hero").outerHeight() - $("header").outerHeight() )
			{$('header').addClass('header--opaque');}
		else
			{$('header').removeClass('header--opaque');}
	});
	
});

// Navigation
	
	$(function() {
		$('.toggle-nav').click(function() {
			if ($('body').hasClass('show-nav')) {
				$('body').removeClass('show-nav').addClass('hide-nav');
				$('.toggle-nav').removeClass('active');
				$(document).unbind('touchmove'); // prevent mobile scrolling
				setTimeout(function() {
					$('body').removeClass('hide-nav');
				}, 500);
			} else {
				$('body').removeClass('hide-nav').addClass('show-nav');
				$('.toggle-nav').addClass('active');
				$(document).bind('touchmove', function(e) { // prevent mobile scrolling
					e.preventDefault();
				});
			}
			return false;
		});
	});
	
	$(document).keyup(function(e) {
		if (e.keyCode == 27) {
			if ($('body').hasClass('show-nav')) {
				$('body').removeClass('show-nav').addClass('hide-nav');
				$('.toggle-nav').removeClass('active');
				$(document).unbind('touchmove'); // prevent mobile scrolling
				setTimeout(function() {
					$('body').removeClass('hide-nav');
				}, 500);
			} else {
				$('body').removeClass('hide-nav').addClass('show-nav');
				$('.toggle-nav').addClass('active');
				$(document).bind('touchmove', function(e) { // prevent mobile scrolling
					e.preventDefault();
				});
			}
		}
	});
	
	
	// disable mousescroll
	
	$( '.preventscrollonother' ).bind( 'mousewheel DOMMouseScroll', function ( e ) {
		var e0 = e.originalEvent,
			delta = e0.wheelDelta || -e0.detail;
		
		this.scrollTop += ( delta < 0 ? 1 : -1 ) * 30;
		e.preventDefault();
		
	});


// Enable Layzr.js (Lazy Loader + Retina)

	var layzr = new Layzr({ 
		selector: '[data-layzr]', 
		attr: 'data-layzr', 
		retinaAttr: 'data-layzr-retina', 
		bgAttr: 'data-layzr-bg', 
		threshold: 90,  // percentage of the viewport height // +sooner/-later
		callback: null 
	});


// Parallax Banner

	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
	
	}
	else{
		window.onscroll = function () {
		n = Math.ceil($("body.project-page").scrollTop() / 3); <!-- index,about,change = are on page -->
		$("#hero").css("-webkit-transform", "translateY(" + n + "px)");
		$("#hero").css("transform", "translateY(" + n + "px)");
		}
	}

