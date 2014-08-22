function moveShadow(){
    $(document).on('mousemove', '#alicia', function(event) {
        var skewX = skewX;
        if (event.pageX > 350) {
            if (event.pageX >= 700) {
                var mouseX = 700;
            } else {
                var mouseX = (parseInt(event.pageX));
            }
            var newdegX = (((mouseX - 350) / 150) * 3) + "deg";
        } else {
            var mouseX = (parseInt(event.pageX));
            var newdegX = -(((350 - mouseX) / 150) * 3) + "deg";
        }
        $("#shadowcontainer").css({skewX: newdegX});
    });
}

function masonryload(){
    if($('#wrap-media-all').length >0){
        var container = document.querySelector('#wrap-media-all');
        var msnry = new Masonry( container, {
          columnWidth: 1,
          itemSelector: '.item-media'        
        });   

        /*var elem = document.querySelector('#wrap-media-all');
        var draggie = new Draggabilly( elem, {
          // options...
        });   */ 
     }
}

function reDim(){
    $('.news-wrap .entry-image').height($('.news-wrap .entry-image').width());
    $('#wrap-media-all .entry-image').height('auto');
    $('.item-tumblr').height($('.item-tumblr').width());
    $('.flip-container').height($('.news-wrap .entry-image').width());
};
function displayButton(){
    $('.mobile-nav').bind('click', function(){
        if(!$('.desktop-nav').hasClass('active_nav')){
            $('.desktop-nav').addClass('active_nav');
        }else{
            $('.desktop-nav').removeClass('active_nav');
        }
        
    });
}
function entryImageResize() {

    $w = $('.single .entry-content, .page .entry-content').width();
    $(".entry-content img[class*='wp-image']").each(function() {
        var imgwidth = this.width;
        $(this).attr('rel', imgwidth);
        var auxw = $(this).attr('width');
        if(auxw==""){
            auxw = $(this).attr('rel');
        }
        //console.log(auxw+"+++"+$w);
        if (auxw >= $w) {
            $(this).width('100%');
            $(this).height('auto');
        } else {
            $(this).attr('style', '');
        }
    });
    var mobile = (/iphone|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));
    if(mobile){
        $('#map').height($(window).height()-( $('#header').height() + $('.nav-tour').height()));
    }else{
        $('#map').height($(window).height()-( $('#header').height() + $('.nav-tour').height() + $('#page-footer').height()));
    }
    

}
