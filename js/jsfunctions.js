// JavaScript Document
      

      function changeElementsProfile(){
        var inputis = document.getElementsByClassName('info');
        var spanis = document.getElementsByClassName('user_info'); 
        var clikac = document.getElementById('inputChanger');
		  
        for(var i = 0; i < inputis.length; i++){
          if(getComputedStyle(inputis[i]).display == "none"){
           	  inputis[i].style.display="inline";
              spanis[i].style.display="none";
            }else{
              inputis[i].style.display="none";
              spanis[i].style.display="inline";
            }
        }
        if (clikac.innerHTML == "Cancel changing"){
          clikac.innerHTML = "Change profile" ;
          if(document.getElementById('userDataChanger') != "none")
            document.getElementById('userDataChanger').style.display = "none";
        }else{
          clikac.innerHTML = "Cancel changing";
          if(document.getElementById('userDataChanger') != "inline")
            document.getElementById('userDataChanger').style.display = "inline";
          }
      }
      
     
      function showLoginPop(){
        var pop_up = document.getElementById('login_pop');
        if(pop_up.style.visibility != "visible")
          pop_up.style.visibility = "visible";
        else
          pop_up.style.visibility = "hidden";
      }
      
      function checkUpload(){
        var uploadis = document.getElementById('up_img');
        var buttonis = document.getElementById('up_img_but');
      
        if(uploadis != '')
         buttonis.disabled = false;      
       }
      
      function add_sub(){
        
        document.getElementById('new_sub_div').style.visibility = 'visible';
        document.getElementById('overlay').style.visibility = 'visible';
        
      }
      function close_add_sub(){
        
        document.getElementById('new_sub_div').style.visibility = 'hidden';
        document.getElementById('overlay').style.visibility = 'hidden';
        
      }
      function del_prod($id){
        
        document.getElementById('del_prod_div').style.visibility = 'visible';
        document.getElementById('overlay').style.visibility = 'visible';
        document.getElementById('temp_hidden_el').value = $id
        
      }
      function close_del_prod(){
        
        document.getElementById('del_prod_div').style.visibility = 'hidden';
        document.getElementById('overlay').style.visibility = 'hidden';
        
      }
      function add_prod(){
       
          document.getElementById('new_prod_div').style.visibility = 'visible';
          document.getElementById('overlay').style.visibility = 'visible';
        
      }
      function close_add_prod(){
        
          document.getElementById('new_prod_div').style.visibility = 'hidden';
          document.getElementById('overlay').style.visibility = 'hidden';
        
      }
      function invalid_input_prod(){
        
        document.getElementById('prod_frame').style.visibility = 'hidden';
        //document.getElementById('sub_cat').style.visibility = 'hidden';      
      }
      
      function changeElementsProd(){
        var inputis = document.getElementsByClassName('prod_change_form');
        var content = document.getElementsByClassName('orig_content'); 
        var clikac = document.getElementById('');
        
        for(var i = 0; i < inputis.length; i++){
          if(getComputedStyle(inputis[i]).display == "none"){
           	  inputis[i].style.display="inline";
              content[i].style.display="none";
            }else{
              inputis[i].style.display="none";
              content[i].style.display="inline";
            }
        }
          
      }
      
     
     
      
    

