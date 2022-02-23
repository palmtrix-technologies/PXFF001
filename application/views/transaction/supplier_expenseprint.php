
<?php 
// var_dump($companyinfo);
// die();
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1"><title>
<?php echo $companyinfo[0]->Cmpny_name;?>
</title>
 <link rel = "icon" href = "<?php echo IMAGE_PATH.$companyinfo[0]->Icon_image;?> "width="30px" height="30px"> 
<link href="<?php echo base_url(); ?>/assets/expensereport/style.css" rel="stylesheet" />

<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/expensereport/bootstrap.css" />
    <style>
        @media print
        {
            .f-fix
            {
                position: fixed;
                bottom: 0;
            }

            .fr
            {
                padding-right: 17px;
            }

            @page
            {
                margin-top: 0; /* this affects the margin in the printer settings */
                margin-bottom: 0;
            }
        }
    </style>
</head>
<body>
  
            <div class="container" style="display: flex; align-items: center;  ">
                <div class="row">
                    <a id="btnHome" style="float: left;" href="<?php echo base_url(); ?>user-home" class="btn btn-default">Home</a>
                    <a id="btnBack" style="float: left;" href="<?php echo base_url(); ?>job-search" class="btn btn-default">Make Another Invoice</a>
                    <button id="btnPrint" style="float: left;" class="btn btn-success" onclick="PrintPage()"><i class="fa fa-print"></i>Print</button>

                    <div style="position: absolute; left: 41%;">
                        <a id="lbtnPrev" href="javascript:__doPostBack(&#39;lbtnPrev&#39;,&#39;&#39;)"><i class="fa fa-arrow-circle-o-left" style="font-size: 27px;" aria-hidden="true"></i></a>&nbsp;&nbsp;
                                <a id="lbtnNext" href="javascript:__doPostBack(&#39;lbtnNext&#39;,&#39;&#39;)"><i class="fa fa-arrow-circle-o-right" style="font-size: 27px;" aria-hidden="true"></i></a>
                    </div>

                    <table style="width: 1070px; margin-bottom: -1px; margin-top: 40px;">
                        <tr>
                            <td>
                            <img src="<?php echo IMAGE_PATH.$invoiceinfo[0]->Invheaderimage;?>" style="width: 90%;" alt="logo"></td>

                        </tr>
                    </table>
                    <div class="textcenters" style="display: flex; align-items: center; justify-content: center; border-top: solid #7d7676 1px; border-bottom: solid #7d7676 1px; border-left: solid #7d7676 1px; border-right: solid #7d7676 1px; margin-bottom: 15px; margin-top: 15px;">
                        <h3>Supplier Expense<br />
                        حساب المورد
                    </div>
                    
             

                    <div >
                 
                        <div class="f-fix">
                      
                        <table class="table table-bordered tab3" style="margin-bottom: 3px;  border-collapse: collapse;border: 1px solid black;  color: black; width: 100%;" >


<tbody >
    <tr>
        <td >
            <b>PI No.
            </b>
        </td>
        <td width="25%" colspan="2" >
        <?php echo ":  ".$expdata[0]->PostId;?>
        </td>
        <td width="20%">
       <b>GL Date</b>
        </td>
        <td width="25%" colspan="2">
      
        <?php echo  ":  ".$expdata[0]->PostingDate;?>
        </td>
    </tr>
     <tr style="border-top-style: hidden;">
        <td width="25%">
            <b>A/c Name
            </b>
        </td>
        <td width="25%" colspan="2">
        <?php echo  ":  ".$expdata[0]->supplier_name;?>
        </td>
        <td width="25%">
       <b></b>
        </td>
        <td width="25%" colspan="2">
        <!-- <?php echo  ":  ".$expdata[0]->Number;?> -->
        </td>
    </tr>
    <tr style="border-top-style: hidden;">
        <td width="25%">
            <b>Client
            </b>
        </td>
        <td width="25%" colspan="2">
        <?php echo  ":  ".$expdata[0]->clientenglish;?>
        </td>
        <td width="25%">
       <b>Invoice Date</b>
        </td>
        <td width="25%" colspan="2">
        <?php echo  ":  ".$expdata[0]->InvDate;?>
        </td>
    </tr>
    <tr style="border-top-style: hidden;"> 
    
        <td width="25%">
            <b>HAWB / HBL
            </b>
        </td>
        <td width="25%" colspan="2">
        <?php echo  ":  ".$expdata[0]->hawb;?>
        </td>
        <td width="25%">
       <b>MAWB / MBL</b>
        </td>
        <td width="25%" colspan="2">
        <?php echo  ":  ".$expdata[0]->mawb;?>
        </td>
    </tr>
   
    <tr style="border-top-style: hidden;">
        <td width="25%">
            <b>Ref No.
            </b>
        </td>
        <td width="25%" colspan="2">
        <?php echo  ":  ".$expdata[0]->Reference;?>
        </td>
        <td width="25%">
       <b>Job No.</b>
        </td>
        <td width="25%" colspan="2">
        <?php echo  ":  ".$expdata[0]->Number;?>
        </td>
    </tr>
    <!-- </tbody>

