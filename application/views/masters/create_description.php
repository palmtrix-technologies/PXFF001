<section class="content-header">
            <h1>
            New Description
            </h1>
          
          </section>
          <section class="content">
          <div class="box box-success">
          <div class="box-body">
          <form role="form">
                  <div class="box-body" style="min-height: 300px;">
                  <div class="form-group col-md-6">
                      <label for="exampleInputname1">Code</label>
                <input type="text" id="description_code"  name="description_code" class="form-control" readonly="readonly" placeholder="<?php echo $code[0]->code+1;?>"  value="<?php echo $code[0]->code+1;?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Description</label>
                      <input type="text" autocomplete="off" class="form-control" required id="description_name" placeholder="Enter description">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Description Arabic</label>
                      <input type="text" autocomplete="off" class="form-control" required id="description_arabic" placeholder="Enter description arabic">
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
<script src="<?php echo base_url(); ?>/assets/user_scripts/masters/description_script.js"></script>
      