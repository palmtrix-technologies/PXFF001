var job_id=0;
var baseurl=$('#baseurl').val();
$( document ).ready(function() {
    $('#description').addClass("hidden");
    $('#title').addClass("hidden");
    
  
  });
  function search_job()
{
    var jobid = $('#q').val();
  
    if($.isNumeric(jobid))
    {
       visiblejobdescription();
    }
    else{
      swallokalert('please enter valid job id!!','#');
        //alert("please enter valid job id");
    }

}  
  
function visiblejobdescription()
{
  
  
     $('#description').removeClass("hidden");
     $('#title').removeClass("hidden");
     postData=$('#q').val();
     var request = $.ajax({
  url: 'job-description/'+postData,
  type: 'GET',
  dataType: 'JSON'
  });
  request.done( function (result) {
    // console.log(result);
  
   var values=JSON.stringify(result);
   
   console.log(result);
   
  //  alert(values[0].JobId);
  $("#job_id").text(result["jobdata"][0].Jobcode);
  $("#id").text(result["jobdata"][0].JobId);
  $("#client_id").text(result["jobdata"][0].client_id);
  $("#shipper").text(result["jobdata"][0].consignor);
  $("#consignee").text(result["jobdata"][0].consignee);
  $("#client").text(result["jobdata"][0].clientenglish);
  $("#terms").text(result["jobdata"][0].ShipmentTerms);
  $("#desc").text(result["jobdata"][0].Description);
 //to print invoice total
 job_id= $('#id').text();
 clientid= $("#client_id").text();
 console.log(clientid);
$("#invctotal").text(result["invoicetotal"][0].sumvalue);
//invoice
var Invsum=0;Invsum1=0;
    var slno=0;
    $(".dataadd").html("");$(".datainv").html("");
    $.each(result["invoicedata"], function(index, value){

         slno=slno+1;
        var inv=value.Inv;
        var date=value.Date;
        var mode=value.InvoiceType;
        // var vattotal=value.Vat;
        // var Remarks=value.Remark;
         var subtotaldata=parseFloat(value.GrandTotal)-parseFloat(value.VatTotal).toFixed(2);
        // sum=parseFloat(subtotaldata);
        // var grandtotal=parseFloat(value.Total).toFixed(2);
        var vattotal=value.VatTotal;
        var Remarks=value.Remark;
        sum=parseFloat(subtotaldata);
        var status=value.Status;
        var invmasterid=value.InvoiceMasterId;
        if(status=='Drafted')
        {
          var grandtotal=parseFloat(value.GrandTotal).toFixed(2);
        Invsum=parseFloat(Invsum)+parseFloat(grandtotal);
        var subtotaldata1=value.Total;
        }
        else
        {
          var subtotaldata2=value.Total;
          var grandtotal1=parseFloat(value.GrandTotal).toFixed(2);
          Invsum1=parseFloat(Invsum1)+parseFloat(grandtotal1);
        }
      
       var stringval='<ul class="nav"><li class="dropdown"> <a class="btn btn-sm dropdown-toggle" style="width: 50px;" data-toggle="dropdown" href="#"><i class="fa fa-ellipsis-v"></i></a><ul class="dropdown-menu">';          
         if(status=='Drafted')
         {
           stringval=stringval+'<li role="presentation"><a role="menuitem" tabindex="-1" href="'+baseurl+'edit-job-invoice/'+invmasterid+'">Edit</a></li>';
           stringval=stringval+'<li role="presentation"><a role="menuitem" tabindex="-1" href="'+baseurl+'change-invoice-status/'+invmasterid+'/'+clientid+'">Post invoice and print</a></li>';
         }
         stringval=stringval+'<li role="presentation"><a role="menuitem" target="_blank" tabindex="-1" href="'+baseurl+'invoice-print/'+invmasterid+'">View invoice</a></li>';
      
         stringval=stringval+'</ul> </li>  </ul>';
         if(status=='Drafted')
         {
         $(".dataadd").append( "<tr class='tbl_row'><td class='sl'>"+slno+" </td> <td class='inv'>"+inv+"</td><td class='date'>"+date+"</td>  <td class='mode'>"+mode+"</td>  <td class='vattotal'>"+vattotal+"</td><td class='totaldata'>"+subtotaldata+"</td><td class='grandtotal' style='text-align:right;'>"+grandtotal+"</td><td class='remark' style='text-align:left;'>"+Remarks+" </td><td>"+stringval+" </td></tr>" );
         }
         else
         {
         $(".datainv").append( "<tr class='tbl_row'><td class='sl'>"+slno+" </td> <td class='inv'>"+inv+"</td><td class='date'>"+date+"</td>  <td class='mode'>"+mode+"</td>  <td class='vattotal'>"+vattotal+"</td><td class='totaldata'>"+subtotaldata+"</td><td class='grandtotal' style='text-align:right;'>"+grandtotal1+"</td><td class='remark' style='text-align:left;'>"+Remarks+" </td><td>"+stringval+" </td></tr>" );
         }

    });
    Invsum=parseFloat(Invsum).toFixed(2);
    Invsum1=parseFloat(Invsum1).toFixed(2);
    $(".dataadd").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td colspan='6' > Total Invoice </td><td style='text-align: right;'>"+Invsum+"</td><td></td><td></td></tr>"); 
   
    $(".datainv").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td colspan='6' > Total Invoice </td><td style='text-align: right;'>"+Invsum1+"</td><td></td><td></td></tr>"); 
   
//Estimate
var Invsum=0;
    var slno=0; 
    $(".dataadda").html("");
    $.each(result["estimatedata"], function(index, value){
      
         slno=slno+1;
        var inv=value.estimate_no;
        var date=value.e_date;
        var jobsid =value.job_id;
       
        var vattotal=value.tax_amount;
        
        var subtotaldata=parseFloat(value.total_amount);
        sum=parseFloat(subtotaldata);

        var grandtotal=parseFloat(value.grand_total).toFixed(2);

        var status1=value.status; 

       var stringval='<ul class="nav"><li class="dropdown"> <a class="btn btn-sm dropdown-toggle" style="width: 50px;" data-toggle="dropdown" href="#"><i class="fa fa-ellipsis-v"></i></a><ul class="dropdown-menu">';          
        

         stringval=stringval+'<li role="presentation"><a role="menuitem" target="_blank" tabindex="-1" href="'+baseurl+'estimate-print/'+value.estimate_masterid+'">View Estimate</a></li>';
 if(status1=='drafted')
         {
         stringval=stringval+'<li role="presentation"><a role="menuitem" target="_blank" tabindex="-1" href="'+baseurl+'estimate-invoice/'+value.estimate_masterid+'">Post to Invoice</a></li>';
         stringval=stringval+'<li role="presentation"><a role="menuitem" target="_blank" tabindex="-1" href="'+baseurl+'edit-consignment/'+value.job_id+'">Edit Estimate</a></li>';
        }
         stringval=stringval+'</ul> </li>  </ul>';

         $(".dataadda").append( "<tr class='tbl_row'><td class='sl'>"+slno+" </td> <td class='inv'>"+inv+"</td><td class='date'>"+date+"</td>   <td class='vattotal'>"+vattotal+"</td><td class='totaldata'>"+subtotaldata+"</td><td class='grandtotal' style='text-align:right;'>"+grandtotal+"</td><td>"+stringval+" </td></tr>" );

      

    });
    Invsum=parseFloat(Invsum).toFixed(2);
    $(".dataadda").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td colspan='6' > Total Invoice </td><td style='text-align: right;'>"+Invsum+"</td><td></td></tr>"); 
   

  //  console.log(Invsum);
    //credit note 
    var slno=0;
    var Creditsum=0;
    $(".creditdata").html("");
    $.each(result["creditnotedata"], function(index, value){
    
      slno=slno+1;
        var code=value.Code_Id;
        var date=value.Date;
      
        var cunstomer=value.name;
       var creditnotemasetrid=value.Creditnote_master_id;
      var amount=parseFloat(value.Total).toFixed(2);
      Creditsum=parseFloat(Creditsum)+parseFloat(amount);
      
      var stringval='<ul class="nav"><li class="dropdown"> <a class="btn btn-sm dropdown-toggle" style="width: 50px;" data-toggle="dropdown" href="#"><i class="fa fa-ellipsis-v"></i></a><ul class="dropdown-menu">';          
   
        stringval=stringval+'<li role="presentation"><a role="menuitem" tabindex="-1" href="'+baseurl+'edit-creditnote/'+creditnotemasetrid+'">Edit</a></li>';
        stringval=stringval+'<li role="presentation"><a role="menuitem" tabindex="-1" href="'+baseurl+'change-creditnote-status/'+creditnotemasetrid+'/'+clientid+'">Post creditnote and print</a></li>';

    

      stringval=stringval+'<li role="presentation"><a role="menuitem" tabindex="-1" target="_blank" href="'+baseurl+'credit-note-print/'+creditnotemasetrid+'">View creditnote</a></li>';
  
      stringval=stringval+'</ul> </li>  </ul>';
        $(".creditdata").append( "<tr class='tbl_row'><td class='sl'>"+slno+" </td> <td class='code'>"+code+"</td><td class='date'>"+date+"</td> <td class='cunstomer'>"+cunstomer+"</td> <td class='amount'  colspan='1'>"+amount+"</td><td>"+stringval+" </td></tr>" );

    });
    Creditsum=parseFloat(Creditsum).toFixed(2);
    
    $(".creditdata").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td colspan='4' > Total Amount </td><td >"+Creditsum+"</td><td></td></tr>"); 

    //payment receipt
    var slno=0;
    var receipt=0;
    $(".paymentreceipt").html("");
    $.each(result["receiptdata"], function(index, value){
    
      slno=slno+1;
       var date=value.Date;
       var doc=value.ID;
       var particulars=value.particulars;
       var invoice=value.Inv;
      //  var amount=value.SubTotal;
       var amount=parseFloat(value.SubTotal).toFixed(2);

       receipt=parseFloat(receipt)+parseFloat(amount);

        $(".paymentreceipt").append( "<tr class='tbl_row'><td class='sl'>"+slno+" </td> <td class='date'>"+date+"</td> <td class='doc'>"+doc+"</td> <td class='particulars'>"+particulars+"</td> <td class='invoice'>"+invoice+"</td>  <td class='amount' style='text-align:right;'>"+amount+"</td> </tr>" );

    });
    receipt=parseFloat(receipt).toFixed(2);
    $(".paymentreceipt").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td colspan='5' > Total Receipt </td><td style='text-align: right;'>"+receipt+"</td></tr>"); 


    var slno=0;
    var Expense=0;
    $(".postedexpense").html("");
    $.each(result["expense"], function(index, value){
        // console.log(value.Inv);
      slno=slno+1;
     
        var date=value.InvDate;
        var supid=value.SupplierID;
        var doc=value.PostId;
        // var particulars=value.Description;;
        var status=value.Status;
        var invoice=value.invoice;
        var supplier=value.supplier_name;
         var expensemasterid=value.ExpenseMasterId;
      var amount=parseFloat(value.Total).toFixed(2);
      Expense=parseFloat(Expense)+parseFloat(amount);
      var stringval='<ul class="nav"><li class="dropdown"> <a class="btn btn-sm dropdown-toggle" style="width: 50px;" data-toggle="dropdown" href="#"><i class="fa fa-ellipsis-v"></i></a><ul class="dropdown-menu">';          
      if(status=='Drafted')
      {
        stringval=stringval+'<li role="presentation"><a role="menuitem" tabindex="-1" href="'+baseurl+'edit-supplier-expense/'+expensemasterid+'">Edit</a></li>';
        stringval=stringval+'<li role="presentation"><a role="menuitem" tabindex="-1" href="'+baseurl+'change-supplier-expense-status/'+expensemasterid+'/'+supid+'">Post expense </a></li>';
      }
     //  else{

      stringval=stringval+'<li role="presentation"><a role="menuitem" target="_blank" tabindex="-1" href="'+baseurl+'supplier-expense-print/'+expensemasterid+'">View expense</a></li>';
     //  }
      stringval=stringval+'</ul> </li>  </ul>';
        $(".postedexpense").append( "<tr class='tbl_row'><td class='sl'>"+slno+" </td> <td class='date'>"+date+"</td> <td class='doc'>"+doc+"</td>  <td class='invoice'>"+invoice+"</td> <td class='supplier'>"+supplier+"</td> <td class='amount' style='text-align: right;'>"+amount+"</td><td>"+stringval+" </td></tr>" );

    });
    Expense=parseFloat(Expense).toFixed(2);
    $(".postedexpense").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td colspan='5' > Total Expense</td><td style='text-align: right;'>"+Expense+"</td><td></td></tr>"); 

    var debitnote=0;
    var slno=0;
    $(".debitnote").html("");
    $.each(result["debitnotedata"], function(index, value){
        // console.log(value.Inv);
      slno=slno+1;
     
        var date=value.InvDate;
      var suplierid=value.SupplierID;
        var doc=value.Code_Id;
        //  var particulars=value.Description;
        var invoice=value.Inv;
        var supplier=value.supplier_name;
   
      var amount=parseFloat(value.Amount).toFixed(2);
      debitnote=parseFloat(debitnote)+parseFloat(amount);
      var debitmasterid=value.Debitnote_Master_id;
      // total=total+amount;
      var stringval='<ul class="nav"><li class="dropdown"> <a class="btn btn-sm dropdown-toggle" style="width: 50px;" data-toggle="dropdown" href="#"><i class="fa fa-ellipsis-v"></i></a><ul class="dropdown-menu">';          
   
      stringval=stringval+'<li role="presentation"><a role="menuitem" tabindex="-1" href="'+baseurl+'edit-debitnote/'+debitmasterid+'">Edit</a></li>';
      stringval=stringval+'<li role="presentation"><a role="menuitem" tabindex="-1" href="'+baseurl+'change-debit-note-status/'+debitmasterid+'/'+suplierid+'">Post expense and print</a></li>';

  

    stringval=stringval+'<li role="presentation"><a role="menuitem" tabindex="-1" target="_blank " href="'+baseurl+'debit-note-print/'+debitmasterid+'">View creditnote</a></li>';

    stringval=stringval+'</ul> </li>  </ul>';
        $(".debitnote").append( "<tr class='tbl_row'><td class='sl'>"+slno+" </td> <td class='date'>"+date+"</td> <td class='doc'>"+doc+"</td><td class='invoice'>"+invoice+"</td> <td class='supplier'>"+supplier+"</td> <td class='amount' style='text-align: right;'>"+amount+"</td><td>"+stringval+" </td></tr>" );

    });
    debitnote=parseFloat(debitnote).toFixed(2);
    $(".debitnote").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td colspan='6' > Total Debitnote </td><td style='text-align: right;'>"+debitnote+"</td><td></td><td></td></tr>"); 
    //  console.log(total)
    var suppayment=0;
    var slno=0;
    $(".payment").html("");
    $.each(result["supplierpayment"], function(index, value){
        // console.log(value.Inv);
      slno=slno+1;
     
        var date=value.Date;
      
        var doc=value.ID;
        var particulars=value.Description;
        // var invoice="";
        var supplier=value.supplier_name;
    
      var amount=parseFloat(value.Total).toFixed(2);
      suppayment=parseFloat(suppayment)+parseFloat(amount);
        $(".payment").append( "<tr class='tbl_row'><td class='sl'>"+slno+" </td> <td class='date'>"+date+"</td> <td class='doc'>"+doc+"</td> <td class='supplier'>"+supplier+"</td> <td class='amount' style='text-align: right;'>"+amount+"</td> </tr>" );

    });
    suppayment=parseFloat(suppayment).toFixed(2);
    $(".payment").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td colspan='4' > Total Supplier Payment </td><td style='text-align: right;'>"+suppayment+"</td></tr>"); 
  

    var slno=0;
    $(".docus").html("");
    $.each(result["jobdocument"], function(index, value){
      // console.log(value.Inv);
    slno=slno+1;
   
      var type=value.doc_type;
      var file=value.file_path;
   
      var extension = get_url_extension(file.replace(" ", "_"));
      var url = file.replace(" ", "_");
      // alert(url);
      if(extension=="pdf"){
       
        url = './assets/images/pdf.png';
      }else if(extension=="csv"){
        url = './assets/images/excel.png';
      }else if(extension=="doc"){
        url = './assets/images/doc.png';
      }
      else if(extension=="docx"){
        url = './assets/images/doc.png';
      }
      $(".docus").append( "<tr class='tbl_row'><td class='sl'>"+slno+" </td> <td class='type'>"+type+"</td> <td class='file'><img src='./"+url+"' style='width:50px;'></td><td class=''><a href='./"+file+"' class='btn btn-xs btn-success downloadable' download><i class='fa fa-download'></i></a></td> </tr>" );

  });



  var slno=0;
  var credittotal=0;
  var debittotal=0;
  $(".estimateledger").html("");    
  $.each(result["estimateprofit"], function(index, value){  

    slno=slno+1;
      var date=value.e_date;
      var type=value.types;
      var description=value.Descriptions;
      var credit=parseFloat(value.Debit).toFixed(2);
      var debit=parseFloat(value.Credit).toFixed(2);
      credittotal=parseFloat(credittotal)+parseFloat(credit);
      debittotal=parseFloat(debittotal)+parseFloat(debit);
      $(".estimateledger").append( "<tr class='tbl_row'><td class='sl'>"+slno+" </td> <td class='date'>"+date+"</td> <td class='type'>"+type+"</td> <td class='description'>"+description+"</td> <td class='credit' style='text-align: right;'>"+credit+"</td> <td class='debit' style='text-align: right;'>"+debit+"</td>  </tr>" );

  });
  credittotal=parseFloat(credittotal).toFixed(2);
  debittotal=parseFloat(debittotal).toFixed(2);
  prft=credittotal-debittotal;
 
 
  $(".estimateledger").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td colspan='4' > Total: </td><td style='text-align: right;'>"+credittotal+"</td><td style='text-align: right;'>"+debittotal+"</td></tr>"); 
  
  $(".estimateledger").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td colspan='5' > Profit: </td><td style='text-align: right;'>"+prft+"</td></tr>"); 
  

    var slno=0;
    var credittotal=0;
    var debittotal=0;
    $(".ledger").html("");
    $.each(result["jobledger"], function(index, value){

      slno=slno+1;
        var date=value.Dates;
        var type=value.types;
        var description=value.Descriptions;
        var credit=parseFloat(value.Debit).toFixed(2);
        var debit=parseFloat(value.Credit).toFixed(2);
        credittotal=parseFloat(credittotal)+parseFloat(credit);
        debittotal=parseFloat(debittotal)+parseFloat(debit);
        $(".ledger").append( "<tr class='tbl_row'><td class='sl'>"+slno+" </td> <td class='date'>"+date+"</td> <td class='type'>"+type+"</td> <td class='description'>"+description+"</td> <td class='credit' style='text-align: right;'>"+credit+"</td> <td class='debit' style='text-align: right;'>"+debit+"</td>  </tr>" );

    });
    credittotal=parseFloat(credittotal).toFixed(2);
    debittotal=parseFloat(debittotal).toFixed(2);


    $(".ledger").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td colspan='4' > Total: </td><td style='text-align: right;'>"+credittotal+"</td><td style='text-align: right;'>"+debittotal+"</td></tr>"); 
    $("#invtotal").text(Invsum);
   $("#expensetotal").text(Expense);
  //  var invpaid=Invsum-Expense;
  //  invoicepaid=parseFloat(invpaid);
 var invpaid=result["invoicepaid"][0].sumvalue;

  $("#invpaid").text(invpaid);
  var amountdue=Invsum-invpaid;
  amountdue=parseFloat(amountdue);
  amountdues =  amountdue.toFixed(2);
  // alert(amountdues);
  $("#amountdue").text(amountdues);
});

request.fail( function ( jqXHR, textStatus) {
      
  // console.log("failed");

    });



 }
   

