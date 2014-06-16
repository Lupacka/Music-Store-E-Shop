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

  	public function getOrders($admin = false){
  		$this->db->select('orders.*, orders_details.status');        
		$this->db->from('orders');
		$this->db->join('orders_details', 'orders_details.id = orders.id_details');
		if(!$admin)
			$this->db->where('orders.user', $this->session->userdata('id'));
		$query = $this->db->get();
		if($query)
			return $query->result();
	}

	function send_email($email, $status = 1, $id){
		$this->load->library('email');
		$this->email->from('admin@hudobniny.cz', 'hudobniny.cz');
		$this->email->to($email); 
		$this->email->subject('Order #{$id} confirmation');

		switch ($status) {
			case 1:
				$this->email->message("
				Dear customer,
				we accepted your order, id: {$id}.
				about further steps or status change, we will inform u via email.
				
				Best regards,
    			hudobniny.cz team 
				");
				break;
			case 2:
				$this->email->message("
				Dear customer,
				we expeded your order, id: {$id}.
				about further steps or status change, we will inform u via email.
				
				Best regards,
    			hudobniny.cz team 
				");
				break;

		}
		$this->email->send();

	}

  }