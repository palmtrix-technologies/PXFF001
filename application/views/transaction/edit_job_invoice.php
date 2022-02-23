<?php 
   // var_dump($curreny);
   // // var_dump ($Inv);
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
                           <div class="form-group col-md-2">
                              <label class="control-label">Inv*</label>
                              <input   type="text" id="inv_code" required="required" class="form-control" readonly="readonly"  placeholder="<?php echo $invoicedata[0]->Inv;?>"  value="<?php echo $invoicedata[0]->Inv;?>"/>
                                <input type="hidden" id="invid" value="<?php echo $invoicedata[0]->InvoiceMasterId;?>" />
                           </div>
                           <div class="form-group col-md-3">
                              <label class="control-label">Date</label>
                              <input type="date"  autocomplete="off" value="<?php echo $invoicedata[0]->Date; ?>" class="form-control" required id="date" name="date" ></input>
                              
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
                           <div class="row">
                              <div class="form-group col-md-2">
                                 <label class="control-label">Unit Price</label>
                                 <input maxlength="100" autocomplete="off" type="text" id="unitprice" required="required" class="form-control " placeholder=" unit price" />
                              </div>
                              <div class="form-group col-md-2">
                                 <label class="control-label">Currency</label>
                                 <select class="form-control" id="unit_price" name="unit_price"  value="--Select Type--">
                                    <?php 

