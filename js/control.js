$(function(){
    $('#addRevCnt').data({'opened': false});
    $('body').on('click', '.ccBtn', function(){
        var self = $(this),
            id = self.attr('id'),
            dbd = $('#dbd')
        switch(id){
            case 'ccSearchBtn':
                var seaCnt = $('#seaCnt'),
                    op = seaCnt.data('op'),
                    c = '4px solid green'
                $('#seaTxt').val('')
                if (!op || op === undefined) {
                    seaCnt.css('border-left', c)
                    closeAllWnds()
                    seaCnt.animate({
                            width:'510px',
                            marginLeft:'-447px'
                        },
                        600,
                        function(){
                            $('#seaBodyCnt').fadeIn(100)
                            dbd.fadeIn(300).css('z-index', 14)
                        }
                    )
                    seaCnt.data('op', true)
                } else {
                    $('#seaBodyCnt').hide()
                    seaCnt.animate({
                            width:'63px',
                            marginLeft:'0px'
                        },
                        300,
                        function(){
                            seaCnt.css('border-left', 'none')
                            dbd.hide().css('z-index', 11)
                        }
                    )
                    seaCnt.data('op', false)
                }
                break;
            case 'ccAddBtn':
                var wnd = $('#addRevCnt')
                if(wnd.data('opened') == false) {
                    wnd.fadeIn(300).data({'opened': true});
                    dbd.fadeIn(300)
                    setWindowCenter(wnd, 60, 75);
                    $('#inputCnt').show();
                    $('#thanksCnt').hide();
                    $('#dbd').css('z-index', 14)
                }
                break;
            default:break;
        }
    })
})