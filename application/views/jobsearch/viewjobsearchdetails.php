<section class="content">

      <div class="row">
        <div class="col-md-3">
 <!-- search form -->
           <!-- <form action="#" method="get"> -->
            <div class="input-group">
              <input type="text" autocomplete="off" name="q" id="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type="submit" name="search_job" id="search_job" class="btn btn-flat" ><i class="fa fa-search" onclick="search_job()"></i></button>
              </span>
            </div>
          <!-- </form>  -->
          <!-- /.search form -->
          <!-- Profile Image -->
          <h4 class="box-title" id="title">Job Description </h4>
          <div class="box " id="description">
            <div class="box-body box-profile">
            <div class="box-body" >
               <div class="job"></div>
                        <strong><i class=""></i> Job</strong>
                        <p  id="job_id">
                           <?php echo $jobdata[0]->JobId;?>
                        </p>
                        <hr>
                        <strong><i class=""></i> Shipper</strong>
                        <p class="text-muted" id="shipper">   
                          <?php echo $jobdata[0]->Consignee;?> 
                             
                    </p>
                        <hr>
                        <strong><i class=""></i> Consignee</strong>
                        <p class="text-muted" id="consignee">  
                            <?php echo $jobdata[0]->Shipper;?>
                            </p>
                        <hr>
                        <strong><i class=""></i> Client Company </strong>
                        <p class="text-muted" id="client">  
                            <?php echo $jobdata[0]->client_name;?>
                        </p>
                        <hr>
                        <strong><i class=""></i>Shipment Terms</strong>
                        <p class="text-muted" id="terms">  
                             <?php echo $jobdata[0]->ShipmentTerms;?>
                             </p>
                        
                                 <hr>
                        <strong><i class=""></i>Consignment Description</strong>
                        <p class="text-muted" id="description">  
                            <?php echo $jobdata[0]->Description;?>
                        </p>
                     </div>

             
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <br><br><br><br>
        <div class="col-md-9">
            
          <div class="nav-tabs-custom">
          <div class="row">
               <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                  <span class="description-text">TOTAL INVOICE</span>
                    <h5 class="description-header"></h5>
                   
                  </div>
                  <!-- /.description-block -->
                </div>
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                  <span class="description-text">TOTAL EXPENCE</span>
                    <h5 class="description-header"></h5>
                    
                  </div>
                  <!-- /.description-block -->
                </div>
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                  <span class="description-text">INVOICE PAID </span>
                    <h5 class="description-header"></h5>
                  </div>
                  <!-- /.description-block -->
                </div>
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                  <span class="description-text">AMOUNT DUE </span>
                    <h5 class="description-header"></h5>
                  </div>
                  <!-- /.description-block -->
                </div>
               </div>
               <br>
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="false">Job Ledger</a></li>
              <li class=""><a href="#timeline" data-toggle="tab" aria-expanded="false">Invoice</a></li>
              <li class=""><a href="#settings" data-toggle="tab" aria-expanded="true">Supplier Expense</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="activity">
              <section class="content">
              <div class="row">
      <div class="col-md-12">
      <h3 class="box-title"> Job Ledger Report </h3>
      <div class="box">
           <div class="box-header with-border">
         
           </div>
         
            
            <div class="box-body">
               <table id="jobledger" class="table table-stripped">
                  <thead>
                     <tr>
                        <th> Sl.no</th>
                        <th> Date</th>
                        <th> Transaction Type</th>
                        <th> Description</th>
                        <th> Credit</th>
                        <th> Debit</th>
                       
                     </tr>
                  </thead>
                  <!-- <tbody>
                     <?php 
                        foreach ($values as $key => $value1)
                         {  
                        	?>
                     <tr>
                        <td class="text-center"><?php echo $value1->Number;?></td>
                        <td class="text-center"><?php echo $value1->Date;?></td>
                        <td class="text-center"><?php echo $value1->Shipper;?></td>
                        <td class="text-center"><?php echo $value1->Consignee;?></td>
                        <td class="text-center"><?php echo $value1->client_name;?></td>
                        <td class="text-center"><?php echo $value1->shipment_type;?></td>
                        <td class="text-center"><?php echo $value1->ShipmentTerms;?></td>
                        <td class="text-center"><?php echo $value1->Type;?></td>
                        <td class="text-center"><?php echo $value1->CargoDescription;?></td>
                     </tr>
                     <?php } ?>
                  </tbody> -->
               </table>
                         </div>
      </div>
      </div>
                         </div>
                         </section>
               
               
              </div>
           
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                <section class="content">
   <div class="row">
      <div class="col-md-12">
      <h3 class="box-title"> Generated Invoices </h3>
         <div class="box ">
           <div class="box-header with-border">
         
           <span class="new-button" style="float: right;"><a href="<?php echo base_url(); ?> " class="btn btn-success btn-sm" ><span class="fa fa-plus"></span> &nbsp;Create Invoice </a></span>
           </div>
           
            <div class="box-body">
    
               <table id="invoicereport" class="table table-stripped">
                  <thead>
                     <tr>
                        <th> Sl.no</th>
                        <th> Invoice.no</th>
                        <th> Date</th>
                        <th> Particulars</th>
                        <th> Mode</th>
                        <th> SubTotal</th>
                        <th>  Vat</th>
                        <th> Grand Total</th>

                     </tr>
                  </thead>
                  <tbody class="dataadd">
                     
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</section> 
<br><br>
<section class="content">
   <div class="row">
      <div class="col-md-12">
      <h3 class="box-title"> Credit Note </h3>
         <div class="box ">
           <div class="box-header with-border">
          
           <span class="new-button" style="float: right;"><a href="<?php echo base_url(); ?> " class="btn btn-success btn-sm" ><span class="fa fa-plus"></span> &nbsp;Create Creditnote </a></span>
           </div>
           
            <div class="box-body">
    
               <table id="invoicereport" class="table table-stripped">
                  <thead>
                     <tr>
                        <th> Sl.no</th>
                        <th> CRN.no</th>
                        <th> Date</th>
                        <th> Customer</th>
                        <th> Mode</th>
                        <th> Amount</th>
                        
                     </tr>
                  </thead>
                  <!-- <tbody>
                     <?php 
                        foreach ($values as $key => $value1)
                         {  
                        	?>
                     <tr>
                        <td class="text-center"><?php echo $value1->Number;?></td>
                        <td class="text-center"><?php echo $value1->Date;?></td>
                        <td class="text-center"><?php echo $value1->Shipper;?></td>
                        <td class="text-center"><?php echo $value1->Consignee;?></td>
                        <td class="text-center"><?php echo $value1->client_name;?></td>
                        <td class="text-center"><?php echo $value1->shipment_type;?></td>
                        <td class="text-center"><?php echo $value1->ShipmentTerms;?></td>
                        <td class="text-center"><?php echo $value1->Type;?></td>
                        <td class="text-center"><?php echo $value1->CargoDescription;?></td>
                     </tr>
                     <?php } ?>
                  </tbody> -->
               </table>
            </div>
         </div>
      </div>
   </div>
