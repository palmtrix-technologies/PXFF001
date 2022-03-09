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
                               '<img src="http://accounts.servyxappz.com/assets/images/1642766108headerimage.png" style="width:100%;" />'
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
        url: 'genaralexpense-report-data/',
        type: 'POST',
        data: {postData:postData} ,
        dataType: 'JSON'
        });
        request.done( function (result) {
      //  console.log(result);
        var values=JSON.stringify(result);
     
        $(".billreports").html("");

        var total=0;
$.each(result["genaral_expense"],function(index,value) {
    
   
    $(".billreports").append( "<tr class='tbl_row'> <td class='code'>"+value.acc_expense_id+"</td> <td class='date'>"+value.expense_date+"</td> <td class='description'>"+value.expensehead+"</td><td >"+value.expense_category+"</td><td class='job'>"+value.ref_number+"</td>  <td class='supplier'>"+value.paymentdecription+"</td><td class='subamnt'>"+value.subtotal+"</td><td class='vatamount'>"+value.tax_total+"</td> <td class='amount'>"+value.total_amount+"</td> </tr>" );
});
datepickerinit();
   
        request.fail( function ( jqXHR, textStatus) {
      
          alert(0);
           
              });
        
});
}

function get_bill_report_detailed()
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
        url: 'genaralexpense-report-data-detail/',
        type: 'POST',
        data: {postData:postData} ,
        dataType: 'JSON'
        });
        request.done( function (result) {
      //  console.log(result);
        var values=JSON.stringify(result);
     
        $(".billreports").html("");

        var total=0;
$.each(result["genaral_expense"],function(index,value) {
    
   
    $(".billreports").append( "<tr class='tbl_row'> <td class='code'>"+value.acc_expense_id+"</td> <td class='date'>"+value.expense_date+"</td> <td class='description'>"+value.expensehead+"</td><td >"+value.expense_category+"</td><td class='job'>"+value.ref_number+"</td>  <td class='supplier'>"+value.paymentdecription+"</td><td class='supplier'>"+value.entity+"</td><td class='supplier'>"+value.details+"</td><td class='subamnt'>"+value.sub+"</td><td class='vatamount'>"+value.tax+"</td> <td class='amount'>"+value.total+"</td> </tr>" );
});
 datepickerinit();
   
        request.fail( function ( jqXHR, textStatus) {
      
          alert(0);
           
              });
        
});
}