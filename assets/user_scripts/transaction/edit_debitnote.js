var deletedidarray=[];
$( document ).ready(function() {
    $('#receipt').addClass("hidden");
    $('#description').addClass("hidden");
    $('#amnt').addClass("hidden");
    var selected_value = $('#type').val();
    if(selected_value!="credit")
        {
          $('#receipt').removeClass("hidden");
          $('#description').removeClass("hidden");
          $('#amnt').removeClass("hidden");
           
        }
        else{
          $('#receipt').addClass("hidden");
          $('#description').addClass("hidden");
          $('#amnt').addClass("hidden");
        }
     
    });


 function visible_cash()
   {
      
      var selected_value = $('#type').val();
      if(selected_value!="credit")
      {
        $('#receipt').removeClass("hidden");
        $('#description').removeClass("hidden");
        $('#amnt').removeClass("hidden");
         
      }
      else{
        $('#receipt').addClass("hidden");
        $('#description').addClass("hidden");
        $('#amnt').addClass("hidden");
      }
      
 }
  
  
 function get_desdatas()
 {
 
 postData=$('#desc_code').val();
 var request = $.ajax({
   url: '../debit-note/debitnote-description/'+postData,
   type: 'GET',
   dataType: 'JSON'
   });
   request.done( function (result) {
     console.log(result);
   var values=JSON.stringify(result);
   $("#description_job").val(result[0].description);
   $("#description_id").val(result[0].id);
 console.log(result[0].id);
   });
 }


  function insert_debit_note()
  {
    if($('#unitprice,#unit_price,#conv_factor').val() == '')
    {
      swallokalert('Insert all fields!!','#');
    //  alert('Insert all fields');
     }
     else{
       insertRow();
      }
  }
  
  $(document).on("click", '.rmvbutton', function() {
           
    $(this).closest("tr").remove();
    calculates();
    return false;
  });


  function insertRow()
  {
    var descID=0;
      var desc= $("#description_job").val();
      var price=parseFloat($("#unitprice").val());
      var currency=$("#unit_price").val(); 
      var price1=parseFloat($("#unitprice").val());
      var conv_factor=parseFloat($("#conv_factor").val());
    //   var mode=$("#mode").val();
       var price = price *  conv_factor;
  
    //   var quantity=$("#quantity").val();
     
  
      var vatAmount= 0;
     var SubTotal=1*price;
   var taxvalue=0;
   var total=SubTotal+taxvalue;
  //  var currency=parseFloat($("#unit_price").val());
  $(".dataadd").append( "<tr class='tbl_row'><td class='job_desc'>"+desc+" </td> <td class='job_price'>"+price1+"</td>   <td class='totalval_data'>"+total+"</td> <td><a class='rmvbutton'><i class='fa fa-trash-o'></i></a><input type='hidden' class='currency' value='"+currency+"'/><input type='hidden' class='cov_factor' value='"+conv_factor+"'/><input type='hidden' class='taxval_data' value='"+taxvalue+"'/> </td></tr>" );
  calculates();

  }



  function calculates() 
  {
    var totsub_val=0;
    $(".subtotalval_data").each(function(td) {
        var s = parseFloat($(this).html());
        totsub_val=parseFloat(totsub_val)+s;
    });
  
    var taxval_data_val=0;
    $(".taxval_data").each(function(td) {
        var s = parseFloat($(this).html());
        taxval_data_val=parseFloat(taxval_data_val)+s;
    });
  
    var totalval_data_val=0;
    $(".totalval_data").each(function(td) {
        var s = parseFloat($(this).html());
        totalval_data_val=parseFloat(totalval_data_val)+s;
    });
   
  $("#total").val(totsub_val.toFixed(2));
  $("#vat_total").val(taxval_data_val.toFixed(2));
  $("#grand_total").val(totalval_data_val.toFixed(2));
  
  
  }
  function deletedids(id,el)
  {
    deletedidarray.push(id);
    console.log(id);
    console.log(deletedidarray);
    $(el).closest("tr").remove();
    calculates();
  return false;
  }
  


  function update_debitnote_details() {
  // var Data;
  var DebitData = {
    "Code_Id": $('#post_code').val(), 
    "PostingDate":$('#post_date').val(),
    "InvDate":$('#inv_date').val(),
    "SubTotal":$('#grand_total').val(),
    "Vat":0,
    "GrandTotal":$('#grand_total').val()  ,
    "OurInv": $('#invoice_id').val(),
    "SupplierID": $('#supplier_id').val(),
    "JobId":$('#id').val(),
    "Reference": $('#invoice').val(),
    "Mode":$('#mode').val(),
    "Status":"Drafted"
   
   
  };
  var DebitDetails = [];
  var debitDetails_bc=0;
      $(".tbl_row").each(function () {
        debitDetails_bc=1;

         var Data = {
        "Description":$(this).find('.job_desc').text(),
        "Amount":$(this).find('.totalval_data').text(),
        "Currency": $(this).find('.currency').val(),
        "ConvFactor": $(this).find('.cov_factor').val(),
        "Description_Id": $(this).find('.desc_code').val()

      };
      DebitDetails.push(Data);
             
            });
   
            var  debit_code=$('#master_id').val(); 

            if(debitDetails_bc==0)
            {
             var DebitDetails ="";
            }
            if(deletedidarray.length == 0)
            {
             deletedidarray="";
            }
  
  var postData = {
    DebitData: DebitData,
    DebitDetails: DebitDetails,
    Id:debit_code,
    deleted:deletedidarray
      };
      console.log(postData);
      var request = $.ajax({
        url: '../update-debitnote',
        type: 'POST',
        data: {postData:postData} ,
        dataType: 'JSON'
        });
      request.done( function ( data ) {
        swallokalert('Debitnote Updated','job-search');

      });
      request.fail( function ( jqXHR, textStatus) {
      //   console.log(jqXHR)
      // alert(0);

        });
  
    }
  
  
  
  