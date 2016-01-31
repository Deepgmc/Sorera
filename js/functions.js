function setWindowCenter (cnt, persW, persH){
    var wh = Math.round( $(window).height() ),
        ww = Math.round( $(window).width() ),
        cntw = Math.round( ww * persW / 100 ),
        cnth = Math.round( wh * persH / 100 ),
        cntOffx = Math.round( (ww - cntw) / 2 ),
        cntOffy = Math.round( (wh - cnth) / 2),
        scrolled = window.pageYOffset || document.documentElement.scrollTop;
    cnt
        .width(cntw)
        .offset( { top: 40 + scrolled, left: cntOffx} )
        .css('position', 'absolute')
}
function isnum($a) {
    if ($a == 0)return true;
    return ($a / $a) ? true : false;
}
function closeAllWnds(){
    var hcnt = $('#headerCnt'),
        seacnt = $('#seaCnt'),
        headerOp = hcnt.data('op'),
        seaOp = seacnt.data('op')
    if (headerOp != false && headerOp !== undefined) {
        hcnt.trigger('click')
    }
    if (seaOp != false && seaOp !== undefined) {
        $('.ccBtn[id="ccSearchBtn"]').trigger('click')
    }
    $('#dbd').fadeOut(200).css('z-index', 11)
    $('.wnd').data({'opened': false}).fadeOut(100)
    $('#revSalLinksCnt').show()
}