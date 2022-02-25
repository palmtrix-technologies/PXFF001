window.alert = function() {};
function datepickerinit()
{
 
    $("#mytable1").DataTable({
                 "paging": false,
                 "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
             dom: "Bfrtip",
             buttons: [
               {
                 extend: "copy",
                 className: "btn-sm"
               },
               {
                   extend: 'colvis',
                   collectionLayout: 'fixed two-column'
               },
               {
                 extend: "csv",
                 className: "btn-sm"
               },
               {
                 extend: "excel",
                 className: "btn-sm"
               },
               {
                 extend: "print",
                 className: "btn-sm",
                 tittle:'',
                   exportOptions: {
                 columns: ':visible'
                   },
                   customize: function (win) {
                       $(win.document.body)
                           .css('font-size', '10pt')
                           .prepend(
                               '<img src="header.png" style="width:100%;" />'
                           );

                       $(win.document.body).find('table')
                           .addClass('compact')
                           .css('font-size', 'inherit');
                   }
               },
             ],
             responsive: true
           });
  
}

function datatable_excel()
{
  $("#mytables").DataTable({
    "paging": false,
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
dom: "Bfrtip",
buttons: [

  {
    extend: "excel",
    className: "btn-sm"
  },

],
responsive: true
});

}
function createinvoice()
{
  var jobid= $("#jobid").val();   
  window.location = 'job-invoice/' + jobid;
}
//job report modewise
function get_jobreport_modewise()
{
  mode=$('#mode').val();

  fromdate=$('#fromdate').val();
  todate=$('#todate').val();
   
    var postData={
      mode:mode,
      fromdate:fromdate,
      todate:todate
    }

    var request = $.ajax({
        url: 'job-report-data-modewise/',
        type: 'POST',
        data: {postData:postData} ,
        dataType: 'JSON'
        });
        request.done( function (result) {
        var values=JSON.stringify(result);
        $(".jobrepoprtmodewise").html("");
     
      
$.each(result["jobrepoprtmodewise"],function(index,value) {
    date=value.Date;
    code=value.Number
      shipper=value.Shipper;

  consignee=value.Consignee;
  clientname=value.client_name;
  shipmenttype=value.shipment_type;
  shipmentterms=value.ShipmentTerms;
  mode=value.Type;

  cargodesc=value.CargoDescription;

  status=value.Status;

    $(".jobrepoprtmodewise").append( "<tr class='tbl_row'>  <td class='code'>"+code+"</td><td class='date'>"+date+"</td> <td class='shipper'>"+shipper+"</td>  <td class='consignee'>"+consignee+"</td><td class='clientname'>"+clientname+"</td><td class='shipmenttype'>"+shipmenttype+"</td> <td class='shipmentterms'>"+shipmentterms+"</td><td class='mode'>"+mode+"</td><td class='cargodesc'>"+cargodesc+"</td><td class='status'>"+status+"</td> </tr>" );
});
// datepickerinit();
        request.fail( function ( jqXHR, textStatus) {
      
          alert(0);
           
              });
        
});
}
//sales report
function get_salesreport()
{
  
  fromdate=$('#fromdate').val();
  todate=$('#todate').val();
   
    var postData={
      fromdate:fromdate,
      todate:todate
    }

    var request = $.ajax({
        url: 'sales-report-data/',
        type: 'POST',
        data: {postData:postData} ,
        dataType: 'JSON'
        });
        request.done( function (result) {
        var values=JSON.stringify(result);
        
        $(".salesreport").html("");
     
        var total=0;
$.each(result["salesreportdata"],function(index,value) {

    date=value.Date;
    mode=value.InvoiceType;
  invoice=value.Inv
  job=value.JobId;
  customer=value.name;
  subtotal=value.Total;
  vattotal=value.VatTotal;
  grandtotal=parseFloat(value.GrandTotal).toFixed(2);
  status=value.Status;
  total=parseFloat(total)+parseFloat(grandtotal);
    $(".salesreport").append( "<tr class='tbl_row'> <td class='invoice'>"+invoice+"</td> <td class='date'>"+date+"</td> <td class='mode'>"+mode+"</td><td class='job'>"+job+"</td>  <td class='customer'>"+customer+"</td><td class='subtotal'>"+subtotal+"</td><td class='vattotal'>"+vattotal+"</td> <td class='grandtotal'>"+grandtotal+"</td><td class='status'>"+status+"</td> </tr>" );
});
total=parseFloat(total).toFixed(2);
$(".salesreport").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td> Total  </td><td></td><td></td><td></td><td></td><td></td><td></td><td>"+total+"</td><td></td></tr>"); 
datepickerinit();
      
       
        
});
request.fail( function ( jqXHR, textStatus) {
      
  alert(0);
   
      });
      
}
function get_salesreport_clientwise()
{
  client_id=$('#client').val();

  fromdate=$('#fromdate').val();
  todate=$('#todate').val();
   
    var postData={
      id:client_id,
      fromdate:fromdate,
      todate:todate
    }

    var request = $.ajax({
        url: 'sales-report-data-clientwise/',
        type: 'POST',
        data: {postData:postData} ,
        dataType: 'JSON'
        });
        request.done( function (result) {
        var values=JSON.stringify(result);
        $(".salesreportrclientwise").html("");
     
        var total=0;
$.each(result["salesreportdataclientwise"],function(index,value) {
    date=value.Date;
    mode=value.InvoiceType;
  invoice=value.Inv
  job=value.JobId;
  customer=value.name;
  subtotal=value.Total;
  vattotal=value.VatTotal;
  grandtotal=parseFloat(value.GrandTotal).toFixed(2);
  status=value.Status;
  total=parseFloat(total)+parseFloat(grandtotal);
  //  console.log(total);
    $(".salesreportrclientwise").append( "<tr class='tbl_row'> <td class='invoice'>"+invoice+"</td> <td class='date'>"+date+"</td> <td class='mode'>"+mode+"</td><td class='job'>"+job+"</td>  <td class='customer'>"+customer+"</td><td class='subtotal'>"+subtotal+"</td><td class='vattotal'>"+vattotal+"</td> <td class='grandtotal'>"+grandtotal+"</td><td class='status'>"+status+"</td> </tr>" );
});
total=parseFloat(total).toFixed(2);
$(".salesreportrclientwise").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td  > Total  </td><td></td><td></td><td></td><td></td><td></td><td></td><td style='text-align: left;'>"+total+"</td><td></td></tr>"); 
datepickerinit();

// console.log(total)
      
        request.fail( function ( jqXHR, textStatus) {
      
          alert(0);
           
              });
        
});
}
function get_invoicereport()
{
// client_id=$('#client').val();
  fromdate=$('#fromdate').val();
  todate=$('#todate').val();
   
    var postData={
      // id:client_id,
      fromdate:fromdate,
      todate:todate
    }

    var request = $.ajax({
        url: 'invoice-report-data/',
        type: 'POST',
        data: {postData:postData} ,
        dataType: 'JSON'
        });
        request.done( function (result) {
      //  console.log(result);
        var values=JSON.stringify(result);
        $(".invoicereport").html("");
     
        var total=0;
$.each(result["invoicereportdata"],function(index,value) {
    date=value.Date;
    mode=value.InvoiceType;
  invoice=value.Inv
  job=value.JobId;
  customer=value.name;
  subtotal=value.Total;
  vattotal=value.VatTotal;
  grandtotal=parseFloat(value.GrandTotal).toFixed(2);
  status=value.Status;
  total=parseFloat(total)+parseFloat(grandtotal);
  //  console.log(total);
    $(".invoicereport").append( "<tr class='tbl_row'> <td class='invoice'>"+invoice+"</td> <td class='date'>"+date+"</td> <td class='mode'>"+mode+"</td><td class='job'>"+job+"</td>  <td class='customer'>"+customer+"</td><td class='subtotal'>"+subtotal+"</td><td class='vattotal'>"+vattotal+"</td> <td class='grandtotal'>"+grandtotal+"</td><td class='status'>"+status+"</td> </tr>" );
});
total=parseFloat(total).toFixed(2);
$(".invoicereport").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td  > Total  </td><td></td><td></td><td></td><td></td><td></td><td></td><td style='text-align: left;'>"+total+"</td><td></td></tr>"); 


datepickerinit();

// console.log(total)
      
        request.fail( function ( jqXHR, textStatus) {
      
          alert(0);
           
              });
        
});
}
//inv report clientwise

