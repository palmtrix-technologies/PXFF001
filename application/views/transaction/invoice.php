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
                            <td style="width:34%;" >
                            <img src="<?php echo IMAGE_PATH.$invoiceinfo[0]->Invheaderimage;?>" style="width:400px; alt="logo"></td>
                            <td style="width:34%;" >
      <div class="textcenters" style="display: flex; align-items: center; justify-content: margin-bottom: 15px; margin-top: 15px;">
                        <h3> Invoice No:   <?php echo $invoicedata[0]->Inv;?></h3>
                  
                    </div>
</td>
                            <td style="width:34%;" >
    <h3 style="padding:right;"> فاتورة</h3>
</td>
                        </tr>
                    </table>
                  
                    
                    <table class="table tab1" style="margin-bottom: -4px;">
                        <thead>


                            <tr>
                                <td  style="width: 34%;">
                                    <table class="cus-con">
                                        <tr>
                                            <td style="border: 1px solid black;"><span class="fl"><b>Customer</b></span> <span class="fr"><b>العميل</b></span></td>

                                        </tr>
                                        <tr style="height: 107px;">

                                            <td style="vertical-align: text-top; font-size: 13px;">
                                                <span id="lblClient"></span>
                                                
                                                      <?php echo $invoicedata[0]->clientenglish;?>
                                                        <br />
                                                      
                                                            <br />
                                                            <?php echo $invoicedata[0]->clientearabic;?>
                                                       
                                                    
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid black; border-right: hidden; border-left: hidden;"></td>
                                        </tr>
                                      

                                        <tr>
                                            <td style="border: 1px solid black;"><b>Shiper Details</b> <span class="fr"><b>تفاصيل الشاحن </b></span></td>
                                        </tr>
                                        <tr style="height: 93px; font-size: 13px;">

                                            <td style="vertical-align: text-top;">
                                                <p>
                                                    <span id="lblShiper">      <?php echo $invoicedata[0]->consignor;?></span>
                                                </p>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid black;"><b>Consignee Details</b> <span class="fr"><b>المرسل إليه </b></span></td>
                                        </tr>
                                        <tr style="height: 93px; font-size: 13px;">

                                            <td style="vertical-align: text-top;">
                                          <?php echo $invoicedata[0]->consignee;?>
                                                    
                                            </td>
                                        </tr>
                                       
                                      

                                    </table>
                                </td>
                                <td style="width: 33%;">
                                    <table class="cus-con" >

                                        
                                                <tr>
                                                    <td style="border: 1px solid black;"><span class="fl"><b>Invoice No</b> </span><span class="fr"><b>رقم الفاتورة </b></span></td>

                                                </tr>
                                                <tr>

                                                    <td style="height: 33px; font-size: 13px;">
                                                      <?php echo $invoicedata[0]->Inv;?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border: 1px solid black; border-right: hidden; border-left: hidden;"></td>
                                                </tr>
                                                <tr>
                                                    <td style="border: 1px solid black;"><b>Invoice Date</b><span class="fr"><b> تاريخ الفاتورة </b></span></td>
                                                </tr>
                                                <tr>

                                                    <td style="height: 33px; font-size: 13px;">
                                                    <?php echo $invoicedata[0]->Date;?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border: 1px solid black; border-right: hidden; border-left: hidden;"></td>
                                                </tr>
                                               
                                                <tr>
                                                    <td style="border: 1px solid black;"><b>Awb / Mwl</b><span class="fr">--</span> </td>
                                                </tr>
                                                <tr>

                                                    <td style="height: 33px; font-size: 13px;"><?php echo $invoicedata[0]->awb;?> <?php echo $invoicedata[0]->hblmbl;?>
                                                        
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="border: 1px solid black; border-right: hidden; border-left: hidden;"></td>
                                                </tr>
                                                <tr>
                                                    <td style="border: 1px solid black;"><b>Weight</b><span class="fr"><b>الوزن </b></span></td>
                                                </tr>
                                                <tr>

                                                    <td style="height: 33px; font-size: 13px;"><?php echo $invoicedata[0]->ActualWeight;?> &nbsp;&nbsp;KGS
                                                    </td>
                                                </tr>
                                              

                                               
                                                <tr>

                                                    <td style="height: 33px; font-size: 13px;">
                              
                                                    </td>
                                                </tr>
                                            
                                         <tr>
                                            <td style="border: 1px solid black; border-right: hidden; border-left: hidden;"></td>
                                        </tr>
                                         <tr>
                                                    <td style="border: 1px solid black;"><b>Custumer P.O / Date</b> <span class="fr"><b>رقم طلب الشراء / تاريخه </b></span></td>
                                                </tr>
                                                <tr>

                                                    <td style="height: 50px; font-size: 13px;">
                                                        <span id="lblPono"><?php echo $invoicedata[0]->PoNo;?></span>
                                                    </td>
                                                </tr>
                                               
                                    </table>
                                </td>
                                <td  style="width: 33%;">
                                    <table class="cus-con">

                                        <tr>
                                            <td style="border: 1px solid black;"><b>Bank Details</b><span class="fr"> <b>تفاصيل البنكية</b> </span></td>
                                        </tr>

                                        <tr style="height: 90px;">

                                            <td style="vertical-align: text-top; font-size: 13px;">
                                                
                                            <?php echo $invoicedata[0]->bank;?><br />
                                                       
                                                    
                                            </td>

                                        </tr>


                                        <tr>
                                            <td style="border: 1px solid black; border-right: hidden; border-left: hidden;"></td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid black;"><b>Job No</b><span class="fr"><b>رقم العمل</b>  </span></td>
                                        </tr>
                                        <tr>

                                            <td style="height: 33px!important; font-size: 13px;">
                                                <span id="lblJobNo"><?php echo $invoicedata[0]->Number;?></span>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="border: 1px solid black; border-right: hidden; border-left: hidden;"></td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid black;"><b>Customer VAT No.</b><span class="fr"><b>رقم ضريبة القيمة المضافة للعميل</b>  </span></td>
                                        </tr>
                                        <tr>

                                            <td style="height: 33px!important; font-size: 13px;">
                                                <span id="lblCustomerVat"><?php echo $invoicedata[0]->vat_no;?></span>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="border: 1px solid black; border-right: hidden; border-left: hidden;"></td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid black;"><b>Estimated Time of Departure</b><span class="fr"><b>رقم المورد</b>  </span></td>
                                        </tr>
                                        <tr>

                                            <td style="height: 33px!important; font-size: 13px;">
                                                <span id="lblVendorId"><?php echo $invoicedata[0]->Etd;?></span>

                                            </td>
                                        </tr>

                                           <tr>
                                            <td style="border: 1px solid black;"><b>Estimated Time of Arrival</b><span class="fr"><b>رقم المورد</b>  </span></td>
                                        </tr>
                                        <tr>

                                            <td style="height: 33px!important; font-size: 13px;">
                                                <span id="lblEta"><?php echo $invoicedata[0]->Eta;?></span>

                                            </td>
                                        </tr>


                                    </table>
                                </td>
                            </tr>
                        </thead>

                    </table>

                    <div style="margin-left: 8px;">
                        <table class="table table-bordered tab2 m-b-1">
                            <thead>
                                <tr>
                                    <th class="ctr" width="6.5%"><b>Sl No:</b>
                                        <label>
                                            الرقم السلسل
                                        </label>
                                    </th>
                                    <th width="46.2%">Item Description
                                        <label class="rtl">وصف البند </label>
                                    </th>
                                    <th class="ctr" width="10.5%">Unit Price
                                        <label>سعر الوحدة </label>
                                    </th>
                                    <th class="ctr" width="10%">Qty
                                        <label>الكمية </label>
                                    </th>
                                    <th width="15.2%">Vat 
                                        <label class="rtl">ضريبة القيمة المضافة</label></th>
                                    <th width="12.3%">Amount
                                        <label class="rtl">المبلغ </label>
                                    </th>
                                </tr>
                            </thead>
                             <tbody>
                                
                                      <?php 
                                    //   echo '<pre>';
                                    //   var_dump($invoice);
                                    //   die();
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
                                                <span id="rptrDetail_lblDescAr_0" style="float: right;"><?php echo $value->description_arabic;?> </span>
                                            </td>
                                            <td style="text-align: center;">
                                            <?php echo $value->UnitPrice;?> - <?=  $value->Currency; ?>
                                            </td>
                                            <td style="text-align: center;">
                                              <?php echo $value->Quantity;?>
                                            </td>
                                            <td style="text-align: center;">   <?php echo $value->Vat;?></td>
                                            <td style="text-align: center;" data-price="<?=  $value->UnitPrice; ?>" data-qty="<?=  $value->Quantity; ?>" class="currency">
                                             <?php echo $totalval  ?>
                                            </td>
                                        </tr>
                                    
                                      <?php } ?>
                            </tbody>
                        </table>
                        <table class="table table-bordered tab3 ">
                            <tbody>
                                <tr>
                                    <td colspan="2" style="width: 53.43%;">TOTAL INVOICE AMOUNT IN SAUDI RIYALS
                                        <label class="rtl">المجموع الكلي للفاتورة بالريال السعودي</label></td>
                                    <td colspan="3" >Total
                                        <label class="rtl"><b>المجموع</b></label>
                                    </td>

                                    <td style="text-align: center; width:12.6%">
                                        <span id="lblTotal"> <?php echo $invoicedata[0]->Total;?></span>
                                    </td>
                                </tr>
                                <tr>
                                       <td colspan="2" >VALUE ADDED TAX (VAT) @ <?= $totalvatper; ?>%
                                        <label class="rtl"><?= $totalvatper; ?>%   ضريبة القيمة المضافة - القيمة الاعتيادية </label>

                                    </td>
                                    <td colspan="3">Vat Total
                                        <label class="rtl">ضريبة القيمة المضافة</label></td>
                                    <td style="text-align: center;">
                                        <span id="lblVatTotal"> <?php echo $invoicedata[0]->VatTotal;?></span></td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        <p style="font-weight: inherit; font-size: 15px; text-align: right; padding-right: 153px;">Advance Amount</p>
                                    </td>
                                    <td  colspan="3" style="text-align: center;">
                                        <span id="lblAdv">0.00</span></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <p class="totalamt" style=" text-transform: uppercase;" id="demo">
                                            <span style="font-weight: 700; font-size: 13px;"></span><span id="container" class="word"></span>
                                            SAR&nbsp;Only
                                        </p>
                                    </td>

                                    <td colspan="3" >GRAND TOTAL
                                        <label class="rtl">المجموع الكلي</label></td>

                                    <td  style="text-align: center;">
                                        <span id="lblGrandTotal"> <?php echo $invoicedata[0]->GrandTotal;?></span>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                        <div class="f-fix">
                            <table class="table table-bordered tab3" style="margin-bottom: 3px;">


                                <tbody>
                                    <tr>
                                        <td width="550">
                                            <p class="tab3-p1">
                                                ANY DISCREPANCIES SHALL BE MARKED OFF IN THIS INVOICE WITHIN 3 WORKING DAYS AFTER RECEIPT OF INVOICE AND CONFIRM IN WRITING TO VD (AS PER BELOW ADDRESS), OTHERWISE NO CLAIMS SHALL BE CONSIDERED.
                                            </p>
                                        </td>
                                        <td style="width: 500px;">
                                            <p class="rtl tab3-p2">
                                                في حال وجود أي مشكلة في الفاتورة يجب أن يتم إبلاغ شركتنا عنها في مدة لا تزيد عن ثلاثة أيام عمل من تاريخ استلام هذه الفاتورة. ويجب أن يكون الإبلاغ خطياً (على عنوان الشركة الموضح أدناه) وإلا فلن يتم التعامل من قبلنا مع المشكلة


                                            </p>
                                        </td>

                                    </tr>

                                </tbody>

                            </table>
                            <table class="table table-bordered " style="font-weight:bold">
                            <tbody>
                    <tr>
                        <td class="b-zero" width="250" style="line-height: 8px;">
                          <b> <h5 style="font-weight:bold"><?php echo $companyinfo[0]->Address;?></h5></b>
                           

                            <p>Tel/Fax: <?php echo $companyinfo[0]->Phone;?> <?php echo $companyinfo[0]->FAX;?></p>
  
                        </td>
                        <td  style="line-height: 14px;" width="150">
                            <p>
                                VAT:<?php echo $companyinfo[0]->VAT;?></p>

                            <p> CR:<?php echo $companyinfo[0]->CR;?></p>
                            <p>Email:<?php echo $companyinfo[0]->Email;?></p>
                            <p>Web:<?php echo $companyinfo[0]->Web;?></</p>
                        </td>
                        <td width="280">
                   <p style="font-weight:normal">
Terms:a)Cheque should be made in crossed a/c payee,The establishment is not responsible for any cash payment without an official receipts,
 </p>

 <b>This is computer generated invoice copy,Sign&stamp not required.</b>
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


