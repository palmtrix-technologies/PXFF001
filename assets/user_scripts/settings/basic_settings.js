




function update_settings() {
    
    var iconimg= $('#imageval').val();
    var headerfilename= $('#headerimage').val();
    var footerfilename= $('#footerimage').val();
    alert(headerfilename);
    // var JobData = {
                
    //     "Inv": $('#inv_code').val(),
    //     "Date":$('#date').val(),
    //     "JobId":$('#job_id').val(),
    //     "Bank":$('#bank').val(),
    //     "InvoiceType":$('#type').val(),
    //     "ReceiptNo":$('#receipt_no').val(),
    //     "ReceiptDescription":$('#adv_desc').val(),
    //     "Amount":$('#amount').val(),
    //     "Status":"Drafted",
    //     "Active":"active",
    //     "Total":$('#total').val(),
    //     "VatTotal":$('#vat_total').val(),
    //     "GrandTotal":$('#grand_total').val()
    //   };
    //     var JobDetails = [];
    //     var JobDetails_bc=0;
    //             $(".tbl_row").each(function () {
    //               JobDetails_bc=1;
    //                 var Data = {
    //                   "Description":$(this).find('.job_desc').text(),
    //                     "UnitPrice": $(this).find('.job_price').text(),
    //                     "Currency": $(this).find('.currency').val(),
    //                     "ConvFactor": $(this).find('.cov_factor').val(),
    //                      "Quantity":$(this).find('.job_quantity').text(),
    //                      "Vat": parseFloat($(this).find('.taxval_data').text()),
    //                      "Total": parseFloat($(this).find('.totalval_data').text())
                        
    //                 };
    //                 JobDetails.push(Data);
    //                // console.log(JobDetails);
    //             });
    //        var  inv_code=$('#inv_code').val(); 
    
    //        if(JobDetails_bc==0)
    //        {
    //         var JobDetails ="";
    //        }
    //        if(deletedidarray.length == 0)
    //        {
    //         deletedidarray="";
    //        }
           
    
    //   var postData = {
    //     JobDetails: JobDetails,
    //     JobData: JobData,
    //     Id:inv_code,
    //     deleted:deletedidarray
    //       };
    //       console.log(postData);
    //       var request = $.ajax({
    //         url: '../update-job-details',
    //         type: 'POST',
    //         data: {postData:postData} ,
    //         dataType: 'JSON'
    //         });
          request.done( function ( data ) {
              alert("Job Invoice Updated");
         window.location.href='../edit-job-invoice/'+inv_code
    
          });
          request.fail( function ( jqXHR, textStatus) {
          //   console.log(jqXHR)
          // alert(0);
          // window.location.href='../edit-job-invoice/'+inv_code
            });
      
          }