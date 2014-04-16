  <?php
    if($this->session->userdata('loged') != 1){
      if($suc){
        echo "<p class='warning_message_login'>Congratulations! You have succesfully activated your account. You can now Log In!</p>
              <p class='center'><a href='login' >Log in</a></p>
        ";
      }else{
        echo "<p class='warning_message_login'>Sorry, your account was already activated</p>     
        ";  
      }
    }
  ?>
