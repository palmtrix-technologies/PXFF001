
  <section class="content-header">
            <h1>
          Client Master
          <?php 
          
          if (in_array("create client",$permission))
          { 
             ?>
              <span class="new-button"><a href="<?php echo base_url(); ?>client-create" class="btn btn-success btn-sm"><span class="fa fa-plus"></span> &nbsp;Add New</a></span>
          <?php } ?>
            </h1>
          
          </section>
                  <section class="content">
          <div class="box box-success">
         
          <div class="box-body">
              <table class="table table-striped table-hover indexer" id="table-permissionList">
                <thead>
                  <tr>
                   
                    <th>Code</th>
                    <th>Name</th>
                    <th>Contact Person</th>
                    <th>Address</th>
                    <th>Mobile</th>
                    <th>EmailL</th>
                    <th>Status</th>
                    <?php 
          
          if (in_array("update client",$permission))
          { 
             ?>
                    <th>Action</th>
          <?php } ?>
                  </tr>
                  <thead>
                  <tbody>
<?php 
foreach ($value as $key => $value1)
 {  
	?>
                  <tr>
                  <!-- <td class="text-center"><?php echo $value1->id;?></td> -->
                  <td ><?php echo $value1->code;?></td>
                  <td ><?php echo $value1->name;?></td>     
                  <td ><?php echo $value1->contact_person;?></td>
                  <td ><?php echo $value1->address;?></td>     
                  <td ><?php echo $value1->mobile;?></td>
                  <td ><?php echo $value1->email;?></td>     
                  <?php 
                    if($value1->IsActive==1)
                      { ?> <td><span class="label label-primary"> <?php echo "Enabled";?></td></span><?php }
                      else
                      { ?> <td><span class="label label-danger"><?php echo "Disabled";?></td></span><?php } ?>
               
               <?php 
          
          if (in_array("update client",$permission))
          { 
             ?>
                    <td><ul class="nav"><li class="dropdown">
                <a class="btn btn-sm dropdown-toggle" style="width: 50px;" data-toggle="dropdown" href="#">
                  <i class="fa fa-ellipsis-v"></i> 
                </a>
                <ul class="dropdown-menu">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()."client-edit/".$value1->id;?>">Edit</a></li>
                  <?php 
                    if($value1->IsActive==1)
                      { ?>
                         <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()."client-disable-status/". $value1->id;?>">
                 
                      Disable
                      <?php } 
                      else {
                        ?>
                         <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()."client-enable-status/". $value1->id;?>">

                        Enable <?php
                      } ?>
                  <!-- <li role="presentation" class="divider"></li> -->
                  <!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Deactivate</a></li> -->
                </ul>
              </li>  </ul></td>
                    <?php } ?>
                  </tr>
                
<?php 
}
?>
                  <tbody>
              </table>
           

          </div>
   
          </div>

          </section>
      
      