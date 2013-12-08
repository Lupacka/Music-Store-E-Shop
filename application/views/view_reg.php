<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo "Registration"?></title>
  <script type="text/javascript" src="http://hudobniny.g6.cz/jsfunctions.js"></script>
  <link href="http://hudobniny.g6.cz/styles/style_main.css" rel="stylesheet" type="text/css" />
<body>
<div id="site">
  <header>
     <div id="top_links">
    <?php
  	  $this->load->helper('url');
        if($this->session->userdata('loged')){
          echo "Welcome <b>". ucfirst($this->session->userdata('nick')) . "</b>";
    		  echo " |".anchor('/profile', 'Profile');
    		  echo anchor('/logout', 'Logout', '');
        }else{
  	     echo  
      			"<a onclick='showLoginPop()'>Login</a> ||".
      			anchor('/registration', 'Registration' , '');
       
        };
     ?>
      <div id="login_pop">
      <?php echo anchor("#","...",array('onclick' => 'showLoginPop()', 'class' => 'close_pop'))?>
      <p>Login</p>
      <?php
        $this->load->helper('form'); 
        echo form_open('/login_validation');
        echo "<span>Nick: <span>";
        echo form_input("nick");
       
        echo "<span>Password: <span>";
        echo form_password("pass");
       
        echo form_submit('login_submit', 'Login');
        echo form_close();
        echo anchor('/forgotten_pass','Forgotten password?','style="float:right; margin-top: -18px; color: #7a8a94;"');
      ?>
      </div>
    </div>
    <h1>hudobniny.cz</h1>
  </header>
  <nav>
    <?php
      echo anchor('/home','Home');
      echo anchor('/about','About');
    ?>
  </nav>
  
  <section>
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
    
    echo validation_errors();  
    }else
      echo "<p class='warning_message_login'>".$notify."</p>";
     $this->session->unset_userdata('notify');
  ?>
</section> 
</div>

</body>
</html>