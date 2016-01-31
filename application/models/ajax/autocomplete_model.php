<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Autocomplete_model extends CI_Model {
    function complete_city($q) {
        $a = new stdClass();
        $this->db->select('name');
        $this->db->from('cities');
        $this->db->like('name', $q, 'after');
        $this->db->limit(7);
        $a = $this->db->get();
        $a = $a->result();
        $sugg = array();
        if(count($a) > 0 ){
            foreach($a as $val){
                $sugg[] = $val->name;
            }
            $arr = array( 'suggestions' => $sugg );
            print_r(json_encode($arr));
        } else {
            $arr = array( 'suggestions' => $sugg );
            print_r(json_encode($arr));
        }
    }

    function complete_com($q) {
        $a = new stdClass();
        $this->db->select('id, name');
        $this->db->from('companies');
        $this->db->like('name', $q, 'after');
        $this->db->limit(5);
        $a = $this->db->get();
        $a = $a->result();
        $sugg = $ids = array();
        if(count($a) > 0 ){
            foreach($a as $val){
                $sugg[] = array( 'value' => $val->name, 'data' => $val->id );
            }
        } else {
            $this->db->select('name');
            $this->db->from('companies');
            $this->db->like('name', $q, 'both');
            $this->db->limit(5);
            $a = $this->db->get();
            $a = $a->result();
            if(count($a) > 0 ) {
                foreach ($a as $val) {
                    $sugg[] = array( 'value' => $val->name, 'data' => $val->id );
                }
            }
        }
        print_r(json_encode( array( 'suggestions' => $sugg ) ));
    }
}