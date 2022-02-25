<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head id="Head1">
	<title>
		FERRY FOLKS
	</title>
	<link href="<?php echo base_url(); ?>/assets/invoicereport/style.css" rel="stylesheet" />

	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/invoicereport/bootstrap.css" />
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

		.f-fix {
				position: fixed;
				bottom: 0;
			}
       
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

th {
  border:1px solid black;
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
    background-image: url("<?php echo base_url(); ?>/assets/images/vd_background.jpg");
    /* Full height */
    height: 100%;
    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    -webkit-print-color-adjust: exact;
   }
</style>
	
</head>

<body>




	<div class="container">
		<div class="row">
			<a id="btnHome" style="float: left;" href="<?php echo base_url(); ?>user-home" class="btn btn-default">Home</a>
			<a id="btnBack" style="float: left;" href="<?php echo base_url(); ?>clientpaymentlist" class="btn btn-default">Make Another Invoice</a>
			<button id="btnPrint" style="float: left;" class="btn btn-success" onclick="PrintPage()"><i class="fa fa-print"></i>Print</button>
			<div class="col-md-1 form-group">
                <button id="btnpdf" style="float: left;" class="btn btn-success" onclick="Printpdf()"><i class="fa fa-print"></i>Pdf</button>   
            </div>
		
			<div style="position: absolute; left: 41%;">
				<a id="lbtnPrev" href="javascript:__doPostBack(&#39;lbtnPrev&#39;,&#39;&#39;)"><i class="fa fa-arrow-circle-o-left" style="font-size: 27px;" aria-hidden="true"></i></a>&nbsp;&nbsp;
				<a id="lbtnNext" href="javascript:__doPostBack(&#39;lbtnNext&#39;,&#39;&#39;)"><i class="fa fa-arrow-circle-o-right" style="font-size: 27px;" aria-hidden="true"></i></a>
			</div>

		
			<div class="row" id="pdf">
			<div style="margin-left: 8px;margin-top: 8pc;    margin-right: 8px;">
			

				<div class="">
					<table class="table  tab3"  style="margin-bottom: 3px;">


						<tbody>
							<tr>
							<td style="width:100%;" >
                            <img src="<?php echo IMAGE_PATH.$invoiceinfo[0]->Invheaderimage;?>" style="width:100%;" alt="logo"></td>
                            <td style="width:34%;" >
      <div class="textcenters" style="display: flex; align-items: center; justify-content: margin-bottom: 15px; margin-top: 15px;">
                        
                  
                    </div>
</td>
							</tr></table>
							<table class="table  tab3"  style="margin-bottom: 3px;">
							<tr>
							<td width="100%">
							<h2 style="font-size: 24px;"><strong>Payment Receipt : 		<span id="lblCustomerVat"><?php echo $receiptdata[0]->vat_no; ?></span> </strong></h2>
	
									<div class="row">
									
									<div class="col-md-4"><strong>Payment Date : </strong><span id="lblClient"></span>

											<?php echo $receiptdata[0]->Date; ?>
									
									</div>
									
									</div>
									<div class="row">
									
									<div class="col-md-4"><strong>Customer :</strong><?php echo $receiptdata[0]->name; ?>
									
									</div>
									<div class="col-md-4">
									<strong>	Payment Method : </strong><?php echo $receiptdata[0]->Mode; ?>
									</div>
									</div>
									<div class="row">
									
									<div class="col-md-4"><strong>Payment Amount :</strong><?php echo $receiptdata[0]->SubTotal; ?>
									
									</div>
									<div class="col-md-4">
									<strong>Memo :</strong> 
									</div>
									</div>
									
								</td></tr>
</table><br/>
<table class="table table-bordered tab3"  style="margin-bottom: 3px; margin: 10px;width: 98%;">
<tr width="100%" style="color: #286090;">
             <th >INVOICE DATE</th>
			 <th>INVOICE NUMBER</th>
			 <th>REFERENCE</th>
			 <th>ORIGINAL AMOUNT</th>
			 <th>AMOUNT PAID</th>
			 <th>BALANCE</th>

	                  </tr>
								<tr>

								<td><?php echo $receiptdata[0]->Date; ?></td>
								<td><?php echo $invoiceinfo[0]->Invseries; ?></td>
								<td><?php  ?></td>
								<td style="text-align:right;"><?php $org=$receiptdata[0]->SubTotal; echo $receiptdata[0]->SubTotal." AED"; ?></td>
								<td style="text-align:right;"><?php $paid=$receiptdata[0]->SubTotal; echo $receiptdata[0]->SubTotal." AED"; ?></td>
								<td style="text-align:right;"><?php  $r=number_format($org - $paid, 2); echo $r." AED"; ?></td>
							
						</tr>
						
					
						</tbody>

					</table><br/>
				
				</div>
				

				<div class="f-fix" style="width: 100%; padding-bottom: 58px;">
                
				<table >
				 <tr>
				<img src="<?php echo IMAGE_PATH.$invoiceinfo[0]->InvfooterImage;?>" style="width: 100%;" alt="logo">
				</tr>
				</table>
				</div>

				</div>
			
				<div>
		</div>
		</div>	
	


	</div>



	<!-- jQuery -->


	<script src="<?php echo base_url(); ?>/assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
	<script>
		$(document).ready(function() {
			//var rowCount = $('.mytable tr').length;
			inwords($('#lblGrandTotal').text());
		});

		function inwords(totalRent) {
			//console.log(totalRent);
			var a = ['', 'one ', 'two ', 'three ', 'four ', 'five ', 'six ', 'seven ', 'eight ', 'nine ', 'ten ', 'eleven ', 'twelve ', 'thirteen ', 'fourteen ', 'fifteen ', 'sixteen ', 'seventeen ', 'eighteen ', 'nineteen '];
			var b = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];
			var number = parseFloat(totalRent).toFixed(2).split(".");
			var num = parseInt(number[0]);
			var digit = parseInt(number[1]);
			//console.log(num);
			if ((num.toString()).length > 9) return 'overflow';
			var n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
			var d = ('00' + digit).substr(-2).match(/^(\d{2})$/);;
			if (!n) return;
			var str = '';
			str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
			str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
			str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
			str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
			str += (n[5] != 0) ? (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + ' ' : '';
			str += (d[1] != 0) ? ((str != '') ? "and " : '') + (a[Number(d[1])] || b[d[1][0]] + ' ' + a[d[1][1]]) + ' ' : '';
			console.log(str);
			$('#container').text(str)
			return str;
		}
	</script>







	<script>
		function PrintPage() {


			//Get the print button and put it into a variable
			var printButton = document.getElementById("btnPrint");
			var backButton = document.getElementById("btnBack");
			var nextButton = document.getElementById("lbtnNext");
			var prevButton = document.getElementById("lbtnPrev");
			var HomeButton = document.getElementById("btnHome");

			//Set the print button visibility to 'hidden' 
			printButton.style.visibility = 'hidden';
			backButton.style.visibility = 'hidden';
			nextButton.style.visibility = 'hidden';
			prevButton.style.visibility = 'hidden';
			HomeButton.style.visibility = 'hidden';
			window.print()

		}
	</script>
 <script>
    function Printpdf() {
     
        // var payment = document.getElementById("payment");
        // var header = document.getElementById("headview");
            // var filtfoot = document.getElementById("filtfoot");

          
            
            
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
        pdf.save("payment_receipt.pdf");
        // payment.style.display = 'none';
        //     header.style.display = 'none';
        // window.open(imgData);
        // $("#print-section").hide();
        //  window.history.back();
    });
    
  
    
    
    
    }
    
    


</script>
</body>

</html>