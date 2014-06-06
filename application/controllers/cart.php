<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cart extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library(array('cart','template'));  
	}

	public function index(){
		$this->home();
	}

	function home(){
		$this->template->write_view('content', 'view_cart'); 
    	$this->template->render();  
	}

	function delete_from_cart(){
		$data = array(
			'rowid' => $_POST['rowid'],
			'qty'	=> 0
			);
		$this->cart->update($data);
	}

}