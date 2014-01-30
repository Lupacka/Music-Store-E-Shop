<?php

  class Profile_mod extends CI_Model{
  
    function find_pass($user){
      $this->db->where('nick', $user);
      $query = $this->db->get('users',1);
        
      if($query->num_rows() == 1){
        return $query->result();
        }
      return false;  
    }
    
    function check_pass($user){
      $this->load->model('registration');
      $data = $this->find_pass($user); 
      if($data){
        foreach($data as $val){
          if($this->registration->make_pass($this->input->post('pass_old'), $val->salt) === $val->pass)
            return true;   
        }
      }
      return false;
     }
     
    function change_pass($new_pass, $id){
     $this->load->model('registration');  
     $salt = $this->registration->salting();  
     $data = array(
              'pass' => $this->registration->make_pass($new_pass,$salt),
              'salt' => $salt
            );
    
     $this->db->where('id', $id);
     
     if($this->db->update('users', $data))   
      return true;
     else
      return false; 
    }
    
    function update_user_info($data){
      $this->db->update_batch("users_info", $data , "id");    
    }
    
    function get_user_info($id){ 
      $query = $this->db->get_where('users_info', "id = ".$id );
      return $query->result(); 
    }
    
    function up_db_photo($atr){
      $this->load->helper('url');
      $this->db->where('id', $this->session->userdata('id'));
      $this->db->update('users_info', array( 'img_url'=> base_url().'media/users_photo/'. $this->session->userdata('id').$atr));
    }
}
?>
