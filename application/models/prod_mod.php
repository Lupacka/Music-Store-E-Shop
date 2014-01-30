<?php

  class Prod_mod extends CI_Model{
  
    function insert_new_prod($data){
      $this->db->insert_batch("tovar", $data);     
      return true; 
   } 
  
  }
?>