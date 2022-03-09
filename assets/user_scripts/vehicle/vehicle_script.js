
    //add permission
    function add()
    {
      var now = moment().format('YYYY-MM-DD h:mm:ss a');
  

       Data = {
            "vehicle_code":$('#vehicle_code').val(),
            "Vehicle_number": $('#Vehicle_number').val(),
            "vehicle_manufactur": $('#vehicle_manufactur').val(),
            "vehicle_model":$('#vehicle_model').val(),
            "vehicle_category": $('#vehicle_category').val(),
            "ownershipdetails": $('#ownershipdetails').val(),
            "is_active":1,
            "purchase_date": $('#purchase_date').val()
      };
  
      var postData = {
        postData1: Data
     };
  
      var request = $.ajax({
      url: 'vehicle-store',
      type: 'POST',
      data: {postData:postData} ,
      dataType: 'JSON'
      });
      request.done( function ( data ) {
      
        swallokalert('Vehicle Created Successfully!!','vehicle');
     
         });
         request.fail( function ( jqXHR, textStatus) {
           // console.log("ghjgbjjh")
           swallokalert('Vehicle Created Failed!!','#');
         //  alert('Supplier Creation  Failed!');
        
         });
  
  
  
    }
    //update
    function update()
    {
      var now = moment().format('YYYY-MM-DD h:mm:ss a');
      Data = {
        "vehicle_code":$('#vehicle_code').val(),
        "Vehicle_number": $('#Vehicle_number').val(),
        "vehicle_manufactur": $('#vehicle_manufactur').val(),
        "vehicle_model":$('#vehicle_model').val(),
        "vehicle_category": $('#vehicle_category').val(),
        "ownershipdetails": $('#ownershipdetails').val(),
        "purchase_date": $('#purchase_date').val()
  };

      var postData = {
       postData1: Data,
        id: $('#id').val(),
       
    };
      var request = $.ajax({
      url: '../vehicle-update',
      type: 'POST',
      data: {postData:postData} ,
      dataType: 'JSON'
      });
      request.done( function ( data ) {
     
        console.log(data)
        swallokalert('Vehicle Updated Successfully!!','../vehicle');
         });
         request.fail( function ( jqXHR, textStatus) {
         
           swallokalert('vehicle  Updation  Failed!!','#');
        
         });
  
      
    }
  