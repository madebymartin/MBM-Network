jQuery(document).ready(function( $ ) {
    //caches a jQuery object containing the header element
    var header = $("#site-navigation");
    var page = $("#page");
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 100) {
            header.removeClass('top').addClass("scrolled");
            page.removeClass('top').addClass("scrolled");
        } else {
            header.removeClass("scrolled").addClass('top');
            page.removeClass("scrolled").addClass('top');
        }
    });



    // var spinner = $(".gform_ajax_spinner");
    // spinner.wrap( "<div class='spinnercontainer'></div>" );

    $('body').on('change','#gform_ajax_spinner_46', function(){
       alert('OK!');
    });
    

    $(window).resize(function() {
        // This will fire each time the window is resized:
        if($(window).width() >= 666) {
            // if larger or equal
            //$("#shortdescription").detach().appendTo('#desktop-description');
            $(".images").detach().appendTo('#desktop-product-images');
        } else {
            // if smaller
            $(".images").detach().appendTo('#mobile-product-images');
        }
    }).resize(); // This will simulate a resize to trigger the initial run.




});