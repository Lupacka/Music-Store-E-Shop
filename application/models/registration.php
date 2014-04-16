<?php

  class Registration extends CI_Model{
  
  function check_rec($prop, $user, $table){
      
      $this->db->where($prop, strip_tags($user));
      $query = $this->db->get('users');
      
      if($query->num_rows() > 0){
        return false;
      }else{
        return true;
      }      
    }

  function make_pass($string, $salt){
      return hash_hmac('sha256', $string , $salt);   
  }
  
  function salting($length = 32){
      return mcrypt_create_iv($length);   
  }
  
  function register_user($user, $userdata){

    $this->db->insert_batch("users", $user);   
    if($this->db->insert_batch("users_info", $userdata))
    	return true; 
  
  }
  function send_activation_email($act){
  	$this->load->library('email');
  	$this->load->helper('url');
	  $nick  = $this->input->post('nick');
	  $emaill = $this->input->post('email');
	  $this->email->from('admin@hudobniny.cz', 'hudobniny.cz');
	  $this->email->to($emaill); 
	  $this->email->subject('Account Activation');
	  $this->email->message("
    Welcome ". $nick .", 
    In order to activate your account, you have to activate it. Please click on  link bellow: 
    ".base_url()."index.php/activate_acc?key=". $act ."

    Best regards,
    hudobniny.cz team ");	
		$this->email->send();	  	
  	}
  
  function activate_acc($key){
			  	
    $this->db->where('activated', $key);
    $query = $this->db->get('users');
      
    if($query->num_rows() >= 1){
      $this->db->where('activated', $key);
      if($this->db->update('users',array('activated'=>'1')))
         return true;     
  	 }
    }
}
?>
