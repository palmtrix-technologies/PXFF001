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
    General Expense Detailed Report
  </h1>

</section>
<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">
        <div class="box-header with-border" id="searchform">
          <div class="row">
            <form role="form" method="post" action="">
            
              <div class="col-md-2 form-group">
                <input type="text" autocomplete="off" placeholder="yyyy-mm-dd" id="fromdate" name="date" class="form-control" />
              </div>
              <div class="col-md-2 form-group">
                <input type="text" autocomplete="off" placeholder="yyyy-mm-dd" id="todate" name="date" class="form-control" />
              </div>
              <div class="col-md-1 form-group">
                <input type="button" class="btn btn-success" value="Show" id="show" onclick="get_bill_report_detailed();" />
              </div>
           
            </form>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
            <table id="mytable1" class="table table-stripped">
                <thead>
                  <tr>
                    <th>Doc.#</th>
                    <th>Date</th>
                    <th>Expense Head</th>
                     <th>Expense Category</th>
                    <th>Inv/Ref</th>
                    <th>Payment type</th>
                    <th>Entity</th>
                    <th>Description</th>
                   
                      <th>Sub Total </th>
                        <th>Vat</th>
                    <th>Amount</th>
                    


                  </tr>


                </thead>
                <tbody class="billreports">

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


</section>
<script src="<?php echo base_url(); ?>/assets/user_scripts/genaral_expense/genaral_expense_report.js"></script>
<script>
  $(document).ready(function() {
    var date_input = $('input[name="date"]'); //our date input has the name "date"
    var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
    var options = {
      format: 'yyyy-mm-dd',
      container: container,
      todayHighlight: true,
      autoclose: true,
    };
    date_input.datepicker(options);



  })
</script>
 

