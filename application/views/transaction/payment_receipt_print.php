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
			<div style="margin-left: 8px;margin-top: 8pc">
			

				<div class="f-fix">
					<table class="table table-bordered tab3"  style="margin-bottom: 3px;">


						<tbody>
							<tr>
							<!-- <td style="width: 500px !important;">
							
								<p class="text-left">
								<img src="http://vd.ferryfolks.com//assets/images/vd_head.jpg" style="width:40%;" alt="logo"></td>
									</p> 
									</td> -->
									<td style="width: 500px !important;">
									<img src="http://vd.ferryfolks.com//assets/images/vd_head.jpg" style="width:65%;text-align:left;" alt="logo">
									<h3>شركة الشحن والتموین للشحن الجوي	<br />
									FREIGHT AND LOGISTICS CO<br />
									<p class="text-right" style="text-align: right!important;">KING KHALED STREET </br>
									DAMMAM SAUDI ARABIA </br>
									DAMMAM EASTERN 31764 </br>
									Tel : 966138946005 Fax: 00966 13 8946005 </br>
									Email : info@fl-ksa.com, Web : www.fl-ksa.com </br>
								</p>
								</h3>
							
									
									</td>
							</tr>
							<tr>
							<td width="100%">
								<h2 style="text-align: center!important;font-size: 24px;">RECEIPT VOUCHER - 		<span id="lblCustomerVat"><?php echo $receiptdata[0]->vat_no; ?></span> </h2>
								</br>
									<div class="row">
									<div class="col-md-2"></div>
									<div class="col-md-4"><strong>Received From : </strong><span id="lblClient"></span>

											<?php echo $receiptdata[0]->name; ?>
									
									</div>
									<div class="col-md-4">
									<strong>	Receipt No :</strong> 		<span id="lblCustomerVat"><?php echo $receiptdata[0]->vat_no; ?></span> 
									</div>
									</div>
									<div class="row">
									<div class="col-md-2"></div>
									<div class="col-md-4"><strong>A/C Name :</strong><?php echo $receiptdata[0]->name; ?>
									
									</div>
									<div class="col-md-4">
									<strong>	Date : </strong><?php echo $receiptdata[0]->Date; ?>
									</div>
									</div>
									<div class="row">
									<div class="col-md-2"></div>
									<div class="col-md-4"><strong>Type :</strong><?php echo $receiptdata[0]->Mode; ?>
									
									</div>
									<div class="col-md-4">
									<strong>Cheque/Ref.No :</strong> 
									</div>
									</div>
									<div class="row">
									<div class="col-md-2"></div>
									<div class="col-md-4"><strong>Narration : </strong>Payment from client, Amount:<?php echo $receiptdata[0]->SubTotal; ?>
									</div>
									</div>
								</td></tr>
								<tr>
							<td>
							<div class="row">
									<div class="col-md-3"></div>
									<div class="col-md-6"><strong>Description</strong>
									</div>
									<div class="col-md-3" style="border-left:2px solid black"><strong>Amount</strong>
									</div>
									</div>
							</td>
						</tr>
						<tr>
							<td>
							<div class="row">
									<div class="col-md-1"></div>
									<div class="col-md-8">	<?php echo $receiptdata[0]->clientenglish; ?></br> </br>
									<?php
						$number=0;
						foreach ($receiptdetails as $key => $value) {
$number=$number+1;
?>
									<?php echo $receiptdata[0]->ID; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $receiptdata[0]->Date; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;JOBNO:<?php echo $value->JobNo; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $receiptdata[0]->SubTotal; ?>
									</div>
									<?php } ?>
									<div class="col-md-3" style="border-left:2px solid black;line-height: 8rem;"><strong><?php echo $receiptdata[0]->SubTotal; ?></strong>
									</div>
									</div>
									<!-- <div class="col-md-2">INVDAM2000462</div><div class="col-md-2"> 30-SEP-20 </div><div class="col-md-2">JOBNO:JDAMAE2000447</div><div class="col-md-2">1500.00</div> -->
							</td>
						</tr>
						<tr>
						<td width="100%">
						<div class="row">
									<div class="col-md-3"></div>
									<div class="col-md-6"><p class="totalamt" style=" text-transform: uppercase;" id="demo">
									<span style="font-weight: 700; font-size: 13px;text-align:right"></span><span id="container" class="word"></span>
									&nbsp;Only
								</p>
									</div>
									<div class="col-md-3"><strong id="lblGrandTotal"><?php echo $receiptdata[0]->SubTotal; ?></strong>
									</div>
									</div>
						</td>
						</tr>
						<tr>
						
						<td width="100%" style="height: 500px;">
						<div class="row" style="margin-top: 317px;"></div>
					<div class="row">
					<div class="col-md-1"></div>
						<div class="col-md-3"> <p style="border-top: 2px solid black;text-align:center">Accountant</br>( ASHRAF )</p></div>
						<div class="col-md-3"><p style="border-top: 2px solid black;text-align:center">Checked by</p></div>
						<div class="col-md-3"><p style="border-top: 2px solid black;text-align:center">Receiver's Signature</p></div>
					</div>
						</td>
					
						</tr>
						</tbody>

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