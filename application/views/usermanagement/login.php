
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Freighbrid | Login </title>
    <link rel = "icon" href = "<?php echo IMAGE_PATH.$cmpnydata[0]->Icon_image;?> "width="30px" height="30px"> 
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>/assets/login/img/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/login/css/bootstrap.min.css">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/login/css/fontawesome-all.min.css">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/login/font/flaticon.css">
    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/login/style.css">
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <div id="preloader" class="preloader">
        <div class='inner'>
            <div class='line1'></div>
            <div class='line2'></div>
            <div class='line3'></div>
        </div>
    </div>
    <section class="fxt-template-animation fxt-template-layout31">
        <span class="fxt-shape fxt-animation-active"></span>
        <div class="fxt-content-wrap">
            <div class="fxt-heading-content">
                <div class="fxt-inner-wrap">
                    <div class="fxt-transformY-50 fxt-transition-delay-3" style="font-size: 45px;
    color: #ebebeb;">
    
                        FREIGHBRID LOGISTICS 
                    </div>
                    <div class="fxt-transformY-50 fxt-transition-delay-4">
                        <h1 class="fxt-main-title" style="font-size: 27px;
    ">We're a Digital Agency.</h1>
                    </div>
                    <!-- <div class="fxt-login-option">
                        <ul>
                            <li class="fxt-transformY-50 fxt-transition-delay-6"><a href="#">Sign in with Google</a></li>
                            <li class="fxt-transformY-50 fxt-transition-delay-7"><a href="#">Sign in with Facebook</a></li>
                        </ul>
                    </div> -->
                </div>
            </div>
            <div class="fxt-form-content">
                <div class="fxt-page-switcher">
                    <h2 class="fxt-page-title mr-3">Login</h2>
                    <ul class="fxt-switcher-wrap">
                 <a href="#">
            <img src ="<?php echo IMAGE_PATH.$cmpnydata[0]->Icon_image;?> "width="175px;"></a> 
                  <!--  <a href="login-31.html" class="fxt-logo"><img src="<?php echo base_url(); ?>/assets/login/img/freighbridlogo.png" alt="Logo"></a>-->
                    
                    </ul>
                </div>
                <div class="fxt-main-form">
                    <div class="fxt-inner-wrap">
                    <form action="<?php echo base_url();?>Home" method="post">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="email" id="email" class="form-control" name="Email" placeholder="Email" required="required">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input id="password" type="password" class="form-control" name="Password" placeholder="********" required="required">
                                        <i toggle="#password" class="fa fa-fw fa-eye toggle-password field-icon"></i>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="fxt-checkbox-wrap">
                                            <div class="fxt-checkbox-box mr-3">
                                                <input id="checkbox1" type="checkbox">
                                                <label for="checkbox1" class="ps-4">Keep me logged in</label>
                                            </div>
                                            <a href="forgot-password-31.html" class="fxt-switcher-text">Forgot Password</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <button type="submit" class="fxt-btn-fill">Log in</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                      
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- jquery-->
    <script src="<?php echo base_url(); ?>/assets/login/js/jquery-3.5.0.min.js"></script>
    <!-- Bootstrap js -->
    <script src="<?php echo base_url(); ?>/assets/login/js/bootstrap.min.js"></script>
    <!-- Imagesloaded js -->
    <script src="<?php echo base_url(); ?>/assets/login/js/imagesloaded.pkgd.min.js"></script>
    <!-- Validator js -->
    <script src="<?php echo base_url(); ?>/assets/login/js/validator.min.js"></script>
    <!-- Custom Js -->
    <script src="<?php echo base_url(); ?>/assets/login/js/main.js"></script>

</body>

</html>