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
      VAT  IN REPORT 
            </h1>
          
          </section>
          <section  class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box box-success">
                <div class="box-header with-border" id="searchform">
<div class="row" >
<form role="form" method="post" action="<?php echo base_url(); ?>reports/Vatreports_controller/getallvatdata"> 
               
                <div class="col-md-2 form-group">
                  <input type="date" autocomplete="off" placeholder="yyyy-mm-dd" id="month" name="from" class="form-control"/>
                </div>
                <div class="col-md-2 form-group">
                  <input type="date" autocomplete="off" placeholder="yyyy-mm-dd" id="year" name="to" class="form-control"/>
                </div>
                <div class="col-md-1 form-group">
                <!-- <input type="button" class="btn btn-success" value="Show" id="show" onclick="get_vat_report_total();"/> -->
                <input type="submit" class="btn btn-success" value="Show" id="show" />
              
            </div>
           
                                </form>
</div>
                </div>

                <?php 
                if(($vatreporttotal)!=''){?>
                <div class="box-body">
                  
                  <div class="row">
                  <center><h5 >(PERIOD:<?php echo $fromdate;?></span>  TO <?php echo $todate;?></span>)</h5></center>

                  <div class="col-md-12" id="salessummary" >
                   

                    <table id="" class="table table-stripped"  style="background:whitesmoke;">

<thead >
<center><h5 >SALES SUMMARY  <span id=""></span></h5></center>
    <tr class="success">
     
        <th>Sl No.</th>
        <th> Tax Payer TRN</th>
        <th>  Company Name / Member Company Name (If applicable)</th>
        <th>Tax Invoice/Tax credit note  No  </th>
        <th>Tax Invoice/Tax credit note Date - DD/MM/YYYY format only  </th>
        <th> Reporting period (From DD/MM/YYYY to DD/MM/YYYY format only) </th>
        <th> Tax Invoice/Tax credit note Amount AED </th>
        <th> Customer Name </th>
        <th> Customer TRN (If applicable) </th>
        <th>Location of the Customer  </th>
        <th>Clear description of the supply  </th>
      </tr>

    </thead>
    <tbody class="sales" >
        <?php  $i=1;$vat=0;
        foreach($vatreporttotal as $r){  ?>
<tr>
    <td><?php echo $i;?></td>
    <td></td>
    <td></td>
    <td><?php echo $r->Inv;?></td>
    <td><?php echo $r->Date;?></td>
    <td></td>
    <td><?php $vat=$vat+$r->VatTotal;  echo $r->VatTotal;?></td>
    <td><?php echo $r->name;?></td>
    <td><?php echo $r->trn_no;?></td>
    <td><?php echo $r->address;?></td>
    <td></td>
</tr>
<?php $i++; } ?>

        
        </tbody>
        <tfoot>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
            <td></td> 
            <td><?php echo $vat;?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tfoot>
</table>
                    </div>
                   
                  
                  </div>
                </div><?php } ?>
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
      