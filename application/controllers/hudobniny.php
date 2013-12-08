<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class hudobniny extends CI_Controller {
  function __construct(){
    parent::__construct();
    }
    
	public function index()
	{
		$this->home();
	}
  
  public function home(){
    $data['title'] = "Welcome";
    
    $this->load->model("get_db"); 
    $data['news'] = $this->get_db->get_items_new();
       
    $this->load->view("view_home", $data);
  
  }
  
  function about(){
    $data['title'] = "About";
    $this->load->view("view_about", $data);
      
  }
}

