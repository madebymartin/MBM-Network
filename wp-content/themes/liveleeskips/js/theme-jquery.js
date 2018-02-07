jQuery(document).ready(function( $ ) {

	$("input[type='text']").on("click", function () {
       $(this).select();
       $("img.validarea").hide();
    });




/*    $.fn.equalHeights = function() {

            var top = 0;
            var randomClass = ( 'eH' + Math.random() ).replace('.','');
            //  console.log('A random class: ' + randomClass); // ?

            // run though each of these elements
            $(this).each( function() {

                // how far is this element, from the top?
                var distanceFromTop = $(this).offset().top;
                // console.log('This is ' + distanceFromTop + ' from the top.');

                // if it's further away from the top than 0, it must be in the second row...
                if ( distanceFromTop > top ) {
                    $('.' + randomClass).removeClass(randomClass); 
                    top = distanceFromTop;
                    // console.log('"top" is ' + top + 'px away');
                }
                
                // add that random class to this element
                $(this).addClass(randomClass);
                
                // set height to auto as a reset...
                $(this).outerHeight('auto');

                // uh....
                var newHeight = (Math.max.apply(null, $('.' + randomClass).map( function() { 
                    return $(this).outerHeight(); 
                }).get()));

                // add the new height to this element   
                $('.' + randomClass).outerHeight(newHeight);

            }).removeClass(randomClass); // remove the class? (first?)

    };

    $(window).resize(function(){
        $('div.bags').equalHeights(); // I should probably debounce this
    }).trigger('resize');*/

    
});