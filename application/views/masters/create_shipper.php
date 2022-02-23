<section class="content-header">
            <h1>
            New Shipper
            </h1>
          
          </section>
          <section class="content">
          <div class="box box-success">
          <div class="box-body">
          <form role="form">
                  <div class="box-body" style="min-height:400px;">
                  <div class="form-group col-md-6">
                      <label for="exampleInputname1">Code</label>
                <input type="text" id="shipper_code"  name="shipper_code" class="form-control" readonly="readonly" placeholder="<?php echo $code[0]->code+1;?>"  value="<?php echo $code[0]->code+1;?>">
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label for="code"> Name</label>
                      <input type="text" autocomplete="off" class="form-control" required id="shipper_name" placeholder="Enter shipper name">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Contact Person</label>
                      <input type="text" autocomplete="off" class="form-control" required id="contact_person" placeholder="Enter contact person">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Address</label>
                      <input type="text" autocomplete="off" class="form-control" required id="shipper_address" placeholder="Enter shipper address">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Country</label>
                      <input type="text" autocomplete="off" class="form-control" required id="shipper_country" placeholder="Enter country">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Telephone</label>
                      <input type="text" autocomplete="off" class="form-control" required id="shipper_telephone" placeholder="Enter telephone">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Mobile</label>
                      <input type="text" autocomplete="off" class="form-control" required id="shipper_mobile" placeholder="Enter mobile ">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Fax</label>
                      <input type="text" autocomplete="off" class="form-control" required id="shipper_fax" placeholder="Enter fax">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Email</label>
                      <input type="text" autocomplete="off" class="form-control" required id="shipper_email" placeholder="Enter email">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Remarks</label>
                      <input type="text" autocomplete="off" class="form-control" required id="shipper_remarks" placeholder="Enter remarks">
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="button" onclick="add();" class="btn btn-success">Save</button>
                    <button type="reset"  class="btn btn-success">Cancel</button>
                  </div>
                </form>
          </div>
</div>
          </section>

<script src="<?php echo base_url(); ?>/assets/js/moment.js"></script>
<script src="<?php echo base_url(); ?>/assets/user_scripts/masters/shipper_script.js"></script>
      