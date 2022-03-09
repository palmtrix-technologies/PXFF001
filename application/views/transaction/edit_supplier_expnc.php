
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
            <h3 class="panel-title">Supplier Expenditure</h3>
         </div>
         <div class="panel-body">
            <section class="content">
            <div class="col-md-10">
               <h4 class="box-title">Details</h4>
               <div class="box box-primary">
                  <div class="box-header with-border">
                     <div class="box-body">
                     <div class="row">
                     <div class="form-group col-md-1">
                    <label class="control-label">Exp Id</label>
                    <input type="hidden" name="id" id="id"  value="<?php  echo $expensedata[0]->JobId; ?>" />
                    <input type="hidden" name="master_id" id="master_id"  value="<?php  echo $expensedata[0]->ExpenseMasterId; ?>" />
                    <input   type="text" id="post_code" required="required" class="form-control" readonly="readonly"  placeholder="<?php echo $expensedata[0]->PostId;?>"  value="<?php echo $expensedata[0]->PostId;?>"/>
                </div>
                <div class="form-group col-md-2">
                  <label class="control-label" for="date">Posting Date</label>
                       <input class="form-control" autocomplete="off" value="<?php  echo $expensedata[0]->PostingDate; ?>"  id="post_date" name="date" placeholder="YYY/MM/DD" type="text"/>
              </div>
              <div class="form-group col-md-2">
                  <label class="control-label" for="date">Inv Date</label>
                       <input class="form-control" autocomplete="off" value="<?php  echo $expensedata[0]->InvDate; ?>" id="inv_date" name="date" placeholder="YYY/MM/DD" type="text"/>
              </div>

                <div class="form-group col-md-2">
                  <label class="control-label" for="date">Select Supplier</label>
                  <input maxlength="100" type="text" autocomplete="off" value="<?php  echo $expensedata[0]->supplier_name; ?>" id="view_supplier_name" required="required" class="form-control" placeholder=" supplier_name" value="">
                  <input maxlength="100" type="hidden" id="supplier_id" class="form-control" value="<?php  echo $expensedata[0]->id; ?>">
              </div>
              <div class="form-group col-md-2">
                  <label class="control-label" for="date">Ref/Invoice</label>
                  <input maxlength="100" type="text" autocomplete="off" value="<?php  echo $expensedata[0]->Reference; ?>" id="invoice" required="required" class="form-control" placeholder=" invoice" value="">
              </div>
              <!-- <div class="form-group col-md-1">
                  <label class="control-label" for="date">Our Inv</label>
                  <input maxlength="100" type="text" autocomplete="off" value="<?php  echo $expensedata[0]->OurInv; ?>" id="invoice_id" required="required" class="form-control" placeholder=" invoice" value="">
              </div> -->
              <div class="form-group col-md-2">
                              <label for="exampleInputname1">Mode </label>
                      <select class="form-control" id="mode" name="mode" value="--Select Type--">
                      <option value="<?php echo $expensedata[0]->Mode; ?>"><?php echo $expensedata[0]->Mode; ?></option>
                                 <?php if($expensedata[0]->Mode!="credit"){ ?>  <option value="credit">credit</option><?php } ?> 
                                 <?php if($expensedata[0]->Mode!="cash"){ ?>  <option value="cash">cash</option><?php } ?> 
                      </select>
                              </div>
              <div class="col-md-12" style="border-bottom:1px solid #eee; margin-bottom:10px; height:2px;"></div>
</div>
                        <div class="row">
                           <!-- <div class="form-group col-md-1">
                              <label class="control-label">Code</label>
                              <input maxlength="100"  onchange="getdata();" type="text" id="desc_code" name="desc_code" required="required" class="form-control" placeholder=" code" />
                           </div> -->
                           <div class="form-group col-md-2">
                              <label class="control-label">Description</label>
                              <input maxlength="100" type="text" id="edescription_job" required="required" class="form-control" placeholder=" Description" value=""/>
                              <input type="hidden" id="edescription_id" class="form-control" value="" />

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

