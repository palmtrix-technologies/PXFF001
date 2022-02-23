
    //add permission
    function add()
    {
      var now = moment().format('YYYY-MM-DD h:mm:ss a');
  
      postData = {
        "code": $('#description_code').val(),
            "description": $('#description_name').val(),
            "description_arabic": $('#description_arabic').val(),
            "created_at": now,
            "IsActive":1
      };
  
  
      var request = $.ajax({
      url: 'description-store',
      type: 'POST',
      data: {postData:postData} ,
      dataType: 'JSON'
      });
      request.done( function ( data ) {
        console.log(data)
        swallokalert('Description created Successfully!!','description');
       // alert('Description created Successfully!');
        //window.location.href="description"
         });
         request.fail( function ( jqXHR, textStatus) {
           // console.log("ghjgbjjh")
           swallokalert('Description Creation  Failed!!!','#');
         //  alert('Description Creation  Failed!');
        
         });
  
  
    }
    //update
    function update()
    {
      var now = moment().format('YYYY-MM-DD h:mm:ss a');
  
      Data = {
            
            "code":$('#description_code').val(),
            "description": $('#description_name').val(),
            "description_arabic": $('#description_arabic').val(),
            "updated_at": now
      };
      var postData = {
       postData1: Data,
        id: $('#id').val()
    };
      var request = $.ajax({
      url: '../description-update',
      type: 'POST',
      data: {postData:postData} ,
      dataType: 'JSON'
      });
      request.done( function ( data ) {
     
        console.log(data)
        swallokalert('Description updated Successfully!!','../description');
     //   alert('Description updated Successfully!');
    //    window.location.href="description"
         });
         request.fail( function ( jqXHR, textStatus) {
           // console.log("ghjgbjjh")
           swallokalert('Description updated Failed!!','#');
        //   alert('Description updation  Failed!');
        
         });
    }
 