
   

<section class="content">
   <div class="row">
      <div class="col-md-12">
         <div class="box box-success">
                  <div class="box-header with-border">
                    <h3>TRIAL BALANCE</h3>
                  </div>
                  <div class="box-body"  style="min-height:auto;">
                    <form action="trial-balanceview" method="post">
                     <div class="row" id="searchh">
                        <div class="form-group col-md-3" >
                           <label for="from" id="lblfrom">From</label>
                           <input type="date" id="txtdate" class="form-control" required id="from" name="from" value="<?php echo date('yy/m/d');?>">
                        </div>
                       
                        <div class="form-group col-md-1">
                           <button type="SUBMIT" style="margin-top: 25px;" class="btn btn-success" id="find" name="find">Find</button>
                        </div>
                        <div class="form-group col-md-1">
                           <!-- <button type="button"  style="margin-top: 25px;" class="btn btn-success" id="print" name="print">Print</button> -->
                           <button type="button" id="btnPrint" style="margin-top: 25px;" class="btn btn-success" onclick="PrintPage();"><i class="fa fa-print"></i>Print</button>                        
                        </div>
                        <div class="col-md-12">
                          <hr>
                        </div>
                     </div>
                     </form>
                  </div>
                  <div class="box-body">
                  <div class="row">
                    <div class="col-md-7" >
                    <table class="table">
                      <thead style="background-color:#3c8dbc;">
                          <tr>
                            <th style="width:500px">Ledger</th>
                            <th style="text-align:right;"> Debit Balance</th>
                            <th style="text-align:right;">Credit Balance</th>
                          <tr>
                      </thead>
                      <tbody>
                        <?php 
                        
                     $credittotal=0;
                     $debittotal=0;
                         foreach ($Trialbalance as $key => $values){
                           $credittotal=$credittotal+( (float)$values->Credit);
                       $debittotal=$debittotal+( (float)$values->DebitAccount);
                        ?>
                          <tr>
                            <td><?php echo $values->Ledger_Name; ?></td>
                            <td style="text-align:right;"><?php echo number_format((float)$values->DebitAccount, 2, '.', ''); ?></td>
                            <td style="text-align:right;"><?php echo number_format((float)$values->Credit, 2, '.', ''); ?></td>
                          </tr>
                        <?php } ?>
                        <tr style="background-color:#f5f5f5; font-weight:500;">
                            <td>Total</td>
                            <td style="text-align:right;"><?php echo number_format((float)$debittotal, 2, '.', ''); ?></td>
                            <td style="text-align:right;"><?php echo number_format((float)$credittotal, 2, '.', ''); ?></td>
                          </tr>
                      </tbody>
                    </table>
                    </div>
                  </div>
             
         </div>
      </div>
   </div>
</section>
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
        // var backButton = document.getElementById("searchform");
         var lblfrom = document.getElementById("searchh");
          // var txtdate = document.getElementsById("txtdate");
        var findbutton = document.getElementById("find");

        //Set the print button visibility to 'hidden' 
        //printButton.style.visibility = 'hidden';
        // backButton.style.visibility = 'hidden';
        lblfrom.style.display = 'none';
        // txtdate.style.visibility = 'hidden';
        findbutton.style.display = 'none';


        window.print()

    }
</script>