<?php 
// var_dump($permission);
// die();
?>
  <section class="content-header">
            <h1>
            Employee List
        
          <?php 
          
          if (in_array("create supplier",$permission))
          { 
             ?>
              <span class="new-button"><a href="<?php echo base_url(); ?>employee-create" class="btn btn-success btn-sm"><span class="fa fa-plus"></span> &nbsp;Add New</a></span>
              <?php
        }
        ?>
            </h1>
          
          </section>
                  <section class="content">
          <div class="box box-success">
         
          <div class="box-body">
              <table class="table table-striped table-hover indexer" id="table-permissionList">
                <thead>
                  <tr>
                   
                  
                    <th>Employee Code</th>
                    <th>Employee Name</th>
                    <th>Phone</th>
                   
                    <th>Status</th>
                    <?php 
         
          if (in_array("update supplier",$permission))
          { 
             ?>
                
                    <th>ACTION</th>
                    <?php
                    }
                    ?>
                  </tr>
                  <thead>
                  <tbody>
<?php 
foreach ($value as $key => $value1)
 {  
	?> 
                  <tr>
                   <td><?php echo $value1->employee_code;?></td>
                  <td ><?php echo $value1->name;?></td>     
                  <td ><?php echo $value1->employee_phone;?></td>
                  <?php 
                    if($value1->is_active==1)
                      { ?> <td><span class="label label-primary"> <?php echo "Enabled";?></td></span><?php }
                      else
                      { ?> <td><span class="label label-danger"><?php echo "Disabled";?></td></span><?php } ?>
               
               <?php 
          
          if (in_array("update supplier",$permission))
          { 
             ?>
                    <td><ul class="nav"><li class="dropdown">
                <a class="btn btn-sm dropdown-toggle" style="width: 50px;" data-toggle="dropdown" href="#">
                  <i class="fa fa-ellipsis-v"></i> 
                </a>
                <ul class="dropdown-menu">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()."employee-edit/".$value1->employeeid;?>">Edit</a></li>
                   <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()."employee-view/".$value1->employeeid;?>">View</a></li>
                  
                  <?php 
                    if($value1->is_active==1)
                      { ?>
                         <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()."employee-disable-status/". $value1->employeeid;?>">
                 
                      Disable
                      <?php } 
                      else {
                        ?>
                         <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()."employee-enable-status/". $value1->employeeid;?>">

                        Enable <?php
                      } ?>
                      </a></li>
                  <!-- <li role="presentation" class="divider"></li> -->
                  <!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Deactivate</a></li> -->
                </ul>
              </li>  </ul></td>
              <?php }
              ?>
                  </tr>
                
<?php 
}
?>
                  <tbody>
              </table>
           

          </div>
   
          </div>

          </section>
      
      