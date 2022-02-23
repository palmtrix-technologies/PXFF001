<section class="content">
   <div class="row">
      <div class="col-md-12">
         <div class="box box-success">
           <div class="box-header with-border">
           <h3 class="box-title"> CREDIT NOTE DETAILS </h3>
           </div>
            <div class="box-body">
               <table id="mytable" class="table table-stripped">
                  <thead>
                     <tr>
                        <th> ID</th>
                        <th> DATE</th>
                        <th> TOTAL</th>
                        
                     </tr>
                  </thead>
                  <tbody>
                     <?php 
                        foreach ($values as $key => $value1)
                         {  
                        	?>
                     <tr>
                        <td class="text-center"><?php echo $value1->Creditnote_master_id;?></td>
                        <td class="text-center"><?php echo $value1->Date;?></td>
                        <td class="text-center"><?php echo $value1->GrandTotal;?></td>
                        
                     </tr>
                     <?php } ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</section>