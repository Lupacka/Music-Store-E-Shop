<?php
foreach($prod as $row){
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
    echo "<h2 style='border-bottom: 1px solid #F1F1F1; font-size: 19px;'>" . $row->name . "</h2>";
    $pom = 0;
    for($i = 0; $i < 4; $i++ ){
       if($row->rating >= $pom)
         echo "<img src='http://hudobniny.g6.cz/media/img_web/one_star_fill.png' style='width:30px;height:30px;'>";
       else
         echo "<img src='http://hudobniny.g6.cz/media/img_web/one_star.png' style='width:30px;height:30px;'>"; 
       $pom += 25; 
    }
    echo "<img src='http://hudobniny.g6.cz/media/img_web/one_star.png' style='width:30px;height:30px;'>";
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
  echo $row->about;
?>
</div>
 <div id="prod_price">
Price:<br> 
<?php
  echo "<b style='float:right;font-size: 25px;'>".$row->price.",-&euro;</b>";
  
?><br>
<input type="button" value='Add to shopping cart'>
</div> 

