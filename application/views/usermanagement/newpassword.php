<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Logistics | Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url(); ?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>/assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?php echo base_url(); ?>/assets/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>LOGISTICS</b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
          
<?php echo @$error; ?>
        <p class="login-box-msg">Enter new Password</p>
        <form action="<?php echo base_url();?>new-password" method="post">
         
          <div class="row">
          
          <div class="form-group has-feedback">
            <input type="password" class="form-control" required name="randomkey" placeholder="Enter random number"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
            <div class="form-group has-feedback">
            <input type="password" class="form-control" required name="newpassword" placeholder="new password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" required name="confirmpassword" placeholder="confirm password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
            <div class="col-xs-4">
              <button type="submit"  name="forgot_pass"  class="btn btn-primary btn-block btn-flat">Create</button>
            </div><!-- /.col -->
          </div>
        </form>

        

       

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    <script src="<?php echo base_url(); ?>/assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url(); ?>/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>/assets/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>