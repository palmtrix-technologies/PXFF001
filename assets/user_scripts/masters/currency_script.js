
    //add permission
    function add()
    {
      var now = moment().format('YYYY-MM-DD h:mm:ss a');
  
      postData = {
            "currency":$('#currency').val(), 
                "created_at": now,
                "IsActive":1  
      };
  
  
      var request = $.ajax({
      url: 'currency-store',
      type: 'POST',
      data: {postData:postData} ,
      dataType: 'JSON'
      });
      request.done( function ( data ) {
  
        console.log(data)
        swallokalert('Currerncy created Successfully!!!','currency');
      //  alert('Currerncy created Successfully!');
        // window.location.href="currency"
         });
         request.fail( function ( jqXHR, textStatus) {
           // console.log("ghjgbjjh")
           swallokalert('Currerncy Creation  Failed!','#');
          // alert('Currerncy Creation  Failed!');
        
         });
  
  
    }
    //update
    function update()
    {
      var now = moment().format('YYYY-MM-DD h:mm:ss a');
      Data = {
        "currency":$('#currency').val(),
          
        "updated_at": now
  };

      var postData = {
       postData1: Data,
        id: $('#id').val()
    };
      var request = $.ajax({
      url: '../currency-update',
      type: 'POST',
      data: {postData:postData} ,
      dataType: 'JSON'
      });
      request.done( function ( data ) {
        swallokalert('Currerncy updated Successfully!!!','../currency');
    // alert('currency updated Successfully!');
    // window.location.href="currency";
      });
      request.fail( function ( jqXHR, textStatus) {
       
        swallokalert('Currerncy updaion Failed!!!','#');
      // alert('Currency updaion Failed!');
      // window.location.href="currency";
    
   
      });
    }
