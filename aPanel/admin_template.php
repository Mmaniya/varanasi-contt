<?php 
define('ABSPATH',  dirname(__DIR__, 1));

require ABSPATH . "/includes.php";
if ($_SESSION['useremail'] == '' || $_SESSION['username'] == '') {
    header('location: index.php');
    exit();

}?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Home</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords"
        content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <?php include 'admin_style.php';?>
        <!-- Required Jquery -->
    <script type="text/javascript" src="<?php echo ADMIN_JS ?>/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_JS ?>/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_JS ?>/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_JS ?>/bootstrap/bootstrap.min.js"></script>

</head>

<body>

    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="#">
                            <i class="feather icon-menu"></i>
                        </a>
                        <a href="<?php echo ADMIN_URL ?>/dashboard.php">
                            <!-- <img class="img-fluid" src="<?php echo ADMIN_IMAGES ?>/logo.png" width="190"
                                alt="Theme-Logo"> -->
                                <h3>VARANASI</h3>
                        </a>
                        <a class="mobile-options">
                            <i class="feather icon-more-horizontal"></i>
                        </a>
                    </div>

                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <a href="javascript:void(0);" onclick="javascript:toggleFullScreen()">
                                    <i class="feather icon-maximize full-screen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">         
                            <li class="user-profile header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        <span><?php echo $_SESSION['username'] ?></span>
                                        <i class="fa fa-caret-down"></i>
                                    </div>
                                    <ul class="show-notification profile-notification dropdown-menu"
                                        data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li>
                                            <a href="<?php echo ADMIN_URL ?>/logout.php">
                                                <i class="fa fa-sign-out"></i> Logout
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Sidebar inner chat end-->
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="pcoded-navigatio-lavel">Navigation</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="">
                                    <a href="<?php echo ADMIN_URL ?>/dashboard.php">
                                        <span class="pcoded-micon"><i class="fa fa-tachometer"></i></span>
                                        <span class="pcoded-mtext">Dashboard</span>
                                    </a>
                                </li>
                                <?php if($_SESSION['admin_role'] == 'A' || $_SESSION['admin_role'] == 'SA'){ ?>
                                <li class="">
                                    <a href="<?php echo ADMIN_URL ?>/raw_details.php">
                                        <span class="pcoded-micon"><i class="fa fa-asterisk"></i></span>
                                        <span class="pcoded-mtext">Raw Details</span>
                                    </a>
                                </li>
                                <?php } ?>

                                <?php if($_SESSION['admin_role'] == 'SA'){ ?>
                                <li class="">
                                    <a href="<?php echo BOOTH_DIR ?>/index.php">
                                        <span class="pcoded-micon"><i class="fa fa-id-card-o"></i></span>
                                        <span class="pcoded-mtext">Upload Voter Id</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="<?php echo BOOTH_DIR ?>/update_address.php">
                                        <span class="pcoded-micon"><i class="fa fa-id-card-o"></i></span>
                                        <span class="pcoded-mtext">Upload Voter Address</span>
                                    </a>
                                </li>
                                <?php } ?>

                                <?php if($_SESSION['admin_role'] == 'A' || $_SESSION['admin_role'] == 'SA'){ ?>
                                <li class="">
                                    <a href="<?php echo USERS_DIR ?>/index.php">
                                        <span class="pcoded-micon"><i class="fa fa-users"></i></span>
                                        <span class="pcoded-mtext">Users</span>
                                    </a>
                                </li>
                                <?php } ?>
                  
                                <?php // if($_SESSION['admin_role'] == 'DE' || $_SESSION['admin_role'] == 'SA'){ ?>
                                <li class="">
                                    <a href="<?php echo ENTRY_DIR ?>/update_raw_voters.php">
                                        <span class="pcoded-micon"><i class="fa fa-hand-o-right"></i></span>
                                        <span class="pcoded-mtext"> Entry Details </span>
                                    </a>
                                </li>
                                <?php // } ?>
                            </ul>
                        </div>
                    </nav>
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-body">
                                        <?php main();?>
                                    </div>
                                </div>
                                <div id="styleSelector" style="display:none">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="preloader" style="display:none;">
        <div id="loader"></div>
    </div>
</body>
<?php include 'admin_script.php';?>

</html>