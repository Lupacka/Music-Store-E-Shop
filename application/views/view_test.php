<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
  <script type="text/javascript" src="<?php echo base_url("js/jquery.js") ?>"> </script>
	<title><?= $title?></title>
</head>
<body>
  <div id="chatframe" style="width:600px;height:250px;border:blue 1px solid; margin-bottom:10px;">
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
  <script type="text/javascript"> 
      
      $('#btn').click(function (){
       /* if( $('#nick').val() == "" || $('$chat').val() == ""){
          $('#warning').html('nevyplnili ste , to co treba!!');
          quit;
        }  */
        
        
        var timeObj = new Date();
        var time = timeObj.getHours()+":" + timeObj.getMinutes()+":"+ timeObj.getSeconds();
        var input = time + " " + $('#nick').val() + ": " + $('#chat').val() + "<br>";  
        $('#chatframe').append(input);
        $.post('test/save_com',{ vst: input});
      }); 
      
      $(document).ready(function(){
        var blaf;
        setInterval(function(){
          $.post("test/load_history?load=1", function(data){
            $('#chatframe').html("");
            for(var t in data){
               $('#chatframe').append(data[t]);
              //console.log(data[t]);
            }
          });  
        }, 10000);
      });          
    </script>   
</body>
</html>