//to edit invoice using invoicenumber
function editinvoice(inv)
{
  var inv= inv;   
  window.location = 'edit-job-invoice/' + inv;
}
//to edit supplier expense m
function editexpense(masterid)
{
  var ID= masterid;   
  window.location = 'edit-supplier-expense/' + ID;
}
//to create new job invoice
function createnewinvoice()
{
  // var jobid = $('#q').val();
  if(job_id!=0){
  window.location = 'job-invoice/' + job_id;
}
else{
  swallokalert('Please Search Job or Please complete job creation!!','#');
  //alert("Please Search Job");
}
}

function createcreditnote()
{
  // var jobid = $('#q').val();
  // if(jobid){
    // window.location = 'credit-note/' + jobid;

  // }
  if(job_id!=0){
    window.location = 'credit-note/' + job_id;
  }
  else{
    swallokalert('Please Search Job!!','#');
    //alert("Please Search Job");
  }
 
}
function createpaymentreceipt()
{
  var clientid = $('#client_id').text();
  if(clientid){
  window.location = 'payment-receipt/' + clientid;
  }
  else{
    swallokalert('Please Search Job!!','#');
    //alert("Please Search Job");
  }
 
}
function createexpense()
{
 
  if(job_id!=0){
    window.location = 'supplier-expense/' + job_id;
  }
  else{
    swallokalert('Please Search Job!!','#');
  }
 
}
function createdebitnote()
{
  
  if(job_id!=0){
    window.location = 'debit-note/' + job_id;
  }
   else{
    swallokalert('Please Search Job!!','#');
  }
 
}

function get_url_extension( url ) {
  return url.split(/[#?]/)[0].split('.').pop().trim();
}

