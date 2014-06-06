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


$(document).ready(function() {
//////////////////////////////////// Global ///////////////////////////////////////////////////
  if($('section').height() < 300)
    $('section').css('height','300px');
/////////////////////////////////// Shopping cart /////////////////////////////////
  $('#mini_cart').click(function(){
    window.location = 'cart';
  })

  $('.t_cross > img').click(function(){
    var tmp = $(this).attr('id');
    var tmp_number = Number($('#mini_cart_count').html());
    $.post('cart/delete_from_cart',{rowid: tmp},function(out){
      $("#"+tmp).remove();
      $('#mini_cart_count').html(tmp_number-1);
    }) 
  })

  $("input[name=cart_prod_price]").change(function(){
    var num   = Number($(this).val());
    var id = Number($(this).attr('id'));
    var old_num = Number($('#p'+id).html());

    $('#p'+id).html( old_num * num );
    
    if(old_num > 5){
    // $('#sum').html()
    }

  })

//////////////////////////////////// Products Comments and Ratings //////////////////////////////////////////////////
  $('input[name=times]').val($('#rat_times').html());
  $('input[name=rat_origin]').val($('input[name=hidden_rating]').val());
  


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
  
  setInterval(function(){
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

  $(document).keypress(function(event){

    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $('#btn').click();   
    }

  });   
});


