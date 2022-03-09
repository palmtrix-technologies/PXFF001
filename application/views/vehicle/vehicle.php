<?php 
// var_dump($permission);
// die();
?>
  <section class="content-header">
            <h1>
            Vehicle List
        
          <?php 
          
          if (in_array("create supplier",$permission))
          { 
             ?>
              <span class="new-button"><a href="<?php echo base_url(); ?>vehicle-create" class="btn btn-success btn-sm"><span class="fa fa-plus"></span> &nbsp;Add New</a></span>
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
                   
                    <th>CODE</th>
                    <th>VEHICLE NUMBER</th>
                    <th>MANUFACTURER</th>
                    <th>MODEL</th>
                    <th>CATEGORY</th>
                    <th>DRIVER</th>
                    <th>PURCHASE DATE</th>
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
                  <!-- <td class="text-center"><?php echo $value1->id;?></td> -->
                  <td><?php echo $value1->vehicle_code;?></td>
                  <td ><?php echo $value1->Vehicle_number;?></td>     
                  <td ><?php echo $value1->vehicle_manufactur;?></td>
                  <td ><?php echo $value1->vehicle_model;?></td>     
                  <td ><?php echo $value1->vehicle_category;?></td>
                  <td ><?php echo $value1->ownershipdetails;?></td>    
                  <td ><?php echo $value1->purchase_date;?></td> 
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
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()."vehicle-edit/".$value1->vehicleid;?>">Edit</a></li>
                   <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()."vehicle-view/".$value1->vehicleid;?>">View</a></li>
                  
                  <?php 
                    if($value1->is_active==1)
                      { ?>
                         <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()."vehicle-disable-status/". $value1->vehicleid;?>">
                 
                      Disable
                      <?php } 
                      else {
                        ?>
                         <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()."vehicle-enable-status/". $value1->vehicleid;?>">

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
      
      