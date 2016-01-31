<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="../../../js/JQ.js"></script>
    <meta charset="UTF-8">
    <title>Тестовый</title>
</head>
<body>
<?
$this->benchmark->mark('s');



/**
 * Script 6
 * 29.06.2015
 * Делаем подтипы вакансий - в нормальном виде, в одной таблице
 * */
if(false) {
    $q = $this->db->get('comTypes');
    foreach ($q->result() as $row) {
        $typeId = $row->id;
        for ($c1 = 1; $c1 <= 54; $c1++) {
            $stId = 't' . $c1;
            echo $row->$stId . '<BR>';
        }
        die();
    }
}



/**
 * Script 5
 * 04.07.2015
 * ЧАСТЬ(!) перенесения описания компаний из папок в файлы.
 * В итоге закончено, скрипт не юзабелен.
 * */
if(false){
    $filename = $_SERVER['DOCUMENT_ROOT'].'/application/views/tmpDescr.csv';
    $row = 0;
    if (($handle = fopen($filename, "r")) !== FALSE) {
        $b = 0;
        while (($data = fgetcsv($handle, 10000000, ";")) !== FALSE) {
            $b++;
            $num = count($data);
            $row++;
            for ($c=0; $c < $num; $c++) {
                if($c==0) $cId = (int)$data[$c];
                else {
                    $txt = $data[$c];
                }
            }
            $data = array(
                'descr' => $txt
            );
            $this->db->where('id', $cId);
            $this->db->update('companies', $data);
        }
        fclose($handle);
    }

    $c1 = 0;
    foreach($a as $tmp => $val){
        echo '<BR><BR><B>BEGIN TMP: </B><BR>';
        print_r($tmp);
        echo '<BR><B>BEGIN VAL: </B><BR>';
        print_r($val);
        $c1++;
        if($c1>15)die();
    }
}




/**
 * Script 4
 * 6.06.2015
 * Удаление компаний, у которых нет ни зарплат ни отзывов
 * */
if(false) {
    $from = 500000; $to = 600000; $c = 0;
    $q = $this->db->query('select id, name from companies WHERE id >= ? AND id < ? ', array($from, $to));
    foreach ($q->result() as $a){
        $qSal = $this->db->query('select cId from salary where cId = ?', array($a->id));
        $nSal = $qSal->num_rows();
        $qRev= $this->db->query('select cId from reviews where cId = ?', array($a->id));
        $nRev = $qRev->num_rows();
        if($nSal < 1 && $nRev < 1){
            //echo '0:'.$a->name . ' (' . $a->id . ')<BR>';
            $c++;
            /*$id = $a->id;
            $subid=intval($id/500);
            $thisDir=$_SERVER['DOCUMENT_ROOT'].'/com/'.$subid.'/'.$id.'/descr'; $dirH = opendir($thisDir);
            while (($rFile = readdir($dirH)) !== false) {
                if ($rFile == '.' | $rFile == '..') continue;
                unlink($thisDir.'/'.$rFile);
            }
            $thisDir=$_SERVER['DOCUMENT_ROOT'].'/com/'.$subid.'/'.$id.'/files'; $dirH = opendir($thisDir);
            while (($rFile = readdir($dirH)) !== false) {
                if ($rFile == '.' | $rFile == '..') continue;
                unlink($thisDir.'/'.$rFile);
            }
            $thisDir=$_SERVER['DOCUMENT_ROOT'].'/com/'.$subid.'/'.$id.'/logo'; $dirH = opendir($thisDir);
            while (($rFile = readdir($dirH)) !== false) {
                if ($rFile == '.' | $rFile == '..') continue;
                unlink($thisDir.'/'.$rFile);
            }
            $thisDir=$_SERVER['DOCUMENT_ROOT'].'/com/'.$subid.'/'.$id.'/director'; $dirH = opendir($thisDir);
            while (($rFile = readdir($dirH)) !== false) {
                if ($rFile == '.' | $rFile == '..') continue;
                unlink($thisDir.'/'.$rFile);
            }
            $thisDir=$_SERVER['DOCUMENT_ROOT'].'/com/'.$subid.'/'.$id.'/fav'; $dirH = opendir($thisDir);
            while (($rFile = readdir($dirH)) !== false) {
                if ($rFile == '.' | $rFile == '..') continue;
                unlink($thisDir.'/'.$rFile);
            }
            $thisDir=$_SERVER['DOCUMENT_ROOT'].'/com/'.$subid.'/'.$id.'/annual'; $dirH = opendir($thisDir);
            while (($rFile = readdir($dirH)) !== false) {
                if ($rFile == '.' | $rFile == '..') continue;
                unlink($thisDir.'/'.$rFile);
            }
            $thisDir=$_SERVER['DOCUMENT_ROOT'].'/com/'.$subid.'/'.$id; $dirH = opendir($thisDir);
            while (($rFile = readdir($dirH)) !== false) {
                if ($rFile == '.' | $rFile == '..') continue;
                unlink($thisDir.'/'.$rFile);
            }*/
            $this->db->query('DELETE FROM companies WHERE id = ? LIMIT 1', $a->id);
        }
        else {
            //echo '1:'.$a->name . ' (' . $a->id . ')<BR>';
        }
    }
    echo '<BR>Deleted: '.$c . ' within '.$from.' - '.$to;
}

