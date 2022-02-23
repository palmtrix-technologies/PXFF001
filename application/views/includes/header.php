<?php

 if($session_data = $this->session->userdata('user_id'))
 {

 }
 else
 {
 redirect('login');
}
// var_dump($values);

// die();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Vision Dispatch For shipping Est</title>
     <link rel = "icon" href = "<?php echo IMAGE_PATH.$cmpnydata[0]->Icon_image;?> "width="30px" height="30px"> 
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url(); ?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>/assets/css/create_user.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>/assets/css/wizard.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>/assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>/assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>/assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>/assets/plugins/iCheck/all.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>/assets/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>/assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
   <!-- //accounts -->
   
  
    <!-- <script src="<?php echo base_url(); ?>/assets/user_scripts/accounts/ledger_group.js"></script>
    <script src="<?php echo base_url(); ?>/assets/user_scripts/accounts/ledger.js"></script>
    <script src="<?php echo base_url(); ?>/assets/user_scripts/accounts/accounts_entry.js"></script>
    <script src="<?php echo base_url(); ?>/assets/user_scripts/accounts/day_book.js"></script>
    <script src="<?php echo base_url(); ?>/assets/user_scripts/accounts/accounts_entry.js"></script> -->
    <!-- jQuery 2.1.3 -->
      <script src="<?php echo base_url(); ?>/assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
        <script src="<?php echo base_url(); ?>/assets/js/radio_button.js"></script>
         <script src="<?php echo base_url(); ?>/assets/user_scripts/usermanagement/user_script.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js" type="text/javascript"></script>
    
    <!-- <link href="http://aot.ferryfolks.com//assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" /> -->
     <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <!-- <script src="http://aot.ferryfolks.com//assets/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script> -->
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js" type="text/javascript"></script>
   <!--print page-->
       
   <script>
    function swallokalert(tittle,url)
    {
    var data=url;
              Swal.fire({
                
            icon: 'success',
            text: tittle,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
          }).then((result) => {
            if (result.value) {
              window.location.replace(data);
            }
          })

    }
    </script>
<style>
.swal2-content {
    font-size: 2.125em!important;}

.img-responsive{
border: 1px solid #ddd;
border-radius: 4px;
padding: 5px;
width: 200px;
height: 200px;
}

</style>
  </head>
  <body class="skin-blue">
    <!-- Site wrapper -->
    <div class="wrapper">
    

      <header class="main-header">
        <a href="<?php echo base_url(); ?>user-home" class="logo"> <img src="<?php echo IMAGE_PATH;?>1585740654iconimage.png" class="img-circle" alt="logo" width="30px" height="30px"/>
<b>FERRY FOLKS</b></a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success">4</span>
                </a> -->
                <ul class="dropdown-menu">
                  <!-- <li class="header">You have 4 messages</li> -->
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- start message -->
                        <a href="#">
                          <div class="pull-left">
                            <img src="<?php echo base_url(); ?>/assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
                          </div>
                          <!-- <h4>
                            Support Team
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                          </h4> -->
                          <!-- <p>Why not buy a new awesome theme?</p> -->
                        </a>
                      </li><!-- end message -->
                    </ul>
                  </li>
                  <!-- <li class="footer"><a href="#">See All Messages</a></li> -->
                </ul>
              </li>
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">10</span>
                </a> -->
                <ul class="dropdown-menu">
                  <!-- <li class="header">You have 10 notifications</li>
                  <li> -->
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li>
                        <!-- <a href="#">
                          <i class="fa fa-users text-aqua"></i> 5 new members joined today
                        </a> -->
                      </li>
                    </ul>
                  </li>
                  <!-- <li class="footer"><a href="#">View all</a></li> -->
                </ul>
              </li>
              <!-- Tasks: style can be found in dropdown.less -->
              <li class="dropdown tasks-menu">
                <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>
                  <span class="label label-danger">9</span>
                </a> -->
                <ul class="dropdown-menu">
                  <!-- <li class="header">You have 9 tasks</li> -->
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- Task item -->
                        <!-- <a href="#">
                          <h3>
                            Design some buttons
                            <small class="pull-right">20%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">20% Complete</span>
                            </div>
                          </div>
                        </a> -->
                      </li><!-- end task item -->
                    </ul>
                  </li>
                  <li class="footer">
                    <a href="#">View all tasks</a>
                  </li>
                </ul>
              </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo IMAGE_PATH.$values; ?>"  class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?php echo $this->session->userdata('user_name'); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo IMAGE_PATH.$values; ?>" class="img-circle" alt="User Image" />
                    <p>
                     <?php echo $this->session->userdata('user_name'); ?>
                      <small></small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="<?php echo base_url(); ?>users">Users</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="<?php echo base_url(); ?>roles">Roles</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="<?php echo base_url(); ?>permission">Permission</a>
                    </div>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url('login')?>" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
    
  