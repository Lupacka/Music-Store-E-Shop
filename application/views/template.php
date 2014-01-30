<?php
 $this->load->helper('url');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?= $title?></title>
  <script type="text/javascript" src="<?php echo base_url("jsfunctions.js") ?>"> </script>
  <link href="<?php echo base_url('styles/style_main.css')?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('styles/style_profile.css')?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('styles/style_prod.css')?>" rel="stylesheet" type="text/css" />
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
    		  echo " |".anchor('profile', 'Profile');
    		  echo anchor('/logout', 'Logout', '');
        }else{
  	     	echo  
      			"<a onclick='showLoginPop()'>Login</a> ||".
      			anchor('/registration', 'Registration' , '');
        };
     ?>
      <div id="login_pop">
      <img src="<?php echo base_url("/media/img_web/close_button_mini.png")?>" alt="krizik" style="float: right; cursor:pointer; position: absolute; margin-left: 151px;" onclick="showLoginPop()"> 
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
      echo anchor('/products?cat=guitars','Guitars');
      echo anchor('/products?cat=bass_guitars','Bass Guitars');
      echo anchor('/products?cat=drums','Drums');
      echo anchor('/products?cat=keyboards','Keyboards');
      echo anchor('/about','About');
    ?>
  </nav>
  <section>
    <?= $content ?>
  <div id="overlay">  
  </section> 
  	

</div>
</body>
</html>