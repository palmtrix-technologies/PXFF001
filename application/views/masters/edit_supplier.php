<section class="content-header">
            <h1>
            Edit Supplier
            </h1>
          
          </section>
          <section class="content">
          <div class="box box-success">
          <div class="box-body">
          <form role="form">
                  <div class="box-body" style="min-height: 500px;">
                    <div class="form-group col-md-6 ">
                      <label for="name">Code</label>
                      <input type="hidden" name="id" id="id"  value="<?php  echo $value[0]->id;?>" />
                      <input type="text" class="form-control" required id="supplier_code"   readonly="readonly" placeholder="<?php  echo $value[0]->code;?>"  value="<?php  echo $value[0]->code;?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Supplier Name</label>
                      <input type="text" autocomplete="off" class="form-control" required id="supplier_name" placeholder="Enter supplier name"  value="<?php  echo $value[0]->supplier_name; ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Contact Person</label>
                      <input type="text" autocomplete="off" class="form-control" required id="contact_person" placeholder="Enter contact person"  value="<?php  echo $value[0]->contact_person; ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Address</label>
                      <input type="text" autocomplete="off" class="form-control" required id="supplier_address" placeholder="Enter supplier address"  value="<?php  echo $value[0]->address; ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">VAT.No</label>
                      <input type="text" autocomplete="off" class="form-control" required id="supplier_vat" placeholder="Enter VAT number"  value="<?php  echo $value[0]->vat_no; ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Country</label>
                      <input type="text" autocomplete="off" class="form-control" required id="supplier_country" placeholder="Enter country"  value="<?php  echo $value[0]->country; ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Telephone</label>
                      <input type="text" autocomplete="off" class="form-control" required id="supplier_telephone" placeholder="Enter telephone"  value="<?php  echo $value[0]->telephone; ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Mobile</label>
                      <input type="text" autocomplete="off" class="form-control" required id="supplier_mobile" placeholder="Enter mobile "  value="<?php  echo $value[0]->mobile; ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Fax</label>
                      <input type="text" autocomplete="off" class="form-control" required id="supplier_fax" placeholder="Enter fax"  value="<?php  echo $value[0]->fax; ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Email</label>
                      <input type="text" autocomplete="off" class="form-control" required id="supplier_email" placeholder="Enter email"  value="<?php  echo $value[0]->email; ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Remarks</label>
                      <input type="text" autocomplete="off" class="form-control" required id="supplier_remarks" placeholder="Enter remarks"  value="<?php  echo $value[0]->remarks; ?>">
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
<script src="<?php echo base_url(); ?>/assets/user_scripts/masters/supplier_script.js"></script>
      