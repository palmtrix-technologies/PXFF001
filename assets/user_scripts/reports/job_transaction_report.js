$( document ).ready(function() {
    $('#invoicetb').addClass("hidden");
    $('#creditnotetb').addClass("hidden");
    $('#receipttb').addClass("hidden");
    $('#expensetb').addClass("hidden");  
    $('#denbitnotetb').addClass("hidden");
    $('#paymenttb').addClass("hidden"); 

  
  
  });
  function unhide()
{
    $('#invoicetb').removeClass("hidden");
    $('#creditnotetb').removeClass("hidden");
    $('#receipttb').removeClass("hidden");
    $('#expensetb').removeClass("hidden");  
    $('#denbitnotetb').removeClass("hidden");
    $('#paymenttb').removeClass("hidden"); 
}
//job transaction report
function get_transaction_report()
{
unhide();
  jobno=$('#jobno').val();
  awb=$('#awb').val();

  if(jobno!="")
  {

    $("#lblJobNo").html("Job No :"+jobno);
    $("#lblJobNo1").html("Job No :"+jobno);
     $("#lblJobNo2").html("Job No :"+jobno);
      $("#lblJobNo3").html("Job No :"+jobno);
      $("#lblJobNo4").html("Job No :"+jobno);
      $("#lblJobNo5").html("Job No :"+jobno);
  }
  if(jobno=="")
  {

    $("#lblJobNo").html("MAWB/AWB :"+awb);
    $("#lblJobNo1").html("MAWB/AWB :"+awb);
     $("#lblJobNo2").html("MAWB/AWB :"+awb);
      $("#lblJobNo3").html("MAWB/AWB :"+awb);
      $("#lblJobNo4").html("MAWB/AWB :"+awb);
      $("#lblJobNo5").html("MAWB/AWB :"+awb);
  }
// console.log(awb);
   if((jobno=='')&& (awb==''))
   {
    swallokalert('Please enter valid jobno or AWB/MAWB!!','');

   }
    var postData={
      jobno:jobno,
      awb:awb
    }

    var request = $.ajax({
        url: 'job-transaction-report-data/',
        type: 'POST',
        data: {postData:postData} ,
        dataType: 'JSON'
        });
        request.done( function (result) {
       console.log(result);
        var values=JSON.stringify(result);
     
        $(".invoicereport").html("");

        var Invsum=0;
        var slno=0;
        
$.each(result["jobinoicedata"],function(index,value) {
 
    slno=slno+1;
    date=value.Dates;
    inv=value.Inv;
    psarticulars=value.Patriculars;
//   code=value.ID;
    mode=value.InvoiceType;
  customer=value.name;
  debit=value.Debit;
  credit=value.Credit;
  Invsum=parseFloat(Invsum)+parseFloat(debit);
 
    $(".invoicereport").append( "<tr class='tbl_row'><td class='sl'>"+slno+"</td><td class='inv'>"+inv+"</td> <td class='date'>"+date+"</td><td class='psarticulars'>"+psarticulars+"</td>  <td class='customer'>"+customer+"</td><td class='mode'>"+mode+"</td> <td class='credit'>"+credit+"</td><td class=' debit'>"+ debit+"</td><td id='totprofit'></td> </tr>" );
});

Invsum=parseFloat(Invsum).toFixed(2);
$(".invoicereport").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td colspan='6' > Total Invoice </td><td></td><td style='text-align: left;'>"+Invsum+"</td><td></td></tr>");      
      
$("#clientid").html(customer);
$("#profit").html(customer);


$(".creditdata").html("");

    

var slno=0;
var creditsum=0;
$.each(result["jobcreditnotedata"],function(index,value) {

slno=slno+1;
date=value.Dates;
inv=value.Code_Id;

//   code=value.ID;
mode="Credit";
customer=value.name;
debit=value.Debit;
credit=value.Credit;
creditsum=parseFloat(creditsum)+parseFloat(credit);

$(".creditdata").append( "<tr class='tbl_row'><td class='sl'>"+slno+"</td><td class='inv'>"+inv+"</td><td class='date'>"+date+"</td>   <td class='customer'>"+customer+"</td><td class='mode'>"+mode+"</td><td class=' credit'>"+ credit+"</td> <td class='debit'>"+debit+"</td> </tr>" );
});   
creditsum=parseFloat(creditsum).toFixed(2);
$(".creditdata").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td colspan='4' > Total Creditnote </td><td></td><td style='text-align: left;'>"+creditsum+"</td><td></td></tr>");      
    
$(".receiptdata").html("");

    

var slno=0;
var receiptsum=0;
$.each(result["jobreceiptdata"],function(index,value) {

slno=slno+1;
date=value.Dates;
doc=value.ID;
inv=value.Inv;

  particulars=value.Descriptions;
ref="";
customer=value.name;
mode=value.Mode;
debit=value.Debit;
credit=value.Credit;
receiptsum=parseFloat(receiptsum)+parseFloat(credit);


$(".receiptdata").append( "<tr class='tbl_row'><td class='sl'>"+slno+"</td><td class='date'>"+date+"</td><td class='doc'>"+doc+"</td> <td class='particulars'>"+particulars+"</td><td class='inv'>"+inv+"</td>  <td class='ref'>"+ref+"</td> <td class='customer'>"+customer+"</td><td class='mode'>"+mode+"</td><td class=' credit'>"+ credit+"</td> <td class='debit'>"+debit+"</td> </tr>" );
}); 
receiptsum=parseFloat(receiptsum).toFixed(2);
$(".receiptdata").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td colspan='7' > Total Receitps </td><td></td><td style='text-align: left;'>"+receiptsum+"</td><td></td></tr>");      
 
$(".expensedata").html("");

    

var slno=0;
var expensesum=0;
$.each(result["jobexpensedata"],function(index,value) {

slno=slno+1;
date=value.InvDate;
postingdata=value.PostingDate;
doc=value.PostId;
inv=value.OurInv;
particulars=value.Descriptions;
ref=value.Reference;
supplier=value.supplier_name;
mode=value.Mode;
debit=value.Debit;
credit=value.Credit;

Status=value.Status;
expensesum=parseFloat(expensesum)+parseFloat(credit);

$(".expensedata").append( "<tr class='tbl_row'><td class='sl'>"+slno+"</td><td class='date'>"+date+"</td><td class='postingdata'>"+postingdata+"</td> <td class='doc'>"+doc+"</td> <td class='particulars'>"+particulars+"</td> <td class='ref'>"+ref+"</td> <td class='inv'>"+inv+"</td> <td class='supplier'>"+supplier+"</td>  <td class='mode'>"+mode+"</td><td class=' Status'>"+ Status+"</td><td class=' credit'>"+ credit+"</td> <td class='debit'>"+debit+"</td></tr>" );
}); 
expensesum=parseFloat(expensesum).toFixed(2);
$(".expensedata").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td colspan='9' > Total Expense </td><td></td><td style='text-align: left;'>"+expensesum+"</td><td></td></tr>");      
profit=parseFloat(Invsum)-parseFloat(expensesum);
profit=parseFloat(profit).toFixed(2);

$("#profit").html(profit);
$("#totprofit").html(profit);


$(".debitdata").html("");

    

var slno=0;
var debitsum=0;
$.each(result["jobdebitdata"],function(index,value) {

slno=slno+1;
date=value.InvDate;
postingdata=value.PostingDate;
doc=value.Code_Id;
inv=value.OurInv;
particulars=value.Descriptions;
ref=value.Reference;
supplier=value.supplier_name;
mode=value.Mode;
debit=value.Debit;
credit=value.Credit;

Status=value.Status;
debitsum=parseFloat(debitsum)+parseFloat(debit);

$(".debitdata").append( "<tr class='tbl_row'><td class='sl'>"+slno+"</td><td class='date'>"+date+"</td><td class='postingdata'>"+postingdata+"</td> <td class='doc'>"+doc+"</td> <td class='particulars'>"+particulars+"</td> <td class='ref'>"+ref+"</td> <td class='inv'>"+inv+"</td> <td class='supplier'>"+supplier+"</td>  <td class='mode'>"+mode+"</td><td class=' Status'>"+ Status+"</td><td class=' credit'>"+ credit+"</td> <td class='debit'>"+debit+"</td></tr>" );
}); 
debitsum=parseFloat(debitsum).toFixed(2);
$(".debitdata").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td colspan='10' > Total Debitnote </td><td></td><td style='text-align: left;'>"+debitsum+"</td></tr>");      
 
$(".paymentdata").html("");

    

var slno=0;
var paymentsum=0;
$.each(result["paymentdata"],function(index,value) {

slno=slno+1;
date=value.Dates;
particulars="";
doc=value.ID;
ref=value.Reference;
inv=value.OurInv;

supplier=value.supplier_name;
mode=value.Mode;
status=value.Status;
client=value.name;
debit=value.Debit;
credit=value.Credit;
paymentsum=parseFloat(paymentsum)+parseFloat(debit);

$(".paymentdata").append( "<tr class='tbl_row'><td class='sl'>"+slno+"</td><td class='date'>"+date+"</td><td class='particulars'>"+particulars+"</td> <td class='doc'>"+doc+"</td> <td class='ref'>"+ref+"</td> <td class='inv'>"+inv+"</td> <td class='supplier'>"+supplier+"</td> <td class='mode'>"+mode+"</td><td class=' Status'>"+ Status+"</td><td class=' client'>"+ client+"<td class=' credit'>"+ credit+"</td><td class='debit'>"+debit+"</td> </tr>" );
}); 
paymentsum=parseFloat(paymentsum).toFixed(2);
$(".paymentdata").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td colspan='10' > Total Payment </td><td></td><td style='text-align: left;'>"+paymentsum+"</td></tr>");      
 
});

request.fail( function ( jqXHR, textStatus) {
      
  swallokalert('Please enter valid jobno or AWB/MAWB!!','');

     
        });
  
}
