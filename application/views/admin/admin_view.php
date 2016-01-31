<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/css/bt/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="../../../js/admin.js"></script>

    <script src="/js/rateStars/lib/jquery.raty.js"></script>
    <script src="/js/functions.js"></script>

    <link rel="stylesheet" href="/js/rateStars/lib/jquery.raty.css">

    <script src="/js/autocomplete/dist/jquery.autocomplete.js"></script>
    <link rel="stylesheet" href="/js/autocomplete/content/styles.css">

    <link rel="stylesheet" href="/css/admin.css">
    <meta charset="UTF-8">
    <link rel="icon" href="/img/fav.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Админка</title>
</head>
<body>
<form action="admin" enctype="multipart/form-data" method="post">
    <input type="submit" name="logoutAdmin" value="Выйти">
</form>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-sm-12">
            <h3>Новая админка! С блэк-джэком и шлюхами</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-1 preBlock">&nbsp;</div>
        <div class="col-md-6 block">
            <h3>Отзывы</h3>
            <div class="row"><?
                $review = $rev = array();
                $files = get_filenames($_SERVER['DOCUMENT_ROOT'].'/application/tmp_files/tmp_reviews/', true);
                if(count($files) > 0){
                    foreach($files AS $file){
                        $review = explode("\n", read_file($file));
                        foreach($review as $key => $val){
                            if($val == '') continue;
                            $tmp = explode('=>', $val);
                            $revs[$file][$tmp[0]] = $tmp[1];
                        }
                    }
                    unset($files, $review);
                    $revn = count($revs);
                    $c1=-1;
                    foreach($revs AS $tmp1 => $rev){
                        $c1++;
                        ?>
                    <div class="container-fluid" id="container_<?=$c1?>">
                        <div class="row revCapt" opened="0" id="revCapt_<?=$c1?>">
                            <div class="col-md-12">
                                <div class="row"><div class="col-sm-12"><span class="glyphicon glyphicon-duplicate captIcon"></span><B><?=$rev['com']?></B></div></div>
                                <div class="row"><div class="col-sm-12 col-sm-offset-1"><?=dddd_mm_yy_ToView($rev['date'], 1, 'norm', 2)?> <I style="color:grey"><?=$rev['time']?></I></div></div>
                            </div>
                        </div>
                        <div class="row revContent" id="revContent_<?=$c1?>">

                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12 rowLineTxt">
                                        Заголовок отзыва. Заполняется самостоятельно
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 rowLineField">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-menu-hamburger"></span></span>
                                            <input type="text" class="form-control" maxlength="40" id="addRevCapt_<?=$c1?>" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12 rowLineTxt">
                                        Компания
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-11">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-menu-hamburger"></span></span>
                                            <input type="text" value="<?=$rev['com']?>" class="form-control addRevCom" maxlength="50" id="addRevCom_<?=$c1?>" autocomplete="off" aria-describedby="basic-addon1">
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-menu-hamburger"></span></span>
                                            <input type="text" placeholder="ВВЕСТИ ИД ИЛИ СКОМПОНОВАТЬ ВЫШЕ" class="form-control" maxlength="50" id="addRevcId_<?=$c1?>" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                    <div class="col-md-1"><span class="glyphicon glyphicon-transfer getRevComId" c1="<?=$c1?>"></span></div>
                                </div>
                            </div>

                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12 rowLineTxt">
                                        Положительноые стороны
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 rowLineField">
                                        <textarea class="form-control" id="addRevPros_<?=$c1?>" rows="3"><?=$rev['pros']?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12 rowLineTxt">
                                        Отрицательные стороны
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 rowLineField">
                                        <textarea class="form-control" id="addRevCons_<?=$c1?>" rows="3"><?=$rev['cons']?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12 rowLineTxt">
                                        Оценка компании юзером
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 rowLineField">
                                        <div id="addRevStars_<?=$c1?>" data-score="<?=$rev['stars']?>" class="stars"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12 rowLineTxt">
                                        Твоя оценка компании (adminMark)
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 rowLineField">
                                        <div id="addRevAdminMark_<?=$c1?>" data-score="0" class="stars"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12 rowLineTxt">
                                        Город
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 rowLineField">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-menu-hamburger"></span></span>
                                            <input type="text" id="addRevCity_<?=$c1?>" value="<?=$rev['city']?>" class="form-control" maxlength="40" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12 rowLineTxt">
                                        Должность
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 rowLineField">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-menu-hamburger"></span></span>
                                            <input type="text" id="addRevJob_<?=$c1?>" value="<?=$rev['job']?>" class="form-control" maxlength="40" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12 rowLineTxt">
                                        Зарплата
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 rowLineField">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-euro"></span></span>
                                            <input type="text" id="addRevSal_<?=$c1?>" value="<?=$rev['sal']?>" class="form-control" maxlength="40" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="container-fluid" style="margin-top:10px;">
                                <div class="row">
                                    <div class="col-md-12 rowLineTxt">
                                        <button type="button" class="btn btn-success sbmRev" id="sbmRev_<?=$c1?>" c1="<?=$c1?>">Добавить</button>
                                        <button type="button" class="btn btn-danger declRev" file="<?=$tmp1?>" id="declRev_<?=$c1?>" c1="<?=$c1?>">Отклонить</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        </div><?
                    }
                }//if files > 0
                else{echo '<div class="row"><div class="col-md-12">Нет новых отзывов</div></div>';}
                ?>
            </div>
        </div>

        <div class="col-md-1 preBlock">&nbsp;</div>

        <div class="col-md-3 block">
            <h3>Статистика</h3>
            <div class="row">
                <div class="col-md-12">
                    <img style="width:130px; height:130px;" src="../../img/dd.png">
                </div>
            </div>
        </div>

        <div class="col-md-1 preBlock">&nbsp;</div>
    </div>

    <div class="row">
        <div class="col-md-1 preBlock">&nbsp;</div>

        <div class="col-md-3 block">
            <div class="row">
                <div class="col-md-12 block">
                    <h3 style="color:red;">Не нажимать(!)</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <A id="testscriptLink" href="/admin/testscript">system(e).preventDefault(e.length)</A><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 block">
                    <h3 style="color:red;">Удаление компании</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" id="delComId" placeholder="cId">
                            <A id="delComBtn" href="#">Удалить ее нафиг</A><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-1 preBlock">&nbsp;</div>

        <div class="col-md-6 block">
            <h3>Добавление компании</h3>
            <form id="ncForm" enctype="multipart/form-data" action="ajax/addNewCom" target="p_a" method="POST">
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-primary">Название</p>
                        <input type="text" class="form-control" id="ncName" name="ncName">
                    </div>
                    <div class="col-md-12">
                        <p class="text-primary">Количество сотрудников</p>
                        <?
                        $r = $this->db->get('empNum');
                        ?>
                        <select id="ncEmpNum" name="ncEmpNum" class="form-control"><?
                            foreach ($r->result() as $enr)
                            {
                                ?>
                                <option value="<?=$enr->empNId?>"><?=$enr->empNName?></option><?
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
                            foreach($tr->result() as $id => $val){
                                ?>
                                <option value="<?=$val->typeId?>"><?=$val->typeName?></option>
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
                            foreach ($stt->result() as $val)
                            {
                                if($val->subTypeTypeId != 1) continue;
                                ?>
                                <option value="<?=$val->subTypeId?>"><?=$val->subTypeName?></option><?
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <p class="text-primary">Логотип</p>
                        <input id="ncLogo" name="ncLogo" type="file" class="form-control">
                    </div>

                    <div class="col-md-12">
                        <p class="text-primary">Сайт</p>
                        <input id="ncSite" name="ncSite" type="text" class="form-control">
                    </div>

                    <div class="col-md-12">
                        <p class="text-primary">Город</p>
                        <input id="ncCity" name="ncCity" type="text" class="form-control">
                    </div>

                    <div class="col-md-12">
                        <p class="text-primary">Адрес</p>
                        <input id="ncAddr" name="ncAddr" type="text" class="form-control">
                    </div>

                    <div class="col-md-12">
                        <p class="text-primary">Метро</p>
                        <input id="ncMetro" name="ncMetro" type="text" class="form-control">
                    </div>

                    <div class="col-md-12">
                        <p class="text-primary">Индекс</p>
                        <input id="ncIndex" name="ncIndex" type="text" class="form-control">
                    </div>

                    <div class="col-md-12">
                        <p class="text-primary">Телефон</p>
                        <input id="ncPhone" name="ncPhone" type="text" class="form-control">
                    </div>

                    <div class="col-md-12">
                        <p class="text-primary">Факс</p>
                        <input id="ncFax" name="ncFax" type="text" class="form-control">
                    </div>

                    <div class="col-md-12">
                        <p class="text-primary">Email</p>
                        <input id="ncMail" name="ncMail" type="text" class="form-control">
                    </div>

                    <div class="col-md-12">
                        <p class="text-primary">ФИО гендира</p>
                        <input id="ncDirName" name="ncDirName" type="text" class="form-control">
                    </div>

                    <div class="col-md-12">
                        <p class="text-primary">Должность гендира</p>
                        <input id="ncDirJN" name="ncDirJN" type="text" class="form-control">
                    </div>

                    <div class="col-md-12">
                        <p class="text-primary">Фото гендара (124 x 152 jpg)</p>
                        <input id="ncDirFoto" name="ncDirFoto" type="file" class="form-control">
                    </div>

                    <div class="col-md-12">
                        <p class="text-primary">Описание компании</p>
                        <textarea id="ncDescr" name="ncDescr" class="form-control"></textarea>
                    </div>

                    <div class="col-md-12">&nbsp;</div>

                    <div class="col-md-12">
                        <input id="ncAddBtn" type="button" class="btn btn-success" value="Добавить">
                    </div>

                    <div class="col-md-12">&nbsp;</div>

                </div>
            </form>
            <IFRAME name="p_a" frameborder="1" width="640" height="300" scrolling="yes"></IFRAME>
        </div>




        <div class="col-md-1 preBlock">&nbsp;</div>
    </div>

    <div class="row">
        <div class="col-md-1 preBlock">&nbsp;</div>

        <div class="col-md-6 block">
            <h3>Еще какойто блок</h3>
            <div class="row">
                <div class="col-md-12">
                    <input type="button" value="Action 1">
                    <input type="button" value="Action 2">
                    <br><br>
                    <img style="width:170px; height:170px;" src="../../img/ss.png">
                </div>
            </div>
        </div>


        <div class="col-md-1 preBlock">&nbsp;</div>




    </div>
</div>
<script type="text/javascript">
    $(function(){
        $('body').on('click', '#testscriptLink', function(e){
            if (confirm("Точно перейти к этому скрипту?")) {
                return true;
            } else {
                e.preventDefault();
                return false;
            }
        });
    })
</script>
</body>
</html>