<?php
 $this->load->helper('url');
 $this->load->helper('form');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?= $title?></title>
  <script type="text/javascript" src="<?php echo base_url("js/jquery.js") ?>"> </script>
  <script type="text/javascript" src="<?php echo base_url("js/jsfunctions.js")?>"> </script>
  <script type="text/javascript" src="<?php echo base_url("js/jsfunctions2.js")?>"> </script>
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
  	      
      			?><a onclick="toggle_elements('#login_pop', 500);">Login</a> ||<?php 
      			echo anchor('/registration', 'Registration' , '');
        };
     ?>
      <div id="login_pop">
      <img src="<?php echo base_url("/media/img_web/close_button_mini.png")?>" alt="krizik" style="float: right; cursor:pointer; margin-left: 151px;" onclick="toggle_elements('#login_pop', 500);"> 
      <p>Login</p>
      <?php
         
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
    <div id="nav_links">
      <?php
        echo anchor('/home','Home');
        echo anchor('/products?cat=guitars','Guitars');
        echo anchor('/products?cat=bass_guitars','Bass Guitars');
        echo anchor('/products?cat=drums','Drums');
        //echo anchor('/products?cat=keyboards','Keyboards');
        echo anchor('/about','About');
      ?>
    </div>
    <div id="nav_search">
      <input type="text" id="val" size="42">
      <?php 
        echo anchor("/products?srch=0","<img src='". base_url('media/img_web/search.png')."'>","id = 'srch_sub'");
      ?>
      <div id="feedback"></div>
    </div>
  <script type="text/javascript"> 
      
      $('#val').keyup(function (){
        var input = $.trim($('#val').val());
        if (input != "")
          $('#srch_sub').attr('href','/hudobniny/index.php/products?srch=' + input);
           
        $.post('hudobniny/prod_search',{ vst: input},function(out){
          $('#feedback').html(out);
        });
      }); 
    </script>  
  </nav>
  <section>
    <?= $content ?>
  <div id="overlay">  
  </section> 
  	

</div>
</body>
</html>