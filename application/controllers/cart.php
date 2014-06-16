<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cart extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library(array('cart','template'));  
		$this->load->helper(array('form','url'));
		$this->load->model('orders');
	}

	public function index(){
		$this->home();
	}

	function home(){
		$data['title'] = "Cart";
		$array = array( (object) array('name'=>'','surname'=>'','adress'=>' , , ', 'email' => '', 'p_number'=>'','country'=>''));
		$data['user_data'] = ($this->session->userdata('loged') == 1)?  $this->get_user_data() : $array;
		//print_r($data['user_data']); 

		$this->template->write_view('content', 'view_cart', $data); 
    	$this->template->render();  
	}

	function admin_orders(){
		$data['title'] = "Orders";
		$data['orders'] = $this->orders->getOrders(true);

		$this->template->write_view('content', 'view_adOrders', $data); 
    	$this->template->render();  
	}
	function get_user_data(){
		$this->load->model('get_db');
		$field = $this->get_db->get_items('users_info','id',$this->session->userdata('id'));
		return $field;
	}

	function order_validation(){
		$this->load->helper('url');
	    $this->load->library('form_validation');
	    $config = array(
	                array(
	                  'field' => 'first', 'label' => 'First name', 'rules' => 'required|min_length[3]|max_length[15]|xss_clean|trim|alpha'    
	                ) ,
	                array(
	                  'field' => 'd_first', 'label' => 'Delivery First name', 'rules' => 'min_length[3]|max_length[15]|xss_clean|trim|alpha'    
	                ) ,
	                array(
	                  'field' => 'last', 'label' => 'Last name', 'rules' => 'required|min_length[3]|max_length[15]|xss_clean|trim|alpha'
	                ) ,
	                array(
	                  'field' => 'd_last', 'label' => 'DeliveryLast name', 'rules' => 'min_length[3]|max_length[15]|xss_clean|trim|alpha'
	                ) ,
	                array(
	                  'field' => 'adress', 'label' => 'Adress', 'rules' => 'required|xss_clean|trim|max_length[30]'      
	                ) ,
	                array(
	                  'field' => 'd_adress', 'label' => 'Deliver Adress', 'rules' => 'xss_clean|trim|max_length[30]'      
	                ) ,
	                array(
	                  'field' => 'zip', 'label' => 'ZIP/Postal code', 'rules' => 'required|exact_length[5]|xss_clean|trim|numeric'      
	                ) ,
	                array(
	                  'field' => 'd_zip', 'label' => 'Delvier ZIP/Postal code', 'rules' => 'exact_length[5]|xss_clean|trim|numeric'      
	                ) ,
	                array(
	                  'field' => 'city', 'label' => 'City', 'rules' => 'required|min_lenghth[3]|max_length[20]|xss_clean|trim'   
	                ),
	                array(
	                  'field' => 'd_city', 'label' => 'Delivery City', 'rules' => 'min_lenghth[3]|max_length[20]|xss_clean|trim'   
	                )
	                ,array(
	                  'field' => 'country', 'label' => 'country', 'rules' => 'required|min_lenghth[5]|max_length[25]|xss_clean|trim'    
	                )
	                ,array(
	                  'field' => 'd_country', 'label' => 'deliver country', 'rules' => 'min_lenghth[5]|max_length[25]|xss_clean|trim'    
	                )
	                ,array(
	                  'field' => 'email', 'label' => 'eMail', 'rules' => 'required|xss_clean|trim|valid_email'    
	                )
	                ,array(
	                  'field' => 'phone', 'label' => 'Phone number', 'rules' => 'required|min_lenghth[5]|max_length[15]|xss_clean|trim|numeric'    
	                )	               
	    ); 
	   $this->form_validation->set_rules($config); 
	   if ($this->form_validation->run()){
	   	$this->load->model('orders');



	   	$order = array(
	   			'first_name' 	=> $this->input->post('first') ,
	   			'last_name'	 	=> $this->input->post('last') ,
	   			'adress'	 	=> $this->input->post('adress') . ", " . $this->input->post('zip') . ", " .  $this->input->post('city'),
	   			'country' 	 	=> $this->input->post('country') ,
	   			'email'		 	=> $this->input->post('email'),
	   			'phone_number'	=> $this->input->post('phone'),
	   			'added'			=> date('Y-m-d'),
	   			'status'		=> 1
	   		);	   	
	   	
	   	if($this->input->post('d_first')){
	   		$order_delivery = array(
	   			'first_name_d' 		=> $this->input->post('d_first') ,
	   			'last_name_d'	 	=> $this->input->post('d_last') ,
	   			'adress_d'	 		=> $this->input->post('d_adress') . ", " . $this->input->post('d_zip') . ", " .  $this->input->post('d_city'),
	   			'country_d' 	 	=> $this->input->post('d_country')
	   		);
	   		$order = array_merge($order,$order_delivery);
	   	}
	   	
	   	$products = array();
	   	foreach ($this->cart->contents() as $value) {
	   		array_push($products, array(
	   			'user'			=> ($this->session->userdata('loged') == 1)? $this->session->userdata('id') : 0,
	   			'id_details'	=> 0,
	   			'id_prod'		=> $value['id'],
	   			'name'			=> $value['name'],
	   			'qty'			=> $value['qty'],
	   			'price'			=> $value['price'],
	   			'added'			=> date('Y-m-d') 
	   			)
	   		);
	   	};
	   	array_push($products, array(
	   			'id_details'	=> 0,
	   			'id_prod'		=> 0,
	   			'user'			=> ($this->session->userdata('loged') == 1)? $this->session->userdata('id') : 0,
	   			'name'			=> $this->input->post('delivery_h'),
	   			'qty'			=> 1,
	   			'price'			=> $this->input->post('delivery'),
	   			'added'			=> date('Y-m-d') ),
	   		array('id_details'	=> 0,
	   			'id_prod'		=> 0,
	   			'user'			=> ($this->session->userdata('loged') == 1)? $this->session->userdata('id') : 0,
	   			'name'			=> $this->input->post('cash_h'),
	   			'qty'			=> 1,
	   			'price'			=> $this->input->post('cash'),
	   			'added'			=> date('Y-m-d') ));

	   	if($this->orders->add_order($order,$products)){
	   		$this->orders->send_email($this->input->post(email));
	   		$this->cart->destroy();
	   		$data['id'] = 'asd';
	   		$this->template->write_view('content', 'view_orderTY', $data); 
    		$this->template->render();  
	   	}
	   }else{
	   	echo validation_errors();
	   } 	
		
	}

	function delete_from_cart(){
		$data = array(
			'rowid' => $_POST['rowid'],
			'qty'	=> 0
			);
		$this->cart->update($data);
	}

	function update_status(){
		$id = strip_tags($_POST['id_details']);
		$status = strip_tags($_POST['status']);

		$this->db->where('id', $id);
		$this->db->update('orders_details', array('status' => $status));

	}

}