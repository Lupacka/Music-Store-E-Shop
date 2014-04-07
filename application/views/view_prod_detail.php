<div id = "product_section">
<?php
$this->load->helper('form');
foreach($prod as $row) { };
?>
  <div id = "chain">
  <?php
    echo "<span class='chain'>Products / ". anchor('/products?cat=guitars' ,ucfirst($row->category)) ." / ". anchor('/products?cat=guitars&sub='.$row->sub ,ucfirst(str_replace('_',' ', $row->sub))) .
    "</span>";  
    ?>
  </div>
  <div id = "prod_photo">
  <?php
    echo "<a href='".base_url($row->img_url)."'><img src='".base_url('/media/prod_photo/'.$row->id.'_thumb.jpg')."' alt='". $row->id."'></a>";
  ?>  
  </div> 
  
  
  <div id = "prod_header">
  <?php
     
      echo form_open('/foo');
      if($this->session->userdata('group') == 1 && $this->session->userdata('loged') == 1) 
        //echo "<a style='float:right; cursor: pointer;' onClick='changeElementsProd()')>Change</a>";
        echo "<a style='float:right; display:none;' onClick=''>Confirm change</a>";
        
      echo "<h2 class='orig_content' style='border-bottom: 1px solid #F1F1F1; font-size: 19px;'>" . $row->name . form_input('rating',$row->rating, "class='prod_change_form'"). "</h2>";
      $pom = 0;
      echo form_hidden('hidden_rating',$row->rating);
      for($i = 0; $i < 5; $i++ ){
         if($row->rating >= $pom)
           echo "<img src='http://hudobniny.g6.cz/media/img_web/one_star_fill.png' style='width:30px;height:30px;'>";
         else
           echo "<img src='http://hudobniny.g6.cz/media/img_web/one_star.png' style='width:30px;height:30px;'>"; 
         $pom += 25; 
      }
      echo "<span style='font-size: 10px; font-style: italic;'>This product was rated <span id='rat_times' style='color:red;'>".$row->rated."</span>x times</span>";
      echo form_input('rating',$row->rating, "class='prod_change_form'");
      echo form_close(); 
  ?> 
  </div>
  
  <div id="prod_about">
    <?php
      echo $row->about. form_textarea('newabout',$row->about,"class='prod_change_form'");
    ?>
  </div>
  
  <div id="prod_price">
    Price:<br> 
    <?php
      echo "<b class='orig_content' style='float:right;font-size: 25px;'>".$row->price. form_input('newPrice',$row->price,"class='prod_change_form' style='width: 40px;'").",-&euro;</b>"; 
        
    ?><br>
    <input type="button" value='Add to shopping cart'>
    
  </div> 
  
  
    
</div>

<div id = "comments_section">
  <div id="comments_frame_header">
    User comments and ratings
  </div>
  <div id ="comments_frame">
  	 <div id="comments_add">
      <?php
        if($this->session->userdata('loged') == 1){
          echo form_open('products/add_comment_rate');
          echo "Nick: ". $this->session->userdata('nick');
          
          echo "<div id='com_rating' style='float:right;'>";
          for($i = 1; $i <= 5 ; $i++){
            echo "<span id='".$i."' onclick='com_rating(". $i .");'></span>";
            echo form_radio("rating",$i*20,'',"id='".$i."_chck'");
          }
          
          echo "</div>";
          
          echo form_textarea('comment', '', "maxlength='200'");
          echo form_hidden('get',strip_tags($_GET['id']));
          echo form_hidden('times','');
          echo form_hidden('rat_origin','');
          
          echo form_submit('commit','Send',"id='commit_comment'");
          echo form_close();
        }else{
          echo "<p id='warning' style='text-align:center;'>You have to be logged to comment</p>";
        }
      ?>
    </div>	
    <?php 
  		//print_r($comments);
  		foreach($comments as $row){	
  	?>	
  	<div class="comment">
  		<div class="comment_img">
  		<img src="<?php echo $row->img_url;?>" alt="pic">
  		</div>		
  		<div class="comment_header">
  			Added by: <?php echo $row->user;?>
  			<div class="user_rate">
          <?php
            $pom = 0;
            for($i = 0; $i < 5; $i++ ){
            if($row->rate >= $pom)
              echo "<img src='http://hudobniny.g6.cz/media/img_web/one_star_fill.png' style='width:15px;height:15px;'>";
            else
              echo "<img src='http://hudobniny.g6.cz/media/img_web/one_star.png' style='width:15px;height:15px;'>"; 
            $pom += 25; 
           }
          ?>
        </div>
  		</div>		
  		<div class="comment_content">
  			<?php echo $row->comment;?>
  		</div>
  		<div class="comment_footer">
  			<span><?php echo $row->date;?></span>
  		</div>
  	</div>
  	<?php }; ?>
  </div>
  
</div>



