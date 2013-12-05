<?php

  class get_db extends CI_Model{
    
    function get_items_new(){
    
      $query = $this->db->get('tovar');
      return $query->result();
    }
  
    function get_user_info($id){ 
      $query = $this->db->get_where('users_info', "id = ".$id );
      return $query->result(); 
    
    }
    function update_user_info($data){
      $this->db->update_batch("users_info", $data , "id");
      
    }
    
    
    function insert($data){
      $this->db->insert("users", $data);
      
    }
    
    function update($data){
      $this->db->update("users", $data , "id = 2");
      
    }
    
     function update2($data){
      $this->db->update_batch("users", $data , "id");
      
    }
  }
  
    
?>
