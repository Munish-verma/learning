<?php
class Common extends CI_model
{

  public function login($table,$data)
  {
     $query = $this->db->select('*')->from($table)->where($data)->get();
      return $query->row_array();
  }


}

?>