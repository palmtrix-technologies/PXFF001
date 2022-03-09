<section class="content-header">
            <h1>
            Edit Vehicle
            </h1>
          
          </section>
          <section class="content">
          <div class="box box-success">
          <div class="box-body">
          <form role="form">
                  <div class="box-body" style="min-height: 500px;">
                  <div class="form-group col-md-6">
                    <label for="exampleInputname1">Code</label>
                    <input type="hidden" name="id" id="id"  value="<?php  echo $value[0]->vehicleid;?>" />
                    <input type="text" id="vehicle_code" value="<?php  echo $value[0]->vehicle_code;?>"   name="vehicle_code" class="form-control" readonly="readonly">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Vehicle Number</label>
                      <input type="text" autocomplete="off" class="form-control" required id="Vehicle_number" value="<?php  echo $value[0]->Vehicle_number;?>"  placeholder="Enter Vehicle Number">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Vehicle manufacturer</label>
                      <input type="text" autocomplete="off" class="form-control" required id="vehicle_manufactur" value="<?php  echo $value[0]->vehicle_manufactur;?>"  placeholder="Enter manufacturer">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Vehicle Model</label>
                      <input type="text" autocomplete="off" class="form-control" required id="vehicle_model" value="<?php  echo $value[0]->vehicle_model;?>"  placeholder="Enter Model">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Vehicle category</label>
                      <input type="text" autocomplete="off" class="form-control" required id="vehicle_category" value="<?php  echo $value[0]->vehicle_category;?>"  placeholder="Enter Vehicle Category">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Purchase Date</label>
                      <input type="text" autocomplete="off" class="form-control" required id="purchase_date" value="<?php  echo $value[0]->purchase_date;?>"  placeholder="Enter Purchase date">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Driver Details</label>
                      <input type="text" autocomplete="off" class="form-control" required id="ownershipdetails" value="<?php  echo $value[0]->ownershipdetails;?>"  placeholder="Driver Details">
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
<script src="<?php echo base_url(); ?>/assets/user_scripts/vehicle/vehicle_script.js"></script>
      