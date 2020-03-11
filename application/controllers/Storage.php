<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Storage extends CI_Controller {
  function __construct() {
    parent::__construct();
    //error_reporting(0);
    $this->load->model("m_file");
    $this->load->model("m_shared");
    $this->load->library('upload');
  }
  
  #Move to Bin
  public function bin() {
    $data['file_id'] = $this->input->post('file_id');
    $data['file_name'] = $this->input->post('file_name');
    $data['file_status'] = 1; //Mode Recycle Bin = 1 || Mode Storage = 0
    $data['file_root'] = $this->input->post('file_root');
    
    $this->session->set_flashdata('bin_file', 'File/Folder <b>' . $data['file_name'] . '</b> dipindahkan ke Recycle Bin !');
    #Execute Query Insert...
    $this->m_file->edit($data);
    #redirect to page
    if($this->input->post('file_root') == base64_encode($_SERVER["DOCUMENT_ROOT"].'/storage/'.$this->session->userdata('user_name').'/')){ //Linux Version
    //if($this->input->post('file_root') == base64_encode($_SERVER["DOCUMENT_ROOT"].'/it-cloudstorage/storage/'.$this->session->userdata('user_name').'/')){ //Windows Version

      redirect('home');

    }else{
      redirect('home/index/'.$data['file_root']);
    }
      
  }

  #Create Folder
  public function create_folder() {
    $data['file_id'] = "";
    $data['user_id'] = $this->input->post('user_id');
    $data['file_name'] = $this->input->post('file_name');
    $data['file_type'] = "folder";
    $data['file_size'] = 0;
    $data['file_date_modified'] = date('Y-m-d H:i:s');
    $data['file_permission'] = 777;
    $data['file_root'] = $this->input->post('file_root');


    #Execute Query Insert...
    $this->m_file->file_input($data);
    mkdir(base64_decode($data['file_root'])."/".$data['file_name'], 0777, true);

    #Notificaion
    $this->session->set_flashdata('create_folder', 'Folder <b>' . $data['file_name'] . '</b> berhasil dibuat');
    #redirect to page
    if($this->input->post('file_root') == base64_encode($_SERVER["DOCUMENT_ROOT"].'/storage/'.$this->session->userdata('user_name').'/')){ //Linux Version
    //if($this->input->post('file_root') == base64_encode($_SERVER["DOCUMENT_ROOT"].'/it-cloudstorage/storage/'.$this->session->userdata('user_name').'/')){ //Windows Version

      redirect('home');

    }else{
      redirect('home/index/'.$data['file_root']);
    }
    
  }

  #Upload File
  public function upload_file(){
    $uploaddir = base64_decode($this->input->post('file_root'));
    $uploadfile = $uploaddir.basename($_FILES['userfile']['name']);
    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
      $data['file_id'] = "";
      $data['user_id'] = $this->input->post('user_id');
      $data['file_name'] = $_FILES['userfile']['name'];
      $data['file_type'] = "file";
      $data['file_size'] = $_FILES['userfile']['size'];
      $data['file_date_modified'] = date('Y-m-d H:i:s');
      $data['file_permission'] = 777;
      $data['file_root'] = $this->input->post('file_root');
      #Execute Query Insert...
      $this->m_file->file_input($data);

      #Notificaion
      $this->session->set_flashdata('upload_file', 'File <b>' . $data['file_name'] . '</b> berhasil diupload');
      #redirect to page
      if($this->input->post('file_root') == base64_encode($_SERVER["DOCUMENT_ROOT"].'/storage/'.$this->session->userdata('user_name').'/')){ //Linux Version
      //if($this->input->post('file_root') == base64_encode($_SERVER["DOCUMENT_ROOT"].'/it-cloudstorage/storage/'.$this->session->userdata('user_name').'/')){ //Windows Version

        redirect('home');

      }else{
        redirect('home/index/'.$data['file_root']);
      }
    } else {
      #Notificaion
      $this->session->set_flashdata('upload_file', 'Ada Kesalahan Saat Mengupload <b>' . $data['file_name'] . '</b>');
      #redirect to page
      if($this->input->post('file_root') == base64_encode($_SERVER["DOCUMENT_ROOT"].'/storage/'.$this->session->userdata('user_name').'/')){ //Linux Version
      //if($this->input->post('file_root') == base64_encode($_SERVER["DOCUMENT_ROOT"].'/it-cloudstorage/storage/'.$this->session->userdata('user_name').'/')){ //Windows Version

        redirect('home');

      }else{
        redirect('home/index/'.$this->input->post('file_root'));
      }
    }
  }

  #Share File/Folder
  public function share() {
    $data['sharing_id'] = "";
    $data['file_id'] = $this->input->post('file_id');
    $data['user_sender'] = $this->input->post('user_sender');
    $data['user_receiver'] = $this->input->post('user_receiver');
    #Execute Query Insert...
    $this->m_file->share($data);
    
    #Notificaion
    $this->session->set_flashdata('share_file', 'Berhasil share file <b>' . $data['file_name'] . '</b>');
    #redirect to page
    if($this->input->post('file_root') == base64_encode($_SERVER["DOCUMENT_ROOT"].'/storage/'.$this->session->userdata('user_name').'/')){ //Linux Version
    //if($this->input->post('file_root') == base64_encode($_SERVER["DOCUMENT_ROOT"].'/it-cloudstorage/storage/'.$this->session->userdata('user_name').'/')){ //Windows Version

      redirect('home');

    }else{
      redirect('home/index/'.$data['file_root']);
    }
  }

  #Rename File/Folder
  public function rename() {
    $data['file_id'] = $this->input->post('file_id');
    $data['file_name'] = $this->input->post('file_name');
    #Execute Query Insert...
    $this->m_file->edit($data);
    #Rename
    rename (base64_decode($this->input->post('file_root')).$this->input->post('file_name_old'), base64_decode($this->input->post('file_root')).$data['file_name']);

    #Notificaion
    $this->session->set_flashdata('rename_file', 'Berhasil Rename File <b>' . $this->input->post('file_name_old') . '</b> ke '.$data['file_name']);
    #redirect to page
    if($this->input->post('file_root') == base64_encode($_SERVER["DOCUMENT_ROOT"].'/storage/'.$this->session->userdata('user_name').'/')){ //Linux Version
    //if($this->input->post('file_root') == base64_encode($_SERVER["DOCUMENT_ROOT"].'/it-cloudstorage/storage/'.$this->session->userdata('user_name').'/')){ //Windows Version

      redirect('home');

    }else{
      redirect('home/index/'.$this->input->post('file_root'));
    }
      
  }

  #Copy File/Folder
  public function copy() {
    $data['file_id'] = "";
    $data['user_id'] = $this->input->post('user_id');
    $data['file_name'] = $this->input->post('file_name');
    $data['file_type'] = "file";
    $data['file_size'] = $this->input->post('file_size');
    $data['file_date_modified'] = date('Y-m-d H:i:s');
    $data['file_permission'] = 777;
    $data['file_root'] = $this->input->post('new_destination');
    #Execute Query Insert...
    $this->m_file->file_input($data);
    #Rename
    copy (base64_decode($this->input->post('file_root')).$this->input->post('file_name'), base64_decode($this->input->post('new_destination')).$data['file_name']);

    #Notificaion
    $this->session->set_flashdata('copy_file', 'Berhasil mengcopy file <b>' . $data['file_name'] . '</b>');
    #redirect to page
    if($this->input->post('file_root') == base64_encode($_SERVER["DOCUMENT_ROOT"].'/storage/'.$this->session->userdata('user_name').'/')){ //Linux Version
    //if($this->input->post('file_root') == base64_encode($_SERVER["DOCUMENT_ROOT"].'/it-cloudstorage/storage/'.$this->session->userdata('user_name').'/')){ //Windows Version

      redirect('home');

    }else{
      redirect('home/index/'.$this->input->post('file_root'));
    }
      
  }

  #Copy File/Folder
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
    

    #Notificaion
    $this->session->set_flashdata('delete_file', 'Berhasil menghapus file/folder <b>' . $data['file_name'] . '</b>');
    #redirect to page
    if($this->input->post('file_root') == base64_encode($_SERVER["DOCUMENT_ROOT"].'/storage/'.$this->session->userdata('user_name').'/')){ //Linux Version
    //if($this->input->post('file_root') == base64_encode($_SERVER["DOCUMENT_ROOT"].'/it-cloudstorage/storage/'.$this->session->userdata('user_name').'/')){ //Windows Version

      redirect('home');

    }else{
      redirect('home/index/'.$this->input->post('file_root'));
    }
      
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
  

  #Download File
  public function download() {
    $file=base64_decode($this->uri->segment(3));
    $type=mime_content_type($file);
  	header('Content-Description: File Transfer');
    header('Content-Type: '.$type);
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: '.filesize($file));
    readfile($file);
	  exit;
  }
}
?>
