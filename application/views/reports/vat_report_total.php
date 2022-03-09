<?php 

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
      VAT REPORT TOTAL
            </h1>
          
          </section>
          <section  class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box box-success">
                <div class="box-header with-border" id="searchform">
<div class="row" >
<form role="form" method="post" action=""> 
                
                <div class="col-md-2 form-group">
                  <input type="text" autocomplete="off" placeholder="yyyy-mm-dd" id="month" name="date" class="form-control"/>
                </div>
                <div class="col-md-2 form-group">
                  <input type="text" autocomplete="off" placeholder="yyyy-mm-dd" id="year" name="date" class="form-control"/>
                </div>
                <div class="col-md-1 form-group">
                <input type="button" class="btn btn-success" value="Show" id="show" onclick="get_vat_report_total();"/>
              
            </div>
           
                                </form>
</div>
                </div>
                <div class="box-body">
                  
                  <div class="row">
                  <center><h5 >(PERIOD: <span id="fromdate"></span>  TO <span id="todate"></span>)</h5></center>

                  <div class="col-md-12" id="salessummary" >
                    <!-- <table id="" class="table table-stripped"  style="background:whitesmoke;">

                    <thead >
                    <center><h5 >SALES SUMMARY  <span id=""></span></h5></center>
                        <tr class="success">
                         
                            <th>DATAILS</th>
                            <th > STANDARD RATED</th>
                            <th>INPUT VAT</th>
                        
                        
                          </tr>

                        </thead>
                        <tbody class="sales" >
                            
                            </tbody>
                    </table> -->

                    <table id="" class="table table-stripped"  style="background:whitesmoke;">

<thead >
<center><h5 >SALES SUMMARY  <span id=""></span></h5></center>
    <tr class="success">
     
        <th>DATAILS</th>
        <th > STANDARD RATED</th>
        <th>INPUT VAT</th>
    
    
      </tr>

    </thead>
    <tbody class="sales" >
        
        </tbody>
</table>
                    </div>
                    <div class="col-md-12" id="expensesummary" >
                    <table id="" class="table table-stripped " style="background:whitesmoke;">

                    <thead >
                    <center><h5 >PURCHASE AND EXPENSES SUMMARY  <span id=""></span></h5></center>
                        <tr class="success">
                         
                            <th>DATAILS</th>
                            <th >STANDARD RATED</th>
                            <th>OUTPUT VAT</th>
                      
                          </tr>

                        </thead>
                        <tbody class="expense" >
                   
                            </tbody>
                    </table>
                    </div>
                    
                  
                  </div>
                </div>
              </div>
            </div>
          </div>


          </section>
        
         
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

  <script type="text/javascript">
      $('.date-own').datepicker({
         minViewMode: 2,
         format: 'yyyy'
       });
  </script>
        <script src="<?php echo base_url(); ?>/assets/user_scripts/reports/vat_reports.js"></script>
      