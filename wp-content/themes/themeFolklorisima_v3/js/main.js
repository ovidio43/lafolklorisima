    var mobile = (/iphone|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));
$(document).ready(function() {

    if(!mobile){
        $('.passions-wrap .head-pasions').parallax("0%", 0.1);
        $('.passions-wrap .single-content').parallax("0%", 0.1);
        $('.additional-image').parallax("100%", 0.4);  
        moveShadow();      
    }

    reDim();
    alicia_events();
    displayButton();
    entryImageResize();
});
$(window).resize(function() {
    entryImageResize();
    reDim();
});
$(window).load(function() {
    if(!mobile){
        masonryload();
    }
});