function get_invoicereport_clientwise()
{
client_id=$('#client').val();
  fromdate=$('#fromdate').val();
  todate=$('#todate').val();
   
    var postData={
      id:client_id,
      fromdate:fromdate,
      todate:todate
    }

    var request = $.ajax({
        url: 'invoice-report-data-clientwise/',
        type: 'POST',
        data: {postData:postData} ,
        dataType: 'JSON'
        });
        request.done( function (result) {
      //  console.log(result);
        var values=JSON.stringify(result);
        $(".invoicereport").html("");
     
        var total=0;
$.each(result["invoicereportdata"],function(index,value) {
    date=value.Date;
    mode=value.InvoiceType;
  invoice=value.Inv
  job=value.JobId;
  customer=value.name;
  subtotal=value.Total;
  vattotal=value.VatTotal;
  grandtotal=parseFloat(value.GrandTotal).toFixed(2);
  status=value.Status;
  total=parseFloat(total)+parseFloat(grandtotal);
  //  console.log(total);
    $(".invoicereport").append( "<tr class='tbl_row'> <td class='invoice'>"+invoice+"</td> <td class='date'>"+date+"</td> <td class='mode'>"+mode+"</td><td class='job'>"+job+"</td>  <td class='customer'>"+customer+"</td><td class='subtotal'>"+subtotal+"</td><td class='vattotal'>"+vattotal+"</td> <td class='grandtotal'>"+grandtotal+"</td><td class='status'>"+status+"</td> </tr>" );
});
total=parseFloat(total).toFixed(2);
$(".invoicereport").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td  > Total  </td><td></td><td></td><td></td><td></td><td></td><td></td><td style='text-align: left;'>"+total+"</td><td></td></tr>"); 
datepickerinit();
// console.log(total)
      
        request.fail( function ( jqXHR, textStatus) {
      
          alert(0);
           
              });
        
});
}
function get_bill_report()
{

  // supplier_id=$('#supplier').val();
    from=$('#fromdate').val();
    to=$('#todate').val();
       var postData={
      // id:supplier_id,
    from:from,
    to:to
    }
  //  alert(to);
    var request = $.ajax({
        url: 'bill-report-data/',
        type: 'POST',
        data: {postData:postData} ,
        dataType: 'JSON'
        });
        request.done( function (result) {
      //  console.log(result);
        var values=JSON.stringify(result);
     
        $(".billreports").html("");

        var total=0;
$.each(result["billreportdata"],function(index,value) {
  code=value.PostId;
  date=value.PostingDate;
    mode=value.Mode;
  invoice=value.inv;
  job=value.JobID;
  supplier=value.supplier_name;
  currency=value.Currency;
  description=value.Description;
  amount=value.Amount;
status=value.Status;

  status=value.Status;
  
   
    $(".billreports").append( "<tr class='tbl_row'> <td class='code'>"+code+"</td> <td class='date'>"+date+"</td> <td class='description'>"+description+"</td><td >"+invoice+"</td><td class='job'>"+job+"</td>  <td class='supplier'>"+supplier+"</td><td class='mode'>"+mode+"</td><td class='currency'>"+currency+"</td> <td class='amount'>"+amount+"</td><td class='status'>"+status+"</td>  </tr>" );
});
datepickerinit();
   
        request.fail( function ( jqXHR, textStatus) {
      
          alert(0);
           
              });
        
});
}
function get_bill_report_supplierwise()
{

  supplier_id=$('#supplier').val();
    from=$('#fromdate').val();
    to=$('#todate').val();
       var postData={
      id:supplier_id,
    from:from,
    to:to
    }
  //  alert(to);
    var request = $.ajax({
        url: 'bill-report-data-supplierwise/',
        type: 'POST',
        data: {postData:postData} ,
        dataType: 'JSON'
        });
        request.done( function (result) {
      //  console.log(result);
        var values=JSON.stringify(result);
     
        $(".billreports").html("");

        var total=0;
$.each(result["billreportdata"],function(index,value) {
  code=value.PostId;
  date=value.PostingDate;
    mode=value.Mode;
  invoice=value.inv;
  // ref=value.Reference;
  job=value.JobID;
  supplier=value.supplier_name;
  currency=value.Currency;
  description=value.Description;
  amount=value.Amount;
status=value.Status;
  // grandtotal=parseFloat(value.GrandTotal).toFixed(2);
  status=value.Status;
  // total=parseFloat(total)+parseFloat(grandtotal);
   
    $(".billreports").append( "<tr class='tbl_row'> <td class='code'>"+code+"</td> <td class='date'>"+date+"</td> <td class='description'>"+description+"</td><td >"+invoice+"</td><td class='job'>"+job+"</td>  <td class='supplier'>"+supplier+"</td><td class='mode'>"+mode+"</td><td class='currency'>"+currency+"</td> <td class='amount'>"+amount+"</td><td class='status'>"+status+"</td>  </tr>" );
});
// total=parseFloat(total).toFixed(2);
// $(".invoicereport").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td colspan='8' > Total  </td><td style='text-align: left;'>"+total+"</td></tr>"); 
datepickerinit();


      
        request.fail( function ( jqXHR, textStatus) {
      
          alert(0);
           
              });
        
});
}
//to get pending bills
function get_pendingbill_data()
{

  // supplier_id=$('#supplier').val();
    from=$('#fromdate').val();
    to=$('#todate').val();
       var postData={
      // id:supplier_id,
    from:from,
    to:to
    }
  //  alert(to);
    var request = $.ajax({
        url: 'pending-bill-data/',
        type: 'POST',
        data: {postData:postData} ,
        dataType: 'JSON'
        });
        request.done( function (result) {
      //  console.log(result);
        var values=JSON.stringify(result);
     
        $(".billreports").html("");

        var total=0;
$.each(result["pendingbillreportdata"],function(index,value) {
  code=value.PostId;
  date=value.PostingDate;
    mode=value.Mode;
  invoice=value.INV;
  // ref=value.Reference;
  job=value.JobID;
  supplier=value.supplier_name;
  currency=value.Currency;
  description=value.Description;
  amount=value.GrandTotal;
status=value.Status;
  // grandtotal=parseFloat(value.GrandTotal).toFixed(2);
  status=value.Status;
  // total=parseFloat(total)+parseFloat(grandtotal);
   
    $(".billreports").append( "<tr class='tbl_row'> <td class='code'>"+code+"</td> <td class='date'>"+date+"</td> <td class='description'>"+description+"</td><td >"+invoice+"</td><td class='job'>"+job+"</td>  <td class='supplier'>"+supplier+"</td><td class='mode'>"+mode+"</td><td class='currency'>"+currency+"</td> <td class='amount'>"+amount+"</td><td class='status'>"+status+"</td>  </tr>" );
});
// total=parseFloat(total).toFixed(2);
// $(".invoicereport").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td colspan='8' > Total  </td><td style='text-align: left;'>"+total+"</td></tr>"); 
datepickerinit();


      
        request.fail( function ( jqXHR, textStatus) {
      
          alert(0);
           
              });
        
});
}
function get_pendingbill_data_supplierwiae()
{

  supplier_id=$('#supplier').val();
    from=$('#fromdate').val();
    to=$('#todate').val();
       var postData={
      id:supplier_id,
    from:from,
    to:to
    }
  //  alert(to);
    var request = $.ajax({
        url: 'pending-bill-data-supplierwise/',
        type: 'POST',
        data: {postData:postData} ,
        dataType: 'JSON'
        });
        request.done( function (result) {
      //  console.log(result);
        var values=JSON.stringify(result);
     
        $(".billreports").html("");

        var total=0;
$.each(result["pendingbillreportdata"],function(index,value) {
  code=value.PostId;
  date=value.PostingDate;
    mode=value.Mode;
  invoice=value.INV;
  // ref=value.Reference;
  job=value.JobID;
  supplier=value.supplier_name;
  currency=value.Currency;
  description=value.Description;
  amount=value.GrandTotal;
status=value.Status;
  // grandtotal=parseFloat(value.GrandTotal).toFixed(2);
  status=value.Status;
  // total=parseFloat(total)+parseFloat(grandtotal);
   
    $(".billreports").append( "<tr class='tbl_row'> <td class='code'>"+code+"</td> <td class='date'>"+date+"</td> <td class='description'>"+description+"</td><td >"+invoice+"</td><td class='job'>"+job+"</td>  <td class='supplier'>"+supplier+"</td><td class='mode'>"+mode+"</td><td class='currency'>"+currency+"</td> <td class='amount'>"+amount+"</td><td class='status'>"+status+"</td>  </tr>" );
});
// total=parseFloat(total).toFixed(2);
// $(".invoicereport").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td colspan='8' > Total  </td><td style='text-align: left;'>"+total+"</td></tr>"); 
datepickerinit();


      
        request.fail( function ( jqXHR, textStatus) {
      
          alert(0);
           
              });
        
});
}
//to get pending inv
function pending_invoice_report_data()
{
 
  fromdate=$('#fromdate').val();
  todate=$('#todate').val();
   
    var postData={
    
      fromdate:fromdate,
      todate:todate
    }

    var request = $.ajax({
        url: 'pending-invoice-report-data/',
        type: 'POST',
        data: {postData:postData} ,
        dataType: 'JSON'
        });
        request.done( function (result) {
      //  console.log(result);
        var values=JSON.stringify(result);
     
        $(".pendinginvoicereport").html("");

        var total=0;
$.each(result["pendinginvoicereportdata"],function(index,value) {
    date=value.Date;
    mode=value.InvoiceType;
  invoice=value.Inv
  job=value.JobId;
  customer=value.name;
  subtotal=value.Total;
  vattotal=value.VatTotal;
  grandtotal=parseFloat(value.GrandTotal).toFixed(2);
  status=value.Status;
  total=parseFloat(total)+parseFloat(grandtotal);
  //  console.log(total);
    $(".pendinginvoicereport").append( "<tr class='tbl_row'> <td class='invoice'>"+invoice+"</td> <td class='date'>"+date+"</td> <td class='mode'>"+mode+"</td><td class='job'>"+job+"</td>  <td class='customer'>"+customer+"</td><td class='subtotal'>"+subtotal+"</td><td class='vattotal'>"+vattotal+"</td> <td class='grandtotal'>"+grandtotal+"</td><td class='status'>"+status+"</td>  </tr>" );
});
total=parseFloat(total).toFixed(2);
$(".pendinginvoicereport").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td  > Total  </td><td></td><td></td><td></td><td></td><td></td><td></td><td style='text-align: left;'>"+total+"</td><td></td></tr>"); 
datepickerinit();
// console.log(total)
      
        request.fail( function ( jqXHR, textStatus) {
      
          alert(0);
           
              });
        
});
}
function pending_invoice_report_data_clientwise()
{
  client_id=$('#client').val();
  fromdate=$('#fromdate').val();
  todate=$('#todate').val();
   
    var postData={
      id:client_id,
      fromdate:fromdate,
      todate:todate
    }
//  alert(fromdate);
//  alert(to);
    var request = $.ajax({
        url: 'pending-invoice-report-data-clientwise/',
        type: 'POST',
        data: {postData:postData} ,
        dataType: 'JSON'
        });
        request.done( function (result) {
      //  console.log(result);
        var values=JSON.stringify(result);
     
        $(".pendinginvoicereport").html("");

        var total=0;
$.each(result["pendinginvoicereportdata"],function(index,value) {
    date=value.Date;
    mode=value.InvoiceType;
  invoice=value.Inv
  job=value.JobId;
  customer=value.name;
  subtotal=value.Total;
  vattotal=value.VatTotal;
  grandtotal=parseFloat(value.GrandTotal).toFixed(2);
  status=value.Status;
  total=parseFloat(total)+parseFloat(grandtotal);
  //  console.log(total);
    $(".pendinginvoicereport").append( "<tr class='tbl_row'> <td class='invoice'>"+invoice+"</td> <td class='date'>"+date+"</td> <td class='mode'>"+mode+"</td><td class='job'>"+job+"</td>  <td class='customer'>"+customer+"</td><td class='subtotal'>"+subtotal+"</td><td class='vattotal'>"+vattotal+"</td> <td class='grandtotal'>"+grandtotal+"</td><td class='status'>"+status+"</td>  </tr>" );
});
total=parseFloat(total).toFixed(2);
b$(".pendinginvoicereport").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td  > Total  </td><td></td><td></td><td></td><td></td><td></td><td></td><td style='text-align: left;'>"+total+"</td><td></td></tr>"); 
datepickerinit();
// console.log(total)
      
        request.fail( function ( jqXHR, textStatus) {
      
          alert(0);
           
              });
        
});
}
function get_receiptreport()
{
 
  fromdate=$('#fromdate').val(); alert(fromdate);
  todate=$('#todate').val();
   
    var postData={
    
      fromdate:fromdate,
      todate:todate
    }

    var request = $.ajax({
        url: 'receipt-report-data/',
        type: 'POST',
        data: {postData:postData} ,
        dataType: 'JSON'
        });
        request.done( function (result) {
      //  console.log(result);
        var values=JSON.stringify(result);
     
        $(".receiptreport").html("");

        var total=0;
$.each(result["receiptdata"],function(index,value) {
    date=value.Date;
  code=value.ID;
    mode=value.Mode;
  customer=value.name;
  subtotal=value.SubTotal;
  status=value.Status;
  total=parseFloat(total)+parseFloat(subtotal);
  //  console.log(total);
    $(".receiptreport").append( "<tr class='tbl_row'><td class='date'>"+date+"</td><td class='code'>"+code+"</td> <td class='customer'>"+customer+"</td><td class='mode'>"+mode+"</td>  <td class='status'>"+status+"</td> <td class='subtotal'>"+subtotal+"</td>  </tr>" );
});
total=parseFloat(total).toFixed(2);
$(".receiptreport").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td  > Total  </td><td></td><td></td><td></td><td></td><td >"+total+"</td><td></td></tr>"); 
datepickerinit();
// console.log(total)
      
        request.fail( function ( jqXHR, textStatus) {
      
          alert(0);
           
              });
        
});
}
//receipt report paymode wise
function get_receiptreport_paymodewise()
{
  paymode=$('#mode').val();

  fromdate=$('#fromdate').val();
  todate=$('#todate').val();
   
    var postData={
      paymode:paymode,
      fromdate:fromdate,
      todate:todate
    }

    var request = $.ajax({
        url: 'receipt-report-data-paymodewise/',
        type: 'POST',
        data: {postData:postData} ,
        dataType: 'JSON'
        });
        request.done( function (result) {
      //  console.log(result);
        var values=JSON.stringify(result);
     
        $(".receiptreportpaymodewise").html("");

        var total=0;
$.each(result["receiptdata_paymodewise"],function(index,value) {
    date=value.Date;
  code=value.ID;
    mode=value.Mode;
  customer=value.name;
  subtotal=value.SubTotal;
  status=value.Status;
  total=parseFloat(total)+parseFloat(subtotal);
  //  console.log(total);
    $(".receiptreportpaymodewise").append( "<tr class='tbl_row'><td class='date'>"+date+"</td><td class='code'>"+code+"</td> <td class='customer'>"+customer+"</td><td class='mode'>"+mode+"</td>  <td class='status'>"+status+"</td> <td class='subtotal'>"+subtotal+"</td>  </tr>" );
});
total=parseFloat(total).toFixed(2);
$(".receiptreportpaymodewise").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td  > Total  </td><td></td><td></td><td></td><td></td><td >"+total+"</td></tr>"); 
datepickerinit();

// console.log(total)
      
        request.fail( function ( jqXHR, textStatus) {
      
          alert(0);
           
              });
        
});
}
//payment report

