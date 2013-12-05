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
    <a href="">Home</a>
  
  </nav>
  
  <section>
  
    <h2>New products</h2> 
    <div id="new_prod_frame">
    <a class="new_prod_arrow_left" href="">prev</a>
    <ul>  
  	<?php
      
      foreach($news as $row){         
        echo "
          <li>
          <img src='". $row->img_url ."' alt='obr'>
          <div class='item_content'>
            ". $row->name ."
          </div>
          <p>". $row->type ."</p>
          <span>". $row->price ." &euro;</span>
          <input type='button'>
        </li>
        ";
      }
    ?>
    </ul>
    <a class="new_prod_arrow_right" href="">next</a>
    </div>
  </section> 
  	

</div>
</body>
</html>