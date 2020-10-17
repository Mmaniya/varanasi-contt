<?php  require "includes.php"; 
$categoryObj = new Categories; ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Webzone || Home</title>
    <link rel="icon" href="<?php echo ADMIN_IMAGES ?>/nav.png" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ADMIN_CSS ?>/user-style.css">
</head>

<body>
    <div class="container">
        <div class="profile d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 ">
            <img src="<?php echo ADMIN_IMAGES ?>/mmslogo.png" alt="logo" class="log-img" />
            <a class="btn btn-primary button-5" href="javascrip:void(0);">View Profile</a>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php 
                  $categoryObj->id = $_REQUEST['id'];   
                  $rsService = $categoryObj->category_service_data();

                  $categoryObj->id = $rsService->category_id; 
                  $rsCategory = $categoryObj->get_category_details();
                ?>
                <div class="row" id="navbar">
                    <div class="col-md-9 heading-6" style="display:flex;">
                        <?php if($rsCategory->category_image) { ?>
                        <img src="<?php echo CATEGORY_IMAGES .'/'. $rsCategory->category_image; ?>" width="40"
                            height="40"><?php } ?>
                        <h1 style="text-transform: capitalize;">
                            <strong>&nbsp;<?php echo $rsCategory->category_name; ?></strong></h1>
                    </div>
                    <div class="col-md-3">
                        <a class="button-3" href="javascript:void(0);">Buy Now
                            <?php echo money($rsService->service_price,'$') ?>/M</a>
                    </div>
                </div>


                <p class="paragraph-2 bottom"><?php echo $rsService->service_description; ?></p>
                <div class="row">
                    <div class="col-md-12" style="display:flex;">
                        <img src="<?php echo ADMIN_IMAGES ?>/featurs_icon.png" alt="Features Image" height='30'
                            width='28' style="margin-right: 1%;">
                        <h1 style="font-size: 30px;line-height: 30px;">Features</h1>
                    </div>
                </div>
                <ul style="list-style-type:none;">
                    <?php 
                        $categoryObj->id = $_REQUEST['id'];   
                        $rsFeatures = $categoryObj->get_service_category_features();
                        if (count($rsFeatures) > 0) {
                            foreach ($rsFeatures as $key => $value) { 
                                if($value->status == 'A'){ 
                                    
                                    ?>
                    <div class="row">
                        <div class="col-md-12" style="display:flex;">
                            <img src="<?php echo ADMIN_IMAGES ?>/features_tick.png" height='25' width='25'
                                style="margin-top: 1%; margin-right: 1%;">
                            <li class="paragraph-2 feature"><?php echo  $value->features ?></li>
                        </div>
                    </div>
                    <?php } } } ?>
                </ul>
                <br>

                <div class="row">
                    <div class="col-md-12" style="display:flex;">
                        <img src="<?php echo ADMIN_IMAGES ?>/faq.svg" alt="Features Image" height='30' width='30'
                            style="margin-right: 1%; margin-bottom:2%;">
                        <h1 style="font-size: 30px;line-height: 30px;">FAQ's</h1>
                    </div>
                </div>
                <div id="accordion">
                <?php 
                $categoryObj->id = $_REQUEST['id'];   
                $rsFaqs = $categoryObj->get_service_category_faq();
                if (count($rsFaqs) > 0) {
                  foreach ($rsFaqs as $key => $value) { 
                    if($value->status == 'A'){ 
                          $keyValue = $key+1; ?>
                    <div class="card" style="border:0px;">
                        <div class="card-head" id="headingOne">
                            <h4 class="mb-0" data-toggle="collapse" style="padding-bottom: 20px;"
                                data-target="#collapse<?php echo $keyValue ?>" aria-expanded="true"
                                aria-controls="collapseOne">
                                <strong> <i class="fa fa-plus" style="color:#2aa8ff"></i>
                                    <?php echo $value->question ?></strong>
                            </h4>
                        </div>
                        <div id="collapse<?php echo $keyValue ?>" class="collapse " aria-labelledby="headingOne"
                            data-parent="#accordion">
                            <div class="card-body">
                                <?php echo $value->answer ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <?php } } } ?>
                </div>
                <div class="row  heading-6">
                    <div class="card div-block-194">
                        <div class="faq-q-text top">Ready to deliver for your client?</div>
                        <div class="row">
                            <div class="col-md-12" style="display:flex;">
                                <?php if($rsCategory->category_image) { ?>
                                <h1 style="text-transform: capitalize;">

                                    <img src="<?php echo CATEGORY_IMAGES .'/'. $rsCategory->category_image; ?>"
                                        width="40" height="40"><?php } ?>
                                    <strong>&nbsp;<?php echo $rsCategory->category_name; ?></strong>
                                </h1>
                            </div>
                        </div>
                        <p class="paragraph-2 bottom cta">Once you click the button below, you'll be redirected to a
                            form where you'll enter all the information we need to make this project a success. From
                            there, you can book a time to get on a call with us where we will answer all your questions
                            &amp; kick off the project.</p>
                            <a class="button-3 " href="javascript:void(0);">Buy Now <?php echo money($rsService->service_price,'$') ?>/M</a>
                    </div>
                </div>
                <br>
                <br>
                <br>

            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo ADMIN_JS ?>/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_JS ?>/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_JS ?>/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_JS ?>/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_JS ?>/common-pages.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_JS ?>/custom-script-user.js"></script>

    <script>
    window.onscroll = function() {
        myFunction()
    };

    var navbar = document.getElementById("navbar");
    var sticky = navbar.offsetTop;

    function myFunction() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
        } else {
            navbar.classList.remove("sticky");
        }
    }

    $(document).ready(function() {
        // Add minus icon for collapse element which is open by default
        $(".collapse.show").each(function() {
            $(this).prev(".card-head").find(".fa").addClass("fa-minus").removeClass("fa-plus");
        });

        // Toggle plus minus icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function() {
            $(this).prev(".card-head").find(".fa").removeClass("fa-plus").addClass("fa-minus");
        }).on('hide.bs.collapse', function() {
            $(this).prev(".card-head").find(".fa").removeClass("fa-minus").addClass("fa-plus");
        });
    });
    </script>
</body>

</html>