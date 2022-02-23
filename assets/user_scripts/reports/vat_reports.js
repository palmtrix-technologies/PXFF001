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
                               '<img src="http://aotlogisticsapp.com/invoicereport/invhead.jpg" style="width:100%;" />'
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
function get_vat_report_total()
{
 var outputvat=0;
var invat=0;
  month=$('#month').val();
  year=$('#year').val();


  
    var postData={
        month:month,
        year:year
     
    }

    var request = $.ajax({
        url: 'vat-report-total-data/',
        type: 'POST',
        data: {postData:postData} ,
        dataType: 'JSON'
        });
        request.done( function (result) {
      //  console.log(result);
       $("#fromdate").html(result.period1);
       $("#todate").html(result.period2);

        var values=JSON.stringify(result);
      
        $(".sales").html("");
     
     
     var  total=0;
     var outvat=0;
$.each(result["vatreporttotal"],function(index,value) {
    
  month=value.month;
  var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
 month= months[month-1];
  standardrated=value.standardrated;

  vattotal=value.vattotal;
  total=parseFloat(total)+parseFloat(standardrated);
  outvat=parseFloat(outvat)+parseFloat(vattotal);

    $(".sales").append( "<tr class='tbl_row'>  <td class='month'>"+month+"</td><td class='standardrated'>"+standardrated+"</td> <td class='vattotal'>"+vattotal+"</td></tr>" );
});
total=parseFloat(total).toFixed(2);
outputvat=parseFloat(outvat).toFixed(2);
$(".sales").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td > Total  </td><td style='text-align: left;'>"+total+"</td><td>"+outputvat+"</td></tr>"); 



//expense data

$(".expense").html("");
     
var  exptotal=0;
var invat=0;
$.each(result["expensedata"],function(index,value) {

    expensemonth=value.expensemonth;
    // console.log(expensemonth);
var monthsexp = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
expensemonth= monthsexp[expensemonth-1];
standardratedexpense=value.standardratedexpense;

inputvat=value.inputvat;
exptotal=parseFloat(exptotal)+parseFloat(standardratedexpense);
invat=parseFloat(invat)+parseFloat(inputvat);

$(".expense").append( "<tr class='tbl_row'>  <td class='expensemonth'>"+expensemonth+"</td><td class='standardratedexpense'>"+standardratedexpense+"</td> <td class='inputvat'>"+inputvat+"</td></tr>" );
});

exptotal=parseFloat(exptotal).toFixed(2);
invat=parseFloat(invat).toFixed(2);
$(".expense").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td  > Total  </td><td style='text-align: left;'>"+exptotal+"</td><td>"+invat+"</td></tr>"); 
$(".expense").append( "<tr class='tbl_row' style='height:50px;'><td  >  </td><td style='text-align: left;'></td><td></td><td></td></tr>"); 

$(".expense").append( "<tr class='tbl_row' ><td style='font-size:15px'; > <b>INPUT VAT </td><td style='text-align: left;'></td><td><b>"+outputvat+"</td>1</tr>"); 
$(".expense").append( "<tr class='tbl_row' ><td  style='font-size:15px';><b> OUTPUT VAT</b>  </td><td style='text-align: left;'></td><td><b>"+invat+"</td>1</tr>"); 
$(".expense").append( "<tr class='tbl_row' style='height:50px;'><td  >  </td><td style='text-align: left;'></td><td></td><td></td></tr>"); 

if(parseInt(outputvat)>parseInt(invat))
{
    vatpayable=parseFloat(outputvat)-parseFloat(invat);
    vatpayable=parseFloat(vatpayable).toFixed(2);
}
else
{
  // alert("hello");
    vatpayable=parseFloat(invat)-parseFloat(outputvat);
    vatpayable=parseFloat(vatpayable).toFixed(2);
}

$(".expense").append( "<tr class='tbl_row' ><td style='font-size:15px'; > <b>VAT PAYABLE/RCEIVABLE FOR THE PERIOD </td><td style='text-align: left;'></td><td><b>"+vatpayable+"</td><td></td></tr>"); 
// $(".expense").append( "<tr class='tbl_row' ><td  style='font-size:15px';><b>PREVOIOUS INPUT/OUTPUT LIABILITY WITH FTA</b>  </td><td style='text-align: left;'></td><td><b></td></tr>"); 
$(".expense").append( "<tr class='tbl_row' style='height:50px;'><td  >  </td><td style='text-align: left;'></td><td></td><td></td></tr>"); 

$(".expense").append( "<tr class='tbl_row' ><td  style='font-size:15px';><b>NET VAT PAYABLE</b>  </td><td style='text-align: left; '></td><td><b style='color:red;'><u>"+vatpayable+"</td><td></td></tr>"); 
      
});

        request.fail( function ( jqXHR, textStatus) {
      
          alert(0);
           
              });
       

}


