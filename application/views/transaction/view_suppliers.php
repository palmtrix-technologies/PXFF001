<?php 
  
  ?>

  <style>
 
.fa-arrow-down {
    transform: rotate(-90deg);
    transition: transform 1s linear;
}

.fa-arrow-down.open {
    transform: rotate(0deg);
    transition: transform 1s linear;
}

.strong
{font-weight: bold;}
</style>
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<section class="content-header">
            <h1>
          Supplier List
            </h1>
          
          </section>
          <section class="content">
            <div class="row">
          <div class="col-md-12">
          <div class="box box-success">
          <div class="box-body">
          <!-- <div id="datatable-buttons_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
            <div class="dt-buttons btn-group">
             
             
             
                
                  </div> -->
                



                  <div id="content" >
                    <label>Search:<input type="search" id="search" class="form-control input-sm" placeholder="" aria-controls="datatable-buttons"></label>
                  
                 
                        <div class="form-group col-md-12">
 <div class="form-group col-md-1"></div>
            <?php 
          
          if (in_array("create supplier payment",$permission))
          { 
             ?>
                       <div class="form-group col-md-2 strong ">#</div>
                        <?php } ?>
                        <div class="form-group col-md-1 strong">Code</div>
                          <div class="form-group col-md-2 strong">Name</div>
                          <div class="form-group col-md-2 strong">Address</div>
                          <div class="form-group col-md-1 strong">Vat No</div>
                          <div class="form-group col-md-1 strong">Mob:</div>
                          <div class="form-group col-md-2 strong">Email</div>

                         </div>


                        <?php 
                        foreach($suppliers as $key=>$value)
                        {
                          ?>
                         <div class="form-group col-md-12">
                 
                    <div id="container" class="form-group col-md-1">
                        <i onclick="showdata('<?php echo $value->id; ?>');" id="icon" class="fa fa-arrow-down"></i>
                        <div id="myDIV<?php echo $value->id; ?>" style="display: none;padding: 38px; margin-left: 42px;">
                         <div class="row">
                          <div class="col-12">
                           <table  class="table table-striped table-bordered dataTable no-footer dtr-inline collapsed" style="width: 100rem !important;">
                                <tr>
                                  <th>sl.No</th>
                                  <th>Date</th>
                                  <th>Invoice</th>
                                  <th>Job</th>
                                  <th>Mode</th>
                                  <th>Status</th>
                                  <th>Amount</th>
                                  <th>Paid Amount</th>
                                   <th>Balance</th>
                                </tr>
                                <?php  $sl=1;$tpaid=0;$tbln=0;$ttotal=0;
                        foreach($balances as $key=>$values)
                        {
                          if($value->id==$values->SupplierID){ 
                          ?>
                                <tr>
                                  <td><?php echo $sl;?></td>
                                  <td><?php echo $values->PostingDate;?></td>
                          <td><?php echo $values->Reference;?></td>
                          <td><?php echo $values->Jobcode;?></td>
                          <td><?php echo $values->Mode;?></td>
                          <td><?php echo $values->Status;?></td>
                           <td><?php echo $values->GrandTotal; $gtotal=$values->GrandTotal;$ttotal=$ttotal+$gtotal;?></td>
                            <td><?php  $paid= $values->GrandTotal-$values->balance; echo $paid;  $tpaid=$tpaid+$paid;?></td>
                             <td><?php echo $values->balance;  $bln=$values->balance; $tbln=$tbln+$bln; ?></td> 

                                </tr><?php $sl++; } }?>
                             <tfoot>
                              <tr class="strong">
                               <td colspan="6">Total</td>
                               <td> <?php echo $ttotal;?></td>
                               <td> <?php echo $tpaid;?></td>
                                <td><?php echo $tbln;?></td>
                              </tr>
                             </tfoot>
                              </table>
                            </div>
                          </div>
                        </div>
                    </div>

                      
                
                   <?php 
           
          if (in_array("create supplier payment",$permission))
          { 
             ?><div class="form-group col-md-2">
                  
                      <input type="submit" onclick="createsupplierpayment('<?php echo $value->id; ?>');"  class="btn btn-sms btn-success" value="Create supplier payment">
          <?php } ?>

                 </div>
 <div class="form-group col-md-1"> <?php echo $value->code;?><input type="hidden" id="sid" value="<?php  echo $value->id;?>"></div>
  <div class="form-group col-md-2" id="suppr"> <?php echo $value->supplier_name;?></div>
   <div class="form-group col-md-2"> <?php echo $value->address;?></div>
    <div class="form-group col-md-1"><?php echo $value->vat_no;?> </div>
     <div class="form-group col-md-1"> <?php echo $value->mobile;?></div>
      <div class="form-group col-md-1"> <?php echo $value->email;?></div>

</div>

                      <?php } ?>

                     <!--  <tbody>
                        <?php 
                        foreach($suppliers as $key=>$value)
                        {
                          ?>
                      <tr role="row" class="odd">

                        <td>
                       <input type="button" onclick="showdata('<?php echo $value->id; ?>');"  class="btn btn-sms btn-success" value="+">
                       <div id="set<?php echo $value->id; ?>" style="display: none;" > 
                        
                              <table>
                                <tr>
                                  <th>sl.No</th>
                                  <th>Supplier</th>
                                  <th>Payment</th>
                                </tr>
                                <tr>
                                  <td>1</td>
                                  <td><?php echo $value->supplier_name;?></td>
                          <td><?php echo $value->address;?></td>
                                </tr>

                              </table>

                         </div>
                        </td>
                      <?php 
          
          if (in_array("create supplier payment",$permission))
          { 
             ?>
                      <td tabindex="0" class="sorting_1">
                      <input type="submit" onclick="createsupplierpayment('<?php echo $value->id; ?>');"  class="btn btn-sms btn-success" value="Create supplier payment"></td>
          <?php } ?>
                         
                          <td><?php echo $value->code;?><input type="hidden" id="sid" value="<?php  echo $value->id;?>"></td>
                          <td><?php echo $value->supplier_name;?></td>
                          <td><?php echo $value->address;?></td>
                          <td><?php echo $value->vat_no;?></td>
                          <td><?php echo $value->mobile;?></td>
                          <td><?php echo $value->email;?></td>
                       
                        </tr><tr role="row" class="even">
                        <?php  } ?>

                      </tbody> 
                    </table>-->
                    <div class="dataTables_info" id="datatable-buttons_info" role="status" aria-live="polite">Showing 1 to 6 of 6 entries
                    </div>
                  </div>
          </div>
          </div>
          </div>
                        </div>
                    
          </section>
                  
<script>
function createsupplierpayment(id)
{
  // var id = $('#sid').val();
  window.location = 'job-supplier-payment/' + id;
 
}
</script>

<script>
$(document).ready(function(){
  $("#hide").click(function(){
    $("#data").hide();
  });
  $("#show").click(function(){
    $("#data").show();
  });
});
</script>
<script>
     function showdata(id)
      { 

current=id;
a="#myDIV"+current;
     $(a).toggle();

 
      }  
 </script>
 <script type="text/javascript">

 $("#filter").keyup(function() {

      // Retrieve the input field text and reset the count to zero
      var filter = $(this).val(),
        count = 0;

      // Loop through the comment list
      $('#results div').each(function() {


        // If the list item does not contain the text phrase fade it out
        if ($(this).text().search(new RegExp(filter, "i")) < 0) {
          $(this).hide();  // MY CHANGE

          // Show the list item if the phrase matches and increase the count by 1
        } else {
          $(this).show(); // MY CHANGE
          count++;
        }

      });

    });
</script>