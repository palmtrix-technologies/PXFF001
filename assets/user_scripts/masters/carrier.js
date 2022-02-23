
    //add bank 
    function store()
    {
      var now = moment().format('YYYY-MM-DD h:mm:ss a');
  
      postData = {
      
            "carrier_type": $('#carrier_type').val(),
            "code": $('#code').val(),
            "name": $('#name').val(),
            "contact": $('#contact').val(),
            "address": $('#address').val(),
            "country": $('#country').val(),
            "telephone": $('#telephone').val(),
            "mobile": $('#mobile').val(),
            "fax": $('#fax').val(),
            "email": $('#email').val(),
            "remarks": $('#remarks').val(),
            // "credit_limit": $('#credit').val(),
            "IsActive":1, 
            "created_at": now
      };
  
  
      var request = $.ajax({
      url: 'carrier-store',
      type: 'POST',
      data: {postData:postData} ,
      dataType: 'JSON'
      });
      request.done( function ( data ) {
       // console.log(data)
        swallokalert('Carrier created Successfully!!','carrier');
       // alert('Carrier created Successfully!');
       // window.location.href="carrier"
         });
         request.fail( function ( jqXHR, textStatus) {
           // console.log("ghjgbjjh")
           swallokalert('Carrier created Failed!!','carrier');
          // alert('Carrier Creation  Failed!');
        
         });
  
  
    }
    //update
    function update()
    {
      // alert("ivdethi");
      var now = moment().format('YYYY-MM-DD h:mm:ss a');
  
      Data = {
            
        "carrier_type": $('#carrier_type').val(),
        "code": $('#code').val(),
        "name": $('#name').val(),
        "contact": $('#contact').val(),
        "address": $('#address').val(),
        "country": $('#country').val(),
        "telephone": $('#telephone').val(),
        "mobile": $('#mobile').val(),
        "fax": $('#fax').val(),
        "email": $('#email').val(),
        "remarks": $('#remarks').val(),
        // "credit_limit": $('#credit').val(),
       
        "updated_at": now
      };
   //console.log(Data);
      var postData = {
       postData1: Data,
        id: $('#id').val()
    };
      var request = $.ajax({
      url: '../carrier-update',
      type: 'POST',
      data: {postData:postData} ,
      dataType: 'JSON'
      });
      request.done( function ( data ) {
        console.log(data)
        swallokalert('Carrier Updated Successfully!!','../carrier');
       // alert('Carrier Updated Successfully!');
       // window.location.href="carrier"
         });
         request.fail( function ( jqXHR, textStatus) {
           // console.log("ghjgbjjh")
           swallokalert('Carrier Updated Failed!!','#');
        //   alert('Carrier Updation  Failed!');
        
         });
    }

  function hideprefix()
  {
    var typeval=$("#carrier_type").val();
//  alert(typeval);
if(typeval=="Air")
{
  //  alert(typeval);
  $('#prefix').removeClass("hidden");
}
else{
  $('#prefix').addClass("hidden");
}
  }

