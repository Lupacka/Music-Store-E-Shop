<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title?></title>
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
        echo $this->input->post('pass');
        if($this->session->userdata('loged')){
          echo "Welcome <b>". ucfirst($this->session->userdata('nick')) . "</b>";
    		  echo " |".anchor('profile', 'Profile');
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
  
    <h2>About this project</h2> 
    <br>
    <p>
    This web application, which i called E-shop: Musical instruments store is intended to provide products associated with music industry.<br>
    E-shop is opened for general public, so they can purchase desired good or just find out new information about new products.
    ...
    </p>
    <br>
    Project specification:
    <ul>
      <li><a href="http://hudobniny.g6.cz/dlc/RP1_3.pdf">Slovak</a></li>
      <li><a href="http://hudobniny.g6.cz/dlc/RP1_3_en.pdf">English</a></li>
    </ul>
    <br>
    Project: 
    <ul>
      <li><a href="http://hudobniny.g6.cz/dlc/first_stage.zip">1. Stage</a></li>
      <li>2. Stage</li>
      <li>3. Stage</li>
      <li>4. Stage</li>
    </ul>
  </section> 
  	

</div>
</body>
</html>