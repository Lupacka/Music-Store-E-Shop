<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {
  
  function __construct(){
    parent::__construct();
    }
	function registration(){
    $data['title'] = 'Registration';
    
    $this->load->view("view_reg", $data);
 }
 
  function reg_validation(){
   $this->load->helper('url');
    $this->load->library('form_validation');
    $config = array(
                array(
                  'field' => 'nick', 'label' => 'Nick', 'rules' => 'required|min_length[3]|max_length[15]|xss_clean|trim|callback_check_nick'      
                ) ,
                array(
                  'field' => 'pass', 'label' => 'Password', 'rules' => 'required|matches[pass_again]|min_length[6]|max_length[15]|xss_clean|trim'      
                ) ,
                array(
                  'field' => 'pass_again', 'label' => 'Pass_again', 'rules' => 'required|xss_clean|trim'      
                ) ,
                array(
                  'field' => 'name', 'label' => 'Name', 'rules' => 'required|min_length[3]|max_length[15]|xss_clean|trim'      
                ) ,
                array(
                  'field' => 'surname', 'label' => 'Surname', 'rules' => 'required|min_lenghth[3]|max_length[15]|xss_clean|trim'   
                )
                ,array(
                  'field' => 'street', 'label' => 'Street', 'rules' => 'required|min_lenghth[5]|max_length[25]|xss_clean|trim'    
                )
                ,array(
                  'field' => 'psc', 'label' => 'PSC', 'rules' => 'required|exact_length[5]|xss_clean|trim|numeric'    
                )
                ,array(
                  'field' => 'city', 'label' => 'City', 'rules' => 'required|min_lenghth[5]|max_length[15]|xss_clean|trim'    
                )
                ,array(
                  'field' => 'country', 'label' => 'Country', 'rules' => 'required|min_lenghth[5]|max_length[15]|xss_clean|trim'
                  )
                ,array(
                  'field' => 'p_number', 'label' => 'Phone number', 'rules' => 'required|min_lenghth[10]|max_length[20]|xss_clean|numeric|trim'    
                )
                ,array(
                  'field' => 'email', 'label' => 'Email', 'rules' => 'required|min_lenghth[5]|max_length[30]|xss_clean|valid_email|trim'    
                )    
    ); 
   $this->form_validation->set_rules($config); 
   if ($this->form_validation->run()){
    $this->load->model('registration');
    $salt =  $this->registration->salting();
    $act_key = MD5($this->registration->salting(15));
    //echo $salt . " " . $this->input->post('pass');
    $user = array(
            array_map('strip_tags', array(
              'nick' => $this->input->post('nick'),
              'pass' => $this->registration->make_pass($this->input->post('pass'), $salt),
              'salt' => $salt,
              'joined' => date('Y-m-d H:i:s'),
              'group' => 0,
              'activated' => $act_key
             )
            )
          );
    $str = $this->input->post('p_number');
    if($str[0] == '0')
      $str = substr($str, 1);
      
    $userdata = array(
                  array_map('strip_tags', array( 
                    'name' => $this->input->post('name'),   
                    'surname' => $this->input->post('surname'),
                    'adress' => $this->input->post('street'). ', ' . $this->input->post('psc') . ', ' . $this->input->post('city'),       
                    'country' => $this->input->post('country'),
                    'p_number' => $this->input->post('p_number_f').$str,
                    'email' =>  $this->input->post('email'),
                    'img_url' =>  base_url().'media/blank_person.jpg'
           )
          )
    );    
    
    if($this->registration->register_user($user, $userdata))
    		$this->registration->send_activation_email($act_key);   
    
    $this->load_notification('reg');
      redirect('/registration'); 
   }else{
    $this->load->view('view_reg');   
   } 

  }
  
  function check_nick(){
    $this->load->model('registration');
    if($this->registration->check_rec('nick',$this->input->post('nick'), 'users')){
      return true;
    }else{
      $this->form_validation->set_message('check_nick','Nickname already exists in database!!');
      return false;
    } 
  }
  function check_email(){
    $this->load->model('registration');
    if($this->login->find_rec('email', $this->input->post('email')))
      return true;
    else{
      $this->form_validation->set_message('check_email',"Your email adress already exist in database!!");
      return false;
    }
  }  
  function activate_acc() {
  	$this->load->model('registration');
  	$key = strip_tags($this->input->get('key', TRUE));
  	if($this->registration->activate_acc($key)) {
				$this->load->view('view_succ_activate');  		
  		}
		  	
  	}

  function login(){
    $data['title'] = "Login";
    $this->load->view("view_login", $data);
 }
  
 
  function login_validation(){
    $this->load->helper('url');
    $this->load->library('form_validation');
    $this->form_validation->set_rules('nick', 'Name', 'required|trim|xss_clean|callback_validate_login');
    $this->form_validation->set_rules('pass', 'Password', 'required|trim|xss_clean');

    if ($this->form_validation->run()){
      redirect('');
    }else{
      $this->load->view("view_login");
  }
 }

  function validate_login(){
    $this->load->model('login');
    $check = $this->login->login();
    if($check){
    		if($check === '2'){
					$this->form_validation->set_message('validate_login', 'Your account is not activated. Please check your email to do so...');
					return false;	    			
    			}
      return true;
    }
    else{
      $this->form_validation->set_message('validate_login','Incorrect username/password');
      return false;
    } 
 }

  function forgotten_pass(){
    
    $this->load->view("view_forg_pass");
  }
  function send_forgotten_pass(){
    $this->load->helper('url');
    $this->load->library('form_validation');
    $this->load->model('login');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|valid_email|callback_check_email_forg');
    
    if($this->form_validation->run() && $this->login->send_forgotten_pass()){
      $this->load_notification('new_pass');
      redirect('/forgotten_pass');
    }else
      $this->forgotten_pass();
  
  }
  function check_email_forg(){
    $this->load->model('login');
    if($this->login->find_rec('email','users_info'))
      return true;
    else{
      $this->form_validation->set_message('check_email_forg',"Your email adress doesn't exist in database!!");
      return false;
    }     
  }

  function logout(){
    $this->load->model('login');
    $this->login->logout();
    }
    
  function load_notification($id){
    $output = $this->notifications_auth($id);
    $this->session->set_userdata( array('notify' => $output));
  }

  function notifications_auth($id){
    if(isset($id)){
      switch($id){
        //case 'login': return "Your personal information has been changed!";
        //case 'logout': return "You have successfully logged out!";
        case 'reg': return "Congratulations ". $this->input->post('name') ." !!<br>You have been succesfully registered. <br> Please check your email for activation";
        case 'new_pass': return "'Your new pasword has been sent.";
      }
    }
  }

}