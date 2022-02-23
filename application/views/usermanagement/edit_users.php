
<section class="content-header">
            <h1>
            Edit User
            </h1>
          
          </section>
          <section class="content">
          <div class="box box-success">
          <div class="box-body" style="min-height:600px;">
          <form role="form"method="post" action="<?php echo base_url();?>users-update" enctype="multipart/form-data">
                         
                    <div class="form-group col-md-6 ">
                    <label for="exampleInputname1">Name*</label>
                      <input type="text" id="name"  autocomplete="off"required name="name" class="form-control" id="name" value="<?php  echo $values[0]->user_name;?>">
                      <input type="hidden" name="id" id="id"  value="<?php  echo $values[0]->id;?>" />
                    
                    </div>
                    <div class="form-group col-md-6 ">
                    <label for="exampleInputEmail1">Email*</label>
                      <input type="email"  required name="email" autocomplete="off" class="form-control" id="email" value="<?php  echo $values[0]->email;?>" >
                    </div>
                    <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Password*</label>
                      <input type="text" required id="password" autocomplete="off" name="password" class="form-control"  value="<?php  echo $values[0]->password;?>">
                    </div>
                    <div class="form-group col-md-6 ">
                      <label>Language*</label>
                      <select class="form-control" name="locale">
                      <option selected="selected" value="<?php  echo $values[0]->locale;?>"><?php  echo $values[0]->locale;?></option>
                     <?php if($values[0]->locale!="english"){ ?>  <option value="english">English</option><?php } ?> 
                     <?php if($values[0]->locale!="arabic"){ ?>  <option value="arabic">Arabic</option><?php } ?> 

                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputFile">Picture</label>
                  
                  <input type="file" id="image" name="image" class="form-control" >
                  <?php  if($values[0]->user_image!=''){ ?>  <img src="<?php echo IMAGE_PATH.$values[0]->user_image; ?>"  class="img-responsive"/>   <?php }?>  
                  <input type="hidden" id="imageval" name="imageval" value="<?php  echo $values[0]->user_image; ?>"/>
                   </div>
                 
                  <div class="form-group col-md-12">
                    <label for="exampleInputFile" required >Roles*</label></div>
                    <?php 
                  foreach($roles as $key=>$val)
                  {
                    foreach($selected as $value)
                    {
                      if($val->id==$value->role_id){ ?>
                     <div class="col-md-3 " >
                        <label class="customradio">
                          <span class="radiotextsty"><?php echo $val->name;?></span>
                           <input type="radio" checked required name="roles[]" id="roles" value="<?php echo $val->id;?>"/>
                           <span class="checkmark"></span>
                          </label>
                        </div>  
                    <!-- <div class="checkbox form-group col-md-3 " >
                        
                        <label>
                          <input type="radio" checked  name="roles[]"  id="roles" value="<?php echo $val->id;?>"/>
                          <?php echo $val->name;?>
                       
                        </label>
                      </div> -->
                       <?php } else { ?>
                        <div class="col-md-3 " >
                        <label class="customradio">
                          <span class="radiotextsty"><?php echo $val->name;?></span>
                           <input type="radio"  required name="roles[]" id="roles" value="<?php echo $val->id;?>"/>
                           <span class="checkmark"></span>
                          </label>
                        </div>  
                        <!-- <div class="checkbox form-group col-md-3 " >
                        
                        <label>
                          <input type="radio"  name="roles[]"  id="roles" value="<?php echo $val->id;?>"/>
       
                          <?php echo $val->name;?>
                       
                        </label>
                      </div> -->
                       <?php } ?>
                   
                      <?php } } ?>
                    
               
</div><!-- /.box-body -->

<div class="box-footer  ">
               
                  <button type="submit" onclick="setTimeout(userupdate, 3000);" class="btn btn-success" >Update</button>
                    <button type="reset" class="btn btn-success">Cancel</button>
                  </div>
                </form>
         
</div>
          </section>