function get_paymentreport()
{
 
  fromdate=$('#fromdate').val();
  todate=$('#todate').val();
   
    var postData={
    
      fromdate:fromdate,
      todate:todate
    }

    var request = $.ajax({
        url: 'paryment-report-data/',
        type: 'POST',
        data: {postData:postData} ,
        dataType: 'JSON'
        });
        request.done( function (result) {
      //  console.log(result);
        var values=JSON.stringify(result);
     
        $(".paymentreport").html("");

        var total=0;
$.each(result["paymentreportdata"],function(index,value) {
  code=value.ID;
 
  date=value.Date;
    mode=value.Mode;
  customer=value.supplier_name;
  subtotal=value.SubTotal;
  status=value.Status;
  total=parseFloat(total)+parseFloat(subtotal);
  //  console.log(total);
    $(".paymentreport").append( "<tr class='tbl_row'><td class='code'>"+code+"</td><td class='date'>"+date+"</td> <td class='customer'>"+customer+"</td><td class='mode'>"+mode+"</td>  <td class='status'>"+status+"</td> <td class='subtotal'>"+subtotal+"</td>  </tr>" );
});
total=parseFloat(total).toFixed(2);
$(".paymentreport").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td > Total  </td><td></td><td></td><td></td><td></td><td >"+total+"</td></tr>"); 
datepickerinit();

// console.log(total)
      
        request.fail( function ( jqXHR, textStatus) {
      
          alert(0);
           
              });
        
});
}

