
<section class="content-header">
            <h1>
            New User 
            </h1>
 
          </section>
          <section class="content">
          <div class="box box-success ">
          <div class="box-body" style="min-height:500px;">
          <form role="form" method="post" action="<?php echo base_url();?>users-store" enctype="multipart/form-data">
               
                    <div class="form-group col-md-6">
                      <label for="exampleInputname1">Name*</label>
                      <input type="text" id="name" required autocomplete="off" name="name" class="form-control" id="name" placeholder="Enter name" >
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Email*</label> <span id='emailmessage'></span>
                      <input type="email" id="email" autocomplete="off" required name="email" class="form-control"  onblur="checkMailStatus()"  placeholder="Enter email">
                    </div>
                    <div class="form-group col-md-6 ">
                      <label for="exampleInputPassword1">Password*</label>
                      <input type="password" autocomplete="off" required id="password" name="password"  class="form-control"  placeholder="Password">
                    </div>
                    <div class="form-group col-md-6 ">
                      <label for="exampleInputconfirmPassword1">Confirm Password*</label>  <span id='message'></span>
                      <input type="password" autocomplete="off" required id="cpassword" name="cpassword" onkeyup='check();' class="form-control" placeholder="confirm Password">
                    </div>
                    <div class="form-group col-md-6 ">
                      <label>Language*</label>
                      <select class="form-control" name="locale">
                        <option value="english">English</option>
                        <option value="arabic">Arabic</option>
                      </select>
                    </div>
                    <div class="form-group  col-md-6 ">
                      <label for="exampleInputFile">Picture</label>
                      <input type="file" id="image" name="image" required> 
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
		                   <label class="labeltext">Roles</label>
                   </div>
                  <div class="row" style="margin-left: 0px;">

                    <?php foreach($roles as $key=>$val){ ?>
                      <div class="col-md-3 " >
                        <label class="customradio">
                          <span class="radiotextsty"><?php echo $val->name;?></span>
                           <input type="radio"  required name="roles[]" id="roles" value="<?php echo $val->id;?>"/>
                           <span class="checkmark"></span>
                          </label>
                        </div>  
                        <?php } ?>
                    </div>             
                       </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" onclick="swallokalert(tittle,'<?php echo base_url(); ?>users');" class="btn btn-success">Save</button>
                    <button type="reset" class="btn btn-success">Cancel</button>
                  </div>
          </div>
          </section>
          
 
