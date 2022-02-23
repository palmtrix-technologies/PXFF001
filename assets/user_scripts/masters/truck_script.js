
    //add permission
    function add()
    {
      var now = moment().format('YYYY-MM-DD h:mm:ss a');
  
      postData = {
            "truck":$('#truck').val(), 
                "created_at": now,
                "IsActive":1  
      };
  
  
      var request = $.ajax({
      url: 'truck-store',
      type: 'POST',
      data: {postData:postData} ,
      dataType: 'JSON'
      });
      request.done( function ( data ) {
  
        console.log(data)
        swallokalert('Truck created Successfully!!!','truck');
      //  alert('Currerncy created Successfully!');
        // window.location.href="currency"
         });
         request.fail( function ( jqXHR, textStatus) {
           // console.log("ghjgbjjh")
           swallokalert('Truck Creation  Failed!','#');
          // alert('Currerncy Creation  Failed!');
        
         });
  
  
    }
    //update
    function update()
    {
      var now = moment().format('YYYY-MM-DD h:mm:ss a');
      Data = {
        "truck":$('#truck').val(),
          
        "updated_at": now
  };

      var postData = {
       postData1: Data,
        id: $('#id').val()
    };
      var request = $.ajax({
      url: '../truck-update',
      type: 'POST',
      data: {postData:postData} ,
      dataType: 'JSON'
      });
      request.done( function ( data ) {
        swallokalert('Truck updated Successfully!!!','../truck');
    // alert('currency updated Successfully!');
    // window.location.href="currency";
      });
      request.fail( function ( jqXHR, textStatus) {
       
        swallokalert('Truck updaion Failed!!!','#');
      // alert('Currency updaion Failed!');
      // window.location.href="currency";
    
   
      });
    }
