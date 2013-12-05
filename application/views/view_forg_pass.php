<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo "Forgotten Password"?></title>
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
    <a href="home">Home</a>
  </nav>
  
  <section>
  <h2>Forgotten Password</h2>
  <table>
  <?php
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
    echo "<br><p id='notification'>". $notify ."</p></td></tr>";
    echo form_close();
   
  ?>
  </table>
</section>
</div>

</body>
</html>