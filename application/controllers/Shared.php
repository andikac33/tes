<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Shared extends CI_Controller {
  function __construct() {
    parent::__construct();
    #Load Model 
    $this->load->model('m_login');
    $this->load->model('m_file');
    $this->load->model('m_user');
    $this->load->model('m_shared');
    
  }
  
  #Show Login Page if Session not exist
  public function index() {
    if (!($this->session->userdata('user_id'))) {
      $this->load->view("login_page");
    } else {
      #Load User to Shared
      $data['share_to_me'] = $this->m_shared->getAll($this->session->userdata('user_id'));
      #Load View
      $this->load->view("_template/header");
      $this->load->view("_template/menu");
      $this->load->view("admin/share/share",$data);
      $this->load->view("_template/footer");
    }
  }

  #
  public function open() {
    if (!($this->session->userdata('user_id'))) {
      $this->load->view("login_page");
    } else {
      #Load User to Shared
      $data['folder']=base64_decode($this->uri->segment(3));
      $data['all_file'] = $this->m_file->getFile(base64_encode($data['folder']));
      //$data['folder']=base64_decode($this->uri->segment(3));
      #Load View
      $this->load->view("_template/header");
      $this->load->view("_template/menu");
      $this->load->view("admin/share/open",$data);
      $this->load->view("_template/footer");
    }
  }

  
  
}
?>