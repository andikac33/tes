<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_note extends CI_Model {
  function __construct() {
    parent::__construct();
  }
  
  public function show_note() {
    $query = $this->db->query("select * from note_tbl where note_status='N' order by note_id asc");
    return $query->result();
  }

  public function show_note_finish() {
    $query = $this->db->query("select * from note_tbl where note_status='Y' order by note_id desc");
    return $query->result();
  }
  
  public function show_note_byID($id) {
    $query = $this->db->query("select * from note_tbl where note_id='$id'");
    return $query->result();
  }

  public function input($data) {
    //insert data
    $this->db->insert('note_tbl', $data);
  }
  
  public function edit($data) {
    $this->db->update('note_tbl', $data, array(
      'note_id' => $data['note_id']
    ));
  }
  
  public function delete($id) {
    $this->db->delete('note_tbl', array('note_id' => $id));
  }  

  

}
?>