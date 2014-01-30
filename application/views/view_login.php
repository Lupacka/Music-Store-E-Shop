
  <h2>Login</h2>
  <table>
  <?php
    $this->load->helper('form'); 
    echo form_open('/login_validation');
    
    echo "<tr><td>Nick: </td><td>";
    echo form_input('nick');
    echo "</td></tr>";
    
    echo "<tr><td>Password: </td><td>";
    echo form_password('pass');
    echo "</td></tr>";
    
    echo "<tr><td>";
    echo form_submit('login_submit', 'Login');
    echo "</td>
    <td>Dont have account yet? ". anchor('/registration','Registrate') ." now!!</td>
    </tr>";
    echo "<tr><td colspan='2'>";
    echo validation_errors("<p id='warning'>","</p>");
    echo "</td></tr>";
    echo form_close();
   
  ?>
  </table>
