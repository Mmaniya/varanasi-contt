<?php  require "includes.php"; 
$categoryObj = new Categories; ?>

<?php  if($_POST['act'] == 'user_services') {  
                    
    $categoryObj->id = $_POST['id'];   
    $rsService = $categoryObj->get_category_service();
    if (count($rsService) > 0) {
    foreach ($rsService as $key => $value) { ?>
    
    <div class="card col-md-6 col-sm-12 main-card">
        <div class="card-body">

                <div class="title-service">
                <?php if(!empty($value->service_img)){ ?>
                    <img src="<?php echo SERVICE_IMAGES .'/'. $value->service_img; ?>" alt="Service Images" class="img-fluid image-11" />
                <?php }else{  ?>
                    <i class="fa fa-cube" aria-hidden="true"></i>
                <?php } ?>
                <div class="title-name"><?php echo $value->service_name; ?></div>
                </div>
            <h4 class="text-block-16 price">$&nbsp;<?php echo $value->service_price; ?>/M</h4>
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
            <div class="row">
                <div class="col-12">
                    <div class="text-box" data-maxlength="250"> 
                        <p class="title"><?php echo $value->service_description; ?></p>
                    </div>
                </div>
            </div>
            <a href="user_features.php?id=<?php echo $value->id; ?>"  class="btn btn-outline-primary col-12 button-3" onclick="get_service_features(<?php echo $value->id; ?>)">Learn More</a>
        </div>
    </div>

<?php } } ?> 
<script>
  $(function () {
    $(".text-box p").text(function(index, currentText) {
        var maxLength = $(this).parent().attr('data-maxlength');
        if(currentText.length >= maxLength) {
            return currentText.substr(0, maxLength) + "...";
        } else {
            return currentText
        } 
        });
  })
  </script>
<?php } ?>

<?php  if($_POST['act'] == 'user_services_name') {  

    $categoryObj->id = $_POST['id'];   
    $rsService = $categoryObj->get_category_details(); ?>
    <div class="text-block-15"><?php echo $rsService->category_name?></div>


<?php } ?>
