
    //add type
    function add($type,$shipment_type)
    {

      var now = moment().format('YYYY-MM-DD h:mm:ss a');
      if( $('#id').val()=="")
      {
      postData = {
            "type":$type,
            "shipment_type":$shipment_type,
            "Status":"OPEN",
            
            "Number":$("#id").val()
      };
      var request = $.ajax({
      url: 'transportation-store',
      type: 'POST',
      data: {postData:postData} ,
      dataType: 'JSON'
      });
      request.done( function ( data ) {
 //console.log("vbhnv");
  $('#id').val(data);
  $("#type").val($type);
  //console.log(postData); 
  return postData;
      });
      }
  
    }
  //  update
    function update()
    {
   
//       var shpr= $('#consignor_id').val();
//       var csgn=  $('#shipperid').val();
//  alert(shpr);
    
//  alert(csgn);
     var typevqal=$("#type").val();
    // alert( $('#id').val());
    // alert(typevqal);
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
        var truck=$("#truck").val();
        var PoNo=$("#PoNo_land").val(); 
        var Nopcs=$("#Nopcs_land").val(); 
        // var Mawb=$("#Mawb_land").val()+'-'+$("#Mawbland_code").val();
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
        "consignor_id": $('#shipperid').val(),
        "consignee_id": $('#consignor_id').val(),
        "NoContainers": $('#NoContainers').val(),
        "client_id": $('#client_name').find('option:selected').attr('id')

  };

      var postData = {
       postData1: Data,
        id: $('#id').val(),
        Shippername:$('#shippername').val(),
        consignorname:$('#consigneename').val(),

    };
    console.log(Data);
      var request = $.ajax({
      url: 'transportation-update',
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
//  function getdata()
// {
 
// postData=$('#desc_code').val();
// var request = $.ajax({
//   url: 'transportation-description/'+postData,
//   type: 'GET',
//   dataType: 'JSON'
//   });
//   request.done( function (result) {
//     console.log(result);
//   var values=JSON.stringify(result);
//   $("#description_job").val(result[0].description);
// console.log(result[0].description);
//   });

// }



//view job details
function jobdetails()
{
 
postData=$('#id').val();
var request = $.ajax({
  url: 'transportation-jobdetails/'+postData,
  type: 'GET',
  dataType: 'JSON'
  });
  request.done( function (result) {
    console.log(result);
  var values=JSON.stringify(result);
  $("#job_code").html(result[0].Number);
  $("#shipper_name,#shippername").html(result[0].Shipper);
  $("#consignee_name,#consigneename").html(result[0].Consignee);
  $("#company_name,#clientname").html(result[0].client_name);
  $("#shpmnt_terms,#shipterm").html(result[0].ShipmentTerms);
  $("#servicetype").html(result[0].Type);
  $("#bayanno,#bayannosumm").html(result[0].BayanNo);
  $("#bayandate").html(result[0].BayanDate);
  $("#statuss").html(result[0].Status);
  $("#consign_desc").html(result[0].Destination);
  $("#consign_date").html(result[0].Date);
  $("#containernum").html(result[0].ContainerNo);
  $("#numcontainer").html(result[0].NoContainers);
  $("#truckno,#trucknoland,#trucknoother").html(result[0].TruckNo);
  $("#nopcssea,#nopcsother,#nopcsland,#nopcsair").html(result[0].Nopcs);
  $("#originother,#originland,#originsea,#originair").html(result[0].Origin);
  $("#desctinationdest,#desctinationother,#desctinationsea,#desctinationair").html(result[0].Destination);
  $("#mawbsea,#mawbair,#mawbland,#mawbother").html(result[0].Mawb);
  $("#containernum").html(result[0].ContainerNo);
  $("#etdair,#etdsea,#etdland,#etdother").html(result[0].Etd);
  $("#etaair,#etasea,#etaland,#etaother").html(result[0].Eta);
  $("#carriersea,#carrierair").html(result[0].Carrier)
  $("#hawbsea,#hawbair").html(result[0].Hawb);
  $("#ponoair,#ponoland,#ponoother").html(result[0].PoNo);
  $("#actualsea,#actualair,#actualland,#actualother").html(result[0].ActualWeight);
  $("#chargeablesea,#chargeableair,#chargeableland,#chargeableother").html(result[0].ChargeableWeight);
  // $("#shipterm").html(result[0].ShipmentTerms);
  $("#doc_type").html(result[0].NoContainers);
  $("#descriptiondata,#consign_desc").html(result[0].Description);
// console.log(result[0].JobId);
console.log(result[0].Type);
console.log(result[0].BayanNo);
console.log(result[0].Destination);
console.log(result[0].Origin);
console.log(result[0].Nopcs);
  });

}

//add estimate
function add_estimate()
{
  
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
  $('.estmt_details').each(function()
  {
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
  });
  var postData = {
   
    estimate_master: estimate_master,
     estimate_master_details: estimate_master_details
      };
  var request = $.ajax({
    url: 'transportation-estimate',
    type: 'POST',
    data: {postData:postData} ,
    dataType: 'JSON'
    });
    request.done( function ( data) {
      console.log(data);
     // window.location.href='estimate-print/'+data
      swallokalert('Estimate Created Successfully!!','estimate-print/'+data);
    // if(!alert('estimate Created Successfully!')){window.location.href=""}
    });
    request.fail( function ( jqXHR, textStatus) {
     swallokalert('estimate Creation failed!!','#');
      // alert('estimate Created Successfully');
      // window.location.reload();
      if (jqXHR.responseText=="success")
      {
      //  swallokalert('estimate Created Successfully!!','#');
      //  if(!alert('estimate3 created Successfully!')){window.location.href=""}
   
      }
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
$(document).ready(function()
{
  $( "#Carrier_air_imp" ).change(function() {
    var element1 = $(this).find('option:selected'); 
    var myTag1 = element1.attr("code"); 
    $("#Mawb_air").val(myTag1);
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
// $(document).ready(function()
// {
// $( "#Carrier_land" ).change(function() {
//   var element = $(this).find('option:selected'); 
//   var myTag = element.attr("code"); 
//   $("#Mawb_land").val(myTag);
//   console.log($(this).attr("code"));
// });
// });