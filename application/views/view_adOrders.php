<?php
	if($this->session->userdata('loged') && $this->session->userdata('group') == 1){
?>

	<h2> Orders Administration </h2>
	<?php
      $id_tmp = 0;
      $price = 0;
      foreach ($orders as $value) {
        $id = $value->id_details;
        if($id != $id_tmp){
          $id_tmp = $id;
          echo "<div class='faktury'>
            <div class='header'>ID of order -> #". $value->id_details ."<span> Added: ". $value->added ."</span></div>
            <div class='content'>";
          echo "<div class='fac_table'><table>";
          foreach ($orders as $val) {
            if($id_tmp == $val->id_details){
                echo "<tr><td>";
                if($val->name == "UPS (+2 €)" ||  $val->name == "Bank transfer" ||
                   $val->name == "Remax (+3 €)" ||  $val->name == "Cash on delivery")
                    echo $val->name;
                else
                  echo anchor('/products?id='.$val->id_prod , $val->name);
                echo "</td><td><span>". $val->price ." &euro; </span>"."</td>";

                $price += $val->price;
            }
          }
          echo "<tr style='border-top:2px solid red;'><td></td><td><b>". $price ." &euro;</b></td></tr>";
          echo "</table>";
          

          echo "
              </div>
              <div class='fac_status'>
              	<table border='0'>
                <tr><td style='font-size: 17px; font-weight: bold;'>Status</td><td><span id='". $value->id_details ."'>";
          switch ($value->status) {
            case 1:
              echo "Prijata";
              break;
            case 2: echo "Expedovana";break;
            case 3: echo "Prijata zakaznikom"; break;

          }
          echo "</span></td></tr>
          		<tr><td colspan='2' >Status Change</td></tr>
          		<tr style='height: 80px;' class='center'><td colspan='2'>
          			<a onclick='order_chg_status(1,". $value->id_details .")'>Prijata</a>
          			<a onclick='order_chg_status(2,". $value->id_details .")')>Expedovana</a>
          			<a onclick='order_chg_status(3,". $value->id_details .")''>Prijata zakaznikom</a>
          		</td></tr>
          		
          		</table>
          		</div>
            </div>
          </div>";
        }
      }
    ?>




<?php
	}else
		echo "<h1>U're no admin!!</h1>"
?>