<?php
// var_dump($invoicedata);
// var_dump($invoice);
// die();
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head id="Head1">
	<title>
<?php echo $companyinfo[0]->Cmpny_name;?>
	</title>

     <link rel = "icon" href = "<?php echo IMAGE_PATH.$companyinfo[0]->Icon_image;?> "width="30px" height="30px"> 
	<link href="<?php echo base_url(); ?>/assets/invoicereport/style.css" rel="stylesheet" />

	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/invoicereport/bootstrap.css" />
	<style>
		@media print {
			.f-fix {
				position: fixed;
				bottom: 0;
			}

			.fr {
				padding-right: 17px;
			}

			@page {
				margin-top: 0;
				/* this affects the margin in the printer settings */
				margin-bottom: 0;
			}
		}
	</style>
</head>
<body >
  



            <div class="container">
                <div class="row">
                    <a id="btnHome" style="float: left;" href="<?php echo base_url(); ?>user-home" class="btn btn-default">Home</a>
                    <a id="btnBack" style="float: left;" href="<?php echo base_url(); ?>job-search" class="btn btn-default">Make Another Invoice</a>
                    <button id="btnPrint" style="float: left;" class="btn btn-success" onclick="PrintPage()"><i class="fa fa-print"></i>Print</button>

                    <div style="position: absolute; left: 41%;">
                        <a id="lbtnPrev" href="javascript:__doPostBack(&#39;lbtnPrev&#39;,&#39;&#39;)"><i class="fa fa-arrow-circle-o-left" style="font-size: 27px;" aria-hidden="true"></i></a>&nbsp;&nbsp;
                                <a id="lbtnNext" href="javascript:__doPostBack(&#39;lbtnNext&#39;,&#39;&#39;)"><i class="fa fa-arrow-circle-o-right" style="font-size: 27px;" aria-hidden="true"></i></a>
                    </div>
                  
                    <table style="width: 100%; margin-bottom: -1px; margin-top: 40px;">
                        <tr>
                            <td style="width:100%;" >
                            <img src="<?php echo IMAGE_PATH.$invoiceinfo[0]->Invheaderimage;?>" style="width:100%;" alt="logo"></td>
                            <td style="width:34%;" >
      <div class="textcenters" style="display: flex; align-items: center; justify-content: margin-bottom: 15px; margin-top: 15px;">
                        
                  
                    </div>
</td>
                            <td style="width:34%;" >
    
</td>
                        </tr>
                    </table><br/>


                    <div style="width: 98%;  padding-left: 75%;"> 
                    <?php echo $invoicedata[0]->clientenglish;?>
</br>
	</div>             
    <div class="textcenters" style="display: flex;   margin-bottom: 15px; margin-top: 15px;">
				<h3><strong >Invoice <?php echo $invoicedata[0]->Inv;?>  </strong></h3><br />
            </div>

		             	<div class="row">	
									<div class="col-md-4"><strong style="color: #286090;">Invoice Date :</strong> </br>
                                    <?php echo $invoicedata[0]->Date;?>
									
									</div>
									<div class="col-md-4">
									
									</div>
									</div>	</br>	            
                    

                    <div style="margin-left: 8px;">
                        <table class="table table-bordered tab2 m-b-1">
                            <thead>
                                <tr style="color: #286090;">
                                    <th class="ctr" width="6.5%"><b>Sl No:</b>
                                       
                                    </th>
                                    <th width="46.2%">Item Description
                                      
                                    </th>
                                    <th class="ctr" width="10.5%">Unit Price
                                     
                                    </th>
                                    <th class="ctr" width="10%">Qty
                                       
                                    </th>
                                    <th width="15.2%">Vat %
                                       </th>
                                    <th width="15.2%">Vat Amount
                                       </th>
                                    <th width="12.3%">Amount
                                       
                                    </th>
                                </tr>
                            </thead>
                             <tbody>
                                
                                      <?php 
                                      $totalvatper=0;
                                      $no=0;
                                      foreach($invoice as $key=>$value)
                                      {
                                       
                                          $no=$no+1;
                                          $totalval=(($value->UnitPrice*$value->Quantity)+$value->Vat)*$value->ConvFactor; 
                                          $subval=($value->UnitPrice*$value->Quantity);
                                          if((($value->Vat/$subval)*100)>$totalvatper)
                                          {$totalvatper=(($value->Vat/$subval)*100);
                                          }
                                          ?>
                                    
                                        <tr id="currencyfilter">
                                            <td style="text-align: center;">
                                             <?php  echo $no;?>
                                            </td>
                                            <td>
                                                <span id="rptrDetail_lblDesc_0"><?php echo $value->Description;?></span>
                                                
                                            </td>
                                            <td style="text-align: right;">
                                            <?php echo $value->UnitPrice;?> - <?=  $value->Currency; ?>
                                            </td>
                                            <td style="text-align: right;">
                                              <?php echo $value->Quantity;?>
                                            </td>
                                            <td style="text-align: right;">   <?php echo $value->VAT_percentage;?></td>
                                            <td style="text-align: right;">   <?php echo $value->Vat;?></td>
                                            <td style="text-align: right;" data-price="<?=  $value->UnitPrice; ?>" data-qty="<?=  $value->Quantity; ?>" class="currency">
                                             <?php echo $totalval;  ?>
                                            </td>
                                        </tr>
                                    
                                      <?php } ?>
                            </tbody>
                        </table>
                        


                        <div style="width: 100%; padding-left: 53%;"> 
				<table class="table table-bordered tab3 ">
						<tr>
						<td>Subtotal</td>
						<td style="text-align: right;border-right: solid 1px #FFF;"><?php echo $invoicedata[0]->Total;?></td>	
						</tr>
						<tr>
						<td>Vat Total</td>
						<td style="background-color: #d2dede;text-align: right;"> <?php echo $invoicedata[0]->VatTotal;?></td>	
						</tr>
						<tr style="background-color: #a1b0ab;" >
						<td>Grand Total</td>
						<td style="text-align: right;"> <?php echo $invoicedata[0]->GrandTotal;?></td>	
						</tr>

						</table>
				
				</div>
                Please use the following communication for your payment :  <?php echo $invoicedata[0]->Inv;?> 
              

                <div class="f-fix" style="width: 100%; padding-bottom: 58px;">
                
			<table >
             <tr>
			<img src="<?php echo IMAGE_PATH.$invoiceinfo[0]->InvfooterImage;?>" style="width: 100%;" alt="logo">
			</tr>
			</table>
			</div>

                       

                    </div>
                </div>
            </div>
       

    </div>



    <!-- jQuery -->

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
</body>
</html>