/**
 * Script 3
 * 6.06.2015
 * Удаление зарплат, которые не привязаны к компаниям
 * */
if(false) {
    $q = $this->db->query('DELETE FROM salary WHERE cId NOT IN (SELECT id FROM companies)');
}

/**
 * Script 2
 * 6.06.2015
 * слияние зарплат из таблиц по буквам в одну таблицу salary
 * */
if(false){
    $fromTbl = 'z';
    $c = 0;
    $job = '';
    $q = $this->db->query('
        SELECT companyId, jobName, city, q, minSal, maxSal, mediana, req, terms FROM '.$fromTbl.' s
        WHERE s.jobName IS NOT NULL AND s.jobName <> ""
        AND s.minSal IS NOT NULL AND s.minSAL <> 0
        AND s.maxSal IS NOT NULL AND s.maxSAL <> 0
        AND s.companyId IS NOT NULL AND s.companyId <> 0
        ');
    foreach ($q->result() as $a){
        $c++;
        if($a->city == '')$a->city='Москва';
        $ej = $a->jobName;
        $job = substr($a->jobName, 0, 1);
        if(
            $job == '.'
            || $job == ','
            || $job == '@'
            || $job == '"'
            || $job == '!'
            || $job == '('
            || $job == ')'
            || $job == ':'
            || $job == '+'
            || $job == '='
            || $job == '#'
            || $job == '-'
            || $job == '/'
            || $job == '{'
            || $job == '}'
            || $job == '*'
            || $job == '&'
            || $job == '^'
            || $job == '%'
            || $job == '$'
            || $job == '\''
            || $job == ''
            || $job == '•'
        ){
            $ej = substr($a->jobName, 1, strlen($a->jobName));
        }
        $this->db->query(
            'INSERT INTO salary
        (cId, position, city, q, minSal, maxSal, mediana, req, terms)
        VALUES
        (?,?,?,?,?,?,?,?,?)',
        array(
            $a->companyId,
            trim(strip_tags($ej)),
            trim(strip_tags($a->city)),
            $a->q,
            $a->minSal,
            $a->maxSal,
            $a->mediana,
            trim($a->req),
            trim($a->terms)));
    }
    echo $c;
}
/**
 * Script 1
 * 6.06.2015
 * слияние рекомендаций руководству и негативного поля в отзывах
 * */
if(false){
    $startId = 4000;
    $endId = 5000;
    $query = $this->db->query('
        SELECT idOld, recomendationsCompany, cons
        FROM company
        WHERE idOld > ? AND idOld <= ?
        AND recomendationsCompany IS NOT NULL',
        array($startId, $endId));
    foreach ($query->result() as $row)
    {
        $cons = $row->cons;
        $recom = $row->recomendationsCompany;
        $end = mysql_real_escape_string($cons . '<br />' . $recom);
        $this->db->query(
            'UPDATE company
        SET cons = "'. $end. '"
        WHERE idOld = '.$row->idOld.' LIMIT 1');
        $this->db->query(
            'UPDATE company
        SET recomendationsCompany = ""
        WHERE idOld = '.$row->idOld.' LIMIT 1');
    }
}


$this->benchmark->mark('e');
echo '<BR>DONE IN '.$this->benchmark->elapsed_time('s', 'e');
?>
</body>
</html>