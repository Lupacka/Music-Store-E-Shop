<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class hudobniny extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->helper('url');
    $this->load->library('template');
    }
    
	public function index()
	{ 
		$this->home();
	}
  
  public function home(){
    $data['title'] = "Welcome";
    
    $this->load->model("get_db"); 
    $data['news'] = $this->get_db->get_items_new();
    
    $this->template->write_view('content', 'view_home', $data); 
    $this->template->render();  
    //$this->load->view("view_home", $data);  
  
  }
  
  function about(){
    $data['title'] = "About";
    $this->template->write_view('content', 'view_about', $data); 
    $this->template->render(); 
      
  }
  function reset_pass(){            //pre testing
    $this->load->model('registration');
    $salt = $this->registration->salting();
    $pass = $this->registration->make_pass('ahoj', $salt);
    $data = array(
              array(
                'id' => 1,
                'pass' => $pass,
                'salt' => $salt
              )   
    );
    $this->db->update_batch('users',$data,'id');
    
  }
}

          
  
  