<script src="<?php echo base_url(); ?>/assets/plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/bootstrap-tagsinput.min.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/js/dropzone.js"></script> -->
<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dropzone.min.css"> -->

<?php 
   
   $month = date('m');
   $day = date('d');
   $year = date('Y');
   
   $today = $year . '-' . $month . '-' . $day;
   ?>
<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />
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
<br>
<div class="container">
    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step col-xs-2">
                <a href="#step-1" type="button" class=" vzbtn1 btn btn-success btn-circle"> 1</a>
                <p><small>Create Shipment</small></p>
            </div>
            <div class="stepwizard-step col-xs-2">
                <a href="#step-2" type="button" class=" vzbtn2 btn btn-default btn-circle">2</a>
                <p><small>Port Details</small></p>
            </div>
            <div class="stepwizard-step col-xs-2">
                <a href="#step-3" type="button" class=" vzbtn3 btn btn-default btn-circle">3</a>
                <p><small>Plannes/Consignment</small></p>
            </div>
            <!-- <div class="stepwizard-step col-xs-2">
                <a href="#step-4" type="button" class="btn btn-default btn-circle">4</a>
                <p><small>Summary</small></p>
            </div> -->

        </div>
    </div>

    <form role="form" method="POST">
        <div class="col-md-11 ">
            <div class="panel panel-primary setup-content" id="step-1">
                <div class="panel-heading">
                    <h3 class="panel-title">Shipper</h3>
                </div>
                <div class="panel-body">
                    <div class=" row">
                        <div class="form-group">
                            <b>
                                <h4> &nbsp; &nbsp; Which type of shipment would you like to create ?</h4>
                            </b><br>
                            &nbsp; &nbsp;
                            <div class="form-group col-md-3">
                            <button class="btn btn-info nextBtn pull-right trans-type  " id="air" type="button" value="Air" style="width:160px; height:50px;"><i class="text-blue fa fa-plane"></i>  Air Export</button>

</div>
   <div class="form-group col-md-3">
                                <button class="btn btn-primary nextBtn pull-right trans-type " id="airimport" type="button" value="AirImport" style="width:160px; height:50px;"> <i class="text-blue fa fa-plane"></i>  Air Import</button>

                                </div>
                                <div class="form-group col-md-3">                                
                                <button class="btn btn-info nextBtn pull-right trans-type " id="sea" type="button" value="FCLExport" style="width:160px; height:50px;"><i class="text-black fa fa-ship"></i>   FCL Export</button>

                                </div>
                                <div class="form-group col-md-3">                     
                                               <button class="btn btn-primary nextBtn pull-right trans-type" id="fclimport" type="button" value="FCLImport" style="width:160px; height:50px;"><i class="text-black fa fa-ship"></i>   FCL Import</button>

                                </div>
                                <div class="form-group col-md-3">                      
                                              <button class="btn btn-primary nextBtn pull-right trans-type" id="lclexport" type="button" value="LCLExport" style="width:160px; height:50px;"><i class="text-white fa fa-ship"></i>   LCL Export</button>

                                </div>
                                <div class="form-group col-md-3">                             
                                       <button class="btn btn-info nextBtn pull-right trans-type " id="lclimport" type="button" value="LCLImport" style="width:160px; height:50px;"> <i class="text-white fa fa-ship"></i>  LCL Import</button>

                                </div>
                                <div class="form-group col-md-3">                           
                                         <button class="btn btn-primary nextBtn pull-right trans-type " id="land" type="button" value="LandExport" style="width:160px; height:50px;"> <i class="text-red fa fa-truck"></i>  Land Export</button>

                                </div>
                                <div class="form-group col-md-3">                             
                                       <button class="btn btn-info nextBtn pull-right trans-type " id="landimport" type="button" value="LandImport" style="width:160px; height:50px;"><i class="text-red fa fa-truck"></i>   Land Import</button>
                                </div>
                                <div class="form-group col-md-3">                              
                                      <button class="btn btn-info nextBtn pull-right trans-type " id="transportation" type="button" value="Other" style="width:160px; height:50px;"><i class="text-yellow fa fa-train"></i>Transportation</button>


