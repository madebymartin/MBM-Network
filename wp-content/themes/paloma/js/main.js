// Set jQuery $ variable
(function ($) {
   $(document);

// Enable responsive menus
( function( window, $, undefined ) {
  'use strict';
 
  $( '.primary-nav' ).before( '<button class="menu-toggle" role="button" aria-pressed="false"></button>' ); // Add toggles to menus
  $( '.primary-nav .sub-menu' ).before( '<button class="sub-menu-toggle" role="button" aria-pressed="false"></button>' ); // Add toggles to sub menus
 
  // Show/hide the main navigation
  $( '.menu-toggle' ).on( 'click', function() {
    var $this = $( this );
    $this.attr( 'aria-pressed', function( index, value ) {
      return 'false' === value ? 'true' : 'false';
    });
 
    $this.toggleClass( 'activated' );
    $this.next( 'nav, .sub-menu' ).animate({
                width: "toggle"
            });
 
  });

    // Show/hide sub menus
  $( '.sub-menu-toggle' ).on( 'click', function() {
    var $this = $( this );
    $this.attr( 'aria-pressed', function( index, value ) {
      return 'false' === value ? 'true' : 'false';
    });
 
    $this.toggleClass( 'activated' );
    $this.next( 'nav, .sub-menu' ).slideToggle( 'fast' );
 
  });
 
})( this, jQuery );

//Init Flickity Slider
var flickContainer = document.querySelector('.main-gallery');
if ( flickContainer != null ){
imagesLoaded( flickContainer, function() {
  $('.main-gallery').flickity({
    // options
    cellAlign: 'left',
    cellSelector: '.home-gallery-cell',
    wrapAround: true,
    pageDots: false,
    imagesLoaded: true,
    dragThreshold: 10,
    autoPlay: parseInt( palomaSlider.delay, 10 ),
    draggable: eval( palomaSlider.draggable ),
    prevNextButtons: eval( palomaSlider.arrows ),
    arrowShape: { 
        x0: 15,
        x1: 60, y1: 50,
        x2: 65, y2: 45,
        x3: 25
    }
  });
});

var imgLoad = imagesLoaded( flickContainer );
var $gallery = jQuery('.main-gallery');
var $gallerycells = $gallery.find('.home-gallery-cell');

  imgLoad.on( 'done', function( instance ) {
  $gallerycells.css( "opacity", "1" );
});
}

//Init Flickity Latest Posts
var flickLatest = document.querySelector('.paloma-latest-posts');
if ( flickLatest != null ){
imagesLoaded( flickLatest, function() {
  $('.paloma-latest-posts').flickity({
    // options
    cellAlign: 'left',
    cellSelector: '.paloma-latest-single',
    wrapAround: true,
    pageDots: false,
    imagesLoaded: true,
    dragThreshold: 10,
    //autoPlay: parseInt( palomaSlider.delay, 10 ),
    //draggable: eval( palomaSlider.draggable ),
    //prevNextButtons: eval( palomaSlider.arrows ),
  });
});
}

//Change sticky nav background on scroll
$(document).ready(function () {
    if (palomaNavParams.sticky != '1') {
        $(".nav-container").removeClass("nav-transparent");
    }
  if (palomaNavParams.sticky == '1'){
    $(window).scroll(function () { 
        if ($(document).scrollTop() > 1 ) {
            $(".upper-nav-container").removeClass("nav-transparent");
        } else {
            $(".upper-nav-container").addClass("nav-transparent");
        }
    });
  }
});

//Enable smooth scroll back to top and to content
$(document).ready(function(){
  $('a[href^="#top"], a[href^="#content"]').on('click',function (e) {
      e.preventDefault();

      var target = this.hash;
      var $target = $(target);

      $('html, body').stop().animate({
          'scrollTop': $target.offset().top
      }, 900, 'swing' );
  });
});

//Configure sticky sidebar
$(document).ready(function() {
    if (palomaSidebar.sticky == "true") {
      $('.sticky-sidebar').theiaStickySidebar({
        // Settings
        additionalMarginTop: 30,
        additionalMarginBottom: 60
      });
    }
  });

//Configure sticky back to top
    function sticky_btt() {
      if (palomaBtt.sticky == "true") {
        var window_top = $(window).scrollTop() + $(window).height();
        var div_top = $('#prefooter').offset().top;
        var page_top = $(window).scrollTop()
        var nav_top = $('#content').offset().top;
        if (window_top < div_top) {
            $('.stnsvn-btt').addClass('stick');
        } else {
            $('.stnsvn-btt').removeClass('stick');
        }
        if (page_top < nav_top) {
            $('.stnsvn-btt').addClass('hidden');
        } else {
            $('.stnsvn-btt').removeClass('hidden');
        }
      }
    }
   
    $(function () {
        $(window).scroll(sticky_btt);
        sticky_btt();
    });

//Isotope
var $grid = $('.grid').imagesLoaded( function() {
  // init Isotope after all images have loaded
  $grid.isotope({
    // options
    layoutMode: 'masonry',
    masonry: {
      columnWidth: '.grid-sizer',
      gutter: '.gutter-sizer'
    },
    itemSelector: '.grid-item',
    percentPosition: true
  });
});

}(jQuery)); //End jQuery
