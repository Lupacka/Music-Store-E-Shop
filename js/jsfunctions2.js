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



$(document).ready(function() {
//////////////////////////////////// Global ///////////////////////////////////////////////////
  if($('section').height() < 300)
    $('section').css('height','300px');


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


