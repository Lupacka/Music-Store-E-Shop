<h2>New products</h2> 
    <div id="new_prod_frame">
    <a class="new_prod_arrow_left" href="">prev</a>
    <ul> 
  	<?php
      
      foreach($news as $row){         
        echo "
          <li>
          <img src='". $row->img_url ."' alt='obr'>
          <div class='item_content'>
            ". $row->name ."
          </div>
          <p>". $row->type ."</p>
          <span>". $row->price ." &euro;</span>
          <input type='button'>
        </li>
        ";
      }
    ?>
    </ul>
    <a class="new_prod_arrow_right" href="">next</a>
    </div>