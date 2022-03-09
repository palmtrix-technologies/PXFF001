<section class="content-header">
            <h1>
            New Employee
            </h1>
          
          </section>
          <section class="content">
          <div class="box box-success">
          <div class="box-body">
          <form role="form" method="post">
                  <div class="box-body" style="min-height:500px;">
                  <div class="form-group col-md-6">
                    <label for="exampleInputname1">Code</label>
                    <input type="text" id="employee_code"  name="employee_code" class="form-control" readonly="readonly" placeholder="<?php echo $code[0]->employee_code+1;?>"  value="<?php echo $code[0]->employee_code+1;?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Employee Name</label>
                      <input type="text" autocomplete="off" class="form-control" required id="employee_name" placeholder="Enter Employee Name">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="code">Employee Phone</label>
                      <input type="text" autocomplete="off" class="form-control" required id="employee_number" placeholder="Enter Phone">
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
<script src="<?php echo base_url(); ?>/assets/user_scripts/employee/employee_script.js"></script>
      
      