<?php 
// var_dump($suppliers);
// die();
?>

<style>
    .printviews{
        display:none;
    }
    .filtfoot{
        display:none;
    }
    
    
</style>
<style>
    @media print {

		
       
			@page {
				margin-top: -100px;
				/* this affects the margin in the printer settings */
				margin-bottom: 0;
				  /*transform: scale(.7);*/
			
			}
			
			@page :first {
    
    
            .filtfoot{
                display:none!important;
            }
                }
			
			.printviews{
        display:block;
    }
    
   
.sticky {
  position: fixed;
  top: 0;
  bottom:50px;
  width: 100%
}
     .filtfoot {

        display: block;
        width:100%;        
        position:relative;
        left:0;
        bottom:0;         
    
}
    thead   {display: table-header-group;   }

    .main-footer{
        display:none;
    }

 .bg {
    visibility: visible;
    /* The image used */
    background-image: url("<?php echo base_url(); ?>/assets/images/vd_background.jpg");
    /* Full height */
    height: 100%;
    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    -webkit-print-color-adjust: exact;
   }

		}
		
		.bg {
    visibility: visible;
    /* The image used */
    /* background-image: url("<?php echo base_url(); ?>/assets/images/vd_background.jpg"); */
    /* Full height */
    height: 100%;
    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    -webkit-print-color-adjust: exact;
   }
</style>
<!-- <link href="<?php echo base_url(); ?>/assets/expensereport/style.css" rel="stylesheet" /> -->
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/expensereport/bootstrap.css" />
<section class="content-header">
  <h1>
     SOA REPORT
            </h1>
          
          </section>
          <section  class="content">
          
          <div class="row">
            <div class="col-md-12">
             
                <div class="box-body">
                       <div class="box-header with-border" style="background-color:#ffffff;" id="searchform">
<div class="row">

                <div class="col-md-2 form-group col-md-offset-4">
                <select class="form-control" id="client" name="client"  value="">
                                    <option value="">--Select Client--</option>
                                  
                                  <?php 
                                  foreach($client as $key=>$value)
                                  {
?>
                                 <option value="<?php echo $value->id;?>"><?php echo $value->name;?></option>
                                  <?php
                                  }
                                   ?>
                                 </select>
                </div>
              
                <div class="col-md-1 form-group">
                <input type="button" class="btn btn-success" value="Show" id="show" onclick="get_soareport_clientwise();"/>
                </div>
                <div class="col-md-1 form-group">
                     <button id="btnPrint" style="float: left;" class="btn btn-success" onclick="PrintPage()"><i class="fa fa-print"></i>Print</button>

                </div>
                <div class="col-md-1 form-group">
                <button id="btnpdf" style="float: left;" class="btn btn-success" onclick="Printpdf()"><i class="fa fa-print"></i>Pdf</button>   
            </div>
                               
</div>
                </div>
                  <div class="row" id="pdf">
                      <div class="row">
                          
                <div class="col-md-12 printviews sticky" id="headview">
                       <table style="width: 100%; " class="" >
                        <tr>
                            <td>
                            <!-- <img src="<?php echo base_url(); ?>/assets/images/vd_head.jpg" style="width: 100%;" alt="logo">-->
                        </td> 

                        </tr>
                    </table>
                </div>
                  <div class="col-md-12" style="background-color: white;">
                  
                 
                    <div class="textcenters" style="display: flex; align-items: center; justify-content: center; margin-bottom: 15px; margin-top: 15px;">
                        <h3> OUTSTANDING LETTER </h3>
                    </div>
                  </div>
                  
                  <div class="col-md-12" style="background-color:white;" >
                      
                      <h5 style="    margin-left: 50px;    font-weight: 600;">To </br>
                      <div class="clientdetails" >
                          
                      </div>
                      </br></br>
                  </h5>
                      
                  </div>
                   <div class="col-md-12" style="background-color: white; display:none;" >
                      
                      <h5 style="    margin-left: 50px;    font-weight: 400;">Dear Sir/Madam,<br><br>
