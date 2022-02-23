<?php 

// var_dump($code[0]);
// die();
?>
<section class="content-header">
 <h1>
  New Carrier
 </h1>
</section>
 <section class="content">
    <div class="box box-success">
       <div class="box-body">
          <form role="form">
                  <div class="box-body"  style="min-height: 300px;">
                   
                  
                    
                  <div class="row">
                  <div class="form-group col-md-6 ">
                      <label>Carrier Type</label>
                      <select class="form-control" name="carrier_type" id="carrier_type" value="" onchange="hideprefix();" >
                      <!-- <option value="Airexport">Air Export</option>
                      <option value="Airimport">Air Import</option>
                      <option value="Lclexport">LCL Export</option>
                      <option value="Lclimport">LCL Import</option>
                      <option value="Fclexport">FCL Export</option>
                      <option value="Fclimport">FCL Import</option>
                      <option value="Transportation">Transportation</option>
                        <option value="Landexport">Land Export</option>
                        <option value="Landimport">Land Import</option> -->
                        <option value="Air">Air </option>
                        <option value="Land">Land</option>
                        <option value="Sea">Sea</option>
                        <option value="Transportation">Transportation</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6" id="prefix">
                      <label for="exampleInputname1">Prefix</label>
                <input type="text" id="code"  name="code" autocomplete="off" class="form-control" required="required" placeholder="Prefix"  value="" >
                    </div>
                                <div class="form-group col-md-6">
                      <label for="exampleInputname1">Name</label>
                      <input type="text" id="name"  name="name" autocomplete="off" class="form-control" required="required" id="name" placeholder="Enter name" >
                    </div>
                               
                  
             
                               
                               
</div>
                  <div class="box-footer">
                    <input type="submit"  onclick="store();" class="btn btn-success"></input>
                    <button type="reset"  class="btn btn-success">Cancel</button>
                  </div>
                </form>
</div>
</div>
          </section>
          <script src="<?php echo base_url(); ?>/assets/js/moment.js"></script>
          <script src="<?php echo base_url(); ?>/assets/plugins/iCheck/icheck.min.js"></script>
          <script src="<?php echo base_url(); ?>/assets/user_scripts/masters/carrier.js"></script>



