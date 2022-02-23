<section class="content-header">
            <h1>
            Edit Description
            </h1>
          
          </section>
          <section class="content">
          <div class="box box-success">
          <div class="box-body">
          <form role="form">
                  <div class="box-body" style="min-height: 300px; " >
                    <div class="form-group col-md-6 "  >
                      <label for="name">Code</label>
                      <input type="hidden" name="id" id="id"  value="<?php  echo $value[0]->id;?>" />
                   
                      <input type="text" class="form-control" id="description_code" readonly="readonly" placeholder="<?php  echo $value[0]->code;?>"  value="<?php  echo $value[0]->code;?>">
                    </div>
                    <div class="form-group col-md-6 ">
                      <label for="code">Description</label>
                      <input type="text" autocomplete="off" class="form-control" id="description_name"  value="<?php  echo $value[0]->description; ?>" >
                    </div>
                    <div class="form-group col-md-6 ">
                      <label for="code">Description Arabic</label>
                      <input type="text" autocomplete="off" class="form-control" id="description_arabic"  value="<?php  echo $value[0]->description_arabic; ?>">
                    </div>
                   
                   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="button"  onclick="update();" class="btn btn-success">Update</button>
                    <button type="reset" class="btn btn-success">Cancel</button>
                  </div>
                </form>
          </div>
</div>
          </section>
          <script src="<?php echo base_url(); ?>/assets/js/moment.js"></script>
<script src="<?php echo base_url(); ?>/assets/user_scripts/masters/description_script.js"></script>
      