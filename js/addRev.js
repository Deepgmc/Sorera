$(function(){
    $('#addRevStars').raty({
        hints: ['Очень плохо', 'Плохо', 'Нормально', 'Хорошо', 'Очень хорошо'],
        score: function() {
            return $(this).attr('data-score');
        }
    });
    $('body').on('click', '#sbmRev', function(){
        $('.addRevErr').hide();
        var stars = $('#addRevStars').raty('score'),
            sal = $('#addRevSal').val(),
            com = $('#addRevCom').val(),
            pros = $('#addRevPros').val(),
            cons = $('#addRevCons').val(),
            job = $('#addRevJob').val(),
            city = $('#addRevCity').val()
        errArr = [],
            errTxt = [],
            isOk = true;
        if(sal < 1 || sal > 200000 || !isnum(sal)){
            $('#err_addRevSal').show()
            errArr.push('Sal')
            errTxt.push('Выберите сумму зарплаты')
            isOk = false
        }
        if(stars < 1 || stars > 5 || !isnum(stars)){
            $('#err_addRevStars').show()
            errArr.push('Stars')
            errTxt.push('Выберите оценку компании')
            isOk = false
        }
        if(com.length < 4 || com.length > 300){
            errArr.push('Com')
            errTxt.push('Неверно введено название компании')
            isOk = false
        }
        if(city.length < 4 || city.length > 300){
            errArr.push('City')
            errTxt.push('Неверно введено название города')
            isOk = false
        }
        if(pros.length < 25){
            errArr.push('Pros')
            errTxt.push('Текст слишком короткий')
            isOk = false
        }
        if(cons.length < 25){
            errArr.push('Cons')
            errTxt.push('Текст слишком короткий')
            isOk = false
        }
        if(errArr.length > 0 && !isOk){
            for(var c1 in errArr){
                $('#err_addRev'+errArr[c1]).show();
                $('#err_addRev'+errArr[c1]).html(errTxt[c1]);
            }
            return false;
        }
        if(isOk){
            $.ajax({
                url: '/ajax/addRev',
                type: 'POST',
                data: {
                    com   : com,
                    stars : stars,
                    pros  : pros,
                    cons  : cons,
                    job   : job,
                    city  : city,
                    sal   : sal
                },
                success: function(json){
                    if($.isArray(json)){
                        alert('Ошибка сохранения');
                        return false;
                    }
                    $('#inputCnt').hide();
                    $('#thanksCnt').show();
                    $('#addRevCnt').css('top', 30 + 'px');
                    window.scroll(0,0);
                }
            });
        }
    })
    $('#addRevCity').devbridgeAutocomplete({
        serviceUrl: '/ajax/autocomplete/city',
        minChars: 2,
        maxHeight: 500,
        width: 500,
        zIndex: 9999,
        deferRequestBy: 300
    })
    $('#addRevCom').devbridgeAutocomplete({
        serviceUrl: '/ajax/autocomplete/com',
        minChars: 2,
        maxHeight: 500,
        width: 500,
        zIndex: 9999,
        deferRequestBy: 300
    })
    $("#addRevSal").ionRangeSlider({
        type: "single",
        hide_min_max: true,
        keyboard: true,
        min: 0,
        max: 200000,
        from: 15000,
        step: 1000,
        postfix: " руб",
        grid: true
    });
})