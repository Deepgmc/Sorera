<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
public function index($script)
{
    if(isset($_POST['logoutAdmin'])){
        $this->session->sess_destroy();
        exit('Good luck');
    }
    if(isset($_POST['pwd'])){
        $errLogin = false;
        $pwd = trim($_POST['pwd']);
        if(strlen($pwd) != 7) {$errLogin = true;}
        if($pwd == 1848918){
            $isRoot = $this->session->set_userdata('AT', 'admin');
        } else {
            $errLogin = true;
        }
        if($errLogin){
            die('You\'ve entered wrong data!');
        }
    }
    $isRoot = $this->session->userdata('AT');
    if(!isset($isRoot) || $isRoot == '' || $isRoot != 'admin'){
        $this->load->view('admin/adm_login_view');
    } else {
        /*  HELPERS   */
        require_once(APPPATH . '/helpers/dddd_mm_yy_ToView.php');

        if ($script == 'index') $script = 'admin';

        if (!preg_match('/testscript/', $script) && !preg_match('/comredact/', $script)) {
            $this->load->model('admin/' . $script . '_model');
        }
        /*  GET DATA    */

        /*  VIEW DATA   */
        $this->load->view('admin/' . $script . '_view');
    }
}
function _remap($cId){$this->index( $cId );}
}