</div>
                        </div>
                    </div>
                </div>
                <!-- <button class="btn btn-primary nextBtn pull-right" type="button">Next</button> -->
            </div>
        </div>
        <div class="col-md-11 ">
            <div class="panel panel-primary setup-content" id="step-2">
                <div class="panel-heading">
                    <h3 class="panel-title">Job Details</h3>
                </div>
                <div class="panel-body">
                    <div class=" row">
                        <div class="form-group  col-md-3">
                            <label class="control-label ">Number</label>
                            <input type="hidden" name="id" id="id" value="<?php echo $values[0]->JobId; ?>" />
                            <input type="hidden" name="type" id="type" value="<?php echo $values[0]->Type; ?>" />
                            <?php 
                        /*     if( $values[0]->Number==0) { ?>
                            <input type="text" id="code" name="code" class="form-control" placeholder="" readonly="readonly" value="<?php echo $jobno+1; ?>">
                           
                            <?php
                              }
                            else
                            {
                                ?>
                                <input type="text" id="code" name="code" class="form-control" placeholder="" readonly="readonly" value="<?php echo $values[0]->Jobcode; ?>">
                         
                                <?php
                                   }   */
                            ?>
                 <input type="hidden"  id="code" name="code" class="form-control" placeholder="" readonly="readonly" value="<?php echo $jobcode[0]->Number; ?>">
                 <input type="text" id="code12" name="code12" class="form-control" placeholder="" readonly="readonly" value="<?php echo $jobcode[0]->Jobcode; ?>">
                        </div>
                        <div class="form-group col-md-3">


                            <label class="control-label" for="date">Date</label>
                            <input class="form-control" id="date" value="<?php echo $values[0]->Date; ?>" name="date" placeholder="MM/DD/YYY" type="text" />
                        </div>
                    </div>
                    <div class=" row">
                    <div class="form-group col-md-4">
                            <label for="exampleInputname1">Client Name</label>
                            <input type="hidden" name="client_id" id="client_id" value="" />
                            <select class="form-control" name="client_name" id="client_name" value="--Select Type--">
                                <option value="select">--Select Type--</option>
                                <?php

                                foreach ($clientlist as $client) {
                                    echo '<option value="' . $client->name . '" id="' . $client->id . '">' . $client->name . '</option>';
                                }
                                ?>

                            </select>
                        </div>
                        <div class="form-group col-md-4" >
                            <label class="control-label">Shipper Name</label>
                            <input maxlength="100" type="text" required="required" id="shippername" value="<?php echo $values[0]->Shipper; ?>" class="form-control" placeholder="Enter shipper Name" />
                            <input maxlength="100" type="hidden" required="required" id="shipperid" value="<?php echo $values[0]->consignor_id; ?>" class="form-control" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Consignee Name</label>
                            <input maxlength="100" type="text" required="required" id="consigneename" value="<?php echo $values[0]->Consignee; ?>" class="form-control" placeholder="Enter Consignee Name" />
                            <input maxlength="100" type="hidden" required="required" id="consignor_id" value="<?php echo $values[0]->consignee_id; ?>" class="form-control" />
                        </div>
                       
                    </div>
                    <!-- <div class=" row">
                        <div class="form-group col-md-4">
                            <label for="exampleInputname1">Type</label>
                            <select class="form-control" name="shipment_type" id="shipment_type" value="--Select Type--">
                                <option value="">--Select Type--</option>
                                <option value="Import">Import</option>
                                <option value="Export">Export</option>
                            </select>
                        </div> -->
                    <!-- <div class="form-group col-md-4">
                            <label class="control-label">Shippment Terms</label>
                            <input maxlength="100" type="text" id="Shipment_Terms" value="<?php echo $values[0]->ShipmentTerms; ?>" required="required" class="form-control" placeholder="shipment terms" />
                        </div>
                    </div> -->
                    <div class=" row" id="airsection">
                        <!-- <div class="form-group col-md-4">
                            <label class="control-label"> Cargo Description</label>
                            <input maxlength="100" type="text" id="cargo_description" value="<?php echo $values[0]->CargoDescription; ?>" required="required" class="form-control" placeholder="Cargo Description" />
                        </div> -->
                        <div class="form-group col-md-4">
                            <label class="control-label">Origin</label>
                            <input maxlength="100" type="text" id="origin_air" required="required" value="<?php echo $values[0]->Origin; ?>" class="form-control" placeholder="Origin " />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Destination</label>
                            <input maxlength="100" type="text" id="destination_air" value="<?php echo $values[0]->Destination; ?>" required="required" class="form-control" placeholder=" Destination" />
                        </div>

                        <div class="form-group col-md-4">
                            <label class="control-label " for="date">ETD</label>
                            <input class="form-control etd_air" id="etd_air" value="<?php echo $values[0]->Etd; ?>" name="date" placeholder="MM/DD/YYY" type="text" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label" for="date">ETA</label>
                            <input class="form-control eta_air" id="eta_air" value="<?php echo $values[0]->Eta; ?>" name="date" placeholder="MM/DD/YYY" type="text" />
                        </div>
                        <div class="form-group col-md-4" >
                            <label class="control-label">Carrier</label>
                            <!-- <input maxlength="100" type="text"  id="Carrier_air" required="required" class="form-control" placeholder=" Carrier" /> -->
                            <select class="form-control " name="Carrier_air" id="Carrier_air" value="--Select Type--">
                                <option value="select">--Select Type--</option>
                              
                              <?php

                                foreach ($carrierlist as $carrier) {
                                    if ($carrier->carrier_type == "Air") {
                                        echo '<option code="' . $carrier->code . '" value="' . $carrier->name . '" id="' . $carrier->id . '">' . $carrier->name  . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                     
                        <div class="form-group col-md-4">
                            <label class="control-label">PO no. </label>
                            <input maxlength="100" type="text" id="PoNo_air" value="<?php echo $values[0]->PoNo; ?>" required="required" class="form-control" placeholder=" PO no." />
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                         
                                    <input maxlength="100" type="hidden" id="Mawb_code_hidden" required="required" class="form-control mawbcarrier" id="mawbcarrier" placeholder="enter serial number"  value="<?php echo $values[0]->Mawb; ?>"  />            
                                                
                                <div class="form-group col-md-4">
                                    <label class="control-label">MAWB </label>
                                    <input maxlength="100" type="text" id="Mawb_air1" readonly="readonly" required="required" class="form-control mawbcarrier" id="mawbcarrier" placeholder="prefix code"  />
                                </div>
                                <div class="form-group col-md-8">
                                    <label class="control-label"> &nbsp;</label><span id='mawbmsg'></span>
                                    
                                    <input maxlength="8" type="text" id="Mawb_code" required="required" class="form-control mawbcarrier" id="mawbcarrier" placeholder="enter serial number"  onblur="checkmawb1();" />                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4" style="display:none;">
                            <label class="control-label"> HAWB</label>
                            <input maxlength="100" type="text" id="Hawb" value="<?php echo $values[0]->Hawb; ?>" required="required" class="form-control" placeholder=" HAWB" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label"> No_pcs</label>
                            <input maxlength="100" type="text" id="Nopcs_air" required="required" value="<?php echo $values[0]->Nopcs; ?>" class="form-control" placeholder=" No_pcs" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Actual Weight </label>
                            <input maxlength="100" type="text" id="ActualWeight_air" required="required" value="<?php echo $values[0]->ActualWeight; ?>" class="form-control" placeholder="Actual Weight" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Chargeable Weight </label>
                            <input maxlength="100" type="text" id="ChargeableWeight_air" required="required" value="<?php echo $values[0]->ChargeableWeight; ?>" class="form-control" placeholder="Chargeable Weight " />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Dimension</label>
                            <input maxlength="100" type="text" id="Dimension" required="required" value="<?php echo $values[0]->Dimension; ?>" class="form-control" placeholder="Dimension" />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputname1">IncoTerms</label>
                            <select class="form-control" id="incoterms" name="incoterms" value="--Select Type--">
                                <option value="<?php echo $values[0]->ShipmentTerms; ?>"><?php echo $values[0]->ShipmentTerms; ?></option>
                                <?php
                                $incoterm = array("CIF-(Cost, Insurance and Freight)", "CIP-(Carriage and Insurance Paid)", "CFR-(Cost and Freight)", "CPT-(Carriage Paid To)", "DAT-(Delivered At Terminal)", "DAP-(Delivered at Place)", "DDP-(Delivered Duty Paid)", "EXW-(ExWorks)", "FAS-(Free Alongside Ship)", "FCA-(Free Carrier)", "FOB-(Free On Board)");
                                foreach ($incoterm as $val) {
                                    if ($val != $values[0]->ShipmentTerms) {
                                ?>
                                        <option value="<?php echo $val; ?>"><?php echo $val; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class=" row" id="seasection">
                        <div class="form-group col-md-4">
                            <label class="control-label" for="date">ETD</label>
                            <input class="form-control etd_sea" id="etd_sea" value="<?php echo $values[0]->Etd; ?>" name="date" placeholder="MM/DD/YYY" type="text" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label" for="date">ETA</label>
                            <input class="form-control eta_sea" id="eta_sea" value="<?php echo $values[0]->Eta; ?>" name="date" placeholder="MM/DD/YYY" type="text" />
                        </div>
                        <div class="form-group col-md-4" id="Fclexport">
                            <label class="control-label">Carrier</label>
                            <!-- <input maxlength="100" type="text" id="Carrier_sea" required="required" class="form-control" placeholder=" Carrier" /> -->
                            <select class="form-control" name="Carrier_sea" id="Carrier_sea" value="--Select Type--">
                                <option value="select">--Select Type--</option>
                                <?php

                                foreach ($carrierlist as $carrier) {
                                    if ($carrier->carrier_type == "Sea") {
                                        echo '<option value="' . $carrier->name . '" id="' . $carrier->id . '">' . $carrier->name  . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <!-- <div class="form-group col-md-4" id="Fclimport">
                            <label class="control-label">Carrier</label>
                            <select class="form-control" name="Carrier_sea" id="Carrier_sea" value="--Select Type--">
                                <option value="select">--Select Type--</option>
                                <?php

                                foreach ($carrierlist as $carrier) {
                                    if ($carrier->carrier_type == "Fclimport") {
                                        echo '<option value="' . $carrier->name . '" id="' . $carrier->id . '">' . $carrier->name . '&nbsp;' . $carrier->code . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div> -->
                        <!-- <div class="form-group col-md-4" id="Lclexport">
                            <label class="control-label">Carrier</label>
                            <select class="form-control" name="Carrier_sea" id="Carrier_sea" value="--Select Type--">
                                <option value="select">--Select Type--</option>
                                <?php

                                foreach ($carrierlist as $carrier) {
                                    if ($carrier->carrier_type == "Lclexport") {
                                        echo '<option value="' . $carrier->name . '" id="' . $carrier->id . '">' . $carrier->name . '&nbsp;' . $carrier->code . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div> -->
                        <!-- <div class="form-group col-md-4" id="Lclimport">
                            <label class="control-label">Carrier</label>
                            <select class="form-control" name="Carrier_sea" id="Carrier_sea" value="--Select Type--">
                                <option value="select">--Select Type--</option>
                                <?php

                                foreach ($carrierlist as $carrier) {
                                    if ($carrier->carrier_type == "Lclimport") {
                                        echo '<option value="' . $carrier->name . '" id="' . $carrier->id . '">' .  $carrier->name . '</option>';
                                    } 
                                }
                                ?>
                            </select>
                        </div> -->
                        <div class="form-group col-md-4" style="display:none;">
                            <label class="control-label">PO no. </label>
                            <input maxlength="100" type="text" id="PoNo_sea" value="<?php echo $values[0]->PoNo; ?>" required="required" class="form-control" placeholder=" PO no." />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label"> POL </label>
                            <input maxlength="100" type="text" id="Pol" value="<?php echo $values[0]->Pol; ?>" required="required" class="form-control" placeholder="POL" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">POD</label>
                            <input maxlength="100" type="text" id="Pod" value="<?php echo $values[0]->Pod; ?>" required="required" class="form-control" placeholder="POD " />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">MBL</label>
                            <input maxlength="100" type="text" id="Mbl_sea" value="<?php echo $values[0]->Mbl; ?>" required="required" class="form-control" placeholder=" MBL" />
                        </div>

                        <div class="form-group col-md-4">
                            <label class="control-label">HBL </label>
                            <input maxlength="100" type="text" id="Hbl" value="<?php echo $values[0]->Hbl; ?>" required="required" class="form-control" placeholder=" HBL" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label"> Cont.type</label>
                            <input maxlength="100" type="text" id="ContType" value="<?php echo $values[0]->ContType; ?>" required="required" class="form-control" placeholder=" cont. type" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label"> No_Containers</label>
                            <input min="1" max="100" type="text" id="NoContainers" value="<?php echo $values[0]->NoContainers; ?>" required="required" class="form-control" placeholder=" No_containers" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Containers_no. </label>
                            <input maxlength="100" type="text" id="ContainerNo" value="<?php echo $values[0]->ContainerNo; ?>" required="required" class="form-control" placeholder="containers number" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Actual Weight </label>
                            <input maxlength="100" type="text" id="ActualWeight_sea" value="<?php echo $values[0]->ActualWeight; ?>" required="required" class="form-control" placeholder=" Weight " />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputname1">IncoTerms</label>
                            <select class="form-control" id="incotermssea" name="incotermssea" value="--Select Type--">
                                <option value="<?php echo $values[0]->ShipmentTerms; ?>"><?php echo $values[0]->ShipmentTerms; ?></option>
                                <?php
                                $incoterm = array("CIF-(Cost, Insurance and Freight)", "CIP-(Carriage and Insurance Paid)", "CFR-(Cost and Freight)", "CPT-(Carriage Paid To)", "DAT-(Delivered At Terminal)", "DAP-(Delivered at Place)", "DDP-(Delivered Duty Paid)", "EXW-(ExWorks)", "FAS-(Free Alongside Ship)", "FCA-(Free Carrier)", "FOB-(Free On Board)");
                                foreach ($incoterm as $val) {
                                    if ($val != $values[0]->ShipmentTerms) {
                                ?>
                                        <option value="<?php echo $val; ?>"><?php echo $val; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div><br>
                    <div class=" row" id="transportationsection">
                        <div class="form-group col-md-4">
                            <label class="control-label">Origin</label>
                            <input maxlength="100" type="text" id="Origin_transport" value="<?php echo $values[0]->Origin; ?>" required="required" class="form-control" placeholder=" origin" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Destination</label>
                            <input maxlength="100" type="text" id="Destination_transport" value="<?php echo $values[0]->Destination; ?>" required="required" class="form-control" placeholder=" destination" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label" for="date">ETD</label>
                            <input class="form-control etd_transport" id="etd_transport" value="<?php echo $values[0]->Etd; ?>" name="date" placeholder="MM/DD/YYY" type="text" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label" for="date">ETA</label>
                            <input class="form-control eta_transport" id="eta_transport" value="<?php echo $values[0]->Eta; ?>" name="date" placeholder="MM/DD/YYY" type="text" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Carrier</label>
                            <!-- <input maxlength="100" type="text" id="Carrier_transport"  required="required" class="form-control" placeholder=" Carrier" /> -->
                            <select class="form-control" name="Carrier_transport" id="Carrier_transport" value="--Select Type--">
                                <option value="select">--Select Type--</option>
                                <?php

                                foreach ($carrierlist as $carrier) {
                                    if ($carrier->carrier_type == "Transportation") {
                                        echo '<option value="' . $carrier->name . '" id="' . $carrier->id . '">' . $carrier->name . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">PO no. </label>
                            <input maxlength="100" type="text" id="PoNo_transport" value="<?php echo $values[0]->PoNo; ?>" required="required" class="form-control" placeholder=" PO no." />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label"> MBL </label>
                            <input maxlength="100" type="text" id="Mbl_transport" value="<?php echo $values[0]->Mbl; ?>" required="required" class="form-control" placeholder="MBL" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">No.pcs</label>
                            <input maxlength="100" type="text" id="Nopcs_transport" value="<?php echo $values[0]->Nopcs; ?>" required="required" class="form-control" placeholder="no-pcs " />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Truck_no</label>
                            <input maxlength="100" type="text" id="TruckNo" required="required" value="<?php echo $values[0]->TruckNo; ?>" class="form-control" placeholder=" truck number" />
                        </div>

                        <div class="form-group col-md-4">
                            <label class="control-label">Actual Weight </label>
                            <input maxlength="100" type="text" id="ActualWeight_transport" value="<?php echo $values[0]->ActualWeight; ?>" required="required" class="form-control" placeholder=" Weight " />
                        </div>

                    </div>
                    <div class=" row" id="landsection">
                        <div class="form-group col-md-4">
                            <label class="control-label">Origin</label>
                            <input maxlength="100" type="text" id="Origin_land" value="<?php echo $values[0]->Origin; ?>" required="required" class="form-control" placeholder=" origin" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Destination</label>
                            <input maxlength="100" type="text" id="Destination_land" required="required" value="<?php echo $values[0]->Destination; ?>" class="form-control" placeholder=" destination" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label" for="date">ETD</label>
                            <input maxlength="100" type="text" id="etd_land" name="date" required="required" value="<?php echo $values[0]->Etd; ?>" class="form-control" placeholder=" ETD" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label" for="date">ETA</label>

                            <input maxlength="100" type="text" id="eta_land" name="date" required="required" value="<?php echo $values[0]->Eta; ?>" class="form-control" placeholder=" ETA" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Truck Type</label>
                          
                            <select class="form-control" name="Carrier_land" id="Carrier_land" value="--Select Type--">
                            <option value="bank">--Select Type--</option>
                                                <?php

                                               foreach ($truck as $truck_name) {
                                                    echo '<option value="' . $truck_name->truck . '" id="' . $truck_name->id . '">' . $truck_name->truck . '</option>';
                                                }
                                                ?>
                            </select>
                        </div>
                      
                        <div class="form-group col-md-4">
                            <label class="control-label">PO no. </label>
                            <input maxlength="100" type="text" id="PoNo_land" value="<?php echo $values[0]->PoNo; ?>" required="required" class="form-control" placeholder=" PO no." />
                        </div>
                  
                        <div class="form-group col-md-4">
                            <label class="control-label">No_pcs</label>
                            <input maxlength="100" type="text" id="Nopcs_land" required="required" value="<?php echo $values[0]->Nopcs; ?>" class="form-control" placeholder="no_pcs " />
                        </div>

                        <div class="form-group col-md-4">
                            <label class="control-label">Chargeable Weight </label>
                            <input maxlength="100" type="text" id="ChargeableWeight_land" value="<?php echo $values[0]->ChargeableWeight; ?>" required="required" class="form-control" placeholder=" Weight " />
                        </div>
                    <!-- </div> -->
                    <!-- <div class=" row"> -->

                        <div class="form-group col-md-4">
                            <label class="control-label">BAYAN No.</label>
                            <input maxlength="100" type="text" id="BayanNo" required="required" value="<?php echo $values[0]->BayanNo; ?>" class="form-control" placeholder="BAYAN number" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">BAYAN Date</label>
                            <input class="form-control" id="BayanDate" value="<?php echo $values[0]->BayanDate; ?>" name="date" placeholder="MM/DD/YYY" type="text" />
                        </div>
                    </div>
                        <!-- <div class="form-group col-md-4">

                            <label for="exampleInputname1">Status</label>
                            <select class="form-control" id="Status" name="status" value="--Select Type--">
                                <option value="bank">--Select Type--</option>
                                <option value="OPEN">OPEN</option>
                                <option value="CLOSED">CLOSED</option>
                            </select>
                        </div> -->
                        <!-- <div class="form-group col-md-4">
                            <label class="control-label">Job Status</label>
                            <input maxlength="100" type="text" id="JobStatus" value="<?php echo $values[0]->JobStatus; ?>" required="required" class="form-control" placeholder="job status" />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputname1">POP</label>
                            <select class="form-control" id="PoP" name="pop" value="--Select Type--">
                                <option value="bank">--Select Type--</option>
                                <option value="YES">YES</option>
                                <option value="NO">NO</option>
                            </select>
                        </div> -->
                        <!-- <div class="form-group col-md-4">
                            <label for="exampleInputname1">Lab Undertaking</label>
                            <select class="form-control" id="LabUndertaking" name="lab_understanding" value="--Select Type--">
                                <option value="bank">--Select Type--</option>
                                <option value="YES">YES</option>
                                <option value="NO">NO</option>
                            </select>
                        </div> -->
                        <!-- <div class="form-group col-md-4">
                            <label for="exampleInputname1">Docs Guarantee</label>
                            <select class="form-control" id="DocsGuarantee" name="docs_guarantee" value="--Select Type--">
                                <option value="bank">--Select Type--</option>
                                <option value="YES">YES</option>
                                <option value="NO">NO</option>
                            </select>
                        </div> -->
                        <!-- <div class="form-group col-md-4">
                            <label class="control-label">Description</label>
                            <input maxlength="100" type="text" id="Description" value="<?php echo $values[0]->Description; ?>" required="required" class="form-control" placeholder="description" />
                        </div> -->
                        <!-- <div class="form-group col-md-4">
                            <label for="exampleInputname1">Salesman</label>
                            <select class="form-control" id="salesman" name="salesman" value="">
                                <option value="select">--Select Type--</option>
                                <?php

                                // foreach ($userlist as $user) {
                                //     echo '<option value="' . $user->user_name . '">' . $user->user_name . '</option>';
                                // }
                                ?>

                            </select>
                        </div> -->
<!-- <div class="row">
<?php
if(empty($uploadedfile))
{

}
else{
 foreach($uploadedfile as $val)
                            {
                                ?>
                        <div class="form-group col-md-2">
                           <input type="hidden" value="<?php echo $val->id;?>"/>
                          
                           <object data="<?php echo IMAGE_PATH.$val->file_path;?>"  id="files" height="200px" width="200px" type="application/pdf"> PDF Plugin Not Available </object>

                                <a href='<?= base_url('assets/images/' .$val->file_path); ?>' class='pdf'>View</a>&nbsp;&nbsp;&nbsp;&nbsp;
                              
                                <a onclick="remove_uploadedfile(<?php echo $val->id;?>,this);" class="delete"id="del" >Remove</a>
                             


                            </div>

                        <?php
                            } } ?>                      

                    </div> -->
                    <!-- <div class=" row">
                        <div class="form-group col-md-11">
                            <div id="my-dropzone" class="dropzone">
                                <div class="dz-message">
                                    <h3>Drop files here</h3> or <strong>click</strong> to upload
                                   
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class=" row">

<div class="form-group col-md-4">
<label for="issue_auth" class="col-sm-3 col-form-label">Document Type</label>
            <input type="text" name="doc_type" id="doc_type" class="form-control " value="">
            <span id="doc_type"></span>
</div>
<div class="form-group col-md-4">
<label for="fileupld" class="col-sm-3 col-form-label">Document Upload</label>
        <input type="file" name="fileupld" id="fileupld"  class="form-control " >
        <span id="filedoc"></span>
</div>
<div class="form-group col-md-4" style="margin-top: 44px;">
<input type="button" class="btn btn-primary btn-succes" id="edit_btn_doc"   value="Add More Documents">
</div>
</div>
<div class="row">
   <div class="col-md-12">
   <table class="table">
   <thead>
   <tr>
   <td>Document Type</td>
   <td>Document</td>
   <td>Action</td>
   </tr>
   </thead>
   <tbody class="data-body">
   <?php foreach ($doc as $document) {?>
   <tr>
   
                            <td><?=$document->doc_type ?></td>
                            <td> 
                                 <?php
                           if(pathinfo(base_url("$document->file_path"), PATHINFO_EXTENSION)=="pdf"){
                            echo "<img src='" . base_url()."assets/images/pdf.png"."' width=50px; >";
                           }elseif(pathinfo(base_url("$document->file_path"), PATHINFO_EXTENSION)=="csv"){
                            echo "<img src='" . base_url()."assets/images/excel.png"."' width=50px; >";
                           }elseif(pathinfo(base_url("$document->file_path"), PATHINFO_EXTENSION)=="doc"){
                            echo "<img src='" . base_url()."assets/images/doc.png"."' width=50px; >";
                           }elseif(pathinfo(base_url("$document->file_path"), PATHINFO_EXTENSION)=="docx"){
                            echo "<img src='" . base_url()."assets/images/doc.png"."' width=50px; >";
                           }else{
                            echo "<img src='" . base_url().$document->file_path."' width=50px; >";
                           } ?>
                           </td>
                             <!-- <td><img src="../<?=$document->file_path ?>" style="width:100px;"></td> -->
                           <td><a href="<?php echo base_url("delete-doc/$document->job_id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete?') "><i class="fa fa-remove"></i></a></td>
                             </tr>
                             <?php } ?>
                           </tbody>
   </table>
   </div>
   </div>
   <?php echo form_close() ?> 
      <?php  echo form_open_multipart('controller', array('id' => 'edit_job_doc')); ?>
      <input type="hidden" value="<?php echo $datadoc->JobId;?>" nam="dummyjobid" id="dummyjobid">
      <?php echo form_close() ?> 

      <?php  echo form_open_multipart('controller', array('id' => 'edit_job_doc_up')); ?>
      <input type="hidden" value="" id="hdnidval">
      <?php echo form_close() ?> 
  <?php echo form_close() ?>
                    <button class="btn btn-primary nextBtn pull-right" id="jobsubmit" type="button">Next</button>

                </div>
            </div>
        </div>
        <div class="col-md-11 ">
            <div class="panel panel-primary setup-content " id="step-3">
                <div class="panel-heading">
                    <h3 class="panel-title">Consignment</h3>
                </div>
                <div class="panel-body">
                    <section class="content">

                        <div class="col-md-10">
                            <h4 class="box-title">Job</h4>
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <div class="box-body">

                                      
                                        <div class="form-group col-md-2">
                                            <label class="control-label">Description</label>
                                            <input type="hidden" id="estimate_code" name="code" class="form-control" placeholder="<?php echo $codes[0]->estimate_no+1; ?>" readonly="readonly" value="<?php echo $codes[0]->estimate_no+1; ?>">
                                            <input type="hidden" name="master_id" id="master_id" value="<?php if($estimatedata!=0){echo $estimatedata[0]->estimate_masterid;} else{echo $estmasterid;} ?>" />
                                            <input type="hidden" name="dat" id="dat" value="<?php if($estimatedata!=0){echo $estimatedata[0]->estimate_masterid;} else{echo 0;} ?>" />

                                            <input maxlength="100" type="text" id="description_job" class="form-control" placeholder=" Description" value="" />
                                            <input type="hidden" id="description_id" class="form-control" value="<?php echo $values[0]->JobId; ?>" />
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="control-label">Unit Price</label>
                                            <input maxlength="100" type="text" id="unitprice" class="form-control " placeholder=" unit price" />
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="control-label">Currency</label>
                                            <select class="form-control" id="unit_price" name="unit_price" value="--Select Type--">
                                                <option value="bank">--Select Type--</option>
                                                <?php

                                                foreach ($currencylist as $currency) {
                                                    echo '<option value="' . $currency->currency . '" id="' . $currency->id . '">' . $currency->currency . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="control-label">Conv.Factor</label>
                                            <input maxlength="100" type="text" id="conv_factor" class="form-control " placeholder=" conv.factor" />
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="control-label">Quantity</label>
                                            <input maxlength="100" type="text" id="quantity" class="form-control " placeholder=" quantity" />
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label class="control-label">VAT</label>
                                            <input maxlength="100" type="text" id="vat" class="form-control" placeholder=" vat" />
                                        </div>
                                        <br>
                                        <input type="submit" name="add" value="ADD" id="add" class="btn btn-success" style="float: right;">
                                        <br>
                                    </div>
                                    <div class="col-md-12">
                                        <div>
                                            <!-- /.box-header -->
                                            <div class="">
                                                <div id="ContentPlaceHolder1_upDataList">

                                                    <table id="datatable" class="table table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Description</th>
                                                                <th>UnitPrice</th>
                                                                <th>Quantity</th>
                                                                <th>SubTotal</th>
                                                                <th>VAT</th>
                                                                <th>TOTAL</th>
                                                      </tr>
                                                        </thead>
                                                        <tbody class="dataadd">
                                                            <?php
                                                            if($estimate!=0){

                                                          
                                                             foreach ($estimate as $key => $value1) {
                                                            ?>
                                                                <tr>
                                                                    <td class="job_desc"><?php echo $value1->description; ?> </td>
                                                                    <td class="job_price"><?php echo $value1->unitprice; ?></td>
                                                                    <td class="job_price"><?php echo $value1->quantity; ?></td>
                                                                    <td class='subtotalval_data'><?php echo ($value1->subtotal) * ($value1->conv_factor); ?></td>
                                                                    <td class="taxval_data"><?php echo $value1->vat; ?> </td>
                                                                    <td class="totalval_data"><?php echo $value1->total; ?></td>
                                                                    <td>
                                                                        <a class="" onclick="deletedids(<?php echo $value1->estimate_details_id; ?>,this)"><i class="fa fa-trash-o"></i></a>
                                                                        <input type="hidden" class="currency" value="<?php echo $value1->unit_type; ?>" />
                                                                        <input type='hidden' class="cov_factor" value="<?php echo $value1->conv_factor; ?>" />
                                                                        <input type='hidden' class="credit_detail_id" value="<?php echo $value1->estimate_details_id; ?>" />

                                                                    </td>
                                                                </tr>

                                                            <?php  }   }?>
                                                        </tbody>
                                                        <tfoot>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                                <div id="ContentPlaceHolder1_upTotals">
                                                    <div style="float: right;">
                                                        <span id="ContentPlaceHolder1_lbl">TOTAL</span>
                                                        <input name="total" type="text" value="<?php if($estimatedata!=0){echo $estimatedata[0]->total_amount; }?>" readonly="readonly" id="total" class="form-control " style="width: 100%;">
                                                        <span id="ContentPlaceHolder1_Label1">Vat Total</span>
                                                        <input name="vat_total" type="text" value="<?php if($estimatedata!=0){ echo $estimatedata[0]->tax_amount;} ?>" readonly="readonly" id="vat_total" class="form-control " style="width: 100%;">
                                                        <span id="ContentPlaceHolder1_Label2">Grand Total</span>
                                                        <input name="grand_total" type="text" value="<?php if($estimatedata!=0){ echo $estimatedata[0]->grand_total;} ?>" readonly="readonly" id="grand_total" class="form-control " style="width: 100%;">
                                                    </div>
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                            <!-- /.box -->

                                        </div>
                                    </div>
                                    <input type="submit" name="submit" onclick="update_estimate();" value="Submit" id="submit"  style="float: right; margin-top:50px;" class="btn btn-success">

                                </div>

                            </div>
                        </div>

                        <div class="col-md-2">
                            <h4 class="box-title">Job Description </h4>
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                </div>
                                <div class="box-body">
                                    <strong><i class=""></i> Job</strong>
                                    <p class="text-dark" id="job_code">
                                        <?php if($values[0]->Number!=0){echo $values[0]->Jobcode;} ?>
                                    </p>
                                    <hr>
                                    <strong><i class=""></i> Shipper</strong>
                                    <p class="text-dark" id="shipper_name"> <?php if($consignordata!=0){ echo $consignordata[0]->consignor;} ?></p>
                                    </p>
                                    <hr>
 
                                    <strong><i class=""></i> Consignee</strong>
                                    <p class="text-dark" id="consignee_name"> <?php if($consigneedata!=0){ echo $consigneedata[0]->consigni;} ?> </p>
                               
                                    <hr>
                                    <strong><i class=""></i> Client Company</strong>
                                    <p class="text-dark" id="company_name"><?php if($clientdata!=0){ echo $clientdata[0]->clientenglish;} ?></p>
                                    <hr>
                                    <strong><i class=""></i> Shipment Terms</strong>
                                    <p class="text-dark" id="shpmnt_terms"> <?php if($estimatedata!=0){ echo $estimatedata[0]->ShipmentTerms; }?></p>
                                    <hr>
                                    <strong><i class=""></i> Consignment description</strong>
                                    <p class="text-dark" id="consign_desc"> <?php if($estimatedata!=0){ echo $estimatedata[0]->CargoDescription; }?></p>

                                </div>

                            </div>
                        </div>
                        <input type="submit" name="next" style="margin-top:90px;"  onclick="showalertbox1();" value="Finish!" id="next" class="btn btn-primary nextBtn pull-right" >
                        
                        
                  
                </div>
            </div>
        </div>


    </form>
</div>


<script src="<?php echo base_url(); ?>/assets/js/moment.js"></script>
<script src="<?php echo base_url(); ?>/assets/user_scripts/transaction/edit_job.js"></script>
<!-- <script src="<?php echo base_url(); ?>/assets/user_scripts/transaction/plannes_script.js"></script> -->
<script src="<?php echo base_url(); ?>/assets/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#jobsubmit').click(function() {
            update();
            // jobdetails();
        });
    });
    // $(document).ready(function() {
    //     // $('#ContainerNo').tagsinput('add', 'some tag');
    //     $('#ContainerNo').tagsinput({
    //         allowDuplicates: true
    //     });
    // });
    $(document).ready(function() {
   

   $('#ContainerNo').tagsinput({
     freeInput: true
   });
   // alert();
   $('#ContainerNo').on('beforeItemAdd', function(event) {
     // event.cancel: set to true to prevent the item getting added
     event.cancel = !(/^([a-zA-Z]{4})+([0-9]{7})+$/.test(event.item));
   });
   });

    function joblisthome() {
        window.location = 'list-job';
    }

    //hide all div
    function hideall() {
        $('#airsection').addClass("hidden");
        $('#seasection').addClass("hidden");
        $('#transportationsection').addClass("hidden");
        $('#landsection').addClass("hidden");
        //     $('#othersection').addClass("hidden");
        $('#landsummary').addClass("hidden");
        $('#seasummary').addClass("hidden");
        $('#airsummary').addClass("hidden");
        $('#othersummary').addClass("hidden");
    }
</script>
<script>
    //date picker
    $(document).ready(function() {
        var date_input = $('input[name="date"]'); //our date input has the name "date"
        var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
        var options = {
            format: 'mm/dd/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
        };
        date_input.datepicker(options);



    })
</script>
<script type="text/javascript">
    $(document).ready(function() {


        var obj = [];
        $.ajax({
            url: "<?php echo base_url(); ?>transaction/Transaction/getshipperdata",
            type: 'post',
            dataType: "json",
            success: function(data) {
                console.log(data);
                obj = data;
                $('#shippername').autocomplete({
                    source: obj,
                    select: function(event, ui) {
                        $("#shippername").val(ui.item.label);
                        $("#shipperid").val(ui.item.value);
                        return false;

                    }
                });
            }
        });

        //var obj=[{"value":1,"label":'anu'},{"value":2,"label":'rejina'}];

    });
</script>

<script type="text/javascript">
    $(document).ready(function() {


        var obj = [];
        $.ajax({
            url: "<?php echo base_url(); ?>transaction/Transaction/getdescriptiondata",
            type: 'post',
            dataType: "json",
            success: function(data) {
                //  console.log(data);
                obj = data;
                $('#description_job').autocomplete({
                    source: obj,
                    select: function(event, ui) {
                        $("#description_job").val(ui.item.label);
                        $("#description_id").val(ui.item.value);
                        return false;

                    }
                });
            }
        });

        //var obj=[{"value":1,"label":'anu'},{"value":2,"label":'rejina'}];

    });
</script>
<script type="text/javascript">
    //autocomplete textbox
    $(document).ready(function() {
        var data =$('#Mawb_code_hidden').val();
var arr = data.split('-');

$("#Mawb_air").val(arr[0]);	  

$("#Mawb_code").val(arr[1]);	  

var obj = [];
        $.ajax({
            url: "<?php echo base_url(); ?>transaction/Transaction/getconsigneedata",
            type: 'post',
            dataType: "json",
            success: function(data) {
                console.log(data);
                obj = data;
                $('#consigneename').autocomplete({
                    source: obj,
                    select: function(event, ui) {
                        $("#consigneename").val(ui.item.label);
                        $("#consignor_id").val(ui.item.value);
                        return false;

                    }
                });
            }
        });





    });

    $(function() {

        $("#add").click(function() {

            if ($('#unitprice,#unit_price,#conv_factor,#quantity,#vat').val() == '') {
                alert('Insert all fields');
            } else {
                insertRow();
            }
        });

    });
    $(document).on("click", '.rmvbutton', function() {

        $(this).closest("tr").remove();
        calculates();
        return false;
    });

    function insertRow() {

        var descID = 0;
        var desc = $("#description_job").val();
        var price = parseFloat($("#unitprice").val());
        var price1 = parseFloat($("#unitprice").val());
        var conv_factor = parseFloat($("#conv_factor").val());
        var price = price * conv_factor;

        var quantity = parseFloat($("#quantity").val());
        var vatAmount = parseFloat($("#vat").val());
        var SubTotal = quantity * price;
        var taxvalue = ((SubTotal * vatAmount) / 100);
        var total = SubTotal + taxvalue;
        var unit_val = $("#unit_price").val();
        var desc_id = $("#description_id").val();

        $(".dataadd").append("<tr class='estmt_details'><td class='desc'>" + desc + " </td> <td class='price_val'>" + price1 + "</td> <td class='quanty'>" + quantity + "</td> <td class='subtotalval_data'>" + SubTotal + "</td> <td class='taxval_data'>" + taxvalue + "</td>  <td class='totalval_data'>" + total + "</td> <td class='hidden unittype'>" + unit_val + "</td><td class='hidden convfact'>" + conv_factor + "</td><td class='hidden desc_id'>" + desc_id + "</td><td><a class='rmvbutton'><i class='fa fa-trash-o'></i></a></td>  </tr>");

        calculates();

  
// TO CLAR Text ARea and text box
        /*Clear textarea using id */
				$('#step-3 #description_job').val('');
        $('#step-3 #unitprice').val('');
        $('#step-3 #conv_factor').val('1');
				$('#step-3 #quantity').val('1');
        $('#step-3 #vat').val('0');
    }

    //total

    function calculates() {
        var totsub_val = 0;
        $(".subtotalval_data").each(function(td) {
            var s = parseFloat($(this).html());
            totsub_val = parseFloat(totsub_val) + s;
        });

        var taxval_data_val = 0;
        $(".taxval_data").each(function(td) {
            var s = parseFloat($(this).html());
            taxval_data_val = parseFloat(taxval_data_val) + s;
        });

        var totalval_data_val = 0;
        $(".totalval_data").each(function(td) {
            var s = parseFloat($(this).html());
            totalval_data_val = parseFloat(totalval_data_val) + s;
        });


        $("#total").val(totsub_val.toFixed(2));

        $("#vat_total").val(taxval_data_val.toFixed(2));
        $("#grand_total").val(totalval_data_val.toFixed(2));


    }
    $("#client_name").val("<?php echo  $values[0]->client_name; ?>");
    $("#shipment_type").val("<?php echo  $values[0]->shipment_type; ?>");
    $("#Carrier_air").val("<?php echo  $values[0]->Carrier; ?>");
    $("#Carrier_sea").val("<?php echo  $values[0]->Carrier; ?>");
    $("#Carrier_transport").val("<?php echo  $values[0]->Carrier; ?>");
    $("#Carrier_land").val("<?php echo  $values[0]->Carrier; ?>");
    $("#Status").val("<?php echo  $values[0]->Status; ?>");
    $("#PoP").val("<?php echo  $values[0]->PoP; ?>");
    $("#LabUndertaking").val("<?php echo  $values[0]->LabUndertaking; ?>");
    $("#DocsGuarantee").val("<?php echo  $values[0]->DocsGuarantee; ?>");
    $("#salesman").val("<?php echo  $values[0]->salesman; ?>");
    var jobtype = $("#type").val();
    if (jobtype == "airexport" || jobtype == "airimport") {

        hideall();

        $('#airsection').removeClass("hidden");
        $('#airsummary').removeClass("hidden");
      
    } else if (jobtype == "fclexport" || jobtype == "fclimport" || jobtype == "lclexport" || jobtype == "lclimport") {
        hideall();

        $('#seasection').removeClass("hidden");
        $('#seasummary').removeClass("hidden");
        if(jobtype == "fclexport")
        {
            $('#Fclimport').addClass("hidden");
            $('#Lclexport').addClass("hidden");
            $('#Lclimport').addClass("hidden");
        }
        else if(jobtype == "fclimport")
        {
            $('#Fclexport').addClass("hidden");
            $('#Lclexport').addClass("hidden");
            $('#Lclimport').addClass("hidden");
        }
        else if(jobtype == "lclexport")
        {
            $('#Fclexport').addClass("hidden");
            $('#Lclimport').addClass("hidden");
            $('#Fclimport').addClass("hidden");
        }
        else{
            $('#Fclexport').addClass("hidden");
            $('#Lclexport').addClass("hidden");
            $('#Fclimport').addClass("hidden");
        }
    } else if (jobtype == "transportation") {
        hideall();

        $('#transportationsection').removeClass("hidden");
        $('#othersummary').removeClass("hidden");
    } else if (jobtype == "landexport" || jobtype == "landimport") {
        hideall();

        $('#landsection').removeClass("hidden");
        $('#landsummary').removeClass("hidden");

    }
    Changepanel();
    $('#step-2').removeClass("hidden");
    $('.vzbtn2').addClass("btn-success");
</script>
<!-- To upload filesize -->
<script>

    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#my-dropzone", {
        url: "<?php echo base_url("images-upload/") ?>"+$('#id').val(),
        acceptedFiles: "image/*,application/pdf",
        addRemoveLinks: true,
        success: function(file, response) {
            if (response == 1) {
                document.getElementById("jobsubmit").style.display = "block";
            }
        },
        removedfile: function(file) {
            var name = file.name;
            var extension = name.split('.').pop();
            $.ajax({
                type: "post",
                url: "<?php echo base_url("images-remove") ?>",
                data: { file: name,extension:extension},
                    dataType: 'html'
              
            });

            var previewElement;
            return (previewElement = file.previewElement) != null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
        },
    
    });
    function remove_uploadedfile(id,el)
    {
       var id=id;
      


$(el).parent().remove();
    // alert(id);
  var request = $.ajax({
    url: '../remove_uploadedfile/'+id,
    type: 'GET',
    dataType: 'JSON'
    });
    request.done( function (result) {
       
      console.log(result);
   
    });
    $(el).parent().remove();
  
    }
</script>


<script type="text/javascript">
    
    function showalertbox1() {
        var number = $("#code").val();
        // alert(number);
        swallokalert('Job Number '+number+'  Updated Successfully!!','<?php echo base_url()?>transaction/Transaction/job_transactionlist');

   
    }
</script>

<script type="text/javascript">
    
    function checkmawb1() {
        // alert("kdjfkjf");
        var number = $("#Mawb_code").val();
       var length= number.toString().length;
        // swallokalert('Job Number '+number+'  Created Successfully!!','');
if(length!=8)
{
  
    document.getElementById('mawbmsg').style.color = 'red';
      document.getElementById('mawbmsg').innerHTML = '8 numbers required';
}
        // swallokalert('Job Number '+number+'  Created Successfully!!','');
        else
{
  
      document.getElementById('mawbmsg').innerHTML = "";
}
   
   
    }

</script>
<script>
    $('#edit_job_doc').on('submit', function(e){ 
        
        var dummyid=$("#dummyjobid").val();
      
        var type=$("#doc_type").val();
        var file_data = $('#fileupld').prop('files')[0];
    //    alert(type);
      
          var formdata = new FormData(this);
          formdata.append("job_id", dummyid);
          formdata.append("doc_type", type);
          formdata.append("fileupld", file_data);
          
          e.preventDefault();
               
                    $.ajax({  
                         url: '<?php echo base_url("create-job-doc-ajax") ?>', 
                         method:"POST",  
                         fileElementId:'fileupld',
                         data:formdata,  
                         contentType: false,  
                         cache: false,  
                         processData:false,  
                         success:function(data)  
                         {  
                            
                            console.log(data);
      
                            //    var base_url= "<?php echo base_url(); ?>";
                              var extension = get_url_extension(data.replace(" ", "_"));
                              var url = '<?php echo base_url(); ?>application/assets/images/'+data.replace(" ", "_");
                           
                              if(extension=="pdf"){
                                url = '<?php echo base_url(); ?>/assets/images/pdf.png';
                              }else if(extension=="csv"){
                                url = '<?php echo base_url(); ?>/assets/images/excel.png';
                              }else if(extension=="doc"){
                                url = '<?php echo base_url(); ?>/assets/images/doc.png';
                              }else if(extension=="docx"){
                                url = '<?php echo base_url(); ?>/assets/images/doc.png';
                              }
                             $(".data-body").append('<tr><td>'+type+'</td><td><img src="'+url+'" style="width:100px;"></td> </tr>');
                             $("#doc_type").val('');
                             $('#fileupld').val('');
                         }
                    });  
        });
</script>
