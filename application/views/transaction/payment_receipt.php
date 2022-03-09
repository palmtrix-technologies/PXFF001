<?php 
   // var_dump($jobdata);
   // var_dump ($Inv);
   // die();
   $month = date('m');
   $day = date('d');
   $year = date('Y');
   
   $today = $year . '-' . $month . '-' . $day;
   ?>
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
   <div class="col-md-12 ">
      <div class="panel panel-primary " >
         <div class="panel-heading">
            <h3 class="panel-title">Payment Receipt</h3>
         </div>
         <div class="panel-body">
            <section class="content">
            <div class="col-md-10">
               <!-- <h4 class="box-title">Job Invoice</h4> -->
               <div class="box box-primary">
                  <div class="box-header with-border">
                     <div class="box-body">
                        <div class="row">
                           <div class="form-group col-md-1">
                              <label class="control-label">Code*</label><?php $ab=$this->session->userdata('user_id');?>
                           <input   type="hidden" id="userid"  class="form-control" placeholder="<?php echo $ab;?>"  value="<?php echo $ab; ?>"/>
                              <input   type="text" id="code" required="required" class="form-control" readonly="readonly" placeholder="<?php echo $receiptcode[0]->ID+1;?>"  value="<?php echo $receiptcode[0]->ID+1;?>"/>

                           </div>
                           <div class="form-group col-md-3">
                              <label class="control-label">Date</label>
                              <input type="date" autocomplete="off" value="<?php echo $today; ?>" class="form-control" required id="date" name="date" ></input>
                              <input maxlength="100" type="hidden" id="client_id" name="client_id" class="form-control"  value="<?php echo $client[0]->id;?>"/>

                           </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-2">
                                 <label class="control-label">Inv No</label>
                               
                                 <select class="form-control" id="inv_id" name="inv_id" onchange="payment_receipt_select_client_details();" value="">
                                 <option value="">-- Inv No--</option>
                                 <?php
                                 foreach($invno as $key=>$value){
                                     ?>
                                   

                                    <option value="<?php echo $value->InvoiceMasterId?>"><?php echo $value->Inv?></option>
                                 <?php 
                                } 
                                ?>  
                                 </select>
                              </div>
                           <div class="form-group col-md-2">
                              <label class="control-label">Description</label>
                              <input maxlength="100" type="text" id="details" required="required" class="form-control" placeholder="Client Details" value=""/>
                              <input maxlength="100" type="hidden" id="job_no"  class="form-control"  value=""/>

                           </div>
                           <div class="row">
                           <div class="form-group col-md-2">
                              <label class="control-label">Amount</label>
                              <input maxlength="100" autocomplete="off" type="text" id="amount" required="required" class="form-control" placeholder=""  value=""/>
                          <input type="hidden" id="amount_actual">
                           </div>
                              <div class="form-group col-md-2">
                                 <label class="control-label">Currency</label>
                                 <select class="form-control" id="unit_price" name="unit_price"  value="--Select Type--">
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
                              <div class="form-group col-md-1">
                                 <label class="control-label">Conv.Factor</label>
                                 <input maxlength="100" autocomplete="off" type="text" id="conv_factor"  required="required" class="form-control " value="1" />
                              </div>
                             
                             
                           </div>
                           <input type="button" name="add" value="ADD"  id="add" class="btn btn-success" style="float: right;" onclick="insert_client_payment();" >
                        </div>
                        <!-- /.panel body -->
                        <div class="col-md-12">
                           <div>
                              <!-- /.box-header -->
                              <div class="">
                                 <div id="ContentPlaceHolder1_upDataList">
                                    <table id="datatable" class="table table-striped table-bordered">
                                       <thead>
                                          <tr>
                                             <th>
                                             Inv No</th>
                                             <th>Job No</th>
                                             <th>Amount</th>
                                             <th>Currency</th>
                                             <th>Cov Factor</th>
                                             <th>TOTAL</th>
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
                                       <span id="ContentPlaceHolder1_lbl">TOTAL</span>        
                                       <input name="total" id="total" type="text" value="0" readonly="readonly" id="total" class="form-control " style="width: 100%;">
                                       <!-- <span id="ContentPlaceHolder1_Label1">Vat Total</span>        
                                       <input name="vat_total" id="vat_total" type="text" value="0" readonly="readonly" id="vat_total" class="form-control " style="width: 100%;">  -->
                                       <span id="ContentPlaceHolder1_Label2">Grand Total</span>        
                                       <input name="grand_total" type="text" id="grand_total" value="0" readonly="readonly" id="grand_total" class="form-control " style="width: 100%;">                 
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
                              <label class="control-label">Pament Mode:</label>
                              <select class="form-control" id="type" name="type" onchange="visible_paymode_details();"  value="--pay mode--">
                              <option value="">--pay mode--</option>
                                 <option value="cash">Cash</option>
                                 <option value="cheque">Cheque</option>
                                 <option value="electronic">Electronic</option>
                              </select>
                           </div>
                           <div class="form-group col-md-4" id="chequeno">
                              <label class="control-label">   Cheque No:</label>
                              <input maxlength="100" autocomplete="off" type="text" id="cheque_no"  class="form-control " placeholder="Cheque No" />
                           </div>
                           <div class="form-group col-md-4" id="chequedate">
                              <label class="control-label">Cheque Date</label>
                              <input maxlength="100" autocomplete="off" type="date" id="cheque_date"  class="form-control " placeholder=" " />
                           </div>
                           <div class="form-group col-md-4" id="bank">
                              <label class="control-label">Bank:</label>
                              <select class="form-control" id="bank_id" name="bank_id"  >
                                 <?php
                                    foreach($bank as $key=>$value)
                                    {
                                      

                                 echo '<option value="' . $value->id . '" id="' . $value->bank_name. '">' . $value->bank_name. '</option>';

                            
                                    }
                                    ?>


