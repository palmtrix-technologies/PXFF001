<section class="content-header">
            <h1>
            New Currency
            </h1>
          
          </section>
          <section class="content">
          <div class="box box-success">
          <div class="box-body">
          <form role="form">
                  <div class="box-body" style="min-height: 300px;">
                    <div class="form-group col-md-6 ">
                      <label for="name">Currency</label>
                      <input type="text" autocomplete="off" class="form-control" required id="currency" value="">
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
<script src="<?php echo base_url(); ?>/assets/user_scripts/masters/currency_script.js"></script>
      