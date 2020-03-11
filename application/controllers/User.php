<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {
  function __construct() {
    parent::__construct();
    error_reporting(0);
    $this->load->model("m_user");
    $this->load->model('m_login');
  }
  
  public function index() {
    if (!($this->session->userdata('user_id'))) {
      $this->load->view("admin/login/login_page");
    } else {
      $data['user'] = $this->m_user->show_user();
      $this->load->view("_template/header");
      $this->load->view("_template/menu");
      $this->load->view("admin/user/user", $data);
      $this->load->view("_template/footer");
    }
  }
  
  public function input() {
    $result = $this->m_login->user_exist($this->input->post('user_name'));
    if(!!($result)){
      $this->session->set_flashdata('user', 'Username : <b>'.$this->input->post('user_name').'</b> sudah digunakan!');
      redirect('user');
    }else{
      $data['user_id'] = "";
      $data['user_name'] = $this->input->post('user_name');
      $data['user_password'] = md5($this->input->post('user_password'));
      $data['user_surename'] = $this->input->post('user_surename');
      $data['user_nidn'] = $this->input->post('user_nidn');
      $data['user_position'] = $this->input->post('user_position');
      $data['user_email'] = $this->input->post('user_email');
      $data['user_status'] = $this->input->post('user_status');
      #Execute Query Insert...
      $this->m_user->input($data);
      #Notificaion
      $this->session->set_flashdata('create_user', 'User <b>' . $data['user_surename'] . '</b> berhasil ditambahkan');
      #redirect to page
      redirect('user');
    }


    
  }
  
  public function edit() {

    if($this->input->post('user_password')){
      $data['user_id'] = $this->input->post('user_id');
      $data['user_name'] = $this->input->post('user_name');
      $data['user_password'] = md5($this->input->post('user_password'));
      $data['user_surename'] = $this->input->post('user_surename');
      $data['user_nidn'] = $this->input->post('user_nidn');
      $data['user_position'] = $this->input->post('user_position');
      $data['user_email'] = $this->input->post('user_email');
      $data['user_status'] = $this->input->post('user_status');
    }else{
      $data['user_id'] = $this->input->post('user_id');
      $data['user_name'] = $this->input->post('user_name');
      $data['user_surename'] = $this->input->post('user_surename');
      $data['user_nidn'] = $this->input->post('user_nidn');
      $data['user_position'] = $this->input->post('user_position');
      $data['user_email'] = $this->input->post('user_email');
      $data['user_status'] = $this->input->post('user_status');
    }
    #Notificaion
    $this->session->set_flashdata('edit_user', 'User <b>' . $data['user_surename'] . '</b> berhasil diperbaharui');
    #Execute Query Insert...
    $this->m_user->edit($data);
    #redirect to page
    redirect('user');
      
  }

  public function activated() {
    $data['user_id'] = $this->input->post('user_id');
    $data['user_status'] = "Y";
    $data['user_storage_size'] = 25;
    #Execute Query Insert...
    $this->m_user->edit($data);

    #Send Verification Message
    $dataq['DestinationNumber']=$this->input->post('user_number');
    $dataq['TextDecoded']="Selamat! Akun anda telah diterima oleh admin, silahkan gunakan IT Cloud Storage Anda. Terima Kasih";
    $this->m_user->sendsms($dataq);

    #Notificaion
    $this->session->set_flashdata('activated_user', 'User <b>' . $data['user_surename'] . '</b> berhasil diaktifkan');
    #redirect to page
    redirect('user');
      
  }
  
  public function delete() {
    $this->m_user->delete($this->input->post('user_id'));
    $this->rrmdir($_SERVER['DOCUMENT_ROOT'].'/storage/'.$this->input->post('user_name')); //Linux Version
    //$this->rrmdir($_SERVER['DOCUMENT_ROOT'].'/it-cloudstorage/storage/'.$this->input->post('user_name')); //Windows Version
    //rmdir($_SERVER['DOCUMENT_ROOT'].'/it-cloudstorage/storage/'.$this->input->post('user_name'));
    #Notificaion
    $this->session->set_flashdata('delete_user', 'User <b>' .$this->input->post('user_name') . '</b> berhasil dihapus');
    redirect('user');
  }


  public function profil() {
    if (!($this->session->userdata('user_id'))) {
      $this->load->view("admin/login/login_page");
    } else {
      $data['user'] = $this->m_user->show_user_byID($this->session->userdata('user_id'));
      $this->load->view("_template/header");
      $this->load->view("_template/menu");
      $this->load->view("admin/user/profil", $data);
      $this->load->view("_template/footer");
    }
  }

  public function profil_edit() {
    echo $_FILES['userfile']['name'];
    if($_FILES['userfile']['name'] !=""){
      $newName=$this->session->userdata('user_name').".jpg";
      $vdir_upload = "./upload/";
      $vfile_upload = $vdir_upload . $newName;
      //Simpan gambar dalam ukuran sebenarnya
      move_uploaded_file($_FILES["userfile"]["tmp_name"], $vfile_upload);

      echo "ada Foto";
      //identitas file asli
      if($_FILES['userfile']['type']=="image/jpeg"){
        $im_src = imagecreatefromjpeg($vfile_upload);
      }else{
        $im_src = imagecreatefrompng($vfile_upload);
      }
      
      $src_width = imageSX($im_src);
      $src_height = imageSY($im_src);

      #target ukuran
      $dst_width2 = 128;
      $dst_height2 = 128;

      $im2 = imagecreatetruecolor($dst_width2,$dst_height2);
      imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

      //Simpan gambar
      imagejpeg($im2,$vdir_upload . "medium_" . $newName);
      
      //Hapus gambar di memori komputer
      imagedestroy($im_src);
      imagedestroy($im2);

      #=============================
      $data['user_id']        = $this->input->post('user_id');
      $data['user_surename']  = $this->input->post('user_surename');
      $data['user_nidn']      = $this->input->post('user_nidn');
      $data['user_position']  = $this->input->post('user_position');
      $data['user_email']     = $this->input->post('user_email');
      $data['user_status']    = $this->input->post('user_status');
      $data['user_number']    = $this->input->post('user_number');
      $data['user_photo']     = "medium_".$newName;
      #jika Password diisi
      if($this->input->post('user_password')){
        $data['user_password'] = md5($this->input->post('user_password'));
      }

    }else{
      echo "tidak ada";
      $data['user_id'] = $this->input->post('user_id');
      $data['user_surename'] = $this->input->post('user_surename');
      $data['user_nidn'] = $this->input->post('user_nidn');
      $data['user_position'] = $this->input->post('user_position');
      $data['user_email'] = $this->input->post('user_email');
      $data['user_status'] = $this->input->post('user_status');
      $data['user_number'] = $this->input->post('user_number');
      #jika Password diisi
      if($this->input->post('user_password')){
        $data['user_password'] = md5($this->input->post('user_password'));
      }

    }

    $this->session->set_userdata($data);
    
    #Execute Query Insert...
    $this->m_user->edit($data);

    #Notificaion
    $this->session->set_flashdata('profil_user', ' Anda Berhasil Merubah Profil');
    #redirect to page
    redirect('user/profil');
      
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
