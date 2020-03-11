<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Register extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('m_login');
  }
  
  #Load Register Page
  public function index() {
    $this->load->view("register_page");
  }

  #Register Validation 
  public function register() {
    if ($this->input->post('user_password') != $this->input->post('password_again')) {
      $this->session->set_flashdata('register', 'Validasi Passowrd Tidak Sama!');
      redirect('register');
    }else{
      $result = $this->m_login->user_exist($this->input->post('user_name'));
      if(!!($result)){
        $this->session->set_flashdata('register', 'Username : <b>'.$this->input->post('user_name').'</b> sudah digunakan!');
        redirect('register');
      }else{
        $data['user_id']        = "";
        $data['user_surename']  = $this->input->post('user_surename');
        $data['user_password']  = md5($this->input->post('user_password'));
        $data['user_name']      = $this->input->post('user_name');
 	      $data['user_number']    = $this->input->post('user_number');
        $data['user_status']    = "N";

        #Create Folder
        mkdir($_SERVER['DOCUMENT_ROOT'].'/storage/'.$data['user_name'], 0777, true); //Linux Version
        //mkdir($_SERVER['DOCUMENT_ROOT'].'/it-cloudstorage/storage/'.$data['user_name'], 0777, true); //Windows Version
        #Execute Query Insert...
        $this->m_login->do_register($data);
        #redirect to page
        $this->session->set_flashdata('register_success', 'Selamat Akun :<b>'.$data['user_name'].'</b> berhasil dibuat. Tunggu hingga Admin memvalidasi akun Anda dan bisa digunakan.');
        redirect('register');
      }
    }
  }
  
}
?>
