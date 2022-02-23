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
    url: '../job-invoice/job-invoice-description/'+postData,
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
  function insert_job_invoice()
  {
    if($('#unitprice,#unit_price,#conv_factor,#quantity,#vat').val() == ''){
      swallokalert('Insert all fields!!','#');
      //alert('Insert all fields');
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
      var price1=parseFloat($("#unitprice").val());
      var conv_factor=parseFloat($("#conv_factor").val());
       var price = price *  conv_factor;
  
      var quantity=$("#quantity").val();
      var currency=$("#unit_price").val();
      
      var vatAmount=parseFloat($("#vat").val());
     var SubTotal=quantity*price;
   var taxvalue=((SubTotal * vatAmount) / 100);
   var total=SubTotal+taxvalue;
  //  var currency=parseFloat($("#unit_price").val());
  $(".dataadd").append( "<tr class='tbl_row'><td class='job_desc'>"+desc+" </td> <td class='job_price'>"+price1+"</td><td class='job_quantity'>"+quantity+"</td> <td class='subtotalval_data'>"+SubTotal+"</td> <td class='taxval_data'>"+taxvalue+"</td>  <td class='totalval_data'>"+total+"</td> <td><a class='rmvbutton'><i class='fa fa-trash-o'></i></a><input type='hidden' class='currency' value='"+currency+"'/><input type='hidden' class='cov_factor' value='"+conv_factor+"'/> </td></tr>" );
  calculates();


  
// TO CLAR Text ARea and text box
/*Clear textarea using id */
$('#step-1 #description_job').val('');
$('#step-1 #unitprice').val('');
$('#step-1 #conv_factor').val('1');
$('#step-1 #quantity').val('1');
$('#step-1 #vat').val('0');
$('#step-1 #date').val($.datepicker.formatDate("yy-mm-dd", new Date()));

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
  
function update_jobInvoice_details() {
  // var Data;
    var invoiceid=$("#invid").val();
  var JobData = {
                
    "Inv": $('#inv_code').val(),
    "Date":$('#date').val(),
    "Bank":$('#bank').val(),
    "InvoiceType":$('#type').val(),
    "ReceiptNo":$('#receipt_no').val(),
    "ReceiptDescription":$('#adv_desc').val(),
    "Amount":$('#amount').val(),
    "Status":"Drafted",
    "Active":"active",
    "Total":$('#total').val(),
    "VatTotal":$('#vat_total').val(),
    "GrandTotal":$('#grand_total').val()
  };
    var JobDetails = [];
    var JobDetails_bc=0;
            $(".tbl_row").each(function () {
              JobDetails_bc=1;
                var Data = {
                  "Description":$(this).find('.job_desc').text(),
                    "UnitPrice": $(this).find('.job_price').text(),
                    "Currency": $(this).find('.currency').val(),
                    "ConvFactor": $(this).find('.cov_factor').val(),
                     "Quantity":$(this).find('.job_quantity').text(),
                     "Vat": parseFloat($(this).find('.taxval_data').text()),
                     "Total": parseFloat($(this).find('.totalval_data').text())
                    
                };
                JobDetails.push(Data);
               // console.log(JobDetails);
            });
       var  inv_code=$('#inv_code').val(); 

       if(JobDetails_bc==0)
       {
        var JobDetails ="";
       }
       if(deletedidarray.length == 0)
       {
        deletedidarray="";
       }
       
console.log(JobData);
  var postData = {
    JobDetails: JobDetails,
    JobData: JobData,
    Id:invoiceid,
    deleted:deletedidarray
      };
      console.log(postData);
      var request = $.ajax({
        url: '../update-job-details',
        type: 'POST',
        data: {postData:postData} ,
        dataType: 'JSON'
        });
      request.done( function ( data ) {
        swallokalert('Job Invoice Updated','#');
     
      });
      request.fail( function ( jqXHR, textStatus) {
   
        });
  
      }
  
  
  
  