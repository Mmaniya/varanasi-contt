<?php  require "includes.php"; 
$categoryObj = new Categories; ?>

<?php  if($_POST['act'] == 'user_services') {  
                    
    $categoryObj->id = $_POST['id'];   
    $rsService = $categoryObj->get_category_service();
    if (count($rsService) > 0) {
    foreach ($rsService as $key => $value) { ?>

    <div class="card col-6 main-card">
    <div class="card-body">
        <div class="row">
        <?php if(!empty($value->service_img)){ ?>
        <img src="<?php echo SERVICE_IMAGES .'/'. $value->service_img; ?>" alt="Service Images" class="col-3" >
        <?php }else{  ?>
            <i class="fa fa-cube" aria-hidden="true"></i>
        <?php } ?>
        <h2 class="col-9"><?php echo $value->service_name; ?></h2>
        </div>
        <h4 class="text-block-16.price">$&nbsp;<?php echo $value->service_price; ?></h4>
        <div class="row">
            <div class="w-col w-col-6">
                <div class="div-block-185 srp">
                    <p class="paragraph-3 caps srp">SRP: $960/M</p>
                </div>
            </div>
            <div class="column-8 w-col w-col-6">
                <div class="div-block-185">
                    <p class="paragraph-3 caps">$500 - $3,000 Ad Budget</p>
                </div>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-6">
                <button type="button" class="btn btn-outline-success col-12">SRP: $960/M</button>
            </div>
            <div class="col-6">
                <button type="button" class="btn btn-outline-success col-12">$500 - $3,000 Ad Budget</button>
            </div>
        </div> -->
        <div class="row">
        <div class="col-12">
            <p style="margin-bottom: 25px; opacity: 0.6; font-family: 'Circular STD', sans-serif;"><?php echo $value->service_description; ?></p>
        </div>
        </div>
        <a href="user_features.php?id=<?php echo $value->id; ?>"  class="btn btn-outline-primary col-12" onclick="get_service_features(<?php echo $value->id; ?>)">Learn More</a>
    </div>
    </div>
    <script>
        // function get_service_features(id){
        //     param = { 'act': 'user_services_name','id':id };
        //     ajax({
        //         a: 'user_ajax',
        //         b: $.param(param),
        //         c: function () { },
        //         d: function (data) {
        //             $('#userservicesname').html(data);
        //         }
        //     });
        // }
    </script>

<?php } } } ?>

<?php  if($_POST['act'] == 'user_services_name') {  

    $categoryObj->id = $_POST['id'];   
    $rsService = $categoryObj->get_category_details(); ?>
    <h2><?php echo $rsService->category_name?></h2>
<?php } ?>

<?php //if($_POST['act'] == 'user_services_features') {  

// $categoryObj->id = $_POST['id'];   
// $rsService = $categoryObj->get_category_details(); ?>
<!-- <h2><?php //echo $rsService->category_name?></h2> -->
<?php  // } ?>
