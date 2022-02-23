<?php
// var_dump($details);
// die();
$from=date('yy-m-d',strtotime("-1 days"));
$to=date('yy-m-d',strtotime("0 days"));
?>
<script src="<?php echo base_url(); ?>/assets/user_scripts/accounts/day_book.js"></script>

<section class="content-header">
            <h1>
        Day Book
       
            </h1>
          
          </section>
          
          <section class="content">
          <form role="form" method="post" action="<?php echo base_url();?>find-day-book"> 

          <div class="row">
           <div class="col-md-12">

          <div class="box box-success">
          <div class="box-body" style="min-height:auto;">
                 
                    <div class=" row">
                    <div class="form-group col-md-3">
                    <label for="from">From</label>
                      <input type="date" class="form-control" required id="from" name="from" value="<?php  echo $from;?>">
                    </div>
                    <div class="form-group col-md-3">
                    <label for="to">To</label>
                      <input type="date" class="form-control" required id="to" name="to" value="<?php  echo $to;?>">
                    </div>
                    <div class="form-group col-md-2">
                  
                    <!-- <button type="button" style="margin-top: 25px;" class="btn btn-success" id="find" onclick="finddata();" name="find">Find</button> -->
                  <input type="submit" style="margin-top: 25px;" class="btn btn-success" id="find" value="Find" name="find"></input>
                  </div>
                    <div class="form-group col-md-2">
                    <button type="button"  style="margin-top: 25px;" class="btn btn-success" id="print" onclick="printDiv('divexport')" name="print">Print</button>

                    </div>
                    <div class="form-group col-md-2">
                    <!-- <button type="button" style="margin-top: 25px;" class="btn btn-success" id="export" name="export">Export Excel</button> -->
<input type="submit" style="margin-top: 25px;" class="btn btn-success" id="export" name="export" value="Export Excel"></input>
                    </div>
                    </div>
                    
                   </div>
          <div class="box-body" id="divexport">

                        <table cellspacing="0" rules="all" border="1" id="div" style="width:100%;border-collapse:collapse;">
                       <tbody>
                       <tr>
                          <th scope="col">
                           <div id="CashbookmHead" style=" width:100%;  background-color: #3c8dbc;     height: 30px;
    padding-top: 6px;">
                           <div style=" width:10%; float:left; padding-left:10px;">Date</div>
                           <div style=" width:90%; float:left; height: 23px;">
                           <div style=" width:54%; float:left;">Particular</div>
                           <div style=" width:22%; float:left;">Voucher Type</div>
                           <div style=" width:12%; float:left; text-align:right;">Credit</div>
                           <div style=" width:12%; float:left; text-align:right; padding-right:10px;"> Debit</div>
                           </div>
                           </div>
                          </th>
                        </tr>
                         <?php    
                     $previousdate="";
                     $credittotal=0;
                     $debittotal=0;
                     foreach ($details as $key => $values){
                      
                           if(($previousdate!=$values->TransferDate)&&($previousdate!=""))  
                           { ?>
                        <tr>
                        <td>
                         
                             <div ID="Totalofall" style=" width:100%; font-weight: bold; color:red; font-size: 15px; ">
                                                                 <div style=" width:80%; padding-left:10%; float:left;">
                                                                     Total</div>
                                                                 <div style=" width:9%; float:left; text-align:right;  border-bottom-style: solid; border-bottom-width: 1px; border-color:Black ">
                                                                     <Label id="lblCreditTotal" style="padding-right:10px;"><?php echo number_format((float)$credittotal, 2, '.', '');; ?></Label></div>
                                                                 <div style=" width:11%; float:left; text-align:right;  border-bottom-style: solid; border-bottom-width: 1px; border-color:Black   ">
                                                                                                  <Label id="lblDebitTotal"><?php echo number_format((float)$debittotal, 2, '.', ''); ?></Label></div>

                      </td>
                        </tr>
                          <?php  $credittotal=0;
                     $debittotal=0; } if($previousdate!=$values->TransferDate) {$cdate=$values->TransferDate;}else{$cdate="&nbsp";}  ?>
                     
                      <tr>
                        <td>
                        
                         <div id="Cashbook" style=" width:100%;">
                       
                           <div style=" width:10%; float:left;padding-left:10px;"><?php  echo $cdate ; ?></div>
                           <div style=" width:90%; float:left; height: 23px;">
                           <div style=" width:54%; float:left;"> <a href="#" data-toggle="tooltip" title="<?php echo $values->Narration; ?>"><?php  echo $values->PARTICULARLS; ?></a> </div>
                           <div style=" width:22%; float:left;"> <?php echo $values->VoucherType; ?></div>
                           <div style=" width:12%; float:left; text-align:right;"><?php  echo $values->CreditAmount; ?></div>
                           <div style=" width:12%; float:left; text-align:right; padding-right:10px;"> <?php  echo $values->Amount; ?></div>
                           </div>
                           </div>
                      </td>
                        </tr>
                       
                     <?php $previousdate=$values->TransferDate ;
                      $credittotal=$credittotal+( (float)$values->CreditAmount);
                       $debittotal=$debittotal+( (float)$values->Amount);
                      //  echo '<script> alert("'.$debittotal.'");</script>a';
                     }  ?>
                         <tr>
                        <td>
                         
                             <div ID="Totalofall" style=" width:100%; font-weight: bold; color:red; font-size: 15px; ">
                                                                 <div style=" width:80%; padding-left:10%; float:left;">
                                                                     Total</div>
                                                                 <div style=" width:9%; float:left; text-align:right;  border-bottom-style: solid; border-bottom-width: 1px; border-color:Black ">
                                                                     <Label id="lblCreditTotal" style="padding-right:10px;"><?php echo number_format((float)$credittotal, 2, '.', '');; ?></Label></div>
                                                                 <div style=" width:11%; float:left; text-align:right;  border-bottom-style: solid; border-bottom-width: 1px; border-color:Black   ">
                                                                                       <Label id="lblDebitTotal"><?php echo number_format((float)$debittotal, 2, '.', ''); ?></Label></div>
           
                      </td>
                        </tr>
                        </tbody>
                       
                        </tr>
                        </table>




          </div>
          </div>
          </div>
                    </form>
          </section>
          <script language="javascript" type="text/javascript">
     function printDiv(divexport) {
         //Get the HTML of div
         var divElements = document.getElementById(divexport).innerHTML;
         //Get the HTML of whole page
         var oldPage = document.body.innerHTML;

         //Reset the page's HTML with div's HTML only
         document.body.innerHTML =
              "<html><head><title></title></head><body>" +
              divElements + "</body>";

         //Print Page
         window.print();

         //Restore orignal HTML
         document.body.innerHTML = oldPage;


     }
    </script>
      
          <script src="<?php echo base_url(); ?>/assets/js/moment.js"></script>
          <script src="<?php echo base_url(); ?>/assets/js/alert.js"></script>
          <!-- <script src="<?php echo base_url(); ?>/assets/user_scripts/accounts/day_book.js"></script> -->
        