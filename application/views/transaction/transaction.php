<script src="<?php echo base_url(); ?>/assets/plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/bootstrap-tagsinput.min.js"></script>
<!-- <link rel="stylesheet" href="../css/bootstrap-tagsinput.css"> -->
<!-- <script src="<?php echo base_url(); ?>assets/js/dropzone.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dropzone.min.css"> -->

<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />


<?php 
   // var_dump($currency);
  
   // die();
   $month = date('m');
   $day = date('d');
   $year = date('Y');
   
   $today = $year . '-' . $month . '-' . $day;
   ?>
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

    .
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

    <form role="form">
        <div class="col-md-11 ">
            <div class="panel panel-primary setup-content" id="step-1">
                <div class="panel-heading">
                    <h3 class="panel-title">Shipper</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <b>
                            <h4> &nbsp; &nbsp; Which type of shipment would you like to create ?</h4>
                        </b><br>
                        &nbsp; &nbsp; &nbsp; &nbsp;
                        <div class="row">
                            <div class="form-group col-md-3">
                                <button class="btn btn-info nextBtn pull-right trans-type  " id="air" type="button" value="Air" style="width:180px; height:50px;"><i class="text-blue fa fa-plane"></i> Air Export</button>

                            </div>
                            <div class="form-group col-md-3">
                                <button class="btn btn-primary nextBtn pull-right trans-type " id="airimport" type="button" value="AirImport" style="width:180px; height:50px;"> <i class="text-blue fa fa-plane"></i> Air Import</button>

                            </div>
                            <div class="form-group col-md-3">
                                <button class="btn btn-info nextBtn pull-right trans-type " id="sea" type="button" value="FCLExport" style="width:180px; height:50px;"><i class="text-black fa fa-ship"></i> FCL Export</button>

                            </div>
                            <div class="form-group col-md-3">
                                <button class="btn btn-primary nextBtn pull-right trans-type" id="fclimport" type="button" value="FCLImport" style="width:180px; height:50px;"><i class="text-black fa fa-ship"></i> FCL Import</button>

                            </div>
                            <div class="form-group col-md-3">
                                <button class="btn btn-primary nextBtn pull-right trans-type" id="lclexport" type="button" value="LCLExport" style="width:180px; height:50px;"><i class="text-white fa fa-ship"></i> LCL Export</button>

                            </div>
                            <div class="form-group col-md-3">
                                <button class="btn btn-info nextBtn pull-right trans-type " id="lclimport" type="button" value="LCLImport" style="width:180px; height:50px;"> <i class="text-white fa fa-ship"></i> LCL Import</button>

                            </div>
                            <div class="form-group col-md-3">
                                <button class="btn btn-primary nextBtn pull-right trans-type " id="land" type="button" value="LandExport" style="width:180px; height:50px;"> <i class="text-red fa fa-truck"></i> Land Export</button>

                            </div>
                            <div class="form-group col-md-3">
                                <button class="btn btn-info nextBtn pull-right trans-type " id="landimport" type="button" value="LandImport" style="width:180px; height:50px;"><i class="text-red fa fa-truck"></i> Land Import</button>
                            </div>
                            <div class="form-group col-md-3">
                                <button class="btn btn-info nextBtn pull-right trans-type " id="transportation" type="button" value="Other" style="width:180px; height:50px;"><i class="text-yellow fa fa-train"></i>Transportation</button>


                            </div>
                            <!-- <div class="form-group col-md-3">
                                <button class="btn btn-danger nextBtn pull-right trans-type " id="clearanceanddelivery" type="button" value="Clearance And Delivery" style="width:180px; height:50px;"><i class=""></i>Clearance&Delivery</button>


                            </div> -->
                        </div>
                    </div>
                </div>
                <!-- <button class="btn btn-primary nextBtn pull-right" type="button">Next</button> -->
            </div>
        </div>
    </form>
        <!-- port details -->
        <div class="col-md-11 ">
            <div class="panel panel-primary setup-content" id="step-2">
                <div class="panel-heading">
                    <h3 class="panel-title">Job Detials</h3>
                </div>
                <div class="panel-body">
                    <div class=" row">
                        <div class="form-group  col-md-3">
                            <!-- value="<?php echo $values[0]->JobId; ?> -->
                            <label class="control-label ">Number</label>
                            <input type="hidden" name="id" id="id" />
                            <input type="hidden" name="type" id="type" value="" />
                       
                            <input type="text" id="code" name="code" class="form-control" placeholder="<?php  echo $code[0]->Number + 1;  ?>" readonly="readonly" value="<?php  echo $code[0]->Number + 1;  ?>">
                        </div>
                        <div class="form-group col-md-3">