foreach($currencylist as $currency)
{ 
  echo '<option value="'.$currency->currency.'" id="'.$currency->id.'">'.$currency->currency.'</option>';
  

}
?>
                                 </select>
                              </div>
                              <div class="form-group col-md-1">
                                 <label class="control-label">Conv.Factor</label>
                                 <input maxlength="100" autocomplete="off" type="text" id="conv_factor"  required="required" class="form-control " value="1" />
                              </div>
                             
                              <div class="form-group col-md-1">
                                 <label class="control-label">VAT</label>
                                 <input maxlength="100" autocomplete="off" type="text" id="vat" required="required" class="form-control" value=" 0" />
                              </div>
                             
                           </div>
                           <input type="button" name="add" value="ADD" onclick="insert_expense();" id="add" class="btn btn-success" style="float: right;">
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
                                             <th>Description</th>
                                             <th>UnitPrice</th>
                                             <th>Sub total</th>
                                             <th>VAT</th>
                                             <th>TOTAL</th>
                                             <th></th>
                                          </tr>
                                       </thead>
                                       <tbody class="dataadd"> 
                                       <?php foreach($expnc as $key=>$value) {
                                        ?>
<tr>
                              <td class="job_desc"><?php echo $value->Description; ?> </td>
                               <td class="job_price"><?php echo $value->Amount; ?></td>
                               <td class='subtotalval_data'><?php echo ($value->Amount)*($value->ConvFactor); ?></td>
                                <td class="taxval_data"><?php echo $value->Vat; ?> </td>
                                 <td class="totalval_data"><?php echo $value->Total; ?></td>
                                  <td>
                                  <a class="" onclick="deletedids(<?php echo $value->ExpenseDetailId; ?>,this)"><i class="fa fa-trash-o"></i></a>
                                  <input type="hidden" class="currency" value="<?php echo $value->Currency; ?>"/>
                                  <input type='hidden' class="cov_factor" value="<?php echo $value->ConvFactor; ?>"/>
                                  <input type='hidden' class="exp_detail_id" value="<?php echo $value->ExpenseDetailId; ?>"/>
                                  <input type='hidden' class="desc_code" value="<?php echo $value->Code; ?>"/>
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
                                       <input name="total" type="text" value="<?php echo $expensedata[0]->SubTotal; ?>" readonly="readonly" id="total" class="form-control " style="width: 100%;">
                                       <span id="ContentPlaceHolder1_Label1">Vat Total</span>        
                                       <input name="vat_total" type="text" value="<?php echo $expensedata[0]->VatTotal; ?>" readonly="readonly" id="vat_total" class="form-control " style="width: 100%;"> 
                                       <span id="ContentPlaceHolder1_Label2">Grand Total</span>        
                                       <input name="grand_total" type="text" value="<?php echo $expensedata[0]->GrandTotal; ?>" readonly="readonly" id="grand_total" class="form-control " style="width: 100%;">                 
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
                         
                          
                           
                           <div class="form-group col-md-2">
                         
                              <input class=" btn btn-success" type="button" name="add_expense" onclick="update_expense_details();" style=" margin-top:20px;" value="Submit" id="add_expense">
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
                        <p class="text-muted" id="job_id">
                        <?php echo $expensedata[0]->Jobcode;?>
                        </p>
                        <hr>
                        <strong><i class=""></i> Shipper</strong>
                        <p class="text-muted">    <?php echo $expensedata[0]->consignor;?></p>
                        <hr>
                        <strong><i class=""></i> Consignee</strong>
                        <p class="text-muted">   <?php echo $expensedata[0]->consignee;?></p>
                        <hr>
                        <strong><i class=""></i> Client </strong>
                        <p> <?php echo $expensedata[0]->clientenglish;?></p></p>
                        <hr>
                        <strong><i class=""></i>Mode</strong>
                        <p> <?php echo $expensedata[0]->Type;?> </p>
                        <hr>
                        <strong><i class=""></i>Weight</strong>
                        <p> <?php echo $expensedata[0]->ActualWeight;?> </p>
                        <hr>
                        <strong><i class=""></i>ETA</strong>
                        <p> <?php echo $expensedata[0]->Eta;?> </p>
                        <hr>
                        <strong><i class=""></i>ETD</strong>
                        <p><?php echo $expensedata[0]->Etd;?></p>
                        <hr>
                        <strong><i class=""></i>MBL/MAWB</strong>
                        <p><?php echo $expensedata[0]->Mbl;?> </p>
                        <hr>
                        <strong><i class=""></i>CARRIER</strong>
                        <p><?php echo $expensedata[0]->Carrier;?> </p>
                        <hr>
                        <strong><i class=""></i>POL</strong>
                        <p><?php echo $expensedata[0]->Pol;?></p>
                        <hr>
                        <strong><i class=""></i>POD</strong>
                        <p><?php echo $expensedata[0]->Pod;?></p>
                        <hr>
                        <strong><i class=""></i>PO NO</strong>
                        <p><?php echo $expensedata[0]->PoNo;?></p>
                     </div>
                  </div>
               </div>
             
            </div>
      
      </div>
   </div>

   </div>
   </section>

<script src="<?php echo base_url(); ?>/assets/user_scripts/transaction/edit_supplier_expense.js"></script>
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