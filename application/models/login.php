<?php

  class Login extends CI_Model{
  
    function find_rec($prop, $table){
      
      $this->db->where($prop, strip_tags($this->input->post($prop))); 
      $query = $this->db->get($table);
      
      if($query->num_rows() == 1){
        return $query->result();
      }
     return false;  
    }
    
    function login(){
      $this->load->model('registration');
      $user = $this->find_rec('nick', 'users');
     
      if ($user){
        foreach($user as $val)
         if($this->registration->make_pass(strip_tags($this->input->post('pass')), $val->salt) === $val->pass){
         	if($val->activated != '1'){
            return '2';
           } 
            $data = array(
              'nick' => $val->nick,
              'id' => $val->id,
              'group' => $val->group,
              'loged' => '1'
            );      
            $this->session->set_userdata($data);
            return true;  
            }
           }         
      return false;
       
    }
    
    function generateRandomString($length = 10) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, strlen($characters) - 1)];
      }
      return $randomString;
     }
     
    function send_email_newpass($new_pass,$nick){
      $this->load->library('email');
  	  $emaill = $this->input->post('email');
  	  $this->email->from('admin@hudobniny.cz', 'hudobniny.cz');
  	  $this->email->to($emaill); 
  	  $this->email->subject('Password recovery');
  	  $this->email->message("
      Dear ". $nick .", 
      You send us a request for a new password. 
      Your new password is: ".$new_pass."
      Please change your password, when you sign in with this new password.

Best regards,
hudobniny.cz team ");	
		$this->email->send();	  	
  	}
    
    function send_forgotten_pass(){
      $new_pass = $this->generateRandomString();
      $user = $this->find_rec('email', 'users_info');
      foreach($user as $val){
        $id = $val->id;
        $nick = $val->name;
      }
      $this->load->model('profile_mod');
      if($this->profile_mod->change_pass($new_pass, $id)){
        $this->send_email_newpass($new_pass, $nick);
        return true;
        }
    
    }

    function logout(){
      $this->load->helper('url');
      $this->session->sess_destroy(); 
      
      redirect('/home');
      
      
    }
  
  }

?>
