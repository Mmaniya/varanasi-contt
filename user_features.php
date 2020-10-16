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
    <title>MMS - Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ADMIN_CSS ?>/user-style.css">

  </head>
  <body>
  <div class="container">
	<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom">
        <!-- <h5 class="my-0 mr-md-auto font-weight-normal">Mastermind Solutions</h5>		  -->
            <img src="<?php echo ADMIN_IMAGES ?>/mmslogo.png" alt="logo" class="log-img"/>
		    <a class="button-3 col-md-2 offset-md-7" href="#">View Profile</a>
	</div>
</div>
<!-- <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <div class="heading-7">Welcome to your agency delivery hub! ⚡</div>
  <p class="paragraph-2">This is where you can get your client work fulfilled, and explore new services you can sell.</p>
</div> -->

<div class="container">
  <div class="row">
    <div class="col-12">
        <?php 
          $categoryObj->id = $_REQUEST['id'];   
          $rsService = $categoryObj->category_service_data();
        ?>
        <div class="row">
            <img src="<?php echo SERVICE_IMAGES .'/'. $rsService->service_img; ?>" alt="Service Images" width="50" height="50">
            <h2 class="col-9"><?php echo $rsService->service_name; ?></h2>
        </div>
            <p class="paragraph-2 bottom"><?php echo $rsService->service_description; ?></p>
            <div class="row"><img src="<?php echo ADMIN_IMAGES ?>/featurs_icon.png" alt="Features Image" height='30' width='30' style="margin-top: 1%; margin-right: 1%;"><h1>Features</h1></div>
            <ul style="list-style-type:none;">
                    <?php 
                        $categoryObj->id = $_REQUEST['id'];   
                        $rsFeatures = $categoryObj->get_service_category_features();
                        if (count($rsFeatures) > 0) {
                            foreach ($rsFeatures as $key => $value) { ?>
                            <div class="row"><img src="<?php echo ADMIN_IMAGES ?>/features_tick.png"  height='25' width='25' style="margin-top: 1%; margin-right: 1%;"><li class="paragraph-2 feature"><?php echo  $value->features ?></li></div>
                <?php } } ?>
            </ul>
            <br>
            <div class="row"><img src="<?php echo ADMIN_IMAGES ?>/faq.svg" alt="Features Image" height='30' width='30' style="margin-top: 1%; margin-right: 1%;"><h1>FAQ's</h1></div>
            <div id="accordion">

            <?php 
        $categoryObj->id = $_REQUEST['id'];   
        $rsFaqs = $categoryObj->get_service_category_faq();
        if (count($rsFaqs) > 0) {
            foreach ($rsFaqs as $key => $value) { 
                    $keyValue = $key+1; ?>

            <div class="card" style="border:0px;">
                <div class="card-head" id="headingOne">
                  <h4 class="mb-0" data-toggle="collapse" style="height: 38px;" data-target="#collapse<?php echo $keyValue ?>" aria-expanded="true" aria-controls="collapseOne">
                  <?php echo $value->question ?>
                  </h4>
                </div>
                <div id="collapse<?php echo $keyValue ?>" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <?php echo $value->answer ?>
                    </div>
                </div>
            </div>    
            <hr>     
            <?php } } ?>
            </div>

    </div>
  </div>
</div>
 <script type="text/javascript" src="<?php echo ADMIN_JS ?>/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo ADMIN_JS ?>/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo ADMIN_JS ?>/popper.js/popper.min.js"></script>
<script type="text/javascript" src="<?php echo ADMIN_JS ?>/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo ADMIN_JS ?>/common-pages.js"></script> 
<script type="text/javascript" src="<?php echo ADMIN_JS ?>/custom-script-user.js"></script>
</body>
</html>