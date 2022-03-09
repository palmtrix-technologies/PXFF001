
    //add permission
    function add()
    {
      var now = moment().format('YYYY-MM-DD h:mm:ss a');
  

       Data = {
            "employee_code":$('#employee_code').val(),
            "name": $('#employee_name').val(),
            "employee_phone": $('#employee_number').val(),
            "is_active":1
          
      };
  
      var postData = {
        postData1: Data
     };
  
      var request = $.ajax({
      url: 'employee-store',
      type: 'POST',
      data: {postData:postData} ,
      dataType: 'JSON'
      });
      request.done( function ( data ) {
      
        swallokalert('employee Created Successfully!!','employee');
     
         });
         request.fail( function ( jqXHR, textStatus) {
           // console.log("ghjgbjjh")
           swallokalert('employee Created Failed!!','#');
         //  alert('Supplier Creation  Failed!');
        
         });
  
  
  
    }
    //update
    function update()
    {
      var now = moment().format('YYYY-MM-DD h:mm:ss a');
     Data = {
            "employee_code":$('#employee_code').val(),
            "name": $('#employee_name').val(),
            "employee_phone": $('#employee_number').val(),
            "is_active":1
          
      };

      var postData = {
       postData1: Data,
        id: $('#id').val(),
       
    };
      var request = $.ajax({
      url: '../employee-update',
      type: 'POST',
      data: {postData:postData} ,
      dataType: 'JSON'
      });
      request.done( function ( data ) {
     
        console.log(data)
        swallokalert('employee Updated Successfully!!','../employee');
         });
         request.fail( function ( jqXHR, textStatus) {
         
           swallokalert('employee  Updation  Failed!!','#');
        
         });
  
      
    }
  