Please find here below the details of your outstanding invoices as of today. (<?= date('d/m/Y'); ?>) Requesting you to settle the same at the earliest, your outstanding
past due balance is (SAR <span id="lblTotal"></span>), as details on the statement of outstanding given below.</h5>
                      
                  </div>
       
                  <div class="col-md-12 bg" style="padding-left: 65px;padding-right: 50px;  text-align: center; ">
                     <table class="table table-bordered dtnew" id="mytables" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th class="column-title">#</th>
                                       <th class="column-title">Invoice No </th>
                                    <th class="column-title">Client Reference</th>
                                    <th class="column-title">Job Number</th>
                                    <th class="column-title">Invoice Date</th>
                                    <th class="column-title">Amount</th>
                                    <th class="column-title">Local amount (SAR)</th>
                                    <th class="column-title">Opening</th>
                                    <th class="column-title">Balance</th>
                                     <th class="column-title">Aging</th>
                                </tr>
                            </thead>
                            <tbody class="jobsearchdataview">


                            </tbody>
                        </table>
                  </div>
                  
                  <div class="col-md-12 printviews" id="payment" style="margin-left:80px">
                      <h3>Payment Details</h3>
                      <p>
Bank Name : Saudi British Bank( SABB ) </p>
<p>Account No: 352346167001</p>
<p>Account Name : VISION DISPATCH FOR SHIPPING EST.</p>
<p>Account Name in Arabic : مؤسسة ايفاد الرؤية للشحن </p>
<p>IBAN No:  SA 8245000000352346167001</p>
                  </div>
                  </div>
                   
            
              
                  </div>
                </div>
          
            </div>
          </div>


          </section>
          
          <section class=" filtfoot" id="filtfoot">
               <table style="width: 100%; margin-bottom: -1px; margin-top: 40px; "  >
                        <tr>
                            <td>
                            <!-- <img src="<?php echo base_url(); ?>/assets/images/vd_footer.jpg" style="width: 100%;" alt="logo"> -->
                        </td>

                        </tr>
                    </table>
          </section>
         
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
         <script>
    $(document).ready(function(){
      var date_input=$('input[name="date"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'yyyy-mm-dd',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
     
     

    })
    
    </script>
    
    <script>
        function PrintPage() {

            var table = $('#mytables').DataTable();
     table.destroy();

            //Get the print button and put it into a variable
           
            var printButton = document.getElementById("btnPrint");
            var backButton = document.getElementById("searchform");
            var filtfoot = document.getElementById("filtfoot");
            
            

            //Set the print button visibility to 'hidden' 
            printButton.style.display = 'none';
            backButton.style.display = 'none';
            filtfoot.style.display = 'block';
            window.print()

        }
        
        
       </script>
       <!-- <script>
         $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
             'csv', 'excel', 'pdf'
        ]
    } );
} );
       </script> -->
       <script>
    function Printpdf() {
        var table = $('#mytables').DataTable();
     table.destroy();

        var payment = document.getElementById("payment");
        var header = document.getElementById("headview");
            var filtfoot = document.getElementById("filtfoot");

            //Set the print button visibility to 'hidden' 
            payment.style.display = 'block';
            header.style.display = 'block';
            //  filtfoot.style.display = 'block';
            
            
       var HTML_Width = $("#pdf").width()+30;
    var HTML_Height = $("#pdf").height();
    var top_left_margin = 0;
    var PDF_Width = HTML_Width + (top_left_margin * 2);
    var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
    var canvas_image_width = HTML_Width;
    var canvas_image_height = HTML_Height;

    var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;
    
    
    

    html2canvas(document.querySelector('#pdf'),{useCORS: true}).then(function (canvas) {
        var imgData = canvas.toDataURL("image/jpeg", 1.0);
        
        var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
        pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
        for (var i = 1; i <= totalPDFPages; i++) { 
            
            pdf.addPage(PDF_Width, PDF_Height);
           
            pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
        }
        pdf.save("soa_report.pdf");
        payment.style.display = 'none';
            header.style.display = 'none';
        // window.open(imgData);
        // $("#print-section").hide();
        //  window.history.back();
    });
    
  
    
    
    
    }
    
    


</script>
      <script src="<?php echo base_url(); ?>/assets/user_scripts/reports/reports.js"></script>
     
