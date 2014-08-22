function filmstrip() {
    var slideSpeed  = 400;
    var cellWidth   = $('.cell').first().width();
    console.log(cellWidth);
    var viewWidth   = $('#viewable').innerWidth();
    var filmWidth   = $('#filmstrip').innerWidth();
    var maxSlide    = -(filmWidth-viewWidth);
    var pos         = $('#filmstrip').position();

    function addNavFunctions() {
        $('#filmstrip-next').click(function() {
            nxtImg();
            return false;
        });
        $('#filmstrip-prev').click(function() {
            prevImg();
            return false;
        });
    }
    function removeNavFunctions() {
        $('#filmstrip-next').unbind('click');
        $('#filmstrip-prev').unbind('click');
    }
    function navReturnFalse() {
        $('#filmstrip-next').click(function() {return false;});
        $('#filmstrip-prev').click(function() {return false;});
    }
    function updatePosition() {        
        pos = $('#filmstrip').position();
    }
/*    function updateViewWidth() {
        viewWidth = $('#viewable').innerWidth(); // not updated, revisit this
    }*/
    function endAnimate() {
        addNavFunctions();
    }
    function nxtImg() {
        updatePosition();
        if (pos.left >= maxSlide) {
            removeNavFunctions(); // remove nav functions to prevent slides from sliding beyond boundary
            navReturnFalse(); // prevent page from moving to anchor link with double clicks
            $('#filmstrip').animate({'left': '-=' +cellWidth}, slideSpeed, 'swing', endAnimate);
        }
    }
    function prevImg() {
        updatePosition();
        if (pos.left < 0) {
            removeNavFunctions(); // remove nav functions to prevent slides from sliding beyond boundary
            navReturnFalse(); // prevent page from moving to anchor link with double clicks
            $('#filmstrip').animate({'left': '+=' +cellWidth}, slideSpeed, 'swing', endAnimate);
        }
    }
    addNavFunctions();
}