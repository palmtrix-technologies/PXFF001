<section class="content-header">
            <h1>
            New Supplier
            </h1>
          
          </section>
          <section class="content">
          <div class="box box-success">
          <div class="box-body">
          <form role="form" method="post">
                  <div class="box-body" style="min-height:500px;">
                  <div class="form-group col-md-6">
                      <label for="exampleInputname1">Code</label>
                <input type="text" id="supplier_code"  name="supplier_code" class="form-control" readonly="readonly" placeholder="<?php echo $code[0]->code+1;?>"  value="<?php echo $code[0]->code+1;?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Supplier Name</label>
                      <input type="text" autocomplete="off" class="form-control" required id="supplier_name" placeholder="Enter supplier name">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Contact Person</label>
                      <input type="text" autocomplete="off" class="form-control" required id="contact_person" placeholder="Enter contact person">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Address</label>
                      <input type="text" autocomplete="off" class="form-control" required id="supplier_address" placeholder="Enter supplier address">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">VAT.No</label>
                      <input type="text" autocomplete="off" class="form-control" required id="supplier_vat" placeholder="Enter VAT number">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Country</label>
                      <input type="text" autocomplete="off" class="form-control" required id="supplier_country" placeholder="Enter country">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Telephone</label>
                      <input type="text" autocomplete="off" class="form-control" required id="supplier_telephone" placeholder="Enter telephone">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Mobile</label>
                      <input type="text" autocomplete="off" class="form-control" required id="supplier_mobile" placeholder="Enter mobile ">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Fax</label>
                      <input type="text" autocomplete="off" class="form-control" required id="supplier_fax" placeholder="Enter fax">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Email</label>
                      <input type="text" autocomplete="off" class="form-control" required id="supplier_email" placeholder="Enter email">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Remarks</label>
                      <input type="text" autocomplete="off" class="form-control" required id="supplier_remarks" placeholder="Enter remarks">
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
<script src="<?php echo base_url(); ?>/assets/user_scripts/masters/supplier_script.js"></script>
      