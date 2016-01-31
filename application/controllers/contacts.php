<?php if ( ! defined('BASEPATH')) exit('Yohoho!');

class Contacts extends CI_Controller {
    public function index()
    {
        $this->load->view('contacts_view');
    }
}