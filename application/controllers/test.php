<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class test extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->helper('url');
     
    }
  public function index()
	{ 
		$this->home();
	}
  
  public function home(){
    
    $data['title'] = "Welcome";
    $data['his'] = $this->load_history();
    $this->load->view("view_test", $data);  
  
  }
  function load_history(){
    $data = array();
    $file = fopen("chat_history.txt",'rw') or die("cant open file");
    while(($line = fgets($file)) != false){
      array_push($data, $line);
    }
    fclose($file);
    if($_GET['load'] == 1)
      echo json_encode($data);
    else
      return $data;   
  }
  
  function save_com(){
    $file = fopen("chat_history.txt",'a') or die("cant open file");
    fwrite($file, strip_tags($_POST['vst'])."\n");
    fclose($file);
  }


}