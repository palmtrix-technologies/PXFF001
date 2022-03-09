<section class="content-header">
            <h1>
            New Client
            </h1>
          
          </section>
          <section class="content">
          <div class="box box-success">
          <div class="box-body">
          <form role="form" method="post">
                  <div class="box-body" style="min-height: 300px;">
                  <div class=" row">
                  <div class="form-group col-md-6">
                      <label for="exampleInputname1">Code</label>
                <input type="text" id="client_code"  name="client_code" class="form-control" readonly="readonly" placeholder="<?php echo $code[0]->code+1;?>"  value="<?php echo $code[0]->code+1;?>">
                    </div>
</div>
<div class=" row">
                    <div class="form-group col-md-6">
                      <label for="code">Name</label>
                      <input type="text" class="form-control" autocomplete="off" required id="client_name" placeholder="Enter cliet name">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Name Arabic</label>
                      <input type="text" class="form-control" autocomplete="off" required id="client_name_arabic" placeholder="Enter cliet name">
                    </div></div>
                    <div class=" row">
                    <div class="form-group col-md-6">
                      <label for="code">Contact Person</label>
                      <input type="text" class="form-control" autocomplete="off" required id="contact_person" placeholder="Enter contact person">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Contact Person Arabic</label>
                      <input type="text" class="form-control" autocomplete="off" required id="contact_person_arabic" placeholder="Enter contact person">
                    </div>
</div>
<div class=" row">
                    <div class="form-group col-md-6">
                      <label for="code">Address</label>
                      <input type="text" class="form-control" autocomplete="off" required id="client_address" placeholder="Enter supplier address">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Address Arabic</label>
                      <input type="text" class="form-control" autocomplete="off" required id="client_address_arabic" placeholder="Enter supplier address">
                    </div></div>
                    <div class=" row">
                    <div class="form-group col-md-6">
                      <label for="code">VAT.No</label>
                      <input type="text" class="form-control" autocomplete="off" required id="client_vat" placeholder="Enter VAT number">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">TRN.No</label>
                      <input type="text" class="form-control" autocomplete="off" required id="client_trn" placeholder="Enter TRN number">
                    </div>
                  
                  </div>
                    
                    <div class=" row">
                    <div class="form-group col-md-6">
                      <label for="code">Country</label>
                      <input type="text" class="form-control" autocomplete="off" required id="client_country" placeholder="Enter country">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Country Arabic</label>
                      <input type="text" class="form-control" autocomplete="off" required id="client_country_arabic" placeholder="Enter country">
                    </div></div>
                    
                    <div class=" row">
                    <div class="form-group col-md-6">
                      <label for="code">Remarks</label>
                      <input type="text" class="form-control" autocomplete="off" required id="client_remarks" placeholder="Enter remarks">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Remarks Arabic</label>
                      <input type="text" class="form-control" autocomplete="off"  required id="client_remarks_arabic" placeholder="Enter remarks">
                    </div></div>
                    <div class=" row">
                    <div class="form-group col-md-6">
                      <label for="code">Vendror Id</label>
                      <input type="text" class="form-control" autocomplete="off" required id="vendor_id" placeholder="Enter remarks">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Openning Balance</label>
                      <input type="text" class="form-control" autocomplete="off" required id="opnbal" placeholder="Enter Openning Balance">
                    </div></div>
                    <div class=" row">
                    <div class="form-group col-md-6">
                      <label for="code">Telephone</label>
                      <input type="text" class="form-control" autocomplete="off" required id="client_telephone" placeholder="Enter telephone">
                    </div></div>
                    <div class=" row">
                    <div class="form-group col-md-6">
                      <label for="code">Mobile</label>
                      <input type="text" class="form-control" autocomplete="off" required id="client_mobile" placeholder="Enter mobile ">
                    </div>  </div>
                    <div class=" row">
                    <div class="form-group col-md-6">
                      <label for="code">Fax</label>
                      <input type="text" class="form-control" autocomplete="off" required id="client_fax" placeholder="Enter fax">
                    </div>  </div>
                    <div class=" row">
                    <div class="form-group col-md-6">
                      <label for="code">Email</label><span id="message"></span>
                      <!-- <input type="text" class="form-control" required id="client_email" name="client_email" onblur="checkclient()"  placeholder="Enter email"> -->
                      <input type="text" class="form-control" autocomplete="off" required id="client_email" name="client_email"   placeholder="Enter email">

                    </div>

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
<script src="<?php echo base_url(); ?>/assets/user_scripts/masters/client_script.js"></script>
      