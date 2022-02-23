

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1"><title>
	AOT
</title>
<link href="<?php echo base_url(); ?>/assets/expensereport/style.css" rel="stylesheet" />

<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/expensereport/bootstrap.css" />
<style>
  .ui-autocomplete {
    position: absolute;
    z-index: 1000;
    cursor: default;
    padding: 0;
    margin-top: 2px;
    list-style: none;
    background-color: #ffffff;
    border: 1px solid #ccc;
    -webkit-border-radius: 5px;
       -moz-border-radius: 5px;
            border-radius: 5px;
    -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
       -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
}
.ui-autocomplete > li {
  padding: 3px 20px;
}
.ui-autocomplete > li.ui-state-focus {
  background-color: #DDD;
}
.ui-helper-hidden-accessible {
  display: none;
}
  </style>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
</head>
<body>
  <br><br>

  <div class="col-md-8 form-group">
      <label>Client</label>
      <input type="text" id="client_name">
      <label>From</label>
      <input type="text" name="date" id="fromdate">
      <label>To</label>
      <input type="text" name="date" id="todate">
      <input type="button" value="Search" id="clientsearch"></input>
    </div>
            <div class="container">
                <div class="row">
                    <a id="btnHome" style="float: left;" href="<?php echo base_url(); ?>Home" class="btn btn-default">Home</a>
                    <!-- <a id="btnBack" style="float: left;" href="<?php echo base_url(); ?>debit-note" class="btn btn-default">Make Another Invoice</a> -->
                    <button id="btnPrint" style="float: left;" class="btn btn-success" onclick="PrintPage()"><i class="fa fa-print"></i>Print</button>

                    <!-- <div style="position: absolute; left: 41%;">
                        <a id="lbtnPrev" href="javascript:__doPostBack(&#39;lbtnPrev&#39;,&#39;&#39;)"><i class="fa fa-arrow-circle-o-left" style="font-size: 27px;" aria-hidden="true"></i></a>&nbsp;&nbsp;
                                <a id="lbtnNext" href="javascript:__doPostBack(&#39;lbtnNext&#39;,&#39;&#39;)"><i class="fa fa-arrow-circle-o-right" style="font-size: 27px;" aria-hidden="true"></i></a>
                    </div> -->

                    <table style="width: 1070px; margin-bottom: -1px; margin-top: 40px;">
                        <!-- <tr>
                            <td>
                                <img src="<?php echo base_url(); ?>/assets/expensereport/invhead.jpg" style="width: 100%;" alt="logo"></td>

                        </tr> -->
                    </table>
                    </div>
                    <br><br><br><br>
                    <div class="textcenters" style="display: flex; align-items: center; justify-content: center; border-top: solid #7d7676 1px; border-bottom: solid #7d7676 1px; margin-bottom: 15px; margin-top: 15px;">
                        <h3>client name and date <br />
                    
                    </div>
                    
                    <table class="table tab1" style="margin-bottom: -4px;">
                        <thead>


                          
                        </thead>

                    </table>

                    <div style="margin-left: 8px;">
                        <table class="table table-bordered tab2 m-b-1">
                            <thead>
                                <tr>
                                <th class="column-title">Date</th>
                              <th class="column-title">Purticular</th>
                              <th class="column-title">Invoice</th>
                              <th class="column-title">Voucher type</th>
                              <th class="column-title">Credit</th>
                              <th class="column-title">Debit</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                     
                                    
                                        <tr>
                                            <td style="text-align: center;">
                                               
                                            </td>
                                            <td>
                                                
                                            </td>
                                            <td style="text-align: center;">
                                           
                                            </td>
                                            <td style="text-align: center;">
                                         
                                            </td>
                                            <td style="text-align: center;">  
                                         </td>
                                            <td style="text-align: center;">
                                          
                                            </td>
                                        </tr>
                                    
                                     
                            </tbody>
                        </table>
                        <br>
                       

                        <div class="f-fix">
                         
                        </div>

                    </div>
                </div>
            </div>
       

    </div>



    <!-- jQuery -->

    
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
     <!-- <script src="<?php echo base_url(); ?>/assets/user_scripts/searchclient/client_search.js"></script> -->
    <script>
          $(document).ready(function(){
  

  var obj=[];
              $.ajax({
               url: "<?php echo base_url(); ?>clientsearch/Client_Search/getclientdata",
               type: 'post',
               dataType: "json",
               success: function( data ) 
               {
                   console.log(data);
                obj=data;
            
                $('#client_name').autocomplete({
                              source: obj,
                              select: function (event, ui) {
                                  $("#client_name").val(ui.item.label);
                                 $("#client_id").val(ui.item.value);
                                  return false;
                                  alert("hai");
                              }
                          });
               }
            });
  
  });
  </script>
  <!-- <script src="<?php echo base_url(); ?>/assets/plugins/jQuery/jQuery-2.1.3.min.js"></script> -->
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <script>
    $(document).ready(function(){
      var date_input=$('input[name="date"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'yyyy/mm/dd',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })

    
    </script>
</body>
</html>


