<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo "Login"?></title>
  <script type="text/javascript" src="http://hudobniny.g6.cz/jsfunctions.js"></script>
  <link href="http://hudobniny.g6.cz/styles/style_main.css" rel="stylesheet" type="text/css" />
<body>
<div id="site">
  <header>
    <div id="top_links">
     <?php
      if(isset($not))
        echo "<span>". $not ."</span>";
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
      <?php echo anchor("","...",array('onclick' => 'showLoginPop()', 'class' => 'close_pop'))?>
      <p>Login</p>
      <?php
        $this->load->helper('form'); 
        echo form_open('/login_validation');
        echo "<span>Nick: </span>";
        echo form_input("nick");
       
        echo "<span>Password: </span>";
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
</section>
</div>

</body>
</html>