<?php 

define('ABSPATH',  dirname(__DIR__, 1));
require ABSPATH . "/includes.php";

if ($_SESSION['useremail'] != '' && $_SESSION['username']) {
    foreach ($_SESSION as $K => $V) {
        unset($_SESSION[$K]);
    }
    session_destroy();
    session_unset();
}?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>MMS - Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="<?php echo ADMIN_IMAGES ?>/favicon.ico" type="image/x-icon">
    <!-- Google font--><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?php echo ADMIN_CSS ?>/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="<?php echo ADMIN_ICON ?>/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="<?php echo ADMIN_ICON ?>/icofont/css/icofont.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?php echo ADMIN_CSS ?>/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ADMIN_CSS ?>/custom.style.css">

</head>

<body class="fix-menu">
    <section class="login-block">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <form class="md-float-material form-material" id="formSignInAdmin" action="javascript:void(0);">
                        <input type="hidden" value="signInAdmin" name="act">
                        <div class="text-center">
                            <img src="<?php echo ADMIN_IMAGES ?>/logo.png" alt="logo.png" width="400">
                        </div>
                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center">Sign In</h3>
                                    </div>
                                </div>
                                <div class="form-group form-primary">
                                    <input type="email" name="username" class="form-control" required="" placeholder="Enter Your Email Address">
                                    <!-- <span class="form-bar"></span> -->
                                    <span class="messages"></span>
                                </div>
                                <div class="form-group form-primary">
                                    <input type="password" name="password" class="form-control" required="" placeholder="Enter Your Password">
                                    <span class="messages"></span>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Sign in</button>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-12">
                                        <div class="forgot-phone text-right f-right">
                                        <a href="javascript:void(0);" onclick="forgetpws_form()" class="text-right f-w-600"> Forgot Password?</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form class="md-float-material form-material" id="formRecoverPws" style="display:none" action="javascript:void(0);">
                        <div class="text-center">
                            <img src="<?php echo ADMIN_IMAGES ?>/logo.png" alt="logo.png" width="400">
                        </div>
                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-left">Recover your password</h3>
                                    </div>
                                </div>
                                <div class="form-group form-primary">
                                    <input type="text" name="emai" class="form-control" required="" placeholder="Enter Your Email Address">
                                    <span class="form-bar"></span>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Reset Password</button>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-12">
                                        <div class="checkbox-fade fade-in-primary d-">

                                        </div>
                                        <div class="forgot-phone text-right f-right">
                                            <!-- <a href="auth-reset-password.htm" class="text-right f-w-600"> Forgot Password?</a> -->
                                            <label>
                                                <span class="text-inverse">Back to<a href="javascript:void(0);" onclick="signin_form()"> <b class="f-w-600">Sign in</b></a></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Required Jquery -->
    <script type="text/javascript" src="<?php echo ADMIN_JS ?>/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_JS ?>/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_JS ?>/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_JS ?>/bootstrap/bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="<?php echo ADMIN_JS ?>/common-pages.js"></script>
     <!-- Custom js -->
     <script type="text/javascript" src="<?php echo ADMIN_JS ?>/custom-script.js"></script>

    <script>
      $("form#formSignInAdmin").submit(function(){
        $('.preloader').show();
            var formData = $('form#formSignInAdmin').serialize();
               ajax({
                  a:"admin_ajax",
                  b:formData,
                  c:function(){},
                  d:function(data){
                    var records = JSON.parse(data);
                    if(records.result == 'Success'){
                        $('.preloader').hide();
                        window.location.href = 'dashboard.php';
                    }
                }
               });
            });
   </script>
    <div class="preloader" style="display:none;">
        <div id="loader"></div>
    </div>
</body>
</html>
