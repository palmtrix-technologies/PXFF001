<?php 
   // var_dump($currency);
  
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
      <div class="panel panel-primary " >
         <div class="panel-heading">
            <h3 class="panel-title">Invoice</h3>
         </div>
         <div class="panel-body">
            <section class="content">
            <div class="col-md-10">
               <h4 class="box-title">Job Invoice</h4>
               <div class="box box-primary">
                  <div class="box-header with-border">
                     <div class="box-body">
                        <div class="row">
                           <div class="form-group col-md-2"><?php $ab=$this->session->userdata('user_id');?>
                           <input   type="hidden" id="userid"  class="form-control" placeholder="<?php echo $ab;?>"  value="<?php echo $ab; ?>"/>
                              <label class="control-label">Inv*</label>
                              <?php  
                           
                             if($Inv == '1') 
                             {$iv=1;}
                             else{
                             $pieces = str_split($Inv, 12);
                             $iv=$pieces[1]+1;  
                             }  $INV1= "INV/".$year."/".$month."/".$iv;?>
                              <input   type="text" id="inv_code" required="required" class="form-control" readonly="readonly"  placeholder="<?php echo $INV1;?>"  value="<?php echo $INV1;?>"/>
                              <input   type="hidden" id="epost_code" required="required" class="form-control" readonly="readonly"  placeholder="<?php echo $supcode[0]->PostId+1;?>"  value="<?php echo $supcode[0]->PostId+1;?>"/>
                           </div>
                           <div class="form-group col-md-3">
                              <label class="control-label">Date</label>
                              <input type="text" value="<?php echo $today; ?>" autocomplete="off" class="form-control" required id="date" name="date"  onchange="setinvdate();"></input>
                              <input maxlength="100" type="hidden" id="job_id"  class="form-control"  value="<?php echo $jobdata[0]->JobId;?>"/>

                           </div>
                        </div>
                        <div class="row">
                           <!-- <div class="form-group col-md-2">
                              <label class="control-label">Code</label>
                              <input maxlength="100"  onchange="getdata();" type="text" id="desc_code" name="desc_code" required="required" class="form-control" placeholder=" code" />
                           </div> -->
                           <div class="form-group col-md-2">
                              <label class="control-label">Description</label>
                              <input maxlength="100" type="text" id="description_job" required="required" class="form-control" placeholder=" Description" value=""/>
                              <input type="hidden" id="description_id" class="form-control" value="" />
                           </div>
                           <!-- <div class="row"> -->
                              <div class="form-group col-md-1">
                                 <label class="control-label">UnitPrice</label>
                                 <input maxlength="50" type="text" autocomplete="off" id="unitprice" required="required" class="form-control " placeholder=" unit price" />
                              </div>
                              <div class="form-group col-md-1">
                                 <label class="control-label">Quantity</label>
                                 <input maxlength="100" type="text"autocomplete="off"  id="quantity" required="required" class="form-control " value=" 1" />
                              </div>
                              <div class="form-group col-md-1">
                                 <label class="control-label">VAT</label>
                                 <input maxlength="100" type="text" autocomplete="off" id="vat" required="required" class="form-control" value=" 0" />
                              </div>
                              <div class="form-group col-md-1">
                                 <label class="control-label">Currency</label>
                                 <select class="form-control" id="unit_price" name="unit_price"  value="--Select Type--" style="width: 70px;">

                                  <?php 
                                  foreach($currency as $key=>$value)
                                  {
?>
                                 <option value="<?php echo $value->currency;?>"><?php echo $value->currency;?></option>
                                  <?php
                                  }
                                   ?>
                                 </select>
                               
                             
                              </div>
                              <!-- <div class="form-group col-md-1">
                                 <label class="control-label">Con.Fact</label>
                                 <input maxlength="100" type="text" autocomplete="off" id="conv_factor"  required="required" class="form-control " value="1" />
                              </div> -->
                             
                             
                              <div class="form-group col-md-3">
                  <label class="control-label" for="date"> Supplier</label>
                  <input maxlength="100" type="text" id="view_supplier_name" required="required" class="form-control" placeholder=" supplier_name" value="">
                  <input maxlength="100" type="hidden" id="supplier_id" class="form-control" value="">
                 </div>
                 <div class="form-group col-md-1">
                                 <label class="control-label">UnitPrice</label>
                                 <input maxlength="100" type="number" autocomplete="off" id="eunitprice" value="0"  required="required" class="form-control " placeholder="unit price" style="width: 65px;" />
                              </div>
                              <div class="form-group col-md-1">
                                 <label class="control-label">Quantity</label>
                                 <input maxlength="100" type="text" autocomplete="off" id="suppqty" value=" 1" required="required" class="form-control " placeholder="Quantity" style="width: 65px;" />
                              </div>

                              <div class="form-group col-md-1">
                                 <label class="control-label"> SuppVat</label>
                                 <input maxlength="100" type="text" autocomplete="off" id="suppvat" value="0" required="required" class="form-control " placeholder="vat" style="width: 65px;" />
                              </div>            

                           <!-- </div> -->
                           <input type="button" name="add" value="ADD" onclick="insert_job_invoice();" id="add" class="btn btn-success" style="float: right;">
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
                                             <th>Description</th>
                                             <th>UnitPrice</th>
                                             <th>Quantity</th>
                                             <th>SubTotal</th>
                                             <th>VAT</th>
                                             <th>TOTAL</th>
                                             <th>Supplier</th>
                                             <th>Unitprice</th>
                                             <th>Total</th>
                                             <th></th>
                                          </tr>
                                       </thead>
                                       <tbody class="dataadd"> 
                                       </tbody>
                                       <tfoot>
                                       </tfoot>
                                    </table>
                                 </div>
                                

                                 <div id="ContentPlaceHolder1_upTotals">
                                    <div style="float: right;">
                                       <span id="ContentPlaceHolder1_lbl">EXPENSE TOTAL</span>        
                                       <input name="total" type="text" value="0" readonly="readonly" id="etotal" class="form-control " style="width: 100%;">
                                       <span id="ContentPlaceHolder1_Label1">Vat Total</span>        
                                       <input name="vat_total" type="text" value="0" readonly="readonly" id="evat_total" class="form-control " style="width: 100%;"> 
                                       <span id="ContentPlaceHolder1_Label2">Grand Total</span>        
                                       <input name="grand_total" type="text" value="0" readonly="readonly" id="egrand_total" class="form-control " style="width: 100%;">                 
                                    </div>
                                 </div>

                                 <div id="ContentPlaceHolder1_upTotals">
                                    <div style="float: right;padding-right: 20px;">
                                       <span id="ContentPlaceHolder1_lbl">TOTAL</span>        
                                       <input name="total" type="text" value="0" readonly="readonly" id="total" class="form-control " style="width: 100%;">
                                       <span id="ContentPlaceHolder1_Label1">Vat Total</span>        
                                       <input name="vat_total" type="text" value="0" readonly="readonly" id="vat_total" class="form-control " style="width: 100%;"> 
                                       <span id="ContentPlaceHolder1_Label2">Grand Total</span>        
                                       <input name="grand_total" type="text" value="0" readonly="readonly" id="grand_total" class="form-control " style="width: 100%;">                 
                                    </div>
                                 </div>

                                 <!-- /.box-body -->
                              </div>
                              <!-- /.box -->
                           </div>
                        </div>
                     </div>
                     <div class="col-md-12 ">
                        <br><br>
                        <div class="row">
                           <div class="form-group col-md-4">
                              <label class="control-label">BANK*</label>
                              <select class="form-control" required="required" id="bank" name="bank"  value="">
                              <!--<option value="">--Select Bank--</option>-->

                               <?php
                                    foreach($bank as $key=>$value)
                                    {
                                        ?>
                                 <option value="<?php echo $value->id;?>"><?php echo $value->bank_name;?></option>
                                 <?php
                                    }
                                    ?>
                              </select>
                           </div>
                           <div class="form-group col-md-4">
                              <label class="control-label">Invoice Type:</label>
                              <select class="form-control" id="type" name="type"  onchange="visible_cash();"  value="">
                                 <option value="credit">Credit</option>
                                 <option value="cash">Cash</option>
                              </select>
                           </div>
                           <div class="form-group col-md-4" id="receipt">
                              <label class="control-label">   Receipt No(Only for Cash):</label>
                              <input maxlength="100" autocomplete="off" type="text" id="receipt_no"  class="form-control " placeholder="Receipt No" />
                           </div>
                           <div class="form-group col-md-4" id="description">
                              <label class="control-label"></label>
                              <input maxlength="100" autocomplete="off" type="text" id="adv_desc"  class="form-control " placeholder="Advance Description" />
                           </div>
                           <div class="form-group col-md-4" id="amnt">
                              <label class="control-label"></label>
                              <input maxlength="100" autocomplete="off" type="text" id="amount"  class="form-control " placeholder="Amount" />
                           </div>

                           <div class="form-group col-md-4">
                              <label class="control-label">Remark</label>
                              <textarea id="remark" name="remark" rows="1" cols="10" class="form-control"></textarea>
                           </div>
                          
                          <div class="form-group col-md-4">
                              <label class="control-label">Credit Date</label>
                              <input type="date" name="creditdate" id="creditdate" class="form-control">
                           </div>

                           <div class="form-group col-md-2">
                              <input type="button" name="submit" onclick="insert_job_details();" style=" margin-top:20px;" value="Submit" id="submit" class="btn btn-success"  >
                           <!--  <button type="button" id="Submit_form"> Submit</button> -->
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- supplier expense -->
               </div>   
               <div class="col-md-2">
                  <h4 class="box-title">Job Description </h4>
                  <div class="box box-primary">
                     <div class="box-header with-border">  
                     </div>
                     <div class="box-body">
                        <strong><i class=""></i> Job</strong>
                        <p class="text-muted">
                           <?php echo $jobdata[0]->Jobcode;?>
                        </p>
                        <hr>
                        <strong><i class=""></i> Shipper</strong>
                        <p class="text-muted">    <?php echo $jobdata[0]->Shipper;?></p>
                        <hr>
                        <strong><i class=""></i> Consignee</strong>
                        <p class="text-muted">    <?php echo $jobdata[0]->Consignee;?> </p>
                        <hr>
                        <strong><i class=""></i> Client </strong>
                        <p> <?php echo $jobdata[0]->client_name;?></p>
                        <hr>
                        <strong><i class=""></i>Mode</strong>
                        <p> <?php echo $jobdata[0]->Type;?> </p>
                        <hr>
                        <strong><i class=""></i>Weight</strong>
                        <p> <?php echo $jobdata[0]->ActualWeight;?> </p>
                        <hr>
                        <strong><i class=""></i>ETA</strong>
                        <p> <?php echo $jobdata[0]->Eta;?> </p>
                        <hr>
                        <strong><i class=""></i>ETD</strong>
                        <p><?php echo $jobdata[0]->Etd;?></p>
                    
                        <hr>
                        <strong><i class=""></i>CARRIER</strong>
                        <p><?php echo $jobdata[0]->Carrier;?> </p>
                      
                        <hr>
                        <strong><i class=""></i>PO NO</strong>
                        <p><?php echo $jobdata[0]->PoNo;?></p>
                     </div>
                  </div>
               </div>
               <!-- <button class="btn btn-primary nextBtn pull-right" style=" margin-top:20px;" type="button">Next</button> -->
        
         </div>
      </div>
   </div>
   </div>
   </section>
<script src="<?php echo base_url(); ?>/assets/user_scripts/transaction/job_invoice.js"></script>
<!-- <script type="text/javascript"> -->

<script src="<?php echo base_url(); ?>/assets/user_scripts/transaction/supplier_expense.js"></script>
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
          $(document).ready(function(){
  

  var obj=[];
              $.ajax({
               url: "<?php echo base_url(); ?>transaction/Job_invoice_controller/getsupplierdata",
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
                $('#description_job').autocomplete({
                    source: obj,
                    select: function(event, ui) {
                        $("#description_job").val(ui.item.label);
                        $("#description_id").val(ui.item.value);
                        return false;

                    }
                });
            }
        });

        //var obj=[{"value":1,"label":'anu'},{"value":2,"label":'rejina'}];

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