
 
<!-- swallokalert('kop shariyayi','www.google.com'); -->
<section class="content">
   <div class="row">
      <div class="col-md-12">
         <div class="box box-success">
           <div class="box-header with-border">
           <h3 class="box-title"> JOB LIST </h3>
         
           <?php 
           
          if (in_array("create job",$permission))
          { 
             ?>
                <span class="new-button"><a href="<?php echo base_url(); ?>job" class="btn btn-success btn-sm"><span class="fa fa-plus"></span> &nbsp;Add New</a></span>
                <?php
        }
        ?>
           </div>
           
            <div class="box-body">
    
               <table  class="table table-bordered indexer" >
                  <thead style="background-color: bisque;">
                     <tr>
                     <th> Mode</th>
                   
                        <th> Code</th>
                        <th> Type</th>
                        <th> Date</th>
                        <th> Shipper</th>
                        <th> Consignee</th>
                        <th> Client</th>
                     
                        <th> Shipment Terms</th>
                     
                        <th>#</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php 
                        foreach ($values as $key => $value1)
                         {  
                        	?>
                     <tr>
                     <td class="text-center"><?php 
                      if($value1->Type=='airexport'||$value1->Type=='airimport')
                     {
                        echo '<i class="text-blue fa fa-plane fa-2x"></i>';
                     } else if($value1->Type=='lclexport'||$value1->Type=='lclimport'||$value1->Type=='fclimport'||$value1->Type=='fclexport')
                     {
                        echo '<i class="text-green fa fa-ship fa-2x"></i>';
                     }
                     else if($value1->Type=='landexport'||$value1->Type=='landimport')
                     {
                        echo '<i class="text-red  fa  fa-truck fa-2x"></i>';
                     }
                     else{
                        echo '<i class="text-yellow fa  fa-train fa-2x"></i>';
                     }
                     
                     ?></td>
                        <td class="text-center"><?php echo $value1->Number;?></td>
                        <td class="text-center"><?php echo $value1->Type;?></td>
                        
                        <td class="text-center"><?php echo $value1->Date;?></td>
                        <td class="text-center"><?php echo $value1->Shipper;?></td>
                        <td class="text-center"><?php echo $value1->Consignee;?></td>
                        <td class="text-center"><?php echo $value1->client_name;?></td>
                        <td class="text-center"><?php echo $value1->ShipmentTerms;?></td>
                        
                      
                        <?php 
                    if($value1->Status=="OPEN")
                      { ?>  
              
                    <td class="text-center">
                    <?php 
          
          if (in_array("update job",$permission))
          { 
             ?>
                 <a href="<?php echo base_url()."edit-job/". $value1->JobId;?>" ><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php
                   } 
                   ?>

                      <a onclick="confirmclose(<?php echo $value1->JobId;?>);" ><span class="label label-success" >Close Job</span></a>  </td>
                      <?php }  else { ?> 
                        <td></td>
                        <?php     } ?>
               
                       
                      
                     </tr>
                     <?php }?>
                  </tbody> 
               </table>
            </div>
         </div>
      </div>
   </div>
</section>
<script>
   //confirm alert
   function confirmclose(id)
   {
    var link="<?php echo base_url().'job-closed-status/'?>"+id;

    Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to edit this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, close it!'
}).then((result) => {
  if (result.value) {

    Swal.fire(
      'closed!',
      'Your job has been closed.',
      'success'
    )
    
    window.location.replace(link);
  }

});
  
   }


   </script>





