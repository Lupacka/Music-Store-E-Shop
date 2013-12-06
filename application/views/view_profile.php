<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title?></title>
  <script type="text/javascript" src="http://hudobniny.g6.cz/jsfunctions.js"></script>
  <link href="http://hudobniny.g6.cz/styles/style_main.css" rel="stylesheet" type="text/css" />
  <link href="http://hudobniny.g6.cz/styles/style_profile.css" rel="stylesheet" type="text/css" />
<body>
<div id="site">
  <header>
    <div id="top_links">
    <?php
  	  $this->load->helper('url');
        echo $this->input->post('pass');
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
    <a href="home">Home</a>
  </nav>
  
  <section>
  <?php if($this->session->userdata('loged') == 1){?>
  <aside>
    <h2><?php echo $title?> picture: </h2>
    <?php
    
    foreach($user_info as $row){
      if(file_exists('./media/users_photo/'.$this->session->userdata('id').'.jpg'))
        echo "<img src='". $row->img_url ."' alt='". $row->name ."'>";
      else
        echo "<img src='". base_url()."media/blank_person.jpg' alt='". $row->name ."'>"; 
    ?> 
    <br>
    <?php
    echo form_open_multipart('/upload_profile_img');
    echo form_upload('img','',"style='width:78px; margin-right: 19px;'");
    echo form_submit('submit', 'Send',"style='display: block; margin: 6px 0 0px 50px;'");
    echo form_close();
    ?>
  
  </aside> 
  <div id="data_frame">
    <h2><?php echo $title;?></h2>
    <?php echo "<p id='notification'>".$notify . "<p>"; echo validation_errors("<p id='warning' style='margin-top:35px; margin-bottom:0px;'>","</p>")?>
    <br>
      <?php
        $this->load->helper('form');
        
        echo form_open('update_profile', "id='user_change_form'");  
      ?>
      <table border = "0" id="users_info">
        <tr>
          <td style="width: 100px;">Name: </td>
          <td> <?php echo "<span class='user_info'>".$row->name."</span>"; echo form_input("name", $row->name, "class='info'");?> </td>
          
          
        </tr>
        <tr>
          <td>Surname: </td>
          <td><?php echo "<span class='user_info'>".$row->surname."</span>"; echo form_input("surname", $row->surname, "class='info'");?></td>
        
        
        </tr>
        <tr>
          <td>Adress: </td>
          <td><?php echo "<span class='user_info'>".$row->adress."</span>"; echo form_input("adress", $row->adress, "class='info'");?> </td>
          
        </tr>
        <tr>
          <td>Country: </td>
          <td><?php echo "<span class='user_info'>".$row->country."</span>"; echo form_input("country", $row->country, "class='info'");?> </td>
        </tr>
        <tr>
          <td>Phone number: </td>
          <td> <?php echo "<span class='user_info'>+421".$row->p_number."</span>"; echo form_input("p_number", $row->p_number, "class='info'");?> </td>
        </tr>
        <tr>
          <td>Email: </td>
          <td> <?php echo "<span class='user_info'>".$row->email."</span>"; echo form_input("email", $row->email, "class='info'");?> </td>
          
          <td style="width:250px; text-align:center;">
           <a onclick="changeElementsProfile();" id="inputChanger"> Change profile</a>
           <a onclick="document.getElementById('user_change_form').submit();" id="userDataChanger"> Confirm change</a>
          </td>
        </tr>
      </table>
      <?php }; 
      echo form_close();
      echo "<h2>Password Change</h2>";
      echo form_open('/change_password', "id='pass_change_form'")
      ?>

  <table border="0" id="change_pass">
		<tr>
			<td style="float: right;">Password: </td>
			<td><?php echo form_password("pass_old", "","class='pass'" );?></td>	
		</tr>
		<tr>
			<td style="float: right;">New Password: </td>
			<td><?php echo form_password("pass_new", "","class='pass'" );?></td
		</tr>
	    <tr>
			<td style="float: right;">Repeat Password: </td>
			<td><?php echo form_password("pass_again", "","class='pass'" );?></td>
		</tr>
    <tr><td colspan='2'><a onclick="document.getElementById('pass_change_form').submit();">Change Password</a></td></tr>
  </table>
	<?php form_close();?>
    <br>  
    <h2>Factures</h2>
  </div>
  <?php }else{
    echo "<p class='warning_message_login'>You must be loged in , in order to see this content!!</p>
          <p><a href='login' class='center'>Log in</a></p>
    ";
  }?>
  </section>
  
  
  	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>

</div>

</body>
</html>