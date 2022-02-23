

    var readarray=[];
    var updatearray=[];
    $(function () {
    $('.readpermissions').on('ifChanged', function(event) {
     // alert('checked = ' + event.target.checked);
     // alert('value = ' + event.target.value);
      if(event.target.checked)
      {
        readarray.push(event.target.value);
      }
      else{
        readarray=jQuery.grep(readarray, function(value) {
          return value != event.target.value;
        });
      }

    });
});

    function add()
    {
      var permissionDatas=[];
      readarray.forEach(function(item) {
        permissionData = {
          "role_id":0,
          "permission_id":parseInt(item)
        }
        permissionDatas.push(permissionData);
      });

      var now = moment().format('YYYY-MM-DD h:mm:ss a');
  
      Roledata = {
            "name":$('#role_code').val(),
            "display_name": $('#role_name').val(),
            "description": $('#role_description').val(),
         
            "created_at": now
      };

      postData={
        "Permission":permissionDatas,
        "roledata":Roledata
      };
      var request = $.ajax({
      url: 'roles-store',
      type: 'POST',
      data: {postData:postData} ,
      dataType: 'JSON'
      });
      request.done( function ( data ) {
        console.log(data)
        swallokalert('Role Created Successfully!','roles');
      //  alert('Role Created Successfully!');
        //window.location.href="roles"
         });
         request.fail( function ( jqXHR, textStatus) {
           // console.log("ghjgbjjh")
           
        swallokalert('Role Creation  Successfully!','roles');
          // alert('Role Creation  Failed!');
        
         });
    }



   
   $(function () {
    $('.updatereadpermissions').on('ifChanged', function(event) {
     
      if(event.target.checked)
      {
        updatearray.push(event.target.value);
      }
      else{
        updatearray=jQuery.grep(updatearray, function(value) {
          return value != event.target.value;
        });
      }
    });
});

    function update()
    {
      var updatepermissionDatas=[];
      updatearray.forEach(function(item) {
        // alert(item);
        updatepermissionData = {
          "role_id":$('#id').val(),
          "permission_id":parseInt(item)
        }
        updatepermissionDatas.push(updatepermissionData);
       
      });

      
      var now = moment().format('YYYY-MM-DD h:mm:ss a');
      Data = {
            
            "name":$('#role_code').val(),
            "display_name": $('#role_name').val(),
            "description": $('#role_description').val(),
            "updated_at": now
      };
      var postData = {
       postData1: updatepermissionDatas,
       role: Data,
       id: $('#id').val()
    };
      var request = $.ajax({
      url: 'roles-update',
      type: 'POST',
      data: {postData:postData} ,
      dataType: 'JSON'
      });
      request.done( function ( data ) {
        console.log(data)
        swallokalert('Role Updated Successfully!','roles'); 
     // alert('Role Updated Successfully!');
      //window.location.href="roles"
       });
       request.fail( function ( jqXHR, textStatus) {
         // console.log("ghjgbjjh")
    
         swallokalert('Role Updation  Failed!','#');
         //alert('Role Updation  Failed!');
      
       });
    }

    function mytest()
    {
      console.log(updatearray);
    }

  