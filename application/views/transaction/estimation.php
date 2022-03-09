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
  
<div class="">
    <div class=" " id="step-3">
       
        <div class="panel-body">
            <section class="content">

                <div class="col-md-12">
                    <h4 class="box-title">New Estimation</h4>
                    <div class="box box-primary">
                       
                        <div class="form-group col-md-2" style="margin-left: 22px;">
                                    <label class="control-label">Job</label><?php $ab=$this->session->userdata('user_id');?>
                    <input   type="hidden" id="userid"  class="form-control" placeholder="<?php echo $ab;?>"  value="<?php echo $ab; ?>"/>
                                    <select class="form-control" id="jobid" name="jobid" value="--Select Type--">
                                        <option value="bank">--Select Job--</option>
                                        <?php

                                        foreach ($values as $values) {
                                            echo '<option value="' . $values->JobId . '" id="' . $values->JobId . '">' . $values->Jobcode . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div></br></br></br>
                                <div class="box-header with-border">
                            <div class="box-body">

                                
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
                            <input type="submit" name="submit"  style="float: right; margin-top:50px;" onclick="new_estimate();" value="Submit" id="submit" class="btn btn-success" >

                        </div>

                    </div>
                </div>

               

                <!-- <input  class="btn btn-primary nextBtn pull-right" type="submit" name="next" style="margin-top:90px;"  onclick="showalertbox();" value="Finish!" id="next" class="btn btn-success" > -->
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

