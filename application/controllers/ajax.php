<?php if ( ! defined('BASEPATH')) exit('Напрямую доступ запрещен');

class Ajax extends CI_Controller {

    public function redactCom(){
        require_once(APPPATH.'/helpers/makeEngWord.php');
        $data = array(
            'name' => $_POST['ncName'],
            'empNum' => $_POST['ncEmpNum'],
            'type' => $_POST['ncType'],
            'subType' => $_POST['ncSType'],
            'site' => $_POST['ncSite'],
            'city' => $_POST['ncCity'],
            'addr' => $_POST['ncAddr'],
            'metro' => $_POST['ncMetro'],
            'postIndex' => $_POST['ncIndex'],
            'phone' => $_POST['ncPhone'],
            'fax' => $_POST['ncFax'],
            'cMail' => $_POST['ncMail'],
            'dirName' => $_POST['ncDirName'].':'.$_POST['ncDirJN'],
            'descr' => trim($_POST['ncDescr'])
        );
        $cId = $_POST['cId'];
        $this->db->where('id', $cId);
        $this->db->update('companies', $data);
        $subId = intval($cId / 500);

        echo 'Updated: id = '.$cId.'<BR>subid = '.$subId.'<BR>';
        $comEngName = makeEngWord(trim($_POST['ncName'].'.jpg'));
        $dirEngName = makeEngWord(trim($_POST['ncDirName']));

        $path = $_SERVER['DOCUMENT_ROOT'].'/com/';
        @mkdir ($path.$subId, 0755);
        @mkdir ($path.$subId.'/'.$cId, 0755);
        @mkdir ($path.$subId.'/'.$cId.'/logo', 0755);
        @mkdir ($path.$subId.'/'.$cId.'/director', 0755);

        @rmdir($path.$subId.'/'.$cId.'/descr');
        @rmdir($path.$subId.'/'.$cId.'/fav');
        @rmdir($path.$subId.'/'.$cId.'/annual');
        @rmdir($path.$subId.'/'.$cId.'/files');

        if($_FILES['ncDirFoto']['tmp_name'] != ''){
            $dirH = opendir($_SERVER['DOCUMENT_ROOT'].'/com/'.$subId.'/'.$cId.'/director');
            while (($rF = @readdir($dirH)) !== false) {
                if ($rF == '.' || $rF == '..') continue;
                @unlink($rF);
            }
            move_uploaded_file($_FILES['ncDirFoto']['tmp_name'], $path.$subId.'/'.$cId.'/director/'.$dirEngName.'-'.$comEngName);
        }
        if($_FILES['ncLogo']['tmp_name'] == ''){
            die('End without logo. Success');
        }

        $dirH = opendir($_SERVER['DOCUMENT_ROOT'].'/com/'.$subId.'/'.$cId.'/logo');
        while (($rF = readdir($dirH)) !== false)
        {
            if($rF == '.' || $rF == '..') continue;
            @unlink($rF);
        }

        $SOURCE_img = $_FILES['ncLogo']['tmp_name'];
        $TARGET_img = $path.$subId.'/'.$cId.'/logo/'.$comEngName;

        $size = GetImageSize($SOURCE_img);
        $NEW_Y = 120; $NEW_X = 200;
        if ($size[0]<$NEW_X && $size[1]<$NEW_Y)
        {
            copy ( $SOURCE_img, $TARGET_img);
            unlink($SOURCE_img);
        }
        else
        {
            require_once($_SERVER['DOCUMENT_ROOT'].'/application/helpers/count_logo_XY.php');
            $tmp = count_logo_XY($size[0], $size[1], $NEW_Y, $NEW_X);
            $NEWX = $tmp[0]; $NEWY = $tmp[1];
            switch ($size[2])
            {
                case 1: // gif format
                    $source_img = imagecreatefromgif($source_img);
                    $target_img = ImageCreateTrueColor($NEWX, $NEWY);
                    ImageCopyResampled($target_img, $source_img, 0,0, 0,0, $NEWX, $NEWY, $size[0], $size[1]);
                    ImageJpeg($target_img, $TARGET_path, 70);
                    ImageDestroy($target_img);
                    ImageDestroy($source_img);
                    break;
                case 2: // jpg format
                    $source_img = imagecreatefromjpeg($SOURCE_img);
                    $target_img = ImageCreateTrueColor($NEWX, $NEWY);
                    ImageCopyResampled($target_img, $source_img, 0,0, 0,0, $NEWX, $NEWY, $size[0], $size[1]);
                    ImageJpeg($target_img, $TARGET_img, 70);
                    ImageDestroy($target_img);
                    ImageDestroy($source_img);
                    break;
                case 3: // png format
                    $source_img = imagecreatefrompng($SOURCE_img);
                    $target_img = ImageCreateTrueColor($NEWX, $NEWY);
                    ImageCopyResampled($target_img, $source_img, 0,0, 0,0, $NEWX, $NEWY, $size[0], $size[1]);
                    ImageJpeg($target_img, $TARGET_img);
                    ImageDestroy($target_img);
                    ImageDestroy($source_img);
                    break;
            }
            unlink($SOURCE_img);
        }
        die('End with logo. Success');
    }

