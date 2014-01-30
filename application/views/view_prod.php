<div id="sub_cat">
<ul>
<?php
  $this->load->helper(array('url','form'));
  if(isset($sub_cat_menu) && $sub_cat_menu != ""){
    foreach($sub_cat_menu as $val){
      echo "<li>".anchor("/products?cat=". $cat . "&sub=". str_replace(' ','_', $val) , $val);
      if($this->session->userdata('group') == 1 && $this->session->userdata('loged') == 1)
        echo "";  
      echo "</li>";
    };
    
    if($this->session->userdata('group') == 1 && $this->session->userdata('loged') == 1)   
      echo "<li class='admin_add_sub'><a onclick='add_sub()' class='new_sub'><img src='http://hudobniny.g6.cz/media/img_web/green-plus.png' alt='add'>Add another sub catego.</a></li>";
  };  
?>
</ul>
</div>
<div id="prod_frame">
<?php
  if($this->session->userdata('group') == 1 && $this->session->userdata('loged') == 1)
    echo "<a onclick ='add_prod()' class='admin_add_prod'>Add new Product</a>";

  $sort = array(
            'name_asc' => 'Name ASC',
            'name_desc' => 'Name DESC',
            'price_asc' => 'Price ASC',
            'price_desc' => 'Price DESC'
   );
   if(isset($sub))
    echo form_open('/products?cat='.$cat.'&sub='.$sub);
   else
    echo form_open('/products?cat='.$cat);
   echo form_dropdown('sort', $sort);
   echo form_submit('sort_submit', 'GO');
   echo form_close();
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
  if(empty($prod))
    echo "<p> No product was found! </p>";
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

<div id="new_sub_div">
<img src="<?php echo base_url("/media/img_web/close_button_mini.png")?>" alt="krizik" style="float: right; cursor:pointer;" onclick="close_add_sub()">
<?php
    echo form_open("/add_sub");
    echo form_hidden('cat',$_GET['cat']);
    echo form_hidden('sub_menu', $sub_cat_menu);
    echo "<span>Name :</span>";
    echo form_input('sub_name','New Sub category',"id='sub_name'");
    echo form_submit('new_sub_go','submit');
    echo form_close();
?>
</div>

<div id="del_prod_div">
<img src="<?php echo base_url("/media/img_web/close_button_mini.png")?>" alt="krizik" style="float: right; cursor:pointer;" onclick="close_del_prod()">
<input type=hidden value="" id="temp_hidden_el">
<p>
  You really want to delete this product?<br>
  <input type="button" value="yes" onclick="window.location = 'products/del_product?cat=<?php echo strip_tags($_GET['cat'])?>&id='+ document.getElementById('temp_hidden_el').value+'' ">
  <input type="button" value="no" onclick="close_del_prod()">
</p>                          
</div>


<div id="new_prod_div">
<img src="<?php echo base_url("/media/img_web/close_button_mini.png")?>" alt="krizik" style="float: right; cursor:pointer;" onclick="close_add_prod()">
<h2>New product insertion</h2>
<table>
<?php
  $options_cat = array(
                   'guitars'  => 'Guitars',
                   'bass_guitars' => 'Bass Guitars',
                   'drums'   => 'Drums',
                   'keyboards' => 'Keyboards',
                 );
  $temp = "?cat=".strip_tags($_GET['cat']);
  echo form_open_multipart("/add_new_prod".$temp);
  echo "<tr><td><label for='name'>Name of product</label></td><td>";
  echo form_input('name','New prod name');
  echo "</td></tr><tr><td>
        <label for='cat'>Category: </label></td><td>";
  echo form_dropdown('cat',$options_cat, $_GET['cat']);
  echo "</td></tr><tr><td><label for='sub'>Sub Category: </label></td><td>";
  echo form_input('sub');
  echo "</td></tr><tr><td><label for='item_label'>Item Label: </label></td><td>";
  echo form_input('item_label')."Min 3 Max 15 chars";
  echo "</td></tr><tr><td><label for='about'>About: </label></td><td>";
  echo form_textarea('about'); 
  echo "</td></tr><tr><td><label for='price'>Price: </label></td><td>";
  echo form_input('price')."&euro;";
  echo "</td></tr><tr><td><label for='image'>Image: </label></td><td>";
  echo form_upload('img')."</td></tr><tr>";
  echo form_reset('Clear','Clear');
  echo form_submit('new_prod_submit','Submit');

?>
</table>
</div>