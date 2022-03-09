<?php  

?>
<script src="<?php echo base_url(); ?>/assets/plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/bootstrap-tagsinput.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />
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
<section class="content">
<input type="hidden" value="<?php echo base_url(); ?>" id="baseurl"/>
      <div class="row">
        <div class="col-md-3">
 <!-- search form -->
           <!-- <form action="#" method="get"> -->
            <div class="input-group">
              <input  type="text" id="qq" required="required" class="form-control" placeholder=" Search" value=""/>
              <input type="hidden"  name="q" id="q" class="form-control" value="">
               <span class="input-group-btn">
                <button type="submit" name="search_job" id="search_job"  class="btn btn-flat" onclick="search_job()"><i class="fa fa-search" ></i></button>
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
               <input type="hidden" id="id" value="">
                        <strong><i class=""></i> Job</strong>
                        <p  id="job_id">
                           <!-- <?php echo $jobdata[0]->JobId;?> -->
                        </p>
                        <hr>
                        <input type="hidden" name="client_id" id="client_id" class="form-control" />

                        <strong><i class=""></i> Shipper</strong>
                        <p class="text-muted" id="shipper">   
                             <!-- <?php echo $jobdata[0]->Shipper;?> -->
                    </p>
                        <hr>
                        <strong><i class=""></i> Consignee</strong>
                        <p class="text-muted" id="consignee">  
                              <!-- <?php echo $jobdata[0]->Consignee;?>  -->
                            </p>
                        <hr>
                        <strong><i class=""></i> Client Company </strong>
                        <p class="text-muted" id="client">  
                            <!-- <?php echo $jobdata[0]->client_name;?> -->
                        </p>
                        <hr>
                        <strong><i class=""></i>Shipment Terms</strong>
                        <p class="text-muted" id="terms">  
                             <!-- <?php echo $jobdata[0]->Type;?> -->
                             </p>
                        
                                 <hr>
                        <strong><i class=""></i>Consignment Description</strong>
                        <p class="text-muted" id="desc">  
                            <!-- <?php echo $jobdata[0]->PoNo;?> -->
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
               <div class="col-sm-3 col-xs-6 ">
                  <div class="description-block border-right ">
                  <span class="description-text ">TOTAL INVOICE</span>
                   <h5 class=" description-header" id="invtotal" style="color:green;">0.00</h5>

                  </div>
                  <!-- /.description-block -->
                </div>
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                  <span class="description-text">TOTAL EXPENCE</span>
                    <h5 class="description-header" id="expensetotal" style="color:green;">0.00</h5>
                    
                  </div>
                  <!-- /.description-block -->
                </div>
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                  <span class="description-text">INVOICE PAID </span>
                    <h5 class="description-header" id="invpaid" style="color:green;">0.00</h5>
                  </div>
                  <!-- /.description-block -->
                </div>
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                  <span class="description-text">AMOUNT DUE </span>
                    <h5 class="description-header" style="color:red;" id="amountdue">0.00</h5>
                  </div>
                  <!-- /.description-block -->
                </div>
               </div>
               <br>
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="false">Job Ledger</a></li>
              <li class=""><a href="#timeline" data-toggle="tab" aria-expanded="false">Invoice</a></li>
              <li class=""><a href="#estima" data-toggle="tab" aria-expanded="false">Estimate</a></li>
              <li class=""><a href="#settings" data-toggle="tab" aria-expanded="true">Supplier Expense</a></li>
              <li class=""><a href="#document" data-toggle="tab" aria-expanded="true">Documents</a></li>
              <?php 
          
         //   if (in_array("create invoice",$permission))
         //   { 
              ?>
              <!-- <li class=""><a href="" onclick=createnewinvoice(); data-toggle="tab" aria-expanded="true">Create Invoice and Expense</a></li> -->
            <?php 
            // }
            ?>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="activity">
              <section class="content">
              <div class="row">
      <div class="col-md-12">
      <h3 class="box-title"> Job Ledger Report </h3>
      <div class="box">
         
         
            
            <div class="box-body">
               <table class="table table-stripped">
                  <thead>
                     <tr>
                        <th> Sl.no</th>
                        <th> Date</th>
                        <th> Transaction Type</th>
                        <th> Description</th>
                        <th style='text-align: right;'> Credit</th>
                        <th style='text-align: right;'> Debit</th>
                       
                     </tr>
                  </thead>
                 
                  <tbody class="ledger">
                     
                    
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
      <h3 class="box-title"> Generated Invoices </h3>
         <div class="box ">
           <div class="box-header with-border">
           <?php 
          
          if (in_array("create invoice",$permission))
          { 
             ?>
           <input type="submit" onclick="createnewinvoice();" style="float: right; width:150px;" class="btn btn-block btn-success" value="Create new invoice">
           <!-- <span class="new-button" style="float: right;" onclick="createnewinvoice();"><a href=" " class="btn btn-success btn-sm" ><span class="fa fa-plus"></span> &nbsp;Create Invoice </a></span> -->
          <?php 
         } 
         ?>
         </div>
           
            <div class="box-body">
    
               <table id="invoicereport" class="table table-stripped">
                  <thead>
                     <tr>
                        <th> Sl.no</th>
                        <th> Invoice.no</th>
                        <th> Date</th>
                        <!-- <th> Particulars</th> -->
                        <th> Mode</th>
                        <th>  Vat</th>
                        <th> SubTotal</th>

                        <th style='text-align: right;'>  Grand Total</th>
                        <?php 
          
          if (in_array("update invoice",$permission))
          { 
             ?>
                        <th >  Action</th>
          <?php } ?>
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
         <div class="box">
           <div class="box-header with-border">
           <?php 
          
          if (in_array("create creditnote",$permission))
          { 
             ?>
           <input type="submit" onclick="createcreditnote();" style="float: right; width:150px;" class="btn btn-block btn-success" value="Create Creditnote">
          <?php } ?>
           <!-- <span class="new-button" style="float: right;"><a href="<?php echo base_url(); ?> " class="btn btn-success btn-sm" ><span class="fa fa-plus"></span> &nbsp;Create Creditnote </a></span> -->
           </div>
           
            <div class="box-body">
    
               <table id="invoicereport" class="table table-stripped">
                  <thead>
                     <tr>
                        <th> Sl.no</th>
                        <th> CRN.no</th>
                        <th> Date</th>
                        <th> Customer</th>
                      
                        <th >  Amount</th>
                        <th >  Actions</th>
                        
                     </tr>
                  </thead>
                  <tbody class="creditdata">
                
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
      <h3 class="box-title">Customer Payment Receipt </h3>
         <div class="box ">
           <div class="box-header with-border">
          
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
                        <th style='text-align: right;'> Amount</th>
                     </tr>
                  </thead>
                  <tbody class="paymentreceipt">
                  
                  </tbody>

               </table>
            </div>
         </div>
      </div>
   </div>
