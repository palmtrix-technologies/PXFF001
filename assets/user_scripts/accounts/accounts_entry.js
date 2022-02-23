
$( document ).ready(function() {
    $('#chequefield').addClass("hidden");
   
  });
  

  function visible()
  {
 var selected_value = $('#pay_type').val();
 //alert(selected_value);
 if(selected_value!=""&&selected_value!="transfer")
 {
    $('#chequefield').removeClass("hidden");
    
 }
 
    
  }
 
  function hideradio()
  {
    $('#chequefield').addClass("hidden");
  }
  
  function hidediv()
  {
    $('#pay').removeClass("hidden");
    $("#debitaccount").html("");
    $("#creditaccount").html("");
    var selected_value = $('#pay_type').val();
      if(selected_value=="transfer")
      {
        $('#chequefield').addClass("hidden");
        $('#pay').addClass("hidden");
      }
      if(selected_value=="select")
        {
           // alert(selected_value);
            $("#creditaccount").append('<option value="">--Select--</option>');
            $("#debitaccount").append('<option value="">--Select--</option>');

        }
       
  //to show debit and credit type dropdownbox
  postData=$('#pay_type').val();
  var request = $.ajax({
    url: 'list-dropdown/'+postData,
    type: 'GET',
    dataType: 'JSON'
    });
    request.done( function ( data ) {
     console.log(data);
    // alert(data);
    
  $("#creditaccount").html("");
  $("#creditaccount").append(' <option value="">--Select--</option>');

      $.each(data['credit'], function(index, value){
        
        $("#creditaccount").append(' <option value="'+value.LedgerID+'">'+value.Ledger_Name+'</option>');
    });
  $("#debitaccount").html("");
  $("#debitaccount").append(' <option value="">--Select--</option>');
 
    $.each(data['debit'], function(index, value){
        
        $("#debitaccount").append(' <option value="'+value.LedgerID+'">'+value.Ledger_Name+'</option>');
    });

    });
   
  
  }
  
 