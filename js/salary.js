$(function(){
    $('body').on('click', '#filBtn', function(){
        var job = $('#filFilJob').val(),
            city = $('#filFilCity').val(),
            rcn = $(this).attr('rCn'),
            href = window.location.protocol + '//' + window.location.hostname + window.location.pathname;
        if(href[href.length-1] != '/') href += '/';
        if(job != '' || city != '') href += '?position=' + job + '&city=' + city;
        window.location.replace(href)
    }).on('keypress', '.filFilTxt', function(e){
        if(e.keyCode==13) $('#filBtn').trigger('click')
    }).on('click', '#clearFil', function(){
        $('#filFilJob').val('')
        $('#filFilCity').val('')
        href = window.location.protocol + '//' + window.location.hostname + window.location.pathname;
        window.location.replace(href)
    })
})