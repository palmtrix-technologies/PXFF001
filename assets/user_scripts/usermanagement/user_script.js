
    
  //password matching
  var check = function() {
    if (document.getElementById('password').value ==
      document.getElementById('cpassword').value) {
      document.getElementById('message').style.color = 'green';
      document.getElementById('message').innerHTML = 'password matching';
    } else {
      document.getElementById('message').style.color = 'red';
      document.getElementById('message').innerHTML = 'password not matching';
    }
  }
//alert box for user add
function useradd(tittle,link) {

  swallokalert(tittle,'<?php echo base_url(); ?>users'); 
}
//alert box for user update
function userupdate() {

  alert('users updated successfully');
  
}
  //email check

  function checkMailStatus(){

var email=$("#email").val();// value in field email
$.ajax({
    type:'post',
        url:'checkMail',// put your real file name 
        data:{email: email},
        success:function(data){
        if(data==1)
        {
          document.getElementById('emailmessage').style.color = 'red';
      document.getElementById('emailmessage').innerHTML = 'email already existing';
     
        }
        else{
       document.getElementById('emailmessage').style.color = 'green';
       document.getElementById('emailmessage').innerHTML = 'email available';  
      }
      
        }
 });
}

 