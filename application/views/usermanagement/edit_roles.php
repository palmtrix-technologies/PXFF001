<script src="<?php echo base_url(); ?>/assets/js/moment.js"></script>
<script src="<?php echo base_url(); ?>/assets/user_scripts/usermanagement/roles_script.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/iCheck/icheck.min.js"></script>
<style>
  .nav-tabs-custom {
    margin-bottom: 20px;
    background: #fff;
    box-shadow: 0 0px 1px rgba(0,0,0,0.1);
    border-radius: 3px;
}

.tab-pane{
  min-height:120px;
  border-bottom:solid 1px #f4f4f4;
}
.input-checkbox {
    font-weight: normal!important;
}
.permission-button-group {
  padding: 15px 0 10px 20px;
}
  </style>
<section class="content-header">
            <h1>
           Edit Roles
            </h1>
          
          </section>
          <section class="content">
          <div class="box box-success">
          <div class="box-body">
          <form role="form">
                  <div class="box-body">
                    <div class="form-group  col-md-6 ">
                      <label for="name">Name</label>
                      <input type="text" autocomplete="off" class="form-control" id="role_name" value="<?php  echo $value[0]->display_name; ?>" placeholder="Enter name">
                      <input type="hidden" name="id" id="id"  value="<?php  echo $value[0]->id;?>" />
                    </div>
                    <div class="form-group  col-md-6">
                      <label for="code">Code</label>
                      <input type="text" autocomplete="off" class="form-control" id="role_code"  value="<?php  echo $value[0]->name; ?>" placeholder="Enter code">
                    </div>
                    <div class="form-group  col-md-12">
                      <label>Description</label>
                      <textarea class="form-control" rows="3" autocomplete="off" id="role_description" placeholder="enter description"><?php  echo $value[0]->description; ?></textarea>
                    </div>
                    <div class="form-group col-md-12 ">
                    <label>Permission</label>
                   <br/>
                    <span class="permission-select-button selectall-all">Select All</span> |
                    <span class="permission-unselect-button unselectall-all">Unselect All</span>
                    <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">read</a></li>
                  <li><a href="#tab_2" data-toggle="tab">create</a></li>
                  <li><a href="#tab_3" data-toggle="tab">update</a></li>
                 
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                   
                    <div class="permission-button-group">
                    <a class="permission-select-button selectall-req" >Select All</a> |
                    <a class="permission-unselect-button unselectall-req">Unselect All</a>
                    </div>

                <?php
                
                foreach($read as $key=> $value1)      
                {if($value1->Isselected ==1){  echo "<script>updatearray.push(".$value1->id.");</script>";}
                 
                      ?>         
                <div class="col-md-3">
                
                    <label class="input-checkbox"><input type="checkbox"  class="minimal updatereadpermissions readselect"   value="<?php echo $value1->id; ?>" <?php if($value1->Isselected ==1){ echo "checked";} ?>  /><?php echo ' '.$value1->display_name;?></label> 
                </div>   
                 
            <?php
                }?>
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                  
                  <div class="permission-button-group">
                  <a class="permission-select-button selectall-cre">Select All</a> |
                    <a class="permission-unselect-button unselectall-cre">Unselect All</a>
                </div>

                <?php
                
                foreach($create as $key=> $value1)      
                {if($value1->Isselected ==1){  echo "<script>updatearray.push(".$value1->id.");</script>";}
                 ?>         
                <div class="col-md-3">
                    <label class="input-checkbox">
                    <label class="input-checkbox"><input type="checkbox"  class="minimal updatereadpermissions createpermissions"   value="<?php echo $value1->id; ?>" <?php if($value1->Isselected ==1){ echo "checked";} ?>  /><?php echo ' '.$value1->display_name; ?></label> 
                    </label> 
                </div>                
                <?php  } ?>

                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_3">
                      
                  <div class="permission-button-group">
                  <a class="permission-select-button selectall-upd">Select All</a> |
                    <a class="permission-unselect-button unselectall-upd">Unselect All</a>
                </div>
                <?php
                foreach($update as $key=> $value1)      
                { if($value1->Isselected ==1){  echo "<script>updatearray.push(".$value1->id.");</script>";}?>         
                <div class="col-md-3">
                    <label class="input-checkbox">
                    <label class="input-checkbox"><input type="checkbox"  class="minimal updatereadpermissions updatepermissions"   value="<?php echo $value1->id; ?>" <?php if($value1->Isselected ==1){ echo "checked"; } ?>  /><?php echo ' '.$value1->display_name; ?></label> 
                    </label> 
                </div>                
                <?php  } ?>
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
                  </div><!-- /.box-body -->
</div>
                  <div class="box-footer">
                    <button type="button"  onclick="update();" class="btn btn-success">Update</button>
                    <button type="reset" onclick="mytest();" class="btn btn-success">Cancel</button>
                  </div>
                </form>
          </div>
</div>
          </section>
       


<script>
   $(function () {
  $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_square-green'
    });
    $('.selectall-all').click(function(){
      $('.updatereadpermissions').iCheck('check');
      });
      $('.unselectall-all').click(function(){
      $('.updatereadpermissions').iCheck('uncheck');
      });
      $('.selectall-req').click(function(){
      $('.readselect').iCheck('check');
      });
      $('.unselectall-req').click(function(){
      $('.readselect').iCheck('uncheck');
      });
      $('.selectall-cre').click(function(){
      $('.createpermissions').iCheck('check');
      });
      $('.unselectall-cre').click(function(){
      $('.createpermissions').iCheck('uncheck');
      });
      $('.selectall-upd').click(function(){
      $('.updatepermissions').iCheck('check');
      });
      $('.unselectall-upd').click(function(){
      $('.updatepermissions').iCheck('uncheck');
      });
   });

   
  </script>
      