</section> 
<br><br>
<section class="content">
   <div class="row">
      <div class="col-md-12">
      <h3 class="box-title">Customer Payment Receipt </h3>
         <div class="box ">
           <div class="box-header with-border">
          
           <span class="new-button" style="float: right;"><a href="<?php echo base_url(); ?> " class="btn btn-success btn-sm" ><span class="fa fa-plus"></span> &nbsp;New Payment Receipt </a></span>
           </div>
           
            <div class="box-body">
    
               <table id="invoicereport" class="table table-stripped">
                  <thead>
                     <tr>
                        <th> Sl.no</th>
                       
                        <th>Receipt Date</th>
                        <th> Doc.#</th>
                        <th> Particulars</th>
                        <th> Ref/Invoice</th>
                     
                     </tr>
                  </thead>
                  <!-- <tbody>
                     <?php 
                        foreach ($values as $key => $value1)
                         {  
                        	?>
                     <tr>
                        <td class="text-center"><?php echo $value1->Number;?></td>
                        <td class="text-center"><?php echo $value1->Date;?></td>
                        <td class="text-center"><?php echo $value1->Shipper;?></td>
                        <td class="text-center"><?php echo $value1->Consignee;?></td>
                        <td class="text-center"><?php echo $value1->client_name;?></td>
                        <td class="text-center"><?php echo $value1->shipment_type;?></td>
                        <td class="text-center"><?php echo $value1->ShipmentTerms;?></td>
                        <td class="text-center"><?php echo $value1->Type;?></td>
                        <td class="text-center"><?php echo $value1->CargoDescription;?></td>
                     </tr>
                     <?php } ?>
                  </tbody> -->
               </table>
            </div>
         </div>
      </div>
   </div>
