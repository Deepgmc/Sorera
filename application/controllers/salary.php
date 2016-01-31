<?php if ( ! defined('BASEPATH')) exit('Denied');

class Salary extends CI_Controller {
    public function _remap($cId, $gets){$this->index( $cId, $gets );}
    public function index($cId, $gets)
    {
        /*  GLOB VARS   */
        $this_page = 'salary';
        $g_salOnPage = 30;

        /*  HELPERS   */
        include APPPATH . 'helpers/pagerClass/class.pagerFromFile.php';
        include APPPATH . 'helpers/dddd_mm_yy_ToView.php';
        include APPPATH . 'helpers/encodeUrlParameter.php';

        /*  GET DATA        */
        $this->load->model('com_model');
        $b = $this->com_model->get_hdr_com_info($cId);
        if($b->id == '' || $b->id == null){
            header("HTTP/1.0 404 Not Found");
            die();
        }

        /*  VIEW DATA   */
        $this->load->view('header_view', array(
            'comData' => $b,
            'logoData' => $this->com_model->get_com_logo($cId),
            'metroData' => $this->com_model->get_com_metro($cId),
            'dirData' => $this->com_model->get_dir_foto($cId),
            'this_page' => $this_page
        ));
        $this->load->view('addRev_view', array(
            'this_page' => $this_page,
            'comData' => $this->com_model->get_hdr_com_info($cId)
        ));
        $this->load->view('control_view', array('this_page' => $this_page));
        $this->load->view('sal_view',
            array(
                'salData' => $this->com_model->get_com_salary($cId, $g_salOnPage),
                'gets' => $gets,
                'salOnPage' => $g_salOnPage,
                'this_page' => $this_page
            ));
        $this->load->view('footer_view', array('this_page' => $this_page, 'cId' => $b->id));
    }
}
