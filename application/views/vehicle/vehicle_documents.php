<section class="content">
  <div class="row">
    <div class="col-md-6">
    <div class="box box-success">
          <form role="form" method="POST">                                                                                                                                                                                      
                  <div class="box-body" style="min-height:300px;">
                       <div class="form-group">
                         <label>Vehicle Number</label>
                         <select class="form-control" id="vehicle_id" name="vehicle_id"  value="">
                                   
                                  
                                  <?php 
                                  foreach($vehicles as $key=>$value)
                                  {
?>
                                 <option value="<?php echo $value->vehicleid;?>"><?php echo $value->Vehicle_number;?></option>
                                  <?php
                                  }
                                   ?>
                                 </select>
                         </div>      
                
                         
                  </div>
                  <div class="box-footer">
                  <input type="submit"  class="btn btn-success">

                    <button type="reset" class="btn btn-success">Cancel</button>
                  </div>
                
          </form>
          </div>
    </div>
  </div>
</section>