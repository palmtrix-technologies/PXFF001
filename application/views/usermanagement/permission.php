
  <section class="content-header">
            <h1>
              Permissions
              <?php 
             
             if (in_array("create permissions", $permission))
             {  ?> 
              <span class="new-button"><a href="<?php echo base_url(); ?>permission-create" class="btn btn-success btn-sm"><span class="fa fa-plus"></span> &nbsp;Add New</a></span>
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
                    <th>NAME</th>
                    <th>CODE</th>
                    <th>DESCRIPTION</th>
                    <th>ACTION</th>
                  </tr>
                  <thead>
                  <tbody>
<?php 
foreach ($value as $key => $value1)
 {  
	?>
                  <tr>
                  <!-- <td class="text-center"><?php echo $value1->id;?></td> -->
                  <td ><?php echo $value1->display_name;?></td>
                  <td ><?php echo $value1->name;?></td>     
                  <td ><?php echo $value1->description;?></td>
                    <td><ul class="nav"><li class="dropdown">
                <a class="btn btn-sm dropdown-toggle" style="width: 50px;" data-toggle="dropdown" href="#">
                  <i class="fa fa-ellipsis-v"></i> 
                </a>
                <ul class="dropdown-menu">
                <?php 
             
             if (in_array("update permission", $permission))
             {  ?> 
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()."permission-edit/".$value1->id;?>">Edit</a></li>
                  <?php
              }
                ?>
                  <!-- <li role="presentation" class="divider"></li> -->
                  <!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Deactivate</a></li> -->
                </ul>
              </li>  </ul></td>
                  </tr>
                
<?php 
}
?>
                  <tbody>
              </table>
           

          </div>
   
          </div>

          </section>
      
      