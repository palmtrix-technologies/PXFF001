<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/invoiceprint/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/invoiceprint/css/custom.css"> -->

    <title>Receipt Page</title>

</head>


<body style=" width: 80%; margin-left: 9%;">

    <div class="container">
		
	
			       
        <div class="row main" id="pdf">
            <div class="col-lg-12">
                <div class="head-logo">
                     <img src="<?php echo base_url(); ?>/assets/invoiceprint/image/freighbridlogo.png" style="margin-left:70%;"> 
                  <!--   <img src="<?php echo IMAGE_PATH.$invoiceinfo[0]->Invheaderimage;?>"  alt="logo"> -->
                </div>
            </div>
        </div>
    </div>

    <div class="row main">
        <div class="col-lg-12 tax-bottom">
            <div class="tax-invoice">
               <center> <h2 style="background-color: #004276; color: aliceblue;">RECEIPT</h2></center>
            </div>
        </div>
    </div>

    <!-- first section -->
    <div class="row main">

    <div class="col-lg-6 tax-bottom">
            <div class="tax-invoice">
               <!-- <center> <h6 style="background-color: #004276; color: aliceblue;">Client</h6></center> -->
               <p><?php echo $receiptdata[0]->name;?> <br/>
               <?php echo $receiptdata[0]->clientenglish;?>
               <br/>
               <?php echo $receiptdata[0]->country;?>
               <br/>
               VAT ID (TRN)  : <?php echo $receiptdata[0]->trn_no;?>
                                            </p>
            </div>
        </div></div>

    <!-- first section -->

    <!-- second section -->

    
    <!-- second section -->

    <!-- third section -->
    <div class="shipping-table">
        <div class="row">
            <div class="col-lg-12">
                <div >
				<table   style="margin-bottom: 3px; margin: 10px;width: 98%;border: 1px solid !important;">
<tr  style="color: #286090;text-align: center; border: 1px solid !important;">
             <th style="border: 1px solid !important;">INVOICE DATE</th>
			 <th style="border: 1px solid !important;">INVOICE NUMBER</th>
			 <th  style="border: 1px solid !important;">REFERENCE</th>
			 <th style="border: 1px solid !important;">ORIGINAL AMOUNT</th>
			 <th style="border: 1px solid !important;">AMOUNT PAID</th>
			 <th style="border: 1px solid !important;">BALANCE</th>

	                  </tr>
								<tr>

								<td style="text-align:center;border: 1px solid !important;"><?php echo $receiptdata[0]->Date; ?></td>
								<td style="text-align:center;border: 1px solid !important;"><?php echo $invoiceinfo[0]->Invseries; ?></td>
								<td style="text-align:center;border: 1px solid !important;"><?php  ?></td>
								<td style="text-align:center;border: 1px solid !important;"><?php $org=$receiptdetails[0]->Actual_amount; echo $receiptdetails[0]->Actual_amount." AED"; ?></td>
								<td style="text-align:center;border: 1px solid !important;"><?php $paid=$receiptdata[0]->SubTotal; echo $receiptdata[0]->SubTotal." AED"; ?></td>
								<td style="text-align:center;border: 1px solid !important;"><?php  $r=number_format($org - $paid, 2); echo $r." AED"; ?></td>
							
						</tr>
						
					
						</tbody>

					</table><br/>
                </div>
            </div>
        </div>
    </div>
    <!-- third section -->

    <!-- fourth section -->
  
    <!-- fourth section -->

    <!-- fifth section -->
    <div class="row main">
        <div class="col-lg-6 col-12">
            <div class="cash-words">
                <div class="row">

                <p id="lblGrandTotal" hidden><?php echo $receiptdata[0]->SubTotal;?></p>
                 <p id="container" class="word"></p>
                                            &nbsp;Only  
                    
                   
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12">

        </div>
    </div>

    <div class="row main">
        <div class="col-lg-12">
            <hr class="footer-line">
            <div class="footer-text">
                <p style="margin-left: 20%;">M +9715 5171 2052  info@freighbridlogistics.com http://www.freighbridlogistics.com</p>
            </div>
        </div>
    </div>
    <!-- footer section -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/invoiceprint/js/bootstrap.min.js"></script>
      <script src="<?php echo base_url(); ?>/assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>

    <script>
        $(document).ready(function () {
            //var rowCount = $('.mytable tr').length;
            inwords($('#lblGrandTotal').text());
        });
        function inwords(totalRent) {
            //console.log(totalRent);
            var a = ['', 'One ', 'Two ', 'Three ', 'Four ', 'Five ', 'Six ', 'Seven ', 'Eight ', 'Nine ', 'Ten ', 'Eleven ', 'Twelve ', 'Thirteen ', 'Fourteen ', 'Fifteen ', 'Sixteen ', 'Seventeen ', 'Eighteen ', 'Nineteen '];
            var b = ['', '', 'Twenty', 'Thirty', 'Torty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];
            var number = parseFloat(totalRent).toFixed(2).split(".");
            var num = parseInt(number[0]);
            var digit = parseInt(number[1]);
            //console.log(num);
            if ((num.toString()).length > 9) return 'overflow';
            var n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
            var d = ('00' + digit).substr(-2).match(/^(\d{2})$/);;
            if (!n) return; var str = '';
            str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'Crore ' : '';
            str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'Lakh ' : '';
            str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'Thousand ' : '';
            str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'Hundred ' : '';
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