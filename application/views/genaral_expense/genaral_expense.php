<?php 
   // var_dump($jobdata);
   // var_dump ($Inv);
   // die();
   $month = date('m');
   $day = date('d');
   $year = date('Y');
   
   $today = $year . '-' . $month . '-' . $day;
   ?>
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
<script src="<?php echo base_url(); ?>/assets/plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<section class="content">
<div class="row">
   <div class="col-md-12 " id="step-1">
      <div class="panel panel-primary  " >
         <div class="panel-heading">
            <h3 class="panel-title">General Expense</h3>
         </div>
         <div class="panel-body">
            <section class="content">
            <div class="col-md-12">
               <h4 class="box-title">Details</h4>
               <div class="box box-primary">
                  <div class="box-header with-border">
                     <div class="box-body">
                     <div class="row">
                     <div class="row">
        
                <div class="form-group col-md-3">
                              <label class="control-label">Expense Head</label>
                              <select class="form-control" id="to_legder"   name="to_legder" required="required" onchange="giveSelection(this.value);">
                                 <option value="">Select Expense head</option>
                                 <?php foreach($expenses as $row){?>
                                 <option value="<?php echo $row->LedgerID;?>"><?php echo $row->Ledger_Name;?></option>
                                 <?php }?>
                              </select>
                           </div>
                           
               <div class="form-group col-md-3">
                              <label class="control-label">Expense Category</label>
                              <select class="form-control" id="expense_cat" name="expense_cat" required="required">
                                 <option value="">Select Expense Category</option>
                                 <option data-option="0">Other Expense</option>
                                <!-- admin expense start-->
                                 <option data-option="184">Printing & Stationary</option>
                                 <option data-option="184">Office Maintenance</option>
                                 <option data-option="184">Rent expenses</option>
                                 <option data-option="184">Employee Welfare</option>
                                 <option data-option="184">Food & Beverages</option>
                                 <option data-option="184">Telephone & Utility</option>
                                 <option data-option="184">Transportation Expense</option>
                                 <option data-option="184">Visa expanses</option>
                                 <option data-option="184">Govt Fee</option>
                                 <option data-option="184">Air ticket </option>
                                 <option data-option="184">Other Expenses </option>
                              <!--  Admin expense end
                                  Vehicle expense start-->
                                  <option data-option="183">Vehicle maintenance</option>
                                 <option data-option="183">Fuel Expense</option>
                                 <option data-option="183">Other Expenses </option>
                                   <!--Vehicle expense end-->
                                   
                                     <!--employee expense start-->
                                 <option data-option="182">Salary</option>
                                 <option data-option="182">Gratuity</option>
                                 <option data-option="182">Leave Salary </option> 
                                   <!--employee expense end-->
                                   
                               
                              </select>
                           </div>
                           
                           
                <div class="form-group col-md-2">
                  <label class="control-label" for="date">Posting Date</label>
      <input class="form-control" id="epost_dates" autocomplete="off" name="date" disabled="true" placeholder="YYY/MM/DD" value="<?php echo $today; ?>" type="text"/>
      <input type="hidden" value="<?php echo $today; ?>" id="epost_date"/>
              </div>
              <div class="form-group col-md-2">
                  <label class="control-label" for="date">Expense Date</label>
                 <input class="form-control" id="einv_date" autocomplete="off" name="date"  placeholder="YYY/MM/DD" type="text"/>
              </div>
                     </div>
                     <div class="row">

                   
              <div class="form-group col-md-3">
                  <label class="control-label" for="date">Ref/Invoice</label>
                  <input maxlength="100" type="text" autocomplete="off" id="einvoice" required="required" class="form-control" placeholder=" invoice" >
              </div>
              
              <div class="form-group col-md-3">
                              <label for="exampleInputname1">Payment Mode </label>
                      <select class="form-control" id="emode" onchange="checktransaction();" name="mode" value="--Select Type--">
                        <option value="credit">CREDIT</option>
                        <option value="cash">CASH</option>
                        <option value="bank">BANK</option>
                        
                      </select>
              </div>

             
                           
                           
                           <div class="form-group col-md-4" id="cash_accounts">
                              <label class="control-label">Cash accounts:</label>
                              <select class="form-control" id="cash_id" name="cash_id"  >
                                 <?php
                                    foreach($cash_acc as $key=>$value)
                                    {
                                     
                                 echo '<option value="' . $value->LedgerID . '" id="' . $value->Ledger_Name. '">' . $value->Ledger_Name. '</option>';

                             
                                    }
                                    ?>
                              </select>
                           </div>
                           
                           <div class="form-group col-md-4" id="banks">
                              <label class="control-label">Bank:</label>
                              <select class="form-control" id="bank" name="bank"  >
                                 <?php
                                    foreach($bank as $key=>$value)
                                    {
                                     
                                 echo '<option value="' . $value->id . '" id="' . $value->bank_name. '">' . $value->bank_name. '</option>';

                             
                                    }
                                    ?>
                              </select>
                           </div>
                           <div class="form-group col-md-4" id="transac_id">
                              <label class="control-label">Transaction Id</label>
                              <input maxlength="100" type="text" id="transactionid"  class="form-control " placeholder="transaction id " />
                           </div>



              <div class="col-md-12" style="border-bottom:1px solid #eee; margin-bottom:10px; height:2px;">
            </div>
