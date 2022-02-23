<section class="content-header">
            <h1>
            Edit Client
            </h1>
          
          </section>
          <section class="content">
          <div class="box box-success">
          <div class="box-body">
          <form role="form">
                  <div class="box-body" style="min-height: 300px;">
                  <div class=" row">
                    <div class="form-group col-md-6 ">
                      <label for="name">Code</label>
                      <input type="hidden" name="id" id="id"  value="<?php  echo $value[0]->id;?>" />
                      <input type="text" class="form-control" required id="client_code" readonly="readonly" placeholder="<?php  echo $value[0]->code;?>"  value="<?php  echo $value[0]->code;?>">
                    </div>
</div>
<div class=" row">
                    <div class="form-group col-md-6">
                      <label for="code">Name</label>
                      <input type="text" autocomplete="off" class="form-control" required id="client_name" value="<?php  echo $value[0]->name; ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Name Arabic</label>
                      <input type="text" autocomplete="off" class="form-control" required id="client_name_arabic" value="<?php  echo $value[0]->name_arabic; ?>">
                    </div></div>
                    <div class=" row">
                    <div class="form-group col-md-6">
                      <label for="code">Contact Person</label>
                      <input type="text" autocomplete="off" class="form-control" required id="contact_person" value="<?php  echo $value[0]->contact_person; ?>" >
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Contact Person Arabic</label>
                      <input type="text" autocomplete="off" class="form-control" required id="contact_person_arabic" value="<?php  echo $value[0]->contact_person_arabic; ?>" >
                    </div>
</div>
<div class=" row">
                    <div class="form-group col-md-6">
                      <label for="code">Address</label>
                      <input type="text" autocomplete="off" class="form-control" required id="client_address" value="<?php  echo $value[0]->address; ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Address Arabic</label>
                      <input type="text" autocomplete="off" class="form-control" required id="client_address_arabic" value="<?php  echo $value[0]->address_arabic; ?>">
                    </div></div>
                    <div class=" row">
                    <div class="form-group col-md-6">
                      <label for="code">VAT.No</label>  
                       <input type="text" autocomplete="off" class="form-control" required id="client_vat" value="<?php  echo $value[0]->vat_no; ?>">
                    </div></div>
                    
                    <div class=" row">
                    <div class="form-group col-md-6">
                      <label for="code">Country</label>
                      <input type="text" autocomplete="off" class="form-control" required id="client_country" value="<?php  echo $value[0]->country; ?>" >
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Country Arabic</label>
                      <input type="text" autocomplete="off" class="form-control" required id="client_country_arabic" value="<?php  echo $value[0]->country_arabic; ?>" >
                    </div></div>
                    
                    <div class=" row">
                    <div class="form-group col-md-6">
                      <label for="code">Remarks</label>
                      <input type="text" autocomplete="off" class="form-control" required id="client_remarks" value="<?php  echo $value[0]->remarks; ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Remarks Arabic</label>
                      <input type="text" autocomplete="off" class="form-control" required id="client_remarks_arabic"  value="<?php  echo $value[0]->remarks_arabic; ?>"> 
                    </div></div>
                    <div class=" row">
                    <div class="form-group col-md-6">
                      <label for="code">Vendror Id</label>
                      <input type="text" autocomplete="off" class="form-control" required id="vendor_id" value="<?php  echo $value[0]->vendor_id; ?>" >
                    </div></div>
                    <div class=" row">
                    <div class="form-group col-md-6">
                      <label for="code">Telephone</label>
                      <input type="text" autocomplete="off" class="form-control" required id="client_telephone" value="<?php  echo $value[0]->telephone; ?>" >
                    </div></div>
                    <div class=" row">
                    <div class="form-group col-md-6">
                      <label for="code">Mobile</label>
                      <input type="text" autocomplete="off" class="form-control" required id="client_mobile" value="<?php  echo $value[0]->mobile; ?>">
                    </div>  </div>
                    <div class=" row">
                    <div class="form-group col-md-6">
                      <label for="code">Fax</label>
                      <input type="text" autocomplete="off" class="form-control" required id="client_fax" value="<?php  echo $value[0]->fax; ?>">
                    </div>  </div>
                    <div class=" row">
                    <div class="form-group col-md-6">
                      <label for="code">Email</label>
                      <input type="text" autocomplete="off" class="form-control" required id="client_email" value="<?php  echo $value[0]->email; ?>">
                    </div>
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
<script src="<?php echo base_url(); ?>/assets/user_scripts/masters/client_script.js"></script>
      