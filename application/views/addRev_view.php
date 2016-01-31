<link rel="stylesheet" href="/css/addRev.css">
<script src="/js/addRev.js"></script>

<script src="/js/autocomplete/dist/jquery.autocomplete.js"></script>

<script src="/js/ionSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
<link rel="stylesheet" href="/js/ionSlider/css/ion.rangeSlider.css">
<link rel="stylesheet" href="/js/ionSlider/css/ion.rangeSlider.skinHTML5.css">

<div id="addRevCnt" class="wnd">
    <span class="glyphicon glyphicon-remove closeBtn"></span>
    <div class="container-fluid" id="thanksCnt">
        <div class="row">
            <div class="col-md-12">
                <h3 style="color:darkgreen;margin-top:40px;margin-bottom:30px;text-align: center;"><B>Спасибо!</B><BR><BR>Ваш отзыв отправлен на проверку и вскоре будет добавлен!</h3>
            </div>
        </div>
    </div>
    <div class="container-fluid" id="inputCnt">
        <div class="row">
            <div class="col-md-12">
                <h4>Пожалуйста, расскажите о компании в которой работаете</h4>
            </div>
        </div>

        <div class="row">
            <div class="row">
                <div class="col-md-7">Название компании</div>
                <div class="col-md-5 addRevErr" id="err_addRevCom">Ошибка</div>
            </div>
            <div class="row">
                <div class="col-md-12" style="font-size:11px;color:grey;">Вы можете ввести любое название компании и мы добавим таковую. Уточните, если надо, в тексте отзыва</div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-text-background"></span></span>
                        <input type="text" value="<?=$comData->name?>" class="form-control addRevTxt" maxlength="40" id="addRevCom" aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="row">
                <div class="col-md-7">Ваша общая оценка этой компании</div>
                <div class="col-md-5 addRevErr" id="err_addRevStars">Ошибка</div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="addRevStars"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="row">
                <div class="col-md-7">Опишите, что именно вам понравилось</div>
                <div class="col-md-5 addRevErr" id="err_addRevPros">Ошибка</div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <textarea class="addRevTA" id="addRevPros" placeholder="опишите что вы заметили положительного в атмосфере, коллективе, руководстве и т.д."></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="row">
                <div class="col-md-7">Опишите, что вам не понравилось</div>
                <div class="col-md-5 addRevErr" id="err_addRevCons">Ошибка</div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <textarea class="addRevTA" id="addRevCons" placeholder="опишите что вам не понравилось в этой компании, в коллективе, руководстве и т.д."></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="row">
                <div class="col-md-7">Ваша должность</div>
                <div class="col-md-5 addRevErr" id="err_addRevJob">Ошибка</div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-knight"></span></span>
                        <input type="text" placeholder="должность указать желательно, но необязательно" class="form-control addRevTxt" id="addRevJob" aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="row">
                <div class="col-md-7">Город, где вы работали</div>
                <div class="col-md-5 addRevErr" id="err_addRevCity">Ошибка</div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-tent"></span></span>
                        <input type="text" class="form-control addRevTxt" maxlength="30" id="addRevCity" autocomplete="off" aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="row">
                <div class="col-md-7">Ваша зарплата</div>
                <div class="col-md-5 addRevErr" id="err_addRevSal">Ошибка</div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <input id="addRevSal" type="text">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div value="Отправить отзыв" id="sbmRev"><span class="glyphicon glyphicon-saved"></span></div>
            </div>
        </div>

    </div>
</div>