jQuery(document).ready(function( $ ) {
    //caches a jQuery object containing the header element
    var header = $("#site-navigation");
    var page = $("#page");
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 70) {
            header.removeClass('top').addClass("scrolled");
            page.removeClass('top').addClass("scrolled");
        } else {
            header.removeClass("scrolled").addClass('top');
            page.removeClass("scrolled").addClass('top');
        }
    });
  
  var $root = $('html, body');
    $('a.scroll').click(function() {
        $root.animate({
            scrollTop: $( $.attr(this, 'href') ).offset().top
        }, 500);
        return false;
    });


    $('button.showmore').click(function(e){
        var $this = $(this);
        var buttonId = $this.data("id");
        $this.toggleClass('on');
        if($this.hasClass('on')){
            $this.text('Show Less');         
        } else {
            $this.text('Show More');
        }

        $('#' + buttonId).toggleClass("show"); //you can list several class names 
        console.log(buttonId);
      })
/*
    $(document).on('click', 'li.wc-layered-nav-term a', function() {
        $(this).addClass('loading');
        // console.log('click!');
    });
*/

/*    $(window).resize(function() {
        // This will fire each time the window is resized:
        if($(window).width() >= 769) {
            // if larger or equal
            //$("#shortdescription").detach().appendTo('#desktop-description');
            $(".images").detach().appendTo('#desktop-product-images');
        } else {
            // if smaller
            $(".images").detach().appendTo('#mobile-product-images');
        }
    }).resize(); // This will simulate a resize to trigger the initial run.

*/

});