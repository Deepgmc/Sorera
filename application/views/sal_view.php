<link rel="stylesheet" href="/css/salary.css">
<link rel="stylesheet" href="/js/ionSlider/css/ion.rangeSlider.css">
<link rel="stylesheet" href="/js/ionSlider/css/ion.rangeSlider.skinModern.css">
<script src="/js/ionSlider/js/ion-rangeSlider/ion.rangeSlider.js"></script>
<script src="/js/filters.js"></script>

<?
$salJob = encodeUrlParameter(@$_GET['position']);
$salCity = encodeUrlParameter(@$_GET['city']);
?>
<input type="hidden" id="this_page" value="<?=$this_page?>">
<div class="container">
    <div class="row" style="height:70px;">&nbsp;</div>
    <div class="row">
        <div class="filtersCnt">
            <div class="input-group input-group-sm">
                <label>должность <input class="form-control filFilTxt" id="filFilJob" type="text" value="<?=(isset($salJob)?$salJob:'')?>"></label>
                <label>город <input class="form-control filFilTxt" id="filFilCity" type="text" value="<?=(isset($salCity)?$salCity:'')?>"></label><BR>
                <input type="button" class="btn btn-sm btn-success" id="filBtn" value="найти" rcn="<?=@$gets[0]?>">
                <span id="clearFil">Убрать фильтры</span>
                <span id="filFilErr">Неверно заполнены поля</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
        <?php
        $minSal = $maxSal = 0;
        foreach($salData as $key => $s){
            if(!is_object($s)) {$salTotal = $s; continue;}
            ?><div class="salLine"><?
                if($s->minSal < $minSal) {$minSal = $s->minSal;}
                if($s->maxSal > $maxSal) {$maxSal = $s->maxSal;}
                if(strlen($s->req)>5 || strlen($s->terms)>5){
                    $haveDescr = true;
                } else {
                    $haveDescr = false;
                }
                echo '<span class="sP">'.$s->position.'</span><span class="jnY">'.dddd_mm_yy_ToView($s->addDate, 1, 'norm', 0).'</span><span class="sC">'.$s->city.'</span>';
                echo '<div class="salReq">'.(strlen($s->req)>5?'<B>Требования:</B> '.htmlspecialchars_decode(htmlspecialchars_decode($s->req)):'').'</div>
                <div class="salReq">'.(strlen($s->terms)>5?'<B>Условия:</B> '.htmlspecialchars_decode(htmlspecialchars_decode($s->terms)):'').'</div>';
                if($haveDescr){
                    ?><BR><h3 style="color:#373635">Зарплата на должности: "<?=$s->position?>"</h3><?
                }
                ?>
                <div disabled="disabled" data-score="Зарплата <?=$s->position?>" minSal="<?=$s->minSal?>" maxSal="<?=$s->maxSal?>" salCity="<?=$s->city?>" id="s_<?=$s->id?>" class="sal salary"></div>
            </div>
            <?
        }
        ?>
        </div>
    </div>
    <div class="row">
        <div class="pagesCnt">
            <?
                echo new pager_db($salTotal, (@$_GET['page']?$_GET['page']:1), $salOnPage, 1, $_GET);
            ?>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('.sal').each(function(){
            var self = $(this),
                maxSal = +self.attr('maxSal'),
                minSal = +self.attr('minSal')
            self.ionRangeSlider({
                type: 'double',
                grid: true,
                min: <?=$minSal?>,
                max: <?=$maxSal?>,
                from: +self.attr('minSal'),
                to: maxSal,
                postfix: ' рублей',
                from_fixed:true,
                to_fixed:true,
                prettify_separator: ',',
                force_edges:true
            })
        })
})
</script>