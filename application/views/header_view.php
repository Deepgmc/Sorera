<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <link rel="icon" href="/img/fav.ico" type="image/x-icon">
    <link rel="stylesheet" href="/css/bt/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

    <script src="/js/rateStars/lib/jquery.raty.js"></script>
    <link rel="stylesheet" href="/js/rateStars/lib/jquery.raty.css">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?
    if($this_page == 'review'){
        $tit = $comData->name.': отзывы сотрудников о компании';
    } else if($this_page == 'salary'){
        $tit = 'Зарплаты в компании '. $comData->name;
    }
    ?>
    <title><?=$tit?></title>
</head>
<body com-id="<?=$comData->id?>" com-name="<?=$comData->name?>">
<div id="dbd">&nbsp;</div>
<?
$media = 'sm';
?>
<div class="container" id="headerCnt">
    <div class="row">
        <div class="col-<?=$media?>-2" id="hdr1">
            <div id="logoCnt">
                <?
                if(file_exists($_SERVER['DOCUMENT_ROOT'].'/com/'.$logoData->subId.'/'.$comData->id.'/logo/'.$logoData->logoFName) && $logoData->logoFName != ''){
                    ?><IMG id="logo" title="<?=$comData->name?>" src = "/com/<?=$logoData->subId?>/<?=$comData->id?>/logo/<?=$logoData->logoFName?>"><?
                } else {
                    ?><IMG id="logo" src = "/img/no_logo.jpg"><?
                }
                ?>
            </div>
        </div>
        <div class="col-<?=$media?>-6" id="hdr2">
            <div class="row" id="hdrNameRow">
                <div class="col-md-12"><?
                    echo '<strong>'.$comData->name.'</strong>';
                    ?></div>
            </div>
            <div class="row" id="hdrTypeRow">
                <div class="col-md-12"><?
                    echo $comData->typeName;
                    ?></div>
            </div>
            <div class="row" id="hdrSTypeRow">
                <div class="col-md-12"><?
                    echo $comData->subTypeName;
                    ?></div>
            </div>
        </div>
        <div class="col-<?=$media?>-4" id="hdr3">
            <div id="starsHdr">
                <?php
                $rate = $comData->global;
                for ($c1 = 1; $c1 <= 5; $c1++) {
                    if ($c1 <= $rate) {
                        ?><img src="/img/stars/star_g_l.png"><?
                    } else {
                        ?><img src="/img/stars/star_b_l.png"><?
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-<?=$media?>-12" id="comDataCnt">
            <div class="col-<?=$media?>-5 comDirBlk">
                <div class="row">
                    <div class="col-<?=$media?>-7" style="font-size:14px;">
                        <BR><BR>
                        <strong><?=$comData->subTypeName?></strong>
                        <BR>
                        Сотрудников <?=$comData->empNName?>
                        <BR><BR>
                        <?
                        $dirName = explode(':', $comData->dirName);
                        ?>
                        <?=($dirName[1] != '' ? $dirName[0] .',<BR>'.$dirName[1] .' компании' : 'Руководитель компании: '.$dirName[1] )?>
                    </div>
                    <div class="col-<?=$media?>-3">
                        <?
                        if($dirData->fotoFName != 'nodir'){
                            ?><img class="dirFoto" title="<?=$comData->name?>" src="/com/<?=$dirData->subId?>/<?=$comData->id?>/director/<?=$dirData->fotoFName?>"><?
                        }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="contactWrapper">&nbsp;</div>
                    <?=$comData->city?>, <?=$comData->addr?> <?=($comData->postIndex!=''?'('.$comData->postIndex.')':'')?><BR>
                    <?
                    if($comData->metro != '')
                    {
                        if( isset($metroData) && $metroData != '' )
                        {
                            switch($comData->city){
                                case 'Москва':$metroImg='msk.png';break;
                                case 'Санкт-Петербург':$metroImg='spb.png'; break;
                                case 'Киев': $metroImg='kiev.png';break;
                                case 'Харьков': $metroImg='harkov.png';break;
                                case 'Минск': $metroImg='spb.png';break;
                            }
                            if(isset($metroImg)) {
                                ?>
                                <IMG alt="Станция метро <?=$comData->name?>" title="Станция метро <?=$comData->name?>" src="/img/metro/<?=$metroImg?>">
                                <span style="font-size:11px; color:<?=$metroData?>"><?=$comData->metro?></span>
                                <?
                            }
                        }
                    }
                    ?>
                    <BR>
                    <?=$comData->phone?>
                    <BR>
                    <?=(substr($comData->site, 0, 3)=='www'?$comData->site:'www.'.$comData->site)?>
                </div>
            </div>
            <div class="col-<?=$media?>-7" style="font-size:13px;text-indent:30px;width:55%;">
                <?=htmlspecialchars_decode(htmlspecialchars_decode($comData->descr))?>
            </div>
            <div class="row">
                <div class="col-<?=$media?>-12">

                </div>
            </div>
        </div>
    </div>
</div>
<?
if($this_page == 'review') {
    $p = 'salary'; $t = 'зарплаты в компании ';
} else {
    $p = 'review'; $t = 'отзывы о компании ';
}
?><a  id="revSalLinksCnt" href="/<?=$p?>/<?=$comData->id?>/<?=$comData->name?>"><?=$t.$comData->name?></a>