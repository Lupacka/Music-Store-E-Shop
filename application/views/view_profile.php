
  <?php if($this->session->userdata('loged') == 1){
    foreach($user_info as $row){ ?>
  <aside>
    <h2><?php echo $title?> picture: </h2>
    <?php
      echo "<img src='". $row->img_url ."' alt='". $row->name ."'>";  
    ?> 
    <br>
    <?php
    $this->load->helper('form');    
    echo form_open_multipart('/upload_profile_img',"id='img_form'");
    echo form_upload('img','',"onchange='checkUpload()' id='up_img' style='width:78px; margin-right: 19px;'");
    echo form_submit('submit', 'Send',"id='up_img_but' style='display: block; margin: 6px 0 0px 50px;' disabled");
    echo form_close();
    ?> 
  </aside>
   
  <div id="data_frame">
    <h2><?php echo $title;?></h2>
    <?php
    $notify = ""; 
    if($this->session->userdata('notify'))
      $notify = $this->session->userdata('notify'); 
    echo "<span id='notification'>".$notify . "</span>"; echo validation_errors("<span id='warning' style='margin-top:35px; margin-bottom:0px;'>","</span>");
    //echo $this->upload->display_errors('<p>', '</p>');
    
    $this->session->unset_userdata('notify');
    ?>
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
          <td> <?php echo "<span class='user_info'>".$row->p_number."</span>"; echo form_input("p_number", $row->p_number, "class='info'");?> </td>
        </tr>
        <tr>
          <td>Email: </td>
          <td> <?php echo "<span class='user_info'>".$row->email."</span>"; echo form_input("email", $row->email, "class='info'");?> </td>
          
          <td style="width:250px; text-align:center;">
          <a onclick="$('#user_change_form').submit();" id="userDataChanger"> Confirm change</a>
          <a onclick="changeElementsProfile();" id="inputChanger"> Change profile</a>
           
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
    <?php
      $id_tmp = 0;
      $price = 0;
      foreach ($orders as $value) {
        $id = $value->id_details;
        if($id != $id_tmp){
          $id_tmp = $id;
          echo "<div class='faktury'>
            <div class='header'>ID of order -> #". $value->id ."<span> Added: ". $value->added ."</span></div>
            <div class='content'>";
          echo "<div class='fac_table'><table>";
          foreach ($orders as $val) {
            if($id_tmp == $val->id_details){
                echo "<tr><td>";
                if($val->name == "UPS (+2 €)" ||  $val->name == "Bank transfer" ||
                   $val->name == "Remax (+3 €)" ||  $val->name == "Cash on delivery")
                    echo $val->name;
                else
                  echo anchor('/products?id='.$val->id_prod , $val->name);
                echo "</td><td><span>". $val->price ." &euro; </span>"."</td>";

                $price += $val->price;
            }
          }
          echo "<tr style='border-top:2px solid red;'><td></td><td><b>". $price ." &euro;</b></td></tr>";
          echo "</table>";
          

          echo "
              </div>
              <div class='fac_status'>
                <p>Status</p><span>";
          switch ($value->status) {
            case 1:
              echo "Prijata";
              break;
            case 2: echo "Expedovana";break;
            case 3: echo "Prijata zakaznikom"; break;

          }
          echo "</span></div>
            </div>
          </div>";
        }
      }
    ?>
  </div>
  <?php }else{
    echo "<p class='warning_message_login'>You must be loged in , in order to see this content!!</p>
          <p><a href='login' class='center'>Log in</a></p>
    ";
  }?>
 