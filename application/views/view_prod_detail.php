<?php
$this->load->helper('form');
foreach($prod as $row) {
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
    for($i = 0; $i < 5; $i++ ){
       if($row->rating >= $pom)
         echo "<img src='http://hudobniny.g6.cz/media/img_web/one_star_fill.png' style='width:30px;height:30px;'>";
       else
         echo "<img src='http://hudobniny.g6.cz/media/img_web/one_star.png' style='width:30px;height:30px;'>"; 
       $pom += 25; 
    }
    echo form_input('rating',$row->rating, "class='prod_change_form'");
  }; 
?> 

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/sk_SK/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
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

<div id="comments_frame">
	<div id="comments_add">
    <?php
      if($this->session->userdata('loged') == 1){
        echo form_open('/foo');
        echo "<span>Nick: ". $this->session->userdata('nick') ."       </span>";
        
        echo "<div id='com_rating'>";
        echo form_label('','1');
        echo form_checkbox('1','','',"id='1' onclick='com_rating(1);'");
        echo "</div>";
        
        echo form_textarea('comment', '', "maxlength='200' ");
        echo form_submit('commit','Send');
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
			<span class="user_rate"></span>
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
