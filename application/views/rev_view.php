<link rel="stylesheet" href="/css/review.css">
<script src="/js/filters.js"></script>

<?
$revJob = encodeUrlParameter(@$_GET['position']);
$revCity = encodeUrlParameter(@$_GET['city']);
?>
<input type="hidden" id="this_page" value="<?=$this_page?>">
<div class="container">
    <div class="row" style="height:70px;">&nbsp;</div>
    <div class="row">
        <div class="filtersCnt">
            <div class="input-group input-group-sm">
                <label>должность <input class="form-control filFilTxt" id="filFilJob" type="text" value="<?=(isset($revJob)?$revJob:'')?>"></label>
                <label>город <input class="form-control filFilTxt" id="filFilCity" type="text" value="<?=(isset($revCity)?$revCity:'')?>"></label><BR>
                <input type="button" class="btn btn-sm btn-success" id="filBtn" value="найти" rcn="<?=@$gets[0]?>">
                <span id="clearFil">Убрать фильтры</span>
                <span id="filFilErr">Неверно заполнены поля</span>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top:40px;">
        <?php
        $num = count($revData);
        foreach($revData as $key => $s){
            if(!is_object($s)) {$revTotal = $s; continue;}
            ?>
            <div class="row">
                <div class="col-sm-12 rev-cnt">
                    <div class="row rev-capt">
                        <div class="col-sm-12">
                            <h3><span class="omh"><span class="orMark">&nbsp;</span></span><?= $s->revCapt ?></h3>
                        </div>
                    </div>
                    <div class="row rev-txt">
                        <div class="col-sm-3">
                            <div class="revLL" style="font-weight:bold;"><?
                                echo $s->position;
                                ?></div>
                            <div class="revLL">
                                <?
                                $rate = $s->globalRating;
                                for ($c1 = 1; $c1 <= 5; $c1++) {
                                    if ($c1 <= $rate) {
                                        ?><img src="/img/stars/star_g_s.png"><?
                                    } else {
                                        ?><img src="/img/stars/star_b_s.png"><?
                                    }
                                }
                                ?>
                            </div>
                            <div class="revLL"><?
                                echo $s->city;
                                ?>
                            </div>
                            <div class="revLL"><?
                                echo dddd_mm_yy_ToView($s->date, 1, 'norm', 0);
                                ?>
                            </div>
                        </div>
                        <div class="col-sm-9" style="padding:10px 30px 0 0;">
                            <p><?= htmlspecialchars_decode(htmlspecialchars_decode(str_replace('\\', '', $s->pros))) ?></p>
                            <p><?= htmlspecialchars_decode(htmlspecialchars_decode(str_replace('\\', '', $s->cons))) ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="row">
        <div class="pagesCnt">
            <?
            echo new pager_db($revTotal, (@$_GET['page']?$_GET['page']:1), $revOnPage, 1, $_GET);
            ?>
        </div>
    </div>
</div>