</table>
<table class="table  tab3" style="margin-bottom: 3px;  border-collapse: collapse; border: 1px solid black;  color: black; width: 100%;" >


<tbody> -->
    <tr >
        <td width="20%">
           <b>SL
            </b>
        </td>
        <td width="20%">
        <b>Narration.
            </b>
        </td>
        <td width="20%">
       <b>Unit Price</b>
        </td>
        <td width="20%">
        <b>Vat
            </b>        </td>
        <td width="20%" colspan="2">
        <b>Amount (SAR)

            </b>        </td>
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
                                                <!-- <span id="rptrDetail_lblDescAr_0" style="float: right;">رسوم الشحن البري </span> -->
                                            </td>
                                            <td>
                                            <?php echo $value->Amount;?> 
                                            </td>
                                            <!-- <td style="text-align: center;">
                                         
                                            </td> -->
                                            <td>   <?php echo $value->Vat;?></td>
                                            <td colspan="2">
                                            <?php echo $value->Total;?>
                                            </td>
                                        </tr>
                                    
                                      <?php } ?>
                                     
<!-- </tbody>

</table> -->

<br>
<!-- <table class="table  tab3" style=" border-collapse: collapse;border: 1px solid black;  color: black; width: 100%;" >
                            <tbody>
                            
                            -->
                            
                                <tr >
                                    <td colspan="4">
                                        <p class="totalamt" style=" text-transform: uppercase; text-align:center;" id="demo">
                                            <span style="font-weight: 700; font-size: 13px;"></span><span id="container" class="word"></span>
                                            SAR&nbsp;Only
                                        </p>
                                    </td>

                                    <!-- <td colspan="2" >GRAND TOTAL
                                        <label class="rtl">المبلغ الإجمالي</label></td> -->

                                    <td  style="text-align: left;" colspan="2">
                                        <span id="lblGrandTotal"> <?php echo $expdata[0]->GrandTotal;?></span>
                                    </td>
                                </tr>
                              <tr>
                              <td colspan="5"  height="280">
                                      
                                    </td>
                              </tr>
                                 
                            </tbody>
                        </table>

                            <table class="table table-bordered " style="font-weight:bold">
                <tbody>
                    <tr>
                        <td class="b-zero" width="280" style="line-height: 15px;">
                            <p class=""><?php echo $companyinfo[0]->Address;?></p>
                           

                            <p>Tel/Fax: <?php echo $companyinfo[0]->Phone;?> / <?php echo $companyinfo[0]->FAX;?></p>
  
                        </td>
                        <td width="120" style="line-height: 14px;">
                            <p>
                                VAT. : <?php echo $companyinfo[0]->VAT;?></p>

                            <p> CR: <?php echo $companyinfo[0]->CR;?></p>
                            <p>Email: <?php echo $companyinfo[0]->Email;?></p>
                            <p>Web : <?php echo $companyinfo[0]->Web;?></</p>
                        </td>
                        <td width="280">
                            <p>This is a computer genarated document and does not require a signature </p>
                        </td>

                    </tr>

                </tbody>
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


