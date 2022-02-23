
  <section class="content-header">
            <h1>
            Supplier Expense
              <span class="new-button"><a href="<?php echo base_url(); ?>description-create" class="btn btn-success btn-sm"><span class="fa fa-plus"></span> &nbsp;Add New</a></span>
            </h1>
          
          </section>
                  <section class="content">
          <div class="box box-success">
         
          <div class="box-body">
              <table class="table table-striped table-hover indexer" id="table-permissionList">
                <thead>
                  <tr>
                   
                  
                  <th>Post Id </th>
                    <th>Posting Date</th>
                    <th> Reference</th>
                    <th> Our Invoice</th>
                    <th> Total</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  <thead>
                  <tbody>
<?php 
foreach ($value as $key => $value1)
 {  
	?>
                  <tr>
                  <td class="text-center"><?php echo $value1->PostId;?></td>
                  <td class="text-center"><?php echo $value1->PostingDate;?></td>
                  <td class="text-center"><?php echo $value1->Reference;?></td>
                  <td class="text-center"><?php echo $value1->OurInv;?></td>    
                  <td class="text-center"><?php echo $value1->GrandTotal;?></td> 
                  <td class="text-center"><?php echo $value1->Status;?></td>
             
                 

                    <td><ul class="nav"><li class="dropdown">
                <a class="btn btn-sm dropdown-toggle" style="width: 50px;" data-toggle="dropdown" href="#">
                  <i class="fa fa-ellipsis-v"></i> 
                </a>
                <ul class="dropdown-menu">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url();?>edit-supplier-expense?id=<?php echo $value1->ExpenseMasterId;?>">Edit</a></li>
                 
                       
                      </a></li>
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
      
      