function get_paymentreport_cashwise()
{
 
  fromdate=$('#fromdate').val();
  todate=$('#todate').val();
   
    var postData={
    
      fromdate:fromdate,
      todate:todate
    }

    var request = $.ajax({
        url: 'paryment-report-data-cashwise/',
        type: 'POST',
        data: {postData:postData} ,
        dataType: 'JSON'
        });
        request.done( function (result) {
      //  console.log(result);
        var values=JSON.stringify(result);
     
        $(".paymentreportcashwise").html("");

        var total=0;
$.each(result["paymentreportdatacashwise"],function(index,value) {
  code=value.ID;
 
  date=value.Date;
    mode=value.Mode;
  customer=value.supplier_name;
  subtotal=value.SubTotal;
  status=value.Status;
  total=parseFloat(total)+parseFloat(subtotal);
  //  console.log(total);
    $(".paymentreportcashwise").append( "<tr class='tbl_row'><td class='code'>"+code+"</td><td class='date'>"+date+"</td> <td class='customer'>"+customer+"</td><td class='mode'>"+mode+"</td>  <td class='status'>"+status+"</td> <td class='subtotal'>"+subtotal+"</td>  </tr>" );
});
total=parseFloat(total).toFixed(2);
$(".paymentreportcashwise").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td  > Total  </td><td></td><td></td><td></td><td></td><td >"+total+"</td></tr>"); 
datepickerinit();
// console.log(total)
      
        request.fail( function ( jqXHR, textStatus) {
      
          alert(0);
           
              });
        
});
}

