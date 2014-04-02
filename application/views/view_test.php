<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
  <script type="text/javascript" src="<?php echo base_url("js/jquery.js") ?>"> </script>
  <script type="text/javascript" src="<?php echo base_url("js/jsfunctions2.js")?>"> </script>
	<title><?= $title?></title>
</head>
<body>
  <div id="chatframe" style="width:600px;height:250px;border:blue 1px solid; margin-bottom:10px; overflow-y:auto;, overflow-x:hidden;">
    <?php
      if(isset($his)){
        foreach($his as $line){
          echo $line."<br>";
        }
      }
    ?>
  </div>
  <input type="text" name="nick" id="nick">
  <input type="text" name="chat" id="chat" style="width:400px;">
  <input type="button" name="go" id="btn" value="Go"> 
  <div id="warning"></div>
   
</body>
</html>