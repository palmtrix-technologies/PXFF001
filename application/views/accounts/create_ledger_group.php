<script>
//console.log("dsfgsdf");
</script>
<script src="<?php echo base_url(); ?>/assets/user_scripts/accounts/ledger_group.js"></script>

<section class="content-header">
            <h1>
         Ledger Group
       
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
                      <label for="exampleInputname1">Add Ledger Groups</label>
                      <select onchange="getdata();" class="form-control" name="ledger_type" id="ledger_type" value="--Select Type--">
                      <option value="">--Select Type--</option>
                        <option value="asset">Asset</option>
                        <option value="liability">Liability</option>
                        <option value="income">Income</option>
                        <option value="expense">Expense</option>
                      </select>
                    </div>
                    </div>
                    <div class=" row">
                    <div class="form-group col-md-12">
                      <input type="text" class="form-control" required id="ledger_name" placeholder=" Ledger">
                    </div>
                   </div>
                   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="button" class="btn btn-success" onclick="store();">Create</button>
                  </div>
                </form>
          </div>
</div>
</div>
<div class="col-md-7">
<div class="box box-success">
         
         <div class="box-body">
             <table class="table table-striped table-hover indexer" id="table-permissionList">
            <h3> LEDGER GROUPS</h3>
            <thead>
             <tr>
             <!-- <th>LEDGER NAME</th> -->
             <!-- <th id="value" name="value"></th></tr> -->
             </thead>
             <tbody id="listvalue">
            
            <tbody>
             </table>
          

         </div>
  
         </div>

</div>
          </section>
         
      
          <script src="<?php echo base_url(); ?>/assets/js/moment.js"></script>
          <script src="<?php echo base_url(); ?>/assets/js/alert.js"></script>
          <script src="<?php echo base_url(); ?>/assets/user_scripts/accounts/ledger_group.js"></script>
        