
$( document ).ready(function() {
  $('#isAgeSelected').click(function() {
   console.log(this.checked);
   if(this.checked)
   {
       $("#evat").prop('disabled', true);
   }
   else{
       $("#evat").prop('disabled', false);
   }
});
     $('#cash_accounts').addClass("hidden");
    $('#chequeno').addClass("hidden");
    $('#chequedate').addClass("hidden");
    $('#banks').addClass("hidden");
    $('#transac_id').addClass("hidden");
    checktransaction();
  });


  function checktransaction()
  {
    var selected_value = $('#emode').val();
    console.log(selected_value);
    // if(selected_value=="bank")
    //  {
    //   $('.bank').removeClass("hidden");
     
        
    //  }
    //  else{
    //   $('.bank').addClass("hidden");
      
    //  }
     
     
     if(selected_value=="bank")
     {
       $('#cash_accounts').addClass("hidden");
       $('#chequeno').removeClass("hidden");
       $('#chequedate').removeClass("hidden");
       $('#banks').removeClass("hidden");
       $('#transac_id').removeClass("hidden");
     }
      else if(selected_value=="cash")
     {
          $('#cash_accounts').removeClass("hidden");
        $('#chequeno').addClass("hidden");
        $('#chequedate').addClass("hidden");
        $('#banks').addClass("hidden");
        $('#transac_id').addClass("hidden");
     }
     else{
         
          $('#cash_accounts').addClass("hidden");
        $('#chequeno').addClass("hidden");
        $('#chequedate').addClass("hidden");
        $('#banks').addClass("hidden");
        $('#transac_id').addClass("hidden");
     }
  }
  


   
  
  
   
  function insert_supplier_expense()
  {
    if($('#eunitprice,#eunit_price,#equantity,#evat').val() == ''){
      swallokalert('Insert all fields!!','#');
      // alert('Insert all fields');
   }
  else{
    if(document.getElementById('isAgeSelected').checked) {
    insertRow_taxincluded();
    } else {
        insertRow1();
    }
   
  }
  }
  
  $(document).on("click", '.ermvbutton', function() {
           
    $(this).closest("tr").remove();
    calculates1();

  return false;
  });
  function insertRow1()
  {
    var descID=0;
      var esite= $("#esite option:selected").text();
      var esiteid= $("#esite").val();
      var eemployee= $("#eemployee option:selected").text();
      var eemployeeid= $("#eemployee").val();
        var evehicle= $("#evehicle option:selected").text();
      var evehicleid= $("#evehicle").val();
      var entity="";
      if(evehicleid!=0)
      {
          entity=evehicle;
      }
      else if(eemployeeid!=0)
      {
          entity=eemployee;
      }
      else{
          entity=esite;
      }
      
      var edesc= $("#edescription_job").val();
      var eprice=parseFloat($("#eunitprice").val());
      var eprice1=parseFloat($("#eunitprice").val());
      var emode=$("#emode").val();
       var eprice = eprice ;
  if(edesc=='')
  {
     edesc= $('#expense_cat option:selected').text();
  }
    //   var quantity=$("#quantity").val();
     
      var ecode=$("#edesc_code").val();
      var evatAmount=parseFloat($("#evat").val());
     var eSubTotal=1*eprice;
   var etaxvalue=((eSubTotal * evatAmount) / 100);
   var etotal=eSubTotal+etaxvalue;
  //  var currency=parseFloat($("#unit_price").val());
  $(".adddata").append( "<tr class='tblrow1'><td>"+entity+"</td><td class='ejob_desc'>"+edesc+" </td> <td class='ejob_price'>"+eprice1+"</td> <td class='esubtotalval_data'>"+eSubTotal+"</td> <td class='etaxval_data'>"+etaxvalue+"</td>  <td class='etotalval_data'>"+etotal+"</td> <td><a class='ermvbutton'><i class='fa fa-trash-o'></i></a><input type='hidden' class='hdnvehicleid' value='"+evehicleid+"'/><input type='hidden' class='hdnemployeeid' value='"+eemployeeid+"'/><input type='hidden' class='hdnsiteid' value='"+esiteid+"'/><input type='hidden' class='hdntaxper' value='"+evatAmount+"'/> </td></tr>" );
  calculates1();


  
// TO CLAR Text ARea and text box
/*Clear textarea using id */
$('#step-1 #edescription_job').val('');

$('#step-1 #eunitprice').val('');
$('#step-1 #econv_factor').val('1');
$('#step-1 #evat').val('0');
$('#step-1 #epost_date').val($.datepicker.formatDate("yy-mm-dd", new Date()));
$('#view_supplier_name').attr('readonly', true);
$('#einvoice').attr('readonly', true);
$('#emode').attr('disabled', true);
  }
  
  function insertRow_taxincluded()
  {
      
    var descID=0;
      var esite= $("#esite option:selected").text();
      var esiteid= $("#esite").val();
      
      var eemployee= $("#eemployee option:selected").text();
      var eemployeeid= $("#eemployee").val();
      
      
        var evehicle= $("#evehicle option:selected").text();
      var evehicleid= $("#evehicle").val();
      var entity="";
      if(evehicleid!=0)
      {
          entity=evehicle;
      }
      else if(eemployeeid!=0)
      {
          entity=eemployee;
      }
      else{
          entity=esite;
      }
      
      var edesc= $("#edescription_job").val();
      var taxincludedprice=parseFloat($("#eunitprice").val());
      var taxfreeprice=taxincludedprice/1.05;
      console.log(taxfreeprice);
      var eprice1=roundNumber(taxfreeprice,2);
      var eprice=roundNumber(taxfreeprice,2);
      var emode=$("#emode").val();
     
      if(edesc=='')
      {
         edesc= $('#expense_cat option:selected').text();
      }
    //   var quantity=$("#quantity").val();
     
      var ecode=$("#edesc_code").val();
      var evatAmount=5;
     var eSubTotal=1*eprice;
   var etaxvalue=taxincludedprice-taxfreeprice;
   var etotal=eSubTotal+etaxvalue;
  //  var currency=parseFloat($("#unit_price").val());
  $(".adddata").append( "<tr class='tblrow1'><td>"+entity+"</td><td class='ejob_desc'>"+edesc+" </td> <td class='ejob_price'>"+eprice1+"</td> <td class='esubtotalval_data'>"+eSubTotal+"</td> <td class='etaxval_data'>"+etaxvalue+"</td>  <td class='etotalval_data'>"+etotal+"</td> <td><a class='ermvbutton'><i class='fa fa-trash-o'></i></a><input type='hidden' class='hdnvehicleid' value='"+evehicleid+"'/><input type='hidden' class='hdnemployeeid' value='"+eemployeeid+"'/><input type='hidden' class='hdnsiteid' value='"+esiteid+"'/><input type='hidden' class='hdntaxper' value='"+evatAmount+"'/> </td></tr>" );
  calculates1();


  
// TO CLAR Text ARea and text box
/*Clear textarea using id */
$('#step-1 #edescription_job').val('');

$('#step-1 #eunitprice').val('');
$('#step-1 #econv_factor').val('1');
$('#step-1 #evat').val('0');
$('#step-1 #epost_date').val($.datepicker.formatDate("yy-mm-dd", new Date()));
$('#view_supplier_name').attr('readonly', true);
$('#einvoice').attr('readonly', true);
$('#emode').attr('disabled', true);
  }
  
  function roundNumber(num, scale) {
  if(!("" + num).includes("e")) {
    return +(Math.round(num + "e+" + scale)  + "e-" + scale);
  } else {
    var arr = ("" + num).split("e");
    var sig = ""
    if(+arr[1] + scale > 0) {
      sig = "+";
    }
    return +(Math.round(+arr[0] + "e" + sig + (+arr[1] + scale)) + "e-" + scale);
  }
}
  function calculates1() {
    var etotsub_val=0;
    $(".esubtotalval_data").each(function(td) {
        var s = parseFloat($(this).html());
        etotsub_val=parseFloat(etotsub_val)+s;
    });
  
    var etaxval_data_val=0;
    $(".etaxval_data").each(function(td) {
        var s = parseFloat($(this).html());
        etaxval_data_val=parseFloat(etaxval_data_val)+s;
    });
  
    var etotalval_data_val=0;
    $(".etotalval_data").each(function(td) {
        var s = parseFloat($(this).html());
        etotalval_data_val=parseFloat(etotalval_data_val)+s;
    });
   
  
    $("#etotal").val(etotsub_val.toFixed(2));
  
   $("#evat_total").val(etaxval_data_val.toFixed(2));
   $("#egrand_total").val(etotalval_data_val.toFixed(2));
  

  }
  //insert data to job-details table
  





  function insert_expense_details() {
       var selected_value = $('#emode').val();
       var fl_id=0;
       if(selected_value=='cash')
       {
           fl_id= $('#cash_id').val();
       }
      
      console.log($('#bank').val());
    
  var ExpenseData = {
     
    "from_ledger_id":fl_id,
    "to_ledger": $('#to_legder').val(),
     "expense_category":$('#expense_cat option:selected').text(),
    "expense_date":$('#einv_date').val(),
    "subtotal":$('#etotal').val(),
    "tax_total":$('#evat_total').val(),
    "total_amount":$('#egrand_total').val(),
    "expense_description":$('#enotes').val(),
    "created_date":$('#epost_date').val(),
    "payment_mode":$('#emode').val(),
    "transaction_id":$('#transactionid').val(),
    "ref_number":$('#einvoice').val(),
    "bank_id": $('#bank').val()
  
  };
  // console.log(ExpenseData);
    var ExpenseDetails = [];
            $(".tblrow1").each(function () {
                var Data = {
                  "site_id":$(this).find('.hdnsiteid').val(),
                  "vehicle_id":$(this).find('.hdnvehicleid').val(),
                   "employee_id":$(this).find('.hdnemployeeid').val(),
                   "description": $(this).find('.ejob_desc').text(),
                   "subtotal":$(this).find('.ejob_price').text(),
                    "tax_per":$(this).find('.hdntaxper').text(),
                     "tax_amount":parseFloat($(this).find('.etaxval_data').text()),
                      "total_amount" : parseFloat($(this).find('.etotalval_data').text())
                };
                ExpenseDetails.push(Data);
               // console.log(JobDetails);
            });
           
  
  var postData = {
    ExpenseDetails: ExpenseDetails,
    ExpenseData: ExpenseData
      };


      console.log(postData);

      var request = $.ajax({
        url: 'insert-genaral-expense',
        type: 'POST',
        data: {postData:postData} ,
        dataType: 'JSON'
        });
      request.done( function ( data ) {
         swallokalert('expense created Successfully!!','genaral-expense-new');
        // window.location.href='../supplier-expense-print/'+data

      });
      request.fail( function ( jqXHR, textStatus) {
     
        });
  
    }
  
  
  
  