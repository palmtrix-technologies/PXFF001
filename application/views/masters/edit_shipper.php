<section class="content-header">
            <h1>
            Edit Shipper
            </h1>
          
          </section>
          <section class="content">
          <div class="box box-success">
          <div class="box-body">
          <form role="form">
                  <div class="box-body" style="min-height: 300px;">
                    <div class="form-group col-md-6 ">
                      <label for="name">Code</label>
                      <input type="hidden" name="id" id="id"    value="<?php  echo $value[0]->id;?>"/>
                      <input type="text" class="form-control" required id="shipper_code"    readonly="readonly" placeholder="<?php  echo $value[0]->code;?>"  value="<?php  echo $value[0]->code;?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Shipper Name</label>
                      <input type="text" autocomplete="off" class="form-control" required id="shipper_name"   value="<?php  echo $value[0]->name; ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Contact Person</label>
                      <input type="text" autocomplete="off" class="form-control" required id="contact_person" value="<?php  echo $value[0]->contact_person; ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Address</label>
                      <input type="text"  autocomplete="off" class="form-control" required id="shipper_address"   value="<?php  echo $value[0]->address; ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Country</label>
                      <input type="text" autocomplete="off" class="form-control" required id="shipper_country" value="<?php  echo $value[0]->country; ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Telephone</label>
                      <input type="text" autocomplete="off" class="form-control" required id="shipper_telephone"  value="<?php  echo $value[0]->telephone; ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Mobile</label>
                      <input type="text" autocomplete="off" class="form-control" required id="shipper_mobile" value="<?php  echo $value[0]->mobile; ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Fax</label>
                      <input type="text" autocomplete="off" class="form-control" required id="shipper_fax"  value="<?php  echo $value[0]->fax; ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Email</label>
                      <input type="text" autocomplete="off" class="form-control" required id="shipper_email"   value="<?php  echo $value[0]->email; ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Remarks</label>
                      <input type="text" autocomplete="off" class="form-control" required id="shipper_remarks"   value="<?php  echo $value[0]->remarks; ?>">
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="button" onclick="update();" class="btn btn-success">Save</button>
                    <button type="reset"  class="btn btn-success">Cancel</button>
                  </div>
                </form>
          </div>
</div>
          </section>

<script src="<?php echo base_url(); ?>/assets/js/moment.js"></script>
<script src="<?php echo base_url(); ?>/assets/user_scripts/masters/shipper_script.js"></script>
      