</div>
                        <div class="row">
                         <div class="form-group col-md-3 vehicle_input">
                              <label class="control-label">Vehicle</label>
                              <select class="form-control select2" id="evehicle" name="evehicle" required="required">
                                
                                  <option value="0">Select Vehicle</option>
                                 <?php foreach($vehicle as $row){?>
                                 
                                 <option value="<?php echo $row->vehicleid;?>"><?php echo $row->Vehicle_number;?></option>
                                 <?php }?>
                              </select>
                           </div>
                        <div class="form-group col-md-3 ">
                              <label class="control-label"> Job</label>
                              <select class="form-control select2" id="esite" name="esite" required="required">
                                 <option value="0">Not Applicable</option>
                                 
                                 <?php foreach($project_site as $row){?>
                                 <option value="<?php echo $row->JobId;?>"><?php echo $row->Number;?></option>
                                 <?php }?>
                              </select>
                           </div>
                           
                            <div class="form-group col-md-3 employee_input">
                              <label class="control-label">Employee</label>
                              <select class="form-control select2" id="eemployee" name="eemployee" required="required">
                                 <option value="0">Not Applicable</option>
                                 <?php foreach($employee as $row){?>
                                 <option value="<?php echo $row->employeeid;?>"><?php echo $row->name;?></option>
                                 <?php }?>
                              </select>
                           </div>
                           <div class="form-group col-md-3">
                              <label class="control-label">Description</label>
                              <input maxlength="100" type="text" id="edescription_job" required="required" class="form-control" placeholder=" Description" value=""/>
                              <input type="hidden" id="edescription_id" class="form-control" value="" />
                           </div>
                           <div class="row">
                              <div class="form-group col-md-1">
                                 <label class="control-label">Cost</label>
                                 <input maxlength="100" type="text" autocomplete="off" id="eunitprice" required="required" class="form-control " placeholder=" unit price" />
                              </div>
                             
                             
                              <div class="form-group col-md-2">
                                 <label class="control-label">VAT    Included<input type="checkbox" id="isAgeSelected"/></label>
                                 <input maxlength="100" autocomplete="off" type="text" id="evat" required="required" class="form-control" value=" 0" />
                              </div>
                             
                           </div>
                           <input type="button" name="add" value="ADD" onclick="insert_supplier_expense();" id="add" class="btn btn-success" style="float: right;">
                        </div>
</br>
                        <!-- /.panel body -->
                        <div class="col-md-12">
                           <div>
                              <!-- /.box-header -->
                              <div class="">
                                 <div id="ContentPlaceHolder1_upDataList">
                                    <table id="datatable" class="table table-striped table-bordered">
                                       <thead>
                                          <tr>
                                          <th>Expense Entity</th>
                                             <th>Description</th>
                                             <th>Cost</th>
                                             <th>SubTotal</th>
                                             <th>VAT</th>
                                             <th>TOTAL</th>
                                             <th></th>
                                          </tr>
                                       </thead>
                                       <tbody class="adddata"> 
                                       </tbody>
                                       <tfoot>
                                       </tfoot>
                                    </table>
                                 </div>
