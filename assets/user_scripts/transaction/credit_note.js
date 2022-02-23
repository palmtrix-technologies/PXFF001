
$( document ).ready(function() {
    $('#receipt').addClass("hidden");
    $('#description').addClass("hidden");
    $('#amnt').addClass("hidden");
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
  
  
function getdata()
  {
  
  postData=$('#desc_code').val();
  var request = $.ajax({
    url: 'creditnote-description/'+postData,
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

  function insert_credit_note()
  {
    if($('#unitprice,#unit_price,#conv_factor,#quantity,#vat').val() == '')
    {
      swallokalert('Insert all fields!!','#');
     // alert('Insert all fields');
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
      var price = price *  conv_factor;
    var quantity=$("#quantity").val();
     var SubTotal=quantity*price;
    var taxvalue=0;
    var total=SubTotal+taxvalue;

  $(".dataadd").append( "<tr class='tbl_row'><td class='job_desc'>"+desc+" </td> <td class='price_val'>"+price1+"</td> <td class='quanty'>"+quantity+"</td>  <td class='totalval_data'>"+total+"</td> <td><a class='rmvbutton'><i class='fa fa-trash-o'></i></a><input type='hidden' class='currency' value='"+currency+"'/><input type='hidden' class='cov_factor' value='"+conv_factor+"'/> <input type='hidden' class='taxval_data' value='"+taxvalue+"'/></td></tr>" );
  calculates();
  
// TO CLAR Text ARea and text box
        /*Clear textarea using id */
				$('#step-1 #description_job').val('');
        $('#step-1 #unitprice').val('');
        $('#step-1 #unit_price').val('1');
        $('#step-1 #conv_factor').val('1');

				$('#step-1 #quantity').val('1');
        $('#step-1 #post_date').val($.datepicker.formatDate("yy-mm-dd", new Date()));

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
  //insert data to creditnote-details table
  


  function insert_creditnote_details() {
 
  var CreditnoteData = {
    "Code_Id": $('#post_code').val(), 
    "PostingDate":$('#post_date').val(),
    "Date":$('#inv_date').val(),
    "JobId":$('#id').val(),
    "Total":$('#grand_total').val(),
    "Vat":0,
    "GrandTotal":$('#grand_total').val() ,
    "Status":"Drafted"

    
     
  };
    var CreditnoteDetails = [];
            $(".tbl_row").each(function () {
                var Data = {
                  "Description":$(this).find('.job_desc').text(),
                  "UnitPrice": $(this).find('.price_val').text(),
                  "Currency": $(this).find('.currency').val(),
                  "ConvFactor": $(this).find('.cov_factor').val(),
                  "Quantity":$(this).find('.quanty').text(),
                  "Total": parseFloat($(this).find('.totalval_data').text())
                                
                };
                CreditnoteDetails.push(Data);
               
            });

            var  credit_code=$('#post_code').val(); 
  var postData = {
    CreditnoteDetails: CreditnoteDetails,
    CreditnoteData: CreditnoteData
      };
      console.log(postData);
      var request = $.ajax({
        url: '../insert-credit-note',
        type: 'POST',
        data: {postData:postData} ,
        dataType: 'JSON'
        });
      request.done( function ( data ) {
        window.location.href='../credit-note-print/'+data
      });
      request.fail( function ( jqXHR, textStatus) {
      
        });
  
    }
  
  
  
  