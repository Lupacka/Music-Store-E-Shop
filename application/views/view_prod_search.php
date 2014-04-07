<div id="sub_cat">
  <ul>
  <?php
    $this->load->helper(array('url','form'));
    if(isset($prod)){
      foreach($prod as $val){
        echo "<li>".anchor("/products?cat=". $val->category . "&sub=". $val->sub , str_replace('_',' ', $val->sub));  
        echo "</li>";
      }; 
    };
  ?>
  </ul>
</div>

<div id="prod_frame">
  <?php
    $sort = array(
              'name_asc' => 'Name ASC',
              'name_desc' => 'Name DESC',
              'price_asc' => 'Price ASC',
              'price_desc' => 'Price DESC'
     );
    /* if(isset($sub))
      echo form_open('/products?cat='.$cat.'&sub='.$sub);
     else
      echo form_open('/products?cat='.$cat);
     echo form_dropdown('sort', $sort);
     echo form_submit('sort_submit', 'GO');
     echo form_close();   */
  ?>
   <div id="prod_frame_header">
     <p>
     <?php
     /* if(empty($prod))
        echo "<span onload='invalid_input_prod()'>Invalid !!</span>";
      else*/ 
      echo $title;
      if(isset($sub)){
        $sub_clean = str_replace('_',' ', $sub);
        if(in_array($sub_clean, $sub_cat_menu)){
          echo " -> " . ucfirst($sub_clean); 
          }
      }
     echo "</p>";
     
   
      
     ?>
   </div>
   <ul>
   <?php
    if(empty($prod)){
      echo "<p> No product was found! </p>";
      echo "
        <script type='text/javascript'>
          $(document).ready(function(){
            $('section').css('height','300px');
          })
        </script> 
      ";
    }
    else
      foreach($prod as $val){
          echo "<li>";
          if($this->session->userdata('group') == 1 && $this->session->userdata('loged') == 1)
             echo "<img src=" . base_url("/media/img_web/red-x.png") . " alt='krizik' style='float: right; cursor:pointer;' onclick='del_prod(".$val->id.")'>"; 
          echo "<div class='item_image'>";
          echo anchor('/products?id='.$val->id,"<img src='".base_url('/media/prod_photo/'.$val->id.'_thumb.jpg')."' alt='".$val->name."'>");
          echo "</div>";
          
          echo "<p>" . anchor('/products?id='.$val->id,$val->name) . "</p>";
          echo "<div class='price'>
               <span>". $val->price . " &euro;</span>
               <input type='button'>
               </div>
          ";
          echo "</li>";
       }
     ?>
  </ul> 
</div>