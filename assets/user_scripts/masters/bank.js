
   
    //add bank 
    function storebank()
    {
     
      var now = moment().format('YYYY-MM-DD h:mm:ss a');
  
      Data = {
        "code": $('#code').val(),
            "bank_name": $('#name').val(),
            "acc_type": $('#acc_type').val(),
            "acc_number": $('#acc-no').val(),
            "iban": $('#iban').val(),
            "opening_bal": $('#opbal').val(),
            "other_info": $('#otherinfo').val(),
            "IsActive":1, 
            "created_date": now
      };
      var Bankname=$('#name').val();
      var actype=$('#acc_type').val();
      
      var postData = {
        postData1: Data,
        Bankname: Bankname,
        Actype: actype
      };
      var request = $.ajax({
      url: 'bank-store',
      type: 'POST',
      data: {postData:postData} ,
      dataType: 'JSON'
      });
      request.done( function ( data ) {
        console.log(data)
        swallokalert('Bank Created Successfully!!','bank');
      // alert('Bank Created Successfully!');
       //window.location.href="bank"
        });
        request.fail( function ( jqXHR, textStatus) {
          // console.log("ghjgbjjh")
          swallokalert('Bank Created Failed!!','#');
          //alert('Bank Creation  Failed!');
       
        });
    
      }
    //update
    function update()
    {
    //   alert("owajdojjse");
      var now = moment().format('YYYY-MM-DD h:mm:ss a');
  
      Data = {
            
        "bank_name": $('#name').val(),
        "acc_type": $('#acc_type').val(),
        "acc_number": $('#acc-no').val(),
        "iban": $('#iban').val(),
        "opening_bal": $('#opbal').val(),
        "other_info": $('#otherinfo').val(),
       
        "updated_at": now
      };
      var postData = {
       postData1: Data,
        id: $('#id').val()
    };
//   console.log(postData);
      var request = $.ajax({
      url: '../bank-update',
      type: 'POST',
      data: {postData:postData} ,
      dataType: 'JSON'
      });
      
      request.done( function ( data ) {
        // console.log(data)
        swallokalert('Bank updated Successfully!!','../bank');

      });
      request.fail( function ( jqXHR, textStatus) {
        // console.log("ghjgbjjh")

        swallokalert('Bank updation Failed!!','#');
      //  alert('bank updation failed!');
     
      });
  
    }
    //check already existing acc no

  function checkacc(){
    // alert("came");
var accno=$("#acc-no").val();// value in field acc no

$.ajax({
    type:'post',
        url:'check-account',// put your real file name 
        data:{acc_number: accno},
        success:function(data){
        if(data==1)
        {
         //  alert("cameftghfgh");
          document.getElementById('accmessage').style.color = 'red';
      document.getElementById('accmessage').innerHTML = 'account already existing';
      document.getElementById("acc-no").value = "";
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