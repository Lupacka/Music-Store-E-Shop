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
        var pop_up= document.getElementById('login_pop');
        if(pop_up.style.visibility != "visible")
          pop_up.style.visibility = "visible";
        else
          pop_up.style.visibility = "hidden";
      }
     
      
    

