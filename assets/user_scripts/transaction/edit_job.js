
 var deletedidarray=[];
  
 //  update
   function update()
   {
 
 var typevqal=$("#type").val();
   // alert( $('#id').val());
   //alert("ivdethiii");
   if(typevqal=="airexport"||typevqal=="airimport")
   {
     var etd=$("#etd_air").val();  
     var eta=$("#eta_air").val();  
     var Origin=$("#origin_air").val();
     var Destination=$("#destination_air").val();
     var carrier=$("#Carrier_air").val();
     var PoNo=$("#PoNo_air").val();
     var Mawb=$("#Mawb_air").val()+'-'+$("#Mawb_code").val();
     var Nopcs=$("#Nopcs_air").val();
     var ActualWeight=$("#ActualWeight_air").val();
     var ChargeableWeight=$("#ChargeableWeight_air").val();
     var shipterm=$("#incoterms").val();
   
  }
   else if(typevqal=="fclexport"||typevqal=="fclimport"||typevqal=="lclexport"||typevqal=="lclimport")
   {
     var etd=$("#etd_sea").val();
     var eta=$("#eta_sea").val(); 
     var carrier=$("#Carrier_sea").val();
     var PoNo=$("#PoNo_sea").val(); 
     var Mbl=$("#Mbl_sea").val(); 
     var ActualWeight=$("#ActualWeight_sea").val();
     var shipterm=$("#incotermssea").val();

    
   }
   else if(typevqal=="transportation")
   {
     var etd=$("#etd_transport").val();
     var eta=$("#eta_transport").val();
     var Origin=$("#Origin_transport").val();
     var Destination=$("#Destination_transport").val(); 
     var carrier=$("#Carrier_transport").val(); 
     var PoNo=$("#PoNo_transport").val();
     var Mbl=$("#Mbl_transport").val(); 
     var Nopcs=$("#Nopcs_transport").val(); 
     var ActualWeight=$("#ActualWeight_transport").val();
    
   }
   else if(typevqal=="landexport"||typevqal=="landimport")
   {
     var etd=$("#etd_land").val();
     var eta=$("#eta_land").val();
     var Origin=$("#Origin_land").val();
     var Destination=$("#Destination_land").val(); 
     var carrier=$("#Carrier_land").val();
     var PoNo=$("#PoNo_land").val(); 
     var Nopcs=$("#Nopcs_land").val(); 
    //  var Mawb=$("#Mawb_land").val()+'-'+$("#Mawbland_code").val();
     var ChargeableWeight=$("#ChargeableWeight_land").val();
   
   }


   var now = moment().format('YYYY-MM-DD h:mm:ss a');
   Data = {
     "Number":$('#code').val(),
     "Date": $('#date').val(),
     "Shipper": $('#shippername').val(),
     "Consignee": $('#consigneename').val(),
     "client_name": $('#client_name').val(),
     "shipment_type": $('#shipment_type').val(),
 
     "ShipmentTerms":shipterm,
     "CargoDescription": $('#cargo_description').val(),
     "Origin":Origin,
     "Destination": Destination,        
     "Etd":etd,
     "Eta":eta,
     "Carrier":carrier,
     "PoNo":PoNo,
     "Mawb":Mawb,
     "Hawb": $('#Hawb').val(),
     "Nopcs": Nopcs,
     "ActualWeight": ActualWeight,
     "ChargeableWeight": ChargeableWeight,
     "Dimension": $('#Dimension').val(),
     "Pol": $('#Pol').val(),
     "Pod": $('#Pod').val(),
     "Mbl": Mbl,
     "Hbl": $('#Hbl').val(),
     "ContType": $('#ContType').val(),
     "NoContainers": $('#NoContainers').val(),
     "ContainerNo": $('#ContainerNo').val(),
     "TruckNo": $('#TruckNo').val(),
     "BayanNo": $('#BayanNo').val(),
     "BayanDate": $('#BayanDate').val(),
     "Status": $('#Status').val(),
     "JobStatus": $('#JobStatus').val(),
     "LabUndertaking": $('#LabUndertaking').val(),
     "DocsGuarantee": $('#DocsGuarantee').val(),
     "Description": $('#Description').val(),
     "PoP": $('#PoP').val(),
     "salesman": $('#salesman').val(),
     "consignor_id": $('#consignor_id').val(),
     "consignee_id": $('#shipperid').val(),
     "client_id": $('#client_name').find('option:selected').attr('id')

};

     var postData = {
      postData1: Data,
       id: $('#id').val(),
         Shippername:$('#shippername').val(),
        consignorname:$('#consigneename').val(),
 
   };
   console.log(postData);
     var request = $.ajax({
     url: '../transportation-update',
     type: 'POST',
     data: {postData:postData} ,
     dataType: 'JSON'
     });
     request.done( function ( data ) {
    
       Changepanel();
       $('#step-3').css( 'display', 'block' );
       $('.vzbtn3').addClass("btn-success");
     });
     request.fail( function ( jqXHR, textStatus) {
   
       Changepanel();
       $('#step-3').removeClass("hidden");
       $('.vzbtn3').addClass("btn-success");
     });

  }
