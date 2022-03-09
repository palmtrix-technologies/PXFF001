
    //add permission
    function add()
    {
      var now = moment().format('YYYY-MM-DD h:mm:ss a');
  
  Data=
  {  "code":$('#client_code').val(),
            "name": $('#client_name').val(),
            "name_arabic": $('#client_name_arabic').val(),
            "contact_person": $('#contact_person').val(),
            "contact_person_arabic": $('#contact_person_arabic').val(),
            "address":$('#client_address').val(),
            "address_arabic":$('#client_address_arabic').val(),
            "vat_no": $('#client_vat').val(),
            "trn_no": $('#client_trn').val(),
            "country": $('#client_country').val(),
            "country_arabic": $('#client_country_arabic').val(),
            "remarks": $('#client_remarks').val(),
            "remarks_arabic": $('#client_remarks_arabic').val(),
            "vendor_id": $('#vendor_id').val(),
            "telephone":$('#client_telephone').val(),
            "mobile": $('#client_mobile').val(),
            "fax": $('#client_fax').val(),
            "email":$('#client_email').val(),
            "IsActive":1,
            "created_at": now
      };
      var postData = {
        postData1: Data,
        name:$('#client_name').val(),
        opbal:$('#opnbal').val()
     };
//   console.log(postData);
      var request = $.ajax({
      url: 'client-store',
      type: 'POST',
      data: {postData:postData} ,
      dataType: 'JSON'
      });
      request.done( function ( data ) {
    
        console.log(data)
        swallokalert('Client createdSuccessfully!!','client');
      //  alert('Client created Successfully!');
       // window.location.href="client"
         });
         request.fail( function ( jqXHR, textStatus) {
           // console.log("ghjgbjjh")
          swallokalert('Client Creation  Failed!!!','#');
         //  alert('Client Creation  Failed!');
        
         });
  
    }
    //update
    function update()
    {
      var now = moment().format('YYYY-MM-DD h:mm:ss a');
      Data = {
        "code":$('#client_code').val(),
            "name": $('#client_name').val(),
            "name_arabic": $('#client_name_arabic').val(),
            "contact_person": $('#contact_person').val(),
            "contact_person_arabic": $('#contact_person_arabic').val(),
            "address":$('#client_address').val(),
            "address_arabic":$('#client_address_arabic').val(),
            "vat_no": $('#client_vat').val(),
            "country": $('#client_country').val(),
            "country_arabic": $('#client_country_arabic').val(),
            "remarks": $('#client_remarks').val(),
            "remarks_arabic": $('#client_remarks_arabic').val(),
            "vendor_id": $('#vendor_id').val(),
            "telephone":$('#client_telephone').val(),
            "mobile": $('#client_mobile').val(),
            "fax": $('#client_fax').val(),
            "email":$('#client_email').val(),
         
        "updated_at": now
  };

      var postData = {
       postData1: Data,
        id: $('#id').val(),
        name:$('#client_name').val()
    };
      var request = $.ajax({
      url: '../client-update',
      type: 'POST',
      data: {postData:postData} ,
      dataType: 'JSON'
      });
      request.done( function ( data ) {
        console.log(data)
        swallokalert('Client Updated Successfully!!','../client');
       // alert('Client Updated Successfully!');
      //  window.location.href="client"
         });
         request.fail( function ( jqXHR, textStatus) {
           // console.log("ghjgbjjh")
           swallokalert('Client  Updation  Failed!!','client');
         //  alert('Client Updation  Failed!');
        
         });
  
    }
      //check already existing acc no

  function checkclient(){
    // alert("came");
var email=$("#client_email").val();// value in field acc no
//  alert(email);
$.ajax({
    type:'post',
        url:'check-client',// put your real file name 
        data:{email: email},
        success:function(data){
        if(data==1)
        {
         //  alert("cameftghfgh");
          document.getElementById('message').style.color = 'red';
      document.getElementById('message').innerHTML = 'email already existing';
      document.getElementById('client_email').value = "";
         // alert("email already exists"); // your message will come here.     
        }
      //   else{
      //  //   alert("came");
      //  //   alert("email available"); // your message will come here.     
      //  document.getElementById('accmessage').style.color = 'green';
      //  document.getElementById('accmessage').innerHTML = 'account number available';  
      // }
      
        }
 });
}