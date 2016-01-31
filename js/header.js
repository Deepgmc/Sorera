$(function () {
var over = false;
$(window).resize(function() {
    $('.wnd').each(function(){
        setWindowCenter($(this), 75, 75)
    })
})
$('body')
    .on('click', '#headerCnt', function () {
        var self = $(this),
            op = self.data('op'),
            sp = 300,
            logoCnt = $('#logoCnt')
        if (op == false || op === undefined) {
            closeAllWnds()
            self.css({'border-radius': '0 0 25px 25px', '-moz-border-radius': '0 0 25px 25px', '-webkit-border-radius': '0 0 25px 25px' });
            $('#revSalLinksCnt').hide()
            self.animate({
                    height:"500px",
                    width:"96%",
                    marginLeft:"2%"
                },
                sp,
                function(){
                    $('#hdrSTypeRow').show()
                    $('#comDataCnt').show()
                }
            )
            self.data('op', true)
            $('#dbd').fadeIn(300)
            logoCnt.css('width', '120px')
            $('#hdrNameRow').css({'font-size': '20px', 'font-weight': 'bold'})
            $('#hdrTypeRow').css('font-size', '18px')
            $('#starsHdr img').css('margin', '30px 0 0 0')
        } else {
            self.css({'border-radius': '0 0 25px 0', '-moz-border-radius': '0 0 25px 0', '-webkit-border-radius': '0 0 25px 0' });
            $('#revSalLinksCnt').show()
            self.animate({
                    height:"50px",
                    width:"45%",
                    marginLeft:"0%"
                },
                sp,
                function(){
                    self.css('overflow-y', 'hidden')
                    $('#hdrSTypeRow').hide()
                    $('#comDataCnt').hide()
                }
            )
            logoCnt.css('width', '60px')
            $('#dbd').fadeOut(300)
            $('#hdrNameRow').css({'font-size': '13px', 'font-weight': 'normal'})
            $('#hdrTypeRow').css('font-size', '10px')
            $('#starsHdr img').css('margin', '7px 0 0 0')
            self.data('op', false)
        }
    })
    .on('click', '#dbd, .closeBtn', function () {
        closeAllWnds()
    })
})