    public function addNewCom(){
        require_once(APPPATH.'/helpers/makeEngWord.php');
        $data = array(
            'name' => $_POST['ncName'],
            'empNum' => $_POST['ncEmpNum'],
            'type' => $_POST['ncType'],
            'subType' => $_POST['ncSType'],
            'site' => $_POST['ncSite'],
            'city' => $_POST['ncCity'],
            'addr' => $_POST['ncAddr'],
            'metro' => $_POST['ncMetro'],
            'postIndex' => $_POST['ncIndex'],
            'phone' => $_POST['ncPhone'],
            'fax' => $_POST['ncFax'],
            'cMail' => $_POST['ncMail'],
            'dirName' => $_POST['ncDirName'].':'.$_POST['ncDirJN'],
            'descr' => trim($_POST['ncDescr'])
        );
        $this->db->insert('companies', $data);
        $cId = $this->db->insert_id();
        $subId = intval($cId / 500);

        echo $cId.'<BR>'.$subId.'<BR>';
        $comEngName = makeEngWord(trim($_POST['ncName'].'.jpg'));
        $dirEngName = makeEngWord(trim($_POST['ncDirName']));

        $path = $_SERVER['DOCUMENT_ROOT'].'/com/';
        mkdir ($path.$subId, 0755);
        mkdir ($path.$subId.'/'.$cId, 0755);
        mkdir ($path.$subId.'/'.$cId.'/logo', 0755);
        mkdir ($path.$subId.'/'.$cId.'/director', 0755);

        rmdir($path.$subId.'/'.$cId.'/descr');
        rmdir($path.$subId.'/'.$cId.'/fav');
        rmdir($path.$subId.'/'.$cId.'/annual');
        rmdir($path.$subId.'/'.$cId.'/files');

        if($_FILES['ncDirFoto']['tmp_name'] != ''){
            move_uploaded_file($_FILES['ncDirFoto']['tmp_name'], $path.$subId.'/'.$cId.'/director/'.$dirEngName.'-'.$comEngName);
        }
        $SOURCE_img = $_FILES['ncLogo']['tmp_name'];
        $TARGET_img = $path.$subId.'/'.$cId.'/logo/'.$comEngName;
        $size = GetImageSize($SOURCE_img);
        $NEW_Y = 120; $NEW_X = 200;
        if ($size[0]<$NEW_X && $size[1]<$NEW_Y)
        {
            copy ( $SOURCE_img, $TARGET_img);
            unlink($SOURCE_img);
        }
        else
        {
            require_once($_SERVER['DOCUMENT_ROOT'].'/application/helpers/count_logo_XY.php');
            $tmp = count_logo_XY($size[0], $size[1], $NEW_Y, $NEW_X);
            $NEWX = $tmp[0]; $NEWY = $tmp[1];
            switch ($size[2])
            {
                case 1: // gif format
                    $source_img = imagecreatefromgif($source_img);
                    $target_img = ImageCreateTrueColor($NEWX, $NEWY);
                    ImageCopyResampled($target_img, $source_img, 0,0, 0,0, $NEWX, $NEWY, $size[0], $size[1]);
                    ImageJpeg($target_img, $TARGET_path, 70);
                    ImageDestroy($target_img);
                    ImageDestroy($source_img);
                    break;
                case 2: // jpg format
                    $source_img = imagecreatefromjpeg($SOURCE_img);
                    $target_img = ImageCreateTrueColor($NEWX, $NEWY);
                    ImageCopyResampled($target_img, $source_img, 0,0, 0,0, $NEWX, $NEWY, $size[0], $size[1]);
                    ImageJpeg($target_img, $TARGET_img, 70);
                    ImageDestroy($target_img);
                    ImageDestroy($source_img);
                    break;
                case 3: // png format
                    $source_img = imagecreatefrompng($SOURCE_img);
                    $target_img = ImageCreateTrueColor($NEWX, $NEWY);
                    ImageCopyResampled($target_img, $source_img, 0,0, 0,0, $NEWX, $NEWY, $size[0], $size[1]);
                    ImageJpeg($target_img, $TARGET_img);
                    ImageDestroy($target_img);
                    ImageDestroy($source_img);
                    break;
            }
            unlink($SOURCE_img);
        }
        die('end');
    }
    public function getSType(){
        $type = $_POST['type'];
        if(!is_numeric($type))die('err post');
        $st = $this->db->get_where('comSubTypes', array('subTypeTypeId' => $type));
        echo json_encode($st->result());
    }
    public function delCom(){
        if(!is_numeric($_POST['cId'])){die();}
        $cId = $_POST['cId'];
        $this->db->delete('companies', array('id' => $cId));
        $this->db->delete('reviews', array('cId' => $cId));
        $this->db->delete('salary', array('cId' => $cId));
        //clean folders
    }
    public function sbmRevRequest(){
        $data = array(
            'revCapt' => $_POST['revCapt'],
            'city' => $_POST['cityCompany'],
            'cons' => $_POST['cons'],
            'pros' => $_POST['pros'],
            'position' => $_POST['position'],
            'globalRating' => $_POST['globalRating'],
            'adminMark' => $_POST['adminMark'],
            'cId' => $_POST['cId'],
            'date' => date('Y-m-d')
        );
        $this->db->insert('reviews', $data);
        $this->db->where('id', $_POST['cId']);
        $this->db->update('companies', array('haveReview' => 1));
    }
    public function addRev()
    {
        require($_SERVER['DOCUMENT_ROOT'].'/application/helpers/random_letters.php' );
        $errArr = array();
        $isOk = true;
        foreach($_POST AS $post_key => $post_val){
            switch($post_key){
                case 'stars':
                case 'sal':
                    if(!is_numeric($post_val) || $post_val == 0){
                        $errArr[] = $post_key;
                        $isOk = false;
                    }
                    break;
                case 'pros':
                case 'cons':
                    if(strlen($post_val) > 100000 || $post_val == ''){
                        $errArr[] = $post_key;
                        $isOk = false;
                    }
                    break;
                case 'com':
                case 'job':
                case 'city':
                    if(strlen($post_val) > 100 || $post_val == ''){
                        $errArr[] = $post_key;
                        $isOk = false;
                    }
                    break;
            }
            $okArr[$post_key] = $post_val;
        }
        if(!$isOk){
            echo json_encode($errArr);
        }
        else{
            $gen=random_word(10);
            $fileName = $_SERVER['DOCUMENT_ROOT'].'/application/tmp_files/tmp_reviews/'.$gen;

            echo $gen;
            $f = fopen($fileName, 'w');
            chmod($fileName, 0755);
            fwrite($f, 'date=>'.date('d-m-Y')."\n");
            fwrite($f, 'time=>'.date('h:i:s')."\n");
            foreach($okArr AS $key => $val){
                $val = preg_replace('/\\r\\n/', '<BR>', $val);
                $val = preg_replace('/\\n/', '<BR>', $val);
                fwrite($f, $key.'=>'.$val."\n");
            }
            fclose($f);
        }
    }
    public function delRevRequest(){
        if(unlink($_POST['file'])) echo json_encode(array('success' => 'yes'));
        else echo json_encode(array('success' => 'no'));
    }
    public function getComIdByName(){
        $this->db->select('id');
        $this->db->where('name', $_POST['cName']);
        $a = $this->db->get('companies', 1);
        $a = $a->result();
        echo json_encode($a[0]->id);
    }
    public function autocomplete($type)
    {
        $q = trim($_GET['query']);
        switch($type){
            case 'city':
                $this->load->model('ajax/autocomplete_model');
                $this->autocomplete_model->complete_city($q);
                break;
            case 'com':
                $this->load->model('ajax/autocomplete_model');
                $this->autocomplete_model->complete_com($q);
                break;
            default: die('Wrong query');
        }
    }
}
