<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_file extends CI_Model {
  function __construct() {
    parent::__construct();
  }

  /*public function getFile($root) { //Old Version
    $query = $this->db->query("select * from file_tbl where file_root='$root'");
    return $query->result();
  }*/

  public function getFile($root) {
    $query = $this->db->query("select * from file_tbl where file_root='$root' and file_status='0'");
    return $query->result();
  }

  public function getFileBin($id) {
    $query = $this->db->query("select * from file_tbl where user_id='$id' and file_status='1'");
    return $query->result();
  }
  
  public function file_input($data) {
    //insert data
    $this->db->insert('file_tbl', $data);
  }

  public function share($data) {
    //insert data
    $this->db->insert('sharing_tbl', $data);
  }

  public function edit($data) {
    $this->db->update('file_tbl', $data, array(
      'file_id' => $data['file_id']
    ));
  }

  public function delete($id) {
    $this->db->delete('file_tbl', array('file_id' => $id));
  } 

  public function getFolder($id) {
    $query = $this->db->query("select * from file_tbl where file_type='folder' and user_id ='$id'");
    return $query->result();
  }

  public function deleteFileRoot($root) {
    $this->db->like('file_root',$root);
    $this->db->delete('file_tbl');
    

  }

}
?>