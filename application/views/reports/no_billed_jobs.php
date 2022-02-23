<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-flash-1.6.1/b-print-1.6.1/datatables.min.css"/>
 

<section class="content">
   <div class="row">
      <div class="col-md-12">
         <div class="box box-success">
           <div class="box-header with-border">
           <h3 class="box-title"> NON BILLED  REPORT </h3>
           </div>
           
            <div class="box-body">
               <table id="mytable" class="table table-stripped">
                  <thead>
                     <tr>
                     <?php 
          
          if (in_array("create nonbilledreports",$permission))
          { 
             ?>     <th>#</th>
          <?php } ?>
                        <th> Code</th>
                        <th> Date</th>
                        <th> Shipper</th>
                        <th> Consignee</th>
                        <th> Client</th>
                        <th> Type</th>
                        <th> Shipment Terms</th>
                        <th> Mode</th>
                      
                     </tr>
                  </thead>
                  <tbody>
                     <?php 
                        foreach ($values as $key => $value1)
                         {  
                        	?>
                     <tr>
                     <input type="hidden" id="jobid" value="<?php  echo $value1->JobId; ?>" ></input>
                   
                     <!-- <?php echo base_url(); ?>job-invoice/id=<?php echo $value1->JobId;?>  -->
                     <?php 
          
          if (in_array("create nonbilledreports",$permission))
          { 
             ?>   
                     <td class="text-center"> <span class="new-button"><button  onclick="createinvoice();" class="btn btn-success btn-xs"><span class="fa fa-plus"></span> &nbsp;Create Invoice </button></span>
                     <?php } ?>

                     <td class="text-center"><?php echo $value1->Number;?></td>
                        <td class="text-center"><?php echo $value1->Date;?></td>
                        <td class="text-center"><?php echo $value1->Shipper;?></td>
                        <td class="text-center"><?php echo $value1->Consignee;?></td>
                        <td class="text-center"><?php echo $value1->client_name;?></td>
                        <td class="text-center"><?php echo $value1->shipment_type;?></td>
                        <td class="text-center"><?php echo $value1->ShipmentTerms;?></td>
                        <td class="text-center"><?php echo $value1->Type;?></td>
                       
                     </tr>
                     <?php } ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</section>
<script src="<?php echo base_url(); ?>/assets/user_scripts/reports/reports.js">
// $( document ).ready(function() {
//     $('#jobid').addClass("hidden");
   
//   });

</script>

