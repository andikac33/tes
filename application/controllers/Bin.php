<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bin extends CI_Controller {
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
      $data['mybin'] = $this->m_file->getFileBin($this->session->userdata('user_id'));
      #Load View
      $this->load->view("_template/header");
      $this->load->view("_template/menu");
      $this->load->view("admin/bin/bin",$data);
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
      $this->load->view("admin/bin/open",$data);
      $this->load->view("_template/footer");
    }
  }

  #Delete File/Folder
  public function delete() {
    #Delete by Type
    if($this->input->post('file_type')=="folder"){
      #Delete By ID
      $this->m_file->delete($this->input->post('file_id'));
      #==============================================
      #Delete Share By ID
      $this->m_shared->delete_share($this->input->post('file_id'));
      #Delete By File Root
      $getRoot = base64_decode($this->input->post('file_root')).$this->input->post('file_name').'/';
      $this->m_file->deleteFileRoot(base64_encode($getRoot));
      //echo base64_decode($this->input->post('file_root')).$this->input->post('file_name');
      $this->rrmdir(base64_decode($this->input->post('file_root')).$this->input->post('file_name'));
    }else{
      #Delete By ID
      $this->m_file->delete($this->input->post('file_id'));
      #==============================================
      #Delete Share By ID
      $this->m_shared->delete_share($this->input->post('file_id'));
      unlink(base64_decode($this->input->post('file_root')).$this->input->post('file_name'));
    }
    

    redirect('bin');
      
  }

  #Move to Bin
  public function storage() {
    $data['file_id'] = $this->input->post('file_id');
    $data['file_name'] = $this->input->post('file_name');
    $data['file_status'] = 0; //Mode Recycle Bin = 1 || Mode Storage = 0
    $data['file_root'] = $this->input->post('file_root');
    $this->m_file->edit($data);
    redirect('bin');
      
  }

  #delete Recursive(All of them) Folder 
  public function rrmdir($dir) { 
    if (is_dir($dir)) { 
      $objects = scandir($dir); 
      foreach ($objects as $object) { 
        if ($object != "." && $object != "..") { 
          if (is_dir($dir."/".$object))
            $this->rrmdir($dir."/".$object);
          else
            unlink($dir."/".$object); 
        } 
      }
      rmdir($dir); 
    } 
  }

  
  
}
?>