<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
.ui-autocomplete > li {
  padding: 3px 20px;
}
.ui-autocomplete > li.ui-state-focus {
  background-color: #DDD;
}
.ui-helper-hidden-accessible {
  display: none;
}
  </style>
<section class="content">

      <div class="row">
        <div class="col-md-3">
 <!-- search form -->
         
            <div class="input-group">
              <input type="text"  class="form-control"  id="supplier_name" placeholder="Search supplier"/>
              <input maxlength="100" type="hidden" id="supplier_id" class="form-control" value="">
              <input maxlength="100" type="hidden" id="supplierexpense_id" class="form-control" value="">
              <span class="input-group-btn">
             
                <button type='submit' class="btn btn-flat"  onclick="get_supplier_data();" ><i class="fa fa-search" ></i></button>
              </span>
            </div>
        
          <!-- /.search form -->
          <!-- Profile Image -->
          <h4 class="box-title" id="suppliertitle">Supplier Details </h4>
          <div class="box" id="supplierdescription">
            <div class="box-body box-profile">
            <div class="box-body">
                        <strong><i class=""></i> Supplier Name</strong>
                        <p class="text-muted" id="suppliername">
                          
                        </p>
                        <hr>
                        <strong><i class=""></i> Contact Person</strong>
                        <p class="text-muted" id="contactperson">   
                           
                    </p>
                        <hr>
                        <strong><i class=""></i> Address</strong>
                        <p class="text-muted" id="address">  
                             
                            </p>
                        <hr>
                        <strong><i class=""></i> Country </strong>
                        <p id="country"> 
                          
                        </p>
                        <hr>
                        <strong><i class=""></i>Phone Number</strong>
                        <p id="phone">
                          
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
                  <span class="description-text">TOTAL SUPPLIER INVOICE</span>
                    <h5 class="description-header" id="supplierinvtotal" style="color:green">00.0</h5>
                   
                  </div>
                  <!-- /.description-block -->
                </div>
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                  <span class="description-text">SUPPLIER INVOICE PAID</span>
                    <h5 class="description-header" id="supplierinvpaid" style="color:green">00.0</h5>
                    
                  </div>
                  <!-- /.description-block -->
                </div>
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                  <span class="description-text">BALANCE DUE </span>
                    <h5 class="description-header" id="dueamount" style="color:red">00.0</h5>
                  </div>
                  <!-- /.description-block -->
                </div>
            
               </div>
               <br><br><br>
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="false">Supplier Ledger</a></li>
              <li class=""><a href="#settings" data-toggle="tab" aria-expanded="true">Supplier Expense</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="activity">
              <section class="content">
   <div class="row">
      <div class="col-md-12">
      <h3 class="box-title">Supplier Ledger Report </h3>
      <div class="box">
           <div class="box-header with-border">
          
           </div>
   
            <div class="box-body">
               <table id="supplierledger" class="table table-stripped">
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
                   <tbody class="ledgerdatatable"> 
                     
                     
                  </tbody>
               </table>
                         </div>
      </div>
                         </div>
                         </div>
                         </section>
               
               
              </div>
           
              <div class="tab-pane" id="settings">
                <!-- The timeline -->
                <section class="content">
   <div class="row">
      <div class="col-md-12">
      <h3 class="box-title"> Paid Expences </h3>
         <div class="box">
           <div class="box-header with-border">
          
         
           </div>
           
            <div class="box-body">
    
               <table id="postedexpense" class="table table-stripped">
                  <thead>
                     <tr>
                        <th> Sl.no</th>
                        <th> Posting Date</th>
                        <th> Doc.#</th>
                        <th> Particulars</th>
                        <th> Ref/Inv</th>
                        <th> Supplier</th>
                        <th style='text-align: right;'>  Amount</th>
                        <th>  #</th>

                     </tr>
                
                  </thead>
                  <tbody class="postedexpensedetails">
                    
                  </tbody>
                  <!-- <tr><td colspan=""><label style="float: right;" id="exptotal">Total Expenditure :</label></td></tr> -->
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
      <h3 class="box-title"> Debit Note </h3>
         <div class="box">
           <div class="box-header with-border">
       
          
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
                      
                        <th style='text-align: right;'>  Amount</th>

                        
                     </tr>
                  </thead>
                  <tbody class="debitnotedata">
                    
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
      <h3 class="box-title">Supplier Payment  </h3>
         <div class="box">
           <div class="box-header with-border">
        
          
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
                      
                      <th style='text-align: right;'>  Amount</th>
                     </tr>
                  </thead>
                  <tbody class="supplierpaymentdata">
                    
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
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>

    <script src="<?php echo base_url(); ?>/assets/user_scripts/searchsupplier/supplier_search.js"></script>
    <script>
          $(document).ready(function(){
  

  var obj=[];
              $.ajax({
               url: "<?php echo base_url(); ?>Suppliersearch/Supplier_Search/getsupplierdata",
               type: 'post',
               dataType: "json",
               success: function( data ) 
               {
                   console.log(data);
                obj=data;
            
                $('#supplier_name').autocomplete({
                              source: obj,
                              select: function (event, ui) {
                                  $("#supplier_name").val(ui.item.label);
                                 $("#supplier_id").val(ui.item.value);
                                  return false;
                                  alert("hai");
                              }
                          });
               }
            });
  
  });
  </script>