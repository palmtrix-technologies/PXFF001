var deletedidarray=[];
$( document ).ready(function() {
  
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
  // alert(selected_value);
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
  
  
    function getdata()
  {
  
  postData=$('#desc_code').val();
  //  alert(postData);
  var request = $.ajax({
    url: '../supplier-expense/supplier-expense-description/'+postData,
    type: 'GET',
    dataType: 'JSON'
    });
    request.done( function (result) {
      console.log(result);
    var values=JSON.stringify(result);
    $("#edescription_job").val(result[0].description);
    $("#description_id").val(result[0].id);
  console.log(result[0].id);
    });
  
  }
  function insert_expense()
  {
    if($('#unitprice,#unit_price,#conv_factor,#quantity,#vat').val() == ''){
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
      var desc= $("#edescription_job").val();
      var price=parseFloat($("#unitprice").val());
      var currency=$("#unit_price").val(); 
      var price1=parseFloat($("#unitprice").val());
      var conv_factor=parseFloat($("#conv_factor").val());
      var mode=$("#mode").val();
       var price = price *  conv_factor;
  
    //   var quantity=$("#quantity").val();
    var code=$("#desc_code").val();
      
      var vatAmount=parseFloat($("#vat").val());
     var SubTotal=1*price;
   var taxvalue=((SubTotal * vatAmount) / 100);
   var total=SubTotal+taxvalue;
  //  var currency=parseFloat($("#unit_price").val());
  $(".dataadd").append( "<tr class='tbl_row'><td class='job_desc'>"+desc+" </td> <td class='job_price'>"+price1+"</td> <td class='subtotalval_data'>"+SubTotal+"</td> <td class='taxval_data'>"+taxvalue+"</td>  <td class='totalval_data'>"+total+"</td> <td><a class='rmvbutton'><i class='fa fa-trash-o'></i></a><input type='hidden' class='currency' value='"+currency+"'/><input type='hidden' class='cov_factor' value='"+conv_factor+"'/><input type='hidden' class='desc_code' value='"+code+"'/>  </td></tr>" );
  calculates();
  
  
// TO CLAR Text ARea and text box
/*Clear textarea using id */

$('#step-1 #edescription_job').val('');
$('#step-1 #unitprice').val('');
$('#step-1 #unit_price').val('1');
$('#step-1 #conv_factor').val('1');
$('#step-1 #vat').val('0');
$('#step-1 #date').val($.datepicker.formatDate("yy-mm-dd", new Date()));

$('#view_supplier_name').attr('readonly', true);
$('#invoice').attr('readonly', true);
$('#mode').attr('disabled', true);
  }
  function calculates() {
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
  
        //To delete the selected rows from jobinvoicedetails tb
    
  function deletedids(id,el)
  {
    deletedidarray.push(id);
    console.log(id);
    console.log(deletedidarray);
    $(el).closest("tr").remove();
    calculates();
  return false;
  }
//update job invoice data
  
function update_expense_details() {
  // var Data;
  var ExpenseData = {
                
    "PostId": $('#post_code').val(), 
    "PostingDate":$('#post_date').val(),
    "InvDate":$('#inv_date').val(),
    "SupplierID": $('#supplier_id').val(),
    "Reference": $('#invoice').val(),
    "OurInv": "",
    "Mode":$('#mode').val(),
    "Status":"Drafted",
    "JobId":$('#id').val(),
    "SupplierInvoiceNo":1,
    "SubTotal":$('#total').val(),
    "VatTotal":$('#vat_total').val(),
    "GrandTotal":$('#grand_total').val()  
  };
    var ExpenseDetails = [];
    var expDetails_bc=0;
            $(".tbl_row").each(function () {
              expDetails_bc=1;
                var Data = {
                  "Description":$(this).find('.job_desc').text(),
                  "Amount":$(this).find('.job_price').text(),
                  "ConvFactor": $(this).find('.cov_factor').val(),
                  "Vat": parseFloat($(this).find('.taxval_data').text()),
                  "Total": parseFloat($(this).find('.totalval_data').text()),
                    "Currency": $(this).find('.currency').val(),
                    "Code": $(this).find('.desc_code').val()   
                };
                ExpenseDetails.push(Data);
               // console.log(JobDetails);
            });
       var  exp_code=$('#master_id').val(); 

       if(expDetails_bc==0)
       {
        var ExpenseDetails ="";
       }
       if(deletedidarray.length == 0)
       {
        deletedidarray="";
       }
       

  var postData = {
    ExpenseDetails: ExpenseDetails,
    ExpenseData: ExpenseData,
    Id:exp_code,
    deleted:deletedidarray
      };
      console.log(postData);
      var request = $.ajax({
        url: '../update-supplier-expense',
        type: 'POST',
        data: {postData:postData} ,
        dataType: 'JSON'
        });
      request.done( function ( data ) {
        swallokalert('supplier expense Updated!','#');
         //alert("supplier expense Updated");
    //  window.location.href='../supplier-expense-print/'+inv_code

      });
      request.fail( function ( jqXHR, textStatus) {
      //   console.log(jqXHR)
      // alert(0);
      // window.location.href='../edit-job-invoice/'+inv_code
        });
  
      }
  
  
  
  