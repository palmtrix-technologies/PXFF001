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
                <h2>Supplier Expense</h2>
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
                    <div class="row">
                        <div class="col-lg-12">
                           
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
                                            <p>Supplier Name</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-10 col-12">
                                        <div class="text">
                                            <p><?php echo $expdata[0]->supplier_name;?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="second-box-1">
                                <div class="row">
                                    <div class="col-lg-2 col-12">
                                        <div class="text">
                                            <p>Client</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-10 col-12">
                                        <div class="text-1">
                                            <p> <?php echo $expdata[0]->clientenglish;?>
                                            </p>
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
                                                    <p>GL Date </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="text-1">
                                                    <p><?php echo $expdata[0]->PostingDate;?></p>
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
                    <table class="table table-bordered">
                        <thead class="shipping-table-content">
                            <tr>
                                <th scope="col" class="shipping-table-head">Sl No.</th>
                                <th scope="col" class="shipping-table-head">Description</th>
                                <th scope="col" class="shipping-table-head">Unit Price</th>
                                <th scope="col" class="shipping-table-head">Curr/<br> Ex.Rate</th>

                                <th scope="col" class="shipping-table-head">Taxable Value</th>
                                <th colspan="2">Total Amount</th>
                            </tr>
                           
                                  <?php 
                                      $number=0;
                                      foreach($expense as $key=>$value)
                                      {
                                         $number=$number+1;
                                         ?>
                                    
                                        <tr >
                                            <td >
                                               <?php echo $number; ?>
                                            </td>
                                            <td>
                                                <span id="rptrDetail_lblDesc_0"><?php echo $value->Description;?></span>
                                            </td>
                                            <td>
                                            <?php echo $value->Amount;?> 
                                            </td>

                                            <td>
                                            <?php echo $value->Currency;?> 
                                            </td>
                                            <td>   <?php echo $value->Vat." (".$value->vat_persentage.")";?></td>
                                            <td colspan="2">
                                            <?php echo $value->Total;?>
                                            </td>
                                        </tr>
                                    
                                      <?php } ?>
                                <tr>
                                    <td colspan="5">
                                        <p class="totalamt" style=" text-transform: uppercase; text-align:center;" id="demo">
                                            <span style="font-weight: 700; font-size: 13px;"></span><span id="container" class="word"></span>
                                            &nbsp;Only
                                        </p>
                                    </td>
                                    <td  style="text-align: center;" colspan="2">
                                        <span id="lblGrandTotal"> <?php echo $expdata[0]->GrandTotal;?></span>
                                    </td>
                                </tr>
                             
                                 
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
    <!-- third section -->

    <!-- fourth section -->
 
    <!-- fourth section -->

    <!-- fifth section -->
   
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

</body>

</html>