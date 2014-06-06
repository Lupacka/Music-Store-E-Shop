<style>
table{border-collapse: collapse; border-spacing: 0; border-color: gray; 
      FONT-FAMILY: verdana,tahoma,arial,helvetica; font-size:12px; border-radius: 7px;}
table tr{display: table-row; vertical-align: inherit; border-color: inherit;}
table th{padding: 0; color: #fff; background:url(../media/img_web/basket_sprite.png) 0 -240px; height: 22px;}
table td{max-width:60px; background:url(../media/img_web/basket_sprite.png) 0 0; padding:7px 0;}
td input{text-align: center; border: 1px solid #bababa; border-radius: 5px;}
td input[type='text']{ width: 32px; height: 22px;}
.t_cross{ padding:0 15px;}
.t_cross img {cursor: pointer;}
.t_item{text-align: left; width: 331px;padding-left: 5px;}
.t_item span{font-weight: bold; font-size: 11px; margin-left: 7px; }
.t_item img{float:left; width: 14%;}
.t_quant{padding:0 10px;}
.t_price{text-align:right; padding-right: 6px; width: 90px; font-weight: bold;}
.t_sum{width:100%;}
/*td .t_price{font-weight: bold; font-size: 5px;}*/ 

</style>

<h2>Your Shopping Basket</h2>
<table><tbody>
<tr class="t_header">
  <th class="t_cross">&nbsp;</th>
  <th class="t_item">item</th>
  <th class="t_quant" style="">quantity</th>
  <th class="t_price" style="">total price</th>
</tr>
<?php
  $sum = 0;
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
<tr class="t_sum" colspan="4" style="border-top: black solid 2px;">
  <td></td>
  <td></td>
  <td></td>
  <td class="t_price"><span id="sum"><?php echo $sum;?></span> &euro;</td>
</tr>

</tbody>
</table>
