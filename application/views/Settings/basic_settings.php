
<section class="content-header">
            <h1>
            Edit Basic Settings
            </h1>
          
          </section>
          <section class="content">
          <div class="box box-success">
          <div class="box-body" style="min-height:600px;">
          <form role="form" method="post" action="<?php echo base_url();?>update-basic-settings" enctype="multipart/form-data">
        
          <div class="col-md-12">
               <h4 class="box-title">Basic company settings</h4>
               <div class="box box-primary">
                  <div class="box-header with-border">
                     <div class="box-body">
                        <div class="row">  

                    <div class="form-group col-md-6 ">
                    <label for="exampleInputname1">Company Name</label>
                      <input type="text" id="name" required name="name" class="form-control" id="name" value="<?php echo $basicinfo[0]->Cmpny_name;?>" >
                      <input type="hidden" name="id" id="id"  value="<?php echo $basicinfo[0]->Id;?>" >
                      <input type="hidden" name="invid" id="invid"  value="<?php echo $invinfo[0]->Id;?>" >

                    </div>
                    <div class="form-group col-md-6 ">
                    <label for="exampleInputEmail1">Address</label>
                      <textarea   required name="address" class="form-control" id="address"  ><?php echo $basicinfo[0]->Address;?></textarea>
                    </div>
                    <div class="form-group col-md-6 ">
                    <label for="exampleInputEmail1">Phone</label>
                      <input type="text"  required name="phno" class="form-control" id="phno" value="<?php echo $basicinfo[0]->Phone;?>" >
                    </div>
                    <div class="form-group col-md-6 ">
                    <label for="exampleInputEmail1">FAX</label>
                      <input type="text"  required name="fax" class="form-control" id="fax" value="<?php echo $basicinfo[0]->FAX;?>" >
                    </div>
                    <div class="form-group col-md-6 ">
                    <label for="exampleInputEmail1">VAT</label>
                      <input type="text"  required name="vat" class="form-control" id="vat" value="<?php echo $basicinfo[0]->VAT;?>" >
                    </div>
                    <div class="form-group col-md-6 ">
                    <label for="exampleInputEmail1">CR</label>
                      <input type="text"  required name="cr" class="form-control" id="cr" value="<?php echo $basicinfo[0]->CR;?>" >
                    </div>
                    <div class="form-group col-md-6 ">
                    <label for="exampleInputEmail1">Email</label>
                      <input type="email"  required name="email" class="form-control" id="email" value="<?php echo $basicinfo[0]->Email;?>" >
                    </div>
                  
                    <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Web</label>
                      <input type="text" required id="web" name="web" class="form-control"  value="<?php echo $basicinfo[0]->Web;?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputFile">Company logo</label>
                  
                  <input type="file" id="iconimage" name="iconimage" class="form-control" >
                  <?php 
                   if($basicinfo[0]->Icon_image!=''){ 
                       ?>
                      <img src="<?php echo IMAGE_PATH.$basicinfo[0]->Icon_image; ?>"  width="150px"; height="150px";/>
                         <?php
                         }
                        
                         ?>  
                         
                  <input type="hidden" id="imageval" name="imageval" value="<?php echo $basicinfo[0]->Icon_image;?>"/>
                   </div>
                 
                
                   
                       <?php
                    //  } else {
                          ?>
                        
                       
                       <?php
                    //     }
                    // } }
                     ?>
                     
               
</div><!-- /.box-body -->
                    </div>

                    </div> 
                     </div>    </div>  
                    <div class="col-md-12">
               <h4 class="box-title">Invoice Settings</h4>
               <div class="box box-primary">
                  <div class="box-header with-border">
                     <div class="box-body">
                        <div class="row">  

                        <div class="form-group col-md-6">
                      <label for="exampleInputFile">Header Image</label>
                  
                  <input type="file" id="headerimage" name="headerimage" class="form-control" >
                  <?php 
                   if($invinfo[0]->Invheaderimage!=''){ 
                       ?>
                      <img src="<?php echo IMAGE_PATH.$invinfo[0]->Invheaderimage; ?>"  width="400px"; height="150px";/>
                         <?php
                   }
                        // $headerfilename = $_FILES['headerimage']['name'];
                        ?>  
                        
                 <input type="hidden" id="headerimg" name="headerimg" value="<?php echo $invinfo[0]->Invheaderimage;?>"/>
                  </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputFile">Footer Image</label>
                  
                  <input type="file" id="footerimage" name="footerimage" class="form-control" >
                  <?php 
                   if($invinfo[0]->InvfooterImage!=''){ 
                       ?>
                      <img src="<?php echo IMAGE_PATH.$invinfo[0]->InvfooterImage; ?>"  width="400px"; height="150px";/>
                         <?php
                         }
                      
                        // $footerfilename = $_FILES['footerimage']['name'];
                        ?>  
                        
                 <input type="hidden" id="footerimg" name="footerimg" value="<?php echo $invinfo[0]->InvfooterImage;?>"/>
                  </div>
                    <div class="form-group col-md-6 ">
                    <label for="exampleInputname1">Invoice series</label>
                      <input type="text" id="invseries" required name="invseries" class="form-control"  value="<?php echo $invinfo[0]->Invseries;?>" >
                      <input type="hidden" name="invid" id="invid"  value="<?php echo $invinfo[0]->Id;?>" />
                    
                    </div>
</div><!-- /.box-body -->
                    </div>

                    </div>    </div>   </div>
                
<div class="box-footer  ">
               
                  <button type="submit"  class="btn btn-success"  >Update</button>
                    <button type="reset" class="btn btn-success">Cancel</button>
                  </div>
                </form>
          </div>
</div>
          </section>
        

          <!-- <script src="<?php echo base_url(); ?>/assets/user_scripts/settings/basic_settings.js"></script> -->
