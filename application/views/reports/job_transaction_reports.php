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
     JOB TRANSACTION  REPORT
            </h1>
          
          </section>
          <section  class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box box-success">
                <div class="box-header with-border" id="searchform">
<div class="row">
<form role="form" method="post" action=""> 
           
                <div class="col-md-2 form-group col-md-offset-3 " >
                  <input type="text" autocomplete="off" placeholder="Search Job No" id="jobno" name="jobno" class="form-control"/>
                </div>
                <div class="col-md-1 form-group " >
                    <h5>OR</h5>
                </div>
                <div class="col-md-2 form-group">
                  <input type="text" autocomplete="off" placeholder="Enter AWB/MAWB" id="awb" name="awb" class="form-control"/>
                </div>
                <div class="col-md-1 form-group">
                <input type="button" class="btn btn-success" value="Show" id="show" onclick="get_transaction_report();"/>
                </div>
                <!-- <div class="col-md-1 form-group" id="printdiv">
              <button id="btnPrint" style="float: left;" class="btn btn-success" onclick="PrintPage()"><i class="fa fa-print"></i>Print</button>
              </div> -->
                                </form>
</div>
                </div>
                <div class="box-body">
                  <div class="row">
                  <div class="col-md-6 text-left">
</br></br>
<p style="font-size: 16px; font-weight: bold;" >Client : <span id="clientid"></span></p>
<p style="font-size: 16px; font-weight: bold;" >Job Profit : <span id="profit"></span></p>

</div>               
<div class="col-md-12" id="invoicetb" >
                    <!-- <table class="table table-striped  indexer table tab1" id="table"  > -->
                    <table id="" class="table table-stripped " style="background:whitesmoke;">

                    <thead >
                    <center><h5 style="color: red;">Invoices ( <span id="lblJobNo"></span>)</h5></center>
                        <tr class="success">
                         
                            <th>Sl</th>
                            <th>Inv No</th>
                            <th>Inv Date</th>
                            <th>Particulars</th>
                        
                            <th>Customer</th>
                            <th>Mode</th>
                            <th>Credit</th>
                            <th >Debit</th>
                            
                            <th >InvProfit</th>

                          </tr>

                          
                        </thead>
                        <tbody class="invoicereport" >
                            
                            </tbody>
                    </table>
                    </div>
                    <div class="col-md-12" id="creditnotetb">
                    <table id="" class="table table-stripped "  style="background:whitesmoke;">

                    <thead>
                    <center><h5 style="color: red;">Credit Notes (  <span id="lblJobNo1"></span>)</h5></center>

                        <tr class="info">
                         
                            <th>Sl</th> 
                              <th>Crn No</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Mode</th>
                            <th>Credit</th>
                            <th >Debit</th>
                         
                       

                          </tr>

                          
                        </thead>
                        <tbody class="creditdata" >
                            
                            </tbody>
                    </table>
                    </div>
                    <div class="col-md-12" id="receipttb">
                    <table id="" class="table table-stripped "  style="background:whitesmoke;">

                    <thead>
                    <center><h5 style="color: red;">Receipts (<span id="lblJobNo2"></span>)</h5></center>

                        <tr class="danger">
                        <th>Sl</th>
                            <th>Receipt Date</th>
                            <th>Doc.#</th>
                            <th>Particulars</th>
                            <th > OurInv/Ref</th>
                            <th >Reference</th>

                           
                            <th>Customer</th>
                            <th>Mode</th>
                            <th>Credit</th>
                            <th >Debit</th>
                        
                          </tr>

                          
                        </thead>
                        <tbody class="receiptdata" >
                            
                            </tbody>
                    </table>
                    </div>
                    <div class="col-md-12" id="expensetb">
                    <table id="" class="table table-stripped "  style="background:whitesmoke;">

                    <thead>
                    <center><h5 style="color: red;">Expense Posting ( <span id="lblJobNo3"></span>)</h5></center>

                        <tr class="warning">
                       
                            <th>Sl</th>
                        
                            <th>Inv Date</th>
                            <th>Posting Date</th>
                            <th>Doc.#</th>
                            <th>Particulars</th>
                            <th > Inv/Ref</th>
                            <th > OurInv</th>
                            <th>Supplier</th>
                            <th>Mode</th>
                          
                            <th >Status</th>
                            <th>Credit</th>
                            <th >Debit</th>
                          </tr>

                          
                        </thead>
                        <tbody class="expensedata" >
                            
                            </tbody>
                    </table>
                    </div>
                    <div class="col-md-12" id="denbitnotetb">
                    <table id="" class="table table-stripped "  style="background:whitesmoke;">

                    <thead>
                    <center><h5 style="color: red;">Debit Note (  <span id="lblJobNo4"></span>)</h5></center>

                        <tr class="success">
                        <th>Sl</th>
                        
                        <th>Inv Date</th>
                        <th>Posting Date</th>
                        <th>Doc.#</th>
                        <th>Particulars</th>
                        <th > Inv/Ref</th>
                        <th > OurInv</th>
                        <th >Supplier</th>
                        <th>Mode</th>
                      
                        <th >Status</th>
                        <th>Credit</th>
                        <th >Debit</th>

                          </tr>

                          
                        </thead>
                        <tbody class="debitdata" >
                            
                            </tbody>
                    </table>
                    </div>
                    <div class="col-md-12" id="paymenttb">
                    <table id="" class="table table-stripped "  style="background:whitesmoke;">

                    <thead>
                    <center><h5 style="color: red;">Payment ( <span id="lblJobNo5"></span>)</h5></center>

                        <tr class="info">
                        <th>Sl</th>
                        
                        <th>Payment Date</th>
                        <th>Doc.#</th>
                        <th>Particulars</th>
                        <th > Inv/Ref</th>
                        <th > OurInv</th>
                        <th>Supplier</th>
                        <th>Mode</th>
                      
                        <th >Status</th>
                        <th>Client</th>
                        <th>Credit</th>
                        <th >Debit</th>
                          </tr>

                          
                        </thead>
                        <tbody class="paymentdata" >
                            
                            </tbody>
                    </table>
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
          </div>


          </section>
          <script src="<?php echo base_url(); ?>/assets/user_scripts/reports/job_transaction_report.js"></script>
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
    
