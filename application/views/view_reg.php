
  <h2>Registration</h2>
  <?php
    $notify = "";
    if($this->session->userdata('notify'))
      $notify = $this->session->userdata('notify');
    if(strlen($notify) < 4){
    $this->load->helper('form'); 
    echo form_open('/reg_validation');
    
    
    echo "<table>";
    echo "<tr><td>Nick: </td>";
    echo "<td>".form_input('nick');
    echo "</td></tr>";
    
    echo "<tr><td>Password: </td>";
    echo "<td>".form_password('pass');
    echo "</td><td><i>Min. 6 and max. 15 characters</i></td></tr>";
    
    echo "<tr><td>Password again: </td><td>";
    echo form_password('pass_again');
    echo "</td></tr>";
    
    echo "<tr><td>Email: </td><td>";
    echo form_input('email');
    echo "</td></tr><br>";
    
    echo "<tr><td>Name: </td><td>";
    echo form_input('name');
    echo "</td></tr>";
    
    echo "<tr><td>Surname: </td><td>";
    echo form_input('surname');
    echo "</td></tr>";
    
    echo "<tr><td>Street: </td><td>";
    echo form_input('street');
    echo "</td></tr>";
    
    echo "<tr><td>PSC: </td><td>";
    echo form_input('psc');
    echo "</td></tr>";
    
    echo "<tr><td>City: </td><td>";
    echo form_input('city');
    echo "</td></tr>";
    
    $options_country = array(
                  'Slovakia' => 'Slovak',
                  'Czech Republic' => 'Czech'
    );
    
    $options_phone = array(
                      '+421' => '+421',
                      '+420' => '+420'
    );
    
    echo "<tr><td>Country: </td><td>";
    echo form_dropdown('country', $options_country);
    echo "</td></tr>";
    
    echo "<tr><td>Mobile Number: </td><td>";
    echo form_dropdown('p_number_f',$options_phone);
    echo form_input('p_number');
    echo "</td></tr>";
    
    echo "<tr><td>";
    echo form_submit('reg_submit', 'Register');
    echo "</td></tr>";
    echo "</table>";
    echo form_close(); 
    
    echo validation_errors("<span id='warning' style='margin-top:35px; margin-bottom:0px;'>","</span>");  
    }else
      echo "<p class='warning_message_login'>".$notify."</p>";
     $this->session->unset_userdata('notify');
  ?>