</hr>
                                 <div class="row">
                                 <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="control-label">Notes</label>
                                    <textarea class="form-control" id="enotes" name="notes" rows="3" placeholder="Notes"></textarea>
                                   
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                 <div id="ContentPlaceHolder1_upTotals">
                                    <div style="float: right;">
                                       <span id="ContentPlaceHolder1_lbl">TOTAL</span>        
                                       <input name="etotal" type="text" value="0" readonly="readonly" id="etotal" class="form-control " style="width: 100%;">
                                       <span id="ContentPlaceHolder1_Label1">Vat Total</span>        
                                       <input name="evat_total" type="text" value="0" readonly="readonly" id="evat_total" class="form-control " style="width: 100%;"> 
                                       <span id="ContentPlaceHolder1_Label2">Grand Total</span>        
                                       <input name="egrand_total" type="text" value="0" readonly="readonly" id="egrand_total" class="form-control " style="width: 100%;">                 
                                    </div>
                                 </div>
                                 </div>
`                                </div>                                 <!-- /.box-body -->
                              </div>
                              <!-- /.box -->
                           </div>
                        </div>
                     </div>
                     <div class="col-md-12 ">
                        <br><br>
                        <div class="row">
                         
                          
                           
                           <div class="form-group col-md-2">
                         
                              <input class=" btn btn-success" type="button" name="add_expense" onclick="insert_expense_details();" style=" margin-top:20px; margin-left:720px;" value="Submit" id="add_expense">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               </div></div>
              
               <!-- <button class="btn btn-primary nextBtn pull-right" style=" margin-top:20px;" type="button">Next</button> -->
            
         </div>
      </div>
   </div>

   </div>
   </section>

<script src="<?php echo base_url(); ?>/assets/user_scripts/genaral_expense/genaral_expense.js"></script>
<script>
var sel1 = document.querySelector('#to_ledger');
var sel2 = document.querySelector('#expense_cat');
var options2 = sel2.querySelectorAll('option');
    function giveSelection(selValue) {
        
  sel2.innerHTML = '';
  for(var i = 0; i < options2.length; i++) {
    if(options2[i].dataset.option === selValue) {
      sel2.appendChild(options2[i]);
    }
    
    
  }
  
  if(selValue=="183")
  {
      $(".vehicle_input").removeClass("hidden");
       $(".site_input").addClass("hidden");
       $(".employee_input").addClass("hidden");
  }
  else if(selValue=="182")
  
  {  $(".vehicle_input").addClass("hidden");
       $(".site_input").removeClass("hidden");
       $(".employee_input").removeClass("hidden");
  }
  else{
      $(".site_input").removeClass("hidden");
      $(".vehicle_input").addClass("hidden");
       $(".employee_input").addClass("hidden");
  }
   $('.select2').select2();
}
// giveSelection(sel1.value);

</script>
<script>
    $(document).ready(function(){
        $(".vehicle_input").addClass("hidden");
        $(".site_input").addClass("hidden");
           $(".employee_input").addClass("hidden");
        
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
    <script>
          $(document).ready(function(){
  

  var obj=[];
              $.ajax({
               url: "<?php echo base_url(); ?>transaction/Supplierexpense_Controller/getsupplierdata",
               type: 'post',
               dataType: "json",
               success: function( data ) 
               {
                   console.log(data);
                obj=data;
                $('#view_supplier_name').autocomplete({
                              source: obj,
                              select: function (event, ui) {
                                  $("#view_supplier_name").val(ui.item.label);
                                 $("#supplier_id").val(ui.item.value);
                                  return false;
  
                              }
                          });
               }
            });
  
  });

  </script>
  
<script type="text/javascript">
    $(document).ready(function() {


        var obj = [];
        $.ajax({
            url: "<?php echo base_url(); ?>transaction/Transaction/getdescriptiondata",
            type: 'post',
            dataType: "json",
            success: function(data) {
                //  console.log(data);
                obj = data;
                $('#edescription_job').autocomplete({
                    source: obj,
                    select: function(event, ui) {
                        $("#edescription_job").val(ui.item.label);
                        $("#edescription_id").val(ui.item.value);
                        return false;

                    }
                });
            }
        });

        //var obj=[{"value":1,"label":'anu'},{"value":2,"label":'rejina'}];

    });
</script>