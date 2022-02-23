<?php 
// var_dump($suppliers);
// die();
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-flash-1.6.1/b-print-1.6.1/datatables.min.css"/>
<link href="<?php echo base_url(); ?>/assets/expensereport/style.css" rel="stylesheet" />
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<!-- <link href="<?php echo base_url(); ?>/assets/expensereport/style.css" rel="stylesheet" /> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/expensereport/bootstrap.css" />
<section class="content-header">
  <h1>
      RECEIPT REPORT
            </h1>
          
          </section>
          <section  class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box box-success">
                <div class="box-header with-border" id="searchform">
<div class="row">
<form role="form" method="post" action=""> 
             
                <div class="col-md-2 form-group">
                  <input type="text" autocomplete="off" placeholder="yyyy-mm-dd" id="fromdate" name="date" class="form-control"/>
                </div>
                <div class="col-md-2 form-group">
                  <input type="text" autocomplete="off" placeholder="yyyy-mm-dd" id="todate" name="date" class="form-control"/>
                </div>
                <div class="col-md-1 form-group">
                <input type="button" class="btn btn-success" value="Show" id="show" onclick="get_receiptreport();"/>
                </div>
                <!-- <div class="col-md-1 form-group" id="printdiv">
              <button id="btnPrint" style="float: left;" class="btn btn-success" onclick="PrintPage()"><i class="fa fa-print"></i>Print</button>
              </div> -->
                                </form>
</div>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                    <table id="mytable1" class="table table-stripped">

                    <thead>
                        <tr role="row">
                         
                            <th>Date</th>
                            <th>Receipt#</th>
                            <th>Client Name</th>
                            <th>Payment Mode</th>
                            <th >Status</th>
                            <!-- <th>Job</th> -->
                            <th >Amount</th>
                          

                          </tr>

                          
                        </thead>
                        <tbody class="receiptreport" >
                            
                            </tbody>
                    </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


          </section>
          <script src="<?php echo base_url(); ?>/assets/user_scripts/reports/reports.js"></script>
          <script>
    $(document).ready(function(){
      var date_input=$('input[name="date"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'yyyy-mm-dd',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
     
     

    })
    
    </script>
    
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
            var backButton = document.getElementById("searchform");
            var nextButton = document.getElementById("printdiv");
            //  var footer = document.getElementsById("footer");
            // var HomeButton = document.getElementById("btnHome");

            //Set the print button visibility to 'hidden' 
            printButton.style.visibility = 'hidden';
            backButton.style.visibility = 'hidden';
            nextButton.style.visibility = 'hidden';
            // footer.style.visibility = 'hidden';
            // HomeButton.style.visibility = 'hidden';

            window.print()

        }
    </script>
      <script src="<?php echo base_url(); ?>/assets/user_scripts/reports/reports.js"></script>
