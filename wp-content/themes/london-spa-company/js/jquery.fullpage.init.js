$(document).ready(function() {
    $('#main').fullpage({
        //Navigation
        menu: '#site-navigation',
        lockAnchors: false,
        anchors:['1', '2', '3', '4', '5'],
        navigation: false,
        navigationPosition: 'right',
        navigationTooltips: ['firstSlide', 'secondSlide'],
        showActiveTooltip: false,
        slidesNavigation: false,
        slidesNavPosition: 'bottom',

        //Scrolling
        css3: true,
        scrollingSpeed: 700,
        autoScrolling: true,
        fitToSection: true,
        fitToSectionDelay: 10,
        scrollBar: true,
        easing: 'easeInOutCubic',
        easingcss3: 'ease',
        loopBottom: true,
        loopTop: false,
        loopHorizontal: false,
        continuousVertical: false,
        normalScrollElements: '#element1, .element2',
        scrollOverflow: false,
        scrollOverflowOptions: null,
        touchSensitivity: 10,
        normalScrollElementTouchThreshold: 5,
        bigSectionsDestination: null,

        //Accessibility
        keyboardScrolling: true,
        animateAnchor: true,
        recordHistory: true,

        //Design
        controlArrows: false,
        verticalCentered: false,
        sectionsColor : ['#000', '#000'],
        paddingTop: '0',
        paddingBottom: '0px',
        fixedElements: '#header, .footer',
        responsiveWidth: 766,
        responsiveHeight: 0,

        //Custom selectors
        sectionSelector: '.section',
        slideSelector: '.slide',

        //events
        onLeave: function(index, nextIndex, direction){},
        afterLoad: function(anchorLink, index){},
        afterRender: function(){},
        afterResize: function(){},
        afterSlideLoad: function(anchorLink, index, slideAnchor, slideIndex){},
        onSlideLeave: function(anchorLink, index, slideIndex, direction, nextSlideIndex){}
    });


	$('.current-menu-item.scroll1').find('a').attr('data-menuanchor', '1');
	$('.current-menu-item.scroll1 .sub-menu').find('a').removeAttr('data-menuanchor', '1');

    $('.current-menu-item .sub-menu .scroll2').find('a').attr('data-menuanchor', '2');
    $('.current-menu-item .sub-menu .scroll3').find('a').attr('data-menuanchor', '3');
    $('.current-menu-item .sub-menu .scroll4').find('a').attr('data-menuanchor', '4');



});

$(document).on('click', '.next', function(){
  $.fn.fullpage.moveSectionDown();
});