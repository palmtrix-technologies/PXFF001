<?php 
// var_dump($ledger);
// die();
?>
<script src="<?php echo base_url(); ?>/assets/user_scripts/accounts/ledger.js"></script>

<section class="content-header">
            <h1>
         Ledger
            </h1>
          
          </section>
          <section class="content">
          <div class="col-md-5">
          <div class="box box-success">
          <div class="box-body">
          <form role="form">
                  <div class="box-body" style="min-height: 100px;">
                  <div class=" row">
                  <div class="form-group col-md-12">
                      <label for="exampleInputname1">Add Ledger</label>
                      <select class="form-control" onchange="getdata();" name="ledger_type" id="ledger_type" value="--Select Type--">
                      <option value="">--Select Type--</option>
                         <?php 
                  foreach($ledger as $key=>$val)
                  {
                    ?><option value="<?php  echo $val->LedgerGroupID;?>"><?php  echo $val->GroupName;?></option>
                   
                    <?php
                  } ?>
                   
                      </select>
                    </div>
                    </div>
                    <div class=" row">
                    <div class="form-group col-md-12" >
                      <input type="text" class="form-control " required id="ledger_name" name="ledger_name" placeholder="Ledger" >
                      <input type="hidden" class="form-control "  id="id" name="id" >
                    </div>
                   </div>
                   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                  <div id="adddata" name="adddata">     <button type="button" id="submit" name="submit" onclick="store();" class="btn btn-success">Create</button></div>
               <div id="editdata" name="editdata">     <button type="button" id="edit" name="edit" onclick="editdata();" class="btn btn-success">Update</button></div>

                  </div>
                </form>
          </div>
</div>
</div>
<div class="col-md-7">
<div class="box box-success">
         
         <div class="box-body">
             <table class="table table-striped table-hover " id="table-permissionList">
            <h3> LEDGER LIST</h3>
             <thead>
             <tr>
             <th>LEDGER NAME</th>
             <!-- <th id="value" name="value"></th></tr> -->
             </thead>
                 <tbody id="listvalue">
            
              <tbody>
             </table>
          

         </div>
  
         </div>

</div>
          </section>

