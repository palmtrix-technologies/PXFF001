function getdata()
{
 // alert(0);
postData=$('#desc_code').val();
var request = $.ajax({
  url: 'transportation-description/'+postData,
  type: 'GET',
  dataType: 'JSON'
  });
  request.done( function (result) {
    console.log(result);
  var values=JSON.stringify(result);
  $("#description_job").val(result[0].description);
console.log(result[0].description);
  });

}
function view_data()
    {
  desc=$('#description_job').val();
  unitprice=$('#unitprice').val();
  quantity=$('#quantity').val();
  vat=$('#vat').val();
  unit=$('#unit').val();

   $('#desc').append= desc;
 
 
 
  // console.log(desc);   
  // console.log(unitprice);   
  // console.log(quantity);   
  // console.log(vat);   
  // console.log(unit);   
    }