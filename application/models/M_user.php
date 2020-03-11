<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_user extends CI_Model {
  function __construct() {
    parent::__construct();
  }
  
  public function show_user() {
    $query = $this->db->query("select * from user_tbl order by user_id desc");
    return $query->result();
  }

  public function mystoragesize($id) {
    $query = $this->db->query("select user_storage_size from user_tbl where user_id='$id'");
    return $query->result();
  }
  
  public function show_user_byID($id) {
    $query = $this->db->query("select * from user_tbl where user_id='$id'");
    return $query->result();
  }
  public function input($data) {
    //insert data
    $this->db->insert('user_tbl', $data);
  }
  
  public function edit($data) {
    $this->db->update('user_tbl', $data, array(
      'user_id' => $data['user_id']
    ));
  }
  
  public function delete($id) {
    $this->db->delete('user_tbl', array('user_id' => $id));
  }  

  public function usertoshare($me) {
    $query = $this->db->query("select * from user_tbl where user_id !='$me' order by user_id desc");
    return $query->result();
  }

  public function sendsms($dataq) {
    //send sms
    $this->db->insert('outbox', $dataq);
  }

}
?>
