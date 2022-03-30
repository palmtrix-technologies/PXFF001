<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/bootstrap-tagsinput.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />


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
<style>
    .nav-tabs-custom {
        margin-bottom: 20px;
        background: #fff;
        box-shadow: 0 0px 1px rgba(0, 0, 0, 0.1);
        border-radius: 3px;
    }

    .hidden {

        visibility: hidden
    }

    .tab-pane {
        min-height: 120px;
        border-bottom: solid 1px #f4f4f4;
    }

    .input-checkbox {
        font-weight: normal !important;
    }

    .permission-button-group {
        padding: 15px 0 10px 20px;
    }

    .
</style>

<style>
    .ui-autocomplete {
        position: absolute;
        z-index: 1000;
        cursor: default;
        padding: 0;
        margin-top: 2px;
        list-style: none;
        background-color: #ffffff;
        border: 1px solid #ccc;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    }

    .ui-autocomplete>li {
        padding: 3px 20px;
    }

    .ui-autocomplete>li.ui-state-focus {
        background-color: #DDD;
    }

    .ui-helper-hidden-accessible {
        display: none;
    }

    .nextBtn {
        font-size: 20px;
        color: mintcream;
    }

    .bootstrap-tagsinput {
        background-color: #fff;
        border: 1px solid #ccc;
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        display: block;
        padding: 4px 6px;
        color: #555;
        vertical-align: middle;
        border-radius: 4px;
        max-width: 100%;
        line-height: 22px;
        cursor: text;
    }

    .bootstrap-tagsinput input {
        border: none;
        box-shadow: none;
        outline: none;
        background-color: transparent;
        padding: 0 6px;
        margin: 0;
        width: auto;
        max-width: inherit;
    }
</style>
   
   
    
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
                



                  <div id="content form-group" >
                    <label>Search: <input maxlength="100"  name="view_supplier_name" type="text" id="view_supplier_name" required="required" class="form-control" placeholder=" supplier_name" value="">
                  <input maxlength="100" type="hidden" id="supplier_id" class="form-control" value=""></label>
                  <button type="submit" name="search_job" id="search_job"  class="btn btn-flat" onclick="search()"><i class="fa fa-search" ></i></button>
                 
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

                         <div id="secondDiv">

                        
                        <?php  $count=0;
                        foreach($suppliers as $key=>$value)
                        {
                          ?>
                      
                          <div id="entryDiv<?php echo $value->id; ?>">       
                         <div class="form-group col-md-12" id="myTable" value="<?php echo $value->supplier_name;?>">
                 
                    <div id="container" class="form-group col-md-1">
                        <i onclick="showdata('<?php echo $value->id; ?>');" id="icon" class="fa fa-arrow-down"></i>
                        <div id="myDIV<?php echo $value->id; ?>" style="display: none;padding: 38px; margin-left: 42px;">
                         <div class="row">
                          <div class="col-12">
                           <table  class="table table-striped table-bordered dataTable no-footer dtr-inline collapsed" style="width: 100rem !important;" >
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

                         </div>     <?php $count=$count+1; } ?> </div>
<?php $cnt=$count+1;?>
<input type="hidden" value="<?php echo $cnt;?>"  id="count">

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

<script>
 $(document).ready(function(){

  var obj=[]; 
              $.ajax({
               url: "<?php echo base_url(); ?>transaction/Supplierexpense_Controller/getsupplierdata",
               type: 'post',
               dataType: "json",
               success: function( data ) 
               {
                   console.log(data);
                obj=data; 
                $('#view_supplier_name').autocomplete({ 
                              source: obj,
                              select: function (event, ui) {       
                                  $("#view_supplier_name").val(ui.item.label);
                                 $("#supplier_id").val(ui.item.value);
                                  return false;
  
                              }
                          });
               }
            });
  
  });

  </script>

<script>
   function search()
      { 
      
 var count= $("#count").val();  
      
 var id= $("#supplier_id").val();  
  a="#entryDiv"+id;  
  for(i=0;i<=count;i++)
  {

    aa="#entryDiv"+i;  $(aa).hide();

  }                      
  $(a).show();
  
   }

</script>
