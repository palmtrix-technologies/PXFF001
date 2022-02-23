<section class="content-header">
            <h1>
            Edit Permissions
            </h1>
          
          </section>
          <section class="content">
          <div class="box box-success">
          <div class="box-body">
          <form role="form">
                  <div class="box-body" style="min-height: 300px; " >
                    <div class="form-group col-md-6 "  >
                      <label for="name">Name</label>
                      <input type="hidden" name="id" id="id"  value="<?php  echo $value[0]->id;?>" />
                   
                      <input type="text" autocomplete="off" class="form-control" id="permission_name"  value="<?php  echo $value[0]->display_name; ?>" placeholder="Enter name">
                    </div>
                    <div class="form-group col-md-6 ">
                      <label for="code">Code</label>
                      <input type="text" class="form-control" autocomplete="off" id="permission_code"  value="<?php  echo $value[0]->name; ?>" placeholder="Enter code">
                    </div>
                    <div class="form-group col-md-6 ">
                      <label>Description</label>
                      <textarea class="form-control" rows="3" autocomplete="off" id="permission_description" placeholder="enter description"><?php  echo $value[0]->description; ?></textarea>
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
<script src="<?php echo base_url(); ?>/assets/user_scripts/usermanagement/permission_script.js"></script>
      