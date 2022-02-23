<?php 
  // var_dump($permission);

  // die();
  ?>
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
          <div id="datatable-buttons_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
            <div class="dt-buttons btn-group">
             
             
             
                
                  </div>
                  <div id="datatable-buttons_filter" class="dataTables_filter">
                    <label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="datatable-buttons"></label>
                  </div>
                  <table id="datatable-buttons" style="width: 100%;" class="table table-striped table-bordered dataTable no-footer dtr-inline collapsed" role="grid" aria-describedby="datatable-buttons_info">
                      <thead>
                        <tr role="row">
                        <?php 
          
          if (in_array("create supplier payment",$permission))
          { 
             ?>
                        <th >#</th>
                        <?php } ?>
                        <th >Code</th>
                          <th">Name</th>
                          <th >Address</th>
                          <th>Vat No</th>
                          <th>Mob:</th>
                          <th>Phone:</th>
                          <th>Email</th>

                         
                      </thead>
                      <tbody>
                        <?php 
                        foreach($suppliers as $key=>$value)
                        {
                          ?>
                      <tr role="row" class="odd">
                      <?php 
          
          if (in_array("create supplier payment",$permission))
          { 
             ?>
                      <td tabindex="0" class="sorting_1">
                      <input type="submit" onclick="createsupplierpayment('<?php echo $value->id; ?>');"  class="btn btn-sms btn-success" value="Create supplier payment"></td>
          <?php } ?>
                            <!-- <td tabindex="0" class="sorting_1"><a href="" class="btn btn-success">create Invoice</a></td> -->
                          <td><?php echo $value->code;?><input type="hidden" id="sid" value="<?php  echo $value->id;?>"></td>
                          <td><?php echo $value->supplier_name;?></td>
                          <td><?php echo $value->address;?></td>
                          <td><?php echo $value->vat_no;?></td>
                          <td><?php echo $value->mobile;?></td>
                          <td><?php echo $value->email;?></t66d>
                        
                        </tr><tr role="row" class="even">
                        <?php  } ?>

                      </tbody>
                    </table>
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