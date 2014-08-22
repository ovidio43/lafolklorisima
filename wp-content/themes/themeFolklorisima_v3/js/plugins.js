// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
    $('.slide-home').bxSlider({
        video: true,
        useCSS: false,
        mode: 'fade',
        pager: false
    });
    $('.gallery br').remove();
    $('.entry-content .gallery').bxSlider({
        mode: 'fade',
        controls: false
    });

  
    if (Modernizr.mq('(min-width: 480px)')) {
        $('.carrousel').bxSlider({
            slideWidth: "auto",
            minSlides: 2,
            maxSlides: 4,
            slideMargin: 0,
            pager: false
        }); 
    }   
    $('.updates-launcher').fancybox({
        padding: 0,
        height: 450,
        arrows: false,
        type: 'inline'
    });
}());


