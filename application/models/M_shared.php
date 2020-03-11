<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_shared extends CI_Model {
  function __construct() {
    parent::__construct();
  }

  public function getAll($me) {
    $this->db->select('*');
    $this->db->from('sharing_tbl a');
    $this->db->join('file_tbl b', 'b.file_id=a.file_id', 'LEFT');
    $this->db->join('user_tbl c', 'c.user_id=a.user_sender', 'LEFT');
    $this->db->where('a.user_receiver',$me);
    $query = $this->db->get();
    if($query->num_rows() > 0) {
      foreach($query->result() as $row) {
        $data[] = $row;
      }
      return $data;
    }
    return false;
  }
  
  public function delete_share($id) {
    $this->db->delete('sharing_tbl', array('file_id' => $id));
  } 
  
}
?>