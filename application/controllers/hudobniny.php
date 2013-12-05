<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class hudobniny extends CI_Controller {
  function __construct(){
    parent::__construct();
    }
    
	public function index()
	{
    #echo "Hi buzna <br>";
		$this->home();
	}
  
  public function home(){
    $data['title'] = "Welcome";
   // if($this->session->not('not'))
    //  $data['not'] = $this->session->not('not');
   // else
  //    $data['not'] = ""; 
    
    $this->load->model("get_db"); 
    $data['news'] = $this->get_db->get_items_new();
       
    $this->load->view("view_home", $data);
  
  }
  
  function about(){
    $data['title'] = "About";
    $this->load->view("view_about", $data);
      
  }
}

