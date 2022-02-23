<section class="content-header">
            <h1>
          Client Payment
            
            </h1>
          
          </section>
                  <section class="content">
          <div class="box box-success">
         
          <div class="box-body">
              <table class="table table-striped table-hover indexer" id="table-permissionList">
                <thead>
                  <tr>
                  <?php 
          
          if (in_array("create clientreceipt",$permission))
          { 
             ?>  
              <th></th>
          <?php } ?>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Contact Person</th>
                    <th>Address</th>
                    <th>Mobile</th>
                  
                   
                  </tr>
                  <thead>
                  <tbody>
<?php 
foreach ($value as $key => $value1)
 {  
	?>
                  <tr>
                  <?php 
          
          if (in_array("create clientreceipt",$permission))
          { 
             ?> 
                       <td class="text-center"><a class="btn btn-success btn-sm" href="<?php echo  base_url().'payment-receipt'.'/'.$value1->id;?>">payment reciept</a></td> 
                       <?php } ?>
                       <td ><?php echo $value1->code;?></td>
                  <td ><?php echo $value1->name;?></td>     
                  <td ><?php echo $value1->contact_person;?></td>
                  <td ><?php echo $value1->address;?></td>     
                  <td ><?php echo $value1->mobile;?></td>
                  
 </tr>
                
<?php 
}
?>
                  <tbody>
              </table>
           

          </div>
   
          </div>

          </section>

