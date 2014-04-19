<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class hudobniny extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->model("get_db");
    $this->load->helper('url');
    $this->load->library(array('cart','template'));  
    }
    
	public function index()
	{ 
     
		$this->home();
	}
  
  public function home(){
    
    $data['title'] = "Welcome";
    
    
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
  function prod_search(){
   
    if(isset($_POST['vst']) && $_POST['vst'] != ""){
     $vst = trim(strip_tags($_POST['vst']));
     
     $this->db->select('name,id');
     $this->db->like('name', $vst, 'both');
     $query = $this->db->get('tovar', 4);
     
     if($query->num_rows() > 0){
       echo "<ul>";
       foreach($query->result() as $row){
        echo anchor("/products?id=" .$row->id,"
        <li>
          <img src='". base_url('/media/prod_photo/'.$row->id.'_thumb.jpg') ."'>
          <span>".$row->name . "</span></li>");
       }
       echo "</ul>";
     }  
    }
  }
  function add_to_cart(){
    $id = strip_tags($this->input->post('vst')) ;
    if(is_numeric($id) && isset($id)){
      foreach($this->get_db->get_items('tovar','id', $id) as $row)
        $data = array(
                  'id'      => $id,
                  'qty'     => 1,
                  'price'   => $row->price,
                  'name'    => $row->name,
                  'options' => array('sub' => ucfirst(str_replace('_',' ', $row->sub)), 'img' => $row->img_url)
               ); 
        
      $this->cart->insert($data);
    }
    echo $this->cart->total_items();
    //print_r($this->cart->contents());
      
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

          
  
  