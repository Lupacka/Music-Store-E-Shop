function toggle_elements(elm, spd){
  $(elm).toggle(spd);
}

function com_rating(index){
   
  /*for(var i = 0; i < index ; i++){
    $("<label>").css("background" , "url('http://hudobniny.g6.cz/media/img_web/one_star_fill.png') no-repeat #FFFFFF;");
  } */
}

$(document).ready(function() {
  $('#tester').on('click',function(){
    var formObj = $(this),
        formurl = formObj.attr('action'),
        enc = formObj.attr('enctype');
    var formData = new FormData(this);
        
    $.ajax({
      url: formurl,
      type: 'POST',
      data:  formData,
      mimeType: enc,
      /*contentType: false,
      cache: false,
      processData: false,  */
      success: function(test){
      console.log(test);
      },
      error: function(){
      console.log(2);
      }          
      });
   // e.preventDefault(); //Prevent Default action. 
   // e.unbind();
   }  
  );
});


