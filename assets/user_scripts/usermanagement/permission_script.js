
    //add permission
  function add()
  {
    var now = moment().format('YYYY-MM-DD h:mm:ss a');

    postData = {
          "name":$('#permission_code').val(),
          "display_name": $('#permission_name').val(),
          "description": $('#permission_description').val(),
          "created_at": now
    };


    var request = $.ajax({
    url: 'permission-store',
    type: 'POST',
    data: {postData:postData} ,
    dataType: 'JSON'
    });
    request.done( function ( data ) {
      console.log(data)
      swallokalert('Permission Created Successfully!','permission');
      // alert('Permission Created Successfully!');
      // window.location.href="permission"
       });
       request.fail( function ( jqXHR, textStatus) {
         // console.log("ghjgbjjh")
         swallokalert('Permission Creation  Failed!!','#');
      //   alert('Permission Creation  Failed!');
      
       });

  }
  //update
  function update()
  {
    var now = moment().format('YYYY-MM-DD h:mm:ss a');

    Data = {
          
          "name":$('#permission_code').val(),
          "display_name": $('#permission_name').val(),
          "description": $('#permission_description').val(),
          "updated_at": now
    };
    var postData = {
     postData1: Data,
      id: $('#id').val()
  };
    var request = $.ajax({
    url: 'permission-update',
    type: 'POST',
    data: {postData:postData} ,
    dataType: 'JSON'
    });
    request.done( function ( data ) {
      console.log(data)
      swallokalert('Permission Updated Successfully!','permission');
      //alert('Permission Updated Successfully!');
     // window.location.href="permission"
       });
       request.fail( function ( jqXHR, textStatus) {
         // console.log("ghjgbjjh")
         swallokalert('Permission Updation  Failed!!','#');
       //  alert('Permission Updation  Failed!');
      
       });
  }