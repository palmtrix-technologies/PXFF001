//add ledger 
function store()
{
 
// alert("ivdethi");

  postData = {
   
        "LedgerGroupID": $('#ledger_type').val(),
        "Ledger_Name": $('#ledger_name').val()
       
  };
  var request = $.ajax({
  url: 'ledger',
  type: 'POST',
  data: {postData:postData} ,
  dataType: 'JSON'
  });
  request.done( function ( data ) {
    swallokalert('Ledger Created Successfully!!','create-ledger');
    // if(!alert('Ledger  Created Successfully....!')){window.location.href="create-ledger-group"}
    });
    request.fail( function ( jqXHR, textStatus) {
     
    

 
      if (jqXHR.responseText=="success")
      {
        swallokalert('Ledger Created Successfully!!','create-ledger');
      //  if(!alert('Ledger  Created Successfully!')){window.location.href="create-ledger-group"}
   
      }
    });

  }
   
function getdata()
{
 // alert(0);
postData=$('#ledger_type').val();
var request = $.ajax({
  url: 'list-ledger/'+postData,
  type: 'GET',
  dataType: 'JSON'
  });
  request.done( function ( data ) {
   
    $("#listvalue").html("");
   
    $.each(data, function(index, value){
      
      $("#listvalue").append('<tr><td>'+value.Ledger_Name+'</td><td><a class="LedgerEdit" valueid="'+value.LedgerID+'" valuestring="'+value.Ledger_Name+'" ><i class="fa fa-edit"></i></a></td></tr>');
  });
 
  });

   

}
function editdata()
 {
// alert("dfgfth");
   Data = {  
    "LedgerGroupID": $('#ledger_type').val(),   
     "Ledger_Name": $('#ledger_name').val()

       };
   var postData = {
    postData1: Data,
    LedgerID: $('#id').val()
 };
   var request = $.ajax({
   url: 'ledger-edit',
   type: 'POST',
   data: {postData:postData} ,
   dataType: 'JSON'
   });
   request.done( function ( data ) {
    swallokalert('Ledger updated Successfully!!','create-ledger');
  //  if(!alert('ledger updated Successfully!...')){window.location.reload();}
   });
   request.fail( function ( jqXHR, textStatus) {
   
    if (jqXHR.responseText=="success")
    {
      swallokalert('Ledger updated Successfully!!','create-ledger');
    //  if(!alert('ledger  updated Successfully!')){window.location.reload();}
 
    }
   });

 }

$( document ).ready(function() {
  $('#editdata').addClass("hidden");
  $(document).on("click", ".LedgerEdit", function(e) {
  
    $('#ledger_name').val($(this).attr("valuestring"));
    $('#id').val($(this).attr("valueid"));
    $('#adddata').addClass("hidden");
    $('#editdata').removeClass("hidden");
 
  });
  
});
