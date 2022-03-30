
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
  
  
  function expensegetdata()
  {
  
  postData=$('#edesc_code').val();
  //  alert(postData);
  var request = $.ajax({
    url: 'supplier-expense-description/'+postData,
    type: 'GET',
    dataType: 'JSON'
    });
    request.done( function (result) {
      console.log(result);
    var values=JSON.stringify(result);
    $("#edescription_job").val(result[0].description);
    $("#edescription_id").val(result[0].id);

  console.log(result[0].id);
    });
  
  }
  function insert_supplier_expense()
  {
    
    if($('#view_supplier_name').val()!='')
    {
   if($('#evat').val()==''){
    $('#evat').val('0');
   }
    if($('#eunitprice,#eunit_price,#econv_factor,#equantity,#evat').val() == ''){
      swallokalert('Insert all fields!!','#');
      // alert('Insert all fields');
   }
  else{
    insertRow1();
  }
}else{alert("Please select supplier..");}
  }

  
  $(document).on("click", '.ermvbutton', function() {
           
    $(this).closest("tr").remove();
    calculates1();
  return false;
  });
  function insertRow1()
  {
    var descID=0;

    currency=$("#eunit_price").val(); 
    var myVariable;
    var request = $.ajax({
     'async': false,
     url: 'get_covfactor_supplier/'+currency,
     type: 'GET',
    dataType: 'JSON'
     });
     request.done( function (result) { 
       console.log(result);
     var values=JSON.stringify(result);
     myVariable = (result[0].conversion_factor); 
     });
     var econv_factor=myVariable; 


      var edesc= $("#edescription_job").val();
      var eprice=parseFloat($("#eunitprice").val());
      var ecurrency=$("#eunit_price").val(); 
      var eprice1=parseFloat($("#eunitprice").val());
    //  var econv_factor=parseFloat($("#econv_factor").val());
      var emode=$("#emode").val();
      
       var eprice = eprice *  econv_factor;
      var ecode=$("#edesc_code").val();
      var evatAmount=parseFloat($("#evat").val());
     var eSubTotal=1*eprice;
   var etaxvalue=((eSubTotal * evatAmount) / 100);
   var etotal=eSubTotal+etaxvalue;
  //  var currency=parseFloat($("#unit_price").val());
  $(".adddata").append( "<tr class='tblrow1'><td class='ejob_desc'>"+edesc+" </td> <td class='ejob_price'>"+eprice1+"</td> <td class='esubtotalval_data'>"+eSubTotal+"</td> <td class=''><span class='etaxval_data'>"+etaxvalue+"</span> ( <span class='taxpr_data'>"+evatAmount+"</span>% )</td>  <td class='etotalval_data'>"+etotal+"</td> <td><a class='ermvbutton'><i class='fa fa-trash-o'></i></a><input type='hidden' class='ecurrency' value='"+ecurrency+"'/><input type='hidden' class='ecov_factor' value='"+econv_factor+"'/><input type='hidden' class='edesc_code' value='"+ecode+"'/> </td></tr>" );
  calculates1();


  
// TO CLAR Text ARea and text box
/*Clear textarea using id */
$('#step-1 #edescription_job').val('');

$('#step-1 #eunitprice').val('');
//$('#step-1 #econv_factor').val('1');
$('#step-1 #evat').val('0');
$('#step-1 #epost_date').val($.datepicker.formatDate("yy-mm-dd", new Date()));
$('#view_supplier_name').attr('readonly', true);
$('#einvoice').attr('readonly', true);
$('#emode').attr('disabled', true);
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
  //  $("#evat_total").val(etaxval_data_val);
   $("#egrand_total").val(etotalval_data_val.toFixed(2));
  // alert(etotsub_val.toFixed(2));

  }
  //insert data to job-details table
  
  $( "#btn_doc" ).click(function() { 
    var type = $('#doc_type').val();
  var fileupload = $('#fileupld').val();
  
  if(type !=="" && fileupload !==""){
  $("#job_doc").submit();
  }else{
   alert("Please Fill document type");
  }
  });




  function insert_expense_details() {
  // var Data;
  // var id=$('#jobid').val();
  // alert(id);

 var supp= $('#supplier_id').val();
 if(supp!=""){
  var ExpenseData = {
    "PostId": $('#epost_code').val(), 
    "PostingDate":$('#epost_date').val(),
    "InvDate":$('#einv_date').val(),
    "SupplierID": $('#supplier_id').val(),
    "Reference": $('#einvoice').val(),
    "OurInv": "",
    "Mode":$('#emode').val(),
    "Status":"Drafted",
    "JobId":$('#job_id').val(),
    "SupplierInvoiceNo":1,
    "SubTotal":$('#etotal').val(),
    "VatTotal":$('#evat_total').val(),
    "GrandTotal":$('#egrand_total').val(),
    "Userid":$('#userid').val()  
  
  };
  // console.log(ExpenseData);
    var ExpenseDetails = [];
            $(".tblrow1").each(function () {
                var Data = {
                  "Description":$(this).find('.ejob_desc').text(),
                  "Amount":$(this).find('.ejob_price').text(),
                  "ConvFactor": $(this).find('.ecov_factor').val(),
                  "Vat": parseFloat($(this).find('.etaxval_data').text()),
                  "Total": parseFloat($(this).find('.etotalval_data').text()),
                    "Currency": $(this).find('.ecurrency').val(),
                    "Code": $(this).find('.edesc_code').val(),
                    "vat_persentage": parseFloat($(this).find('.taxpr_data').text())    
                };
                ExpenseDetails.push(Data);
               // console.log(JobDetails);
            });
            var  exp_code=$('#epost_code').val(); 
  
  var postData = {
    ExpenseDetails: ExpenseDetails,
    ExpenseData: ExpenseData
      };
      console.log(postData);
      var request = $.ajax({
        url: '../insert-expense-details',
        type: 'POST',
        data: {postData:postData} ,
        dataType: 'JSON'
        });
      request.done( function ( data ) {
        console.log(data);
       
        window.location.href='../supplier-expense-print/'+data

      });
      request.fail( function ( jqXHR, textStatus) {
      //   console.log(jqXHR)
      // alert(0);
        });
      }
      else{alert("Please select Supplier..");}
    }
  
  
    function get_url_extension( url ) {
      return url.split(/[#?]/)[0].split('.').pop().trim();
    }
  