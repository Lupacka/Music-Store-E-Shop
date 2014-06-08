<?php

  class orders extends CI_Model{

  	function add_order($field = array(), $prod = array()){
  		$bool = false;
  		if($this->db->insert("orders_details", $field)) $bool = true;
  		$tmp = $prod;
  		$this->db->select_max('id');
  		$query = $this->db->get('orders_details');
  		foreach ($query->result() as $key) {
  			for($i = 0; $i < count($tmp); $i++)
  				$tmp[$i]['id_details'] = $key->id;
  		}
  		if($this->db->insert_batch("orders", $tmp) && $bool)
  			return true;

  	}


  }