//get description
function getdatadesc()
{

postData=$('#desc_code').val();
var request = $.ajax({
 url: '../transportation-description/'+postData,
 type: 'GET',
 dataType: 'JSON'
 });
 request.done( function (result) {
   console.log(result);
 var values=JSON.stringify(result);
 $("#description_job").val(result[0].description);
// console.log(result[0].description);
 });

}

//update estimate
function update_estimate()
{
//  alert("ivdethi");
 var id=$("#id").val();  
 
 var today = new Date();
 var dd = String(today.getDate()).padStart(2, '0');
 var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
 var yyyy = today.getFullYear();
 
 today = yyyy + '/' + mm + '/' + dd;
 // alert(today);
   estimate_master= {
 "estimate_no": $('#estimate_code').val(),
 "e_date":today,
 "job_id":id ,
 "total_amount": $('#total').val(),
 "tax_amount": $('#vat_total').val(),
 "grand_total": $('#grand_total').val(),
 "status": "drafted",
 "IsActive":1
};

console.log(estimate_master);

var estimate_master_details =[];
var estimateDetails_bc=0;
 $('.estmt_details').each(function()
 {
   estimateDetails_bc=1;
   var Data = {
     "description":$(this).find('.desc').text(),
       "unitprice": $(this).find('.price_val').text(),
       "unit_type": $(this).find('.unittype').text(),
       "subtotal":  $(this).find('.subtotalval_data').text(),
       "conv_factor": $(this).find('.convfact').text(),
        "quantity":$(this).find('.quanty').text(),
        "vat": parseFloat($(this).find('.taxval_data').text()),
        "total": parseFloat($(this).find('.totalval_data').text())
   };

   estimate_master_details.push(Data);
   console.log("estimate_master_details");

   console.log(estimate_master_details); 
           });
  
           var  estimate_code=$('#master_id').val(); 
           var  dat=$('#dat').val(); 

           

           if(estimateDetails_bc==0)
           {
            var estimate_master_details ="";
           }
           if(deletedidarray.length == 0)
           {
            deletedidarray="";
           }
    
 
 var postData = {
  
   estimate_master: estimate_master,
    estimate_master_details: estimate_master_details,
    Id:estimate_code,
    Dat:dat,
    deleted:deletedidarray
     };
 var request = $.ajax({
   url: '../update-estimate',
   type: 'POST',
   data: {postData:postData} ,
   dataType: 'JSON'
   });
   request.done( function ( data ) {
     swallokalert('Estimate updated Successfully!','../estimate-print/'+data);
  // if(!alert('estimate updated Successfully!')){
    // location.reload()}
   });
   request.fail( function ( jqXHR, textStatus) {
     swallokalert('Estimate UpdationFailed!','#');
   //  alert('estimate updated Successfully');
   //  location.reload();
    //  if (jqXHR.responseText=="success")
    //  {
    //    swallokalert('estimate updated Successfully!','edit-job');
    //   //if(!alert('estimate3 updated Successfully!')){window.location.href=""}
  
    //  }
   });
}

//onchange carrier and mawb
$(document).ready(function()
{
 $( "#Carrier_air" ).change(function() {
   var element = $(this).find('option:selected'); 
   var myTag = element.attr("code"); 
   $("#Mawb_air").val(myTag);
   console.log($(this).attr("code"));
 });
});


function Changepanel()
{
 $('#step-1').css( 'display', 'none' );
 $('#step-2').css( 'display', 'none' );
 $('#step-3').css( 'display', 'none' );
 $('.vzbtn1').removeClass("btn-success");
 $('.vzbtn2').removeClass("btn-success");
 $('.vzbtn3').removeClass("btn-success");
}
function deletedids(id,el)
 {
   deletedidarray.push(id);
   console.log(id);
   console.log(deletedidarray);
   $(el).closest("tr").remove();
   calculates();
 return false;
 }
//  $(document).ready(function()
// {
// $( "#Carrier_land" ).change(function() {
//  var element = $(this).find('option:selected'); 
//  var myTag = element.attr("code"); 
//  $("#Mawb_land").val(myTag);
//  console.log($(this).attr("code"));
// });
// });
$( "#edit_btn_doc" ).click(function() {
  
  var type = $('#doc_type').val();
var fileupload = $('#fileupld').val();

if(type !=="" && fileupload !==""){
$("#edit_job_doc").submit();
}else{
 alert("Please Fill document type");
}
});

function get_url_extension( url ) {
  return url.split(/[#?]/)[0].split('.').pop().trim();
}