<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Note extends CI_Controller {
  function __construct() {
    parent::__construct();
    //error_reporting(0);
    $this->load->model("m_note");
    $this->load->model('m_login');
  }
  
  public function index() {
    if (!($this->session->userdata('user_id'))) {
      $this->load->view("admin/login/login_page");
    } else {
      $data['note'] = $this->m_note->show_note();
      $data['note_finish'] = $this->m_note->show_note_finish();
      $this->load->view("_template/header");
      $this->load->view("_template/menu");
      $this->load->view("admin/note/note", $data);
      $this->load->view("_template/footer");
    }
  }
  
  public function input() {
    $data['note_id'] = "";
    $data['note_description'] = $this->input->post('note_description');
    $data['note_date'] = $this->input->post('note_date');
    $data['note_status'] = "N";
    #Execute Query Insert...
    $this->m_note->input($data);
    #Notificaion
    $this->session->set_flashdata('create_note', 'Catatan Baru berhasil ditambahkan');
    #redirect to page
    redirect('note');
  }
  
  public function edit() {
    
    $data['note_id'] = $this->input->post('note_id');
    $data['note_description'] = $this->input->post('note_description');
    $data['note_date'] = $this->input->post('note_date');
    $data['note_status'] = $this->input->post('note_status');
    #Execute Query Insert...
    $this->m_note->edit($data);
    #redirect to page
    redirect('note');
      
  }

  public function finished() {
    $data['note_id'] = $this->uri->segment(3);
    $data['note_status'] = "Y";
    #Execute Query Insert...
    $this->m_note->edit($data);
    #Notificaion
    $this->session->set_flashdata('finish_note', 'Catatan Baru Saja Diselesaikan');
    #redirect to page
    redirect('note');
      
  }
  
  public function delete() {
    $this->m_note->delete($this->uri->segment(3));
    #Notificaion
    $this->session->set_flashdata('delete_note', 'Catatan berhasil dihapus');
    redirect('note');
  }
  
}
?>