function get_paymentreport_bankwise()
{
  // paymode=$('#mode').val();
  fromdate=$('#fromdate').val();
  todate=$('#todate').val();
   
    var postData={
      // paymode:paymode,
      fromdate:fromdate,
      todate:todate
    }

    var request = $.ajax({
        url: 'paryment-report-data-bankwise/',
        type: 'POST',
        data: {postData:postData} ,
        dataType: 'JSON'
        });
        request.done( function (result) {
      //  console.log(result);
        var values=JSON.stringify(result);
     
        $(".paymentreportbankwise").html("");

        var total=0;
$.each(result["paymentreportdatabankwise"],function(index,value) {
  code=value.ID;
 
  date=value.Date;
    mode=value.Mode;
  customer=value.supplier_name;
  subtotal=value.SubTotal;
  status=value.Status;
  total=parseFloat(total)+parseFloat(subtotal);
  //  console.log(total);
    $(".paymentreportbankwise").append( "<tr class='tbl_row'><td class='code'>"+code+"</td><td class='date'>"+date+"</td> <td class='customer'>"+customer+"</td><td class='mode'>"+mode+"</td>  <td class='status'>"+status+"</td> <td class='subtotal'>"+subtotal+"</td>  </tr>" );
});
total=parseFloat(total).toFixed(2);
$(".paymentreportbankwise").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td colspan='5' > Total  </td><td></td><td></td><td></td><td></td><td >"+total+"</td></tr>"); 
datepickerinit();
// console.log(total)
      
        request.fail( function ( jqXHR, textStatus) {
      
          alert(0);
           
              });
        
});
}
//profit and loss
function profit_loss_data()
{
  fromdate=$('#fromdate').val();
  todate=$('#todate').val();
  $("#datefrom").html(fromdate);
  $("#dateto").html(todate);
    var postData={
      fromdate:fromdate,
      todate:todate
    }

    var request = $.ajax({
        url: 'profit-loss-data/',
        type: 'POST',
        data: {postData:postData} ,
        dataType: 'JSON'
        });
        request.done( function (result) {
       console.log(result);
        var values=JSON.stringify(result);
        $(".vatinreport").html("");
     
        var total=0;
$.each(result["vatinreportdata"],function(index,value) {
    date=value.Date;
    mode=value.InvoiceType;
  invoice=value.Inv
  job=value.JobId;
  customer=value.name;
  subtotal=value.Total;
  vattotal=value.VatTotal;
 grandtotal=value.GrandTotal;
  total=parseFloat(total)+parseFloat(grandtotal);
  //  console.log(total);
    $(".vatinreport").append( "<tr class='tbl_row'> <td class=''>"+invoice+"</td> <td class='date'>"+date+"</td> <td class='mode'>"+mode+"</td><td class='job'>"+job+"</td>  <td class='customer'>"+customer+"</td><td class='subtotal'>"+subtotal+"</td><td class='vattotal'>"+vattotal+"</td> <td>"+grandtotal+"</td></tr>" );
});
total=parseFloat(total).toFixed(2);
$(".vatinreport").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td colspan='7' > Total  Income</td><td style='text-align: left;'>"+total+"</td></tr>"); 
datepickerinit();


$(".vatoutreport").html("");
     
var totalexpns=0;
$.each(result["vatoutreportdata"],function(index,value) {
code=value.PostId;
date=value.PostingDate;
mode=value.Mode;
invoice=value.inv;
job=value.JobID;
supplier=value.supplier_name;
currency=value.Currency;
description=value.Description;
amount=value.Amount;
grand_total=value.GrandTotal;

vattotal=value.VatTotal

totalexpns=parseFloat(totalexpns)+parseFloat(grand_total);
// console.log(totalexpns);
$(".vatoutreport").append( "<tr class='tbl_row'> <td class='code'>"+code+"</td> <td class='date'>"+date+"</td> <td class='description'>"+description+"</td><td >"+invoice+"</td><td class='job'>"+job+"</td>  <td class='supplier'>"+supplier+"</td><td class='mode'>"+mode+"</td><td class='currency'>"+currency+"</td> <td class='amount'>"+amount+"</td><td class='vattotal'>"+vattotal+"</td><td>"+grand_total+"</td>  </tr>" );

});
totalexpns=parseFloat(totalexpns).toFixed(2);
$(".vatoutreport").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td colspan='10' > Total Expense </td><td style='text-align: left;'>"+totalexpns+"</td><td></td></tr>"); 
$(".vatoutreport").append( "<tr class='tbl_row' style='background-color: #e6e6ff; width:100px;'><td colspan='11' > </td><td style='text-align: left;'></td></tr>"); 

if(parseInt(total)>parseInt(totalexpns))
{
    profit=parseFloat(total)-parseFloat(totalexpns);
    profit="Profit: "+parseFloat(profit).toFixed(2);
}
else
{
  // alert("hello");
  profit=parseFloat(intotalexpnsvat)-parseFloat(total);
  profit="Loss: "+parseFloat(profit).toFixed(2);
}

$(".vatoutreport").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td colspan='10' > Profit/Loss</td><td style='text-align: left;'><b style='color:red;'><u>"+profit+"</td><td></td></tr>"); 

// console.log(total)
      
        request.fail( function ( jqXHR, textStatus) {
      
          alert(0);
           
              });
        
});
}
function get_soareport_clientwise() {

    client_id = $('#client').val();


    var postData = {
        id: client_id

    }

    var request = $.ajax({
        url: 'soa-report-data-clientwise',
        type: 'POST',
        data: {
            postData: postData
        },
        dataType: 'JSON'
    });
    request.done(function(result) {

        var values = JSON.stringify(result);

        console.log(result);
$(".clientdetails").html(result["clientdetails"].client);
        //client serch data
        
        var Sum = 0;
        count = 1;
        $(".jobsearchdataview").html("");
        $.each(result["soareportdataclientwise"], function(index, value) {
            // slno=slno+1;

            date = value.Dates;
            Reference = value.ReferenceNo;
            Clientref = value.ClientReference;
            jobno = value.Jobno;
            amount = value.Amount;
            closing = Sum;
            Sum = (parseFloat(Sum) + parseFloat(value.Amount)).toFixed(2);
            $(".jobsearchdataview").append("<tr class='tbl_row'> <td class='SL'>" + count + "</td> <td class='Invoice'>" + Reference + "</td>  <td class='clientref'>" + Clientref + "</td>  <td class='Job'>" + jobno + "</td><td class='date'>" + date + "</td><td>" + amount + "</td><td>" + amount + "</td><td>" + closing + "</td><td>" + Sum + "</td><td>" + value.age + "</td> </tr>");

            count = count + 1;
        });
       
        //  $(".jobsearchdataview").append("<tr class='tbl_row' ><td  colspan='8'>Total</td><td colspan='1'>" + Sum + "</td> <td class='type'></td></tr>");
     
        datepickerinit();
        datatable_excel();
    });

    request.fail(function(jqXHR, textStatus) {
       
        alert(0);

    });


}