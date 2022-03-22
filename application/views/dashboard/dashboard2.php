<script src="<?php echo base_url(); ?>/assets/dist/js/pages/dashboard2.js" type="text/javascript"></script>





 <?php 
   $dates=date("Y-m-d");
   foreach($creditdate as $value)
   { 
   echo '<script type="text/javascript">'
   . '$( document ).ready(function() {'
   . '$("#stat").modal("show");'
   .  'show: true;'
   . '});'
   . '</script>';
          ?>
<!-- <div class="modal fade" id="stat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel" style="color: #9e111f;">Notification</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            
           <?php foreach($creditdate as $value)
                     { ?> <div class="modal-body"><p>
               <h5>Pending Invoice of  <?php echo $value->name;?> , credit date is  <?php echo $value->credit_date;?> </h5>
               </p> </div><?php   }?>
           
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            
            
         </div>
      </div>
   </div>
</div> -->
<?php } ?> 



  <section class="content-header">
    <h1>
    
      <small></small>
    </h1>
    <!-- <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
      <li class="active"></li>
    </ol> -->
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Info boxes -->
    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
     
        <div class="info-box">
        <a href="<?php echo base_url(); ?>job"> 
          <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
          
          <div class="info-box-content">
            <span class="info-box-text"><h3>New Job</h3></span>
            <span class="info-box-number"><?php echo $jobs[0]->totaljobs;?></span>
          </div>
          <!-- /.info-box-content -->
        </div></a>
        <!-- /.info-box -->
      </div>

      <!-- <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
        <a href="<?php echo base_url(); ?>new_invoice"> 
          <span class="info-box-icon bg-yellow"><i class="fa fa-file-excel-o" aria-hidden="true"></i></span>
          <div class="info-box-content">
            <span class="info-box-text"><h3>New Invoice</h3></span>
            <span class="info-box-number"></span>
          </div>
        </div></a>
      </div> -->

      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">New clients</span>
            <span class="info-box-number"><?php echo $getcliennumber[0]->clients;?></span>
          </div>
        </div>
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-red"><i class="fa fa-briefcase"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Pending Reciepts</span>
            <span class="info-box-number"><?php 
            if($pendingreceipt[0]->total=="")
            {
              ?>
                        0

        <?php  }
        else { ?>
                    <?php echo $pendingreceipt[0]->total;?>

        <?php } ?>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix visible-sm-block"></div>

      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total pending payments</span>
            <span class="info-box-number"><?php echo ($pendingpayment[0]->exptotal-$pendingpayment1[0]->paymenttotal);?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
     
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Monthly Recap Report</h3>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <div class="btn-group">
                <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Separated link</a></li>
                </ul>
              </div>
              <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-8">
                <p class="text-center">
                  <strong >Sales:1 Jan 2020- 31 July 2020 <span id="salesdate"></span></strong>
                </p>
                <div class="chart-responsive">
                  <!-- Sales Chart Canvas -->
                  <canvas id="salesChart" height="180"></canvas>
                </div>
                <!-- /.chart-responsive -->
              </div>
              <!-- /.col -->
              <div class="col-md-4">
                <p class="text-center">
                  <strong>JOB CATEGORY WISE</strong>
                </p>
                <?php 
                $perc=0;
                $percsea=0;
                $percland=0;
                $percother=0;
                $number=$jobair[0]->aircount;
                $total= $jobs[0]->totaljobs;
                $numbersea=$jobsea[0]->seacount;
                $numberland=$jobland[0]->landcount;
                $numberother=$jobother[0]->othercount;

                if($total!=0)
                {
                  $perc=($number/$total)*100;
                  $percsea=($numbersea/$total)*100;
                  $percland=($numberland/$total)*100;
                  $percother=($numberother/$total)*100;

                }
               
          
                ?>
                <div class="progress-group">
                  <span class="progress-text">AIR TRANSPORTATION</span>
                  <span class="progress-number"><b><?php echo $jobair[0]->aircount;?></b>/<?php echo $jobs[0]->totaljobs;?></span>
                  <div class="progress sm">
                    <div class="progress-bar progress-bar-aqua" style="width:<?php echo $perc;?>%;"></div>
</div>
</div>
<!-- /.progress-group -->
<div class="progress-group">
  <span class="progress-text">SEA TRANSPORTATION</span>
  <span class="progress-number"><b><?php echo $jobsea[0]->seacount;?></b>/<?php echo $jobs[0]->totaljobs;?></span>
  <div class="progress sm">
    <div class="progress-bar progress-bar-red"  style="width:<?php echo $percsea;?>%;"></div>