<label class="control-label" for="date">Date</label>
<input class="form-control" id="date" name="date" placeholder="" type="text"   value="<?php echo $today; ?>" />
</div>
                    </div>
                    <div class=" row">
                        <div class="form-group col-md-4">
                            <label class="control-label">Shipper Name</label>
                            <input maxlength="100" type="text" required="required" id="shippername" class="form-control" placeholder="Enter shipper Name" />
                            <input maxlength="100" type="hidden" required="required" id="shipperid" class="form-control" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Consignee Name</label>
                            <input maxlength="100" type="text" required="required" id="consigneename" class="form-control" placeholder="Enter Consignee Name" />
                            <input maxlength="100" type="hidden" required="required" id="consignor_id" class="form-control" />
                        </div>
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
                    </div>
                    <div class=" row">
                       
                    </div>
                    <div class=" row" id="airsection">
                        <!-- <div class="form-group col-md-4">
                            <label class="control-label"> Cargo Description</label>
                            <select class="form-control" id="cargo_description" name="cargodescription" value="">
                                <option value="">--Select Type--</option>
                                <?php

                                foreach ($desclist as $desc) { {
                                        echo '<option code="' . $desc->code . '" value="' . $desc->description . '" id="' . $desc->id . '">' . $desc->description . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div> -->
                        <div class="form-group col-md-4">
                            <label class="control-label">Origin</label>
                            <input maxlength="100" autocomplete="off" type="text" id="origin_air" required="required" class="form-control" placeholder="Origin " />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Destination</label>
                            <input maxlength="100" autocomplete="off" type="text" id="destination_air" required="required" class="form-control" placeholder=" Destination" />
                        </div>

                        <div class="form-group col-md-4">
                            <label class="control-label " for="date">ETD</label>
                            <input class="form-control etd_air" autocomplete="off" id="etd_air" name="date" placeholder="MM/DD/YYY" type="text" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label" for="date">ETA</label>
                            <input class="form-control eta_air" autocomplete="off" id="eta_air" name="date" placeholder="MM/DD/YYY" type="text" />
                        </div>
                        <div class="form-group col-md-4" id="Airexport" name="Airexport">
                            <label class="control-label">Carrier</label>
                            <!-- <input maxlength="100" type="text"  id="Carrier_air" required="required" class="form-control" placeholder=" Carrier" /> -->
                            <select class="form-control " name="Carrier_air" id="Carrier_air" value="">
                                <option value="select">--Select Type--</option>
                              
                              <?php

                                foreach ($carrierlist as $carrier) {
                                    if ($carrier->carrier_type == "Air") {
                                        echo '<option code="' . $carrier->code . '" value="' . $carrier->name . '" id="' . $carrier->id . '">' . $carrier->name . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <!-- <div class="form-group col-md-4" id="Airimport" name="Airimport">
                            <label class="control-label">Carrier</label>
                            <select class="form-control " name="Carrier_air_imp" id="Carrier_air_imp" value="">
                                <option value="select">--Select Type--</option>
                              
                              <?php

                                foreach ($carrierlist as $carrier) {
                                    if ($carrier->carrier_type == "Air") {
                                        echo '<option code="' . $carrier->code . '" value="' . $carrier->name . '" id="' . $carrier->id . '">' . $carrier->name .  '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div> -->
                
                        <div class="form-group col-md-4">
                            <label class="control-label">PO No. </label>
                            <input maxlength="100" type="text" autocomplete="off" id="PoNo_air" required="required" class="form-control" placeholder=" PO No." />
                        </div>
                        <div class="col-md-4">
                            <div class="row">

                                <div class="form-group col-md-4">
                                    <label class="control-label">MAWB </label>
                                    <input  type="text" autocomplete="off" id="Mawb_air" readonly="readonly" required="required" class="form-control mawbcarrier" id="mawbcarrier" placeholder="prefix code"  />
                                </div>
                                <div class="form-group col-md-8">
                                    <label class="control-label"> &nbsp;</label><span id='mawbmsg'></span>
                                    <input maxlength="8" type="text" id="Mawb_code" required="required" class="form-control mawbcarrier" id="mawbcarrier" placeholder="enter serial number"  onblur="checkmawb();" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label"> HAWB</label>
                            <input maxlength="100" type="text" id="Hawb" autocomplete="off" required="required" class="form-control" placeholder=" HAWB" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label"> No_pcs</label>
                            <input maxlength="100" type="text" id="Nopcs_air" autocomplete="off" required="required" class="form-control" placeholder=" No_pcs" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Actual Weight </label>
                            <input maxlength="100" type="text" id="ActualWeight_air" autocomplete="off" required="required" class="form-control" placeholder="Actual Weight" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Chargeable Weight </label>
                            <input maxlength="100" type="text" id="ChargeableWeight_air" autocomplete="off" required="required" class="form-control" placeholder="Chargeable Weight " />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Dimension</label>
                            <input maxlength="100" type="text" id="Dimension" autocomplete="off" required="required" class="form-control" placeholder="Dimension" />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputname1">IncoTerms</label>
                            <select class="form-control" id="incoterms" name="incoterms" value="--Select Type--">
                                <option value="">--Select Type--</option>
                                <option value="CIF-(Cost, Insurance and Freight)">CIF-(Cost, Insurance and Freight)</option>
                                <option value="CIP-(Carriage and Insurance Paid)">CIP-(Carriage and Insurance Paid)</option>
                                <option value="CFR-(Cost and Freight)">CFR-(Cost and Freight)</option>
                                <option value="CPT-(Carriage Paid To)">CPT-(Carriage Paid To)</option>
                                <option value="DAT-(Delivered At Terminal)">DAT-(Delivered At Terminal)</option>
                                <option value="DAP-(Delivered at Place)">DAP-(Delivered at Place)</option>
                                <option value="DDP-(Delivered Duty Paid)">DDP-(Delivered Duty Paid)</option>
                                <option value="EXW-(ExWorks)">EXW-(ExWorks)</option>
                                <option value="FAS-(Free Alongside Ship)">FAS-(Free Alongside Ship)</option>
                                <option value="FCA-(Free Carrier)">FCA-(Free Carrier)</option>
                                <option value="FOB-(Free On Board)">FOB-(Free On Board)</option>

                            </select>
                        </div>
                    </div>
                    <div class=" row" id="seasection">
                        <div class="form-group col-md-4">
                            <label class="control-label" for="date">ETD</label>
                            <input class="form-control etd_sea" id="etd_sea" name="date" autocomplete="off" placeholder="MM/DD/YYY" type="text" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label" for="date">ETA</label>
                            <input class="form-control eta_sea" id="eta_sea" name="date" autocomplete="off" placeholder="MM/DD/YYY" type="text" />
                        </div>
                        <div class="form-group col-md-4" id="Fclexport">
                            <label class="control-label">Carrier</label>
                            <!-- <input maxlength="100" type="text" id="Carrier_sea" required="required" class="form-control" placeholder=" Carrier" /> -->
                            <select class="form-control" name="Carrier_sea" id="Carrier_sea" value="--Select Type--">
                                <option value="select">--Select Type--</option>
                                <?php

                                foreach ($carrierlist as $carrier) {
                                    if ($carrier->carrier_type == "Sea") {
                                        echo '<option value="' . $carrier->name . '" id="' . $carrier->id . '">' . $carrier->name .  '</option>';
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
                                    if ($carrier->carrier_type == "Sea") {
                                        echo '<option value="' . $carrier->name . '" id="' . $carrier->id . '">' . $carrier->name .  '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div> -->
                        <!-- <div class="form-group col-md-4" id="Sea">
                            <label class="control-label">Carrier</label>
                            <select class="form-control" name="Carrier_sea" id="Carrier_sea" value="--Select Type--">
                                <option value="select">--Select Type--</option>
                                <?php

                                foreach ($carrierlist as $carrier) {
                                    if ($carrier->carrier_type == "Sea") {
                                        echo '<option value="' . $carrier->name . '" id="' . $carrier->id . '">' . $carrier->name . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div> -->
                        <!-- <div class="form-group col-md-4" id="Sea">
                            <label class="control-label">Carrier</label>
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
                        </div> -->
                        <div class="form-group col-md-4">
                            <label class="control-label">PO No. </label>
                            <input maxlength="100" type="text" id="PoNo_sea" autocomplete="off" required="required" class="form-control" placeholder=" PO No." />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label"> POL </label>
                            <input maxlength="100" type="text" id="Pol" autocomplete="off" required="required" class="form-control" placeholder="POL" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">POD</label>
                            <input maxlength="100" type="text" id="Pod" autocomplete="off" required="required" class="form-control" placeholder="POD " />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">MBL</label>
                            <input maxlength="100" type="text" id="Mbl_sea" autocomplete="off" required="required" class="form-control" placeholder=" MBL" />
                        </div>

                        <div class="form-group col-md-4">
                            <label class="control-label">HBL </label>
                            <input maxlength="100" type="text" id="Hbl" autocomplete="off" required="required" class="form-control" placeholder=" HBL" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label"> Cont.type</label>
                            <input maxlength="100" type="text" id="ContType" autocomplete="off" required="required" class="form-control" placeholder=" cont. type" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label"> No_Containers</label>
                            <input min="1" max="100" type="number" id="NoContainers" autocomplete="off" required="required" class="form-control" placeholder=" Number of containers" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Containers_no. </label>
                            <input type="text" value=""  data-role="tagsinput" autocomplete="off" id="ContainerNo" class="form-control">
                        </div>
                        <!-- <div class="form-group col-md-4">
                            <label class="control-label">Containers_no. </label>
                            <input maxlength="100" type="text" id="ContainerNo" required="required" class="form-control" placeholder="containers number" />
                        </div> -->
                        <div class="form-group col-md-4">
                            <label class="control-label">Actual Weight </label>
                            <input maxlength="100" type="text" id="ActualWeight_sea" autocomplete="off" required="required" class="form-control" placeholder=" Weight " />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputname1">IncoTerms</label>
                            <select class="form-control" id="incotermssea" name="incotermssea" value="--Select Type--">
                                <option value="">--Select Type--</option>
                                <option value="CIF-(Cost, Insurance and Freight)">CIF-(Cost, Insurance and Freight)</option>
                                <option value="CIP-(Carriage and Insurance Paid)">CIP-(Carriage and Insurance Paid)</option>
                                <option value="CFR-(Cost and Freight)">CFR-(Cost and Freight)</option>
                                <option value="CPT-(Carriage Paid To)">CPT-(Carriage Paid To)</option>
                                <option value="DAT-(Delivered At Terminal)">DAT-(Delivered At Terminal)</option>
                                <option value="DAP-(Delivered at Place)">DAP-(Delivered at Place)</option>
                                <option value="DDP-(Delivered Duty Paid)">DDP-(Delivered Duty Paid)</option>
                                <option value="EXW-(ExWorks)">EXW-(ExWorks)</option>
                                <option value="FAS-(Free Alongside Ship)">FAS-(Free Alongside Ship)</option>
                                <option value="FCA-(Free Carrier)">FCA-(Free Carrier)</option>
                                <option value="FOB-(Free On Board)">FOB-(Free On Board)</option>

                            </select>
                        </div>
                    </div><br>
                    <div class=" row" id="transportationsection">
                        <div class="form-group col-md-4">
                            <label class="control-label">Origin</label>
                            <input maxlength="100" type="text" id="Origin_transport" autocomplete="off" required="required" class="form-control" placeholder=" origin" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Destination</label>
                            <input maxlength="100" type="text" id="Destination_transport" autocomplete="off" required="required" class="form-control" placeholder=" destination" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label" for="date">ETD</label>
                            <input class="form-control etd_transport" id="etd_transport" autocomplete="off" name="date" placeholder="MM/DD/YYY" type="text" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label" for="date">ETA</label>
                            <input class="form-control eta_transport" id="eta_transport" autocomplete="off" name="date" placeholder="MM/DD/YYY" type="text" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Carrier</label>
                            <!-- <input maxlength="100" type="text" id="Carrier_transport"  required="required" class="form-control" placeholder=" Carrier" /> -->
                            <select class="form-control" name="Carrier_transport" id="Carrier_transport" value="--Select Type--">
                                <option value="select">--Select Type--</option>
                                <?php

                                foreach ($carrierlist as $carrier) {
                                    if ($carrier->carrier_type == "Transportation") {
                                        echo '<option value="' . $carrier->name . '" id="' . $carrier->id . '">' . $carrier->name .  '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">PO No. </label>
                            <input maxlength="100" type="text" id="PoNo_transport" autocomplete="off" required="required" class="form-control" placeholder=" PO No." />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label"> Delivery Note </label>
                            <input maxlength="100" type="text" id="Mbl_transport" autocomplete="off" required="required" class="form-control" placeholder="delivery note" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">No.pcs</label>
                            <input maxlength="100" type="text" id="Nopcs_transport" autocomplete="off" required="required" class="form-control" placeholder="no-pcs " />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Truck_no</label>
                            <input maxlength="100" type="text" id="TruckNo" autocomplete="off" required="required" class="form-control" placeholder=" truck number" />
                        </div>

                        <div class="form-group col-md-4">
                            <label class="control-label">Actual Weight </label>
                            <input maxlength="100" type="text" id="ActualWeight_transport" autocomplete="off" required="required" class="form-control" placeholder=" Weight " />
                        </div>

                    </div>
                    <div class=" row" id="landsection">
                        <div class="form-group col-md-4">
                            <label class="control-label">Origin</label>
                            <input maxlength="100" type="text" id="Origin_land" autocomplete="off" required="required" class="form-control" placeholder=" origin" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Destination</label>
                            <input maxlength="100" type="text" id="Destination_land" autocomplete="off" required="required" class="form-control" placeholder=" destination" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label" for="date">ETD</label>
                            <input maxlength="100" type="text" id="etd_land" name="date" autocomplete="off"  required="required" class="form-control" placeholder=" ETD" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label" for="date">ETA</label>

                            <input maxlength="100" type="text" id="eta_land" name="date" autocomplete="off" required="required" class="form-control" placeholder=" ETA" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Truck Type</label>
                            <!-- <select class="form-control" name="Carrier_land" id="Carrier_land" value="--Select Type--">
                                <option value="">--Select Type--</option>
                                <option value="Pickup">Pickup</option>
                                <option value="Tractor">Tractor</option>
                                <option value="Van">Van</option>
                                <option value="Trailer">Tractor-trailer</option>
                                <option value="Tanker">Tanker</option>
                                <option value="more">Add More</option>

                            </select> -->
                            <select class="form-control" name="Carrier_land" id="Carrier_land" value="--Select Type--">
                      <option value="">--Select Type--</option>
                      <?php

foreach ($truck as $truck_name) {
    echo '<option value="' . $truck_name->truck . '" id="' . $truck_name->id . '">' . $truck_name->truck . '</option>';
}
?>
                   
                      </select>
                        </div>
                        <!-- <div class="form-group col-md-4 truck hidden">
                            <label class="control-label">New Truck</label>
                            <input  type="text" name="truck" id="truck" autocomplete="off" class="form-control" placeholder="Add New Truck" />
                        </div> -->
                        <!-- <div class="col-md-4">
                            <div class="row"> -->

                                <!-- <div class="form-group col-md-4">
                                    <label class="control-label">MAWB </label>
                                    <input maxlength="100" type="text" id="Mawb_land" autocomplete="off" readonly="readonly" required="required" class="form-control mawbcarrier" id="mawbcarrier" placeholder="prefix code" />
                                </div> -->
                                <!-- <div class="form-group col-md-8">
                                    <label class="control-label"> &nbsp;</label><span id='mawbmsgcarrier'></span>
                                    <input maxlength="100" type="text" autocomplete="off" id="Mawbland_code" required="required" class="form-control mawbcarrier" id="mawbcarrier" placeholder="enter serial number" onblur="checkemawbcarrier();" />
                                </div> -->
                            <!-- </div>
                        </div> -->
                        <div class="form-group col-md-4">
                            <label class="control-label">PO No. </label>
                            <input maxlength="100" type="text" id="PoNo_land" autocomplete="off" required="required" class="form-control" placeholder=" PO No." />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">No_pcs</label>
                            <input maxlength="100" type="text" id="Nopcs_land" autocomplete="off" required="required" class="form-control" placeholder="no_pcs " />
                        </div>

                        <div class="form-group col-md-4">
                            <label class="control-label">Chargeable Weight </label>
                            <input maxlength="100" type="text" id="ChargeableWeight_land" autocomplete="off" required="required" class="form-control" placeholder=" Weight " />
                        </div>
                    </div>
                    <div class=" row">

                        <div class="form-group col-md-4">
                            <label class="control-label">BAYAN No.</label>
                            <input maxlength="100" type="text" id="BayanNo" autocomplete="off" required="required" class="form-control" placeholder="BAYAN number" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">BAYAN Date</label>
                            <input class="form-control" id="BayanDate" name="date" autocomplete="off" placeholder="MM/DD/YYY" type="text" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Remarks</label>
                            <input maxlength="100" type="text" id="Description" autocomplete="off" required="required" class="form-control" placeholder="consignment description" />
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
                            <input maxlength="100" type="text" id="JobStatus" required="required" class="form-control" placeholder="job status" />
                        </div> -->
                    <!-- <div class="form-group col-md-4">
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
                            <label for="exampleInputname1"> Upload Files</label>
                            <input  type="file" id="filesupload" name="filesupload" required="required" class="form-control"  />

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
                        <input type="button" class="btn btn-primary btn-succes" id="btn_doc"   value="Add More Documents">
                        </div>
                    </div>
                    <div class="row">
                           <div class="col-md-12">
                           <table class="table">
                           <thead>
                           <tr>
                           <td>Document Type</td>
                           <td>Document</td>
                           <td></td>
                           </tr>
                           </thead>
                           <tbody class="data-body">
                           </tbody>
                           </table>
                           </div>
                           </div>
                    <button class="btn btn-primary nextBtn pull-right" id="jobsubmit" type="button">Next</button>

                    <?php echo form_close() ?> 
      <?php  echo form_open_multipart('controller', array('id' => 'job_doc')); ?>
      <input type="hidden" value="<?php echo(rand(2000,6000));?>" name="dummyjobid" id="dummyjobid">
      <?php echo form_close() ?> 

      <?php  echo form_open_multipart('controller', array('id' => 'job_doc_up')); ?>
      <input type="hidden" value="" id="hdnidval">
      <?php echo form_close() ?> 
                </div>


            </div>
        </div>
    </form>

<!-- end port details -->
<!-- consignment -->
<div class="col-md-11">
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

                                <!-- <div class="form-group col-md-1"> -->


                                <!-- <label class="control-label">Code</label>
                                            <input maxlength="100" onchange="getdata();" type="text" id="desc_code" class="form-control" placeholder=" code" /> -->
                                <!-- </div> -->
                                <div class="form-group col-md-3">

                                    <label class="control-label">Description</label>
                                    <input maxlength="100" type="text" id="description_job" class="form-control" placeholder=" Description" value="" />
                                    <input type="hidden" id="description_id" class="form-control" value="" />
                                    <input type="hidden" id="estimate_code" name="code" class="form-control" placeholder="<?php echo $codes[0]->estimate_no + 1; ?>" readonly="readonly" value="<?php echo $codes[0]->estimate_no + 1; ?>">

                                </div>
                                <div class="form-group col-md-2">
                                    <label class="control-label">Unit Price</label>
                                    <input maxlength="100" type="text" autocomplete="off" id="unitprice" class="form-control " placeholder=" unit price" />
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
                                    <input maxlength="100" type="text" autocomplete="off" id="conv_factor" class="form-control " placeholder=" conv.factor" />
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="control-label">Quantity</label>
                                    <input maxlength="100" type="text" autocomplete="off" id="quantity" class="form-control " placeholder=" quantity" />
                                </div>
                                <div class="form-group col-md-1">
                                    <label class="control-label">VAT</label>
                                    <input maxlength="100" type="text" id="vat" autocomplete="off" class="form-control" placeholder=" vat" />
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
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="dataadd">

                                                </tbody>
                                                <tfoot>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div id="ContentPlaceHolder1_upTotals">
                                            <div style="float: right;">
                                                <span id="ContentPlaceHolder1_lbl">TOTAL</span>
                                                <input name="total" type="text" value="" readonly="readonly" id="total" class="form-control " style="width: 100%;">
                                                <span id="ContentPlaceHolder1_Label1">Vat Total</span>
                                                <input name="vat_total" type="text" value="" readonly="readonly" id="vat_total" class="form-control " style="width: 100%;">
                                                <span id="ContentPlaceHolder1_Label2">Grand Total</span>
                                                <input name="grand_total" type="text" value="" readonly="readonly" id="grand_total" class="form-control " style="width: 100%;">
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->

                                </div>
                            </div>
                            <input type="submit" name="submit"  style="float: right; margin-top:50px;" onclick="add_estimate();" value="Submit" id="submit" class="btn btn-success" >

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
                            </p>
                            <hr>
                            <strong><i class=""></i> Shipper</strong>
                            <p class="text-dark" id="shipper_name"> </p>
                            <hr>
                            <strong><i class=""></i> Consignee</strong>
                            <p class="text-dark" id="consignee_name"> </p>
                            <hr>
                            <strong><i class=""></i> Client Company</strong>
                            <p class="text-dark" id="company_name"> </p>
                            <hr>
                            <strong><i class=""></i> Shipment Terms</strong>
                            <p class="text-dark" id="shpmnt_terms"> </p>
                            <hr>
                            <strong><i class=""></i> Consignment description</strong>
                            <p class="text-dark" id="consign_desc"> </p>

                        </div>

                    </div>
                </div>

                <input  class="btn btn-primary nextBtn pull-right" type="submit" name="next" style="margin-top:90px;"  onclick="showalertbox();" value="Finish!" id="next" class="btn btn-success" >
            </section>
        </div>
    </div>
</div>

<!-- end of consignment -->

<!-- summary -->

<!-- end summary -->
                                    </div>



<script src="<?php echo base_url(); ?>/assets/js/moment.js"></script>
<script src="<?php echo base_url(); ?>/assets/user_scripts/transaction/job_script.js"></script>
<!-- <script src="<?php echo base_url(); ?>/assets/user_scripts/transaction/plannes_script.js"></script> -->
<script src="<?php echo base_url(); ?>/assets/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
     
        $('#jobsubmit').click(function() {
            update();
            jobdetails();
            $("#job_doc").submit();

        });
    });

//     $(document).ready(function() {
//         $('#ContainerNo').tagsinput('add', 'some tag');
//         $('#ContainerNo').tagsinput({
//             // allowDuplicates: true
//         });
//         $('#ContainerNo').on('beforeItemAdd', function(event) {
//   // check item contents
//   if (!/^([a-zA-Z0-9]{4,7})+$/) {
//     // set to true to prevent the item getting added
//     event.cancel = true;
//   }
// });
//     });
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

    // $(document).ready(function() {
    //     var regex5 = /^([a-zA-Z0-9]{4,7})+$/; // Number
    //     $('#ContainerNo').tagsinput({
    //         allowDuplicates: true,
    //         pattern: regex5
    //     });
    // });

    //show selected div only 
    $(document).ready(function() {
        $('#air').click(function() {
            add("airexport", "Export");
            hideall();

            $('#airsection').removeClass("hidden");
            $('#airsummary').removeClass("hidden");
            // $('#Airimport').addClass("hidden");
            // $('#airexport').addClass("hidden");
            
        });
        $('#airimport').click(function() {
            add("airimport", "Import");
            hideall();

            $('#airsection').removeClass("hidden");
            $('#airsummary').removeClass("hidden");
            // $('#Airexport').addClass("hidden");

        });

        $('#sea').click(function() {
            add("fclexport", "Export");
            hideall();

            $('#seasection').removeClass("hidden");
            $('#seasummary').removeClass("hidden");
            // $('#Fclimport').addClass("hidden");
            // $('#Lclexport').addClass("hidden");
            // $('#Lclimport').addClass("hidden");
        });
        $('#fclimport').click(function() {
            add("fclimport", "Import");
            hideall();
            $('#seasection').removeClass("hidden");
            $('#seasummary').removeClass("hidden");
            // $('#Fclexport').addClass("hidden");
            // $('#Lclexport').addClass("hidden");
            // $('#Lclimport').addClass("hidden");
        });
        $('#lclexport').click(function() {
            add("lclexport", "Export");
            hideall();
            $('#seasection').removeClass("hidden");
            $('#seasummary').removeClass("hidden");
            // $('#Fclexport').addClass("hidden");
            // $('#Lclimport').addClass("hidden");
            // $('#Fclimport').addClass("hidden");
        });
        $('#lclimport').click(function() {
            add("lclimport", "Import");
            hideall();
            $('#seasection').removeClass("hidden");
            $('#seasummary').removeClass("hidden");
            // $('#Fclexport').addClass("hidden");
            // $('#Lclexport').addClass("hidden");
            // $('#Fclimport').addClass("hidden");
        });
        $('#transportation').click(function() {
            add("transportation","Transportation");
            hideall();
            $('#transportationsection').removeClass("hidden");
            $('#othersummary').removeClass("hidden");

        });
        $('#land').click(function() {
            add("landexport", "Export");
            hideall();
            $('#landsection').removeClass("hidden");
            $('#landsummary').removeClass("hidden");

        });
        $('#landimport').click(function() {
            add("landimport", "Import");
            hideall();
            $('#landsection').removeClass("hidden");
            $('#landsummary').removeClass("hidden");

        });
    });

    //hide all div
    function hideall() {
        $('#airsection').addClass("hidden");
        $('#seasection').addClass("hidden");
        $('#landsection').addClass("hidden");
        $('#transportationsection').addClass("hidden");
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
            format: 'yyyy-mm-dd',
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
                //  console.log(data);
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


        var obj = [];
        $.ajax({
            url: "<?php echo base_url(); ?>transaction/Transaction/getconsigneedata",
            type: 'post',
            dataType: "json",
            success: function(data) {
                //  console.log(data);
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

    function joblisthome() {
        window.location = 'list-job';
    }
</script>
<!-- To upload filesize -->
<script>
 
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#my-dropzone", {
        url: "<?php echo base_url("images-upload/"); ?>"+$('#id').val(),
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
                data: {
                    file: name,
                    extension: extension
                },
                dataType: 'html'
            });

            var previewElement;
            return (previewElement = file.previewElement) != null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
        },

    });
</script>



<script type="text/javascript">
    
    function showalertbox() {
        var number = $("#code").val();
        // alert(number);
        swallokalert('Job Number '+number+'  Created Successfully!!','list-job');

   
    }
</script>
<script type="text/javascript">
    
    function checkmawb() {
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
    

    function checkemawbcarrier() {
        var number1 = $("#Mawbland_code").val();
       var length1= number1.toString().length;
        // swallokalert('Job Number '+number+'  Created Successfully!!','');
if(length1!=8)
{
  
    document.getElementById('mawbmsgcarrier').style.color = 'red';
      document.getElementById('mawbmsgcarrier').innerHTML = '8 numbers required';
}
        // swallokalert('Job Number '+number+'  Created Successfully!!','');
        else
{
  
      document.getElementById('mawbmsgcarrier').innerHTML = "";
}
   
   
    }
</script>
<script>
    $(document).ready(function(){ 
  
   //onchange document type start 
   $("#Carrier_land").change(function(){
  
     var value=$("#Carrier_land").val();
    
         if(value=="more")
         {
                 $(".truck").removeClass("hidden");
         }
         else{
           $(".truck").addClass("hidden");
         }
   });
});
</script>
<script>
    $('#job_doc').on('submit', function(e){ 
        
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
                            //  $id=$.trim(data);
                            //  addcategory($id);
                            console.log(data);
      
                            //    var base_url= "<?php echo base_url(); ?>";
                              var extension = get_url_extension(data.replace(" ", "_"));
                              var url = '<?php echo base_url(); ?>/assets/images/'+data.replace(" ", "_");
                           
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

