
 
<!-- swallokalert('kop shariyayi','www.google.com'); -->
<section class="content">
   <div class="row">
      <div class="col-md-12">
         <div class="box box-success">
           <div class="box-header with-border">
           <h3 class="box-title"> ESTIMATION LIST </h3>
         
           <?php 
           
          if (in_array("create job",$permission))
          { 
             ?>
                <span class="new-button"><a href="<?php echo base_url(); ?>estimation" class="btn btn-success btn-sm"><span class="fa fa-plus"></span> &nbsp;Add New</a></span>
                <?php
        }
        ?>
           </div>
           
            <div class="box-body">
    
               <table  class="table table-bordered indexer" >
                  <thead style="background-color: bisque;">
                     <tr>
                     <th> Sl.No</th>
                        <th> Estimate Date </th>
                        <th> Estimate Number</th>
                        <th> Job Number</th>
                        
                     
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php  $i=1;
                        foreach ($values as $key => $value1)
                         {  
                        	?>
                     <tr>
                     
                        <td class="text-center"><?php echo $i;?></td>
                        <td class="text-center"><?php echo $value1->e_date;?></td>
                        
                        <td class="text-center"><?php echo $value1->estimate_no;?></td>
                        <td class="text-center"><?php foreach ($jobid as $key => $jb)
                         {if($value1->job_id == $jb->JobId){ $jbs=$jb->Number; echo $jb->Jobcode;}}  ?></td>
                      
                    <td class="text-center">
                   
                 <a href="<?php echo base_url()."edit-consignment/". $value1->job_id;?>" ><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                   
                 </td>
                      
               
                       
                      
                     </tr>
                     <?php $i++; }?>
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





