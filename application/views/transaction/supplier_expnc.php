<?php 
  
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
            <h3 class="panel-title">Supplier Expenditure</h3>
         </div>
         <div class="panel-body">
         <div id="deleteModal" class="modal fade" role='dialog'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Delete </h4>
            </div>
            <div class="modal-body">
                <p>Do You Really Want to Delete This ?</p>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<span id= 'deleteButton'></span>
            </div>
			
        </div>
      </div>
  </div>

            <section class="content">
            <div class="col-md-10">
               <h4 class="box-title">Details</h4>
               <div class="box box-primary">
                  <div class="box-header with-border">
                     <div class="box-body">
                     <div class="row">
                     <div class="row">
          <div class="form-group col-md-2">
                    <label class="control-label">Exp Id</label><?php $ab=$this->session->userdata('user_id');?>
                    <input   type="hidden" id="userid"  class="form-control" placeholder="<?php echo $ab;?>"  value="<?php echo $ab; ?>"/>
                    <input type="hidden" name="eid" id="ejobid"  value="<?php  echo $jobdata[0]->JobId; ?>" />
                    <input maxlength="100" type="hidden" id="job_id"  class="form-control"  value="<?php echo $jobdata[0]->JobId;?>"/>
  
                    <input   type="text" id="epost_code" required="required" class="form-control" readonly="readonly"  placeholder="<?php echo $code[0]->PostId+1;?>"  value="<?php echo $code[0]->PostId+1;?>"/>
                </div>
                <div class="form-group col-md-2">
                  <label class="control-label" for="date">Posting Date</label>
      <input class="form-control" id="epost_date" autocomplete="off" name="date" placeholder="YYY/MM/DD" value="<?php echo $today; ?>" type="text"/>
              </div>
              <div class="form-group col-md-2">
                  <label class="control-label" for="date">Inv Date</label>
      <input class="form-control" id="einv_date" autocomplete="off" name="date" readonly="readonly" placeholder="YYY/MM/DD" type="text"/>
              </div>
                     </div>
                     <div class="row">

                     <div class="form-group col-md-3">
                  <label class="control-label" for="date">Select Supplier</label>
                  <input maxlength="100" type="text" id="view_supplier_name" autocomplete="off" required="required" class="form-control" placeholder=" supplier_name" value="">
                  <input maxlength="100" type="hidden" id="supplier_id" class="form-control" value="">
              </div>
              <div class="form-group col-md-3">
                  <label class="control-label" for="date">Ref/Invoice</label>
                  <input maxlength="100" type="text" autocomplete="off" id="einvoice" required="required" class="form-control" placeholder=" invoice" >
              </div>
              <!-- <div class="form-group col-md-3">
                  <label class="control-label" for="date">Invoice</label>
                  <input maxlength="100" type="text" autocomplete="off" id="einvoice_id" required="required" class="form-control" placeholder=" invoice" value="">
              </div> -->
              <div class="form-group col-md-3">
                              <label for="exampleInputname1">Mode </label>
                      <select class="form-control" id="emode" name="mode" value="--Select Type--">
                        <option value="credit">CREDIT</option>
                        <option value="cash">CASH</option>
                        
                      </select>
                              </div>
              <div class="col-md-12" style="border-bottom:1px solid #eee; margin-bottom:10px; height:2px;">
            </div>
</div>
                        <div class="row">
                           <!-- <div class="form-group col-md-1">
                              <label class="control-label">Code</label>
                              <input maxlength="100"  onchange="expensegetdata();" type="text" id="edesc_code" name="edesc_code" required="required" class="form-control" placeholder=" code" />
                           </div> -->
                           <div class="form-group col-md-3">
                              <label class="control-label">Description</label>
                              <input maxlength="100" type="text" id="edescription_job" required="required" class="form-control" placeholder=" Description" value=""/>
                              <input type="hidden" id="edescription_id" class="form-control" value="" />
                           </div>
                           <div class="row">
                              <div class="form-group col-md-2">
                                 <label class="control-label">Unit Price</label>
                                 <input maxlength="100" type="number" autocomplete="off" id="eunitprice" required="required" class="form-control " placeholder=" unit price" />
                              </div>
                              <div class="form-group col-md-2">
                                 <label class="control-label">Currency</label>
                                 <select class="form-control" id="eunit_price" name="unit_price"  value="--Select Type--">

                                 <?php 
                                  foreach($currency as $key=>$value)
                                  {
                                  ?>
                                 <option value="<?php echo $value->currency;?>"><?php echo $value->currency;?></option>
                                  <?php
                                  }
                                   ?></select>
                              </div>
                              <!-- <div class="form-group col-md-2">
                                 <label class="control-label">Conv.Fact</label>
                                 <input maxlength="100" autocomplete="off" type="number" id="econv_factor"  required="required" class="form-control " value="1" />
                              </div> -->
                             
                              <div class="form-group col-md-2">
                                 <label class="control-label">VAT</label>
                                 <input maxlength="100" autocomplete="off" type="number" id="evat" required="required" class="form-control" value="0" />
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
                                             <th>Description</th>
                                             <th>UnitPrice</th>
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
                                 <!-- /.box-body -->
                              </div>
                              <!-- /.box -->
                           </div>
                        </div>
                     </div>


                     <div class=" row">

