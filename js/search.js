$(function(){
    $('#seaTxt')
        .devbridgeAutocomplete({
            serviceUrl: '/ajax/autocomplete/com',
            minChars: 2,
            maxHeight: 500,
            width: '396px',
            zIndex: 9999,
            deferRequestBy: 200,
            autoSelectFirst:true,
            onSelect: function (suggestion) {
                $('#seaTxt').data({'name': suggestion.value, 'id': suggestion.data})
            }
        })
        .keypress(function(e){
            if(e.which == 13){
                window.location.href = '/' + $('#this_page').val() + '/' + $(this).data('id') + '/' + $(this).data('name');
                return false
            }
        })
})