jQuery(function() {
    //caches a jQuery object containing the header element
    var header = jQuery("#sections_nav");
    jQuery(window).scroll(function() {
        var scroll = jQuery(window).scrollTop();

        if (scroll >= 110) {
            header.removeClass('hidden').addClass("visible");
        } else {
            header.removeClass("visible").addClass('hidden');
        }
    });
});