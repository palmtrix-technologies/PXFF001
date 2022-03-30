<script src="<?php echo base_url(); ?>/assets/dist/js/pages/dashboard2.js" type="text/javascript"></script>

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
            <span class="info-box-text"><h4>New Job</h4></span>
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
        <a href=""> 
          <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
          <div class="info-box-content">
            <span class="info-box-text"><h4>New clients</h4></span>
            <span class="info-box-number"><?php echo $getcliennumber[0]->clients;?></span>
          </div>
        </div></a>
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
        <a href="">
          <span class="info-box-icon bg-red"><i class="fa fa-briefcase"></i></span>
          <div class="info-box-content">
            <span class="info-box-text"><h4>Pending Reciepts</h4></span>
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
          </div></a>
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix visible-sm-block"></div>

      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
        <a href="">
          <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>
          <div class="info-box-content">
            <span class="info-box-text"><h4>Total pending payments</h4></span>
            <span class="info-box-number"><?php echo ($pendingpayment[0]->exptotal-$pendingpayment1[0]->paymenttotal);?></span>
          </div></a>
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
              <div class="col-md-8" style="display:none;">
                <p class="text-center">
                  <strong >Sales:1 Jan 2020- 31 July 2020 <span id="salesdate"></span></strong>
                </p>
                <div class="chart-responsive">
                  <canvas id="salesChart" height="180"></canvas>
                </div>
                <!-- /.chart-responsive -->
              </div>
              <!-- /.col -->
              <div class="col-md-12">
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

<!-- /.box-footer -->
</div>
<!-- /.box -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->

<!-- Main row -->
<div class="row">
  <div class="col-md-8">
  <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Latest Jobs</h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="table-responsive">
          <table class="table no-margin">
            <thead>
              <tr>
                <th>JOB ID</th>
                <th>Mode</th>
                <th>Type</th>
                <th>Status</th>
                <!-- <th>Popularity</th> -->
              </tr>
            </thead>
            <tbody>
              <?php

              foreach($latestjobsdata as $value)
{
  ?>
           <tr>
                <td><a href="#"><?php echo $value->Jobcode;?></a></td>
                <?php if($value->Type=="airexport"||$value->Type=="airimport")
             { 
                ?>
  <td>  <i class="text-blue fa fa-plane"></i></td>
             <?php } ?>
             <?php if($value->Type=="fclexport"||$value->Type=="fclimport"||$value->Type=="lclexport"||$value->Type=="lclimport")
             { 
                ?>
  <td>  <i class="text-blue fa fa-ship"></i></td>
             <?php } ?>
             <?php if($value->Type=="landexport"||$value->Type=="landimport")
             { 
                ?>
  <td>  <i class="text-blue fa fa-truck"></i></td>
             <?php } ?>
             <?php if($value->Type=="transportation")
             { 
                ?>
  <td>  <i class="text-blue fa fa-train"></i></td>
             <?php } ?>
                <td><?php echo $value->Type;?></td>
                <?php if($value->Status=="OPEN")
             { 
                ?>
                <td><span class="label label-success"><?php echo $value->Status;?></span></td>
             <?php } ?>
                <?php if($value->Status=="CLOSED")
             { 
                ?>
                <td><span class="label label-danger"><?php echo $value->Status;?></span></td>
             <?php } ?>
                <!-- <td>
                  <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                </td> -->
              </tr>
              <?php
} ?>    
            </tbody>
          </table>
        </div>
        <!-- /.table-responsive -->
      </div>
      <!-- /.box-body -->
      <div class="box-footer clearfix">
        <a href="<?php echo base_url(); ?>job" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
        <a href="<?php echo base_url(); ?>list-job" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
      </div>
      <!-- /.box-footer -->
    </div> 

</div>
<div class="col-md-4">
  <!-- Info Boxes Style 2 -->
  <div class="info-box bg-yellow">
    <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
    <div class="info-box-content">
      <span class="info-box-text">Purchase</span>
      <span class="info-box-number"><?php echo $purchase[0]->totalexp;?></span>
     

</div>
<!-- /.info-box-content -->
</div>
<!-- /.info-box -->
<div class="info-box bg-green">
  <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Invoices</span>
    <span class="info-box-number"><?php echo $income[0]->incometotal;?></span>
  
</div>
<!-- /.info-box-content -->
</div>
<!-- /.info-box -->
<div class="info-box bg-red">
  <span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Estimated Jobs</span>
    <span class="info-box-number"><?php echo round($estimatetotaldata[0]->totalestimate,2);?></span>
   
</div>
<!-- /.info-box-content -->
</div>
<!-- /.info-box -->
<div class="info-box bg-aqua">
  <span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Number of Clients</span>
    <span class="info-box-number"><?php echo round($getcliennumber[0]->clients,2);?></span>
    
</div>
<!-- /.info-box-content -->
</div>
<!-- /.info-box -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->

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