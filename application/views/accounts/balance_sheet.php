<?php 
  // Year to start available options at

  $earliest_year = 2010; 
  // Set your latest year you want in the range, in this case we use PHP to just set it to the current year.
  $latest_year = date('Y'); 
?>

<section class="content-header">
 <h1>
 Ledger Group
 </h1>
</section>
 <section class="content">
    <div class="box box-success">
       <div class="box-body">
          <form role="form"   method="post"  action="<?php echo base_url();?>find-balance-sheet">                                                                                                                                                                                                                                                                                                                                                                          
                  <div class="box-body"  style="min-height:100px;">
                             
                  <div class="row">                         
                  <div class="form-group col-md-3 ">
                      <label>Financial Year</label>
                      <select class="form-control" required name="financial_year" id="financial_year" value="">
                      <option value="" selected="selected" diabled="disabled">----Select----</option>
                     <?php
                        for ($i=$earliest_year;$i<=$latest_year;$i++) 
                        {
                            $j=$i+1;
                            ?>

                       <option value="<?php echo $i;?>"><?php echo  "$i-$j";?></option>
  <?php
}
  ?>
                      </select>
                      </div>
                      <div class="form-group col-md-2">
                  
                  <input type="submit" style="margin-top: 25px;" class="btn btn-success" id="find" name="find" value="Find"></input>

                </div>
                <div class="form-group col-md-2">
                    <button type="button"  style="margin-top: 25px;" class="btn btn-success" id="print" onclick="printDiv('divexport')" name="print">Print</button>

                    </div>
                                
                         
</div>
                 
                </form>
              
              
                <div id="divexport">
                                 <div id="ContentPlaceHolder1_up_GridLedgerAccountsDetails">
	

               
                                 <div style="width:98%; float:none;">
                                
                                

                                <div id="Balancesheet" style=" background-color:White;color: gray; font-size:15px ">

    <div>
    <div id=" Liability" style=" width:49%; float:left; clear:both ">
    <div style=" background-color:rgba(82, 107, 1, 1); color:White; border-color:White; border-style:solid; border-width:1px;border:solid 1px gray">
    <div style=" width:70%; float:left; padding:2px;">Liability</div>
    <div style=" width:25%;text-align:right; float:right; padding:2px;">Amount</div>
    <div style=" clear:both"></div>
    </div>
    <?php 
         $totalliability=0;
         $totalassets=0;              
                       if($data!=""){  ?>
     <!-- <div style=" clear:both;">ss</div> -->
    <?php
    foreach ($liabilitydata as $val)
    {
        if($val->DebitAccount==0)
        {
            $amount=$val->Credit;
        }
        else{
            $amount=$val->DebitAccount;
        }
        ?>
    
    <div style=" clear:both;"></div>

     <div style=" clear:both;"></div>
     <div style=" width:50%; float:left;"><?php echo $val->Ledger_Name;?></div>
    <div style=" width:48%;text-align:right;float:right; "><?php echo $amount;?></div>
    <?php
    $totalliability=$totalliability+$amount;
    }
}
    ?>
        </div>

    </div>
    
    <div id="Asset" style=" width:50%; float:right;">
     <div style=" background-color:rgba(82, 107, 1, 1); color:White; border-color:White; border-style:solid; border-width:1px;border:solid 1px gray">
    <div style=" width:70%; float:left; padding:2px;">Asset</div>
     <div style=" width:25%;text-align:right; float:right; padding:2px;">Amount</div>
    <div style=" clear:both"></div>
    
    </div>
    <?php 
                       
                       if($data!=""){  ?>
     <!-- <div style=" clear:both;">ss</div> -->
    <?php
    foreach ($assetdata as $val)
    {
      
            if($val->DebitAccount==0)
            {
                $amountasset=$val->Credit;
            }
            else{
                $amountasset=$val->DebitAccount;
            }
            ?>
      
       
       

        <div style=" width:50%; float:left;"><?php echo $val->Ledger_Name;?></div>
    <div style=" width:48%;text-align:right;float:right; "><?php echo $amountasset;?></div>
    <?php
             $totalassets=$totalassets+$amountasset;            

    }
    $inc=0;
    $exp=0;
	foreach($incomedata as $key => $val){
        if($val->DebitAccount==0)
        {
            $amt=$val->Credit;
        }
        else{
            $amt=$val->DebitAccount;
        }
      $inc=$inc+$amt;
     }
     foreach($expensedata as $key => $val){
        if($val->DebitAccount==0)
        {
            $amt1=$val->Credit;
        }
        else{
            $amt1=$val->DebitAccount;
        }
      $exp=$exp+$amt1;
     }
     if($exp<$inc)
     {
        $profit=$inc-$exp;

     }
     else{
        $profit=$exp-$inc;

     }
// echo "<br/>";

// echo $amt;
// echo "<br/>";
// echo $amt1;
    ?>
    
    <div style=" width:50%; float:left;">Profit & Loss A/C</div>
<div style=" width:48%;text-align:right;float:right; "><?php echo  $profit;?></div>

    <?php
}

    ?>

   

    </div>

    </div>

     <div style=" clear:both;"></div>
    <div id="Total">
    <div id="Total Liability" style=" width:49%; float:left;border:solid 1px gray ">

     

    <div style=" background-color:Gray; color:White;border-color:White; border-style:solid; border-width:1px;">
     <div style=" width:70%; float:left; padding:2px;">Total Liability </div>
    <div style=" width:25%; text-align:right;float:right; padding:2px;">
        <span id="ContentPlaceHolder1_lblTotalLiab"></span><?php echo $totalliability;?></div>
     <div style=" clear:both;"></div>
    </div>
  
    </div>
 
    <div id="TotalAsset" style=" width:50%; float:right;border:solid 1px gray">

    <div style=" background-color:Gray; color:White;border-color:White; border-style:solid; border-width:1px;">
     <div style=" width:70%; float:left; padding:2px;">Total Asset </div>
    <div style=" width:25%;text-align:right;float:right ; padding:2px;">
        <span id="ContentPlaceHolder1_lblTotalAsset"></span><?php echo $totalassets;?></div>
     <div style=" clear:both;"></div>
    </div>

    </div>
    
</div>

 <div style=" clear:both;"></div>

    </div>

                              
       </div>
                             
&nbsp;
    
</div>
                                 </div>
</div>
</div>
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