</div>
</div>
<!-- /.progress-group -->
<div class="progress-group">
  <span class="progress-text">LAND TRANSPORTATION</span>
  <span class="progress-number"><b><?php echo $jobland[0]->landcount;?></b>/<?php echo $jobs[0]->totaljobs;?></span>
  <div class="progress sm">
    <div class="progress-bar progress-bar-green" style="width:<?php echo $percland;?>%;"></div>
</div>
</div>
<!-- /.progress-group -->
<div class="progress-group">
  <span class="progress-text">Others</span>
  <span class="progress-number"><b><?php echo $jobother[0]->othercount;?></b>/<?php echo $jobs[0]->totaljobs;?></span>
  <div class="progress sm">
    <div class="progress-bar progress-bar-yellow" style="width:<?php echo $percother;?>%;"></div>
</div>
</div>
<!-- /.progress-group -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->
</div>
<!-- ./box-body -->
<div class="box-footer">
  <div class="row">
    <div class="col-sm-3 col-xs-6">
      <div class="description-block border-right">
        <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
  
  
       <h5 class="description-header"><?php echo $monthlyreport[0]->standardrate;?></h5>
        <span class="description-text">TOTAL REVENUE</span>
      </div>
      <!-- /.description-block -->
    </div>
    <!-- /.col -->
    <div class="col-sm-3 col-xs-6">
      <div class="description-block border-right">
        <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
        <h5 class="description-header"><?php echo $totalexpense[0]->standardratedexpense;?></h5>
        <span class="description-text">TOTAL COST</span>
      </div>
      <!-- /.description-block -->
    </div>
    <!-- /.col -->
    <div class="col-sm-3 col-xs-6">
      <div class="description-block border-right">
        <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
        <?php 
        $profit=$monthlyreport[0]->standardrate-$totalexpense[0]->standardratedexpense;
        ?>
        <h5 class="description-header"><?php echo $profit;?></h5>
        <span class="description-text">TOTAL PROFIT</span>
      </div>
      <!-- /.description-block -->
    </div>
    <!-- /.col -->
    <div class="col-sm-3 col-xs-6">
      <div class="description-block">
        <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
        <h5 class="description-header"><?php echo $jobs[0]->totaljobs;?></h5>
        <span class="description-text">TOTAL JOBS</span>
      </div>
      <!-- /.description-block -->
    </div>
  </div>
  <!-- /.row -->
</div>
<!-- /.box-footer -->
</div>
<!-- /.box -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->

<!-- Main row -->
<div class="row">
  <!-- Left col -->
  <div class="col-md-8">
    <!-- MAP & BOX PANE -->
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Job destination report</h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body no-padding">
        <div class="row">
          <div class="col-md-9 col-sm-8">
            <div class="pad">
              <!-- Map will be created here -->
              <div id="world-map-markers" style="height: 325px;"></div>
</div>
</div>
<!-- /.col -->

<div class="col-md-3 col-sm-4">
  <div class="pad box-pane-right bg-green" style="min-height: 280px">
<div class="description-block margin-bottom">
  <div class="sparkbar pad" data-color="#fff">90,70,90,70,75,80,70</div>
  <h5 class="description-header"><?php echo $importdata[0]->importcount;?></h5>
  <span class="description-text">Import</span>
</div>
<!-- /.description-block -->
<div class="description-block margin-bottom">
  <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
  <h5 class="description-header"><?php echo $exportdata[0]->exportcount;?></h5>
  <span class="description-text">Export</span>
</div>
<!-- /.description-block -->
<div class="description-block">
  <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
  <h5 class="description-header"><?php echo $othercount[0]->othercount;?></h5>
  <span class="description-text">Others</span>
</div>
<!-- /.description-block -->
</div>
</div>
<!-- /.col -->
</div>
<!-- /.row -->
</div>
<!-- /.box-body -->
</div>
<!-- /.box -->

</div>
<!-- /.col -->

<div class="col-md-4">
  <!-- Info Boxes Style 2 -->
  <div class="info-box bg-yellow">
    <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
    <div class="info-box-content">
      <span class="info-box-text">Purchase</span>
      <span class="info-box-number"><?php echo $purchase[0]->totalexp;?></span>
      <div class="progress">
        <div class="progress-bar" style="width: 50%"></div>
</div>
<span class="progress-description">
                    50% Increase in 30 Days
                  </span>
</div>
<!-- /.info-box-content -->
</div>
<!-- /.info-box -->
<div class="info-box bg-green">
  <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Invoices</span>
    <span class="info-box-number"><?php echo $income[0]->incometotal;?></span>
    <div class="progress">
      <div class="progress-bar" style="width: 20%"></div>
</div>
<span class="progress-description">
                    20% Increase in 30 Days
                  </span>
