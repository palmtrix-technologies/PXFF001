
    //add permission
    function add()
    {
      var now = moment().format('YYYY-MM-DD h:mm:ss a');
  
      postData = {
            "code":$('#shipper_code').val(),
            "name": $('#shipper_name').val(),
            "contact_person": $('#contact_person').val(),
            "address":$('#shipper_address').val(),
            "country": $('#shipper_country').val(),
            "telephone":$('#shipper_telephone').val(),
            "mobile": $('#shipper_mobile').val(),
            "fax": $('#shipper_fax').val(),
            "email":$('#shipper_email').val(),
            "remarks": $('#shipper_remarks').val(),
            "IsActive":1,
            "type":'autocomplete',

            "created_at": now
      };
  
  
      var request = $.ajax({
      url: 'shipper-store',
      type: 'POST',
      data: {postData:postData} ,
      dataType: 'JSON'
      });
      request.done( function ( data ) {
  
        console.log(data)
        swallokalert('Shipper created Successfully!!','shipper');
     //   alert('Shipper created Successfully!');
      //  window.location.href="shipper"
         });
         request.fail( function ( jqXHR, textStatus) {
           // console.log("ghjgbjjh")
           swallokalert('Shipper created  Failed!!','#');
         //  alert('Shipper Creation  Failed!');
        
         });
  
    }
    //update
    function update()
    {
      var now = moment().format('YYYY-MM-DD h:mm:ss a');
      Data = {
        "code":$('#shipper_code').val(),
            "name": $('#shipper_name').val(),
            "contact_person": $('#contact_person').val(),
            "address":$('#shipper_address').val(),
            "country": $('#shipper_country').val(),
            "telephone":$('#shipper_telephone').val(),
            "mobile": $('#shipper_mobile').val(),
            "fax": $('#shipper_fax').val(),
            "email":$('#shipper_email').val(),
            "remarks": $('#shipper_remarks').val(),

        "updated_at": now
  };

      var postData = {
       postData1: Data,
        id: $('#id').val()
    };
      var request = $.ajax({
      url: '../shipper-update',
      type: 'POST',
      data: {postData:postData} ,
      dataType: 'JSON'
      });
      request.done( function ( data ) {
        console.log(data)
        swallokalert('Shipper Updated Successfully!!','../shipper');
      //  alert('Shipper Updated Successfully!');
      //  window.location.href="shipper"
         });
         request.fail( function ( jqXHR, textStatus) {
           // console.log("ghjgbjjh")
           swallokalert('Shipper Updated Failed!!','#');
         //  alert('Shipper Updation  Failed!');
        
         });
    
    }
    