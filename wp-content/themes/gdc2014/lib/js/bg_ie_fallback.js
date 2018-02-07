if (!('backgroundSize' in document.body.style || 'MozBackgroundSize' in document.body.style)) {
    jQuery(document).ready(function() {
        var background = jQuery('body'), fallbackimage, fallbackpattern, overflowX, overflowY;
         
        background.prepend('<img src="https://germaine-de-capuccini.co.uk/wp-content/themes/gdc2014/images/gdc-background.jpg" id="fallbackimage">');
        background.prepend('<div id="fallbackpattern"></div>');
         
        fallbackimage = jQuery('#fallbackimage');
        fallbackpattern = jQuery('#fallbackpattern');
         
        jQuery(window).on("load resize", centerImage);
         
        function centerImage() {       
            overflowX = (fallbackpattern.width() - fallbackimage.width()) / 2;
            overflowY = (fallbackpattern.height() - fallbackimage.height()) / 2;                   
            fallbackimage.css('margin-left', overflowX+'px');
            fallbackimage.css('margin-top', overflowY+'px');
        }
         
    });
}