</div>
<!-- /.info-box-content -->
</div>
<!-- /.info-box -->
<div class="info-box bg-red">
  <span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Estimated Jobs</span>
    <span class="info-box-number"><?php echo round($estimatetotaldata[0]->totalestimate,2);?></span>
    <div class="progress">
      <div class="progress-bar" style="width: 70%"></div>
</div>
<span class="progress-description">
                    70% Increase in 30 Days
                  </span>
</div>
<!-- /.info-box-content -->
</div>
<!-- /.info-box -->
<div class="info-box bg-aqua">
  <span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Enquirees</span>
    <span class="info-box-number">0</span>
    <div class="progress">
      <div class="progress-bar" style="width: 40%"></div>
</div>
<span class="progress-description">
                    0% Increase in 30 Days
                  </span>
</div>
<!-- /.info-box-content -->
</div>
<!-- /.info-box -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->



    <!-- /.box -->
  </div>
  <!-- /.col -->
  <div class="col-md-4 hidden">
    <!-- PRODUCT LIST -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Recently Added Products</h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <ul class="products-list product-list-in-box">
          <li class="item">
            <div class="product-img">
              <!-- <img src="http://placehold.it/50x50/d2d6de/ffffff" alt="Product Image" /> -->
            </div>
            <div class="product-info">
              <a href="javascript::;" class="product-title">Samsung TV <span class="label label-warning pull-right">$1800</span></a>
              <span class="product-description">
                          Samsung 32" 1080p 60Hz LED Smart HDTV.
                        </span>
            </div>
          </li>
          <!-- /.item -->
          <li class="item">
            <div class="product-img">
              <!-- <img src="<?php echo base_url(); ?>assets/dist/img/default-50x50.gif" alt="Product Image" /> -->
            </div>
            <div class="product-info">
              <a href="javascript::;" class="product-title">Bicycle <span class="label label-info pull-right">$700</span></a>
              <span class="product-description">
                          26" Mongoose Dolomite Men's 7-speed, Navy Blue.
                        </span>
            </div>
          </li>
          <!-- /.item -->
          <li class="item">
            <div class="product-img">
              <!-- <img src="<?php echo base_url(); ?>assets/dist/img/default-50x50.gif" alt="Product Image" /> -->
            </div>
            <div class="product-info">
              <a href="javascript::;" class="product-title">Xbox One <span class="label label-danger pull-right">$350</span></a>
              <span class="product-description">
                          Xbox One Console Bundle with Halo Master Chief Collection.
                        </span>
            </div>
          </li>
          <!-- /.item -->
          <li class="item">
            <div class="product-img">
              <!-- <img src="<?php echo base_url(); ?>assets/dist/img/default-50x50.gif" alt="Product Image" /> -->
            </div>
            <div class="product-info">
              <a href="javascript::;" class="product-title">PlayStation 4 <span class="label label-success pull-right">$399</span></a>
              <span class="product-description">
                          PlayStation 4 500GB Console (PS4)
                        </span>
            </div>
          </li>
          <!-- /.item -->
        </ul>
      </div>
      <!-- /.box-body -->
      <div class="box-footer text-center">
        <a href="javascript::;" class="uppercase">View All Products</a>
      </div>
      <!-- /.box-footer -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

</section>
<!-- /.content -->
     
  <!-- <script>
    $( document ).ready(function() {
      var d = new Date(),

month = d.getMonth(),

year = d.getFullYear();
// console.log(month);  
// console.log(year);  

if((month == 1)||(month == 2)||(month == 3)){


fromdate="1"+" jan "+year;
todate="31"+" march "+year;

}
if(month == 4||month == 5||month == 6){

  fromdate="1"+" April "+year;
todate="30"+" June "+year;

}
if(month == 7||month == 8||month == 9){
  fromdate="1"+" July "+year;
todate="30"+" Sept "+year;
}
if(month == 10||month == 11||month == 12){
  fromdate="1"+" Oct "+year;
todate="31"+" Dec "+year;
}
$("#salesdate").html(fromdate+"-"+todate);

  });

  </script> -->

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
  <script type="text/javascript">
    $(document).ready(function(){
           
          

           $.ajax({
               url: "<?php echo base_url(); ?>transaction/Supplierexpense_Controller/getcreditData",
               type: 'post',
             // dataType: "json",
               success: function( status ) 
               {  
                 var data = JSON.parse(status);
                console.log(data);
                $.each(data["rec"], function(index, value){

                //  $('#creditdata').append(value.name); 
                 // $('#cdate').append(value.credit_date);
              // var name=value.Inv;
               var a="#myModal"+value.InvoiceMasterId;   
                $('#myModal9').modal("show");
           //    $('a').modal("show"); exit();
               });
  
             
                     
               }
            });

      }); 
 </script>