<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
  function __construct() {
    parent::__construct();
    #Load Model 
    $this->load->model('m_login');
    $this->load->model('m_file');
    $this->load->model('m_user');
    
  }
  
  #Show Login Page if Session not exist
  public function index() {
    if (!($this->session->userdata('user_id'))) {
      $this->load->view("login_page");
    } else {

      #If Segment 3 is not empty
      if($this->uri->segment(3)==''){
        $data['folder']=$_SERVER["DOCUMENT_ROOT"].'/storage/'.$this->session->userdata('user_name').'/'; // Linux Version
        //$data['folder']=$_SERVER["DOCUMENT_ROOT"].'/it-cloudstorage/storage/'.$this->session->userdata('user_name').'/'; //Windows Version
      }else{
        $data['folder']=base64_decode($this->uri->segment(3));
      }
      #Create Design Path
      $design_path = explode('/opt/lampp/htdocs/it-cloudstorage/', $data['folder']); //Linux Version
      //$design_path = explode('C:/xampp/htdocs/it-cloudstorage/', $data['folder']); //Windows Version
	$data['design_path'] =  $design_path[0];
      #Load All File/Folder which have same root with $data['folder']
      $data['all_file'] = $this->m_file->getFile(base64_encode($data['folder']));
      #Load User to Shared
      $data['shared_to'] = $this->m_user->usertoshare($this->session->userdata('user_id'));
      #Load All Folder
      $data['getAllFolder'] = $this->m_file->getFolder($this->session->userdata('user_id'));
      #getMyStorage
      $data['MyStorageSize'] = $this->m_user->mystoragesize($this->session->userdata('user_id'));
      #Load View
      $this->load->view("_template/header");
      $this->load->view("_template/menu");
      $this->load->view("admin/beranda/beranda",$data);
      $this->load->view("_template/footer");
    }
  }

  #Login Validation 
  public function login() {
    if ($_POST) {
      $data['username'] = $this->input->post('username');
      $data['password'] = md5($this->input->post('password'));
      $result           = $this->m_login->login($data);
      if (!!($result)) {
        $data = array(
          'user_id'       => $result->user_id,
          'user_name'     => $result->user_name,
          'user_status'   => $result->user_status,
          'user_surename' => $result->user_surename,
	  'user_photo'    => $result->user_photo,
          'user_position' => $result->user_position,
        );

        if($data['user_status']!="Y"){
          $this->session->set_flashdata('login', 'Maaf Akun Anda Belum di Aktifkan!');
          redirect('home');
        }else{
          $this->session->set_userdata($data);
          redirect('home');
        }
      } else {
        $this->session->set_flashdata('login', 'Username atau password salah!');
        redirect('home');
      }
    }
  }
  
  #Destroy Session if Logout Pressed
  public function logout() {
    $this->session->sess_destroy();
    redirect('' . base_url());
  }
  
}
?>
