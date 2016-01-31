<?php if ( ! defined('BASEPATH')) exit('Yohoho!');

class Mainpage extends CI_Controller {
    public function index()
    {
        $this->load->view('mainPage_view');
        $this->load->view('footer_view');
    }
}