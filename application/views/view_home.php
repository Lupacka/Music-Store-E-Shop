<h2>New products</h2> 
    <div id="new_prod_frame">
    <a class="new_prod_arrow_left" href="">prev</a>
    <ul> 
  	<?php
      if(isset($news) && $news != ""){
        foreach($news as $row){         
          echo "
            <li>
            <img src='". base_url('/media/prod_photo/'.$row->id.'_thumb.jpg') ."' alt='obr'>
            <div class='item_content'>
              ". $row->name ."
            </div>
            <p>". $row->item_label ."</p>
            <div class='price'>
              <span>". $row->price ." &euro;</span>
              <input type='button'>
            </div>
          </li>
          ";
        } 
      }else{
        echo "<h3 style='margin-left:38%;margin-top:8%; position: absolute;'>No new products was found!!</h3>";
      }
    ?>
    </ul>
    <a class="new_prod_arrow_right" href="">next</a>
    </div>