function toggle_elements(elm, spd){
  $(elm).toggle(spd);
}

function com_rating(index){
  
  $("#com_rating>span").each(function(){
    $(this).css("background-image" , "url(http://hudobniny.g6.cz/media/img_web/one_star.png)"); 
  }); 
  
  $('#com_rating>input').each(function(){
    $(this).attr({checked:""});
  }); 
   
  for(var i = 1; i <= index ; i++){
    $('#com_rating > #'+i).css("background-image" , "url(http://hudobniny.g6.cz/media/img_web/one_star_fill.png)"); 
    //alert(i);
  } 
  
  $('#'+index+'_chck').attr({checked:"checked"});
};

function add_to_cart(id){
  $.post('hudobniny/add_to_cart',{ vst: id}, function(out){
    //console.log(out);
    $("#mini_cart > span").html(out).fadeIn("slow");
  });
}
function recalculate_chk(num){
  var tmp = [];
  if(num > 0)
    $(':radio').each(function(){
      //console.log(this);
      if( $(this).is(':checked') ){
        tmp.push($(".methods > ."+$(this).attr('id')).html());
       //console.log("."+$(this).attr('id'));
        tmp.push(Number($(this).val()));
      }
    })

  console.log(tmp);
  $("#d_sum").html(tmp[0]);
  $("input[name='delivery_h']").prop('value',tmp[0]);
  $('#p_sum').html(tmp[2]);
  $("input[name='cash_h']").prop('value',tmp[2]);
  $('#d_p').html(tmp[1]+" &euro;");
  $('#p_p').html(tmp[3]+" &euro;");
  $('#sum').html( num + tmp[1] + tmp[3] );
  //console.log(tmp);
}

function check_out(){
  $('#chk_out').hide(450);
  $('.methods, .tr_none, .udaje_email, .udaje , .submit_order').show(450);
  $('.overview').css({'float':'right','margin-right':'45px'});
  recalculate_chk(Number($('#sum').html()) , '');
}

function order_chg_status(id,elm){
  
  $.post('cart/update_status', {id_details: elm, status: id}, function(){
    switch(id){
    case 1: 
      $('#'+elm).html('Prijata');
      break;
    case 2: 
      $('#'+elm).html('Expedovana');
      break;
    case 3: 
      $('#'+elm).html('Prijata zakaznikom');
      break;
  }  
  })
}

$(document).ready(function() {

/////////////////////////////////// Shopping cart /////////////////////////////////
  
  $('#mini_cart').click(function(){ //redirect
    window.location = 'cart';
  })

  $('.t_cross > img').click(function(){  //delete product from cart
    var tmp = $(this).attr('id');
    var tmp_number = Number($('#mini_cart_count').html());
    $.post('cart/delete_from_cart',{rowid: tmp},function(out){

      $('#sum').html(Number($('#sum').html()) - Number($("#"+tmp+" > .t_price > span").html()));  // recaltulating the sum

      $('#mini_cart_count').html(tmp_number-1);
      $("#"+tmp).remove();
    }) 
  })

  $("input[name=cart_prod_price]").change(function(){ // recalculating price
    var num   = Number($(this).val()),
        id    = $(this).attr('id');
        pom   = 0;

    $('#p'+id).html( Number($('#p'+id).html()) * num );
    
    $('.t_price > span').each(function(){
      if($(this).attr('id') != 'sum')
        pom+= Number($(this).html());
        //console.log($(this).html());
    }) 
    $('#sum').html(pom);  

  })

//////////////////////////////////// Products Comments and Ratings //////////////////////////////////////////////////
  $('input[name=times]').val($('#rat_times').html());
  $('input[name=rat_origin]').val($('input[name=hidden_rating]').val());
  
////////////////////////////////////  Profile factures ////////////////////////////////////////////////////////
$('.faktury').click(function(){
  if($(this).css('height') < '25px'){
    $(this).css('height','auto').fadeIn("slow");
    $(this).css('cursor', 'initial');
  }
  /*else
    $(this).css('height','20px').animate();*/
})

////////////////////////////////////  TEST CHAT FUNCTIONs /////////////////////////////////////////////////////  
  $('#btn').click(function (){
        if( $('#nick').val() == ""){
          $('#warning').html('nevyplnili ste Nick!!');
          return;
        }  
        
        var timeObj = new Date();
        var time = timeObj.getHours()+":" + timeObj.getMinutes()+":"+ timeObj.getSeconds();
        var input = time + " " + $('#nick').val() + ": " + $('#chat').val() + "<br>";  
        
        $('#chatframe').append(input);
        $.post('test/save_com',{ vst: input}, $('#chat').val(""));
      }); 
  
  /*setInterval(function(){
          $.post("test/load_history?load=1", function(data){           
            //$('#chatframe').append(data[1]);
            var trans = JSON.parse(data);
            $('#chatframe').html("");
            $.each(trans, function(i,val){
              $('#chatframe').append(val+"<br>");
              //console.log(val);  
            });
          });  
        }, 2500);   
*/
  $(document).keypress(function(event){

    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $('#btn').click();   
    }

  });   
});


