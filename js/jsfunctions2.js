function toggle_elements(elm, spd){
  $(elm).toggle(spd);
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
   });
});


