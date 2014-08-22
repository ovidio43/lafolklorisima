jQuery(document).ready(function() {
    jQuery('body').on('click', 'nav.pagination > div.alignright > a', function(e) {
        e.preventDefault();
        var thisObj = jQuery(this);
        thisObj.text('LOADING...');
        var jqxhr = jQuery.get(thisObj.attr('href'), function(data) {
            if (jQuery.browser.msie && parseFloat(jQuery.browser.version) < 9) {
                jQuery('.news-wrap').append(forIE8(data, 'news-wrap'));
            } else {
                jQuery('.news-wrap').append(jQuery(data).find('.news-wrap').children());
            }
            thisObj.parent().parent().remove();
            reDim();
        });
         jqxhr.done(function() {
            var imgLoad = imagesLoaded( '#wrap-media-all' );
            imgLoad.on( 'always', function onAlways() {
                masonryload();
            });                           
        }); 
       
    });
    jQuery('body').on('click', 'nav.pagination > p > a', function(e) {
        e.preventDefault();
        var thisObj = jQuery(this);
        thisObj.text('LOADING...');
        jQuery.get(thisObj.attr('href'), function(data) {
            if (jQuery.browser.msie && parseFloat(jQuery.browser.version) < 9) {
                jQuery('.content-wrapper').append(forIE8(data, 'content-wrapper'));
            } else {
                jQuery('.content-wrapper').append(jQuery(data).find('.content-wrapper').children());
            }
            thisObj.parent().parent().remove();
            reDim();
        });
    });
});
function forIE8(data, objContent) {
    var begin = data.indexOf('<div class="' + objContent + '">');
    var end = data.lastIndexOf('</nav>');
    var res = data.slice((begin + 26), end);
    res = res + '</nav>';
    return res;
}