</section> 
              </div>
            

              <div class="tab-pane " id="settings">
              <section class="content">
   <div class="row">
      <div class="col-md-12">
      <h3 class="box-title"> Posted Expences </h3>
         <div class="box ">
           <div class="box-header with-border">
          
           <span class="new-button" style="float: right;"><a href="<?php echo base_url(); ?> " class="btn btn-success btn-sm" ><span class="fa fa-plus"></span> &nbsp;Post New Expense </a></span>
           </div>
           
            <div class="box-body">
    
               <table id="invoicereport" class="table table-stripped">
                  <thead>
                     <tr>
                        <th> Sl.no</th>
                        <th> Inv Date</th>
                        <th> Doc.#</th>
                        <th> Particulars</th>
                        <th> Ref/Inv</th>
                        <th> Supplier</th>
                      
                        <th>  Amount#</th>

                     </tr>
                  </thead>
                  <!-- <tbody>
                     <?php 
                        foreach ($values as $key => $value1)
                         {  
                        	?>
                     <tr>
                        <td class="text-center"><?php echo $value1->Number;?></td>
                        <td class="text-center"><?php echo $value1->Date;?></td>
                        <td class="text-center"><?php echo $value1->Shipper;?></td>
                        <td class="text-center"><?php echo $value1->Consignee;?></td>
                        <td class="text-center"><?php echo $value1->client_name;?></td>
                        <td class="text-center"><?php echo $value1->shipment_type;?></td>
                        <td class="text-center"><?php echo $value1->ShipmentTerms;?></td>
                        <td class="text-center"><?php echo $value1->Type;?></td>
                        <td class="text-center"><?php echo $value1->CargoDescription;?></td>
                     </tr>
                     <?php } ?>
                  </tbody> -->
               </table>
            </div>
         </div>
      </div>
   </div>
</section> 
<br><br>
<section class="content">
   <div class="row">
      <div class="col-md-12">
         <div class="box ">
           <div class="box-header with-border">
           <h3 class="box-title"> Debit Note </h3>
           <span class="new-button" style="float: right;"><a href="<?php echo base_url(); ?> " class="btn btn-success btn-sm" ><span class="fa fa-plus"></span> &nbsp;Create Debitnote </a></span>
           </div>
           
            <div class="box-body">
    
               <table id="invoicereport" class="table table-stripped">
                  <thead>
                     <tr>
                     <th> Sl.no</th>
                        <th> Inv Date</th>
                        <th> Doc.#</th>
                        <th> Particulars</th>
                        <th> Ref/Inv</th>
                        <th> Supplier</th>
                      
                        <th>  Amount#</th>

                        
                     </tr>
                  </thead>
                  <!-- <tbody>
                     <?php 
                        foreach ($values as $key => $value1)
                         {  
                        	?>
                     <tr>
                        <td class="text-center"><?php echo $value1->Number;?></td>
                        <td class="text-center"><?php echo $value1->Date;?></td>
                        <td class="text-center"><?php echo $value1->Shipper;?></td>
                        <td class="text-center"><?php echo $value1->Consignee;?></td>
                        <td class="text-center"><?php echo $value1->client_name;?></td>
                        <td class="text-center"><?php echo $value1->shipment_type;?></td>
                        <td class="text-center"><?php echo $value1->ShipmentTerms;?></td>
                        <td class="text-center"><?php echo $value1->Type;?></td>
                        <td class="text-center"><?php echo $value1->CargoDescription;?></td>
                     </tr>
                     <?php } ?>
                  </tbody> -->
               </table>
            </div>
         </div>
      </div>
   </div>
</section> 
<br><br>
<section class="content">
   <div class="row">
      <div class="col-md-12">
         <div class="box">
           <div class="box-header with-border">
           <h3 class="box-title">Supplier Payment  </h3>
           <span class="new-button" style="float: right;"><a href="<?php echo base_url(); ?> " class="btn btn-success btn-sm" ><span class="fa fa-plus"></span> &nbsp;Create Supplier Payment </a></span>
           </div>
           
            <div class="box-body">
    
               <table id="invoicereport" class="table table-stripped">
                  <thead>
                     <tr>
                        <th> Sl.no</th>
                       
                        <th>Payment Date</th>
                        <th> Doc.#</th>
                        <th> Particulars</th>
                        <th> Ref/Invoice</th>
                        <th> Supplier</th>
                      
                      <th>  Amount#</th>
                     </tr>
                  </thead>
                  <!-- <tbody>
                     <?php 
                        foreach ($values as $key => $value1)
                         {  
                        	?>
                     <tr>
                        <td class="text-center"><?php echo $value1->Number;?></td>
                        <td class="text-center"><?php echo $value1->Date;?></td>
                        <td class="text-center"><?php echo $value1->Shipper;?></td>
                        <td class="text-center"><?php echo $value1->Consignee;?></td>
                        <td class="text-center"><?php echo $value1->client_name;?></td>
                        <td class="text-center"><?php echo $value1->shipment_type;?></td>
                        <td class="text-center"><?php echo $value1->ShipmentTerms;?></td>
                        <td class="text-center"><?php echo $value1->Type;?></td>
                        <td class="text-center"><?php echo $value1->CargoDescription;?></td>
                     </tr>
                     <?php } ?>
                  </tbody> -->
               </table>
            </div>
         </div>
      </div>
   </div>
</section> 
              </div>
            
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <script src="<?php echo base_url(); ?>/assets/user_scripts/jobsearch/jobsearch.js"></script>
