
             
            
           
<section class="content-header">
            <h1>
              Users
              <?php 
             
             if (in_array("create user", $permission))
             {  ?> 
              <!--<span class="new-button"><a href="<?php echo base_url(); ?>users-create" class="btn btn-success btn-sm"><span class="fa fa-plus"></span> &nbsp;Add New</a></span>-->
            </h1>
            <?php
              }
                ?>
          </section>


                  <section class="content">
                      
          <div class="box box-success">
         
          <div class="box-body">
              
          <table class="table table-striped table-hover indexer" id="table-permissionList">
             
                <thead>
                    
                  <tr>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>ROLES</th>
                    <th>STATUS</th>
                    <th>ACTION</th>
                  </tr>
                  <thead>
                  <tbody>
                  <?php 
                  foreach($value as $key=>$val)
                  {
                    ?>
                   
                  <tr>
                    <td><?php echo $val->user_name;?></td>
                    <td><?php echo $val->email;?></td>
                    <td> <span class="label label-primary"><?php echo $val->display_name;?></span></td>
                
                    <?php 
                    if($val->enabled==1)
                      { ?> <td><span class="label label-primary"> <?php echo "Enabled";?></td></span><?php }
                      else
                      { ?> <td><span class="label label-danger"><?php echo "Disabled";?></td></span><?php } ?>
                    
                    <td><ul class="nav"><li class="dropdown">
                <a class="btn btn-sm dropdown-toggle" style="width: 50px;" data-toggle="dropdown" href="#">
                  <i class="fa fa-ellipsis-v"></i> 
                </a>
                <ul class="dropdown-menu">
                <?php 
             
             if (in_array("update users", $permission))
             {  ?> 
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()."users-edit/". $val->user_id;?>">Edit</a></li>
                  <?php
              }
                ?>
                  <?php 
                    if($val->enabled==1)
                      { ?>
                         <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()."users-disable-status/". $val->user_id;?>">
                 
                      Disable
                      <?php } 
                      else {
                        ?>
                         <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()."users-enable-status/". $val->user_id;?>">

                        Enable <?php
                      } ?>
                     
                        </a></li>

                </ul>
              </li>  </ul></td>
                  </tr>
                  <?php
                  }?>
                  <tbody>
              </table>
           

          </div>
   
          </div>

          </section>
      
      