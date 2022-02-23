
<section class="content-header">
 <h1>
  Edit Bank
 </h1>
</section>
 <section class="content">
    <div class="box box-success">
       <div class="box-body">
          <form role="form">
                  <div class="box-body"  style="min-height: 300px;">
                   
                  
                    
                  <div class="row">
                  <div class="form-group col-md-6">
                      <label for="exampleInputname1">Code</label>
                      <input type="text" id="code"  name="code" class="form-control" readonly="readonly"   value="<?php  echo $value[0]->code;?>" >
                    </div>
                                <div class="form-group col-md-6">
                      <label for="exampleInputname1">Name</label>
                      <input type="text" id="name"  autocomplete="off" name="name" class="form-control"  value="<?php  echo $value[0]->bank_name;?>">
                      <input type="hidden" name="id" id="id"  value="<?php  echo $value[0]->id;?>" />
                    </div>
                    <div class="form-group col-md-6 ">
                      <label>Account Type</label>
                      <select class="form-control" name="acc_type" id="acc_type">
                      <option selected="selected" value="<?php  echo $value[0]->acc_type;?>"><?php  echo $value[0]->acc_type;?></option>
                     <?php if($value[0]->acc_type!="savings"){ ?>  <option value="savings">Savings</option><?php } ?> 
                     <?php if($value[0]->acc_type!="current"){ ?>  <option value="current">Current</option><?php } ?> 

                      </select>
                    </div>
                                <div class="form-group col-md-6">
									<label>A/C No.</label>
									
									<input type="text" class="form-control" autocomplete="off" id="acc-no" name="acc-no" value="<?php  echo $value[0]->acc_number;?>" >
								
                                </div>
                                <div class="form-group col-md-6">
									<label>IBAN</label>
									
										<input type="text" class="form-control" autocomplete="off" id="iban" name="iban" value="<?php  echo $value[0]->iban;?>" >
								
                                </div>
                                <div class="form-group col-md-6">
									<label>Opening Balance</label>
									
										<input type="text" class="form-control" autocomplete="off" id="opbal" name="opbal" value="<?php  echo $value[0]->opening_bal;?>" >
								
                                </div>
                                <div class="form-group col-md-6">
									<label>Other Information if any</label>
									
										<input type="text" class="form-control" autocomplete="off" id="otherinfo" name="otherinfo" value="<?php  echo $value[0]->other_info;?>" >
								
                                </div>
                              
                               
                               
</div>
<div class="box-footer">
                    <button type="button"  onclick="update();" class="btn btn-success">Update</button>
                    <button type="reset" class="btn btn-success">Cancel</button>
                  </div>
                </form>
</div>
</div>
          </section>
          <script src="<?php echo base_url(); ?>/assets/js/moment.js"></script>
          <script src="<?php echo base_url(); ?>/assets/plugins/iCheck/icheck.min.js"></script>
          <script src="<?php echo base_url(); ?>/assets/user_scripts/masters/bank.js"></script>




  