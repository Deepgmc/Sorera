$(function(){
    $('body')
        .on('click', '#ncAddBtn', function(){
            $('#ncForm').submit();
            //window.location.reload()
        })
        .on('change', '#ncType', function(){
            var self = $(this),
                stype = $('#ncSType'),
                str = ''
            $.ajax({
                url: '/ajax/getSType',
                dataType: 'json',
                type: 'POST',
                data: {
                    type  : self.val()
                },
                success: function(json){
                    stype.empty()
                    for(var c1 in json){
                        str += '<option value="' + json[c1].subTypeId + '">' + json[c1].subTypeName + '</option>';
                    }
                    stype.append(str)
                }
            })
        })
        .on('click', '#delComBtn', function(){
            var self = $(this)
            $.ajax({
                url: '/ajax/delCom',
                type: 'POST',
                data: {
                    cId  : $('#delComId').val()
                },
                success: function(json){
                    console.log(json)
                }
            });
        })
        .on('click', '.revCapt', function(){
        var self = $(this),
            opened = self.attr('opened'),
            content = self.next('.revContent')
        if(opened == '0'){
            self.attr('opened', 1)
            content.slideDown(300)
        } else {
            self.attr('opened', 0)
            content.slideUp(300)
        }
    })
    .on('click', '.sbmRev', function(){
        var self = $(this),
            c1 = self.attr('c1'),
            stars = $('#addRevStars_'+c1).raty('score'),
            adminMark = $('#addRevAdminMark_'+c1).raty('score')
        if(stars == 0 || adminMark == 0 || stars == '' || stars == undefined || adminMark == '' || adminMark == undefined
        || stars > 5 || adminMark > 5){
            alert('Оценки проставить');
            return false;
        }
        if($('#addRevCapt_'+c1).val() == '') {
            alert('Заголовок вписать');
            return false;
        }
        if($('#addRevcId_'+c1).val() == '' || $('#addRevcId_'+c1).val() == undefined){
            alert('Сопоставить ид компании');
            return false;
        }
        $.ajax({
            url: '/ajax/sbmRevRequest',
            type: 'POST',
            data: {
                revCapt : $('#addRevCapt_'+c1).val(),
                pros : $('#addRevPros_'+c1).val(),
                cons  : $('#addRevCons_'+c1).val(),
                position   : $('#addRevJob_'+c1).val(),
                cityCompany  : $('#addRevCity_'+c1).val(),
                sal   : $('#addRevSal_'+c1).val(),
                cId   : $('#addRevcId_'+c1).val(),
                globalRating : stars,
                adminMark : adminMark
            },
            success: function(json){
                $('#declRev_'+c1).trigger('click', {file : self.attr('file'), cId : self.attr('cId')})
                $('#container_'+c1).slideUp(700, function(){$(this).remove();});
            }
        });
    })
    .on('click', '.declRev', function(){
        var self = $(this)
        $.ajax({
            url: '/ajax/delRevRequest',
            type: 'POST',
            dataType: 'json',
            data: {
                file : self.attr('file')
            },
            success: function(json){
                console.log(json)
                if(json.success == 'yes') {
                    //window.location.reload()
                }
                else {
                    alert('Err. Was not deleted!');
                }
            }
        });
    })
    .on('click', '.getRevComId', function(){
        var self = $(this),
            c1 = self.attr('c1'),
            cName = $('#addRevCom_'+c1).val();
        if(cName == '') return false;
        $.ajax({
            url: '/ajax/getComIdByName',
            type: 'POST',
            dataType: 'json',
            data: {
                cName : cName
            },
            success: function(json){
                json = parseInt(json);
                if(isnum(json)){
                    $('#addRevcId_'+c1).val(json);
                } else {
                    alert("Error get id");
                }
            }
        });
    })
    $('.stars').raty({
        hints: ['Очень плохо', 'Плохо', 'Нормально', 'Хорошо', 'Очень хорошо'],
        score: function () {
            return $(this).attr('data-score');
        }
    })
    $('.addRevCom').devbridgeAutocomplete({
        serviceUrl: '/ajax/autocomplete/com',
        minChars: 2,
        maxHeight: 500,
        width: 500,
        zIndex: 9999,
        deferRequestBy: 50
    })
})