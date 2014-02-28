<?php

  class get_db extends CI_Model{
    
    function get_items($table, $prop, $val){
      $query = $this->db->get_where($table, $prop." = '".$val."'");
      return $query->result();
    }
    
    function get_items_new(){     //uprava-> limit dat prec, kvoli scroling
      $this->db->order_by("date", "desc");
      $query = $this->db->get('tovar', 5);
      return $query->result();
    }
       
    function get_items_sorted($conf_raw, $prop, $val){
      $conf = explode('_', $conf_raw);
      $this->db->order_by($conf[0], $conf[1]);
      $query = $this->db->get_where('tovar', $prop." = '".$val."'");
      return $query->result();
    }
    function update_submenu($cat, $submenu){
      $this->db->where('main', $cat);
     
     if($this->db->update('categories', array('sub' => $submenu)))   
      return true;
     else
      return false;    
   } 
     
  
  }    
?>
