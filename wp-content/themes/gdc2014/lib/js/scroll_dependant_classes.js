jQuery(function() {
    //caches a jQuery object containing the header element
    var header = jQuery("#product_sticky_nav");
    jQuery(window).scroll(function() {
        var scroll = jQuery(window).scrollTop();

        if (scroll >= 210) {
            header.removeClass('hidden').addClass("visible");
        } else {
            header.removeClass("visible").addClass('hidden');
        }
    });
});