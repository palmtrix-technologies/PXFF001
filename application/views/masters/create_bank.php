<?php 

// var_dump($code[0]);
// die();
?>
<section class="content-header">
 <h1>
  New Bank
 </h1>
</section>
 <section class="content">
    <div class="box box-success">
       <div class="box-body">
          <form role="form" method="POST">                                                                                                                                                                                      
                  <div class="box-body"  style="min-height:300px;">
                             
                  <div class="row">
                  <div class="form-group col-md-6">
                      <label for="exampleInputname1">Code</label>
                <input type="text" id="code"  name="code" class="form-control" readonly="readonly" placeholder="<?php echo $code[0]->code+1;?>"  value="<?php echo $code[0]->code+1;?>">
                    </div>
                   
                           <div class="form-group col-md-6">
                      <label for="exampleInputname1">Name</label>
                      <input type="text" id="name"  name="name"  class="form-control" autocomplete="off" placeholder="Enter name" required ></div>
                   
                               
                    <div class="form-group col-md-6 ">
                      <label>Acc Type*</label>
                      <select class="form-control" required name="acc_type" id="acc_type" value="">
                        <option value="savings">Savings</option>
                        <option value="current">Current</option>
                      </select>
                    </div>
                                <div class="form-group col-md-6">
									<label>A/C No.</label><span id="accmessage"></span>
									
									<input type="text" required class="form-control" id="acc-no" autocomplete="off"  onblur="checkacc()" name="acc-no">
								
                                </div>
                                <div class="form-group col-md-6">
									<label>IBAN</label>
									
										<input type="text" required autocomplete="off"  class="form-control" id="iban" name="iban">
								
                                </div>
                                <div class="form-group col-md-6">
									<label>Opening Balance</label>
									
										<input type="text" required autocomplete="off" class="form-control" id="opbal" name="opbal">
								
                                </div>
                                <div class="form-group col-md-6">
									<label>Other Information if any</label>
									
										<input type="text" autocomplete="off" class="form-control" id="otherinfo" name="otherinfo">
								
                                </div>
                         
</div>
                  <div class="box-footer">
                  <input type="submit"  onclick="storebank();" class="btn btn-success"></input>

                    <!-- <button type="button"  onclick="store();" class="btn btn-success">Save</button> -->
                    <button type="reset"  class="btn btn-success">Cancel</button>
                  </div>
                </form>
</div>
</div>
          </section>
          <script src="<?php echo base_url(); ?>/assets/js/moment.js"></script>
          <script src="<?php echo base_url(); ?>/assets/js/alert.js"></script>
          <script src="<?php echo base_url(); ?>/assets/user_scripts/masters/bank.js"></script>




  