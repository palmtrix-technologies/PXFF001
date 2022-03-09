
$( document ).ready(function() {
  $('#receipt').addClass("hidden");
  $('#description').addClass("hidden");
  $('#amnt').addClass("hidden");

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
  url: 'job-invoice-description/'+postData,
  type: 'GET',
  dataType: 'JSON'
  });
  request.done( function (result) {
    // console.log(result);
  var values=JSON.stringify(result);
  $("#description_job").val(result[0].description);
  $("#description_id").val(result[0].id);
// console.log(result[0].id);
  });

}
function insert_job_invoice()
{
  if($('#unitprice,#unit_price,#conv_factor,#quantity,#vat,#view_supplier_name,#eunitprice').val() == ''){
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


 var eprice=parseFloat($("#eunitprice").val());
 var eprice = eprice *  conv_factor;
      var ecode=$("#edesc_code").val();
      var evatAmount=parseFloat($("#vat").val());
     var eSubTotal=1*eprice;
   var etaxvalue=((eSubTotal * evatAmount) / 100);
   var etotal=eSubTotal+etaxvalue;


 var supp =$("#view_supplier_name").val();
 var suppid =$("#supplier_id").val();
 var unit_sup=$("#eunitprice").val();
//  var currency=parseFloat($("#unit_price").val());
$(".dataadd").append( "<tr class='tbl_row'><td class='job_desc'>"+desc+" </td> <td class='job_price'>"+price1+"</td><td class='job_quantity'>"+quantity+"</td> <td class='subtotalval_data'>"+SubTotal+"</td> <td class=''><span class='taxval_data'>"+taxvalue+"</span> ( <span class='taxpr_data'>"+vatAmount+"</span>% )</td>  <td class='totalval_data'>"+total+"</td><td class='supp'>"+supp+"</td><td class='unit_sup'>"+unit_sup+"</td> <td><a class='rmvbutton'><i class='fa fa-trash-o'></i></a><input type='hidden' class='currency' value='"+currency+"'/><input type='hidden' class='cov_factor' value='"+conv_factor+"'/><input type='hidden' class='esubtotalval_data' value='"+eSubTotal+"'/><input type='hidden' class='etaxval_data' value='"+etaxvalue+"'/><input type='hidden' class='etotalval_data' value='"+etotal+"'/><input type='hidden' class='supp_id' value='"+suppid+"'/> </td></tr>" );


calculates();

// TO CLAR Text ARea and text box
        /*Clear textarea using id */
				$('#step-1 #description_job').val('');
        $('#step-1 #unitprice').val('');
        $('#step-1 #conv_factor').val('1');
				$('#step-1 #quantity').val('1');
        $('#step-1 #vat').val('0');
        $('#step-1 #view_supplier_name').val('');
        $('#step-1 #eunitprice').val('');
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
//insert data to job-details table

function insert_job_details() {
    var $jobid=$('#job_id').val(); 
var JobData = {
  "Inv": $('#inv_code').val(),
  "Date":$('#date').val(),
  "JobId":$('#job_id').val(),
  "Bank":$('#bank').val(),
  "InvoiceType":$('#type').val(),
  "ReceiptNo":$('#receipt_no').val(),
  "ReceiptDescription":$('#adv_desc').val(),
  "Amount":$('#amount').val(),
  "Status":"Drafted",
  "Active":"active",
  "Total":$('#total').val(),
  "VatTotal":$('#vat_total').val(),
  "GrandTotal":$('#grand_total').val(),
  "Userid":$('#userid').val(),
  "Remark":$('#remark').val()
};   



var ExpenseData = [];
  $(".tbl_row").each(function () {
    var Datas = {
  "PostId": $('#epost_code').val(), 
  "PostingDate":$('#date').val(),
  "InvDate":$('#date').val(),
  "SupplierID":$(this).find('.supp_id').val(),
  "Reference": $('#inv_code').val(),
  "OurInv": '',
  "Mode":$('#type').val(),
  "Status":"Drafted",
  "JobId":$('#job_id').val(),
  "SupplierInvoiceNo":1,
  "SubTotal":$('#esubtotalval_data').val(),
  "VatTotal":$('#etaxval_data').val(),
  "GrandTotal":$('#etaxval_data').val(),
  "Userid":$('#userid').val()
};                                     
ExpenseData.push(Datas);
});


var ExpenseDetails = [];
$(".tbl_row").each(function () {
    var Data1 = {
      "Description":$(this).find('.job_desc').text(),
      "Amount":$(this).find('.esubtotalval_data').val(),
      "ConvFactor": $(this).find('.cov_factor').val(),
      "Vat": parseFloat($(this).find('.etaxval_data').val()),
      "Total": parseFloat($(this).find('.etotalval_data').val()),
        "Currency": $(this).find('.currency').val(),
        "Code":0,
        "SupplierID":$(this).find('.supp_id').val(),
        "vat_persentage": ''    
     
    };
    ExpenseDetails.push(Data1);
});


       var JobDetails = [];
          $(".tbl_row").each(function () {
              
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

var postDatas = {
  JobDetails:JobDetails,
  JobData: JobData
    };                            // alert(JSON.stringify(JobDetails, "", 2));

    var postData = {
      ExpenseDetails: ExpenseDetails,
      ExpenseData: ExpenseData
        };  

//  var request = $.ajax({
//   url: '../insert_expense_details',
//   type: 'POST',
//   dataType: 'JSON',
//   data: {postData:postData} ,

//   });
//   request.done( function ( data ) { alert(data);
//     window.location.href='../invoice-print/'+data
    
//     });
   

    var request1 = $.ajax({
      url: '../insert-job-details',
      type: 'POST',
      data: {postData:postDatas} ,
      dataType: 'JSON'
      });
    request1.done( function ( data ) { 
    window.location.href='../invoice-print/'+data
    
    });
    request1.fail( function ( jqXHR, textStatus) {
      swallokalert('Job Invoice  Creation failed !','#');
   

      });  

  }



