
  <h2>Forgotten Password</h2>
  <table>
  <?php
    $notify = "";
    $this->load->helper('form'); 
    echo form_open('/send_forgotten_pass');
    
    echo "<tr><td style='text-align: right;'>Email: </td><td>";
    echo form_input('email','',"style='float: left;'");
    echo "</td></tr>";
    
    echo "<tr><td>";
    echo form_submit('forg_submit', 'Send Email', "style='margin-left:100%;'");
    echo "</td>
    </tr>";
    echo "<tr><td colspan='2'><p> Please enter your email adress and after validation a new password will be sent. </p></td></tr>";
    echo "<tr><td colspan='2'>";
    echo validation_errors("<p id='warning'>","</p>");
    if($this->session->userdata('notify'))
      $notify = $this->session->userdata('notify');
     
    echo "<br><p id='notification'>". $notify ."</p></td></tr>";
    echo form_close();
    $this->session->unset_userdata('notify');
  ?>
  </table>
