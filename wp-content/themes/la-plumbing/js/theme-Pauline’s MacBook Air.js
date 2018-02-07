jQuery(document).ready(function( $ ) {
  var stickyTop = $('#scrollspy-nav').offset().top;
  var distanceToMain = $('#main').offset().top;

  $(window).resize(function() {
    var stickyTop = $('#scrollspy-nav').offset().top;
  }).resize(); // This will simulate a resize to trigger the initial run.

  $(window).on( 'scroll', function(){
      if ($(window).scrollTop() >= stickyTop) {
          $('#scrollspy-nav').addClass( "stick" );
      } else {
          $('#scrollspy-nav').removeClass( "stick" );
      }

      if ($(window).scrollTop() >= distanceToMain) {
          $('#scrollspy-nav').addClass( "opaque" );
      } else {
          $('#scrollspy-nav').removeClass( "opaque" );
      }
  });


  $('.nav li a').on('click', function(event) {
      event.preventDefault();
      var hash = this.hash;
      $('html, body').animate({scrollTop: $(hash).offset().top}, 320);
  });

});