<?php

// foreach ($clientlist as $client) {
   //  echo '<option value="' . $client->name . '" id="' . $client->id . '">' . $client->name . '</option>';
// }
?>
                              </select>
                           </div>
                           <div class="form-group col-md-4" id="transac_id">
                              <label class="control-label">Transaction Id</label>
                              <input maxlength="100" type="text" id="transaction_id"  class="form-control " placeholder="transaction id " />
                           </div>
                           <div class="form-group col-md-2">
                              <input type="button"  style=" margin-top:20px;" value="Submit" id="submit" onclick="insert_payment_receipt();" class="btn btn-success"  >
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               </div>
               <div class="col-md-2">
                  <h4 class="box-title">Client Details </h4>
                  <div class="box box-primary">
                     <div class="box-header with-border">  
                     </div>
                     <div class="box-body">
                        <strong><i class=""></i> Name</strong>
                        <p class="text-muted">
                        <?php echo $client[0]->name;?>
                        </p>
                        <hr>
                        <strong><i class=""></i> Address</strong>
                        <p class="text-muted">
                               <?php echo $client[0]->address;?></p>
                        <hr>
                        <strong><i class=""></i> Country</strong>
                        <p class="text-muted"> 
                               <?php echo $client[0]->country;?>  </p>
                        <hr>
                        <strong><i class=""></i> Tele: </strong>
                        <p> 
                             <?php echo $client[0]->telephone;?></p>
                        <hr>
                        <strong><i class=""></i>Mobile</strong>
                        <p>  
                             <?php echo $client[0]->mobile;?> </p>
                        <hr>
                        <strong><i class=""></i>Email</strong>
                        <p> 
                              <?php echo $client[0]->email;?></p>
                       
                     </div>
                  </div>
               </div>
               <!-- <button class="btn btn-primary nextBtn pull-right" style=" margin-top:20px;" type="button">Next</button> -->
        
         </div>
      </div>
   </div>
   </div>
   
   </section>
<script src="<?php echo base_url(); ?>/assets/user_scripts/transaction/payment_receipt.js"></script>
<!-- <script type="text/javascript"> -->