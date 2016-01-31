<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="/css/bt/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <title>Редактирование компании</title>
    <style>
        .text-primary{
            font-weight:bold;
            font-size:16px;
            display:block;
            margin-top:30px;
        }
    </style>
</head>
<body>
<?
$cId = $_GET['footerCId'];
$this->benchmark->mark('s');



$a = new stdClass();
$this->db->select('*');
$this->db->from('companies');
$this->db->join('comTypes', 'comTypes.typeId = companies.type', 'left');
$this->db->join('comSubTypes', 'comSubTypes.subTypeId = companies.subType AND comSubTypes.subTypeTypeId = comTypes.typeId', 'left');
$this->db->join('empNum', 'empNum.empNId = companies.empNum', 'left');
$this->db->where('companies.id', $cId);
$a = $this->db->get();
$a = $a->result()[0];
?>

<div class="col-md-6 block">
            <h3>Редактирование компании</h3>
            <form id="ncForm" enctype="multipart/form-data" action="../ajax/redactCom" target="p_a" method="POST">
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-primary">Название</p>
                        <input type="text" class="form-control" id="ncName" name="ncName" value="<?=$a->name?>">
                    </div>
                    <div class="col-md-12">
                        <p class="text-primary">Количество сотрудников</p>
                        <?
                            $r = $this->db->get('empNum');
                        ?>
                        <select id="ncEmpNum" name="ncEmpNum" class="form-control"><?
                            foreach ($r->result() as $enr){?>
                                <option <?=($enr->empNId == $a->empNum ? 'selected':'')?> value="<?=$enr->empNId?>"><?=$enr->empNName?></option><?
                            }
                            ?>
                        </select>
                    </div><?
                ?>
                <div class="col-md-12">
                    <p class="text-primary">Тип</p>
                    <select id="ncType" name="ncType" class="form-control">
                        <?
                        $tr = $this->db->get('comTypes');
                        foreach($tr->result() as $id => $val){?>
                            <option <?=($val->typeId == $a->type ? 'selected':'')?> value="<?=$val->typeId?>"><?=$val->typeName?></option>
                            <?
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-12">
                    <p class="text-primary">Подтип</p>
                    <?
                    $stt = $this->db->get('comSubTypes');
                    ?>
                    <select id="ncSType" name="ncSType" class="form-control"><?
                        foreach ($stt->result() as $val){
                            if($val->subTypeTypeId != 1) continue;
                            ?>
                            <option <?=($val->subTypeTypeId == $a->subType ? 'selected':'')?> value="<?=$val->subTypeId?>"><?=$val->subTypeName?></option><?
                        }
                        ?>
                    </select>
                </div>
                <?
                    $subId = intval($cId/500);
                    $dirH = opendir($_SERVER['DOCUMENT_ROOT'].'/com/'.$subId.'/'.$cId.'/logo');
                    $logoFName = '';
                    while (($rF = @readdir($dirH)) !== false)
                    {
                        if($rF == '.' || $rF == '..') continue;
                        $logoFName = $rF;
                        break;
                    }
                ?>
                <div class="col-md-12">
                    <p class="text-primary">Логотип</p>
                    <?
                    if($logoFName != ''){
                    ?><IMG src = "/com/<?=$subId?>/<?=$cId?>/logo/<?=$logoFName?>"><?
                    } else {
                        ?><p>Нет логотипа</p><?
                    }
                    ?>
                    <input id="ncLogo" name="ncLogo" type="file" class="form-control">
                </div>

                <div class="col-md-12">
                    <p class="text-primary">Сайт</p>
                    <input id="ncSite" name="ncSite" type="text" class="form-control" value="<?=$a->site?>">
                </div>

                <div class="col-md-12">
                    <p class="text-primary">Город</p>
                    <input id="ncCity" name="ncCity" type="text" class="form-control" value="<?=$a->city?>">
                </div>

                <div class="col-md-12">
                    <p class="text-primary">Адрес</p>
                    <input id="ncAddr" name="ncAddr" type="text" class="form-control" value="<?=$a->addr?>">
                </div>

                <div class="col-md-12">
                    <p class="text-primary">Метро</p>
                    <input id="ncMetro" name="ncMetro" type="text" class="form-control" value="<?=$a->metro?>">
                </div>

                <div class="col-md-12">
                    <p class="text-primary">Индекс</p>
                    <input id="ncIndex" name="ncIndex" type="text" class="form-control" value="<?=$a->postIndex?>">
                </div>

                <div class="col-md-12">
                    <p class="text-primary">Телефон</p>
                    <input id="ncPhone" name="ncPhone" type="text" class="form-control" value="<?=$a->phone?>">
                </div>

                <div class="col-md-12">
                    <p class="text-primary">Факс</p>
                    <input id="ncFax" name="ncFax" type="text" class="form-control" value="<?=$a->fax?>">
                </div>

                <div class="col-md-12">
                    <p class="text-primary">Email</p>
                    <input id="ncMail" name="ncMail" type="text" class="form-control" value="<?=$a->cMail?>">
                </div>
                <?
                $dir = explode(':', $a->dirName);
                $dirName = $dir[0];
                $dirJob = $dir[1];
                ?>
                <div class="col-md-12">
                    <p class="text-primary">ФИО гендира</p>
                    <input id="ncDirName" name="ncDirName" type="text" class="form-control" value="<?=$dirName?>">
                </div>

                <div class="col-md-12">
                    <p class="text-primary">Должность гендира</p>
                    <input id="ncDirJN" name="ncDirJN" type="text" class="form-control" value="<?=$dirJob?>">
                </div>

                <div class="col-md-12">
                    <p class="text-primary">Фото гендира (124 x 152 jpg)</p>
                    <?
                    $dirH = opendir($_SERVER['DOCUMENT_ROOT'].'/com/'.$subId.'/'.$cId.'/director');
                    while (($rF = @readdir($dirH)) !== false) {
                        if ($rF == '.' || $rF == '..') continue;
                        $fotoFName = $rF;
                        break;
                    }
                    if($fotoFName != '') {
                        $str = '';
                    } else {
                        $str = 'Фото нет';
                    }
                    ?>
                        <?
                        if($str != ''){?>
                            <p><?=$str?></p><?
                        } else {
                            ?><img src="/com/<?=$subId?>/<?=$cId?>/director/<?=$fotoFName?>"><?
                        }
                        ?>
                    <input id="ncDirFoto" name="ncDirFoto" type="file" class="form-control">
                </div>

                <div class="col-md-12">
                    <p class="text-primary">Описание компании</p>
                    <textarea id="ncDescr" name="ncDescr" class="form-control" cols="70" rows="15"><?=$a->descr?></textarea>
                </div>

                <div class="col-md-12">&nbsp;</div>

                <div class="col-md-12">
                    <input id="ncAddBtn" type="submit" class="btn btn-success" value="Сохранить новые данные">
                </div>

                <div class="col-md-12">&nbsp;</div>

                </div>
                <input type="hidden" name="cId" value="<?=$cId?>">
            </form>
<IFRAME name="p_a" frameborder="1" width="640" height="300" scrolling="yes"></IFRAME>
</div>
<script type="text/javascript">
    lastSTypeVal = <?=($a->subType?$a->subType:0)?>;
    //ставим подтип в зависимости от типа после загрузки
    var self = $('#ncType'),
        stype = $('#ncSType'),
        str = ''
    $.ajax({
        url: '../ajax/getSType',
        dataType: 'json',
        type: 'POST',
        data: {
            type  : self.val()
        },
        success: function(json){
            stype.empty()
            for(var c1 in json){
                str += '<option ' + (lastSTypeVal==json[c1].subTypeId ? 'selected="selected"' : '') + ' value="' + json[c1].subTypeId + '">' + json[c1].subTypeName + '</option>';
            }
            stype.append(str)
        }
    })
    //ставим подтип в зависимости от типа при смене типа
    $('body').on('change', '#ncType', function(){
        var self = $(this),
            stype = $('#ncSType'),
            str = ''
        $.ajax({
            url: '../ajax/getSType',
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
    .on('click', '#ncAddBtn2', function(){
        $('#ncAddBtn').click()
    })
</script>
<?
$this->benchmark->mark('e');
echo('<BR>DONE IN '.$this->benchmark->elapsed_time('s', 'e'));
?>
<BR><BR><a href="/review/<?=$cId?>/<?=$a->name?>">К профилю компании</a>
<BR><BR><input id="ncAddBtn2" type="button" class="btn btn-success" value="Сохранить новые данные">
<BR><BR>Id: <?=$cId?> Subid: <?=$subId?>
</body>
</html>