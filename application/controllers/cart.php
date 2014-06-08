<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cart extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library(array('cart','template'));  
		$this->load->helper('form');
	}

	public function index(){
		$this->home();
	}

	function home(){
		$data['title'] = "Cart";
		if($this->session->userdata('loged')){
			$data['user_data'] = $this->get_user_data();
		}
		$this->template->write_view('content', 'view_cart', $data); 
    	$this->template->render();  
	}

	function get_user_data(){
		$this->load->model('get_db');
		$tmp = array();
		foreach($this->get_db->get_items('users_info','id',$this->session->userdata('id')) as $val){
			array_push($tmp, explode(',', $val->adress));

		}
		return $tmp;
	}

	function delete_from_cart(){
		$data = array(
			'rowid' => $_POST['rowid'],
			'qty'	=> 0
			);
		$this->cart->update($data);
	}

}