<div class="form-group col-md-4">
<label for="issue_auth" class="col-sm-3 col-form-label">Document Type</label>
            <input type="text" name="doc_type" id="doc_type" class="form-control " value="">
            <span id="doc_type"></span>
</div>
<div class="form-group col-md-4">
<label for="fileupld" class="col-sm-3 col-form-label">Document Upload</label>
        <input type="file" name="fileupld" id="fileupld"  class="form-control " >
        <span id="filedoc"></span>
</div>
<div class="form-group col-md-4" style="margin-top: 44px;">
<input type="button" class="btn btn-primary btn-succes" id="btn_doc"   value="Add More Documents">
</div>
</div>
<div class="row">
   <div class="col-md-12">
   <table class="table">
   <thead>
   <tr>
   <td>Document Type</td>
   <td>Document</td>
   <td></td>
   </tr>
   </thead>
   <tbody class="data-body">
   </tbody>
   </table>
   </div>
   </div>

   <?php echo form_close() ?> 
      <?php  echo form_open_multipart('controller', array('id' => 'job_doc')); ?>
      <input type="hidden" value="<?php echo(rand(2000,6000));?>" name="dummyjobid" id="dummyjobid">
      <?php echo form_close() ?> 
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
               <div class="col-md-2">
               
                  <h4 class="box-title">Job Description </h4>
                  <div class="box box-primary">
                     <div class="box-header with-border">  
                     </div>
                     <div class="box-body">
                        <strong><i class=""></i> Job</strong>
                        <p class="text-muted" id="job_id">
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
                        <strong><i class=""></i>MBL/MAWB</strong>
                        <p><?php echo $jobdata[0]->Mbl;?> </p>
                        <hr>
                        <strong><i class=""></i>CARRIER</strong>
                        <p><?php echo $jobdata[0]->Carrier;?> </p>
                        <hr>
                        <strong><i class=""></i>POL</strong>
                        <p><?php echo $jobdata[0]->Pol;?></p>
                        <hr>
                        <strong><i class=""></i>POD</strong>
                        <p><?php echo $jobdata[0]->Pod;?></p>
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

<script src="<?php echo base_url(); ?>/assets/user_scripts/transaction/supplier_expense.js"></script>
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


<script>
  $('#job_doc').on('submit', function(e){ 
        
        var dummyid=$("#epost_code").val();  
      
        var type=$("#doc_type").val();                          
        var file_data = $('#fileupld').prop('files')[0];        //   alert(JSON.stringify(file_data, "", 2));
     
    
          var formdata = new FormData(this);
          formdata.append("exp_id", dummyid);
          formdata.append("doc_type", type);
          formdata.append("fileupld", file_data);
        
          e.preventDefault();              
               
                    $.ajax({  
                         url: "<?php echo base_url(); ?>transaction/Supplierexpense_Controller/create_exp_doc_ajax", 
                         method:"POST",  
                         fileElementId:'fileupld',
                         dataType: 'JSON',
                         data:formdata,  
                         contentType: false,  
                         cache: false,  
                         processData:false,  
                         success:function(response)  
                         {   
                              var   data =response.file_name;        
                                 did=response.did; 
                                 console.log(data);
      
                         
                              var extension = get_url_extension(data.replace(" ", "_"));       
                              var url = '<?php echo base_url(); ?>/assets/images/'+data.replace(" ", "_");
                           
                              if(extension=="pdf"){
                                url = '<?php echo base_url(); ?>/assets/images/pdf.png';
                              }else if(extension=="csv"){
                                url = '<?php echo base_url(); ?>/assets/images/excel.png';
                              }else if(extension=="doc"){
                                url = '<?php echo base_url(); ?>/assets/images/doc.png';
                              }else if(extension=="docx"){
                                url = '<?php echo base_url(); ?>/assets/images/doc.png'; 
                              }  
                             $(".data-body").append('<tr id="row' + did + '"><td>'+type+'</td><td><a href="<?php echo base_url(); ?>/assets/images/'+data+'" style="width:100px;" target="_blank"><img src="'+url+'" style="width:100px;"></a></td><td><button type="button"  class="btn btn-info btn-lg" onclick="confirmDeleteModal('+did+')">Delete</button></td></tr>');
                             $("#doc_type").val('');
                             $('#fileupld').val('');
                         }
                    });  
        });
</script>

<script type="text/javascript">
function confirmDeleteModal(id){   
    $('#deleteModal').modal();  
	$('#deleteButton').html('<a class="btn btn-danger" onclick="deleteData('+id+')">Delete</a>');
}     
function deleteData(id){  //alert(id);
    $('#row' + id).remove();
    $.ajax({  
                url: '<?php echo base_url(); ?>transaction/Supplierexpense_Controller/delete_exp_documents/'+id,                                   
                method:"POST", 
            dataType: 'JSON',
                data: {id:id} ,  
                success:function(data){ 
                  
                   
                }  
           });  
  
  $('#deleteModal').modal('hide'); // now close modal
}  
</script>