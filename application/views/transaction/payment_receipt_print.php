<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/invoiceprint/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/invoiceprint/css/custom.css">

    <title>Receipt Page</title>

</head>

<body>

    <div class="container">
		
	<a id="btnHome" style="float: left;" href="<?php echo base_url(); ?>user-home" class="btn btn-default">Home</a>
			<a id="btnBack" style="float: left;" href="<?php echo base_url(); ?>clientpaymentlist" class="btn btn-default">Make Another Invoice</a>
			<button id="btnPrint" style="float: left;" class="btn btn-success" onclick="PrintPage()"><i class="fa fa-print"></i>Print</button>
			
			<!-- <div class="col-md-1 form-group">
                <button id="btnpdf" style="float: left;" class="btn btn-success" onclick="Printpdf()"><i class="fa fa-print"></i>Pdf</button>   
            </div> -->
		
			<div style="position: absolute; left: 41%;">
				<a id="lbtnPrev" href="javascript:__doPostBack(&#39;lbtnPrev&#39;,&#39;&#39;)"><i class="fa fa-arrow-circle-o-left" style="font-size: 27px;" aria-hidden="true"></i></a>&nbsp;&nbsp;
				<a id="lbtnNext" href="javascript:__doPostBack(&#39;lbtnNext&#39;,&#39;&#39;)"><i class="fa fa-arrow-circle-o-right" style="font-size: 27px;" aria-hidden="true"></i></a>
			</div>
			       
        <div class="row main" id="pdf">
            <div class="col-lg-12">
                <div class="head-logo">
                     <img src="<?php echo base_url(); ?>/assets/invoiceprint/image/freighbridlogo.png"> 
                  <!--   <img src="<?php echo IMAGE_PATH.$invoiceinfo[0]->Invheaderimage;?>"  alt="logo"> -->
                </div>
            </div>
        </div>
    </div>

    <div class="row main">
        <div class="col-lg-12 tax-bottom">
            <div class="tax-invoice">
                <h2>RECEIPT</h2>
            </div>
        </div>
    </div>

    <!-- first section -->
    <div class="row main">
        <div class="col-xl-12 ">
            <div class="row">
                <div class="col-lg-6 col-sm-6 col-12">
                    <div class="section-first-box ">
                        <div class="text-1">
                            <p><?php echo $companyinfo[0]->Cmpny_name;?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="first-box-1">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="text-1">
                                            <p> <?php echo $companyinfo[0]->Address;?> <?php echo $companyinfo[0]->Phone;?><?php echo $companyinfo[0]->Email;?></p>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="first-box-1">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="text">
                                            <p>Office VAT ID (TRN):</p>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="text-1">
                                            <p><?php echo $companyinfo[0]->VAT;?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <div class="col-lg-6 col-sm-6 col-12">
                    <div class="section-second-box ">
                        <h2>Bill To</h2>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="second-box-1">
                                <div class="row">
                                    <div class="col-lg-2 col-12">
                                        <div class="text">
                                            <p>Name</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-10 col-12">
                                        <div class="text">
                                            <p><?php echo $receiptdata[0]->name;?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="second-box-1">
                                <div class="row">
                                    <div class="col-lg-2 col-12">
                                        <div class="text">
                                            <p>Address</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-10 col-12">
                                        <div class="text-1">
                                            <p> <?php echo $receiptdata[0]->clientenglish;?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="second-box-1">
                                <div class="row">
                                    <div class="col-6 center-line">
                                        <div class="text">
                                            <p>Region</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text">
                                            <p>VAT ID (TRN)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="second-box-1">
                                <div class="row">
                                    <div class="col-6 center-line">
                                        <div class="text-1">
                                            <p><?php echo $receiptdata[0]->country;?></p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-1">
                                            <p><?php echo $receiptdata[0]->trn_no;?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="second-box-1">
                                <div class="row">
                                    <div class="col-lg-3 col-12">
                                        <div class="text">
                                            <p>Receipt No.</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-12">
                                        <div class="text">
                                            <p><?php echo $receiptdata[0]->vat_no; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="second-box-1">
                                <div class="row">
                                    <div class="col-6 center-line">
                                        <div class="row">
                                            <div class="col-lg-6 col-12">
                                                <div class="text">
                                                    <p>Payment Date </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="text-1">
                                                    <p><?php echo $receiptdata[0]->Date; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- first section -->

    <!-- second section -->

    
    <!-- second section -->

    <!-- third section -->
    <div class="shipping-table">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
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
								<td style="text-align:right;"><?php $org=$receiptdetails[0]->Actual_amount; echo $receiptdetails[0]->Actual_amount." AED"; ?></td>
								<td style="text-align:right;"><?php $paid=$receiptdata[0]->SubTotal; echo $receiptdata[0]->SubTotal." AED"; ?></td>
								<td style="text-align:right;"><?php  $r=number_format($org - $paid, 2); echo $r." AED"; ?></td>
							
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
                    <div class="col-lg-2 col-3">
                        <div class="text-4">
                            <p>In Words</p>
                        </div>
                    </div>
                    <div >  <p><span id="lblGrandTotal" hidden><?php echo $receiptdata[0]->SubTotal;?></span></p>
                        <div class="tax-table-text-1">
                            <p> <span id="container" class="word"></span>
                                            &nbsp;Only</p>  
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12">

        </div>
    </div>

    <!-- fifth section -->

    <!-- sixth section -->
  
    <!-- sixth section -->

    <!-- footer section -->
    <div class="row main">
        <div class="col-lg-12">
            <hr class="footer-line">
            <div class="footer-text">
                <p>M +9715 5171 2052  info@freighbridlogistics.com http://www.freighbridlogistics.com</p>
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
            var a = ['', 'one ', 'two ', 'three ', 'four ', 'five ', 'six ', 'seven ', 'eight ', 'nine ', 'ten ', 'eleven ', 'twelve ', 'thirteen ', 'fourteen ', 'fifteen ', 'sixteen ', 'seventeen ', 'eighteen ', 'nineteen '];
            var b = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];
            var number = parseFloat(totalRent).toFixed(2).split(".");
            var num = parseInt(number[0]);
            var digit = parseInt(number[1]);
            //console.log(num);
            if ((num.toString()).length > 9) return 'overflow';
            var n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
            var d = ('00' + digit).substr(-2).match(/^(\d{2})$/);;
            if (!n) return; var str = '';
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