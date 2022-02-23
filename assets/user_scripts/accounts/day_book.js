// function finddata()
// {
// //  alert(0);
// postData=$('#from').val();
// postData1=$('#to').val();
// var request = $.ajax({
//   url: 'find-day-book/'+postData+postData1,
//   type: 'GET',
//   dataType: 'JSON'
//   });
//   request.done( function ( data ) {
//     console.log(data);
//     // alert(0);
// //   $("#listvalue").html("");
  
// //   $.each(data, function(index, value,data){
// //     $("#listvalue").append('<tr><td>'+value.GroupName+'</td></tr>');
// // });
 
//   });

   

// }
function finddata()
{

    var from = $('#from').val();
    var to = $('#to').val();
  var request = $.ajax({
  url: 'find-day-book',
  type: 'POST',
  data: ({from: from, to:to}),
  dataType: 'JSON'
  });
  request.done( function ( data ) {
 console.log(data)
  });
  
}
