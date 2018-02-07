jQuery(document).foundation();
/*
These functions make sure WordPress
and Foundation play nice together.
*/

jQuery(document).ready(function() {

    // Remove empty P tags created by WP inside of Accordion and Orbit
    jQuery('.accordion p:empty, .orbit p:empty').remove();

	 // Makes sure last grid item floats left
	jQuery('.archive-grid .columns').last().addClass( 'end' );

	// Adds Flex Video to YouTube and Vimeo Embeds
  jQuery('iframe[src*="youtube.com"], iframe[src*="vimeo.com"]').each(function() {
    if ( jQuery(this).innerWidth() / jQuery(this).innerHeight() > 1.5 ) {
      jQuery(this).wrap("<div class='widescreen flex-video'/>");
    } else {
      jQuery(this).wrap("<div class='flex-video'/>");
    }
  });




  if (jQuery('#back-to-top').length) {
      var scrollTrigger = 100, // px
          backToTop = function () {
              var scrollTop = jQuery(window).scrollTop();
              if (scrollTop > scrollTrigger) {
                  jQuery('#back-to-top').addClass('show');
                  jQuery('.header').addClass('scrolled');
              } else {
                  jQuery('#back-to-top').removeClass('show');
                  jQuery('.header').removeClass('scrolled');
              }
          };
      backToTop();
      jQuery(window).on('scroll', function () {
          backToTop();
      });
      jQuery('#back-to-top').on('click', function (e) {
          e.preventDefault();
          jQuery('html,body').animate({
              scrollTop: 0
          }, 700);
      });
  }






    //   jQuery('.animate').bind('inview', function (event, visible) {
       
    //   if (visible == true) {
    //     // element is now visible in the viewport
    //     jQuery(this).removeClass('animate');
    //       console.log( jQuery(this).attr('class'));
    //   } else {
    //     // element has gone out of viewport
    //      jQuery(this).addClass('animate');
    //        console.log( jQuery(this).attr('class'));
    //   }
    // });
    // jQuery('.animate').trigger('inview');



});
