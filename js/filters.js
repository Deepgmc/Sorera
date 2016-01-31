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
        var ffj = $('#filFilJob'),
            ffc = $('#filFilCity')
        if(ffj.val() == '' && $ffc.val() == '') return false
        $('#filFilJob').val('')
        $('#filFilCity').val('')
        href = window.location.protocol + '//' + window.location.hostname + window.location.pathname;
        window.location.replace(href)
    })
    $('#filFilCity').devbridgeAutocomplete({
        serviceUrl: '/ajax/autocomplete/city',
        minChars: 2,
        maxHeight: 500,
        width: 500,
        zIndex: 9999,
        deferRequestBy: 300
    })
})