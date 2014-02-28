<?php
  echo "buzna";
  if(isset($_POST['vst'])){
     $vst = strip_tags($_POST['vst']);
     echo strrev($vst);
  }
?>