<style>
table, .udaje_email{border-collapse: collapse; border-spacing: 0; border-color: gray; 
      FONT-FAMILY: verdana,tahoma,arial,helvetica; font-size:12px; border-radius: 7px; }
.tr_none, .udaje, .udaje_email, .methods, input[type=submit]{display: none}
.overview{}
.overview tr{vertical-align: inherit; border-color: inherit;}
.overview th{padding: 0; color: #fff; background:url(../media/img_web/basket_sprite.png) 0 -240px; height: 22px;}
.overview td{max-width:60px; background:url(../media/img_web/basket_sprite.png) 0 0; padding:7px 0;}
.overview td input{text-align: center; border: 1px solid #bababa; border-radius: 5px;}
.overview td input[type='text']{ width: 32px; height: 22px;}
.overview .t_cross{ padding:0 15px;}
.overview .t_cross img {cursor: pointer;}
.overview .t_item{text-align: left; width: 331px;padding-left: 5px;}
.overview .t_item span{font-weight: bold; font-size: 11px; margin-left: 7px; }
.overview .t_item img{float:left; width: 14%;}
.overview .t_quant{padding:0 10px;}
.overview .t_price{text-align:right; padding-right: 6px; width: 90px; font-weight: bold;}
.overview .t_sum{width:100%;}
.udaje {width: inherit; height: 240px; margin-bottom: 30px;}
.udaje table input{display:block;}
.udaje td, .udaje_email table td {height: 35px;width: 180px;} 
.mark{ background-color: #F0EDE3; font-weight: bold;}
.udaje .delivery {margin-left: 25px;}
.udaje_email{width: 365px; height: 130px;}
.udaje_email h4, .methods h4{padding: 9px 0; font-weight: bold;}
.methods {width: 365px;}
.submit_order{float:right; margin-right: 45px;}

/*td .t_price{font-weight: bold; font-size: 5px;}*/ 

</style>

<h2>Your Shopping Basket</h2>
<div class="udaje">
  <table style="float:left;">
    <tr class="mark"> 
    <td colspan="2">Invoice and Delivery Address</td>
    </tr>
    <?php
    $sum = 0;
     
      foreach($user_data as $val){
        $adress = explode(',', $val->adress);
      
      echo form_open('/order_validation');
      echo "<tr><td>First name:</td><td>".form_input('first' , $val->name)."</td></tr>";
      echo "<tr><td>Last name:</td><td>".form_input('last' , $val->surname)."</td></tr>";
      echo "<tr><td>Adress:</td><td>".form_input('adress', $adress[0])."</td></tr>";
      echo "<tr><td>ZIP/Postal code:</td><td>".form_input('zip' ,trim($adress[1]))."</td></tr>";
      echo"<tr><td>City: </td><td>". form_input('city',trim($adress[2]))."</td></tr>";
      echo"<tr><td>Country:</td><td>". form_input('country', $val->country);
      echo "</td></tr></table>";//};
    ?>
  <div class="delivery" style="display:none;">
    <table class="udaje" style="">
      <tr> 
      <td colspan="2" class="mark">Delivery Address</td>
      </tr>
      <?php
        echo "<tr><td>First name:</td><td>".form_input('d_first')."</td></tr>";
        echo "<tr><td>Last name:</td><td>".form_input('d_last')."</td></tr>";
        echo "<tr><td>Adress:</td><td>".form_input('d_adress')."</td></tr>";
        echo "<tr><td>ZIP/Postal code:</td><td>".form_input('d_zip')."</td></tr>";
        echo"<tr><td>City: </td><td>". form_input('d_city')."</td></tr>";
        echo"<tr><td>Country:</td><td>". form_input('d_country');
        echo "</td></tr></table>";
      //}
      ?>
  </div>
  
  <input type='checkbox' id="chk_d" class='d_a' onclick="$('.delivery').toggle(425); $('.d_a').hide(100);"> <span class='d_a'>I'd like to enter a different delivery address.</span>
</div>
<?php
  if($this->cart->total() == 0){
    echo "<h2>Your basket is empty...</h2>";
    echo "<img src='../media/img_web/sad.png' style='width: 25%; '>";
  }else {
?>
<div class="overview">
  <table><tbody>
  <tr class="t_header">
    <th class="t_cross">&nbsp;</th>
    <th class="t_item">item</th>
    <th class="t_quant" style="">quantity</th>
    <th class="t_price" style="">total price</th>
  </tr>
  <?php
    
    foreach ($this->cart->contents() as $key) {
      $sum += $key{'price'};
      echo "
      <tr id='". $key['rowid'] ."'>
        <td class='t_cross'><img src='../media/img_web/red-x.png' alt='x' id='". $key['rowid'] ."'></td>
        <td class='t_item'>
          <img src='..". $key['options']['img'] ."'>
          <span>". $key['name'] ."<span>
        </td>
        <td style='text-align: center;''><input type='text' value='1' id='". $key['id'] ."' name='cart_prod_price'></td>
        <td class='t_price'><span id='p". $key['id']."'>". $key['price'] ."</span> &euro;</td>
      </tr>";
  }?>
  <tr class='tr_none'>
    <td></td>
    <td>Delivery by <span id='d_sum' style="font-weight:bold;"></span></td>
    <td></td>
    <td class="t_price" id="d_p"></td>
  </tr>
  <tr class='tr_none'>
    <td></td>
    <td>Payment by <span id='p_sum' style="font-weight:bold;"></span></td>
    <td></td>
    <td class="t_price" id="p_p"></td>
  </tr>
  <tr class="t_sum" celspan="4" style="border-top: black solid 2px;">
    <td></td>
    <td></td>
    <td></td>
    <td class="t_price"><span id="sum" style="font-size: 14px;"><?php echo $sum;?></span> &euro;</td>
  </tr>
  </tbody>
  </table>
</div>
<?php };?>
<div class="udaje_email">
<h4 style="" class="mark">eMail and phone number</h4>
<table>
   <?php
      echo "<tr><td>eMail:</td><td>".form_input('email', $val->email)."</td></tr>";
      echo "<tr><td>Phone number:</td><td>".form_input('phone', $val->p_number)."</td></tr>";
    };
   ?>
</table>
</div>
<div class="methods">
  <h4 style="" class="mark">Payment and delivery method</h4>
  <?php
    echo "<label for='ups' class='ups'>UPS (+2 &euro;)</label>".form_radio('delivery','2',true,"id='ups' onchange='recalculate_chk(".$sum.")'");
    echo "<br><label for='remax' class='remax'>Remax (+3 &euro;)</label>".form_radio('delivery','3','',"id='remax' onchange='recalculate_chk(".$sum.")'");
    echo "<br><br><label for='bank' class='bank'>Bank transfer</label>".form_radio('cash','0',true,"id='bank' onchange='recalculate_chk(".$sum.")'");
    echo "<br><label for='cash' class='cash'>Cash on delivery (+1 &euro;)</label>".form_radio('cash','1','',"id='cash' onchange='recalculate_chk(".$sum.")'");
  ?>
</div>






<?php
    echo form_hidden('delivery_h','') . form_hidden('cash_h','');
    echo form_submit('','Confirm Order',"class='submit_order'");
    echo form_close();
    if($this->cart->total() != 0)
      echo "<button id='chk_out' onclick='check_out();''>proceed to checkout</button>";
  ?>
