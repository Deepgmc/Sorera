$(function(){
    $('#searchField').devbridgeAutocomplete({
        serviceUrl: '/ajax/autocomplete/com',
        minChars: 2,
        maxHeight: 500,
        width: $('#searchField').width()+26,
        zIndex: 9999,
        deferRequestBy: 300,
        autoSelectFirst: false,
        beforeRender: function (container) {
            $('#searchField').css({'-webkit-border-radius': '20px 20px 0 0', '-moz-border-radius': '20px 20px 0 0', 'border-radius': '20px 20px 0 0'})
        },
        onHide: function (container) {
            $('#searchField').css({'-webkit-border-radius': '20px', '-moz-border-radius': '20px', 'border-radius': '20px'})
        },
        onSelect: function (suggestion) {
            $('#searchField').focus().data({'name': suggestion.value, 'id': suggestion.data})
            var e = $.Event('keypress');
            e.which = 13;
            //$('#searchField').trigger(e);
        }
    })
        .keypress(function(e){
            if(e.which == 13){
                var id  = $(this).data('id'),
                    name = $(this).data('name')
                if(name === undefined || id === undefined || name == '' || id == '') return false
                window.location.href = '/review/' + $(this).data('id') + '/' + $(this).data('name');
                return false
            }
        })
})