<section class="content">
    <div class="row">
    <div class="col-md-3">
    <div class="box " id="description">
            <div class="box-body box-profile">
            <div class="box-body" >
               <div class="job"></div>
               <input type="hidden" id="id" value="">
                       <p> Vehicle Number</p>
                        <p  > <strong> <?=$value->Vehicle_number?> </strong></p>
                        <hr>
                         <p> Vehicle Manufacturer</p>
                        <p  > <strong> <?=$value->vehicle_manufactur?> </strong></p>
                        <hr>
                        <p> Vehicle Model</p>
                        <p  > <strong> <?=$value->vehicle_model?> </strong></p>
                        <hr>
                       
                        <p> Vehicle Category</p>
                        <p  > <strong> <?=$value->vehicle_category?> </strong></p>
                       
                       
                       <hr>
                        <p> Purchase Date</p>
                        <p  > <strong> <?=$value->purchase_date?> </strong></p>
                        <hr>
                        <p> Driver</p>
                        <p  > <strong> <?=$value->ownershipdetails?> </strong></p>
                        <hr>
                     </div>
             
            </div>
            <!-- /.box-body -->
          </div>

    </div>
    
      <div class="col-md-9">
            
          <div class="nav-tabs-custom">
          <div class="row">
               <div class="col-sm-2 col-xs-6 ">
                  <div class="description-block border-right ">
                  <span class="description-text ">This Month Expense</span>
                   <h5 class=" description-header" id="lbl_site_value" style="color:green;"><?=$overview->month_total?></h5>

                  </div>
                  <!-- /.description-block -->
                </div>
                <div class="col-sm-2 col-xs-6 ">
                  <div class="description-block border-right ">
                  <span class="description-text ">This Month Fuel</span>
                   <h5 class=" description-header" id="lbl_estimated_expense" style="color:green;"><?=$overview->month_fuel?></h5>

                  </div>
                  <!-- /.description-block -->
                </div>
               <div class="col-sm-2 col-xs-6 ">
                  <div class="description-block border-right ">
                  <span class="description-text ">This Month Maintenance</span>
                   <h5 class=" description-header" id="invtotal" style="color:green;"><?=$overview->month_main?></h5>

                  </div>
                  <!-- /.description-block -->
                </div>
                <div class="col-sm-2 col-xs-6">
                  <div class="description-block border-right">
                  <span class="description-text">Total Expense</span>
                    <h5 class="description-header" id="expensetotal" style="color:green;"><?=$overview->total?></h5>
                    
                  </div>
                  <!-- /.description-block -->
                </div>
                <div class="col-sm-2 col-xs-6">
                  <div class="description-block border-right">
                  <span class="description-text">Total Fuel </span>
                    <h5 class="description-header" id="amountdue" style="color:green;"><?=$overview->fuel?></h5>
                  </div>
                  <!-- /.description-block -->
                </div>
                <div class="col-sm-2 col-xs-6">
                  <div class="description-block border-right">
                  <span class="description-text">Total Maintienance </span>
                    <h5 class="description-header" style="color:green;" id="invpaid"><?=$overview->main?></h5>
                  </div>
                  <!-- /.description-block -->
                </div>
               </div>
               <br>
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="false">Vehicle Expense</a></li>
              <li class=""><a href="#timeline" data-toggle="tab" aria-expanded="false">Fuel Expense</a></li>
              <li class=""><a href="#settings" data-toggle="tab" aria-expanded="true">Maintinence Expense</a></li>
               
          
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="activity">
              <section class="content">
              <div class="row">
      <div class="col-md-12">
      <h3 class="box-title"> Total Expense </h3>
      <div class="box">
         
         
            
            <div class="box-body">
               <table class="table table-stripped">
                  <thead>
                     <tr>
                        <th> Date</th>
                        <th> Expense Type</th>
                        <th> Description</th>
                        <th style='text-align: right;'> Sub Total</th>
                        <th style='text-align: right;'> Vat</th>
                        <th style='text-align: right;'> Grand Total</th>
                     </tr>
                  </thead>
                 
                  <tbody class="ledger">
                     <?php 
foreach ($allexpense as $key => $row)
 {  
	?>
                      <tr>
                        <td> <?=$row->expense_date?></td>
                        <td><?=$row->expense_category?></td>
                        <td> <?=$row->description?></td>
                        <td style='text-align: right;'><?=$row->subtotal?></td>
                        <td style='text-align: right;'> <?=$row->tax_amount?></td>
                        <td style='text-align: right;'> <?=$row->total_amount?></td>
                     </tr>
                     <?php } ?>
                    
                  </tbody>
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
      <h3 class="box-title"> Fuel Expense </h3>
         <div class="box ">
           <div class="box-header with-border">
         
         </div>
           
              <div class="box-body">
               <table class="table table-stripped">
                  <thead>
                     <tr>
                        <th> Date</th>
                       
                        <th> Description</th>
                        <th style='text-align: right;'> Sub Total</th>
                        <th style='text-align: right;'> Vat</th>
                        <th style='text-align: right;'> Grand Total</th>
                     </tr>
                  </thead>
                 
                  <tbody class="ledger">
                     <?php 
foreach ($fuelexpense as $key => $row)
 {  
	?>
                      <tr>
                        <td> <?=$row->expense_date?></td>
                       
                        <td> <?=$row->description?></td>
                        <td style='text-align: right;'><?=$row->subtotal?></td>
                        <td style='text-align: right;'> <?=$row->tax_amount?></td>
                        <td style='text-align: right;'> <?=$row->tax_amount?></td>
                     </tr>
                     <?php } ?>
                    
                  </tbody>
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
      <h3 class="box-title"> Maintinance </h3>
         <div class="box ">
        
           
                <div class="box-body">
               <table class="table table-stripped">
                  <thead>
                     <tr>
                        <th> Date</th>
                       
                        <th> Description</th>
                        <th style='text-align: right;'> Sub Total</th>
                        <th style='text-align: right;'> Vat</th>
                        <th style='text-align: right;'> Grand Total</th>
                     </tr>
                  </thead>
                 
                  <tbody class="ledger">
                     <?php 
foreach ($maintenence as $key => $row)
 {  
	?>
                      <tr>
                        <td> <?=$row->expense_date?></td>
                       
                        <td> <?=$row->description?></td>
                        <td style='text-align: right;'><?=$row->subtotal?></td>
                        <td style='text-align: right;'> <?=$row->tax_amount?></td>
                        <td style='text-align: right;'> <?=$row->tax_amount?></td>
                     </tr>
                     <?php } ?>
                    
                  </tbody>
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
</div>

</section>