foreach($currency as $currency)
{ 
  echo '<option value="'.$currency->currency.'" id="'.$currency->id.'">'.$currency->currency.'</option>';
  

}
?>
                                 </select>
                              </div>
                              <div class="form-group col-md-1">
                                 <label class="control-label">Conv.Fact</label>
                                 <input maxlength="100" autocomplete="off" type="text" id="conv_factor"  required="required" class="form-control " value="1" />
                              </div>
                              <div class="form-group col-md-1">
                                 <label class="control-label">Quantity</label>
                                 <input maxlength="100" autocomplete="off" type="text" id="quantity" required="required" class="form-control " value=" 1" />
                              </div>
                              <div class="form-group col-md-1">
                                 <label class="control-label">VAT</label>
                                 <input maxlength="100" autocomplete="off" type="text" id="vat" required="required" class="form-control" value=" 0" />
                              </div>

                           </div>

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
                                             <th></th>
                                          </tr>
                                       </thead>
                                       <tbody class="dataadd"> 
                                    <?php foreach($invoice as $key=>$value) {
                                        ?>
                              <tr>
                              <td class="job_desc"><?php echo $value->Description; ?> </td>
                               <td class="job_price"><?php echo $value->UnitPrice; ?></td>
                               <td class='job_quantity'><?php echo $value->Quantity; ?></td>
                                <td class="subtotalval_data"><?php echo $value->Total-$value->Vat; ?></td> 
                                <td class="taxval_data"><?php echo $value->Vat; ?> </td>
                                 <td class="totalval_data"><?php echo $value->Total; ?></td>
                                  <td>
                                  <a class="" onclick="deletedids(<?php echo $value->InvoiceDetailId; ?>,this)"><i class="fa fa-trash-o"></i></a>
                                  <input type="hidden" class="currency" value="<?php echo $value->Currency; ?>"/>
                                  <input type='hidden' class="cov_factor" value="<?php echo $value->ConvFactor; ?>"/>
                                  <input type='hidden' class="inv_detail_id" value="<?php echo $value->InvoiceDetailId; ?>"/>
                                   </td>
                              </tr>
                                       <?php  } ?>  
                                       </tbody>
                                       <tfoot>
                                       </tfoot>
                                    </table>
                                 </div>
                                 <div id="ContentPlaceHolder1_upTotals">
                                    <div style="float: right;">
                                       <span id="ContentPlaceHolder1_lbl">TOTAL</span>        
                                       <input name="total" type="text" value="<?php echo $invoicedata[0]->Total; ?>" readonly="readonly" id="total" class="form-control " style="width: 100%;">
                                       <span id="ContentPlaceHolder1_Label1">Vat Total</span>        
                                       <input name="vat_total" type="text" value="<?php echo $invoicedata[0]->VatTotal; ?>" readonly="readonly" id="vat_total" class="form-control " style="width: 100%;"> 
                                       <span id="ContentPlaceHolder1_Label2">Grand Total</span>        
                                       <input name="grand_total" type="text" value="<?php echo $invoicedata[0]->GrandTotal; ?>" readonly="readonly" id="grand_total" class="form-control " style="width: 100%;">                 
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
                              <select class="form-control" id="bank" name="bank"  value=" ">
                              <option value="<?php echo  $invoicedata[0]->id;?>"><?php echo  $invoicedata[0]->bank_name;?></option>

                                 <?php
                                    foreach($bank as $key=>$value)
                                    {
                              if($value->bank_name!= $invoicedata[0]->bank_name)
                              {
                              ?>
                              
                                 <option value="<?php echo $value->id;?>"><?php echo $value->bank_name;?></option>
                                 <?php
                                      }  }
                                    ?>
                              </select>
                           </div>
                           <div class="form-group col-md-4">
                              <label class="control-label">Invoice Type:</label>
                              <select class="form-control" id="type" name="type"  onchange="visible_cash();"  value="">
                                 <option value="<?php echo $invoicedata[0]->InvoiceType; ?>"><?php echo $invoicedata[0]->InvoiceType; ?></option>
                                 <?php if($invoicedata[0]->InvoiceType!="credit"){ ?>  <option value="credit">Credit</option><?php } ?> 
                                 <?php if($invoicedata[0]->InvoiceType!="cash"){ ?>  <option value="cash">Cash</option><?php } ?> 
                              </select>
                           </div>
                           <div class="form-group col-md-4" id="receipt">
                              <label class="control-label">   Receipt No(Only for Cash):</label>
                              <input maxlength="100" type="text" id="receipt_no"  class="form-control " value="<?php echo $invoicedata[0]->ReceiptNo; ?>" />
                           </div>
                           <div class="form-group col-md-4" id="description">
                              <label class="control-label"></label>
                              <input maxlength="100" type="text" id="adv_desc"  class="form-control " value="<?php echo $invoicedata[0]->ReceiptDescription; ?>" />
                           </div>
                           <div class="form-group col-md-4" id="amnt">
                              <label class="control-label"></label>
                              <input maxlength="100" type="text" id="amount"  class="form-control " value="<?php echo $invoicedata[0]->Amount; ?>" />
                           </div>
                           <div class="form-group col-md-2">
                              <input type="button" name="submit" onclick="update_jobInvoice_details();" style=" margin-top:20px;" value="Update" id="submit" class="btn btn-success"  >
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               </div>
               <div class="col-md-2">
                  <h4 class="box-title">Job Description </h4>
                  <div class="box box-primary">
                     <div class="box-header with-border">  
                     </div>
                     <div class="box-body">
                        <strong><i class=""></i> Job</strong>
                        <p class="text-muted">
                           <?php echo $invoicedata[0]->Number;?>
                        </p>
                        <hr>
                        <strong><i class=""></i> Shipper</strong>
                        <p class="text-muted">    <?php echo $invoicedata[0]->consignor;?></p>
                        <hr>
                        <strong><i class=""></i> Consignee</strong>
                        <p class="text-muted">    <?php echo $invoicedata[0]->consignee;?> </p>
                        <hr>
                        <strong><i class=""></i> Client </strong>
                        <p> <?php echo $invoicedata[0]->clientenglish;?></p>
                        <hr>
                        <strong><i class=""></i>Mode</strong>
                        <p> <?php echo $invoicedata[0]->Type;?> </p>
                        <hr>
                        <strong><i class=""></i>Weight</strong>
                        <p> <?php echo $invoicedata[0]->ActualWeight;?> </p>
                        <hr>
                        <strong><i class=""></i>ETA</strong>
                        <p> <?php echo $invoicedata[0]->Eta;?> </p>
                        <hr>
                        <strong><i class=""></i>ETD</strong>
                        <p><?php echo $invoicedata[0]->Etd;?></p>
                       
                        <hr>
                        <strong><i class=""></i>CARRIER</strong>
                        <p><?php echo $invoicedata[0]->Carrier;?> </p>
                       
                        <hr>
                        <strong><i class=""></i>PO NO</strong>
                        <p><?php echo $invoicedata[0]->PoNo;?></p>
                     </div>
                  </div>
               </div>
               <!-- <button class="btn btn-primary nextBtn pull-right" style=" margin-top:20px;" type="button">Next</button> -->
            </div>
         </div>
      </div>
   
   </div>
   </section>
<script src="<?php echo base_url(); ?>/assets/user_scripts/transaction/edit_job_invoice.js"></script>
<!-- <script type="text/javascript"> -->

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