//vat in report
function get_vatinreport()
{
  fromdate=$('#fromdate').val();
  todate=$('#todate').val();
  jobid=$('#jobid').val();
  
  
   
    var postData={
      fromdate:fromdate,
      todate:todate,
      jobid:jobid
    }

    var request = $.ajax({
        url: 'vatin-report-data/',
        type: 'POST',
        data: {postData:postData} ,
        dataType: 'JSON'
        });
        request.done( function (result) {
      //  console.log(result);
        var values=JSON.stringify(result);
        $(".vatinreport").html("");
        var slno=0;
        var total=0;
$.each(result["vatinreportdata"],function(index,value) {
    date=value.Date;
    slno=slno+1;
    mode=value.InvoiceType;
  invoice=value.I 
  job=value.JobId;
  customer=value.name;
  subtotal=value.Total;
  vattotal=value.VatTotal;
  var vatinperc=((vattotal * 100) / subtotal);
  vatinperc=parseFloat(vatinperc).toFixed(2);
  vatinp=((vatinperc*100) / 100);
  total=parseFloat(total)+parseFloat(vattotal);
  vatinp = value.per;
  //  console.log(total);
    $(".vatinreport").append( "<tr class='tbl_row'> <td class='sl'>"+slno+"</td><td class='invoice'>"+invoice+"</td> <td class='date'>"+date+"</td> <td class='mode'>"+mode+"</td><td class='job'>"+job+"</td>  <td class='customer'>"+customer+"</td><td class='subtotal'>"+subtotal+"</td><td>"+vatinp+"%</td><td class='vattotal'>"+vattotal+"</td> </tr>" );
});
total=parseFloat(total).toFixed(2);
$(".vatinreport").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td > VAT IN Total  </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td style='text-align: left;'>"+total+"</td></tr>"); 
datepickerinit();

// console.log(total)
      
        request.fail( function ( jqXHR, textStatus) {
      
          alert(0);
           
              });
        
});
}
function get_vatoutreport()
{
  fromdate=$('#fromdate').val();
  todate=$('#todate').val();
  jobid=$('#jobid').val();
 var  vattotal=0;
    var postData={
      fromdate:fromdate,
      todate:todate,
      jobid:jobid
    }

    var request = $.ajax({
        url: 'vatout-report-data/',
        type: 'POST',
        data: {postData:postData} ,
        dataType: 'JSON'
        });
        request.done( function (result) {
      //  console.log(result);
        var values=JSON.stringify(result);
        $(".vatoutreport").html("");
     
        var total=0;
$.each(result["vatoutreportdata"],function(index,value) {
    code=value.PostId;
  date=value.PostingDate;
    mode=value.Mode;
  invoice=value.Reference;
  // job=value.JobID;
  job=value.Number;
  supplier=value.supplier_name;
//   currency=value.Currency;
//   description=value.Description;
  amount=value.SubTotal;
 console.log(value);

vattotal=value.VatTotal
var vatperc=((vattotal * 100) / amount);
  // status=value.Status;
vatperc=value.percentage;
vatoutperc=parseFloat(vatperc).toFixed(2);
 vatoutp=((vatoutperc*100) / 100);
  total=parseFloat(total)+parseFloat(vattotal);
  //  console.log(total);
   $(".vatoutreport").append( "<tr class='tbl_row'> <td class='code'>"+code+"</td> <td class='date'>"+date+"</td><td >"+invoice+"</td><td class='job'>"+job+"</td>  <td class='supplier'>"+supplier+"</td><td class='mode'>"+mode+"</td><td class='amount'>"+amount+"</td><td>"+vatperc+"</td><td class='vattotal'>"+vattotal+"</td>  </tr>" );

});
total=parseFloat(total).toFixed(2);
$(".vatoutreport").append( "<tr class='tbl_row' style='background-color: #e6e6ff;'><td> VAT OUT Total  </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td style='text-align: left;'>"+total+"</td></tr>"); 
datepickerinit();

// console.log(total)
      
        request.fail( function ( jqXHR, textStatus) {
      
          alert(0);
           
              });
        
});
}
