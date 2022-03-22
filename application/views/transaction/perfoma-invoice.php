<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/invoiceprint/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/invoiceprint/css/custom.css">

    <title>Invoice Page</title>

</head>

<body>

    <div class="container">
        <a id="btnHome" style="float: left;" href="<?php echo base_url(); ?>user-home" class="btn btn-default">Home</a>
                    <a id="btnBack" style="float: left;" href="<?php echo base_url(); ?>job-search" class="btn btn-default">Make Another Invoice</a>
                    <button id="btnPrint" style="float: left;" class="btn btn-success" onclick="PrintPage()"><i class="fa fa-print"></i>Print</button>
                      <div style="position: absolute; left: 41%;">
                        <a id="lbtnPrev" href="javascript:__doPostBack(&#39;lbtnPrev&#39;,&#39;&#39;)"><i class="fa fa-arrow-circle-o-left" style="font-size: 27px;" aria-hidden="true"></i></a>&nbsp;&nbsp;
                                <a id="lbtnNext" href="javascript:__doPostBack(&#39;lbtnNext&#39;,&#39;&#39;)"><i class="fa fa-arrow-circle-o-right" style="font-size: 27px;" aria-hidden="true"></i></a>
                    </div>
                  
        <div class="row main">
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
                <h2>Tax Invoice</h2>
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
                                    <!-- <div class="col-5">
                                        <div class="text-1">
                                            <p>T : +9714</p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="text-1">
                                            <p>3555011</p>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="text-1">
                                            <p>PO Box : 122147 Dubai, United Arab Emirates</p>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="text-1">
                                            <p> F : +9714 </p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="text-1">
                                            <p>3555010</p>
                                        </div>
                                    </div> -->
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
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-first-box-1">
                                <div class="text-1">
                                    <p>Remarks</p>
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
                                            <p><?php echo $invoicedata[0]->name;?></p>
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
                                            <p> <?php echo $invoicedata[0]->clientenglish;?>
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
                                            <p><?php echo $invoicedata[0]->country;?></p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-1">
                                            <p><?php echo $invoicedata[0]->trn_no;?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="second-box-1">
                                <div class="row">
                                    <div class="col-lg-3 col-12">
                                        <div class="text">
                                            <p>Invoice Ref #</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-12">
                                        <div class="text">
                                            <p><?php echo $invoicedata[0]->Inv;?></p>
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
                                                    <p>Invoice Date </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="text-1">
                                                    <p><?php echo $invoicedata[0]->Date;?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-lg-6 col-12">
                                                <div class="text">
                                                    <p>Due Date </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="text-1">
                                                    <p></p>
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

    <div class="row main">
        <div class="col-12">
            <div class="shipment-details">
                <div class="text-1">
                    <p> Shipment Details -(LINER EXPORT)</p>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="shipment-details-1">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="row">

                            <div class="col-lg-4 col-6">
                                <div class="text-1">
                                    <p>Container No</p>
                                </div>
                            </div>
                            <div class="col-lg-8 col-6">
                                <div class="text-1">
                                    <p>: <?php echo $invoicedata[0]->ContainerNo;?></p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="text-1">
                                    <p>Job Ref</p>
                                </div>
                            </div>
                            <div class="col-lg-8 col-6">
                                <div class="text-1">
                                    <p>:<?php echo $invoicedata[0]->Jobcode;?></p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="text-1">
                                    <p>Customer Ref</p>
                                </div>
                            </div>
                            <div class="col-lg-8 col-1">
                                <div class="text-1">
                                    <p>: </p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="text-1">
                                    <p>Packages/Qty</p>
                                </div>
                            </div>
                            <div class="col-lg-8 col-6">
                                <div class="text-1">
                                    <p>:</p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="row">
                            <div class="col-lg-4 col-6">
                                <div class="text-1">
                                    <p>Weight/Vol</p>
                                </div>
                            </div>
                            <div class="col-lg-8 col-6">
                                <div class="text-1">
                                    <p>: <?php echo $invoicedata[0]->ActualWeight;?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="text-1">
                                    <p>BL Ref</p>
                                </div>
                            </div>
                            <div class="col-lg-8 col-6">
                                <div class="text">
                                    <p>:</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="text-1">
                                    <p>Terms</p>
                                </div>
                            </div>
                            <div class="col-lg-8 col-6">
                                <div class="text-1">
                                    <p>: </p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="text-1">
                                    <p>Shipper</p>
                                </div>
                            </div>
                            <div class="col-lg-8 col-6">
                                <div class="text-1">
                                    <p>: <?php echo $invoicedata[0]->consignor;?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- second section -->

    <!-- third section -->
    <div class="shipping-table">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="shipping-table-content">
                            <tr>
                                <th scope="col" class="shipping-table-head">Sl No.</th>
                                <th scope="col" class="shipping-table-head">Description</th>
                                <th scope="col" class="shipping-table-head">Qty.Unit</th>
                                <th scope="col" class="shipping-table-head">Unit Price</th>
                                <th scope="col" class="shipping-table-head">Curr/<br> Ex.Rate</th>

                                <th scope="col" class="shipping-table-head">Taxable Value</th>
                                <th scope="col" class="shipping-table-head">VAT %</th>
                                <th colspan="2">VAT</th>
                            </tr>
                            <tr>
                                <th scope="col" class="shipping-table-head-1"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                               
                                <th>Rate</th>
                                <th>Amt</th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php 
                                      $totalvatper=0; $tt=0;
                                      $no=0;
                                      foreach($invoice as $key=>$value)
                                      {
                                       
                                          $no=$no+1;
                                          $totalval=((($value->UnitPrice*$value->Quantity))*$value->ConvFactor)+$value->Vat; 
                                           $totalvall=((($value->UnitPrice*$value->Quantity))*$value->ConvFactor); 
                                           $tt=$tt+$totalvall; 
                                          $subval=($value->UnitPrice*$value->Quantity);
                                          if((($value->Vat/$subval)*100)>$totalvatper)
                                          {$totalvatper=(($value->Vat/$subval)*100);
                                          }
                                          ?>
                            <tr >
                                <td class="shipping-table-text">
                                             <?php  echo $no;?>
                                            </td>
                                <td scope="row" class="shipping-table-text"><?php echo $value->Description;?></td>
                                <td class="shipping-table-text"><?php echo $value->Quantity;?></td>
                                <td class="shipping-table-text"><?php echo $value->UnitPrice;?></td>
                                <td class="shipping-table-text"><?php echo $value->Currency; ?> <?php echo $value->ConvFactor; ?></td>
                                <td class="shipping-table-text">   <?php echo $totalvall;?></td>
                                <td class="shipping-table-text"> <?php echo $value->VAT_percentage;?></td>
                                 <td class="shipping-table-text">   <?php echo $value->Vat;?></td>
                                <td class="shipping-table-text-1">
                                    <?php echo $totalval; ?>
                                </td>

                            </tr>
                            <?php } ?>
                          
                        </tbody>
                        <tfoot>
                             <tr >
                                    <td class="shipping-table-total"></td>
                                    <td class="shipping-table-total"></td>
                                    <td class="shipping-table-total"></td>
                                    <td class="shipping-table-total"></td>
                                    <td class="shipping-table-total"></td>
                                    <td class="shipping-table-total"><?php echo $tt;?> </td>
                                    <td class="shipping-table-total"> 0.00</td>
                                    <td class="shipping-table-total"></td>
                                    
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- third section -->

    <!-- fourth section -->
    <div class="shipping-table">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-6 col-6">
                        <div class="table-responsive"></div>
                        <table class="table table-bordered">
                            <thead class="shipping-table-content">
                                <tr>
                                    <th scope="col" class="shipping-table-head">Tax Summary</th>
                                    <th scope="col" class="shipping-table-head">Taxable Amt</th>
                                    <th colspan="2">VAT</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>%</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">VAT 0%</td>
                                    <td><?php echo $tt;?></td>
                                    <td>0.00</td>
                                    <td>0.00</td>
                                </tr>
                                 
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6 col-6">
                        <div class="cash-words-1">
                            <div class="row">
                                <div class="col-lg-6 col-6">
                                    <div class="tax-table-text-2">
                                        <p>Total Invoice :</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-6">
                                    <div class="tax-table-text-3">
                                        <p><?php echo $invoicedata[0]->Total;?></p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-6">
                                    <div class="tax-table-text-2">
                                        <p>Vat Total :</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-6">
                                    <div class="tax-table-text-3">
                                        <p><?php echo $invoicedata[0]->VatTotal;?></p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-6">
                                    <div class="tax-table-text-2">
                                        <p>Net Total : </p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-6">
                                    <div class="tax-table-text-3">
                                        <p><span id="lblGrandTotal"> <?php echo $invoicedata[0]->GrandTotal;?></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                    <div >
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
    <div class="row main">
        <div class="col-lg-5"></div>
        <div class="col-lg-7">
            <div class="section-second-box">
                <div class="text-1">
                    <p>Bank Details</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="second-box-1">
                        <div class="row">
                            <div class="col-lg-2 col-5">
                                <div class="bank-details-text">
                                    <p>A/C Name</p>
                                </div>
                            </div>
                            <div class="col-lg-10 col-7">
                                <div class="bank-details-text-1">
                                    <p>NAVIO SHIPPING LLC</p>
                                </div>
                            </div>
                            <div class="col-lg-2 col-5">
                                <div class="bank-details-text">
                                    <p>A/C Number</p>
                                </div>
                            </div>
                            <div class="col-lg-10 col-7">
                                <div class="bank-details-text-1">
                                    <p>101 5879 1124 001</p>
                                </div>
                            </div>
                            <div class="col-lg-2 col-5">
                                <div class="bank-details-text">
                                    <p>IBAN</p>
                                </div>
                            </div>
                            <div class="col-lg-10 col-7">
                                <div class="bank-details-text-1">
                                    <p>AE90003001015824001</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="row">
                                            <div class="col-lg-4 col-5">
                                                <div class="bank-details-text">
                                                    <p>Bank</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-5">
                                                <div class="bank-details-text-1">
                                                    <p>ABU DHABI COMMERCIAL BANK [AED]</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12 swift-code-right">
                                        <div class="row">
                                            <div class="col-lg-4 col-5">
                                                <div class="bank-details-text">
                                                    <p>Swift Code</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-5">
                                                <div class="bank-details-text-1">
                                                    <p>ADCBAEAAXXX</p>
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

</body>

</html>