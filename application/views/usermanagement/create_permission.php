<section class="content-header">
            <h1>
            New Permissions
            </h1>
          
          </section>
          <section class="content">
          <div class="box box-success">
          <div class="box-body">
          <form role="form">
                  <div class="box-body" style="min-height: 300px;">
                    <div class="form-group col-md-6 ">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" autocomplete="off" required id="permission_name" placeholder="Enter name">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Code</label>
                      <input type="text" class="form-control" autocomplete="off" required id="permission_code" placeholder="Enter code">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Description</label>
                      <textarea class="form-control" required rows="3" autocomplete="off" id="permission_description"  placeholder="enter description"></textarea>
                    </div>
                   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="button" onclick="add();" class="btn btn-success">Save</button>
                    <button type="reset" class="btn btn-success">Cancel</button>
                  </div>
                </form>
          </div>
</div>
          </section>

<script src="<?php echo base_url(); ?>/assets/js/moment.js"></script>
<script src="<?php echo base_url(); ?>/assets/user_scripts/usermanagement/permission_script.js"></script>
      