</section> 
              </div>
            

              <div class="tab-pane" id="estima">
                <!-- The timeline -->
                <section class="content">
   <div class="row">
      <div class="col-md-12">
      <h3 class="box-title"> Generated Estimate </h3>
         <div class="box ">
           <div class="box-header with-border">
           
         </div>
           
            <div class="box-body">
    
               <table id="invoicereport" class="table table-stripped">
                  <thead>
                     <tr>
                        <th> Sl.no</th>
                        <th> Estimate.no</th>
                        <th> Date</th>
                        <th>  Vat</th>
                        <th> SubTotal</th>

                        <th style='text-align: right;'>  Grand Total</th>
                        <?php 
          
          if (in_array("update invoice",$permission))
          { 
             ?>
                        <th >  Action</th>
          <?php } ?>
                     </tr>
                  </thead>
                  <tbody class="dataadda">
                     
                  </tbody>
                  </table>
            </div>
         </div>
      </div>
   </div>
</section> 
<br><br>

<br><br>

              </div>


              <div class="tab-pane " id="settings">
              <section class="content">
   <div class="row">
      <div class="col-md-12">
      <h3 class="box-title"> Posted Expences </h3>
         <div class="box ">
           <div class="box-header with-border">
           <?php 
          
          if (in_array("create expense",$permission))
          { 
             ?> 
           <input type="submit" onclick="createexpense();" style="float: right; width:150px;" class="btn btn-block btn-success" value="Create new expense">
          <?php 
         } 
         ?>  
         </div>
           
            <div class="box-body">
    
               <table id="invoicereport" class="table table-stripped">
                  <thead>
                     <tr>
                        <th> Sl.no</th>
                        <th> Inv Date</th>
                        <th> Doc.#</th>
                        <!-- <th> Particulars</th> -->
                        <th> Ref/Inv</th>
                        <th> Supplier</th>
                      
                        <th style='text-align: right;'>  Amount#</th>
                        <?php 
          
          if (in_array("update expense",$permission))
          { 
             ?>
                 <th>  Action</th>

          <?php } ?>
                     </tr>
                  </thead>
                  <tbody class="postedexpense">
                   
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
         <div class="box ">
           <div class="box-header with-border">
           <h3 class="box-title"> Debit Note </h3>
           <?php 
          
          if (in_array("create debitnote",$permission))
          { 
             ?> 
           <input type="submit" onclick="createdebitnote();" style="float: right; width:150px;" class="btn btn-block btn-success" value="Create Debitnote">
          <?php } ?> 
         </div>
           
            <div class="box-body">
    
               <table id="invoicereport" class="table table-stripped">
                  <thead>
                     <tr>
                     <th> Sl.no</th>
                        <th> Inv Date</th>
                        <th> Doc.#</th>
                        <!-- <th>Particulars</th> -->
                        <th> Ref/Inv</th>
                        <th> Supplier</th>
                      
                        <th style='text-align: right;'>  Amount#</th>
                        <th >  Actions</th>
                        
                     </tr>
                  </thead>
                  <tbody class="debitnote">
                    
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
         <div class="box">
           <div class="box-header with-border">
           <h3 class="box-title">Supplier Payment  </h3>
           </div>
           
            <div class="box-body">
    
               <table id="invoicereport" class="table table-stripped">
                  <thead>
                     <tr>
                        <th> Sl.no</th>
                       
                        <th>Payment Date</th>
                        <th> Doc.#</th>
                        <!-- <th> Particulars</th>
                        <th> Ref/Invoice</th> -->
                        <th> Supplier</th>
                      
                      <th style='text-align: right;'>  Amount#</th>
                  
                        
                     </tr>
                  </thead>
                  <tbody class="payment">
                    
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</section> 
              </div>
              <div class="tab-pane " id="document">
              <section class="content">
   <div class="row">
      <div class="col-md-12">
      <h3 class="box-title">Documents </h3>
         <div class="box ">
            <div class="box-body">
               <table id="invoicereport" class="table table-stripped">
                  <thead>
                     <tr>
                        <th> Sl.no</th>
                        <th>Document Type</th>
                        <th>Document</th>
                        <!-- <th> Particulars</th> -->
                        <th>Action</th>
                     </tr>
                  </thead>
                  <!-- <tbody>
                           <?php
                              foreach ($document as $doc) {
                           ?>
                           <tr>
                           <td><?php echo $doc->doc_type ;?></td>
                           <td><?php  echo "<img src='" . base_url().$doc->name."' width=100px; >";?></td>
                          
                         <td>
                           
                           <?php
                           if(pathinfo(base_url("$doc->name"), PATHINFO_EXTENSION)=="pdf"){
                            echo "<img src='" . base_url()."assets/images/pdf.png"."' width=100px; >";
                           }elseif(pathinfo(base_url("$doc->name"), PATHINFO_EXTENSION)=="csv"){
                            echo "<img src='" . base_url()."assets/images/excel.png"."' width=100px; >";
                           }elseif(pathinfo(base_url("$doc->name"), PATHINFO_EXTENSION)=="doc"){
                            echo "<img src='" . base_url()."assets/images/doc.png"."' width=100px; >";
                           }elseif(pathinfo(base_url("$doc->name"), PATHINFO_EXTENSION)=="docx"){
                            echo "<img src='" . base_url()."assets/images/doc.png"."' width=100px; >";
                           }else{
                            echo "<img src='" . base_url().$doc->name."' width=100px; >";
                           } ?>
                           </td> 
                           <td class="noprint"> <a href="<?php  echo str_replace(" ","_",base_url("$doc->name"));?>"  class="btn btn-xs btn-success downloadable" download><i class="fa fa-download"></i></a> </td>
                          
                           </tr>
  
                          <?php
                             }
                             ?>
                           </tbody> -->
                           <tbody class="docus">
                     
                    
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
    <script src="<?php echo base_url(); ?>/assets/user_scripts/jobsearch/jobsearch.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {


        var obj = [];
        $.ajax({
            url: "<?php echo base_url(); ?>Jobsearch/Job_Search/getjobdata",
            type: 'post',
           dataType: "json",
            success: function(data) { 
                obj = data;
                $('#qq').autocomplete({
                    source: obj,
                    select: function(event, ui) {  
                        $("#qq").val(ui.item.label);
                        $("#q").val(ui.item.value);
                        return false;

                    }
                });
            }
        });

    });
</script>
