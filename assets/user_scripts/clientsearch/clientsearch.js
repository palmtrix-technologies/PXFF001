function get_client_data()
{

    client_id=$('#client_id').val();
    from=$('#fromdate').val();
    to=$('#todate').val();
   
    var postData={
    id:client_id,
    from:from,
    to:to
    }
  // alert(from);
  //  alert(to);
    var request = $.ajax({
        url: 'client-data/',
        type: 'POST',
        data: {postData:postData} ,
        dataType: 'JSON'
        });
        request.done( function (result) {
       
        var values=JSON.stringify(result);
     
        // $("#suppliername").text(result["clientserchdata"][0].supplier_name);
        // console.log(result["clientserchdata"][0].supplier_name );


       //client serch data
// var slno=0;
var creditsum=0;
var debitsum=0;
$(".jobsearchdataview").html("");
$.each(result["clientserchdata"],function(index,value) {
    // slno=slno+1;
    date=value.Dates;
    particulars=value.particulars;
  invoice=value.invoice
  voucher=value.vouchertypes;
  credit=value.Credit;
  debit=value.Debit;

 
creditsum=(parseFloat(creditsum)+parseFloat(value.Credit)).toFixed(2);
debitsum=(parseFloat(debitsum)+parseFloat(value.Debit)).toFixed(2);
     console.log(voucher);
    $(".jobsearchdataview").append( "<tr class='tbl_row'> <td class='date'>"+date+"</td> <td class='type'>"+particulars+"</td> <td class='inv'>"+invoice+"</td><td class='voucher'>"+voucher+"</td>  <td class='credit'>"+credit+"</td><td class='debit'>"+debit+"</td> </tr>" );
});

$(".jobsearchdataview").append( "<tr class='tbl_row' ><td  colspan='4'>Total</td> <td class='type'>"+creditsum+"</td> <td class='type'>"+debitsum+"</td></tr>" );
var   balance=0;
if(creditsum>debitsum)
{
balance=creditsum-debitsum;
$(".jobsearchdataview").append( "<tr class='tbl_row' ><td  colspan='4'>Balance</td> <td>"+balance+"</td> <td class='type'>0</td></tr>" );
}
else{
balance=(debitsum-creditsum).toFixed(2);
$(".jobsearchdataview").append( "<tr class='tbl_row' ><td  colspan='4'>Balance</td> <td>0</td> <td class='type'>"+balance+"</td></tr>" );
}

        request.fail( function ( jqXHR, textStatus) {
            //   console.log(jqXHR)
          alert(0);
           
              });
        
});
}
