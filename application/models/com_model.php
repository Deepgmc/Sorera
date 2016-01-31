<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Com_model extends CI_Model {

    function get_hdr_com_info($cId) {
        $a = new stdClass();
        $this->db->select('*');
        $this->db->from('companies');
        $this->db->join('comTypes', 'comTypes.typeId = companies.type', 'left');
        $this->db->join('comSubTypes', 'comSubTypes.subTypeId = companies.subType AND comSubTypes.subTypeTypeId = comTypes.typeId', 'left');
        $this->db->join('empNum', 'empNum.empNId = companies.empNum', 'left');
        $this->db->where('companies.id', $cId);
        $a = $this->db->get();
        $a = $a->result();
        return $a[0];
    }

    function get_com_metro($cId){
        $this->db->select('metColor');
        $this->db->from('companies');
        $this->db->join('metro', 'companies.city = metro.metCity AND companies.metro = metro.metName', 'left');
        $this->db->where('companies.id', $cId);
        $a = $this->db->get();
        $a = $a->result();
        $a = $a[0]->metColor;
        switch($a)
        {
            case 'red': $mcolor ='red;'; break;
            case 'green': $mcolor ='#060;';break;
            case 'violet': $mcolor='#5A0699;';break;
            case 'blue': $mcolor='#009;';break;
            case 'yellow': $mcolor='#B7A313;';break;
            case 'lGreen': $mcolor='#80E67D;';break;
            case 'brown': $mcolor='#630;';break;
            case 'lBlue': $mcolor='#09F;';break;
            case 'grey': $mcolor='grey';break;
            case 'orange': $mcolor='#F60;';break;
            default: $mcolor='#000;';break;
        }
        return $mcolor;
    }

    /**
     * @param $cId
     * @param $revOnPage
     * @return mixed
     */
    function get_com_reviews($cId, $revOnPage){
        $revCity = encodeUrlParameter(@$_GET['city']);
        $revJob = encodeUrlParameter(@$_GET['position']);
        $page = @$_GET['page'];
        if(strlen($revCity) > 30) die('Error city parameter');
        if(isset($page) && (!is_numeric($page) || $page < 1 || $page=='')) die('Wrong page');

        $ft = $this->countFromToPages($page, $revOnPage);$from = $ft[0];$to = $ft[1];

        $this->db->select('*')->from('reviews')->where('cId', $cId)->like('city', $revCity)->like('position', $revJob)->limit($to, $from)->order_by('date DESC, adminMark DESC');
        $a = $this->db->get()->result();

        $this->db->select('COUNT(*)')->from('reviews')->where('cId', $cId)->like('city', $revCity)->like('position', $revJob);
        $a['revNum'] = $this->db->count_all_results();

        return $a;
    }

    /**
     * @param $cId
     * @param $salOnPage
     * @return mixed
     */
    function get_com_salary($cId, $salOnPage){
        $salCity = encodeUrlParameter(@$_GET['city']);
        $salJob = encodeUrlParameter(@$_GET['position']);
        $page = @$_GET['page'];
        if(strlen($salCity) > 30) die('Error city parameter');

        if(isset($page) && (!is_numeric($page) || $page < 1 || $page=='')) die('Wrong page');

        $ft = $this->countFromToPages($page, $salOnPage);$from = $ft[0];$to = $ft[1];

        $this->db->select('*')->from('salary')->where('cId', $cId)->like('city', $salCity)->like('position', $salJob)->limit($to, $from)->order_by('addDate DESC, minSal DESC');
        $a = $this->db->get()->result();

        $this->db->select('COUNT(*)')->from('salary')->where('cId', $cId)->like('city', $salCity)->like('position', $salJob);
        $a['salNum'] = $this->db->count_all_results();
        return $a;
    }

    function get_com_logo($cId){
        $a = new stdClass();
        $subId = intval($cId/500);
        $dirH = opendir($_SERVER['DOCUMENT_ROOT'].'/com/'.$subId.'/'.$cId.'/logo');
        while (($rF = @readdir($dirH)) !== false)
        {
            if($rF == '.' || $rF == '..') continue;
            $logoFName = $rF;
            break;
        }
        $a->logoFName = $logoFName;
        $a->subId = $subId;
        return $a;
    }
    function get_dir_foto($cId){
        $a = new stdClass();
        $subId = intval($cId/500);
        $dirH = opendir($_SERVER['DOCUMENT_ROOT'].'/com/'.$subId.'/'.$cId.'/director');
        while (($rF = @readdir($dirH)) !== false) {
            if ($rF == '.' || $rF == '..') continue;
            $fotoFName = $rF;
            break;
        }
        if($fotoFName != '') {
            $a->fotoFName = $fotoFName;
            $a->subId = $subId;
        } else {
            $a->fotoFName = 'nodir';
            $a->subId = 0;
        }
        return $a;
    }
    private function countFromToPages($page, $onPage){
        if($page == '' || !isset($page)) $page = 1;
        $from = ($page-1) * $onPage;
        $to = $from + $onPage;
        return array(($page-1) * $onPage, $from + $onPage);
    }
}