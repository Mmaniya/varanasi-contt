<?php 
define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php";
$action = $_POST['act'];
$categoryObj = new Categories; ?>

<!--============================
    Category Statistics Start
=============================-->

<?php if ($action == 'category_statistics') { ?>
    <div class="card borderless-card">
        <div class="card-block info-breadcrumb">
            <div class="breadcrumb-header">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item"><a href="<?php echo ADMIN_URL ?>/dashboard.php"> <i class="fa fa-home"></i>
                            Dashboard</a> </li>
                    <li class="breadcrumb-item"><a href="<?php echo CATEGORY_DIR ?>/index.php">Categories</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4 col-md-6">
            <a href="javascript:void(0)" onclick="category_table('')">
                <div class="card social-card bg-c-yellow">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <i class="feather icon-bar-chart-2 f-34 text-c-blue social-icon"></i>
                            </div>
                            <div class="col">
                                <h4 class="m-b-0">Total Categories</h4>
                                <h4 class="m-b-0">
                                    <?php
                                            $countCategory = $categoryObj->get_category_count();
                                            echo $countCategory->total;  ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-md-6">
            <a href="javascript:void(0)" onclick="category_table('A')">
                <div class="card social-card  bg-c-green">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <i class="feather icon-bar-chart-2 f-34 text-c-pink social-icon"></i>
                            </div>
                            <div class="col">
                                <h4 class="m-b-0">Work In Progress</h4>
                                <h4 class="m-b-0">
                                    <?php  echo  $countCategory->total_active; ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-md-12">
            <a href="javascript:void(0)" onclick="add_edit_category()">
                <div class="card social-card  bg-c-pink">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <i class="feather icon-plus f-34 text-c-green social-icon"></i>
                            </div>
                            <div class="col">
                                <h4 class="m-b-0">Add Categories</h4>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
<?php }?>

<!--============================
    Category Add Edit Form
=============================-->

<?php if ($action == 'add_edit_category_form') { 
    $btnName = $title = 'Add New';
    $categoryId =  $_POST['id'];
    if ($categoryId > 0) {
        $categoryObj->id = $_POST['id'];
        $rsCategory = $categoryObj->get_category_details();            
        foreach ($rsCategory as $K => $V) {
            $$K = $V;
        }
        $btnName = $title = 'Edit ';
    }?>
    <script> tinymce.remove(); tinymce.init(); </script>
    <div class="card-header bg-c-lite-green">
        <h5 class="card-header-text"><?php echo $btnName ?> Categories</h5>
        <a href="javascript:void(0);" onclick="hide_category_form()" style="font-size:16px;"
            class="right-float label label-danger"><i class="feather icon-x">Cancel</i></a>
    </div>
    <div class="card-block" style="background-color: rgb(255, 255, 255);">
        <form action="javascript:void(0);" id="service_category"  enctype="multipart/form-data">
            <input type="hidden" value="service_categories" name="act">
            <input type="hidden" name="id" id="cate_id" value="<?php echo $id; ?>">
            <input type="hidden" name="admin_id" value="<?php echo $_SESSION['admin_id']; ?>">

            <div class="row">
                <div class="col-sm-6 col-lg-6">
                    <label class="col-form-label">Category Name</label>
                    <div class="input-group input-group-inverse">
                        <input type="text" class="form-control" placeholder="Enter Category Name" name="category_name"
                            value="<?php echo $category_name; ?>">
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6">
                    <label class="col-form-label">Category Abbreviation</label>
                    <div class="input-group input-group-inverse">
                        <input type="text" class="form-control" placeholder="Enter Category Abbreviation"
                            name="category_abbr" value="<?php echo $category_abbr; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <label class="col-form-label">Category Image</label>
                    <div class="input-group input-group-inverse">
                        <input type="file" class="form-control" placeholder="Enter Category Image" name="category_image" >
                    </div>
                </div>
                <?php if(!empty($category_image)) {  ?>
                <div class="col-sm-12 col-lg-12">
                    <img src="<?php echo CATEGORY_IMAGES .'/'. $category_image; ?>" width="100" height="100">
                </div>
                <?php } ?>
            </div>

            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <label class="col-form-label">Category Description</label>
                    <div class="input-group input-group-inverse">
                        <textarea rows="5" cols="5" class="form-control" placeholder="Enter Category Description" id="category_description" name="category_description"><?php echo $category_description; ?></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <input type="submit" class="btn btn-grd-primary" value="Submit">
                </div>
            </div>
        </form>
    </div>
    <script>
        $("form#service_category").submit(function() {
            tinyMCE.triggerSave();
            // var formData = $('form#service_category').serialize();
            var formData = new FormData(this);        
                $.ajax({
                url: '<?php echo CATEGORY_DIR ?>/category_ajax.php',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    var records = JSON.parse(data);
                    if (records.result == 'Success') {
                        tinymce.remove();
                        category_table();
                        category_statistics();
                        hide_category_form();
                        notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft',
                            'animated fadeOutLeft', records.data);
                    } else {
                        notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft',
                            'animated fadeOutLeft', records.data);
                    }
                }
            });
        });
    </script>
    <script src="<?php echo ADMIN_JS ?>/tinymce/wysiwyg-editor.js"></script>

<?php }?>

<!--============================
        Service Breadcrumb
==============================-->

<?php if ($action == 'service_breadcrumb'){ 
    $categoryId =  $_POST['id'];
    if ($categoryId > 0) {
    $categoryObj->id = $_POST['id'];
    $rsCategory = $categoryObj->get_category_details();            
    foreach ($rsCategory as $K => $V) {
        $$K = $V;
    } } ?>
    <div class="card borderless-card">
        <div class="card-block warning-breadcrumb">
            <div class="breadcrumb-header">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item"><a href="<?php echo ADMIN_URL ?>/dashboard.php"> <i
                                class="fa fa-home"></i>Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo CATEGORY_DIR ?>/index.php">Categories</a></li>
                    <li class="breadcrumb-item"><a href="#!"><?php echo $category_name; ?></a></li>
                </ul>
            </div>
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item"><a href="<?php echo CATEGORY_DIR ?>/index.php"> <i class="fa fa-arrow-left"
                                aria-hidden="true"></i> Back</a></li>
                </ul>
            </div>
        </div>
    </div>
<?php } ?>

<!--============================
        Service Form
==============================-->

<?php if($action == 'add_edit_service_form'){ 
    
    $serviceId = $_POST['service_id'];
    $btnName = $title = 'Add New';
	$category_id = $_POST['category_id'];  
    if ($serviceId > 0) {
        $categoryObj->id = $serviceId;
        $rsService = $categoryObj->category_service_data();  
        foreach ($rsService as $K => $V) {
            $$K = $V;
        }
        $btnName = $title = 'Edit ';
    }?>
    <script> tinymce.remove(); tinymce.init('width : "840"');</script>
    <style>
    .mce-panel {
        width: 99%;
    }
    </style>
    <div class="col-12">
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5><?php echo $btnName ?> Service</h5>
                            <?php if(empty($_POST['page'])){ ?>
                                <a href="javascript:void(0);" onclick="view_category(<?php echo $_POST['category_id'] ?>)" style="font-size:16px;" class="right-float label label-danger"> <i class="feather icon-x">Cancel</i></a>
                            <?php } else { ?>
                                <a href="javascript:void(0);" onclick="view_category_service(<?php echo $_POST['service_id'] ?>)" style="font-size:16px;" class="right-float label label-danger"> <i class="feather icon-x">Cancel</i></a>
                            <?php } ?>
                        </div>
                        <div class="card-block">
                            <div id="wizard1">
                                <section>
                                    <form action="javascript:void(0);" class="wizard-form " id="category_service_forms"
                                        enctype="multipart/form-data">
                                        <input type="hidden" value="category_services" name="act">
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <input type="hidden" name="admin_id" value="<?php echo $_SESSION['admin_id']; ?>">
                                        <h3> Service </h3>
                                        <fieldset>
                                            <div class="row">
                                                <?php if(!empty($id)) { ?> <div class="col-sm-3 col-lg-3"> <?php } else { ?>
                                                    <div class="col-sm-4 col-lg-4"> <?php } ?>
                                                        <label class="col-form-label">Select Category</label>
                                                        <div class="input-group input-group-inverse">
                                                            <select class="form-control" name="category_id"
                                                                id="category_id">
                                                                <option value="">Select Category</option>
                                                                <?php $rsCategory = Service::get_service_category();
                                                                        if (count($rsCategory) > 0) {
                                                                            foreach ($rsCategory as $key => $value) { ?>
                                                                <option value="<?php echo $value->id ?>"
                                                                    <?php if ($category_id == $value->id) {echo 'selected';}?>>
                                                                    <?php echo $value->category_name ?></option>
                                                                <?php } }  ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <?php if(!empty($service_name)) { ?> <div class="col-sm-3 col-lg-3">
                                                        <?php } else { ?> <div class="col-sm-4 col-lg-4"> <?php } ?>
                                                            <label class="col-form-label">Service Name</label>
                                                            <div class="input-group input-group-inverse">
                                                                <input type="text" class="form-control"
                                                                    placeholder="Enter Service Name" name="service_name"
                                                                    value="<?php echo $service_name; ?>">
                                                            </div>
                                                        </div>
                                                        <?php if(!empty($service_img)) { ?> <div class="col-sm-3 col-lg-3">
                                                            <?php } else { ?> <div class="col-sm-4 col-lg-4"> <?php } ?>
                                                                <label class="col-form-label">Service Image</label>
                                                                <div class="input-group input-group-inverse">
                                                                    <input type="file" class="form-control" name="service_img" id="service_img" value="<?php echo $service_img; ?>">
                                                                </div>
                                                            </div>
                                                            <?php if (!empty($service_img)) {?>
                                                            <div class="col-sm-3 col-lg-3">
                                                                <img src="<?php echo SERVICE_IMAGES .'/'. $service_img; ?>"
                                                                    alt="Service Images" width="100" height="100">
                                                            </div>
                                                            <?php }?>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-3 col-lg-3">
                                                                <label class="col-form-label">Service Payment Type</label>
                                                                <div class="input-group input-group-inverse">
                                                                    <select class="form-control" name="service_payment_type"
                                                                        onchange="service_payment(this.value)">
                                                                        <option value="onetime"
                                                                            <?php if ($service_payment_type == 'onetime') {echo 'selected';}?>>
                                                                            One Time</option>
                                                                        <option value="recurring"
                                                                            <?php if ($service_payment_type == 'recurring') {echo 'selected';}?>>
                                                                            Recurring</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <?php  if($service_payment_type=='recurring') { ?> <script>  service_payment('recurring'); </script> <?php } ?>
                                                            <div class="col-sm-2 col-lg-2 newclass">
                                                                <label class="col-form-label">Service Price </label>
                                                                <div class="input-group ">
                                                                    <input type="number" class="form-control"
                                                                        placeholder="Price" name="service_price"
                                                                        value="<?php echo $service_price; ?>">
                                                                    <span class="input-group-addon"
                                                                        id="basic-addon3">$</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 col-lg-3 recurring_period"
                                                                style="display:none">
                                                                <label class="col-form-label">Recurring Period</label>
                                                                <div class="input-group input-group-inverse">
                                                                    <input type="text" class="form-control" placeholder="Recurring Period"name="if_recurring_period" value="<?php echo $if_recurring_period; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 col-lg-3 recurring_period"
                                                                style="display:none">
                                                                <label class="col-form-label">Recurring Type</label>
                                                                <div class="input-group input-group-inverse">
                                                                    <select class="form-control" name="recurring_type">
                                                                        <option value="weekly" <?php if ($recurring_type == 'weekly') {echo 'selected';}?>> Weekly </option>
                                                                        <option value="bi_weekly" <?php if ($recurring_type == 'bi_weekly') {echo 'selected';}?>> Bi Weekly</option>
                                                                        <option value="monthly" <?php if ($recurring_type == 'monthly') {echo 'selected';}?>> Monthly</option>
                                                                        <option value="yearly" <?php if ($recurring_type == 'yearly') {echo 'selected';}?>> Yearly</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-2 col-lg-2 newclass">
                                                                <label class="col-form-label">Delivery Time</label>
                                                                <div class="input-group input-group-inverse">
                                                                    <select class="form-control"
                                                                        name="service_delivery_time">
                                                                        <option value="1" <?php if ($service_delivery_time == '1') {echo 'selected';}?>>1</option>
                                                                        <option value="2" <?php if ($service_delivery_time == '2') {echo 'selected';}?>>2</option>
                                                                        <option value="3" <?php if ($service_delivery_time == '3') {echo 'selected';}?>>3</option>
                                                                        <option value="4" <?php if ($service_delivery_time == '4') {echo 'selected';}?>>4</option>
                                                                        <option value="5" <?php if ($service_delivery_time == '5') {echo 'selected';}?>>5</option>
                                                                        <option value="6" <?php if ($service_delivery_time == '6') {echo 'selected';}?>>6</option>
                                                                        <option value="7" <?php if ($service_delivery_time == '7') {echo 'selected';}?>>7</option>
                                                                        <option value="8" <?php if ($service_delivery_time == '8') {echo 'selected';}?>>8</option>
                                                                        <option value="9" <?php if ($service_delivery_time == '9') {echo 'selected';}?>>9</option>
                                                                        <option value="10" <?php if ($service_delivery_time == '10'){echo 'selected';}?>>10</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-2 col-lg-2 newclass">
                                                                <label class="col-form-label">Delivery Type</label>
                                                                <div class="input-group input-group-inverse">

                                                                    <select class="form-control"
                                                                        name="service_delivery_type">
                                                                        <option value="day" <?php if ($service_delivery_type == 'day') {echo 'selected';}?>>Day</option>
                                                                        <option value="week" <?php if ($service_delivery_type == 'week') {echo 'selected';}?>> Week</option>
                                                                        <option value="month" <?php if ($service_delivery_type == 'month') {echo 'selected';}?>>Month</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 col-lg-3">
                                                                <label class="col-form-label">Questionnaire Complete Days</label>
                                                                <div class="input-group input-group-inverse">
                                                                    <input type="text" class="form-control" placeholder="Questionnaire Complete Days" name="service_questionnaire_complete_days" value="<?php echo $service_questionnaire_complete_days; ?>">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-12 col-lg-12">
                                                                <label class="col-form-label">Service Description</label>
                                                                <div class="input-group input-group-inverse">
                                                                    <textarea class="form-control" id="service_description"  name="service_description"><?php echo $service_description; ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                        </fieldset>
                                        <h3> Features </h3>
                                        <fieldset>
                                            <div class="card-header bg-c-lite-green">
                                                <h5>Add New <?php //echo $rsService->service_name; ?> Features</h5>
                                            </div>
                                            <div class="card-block">
                                                <div class="row" id="appeded_column">
                                                    <?php 
                                                            $categoryObj->id = $id;
                                                            $rsServiceFeatures = $categoryObj->get_service_category_features();
                                                            if(count($rsServiceFeatures)>0){  ?>
                                                    <script>
                                                    z = 0;
                                                    </script>
                                                    <?php  foreach ($rsServiceFeatures as $key => $value){  $rand = rand(); ?>
                                                    <div class="col-sm-6 col-lg-6" id="edit_column_<?php echo $key;?>">
                                                        <label class="col-form-label">Features</label>
                                                        <div class="input-group input-group-inverse">
                                                            <button type="button"  class="btn btn-default clone-btn-left delete" onclick="removeEditRow(<?php echo $key;?>)"><i class="fa fa-minus"></i></button>
                                                            <input type="text" class="form-control" placeholder="Enter Features" value="<?php echo $value->features; ?>" name="features[]">
                                                            <button type="button" class="btn btn-primary clone-btn-left clone" onclick="add_more_features_fields()"><i class="fa fa-plus"></i></button>
                                                        </div>
                                                    </div>
                                                    <script>
                                                         z++;
                                                    </script>
                                                    <?php } } else { ?> <script>  add_more_features_fields(); </script><?php } ?>
                                                </div>
                                            </div>
                                            <script>
                                            x = 1;

                                            function add_more_features_fields() {
                                                html = '<div class="col-sm-6 col-lg-6" id="column_' + x + '">';
                                                html += '<label class="col-form-label">Features</label>';
                                                html += '<div class="input-group input-group-inverse"> ';
                                                html += '<button type="button" class="btn btn-default clone-btn-left delete" onclick="removeRow(' + x + ')"><i class="fa fa-minus"></i></button>';
                                                html += '<input type="text" class="form-control" placeholder="Enter Features" name="features[]">';
                                                html += '<button type="button" class="btn btn-primary clone-btn-left clone" onclick="add_more_features_fields()"><i class="fa fa-plus"></i></button>';
                                                html += '</div>';
                                                html += '</div>';
                                                $('#appeded_column').append(html);
                                                x++;
                                            }

                                            function removeRow(id) {
                                                if (x == 1) {
                                                    return;
                                                }
                                                x--;
                                                $('#column_' + id).remove();
                                            }

                                            function removeEditRow(id) {
                                                if (z == 1) {
                                                    return;
                                                }
                                                z--;
                                                $('#edit_column_' + id).remove();
                                            }
                                            </script>
                                        </fieldset>
                                        <h3> Faq </h3>
                                        <fieldset>

                                            <div class="card-header bg-c-lite-green">
                                                <h5>Add New <?php //echo $rsService->service_name; ?> Faq</h5>
                                            </div>
                                            <div class="card-block">
                                                <div id="appeded_column_faq" class="row">
                                                    <?php   $categoryObj->id = $id;
                                                                $rsServiceFaq = $categoryObj->get_service_category_faq();
                                                                if(count($rsServiceFaq)>0){
                                                                    foreach ($rsServiceFaq as $key => $value){  ?>

                                                                    <div class="col-sm-6 col-lg-6 " id="faq_column_<?php echo $key;?>">
                                                                        <label class="col-form-label">Question</label>
                                                                        <div class="input-group input-group-inverse">
                                                                            <input type="text" class="form-control"  placeholder="Enter Question"  value="<?php echo $value->question; ?>" name="question[]">
                                                                        </div>
                                                                        <label class="col-form-label">Answer</label>
                                                                        <textarea name="answer[]"><?php echo $value->answer; ?></textarea>
                                                                        <button class="clone btn btn-primary m-b-15 m-t-15  m-r-15" onclick="add_more_faq_fields()">Add</button>
                                                                        <button class="delete btn btn-danger m-b-15 m-t-15"  onclick="removeFaq(<?php echo $key;?>)">Delete</button>
                                                                    </div>
                                                                    <?php } }else{ ?> <script> add_more_faq_fields(); </script><?php } ?>
                                                </div>
                                            </div>
                                            <script>
                                  
                                            i = 1;

                                            function add_more_faq_fields() {
                                                html = '<div class="col-sm-6 col-lg-6 " id="faq_column_' + i + '">';
                                                html += '<label class="col-form-label">Question</label>';
                                                html += '<div class="input-group input-group-inverse">';
                                                html += '<input type="text" class="form-control" placeholder="Enter Question" value="" name="question[]">';
                                                html += '</div>';
                                                html += '<textarea name="answer[]" class="myeditable"></textarea>';
                                                html += '<button class=" clone btn btn-primary m-b-15 m-t-15 m-r-15" onclick="add_more_faq_fields()">Add</button>';
                                                html += '<button class=" delete  btn btn-danger m-b-15 m-t-15" onclick="removeFaq(' + i + ')">Delete</button>';
                                                html += '</div>';
                                                $('#appeded_column_faq').append(html);
                                                i++;
                                            }

                                            function removeFaq(id) {
                                                if (i == 1) {
                                                    return;
                                                }
                                                i--;
                                                $('#faq_column_' + id).remove();
                                            }
                                            </script>
                                        </fieldset>
                                        <h3> Steps </h3>
                                        <fieldset>

                                            <div class="card-header bg-c-lite-green">
                                                <h5>Add New <?php //echo $rsService->service_name; ?> Steps</h5>
                                            </div>
                                            <div class="card-block">
                                                <div id="appeded_column_step" class="row">
                                                    <?php   $categoryObj->id = $id;
                                                    $rsServiceFaq = $categoryObj->get_service_category_steps();
                                                    if(count($rsServiceFaq)>0){
                                                        foreach ($rsServiceFaq as $key => $value){  ?>

                                                        <div class="col-sm-6 col-lg-6 " id="step_column_<?php echo $key;?>">
                                                            <label class="col-form-label">Title</label>
                                                            <div class="input-group input-group-inverse">
                                                                <input type="text" class="form-control"  placeholder="Enter Steps Title"  value="<?php echo $value->title; ?>" name="title[]">
                                                            </div>
                                                            <label class="col-form-label">Discription</label>
                                                            <textarea name="description[]"><?php echo $value->description; ?></textarea>
                                                            <label class="col-form-label">Estimated Time to Complete</label>
                                                            <div class="input-group input-group-inverse">
                                                                <input type="text" class="form-control col-5"  placeholder="Enter Time"  value="<?php echo $value->estimated_time; ?>" name="estimated_time[]">
                                                                <select class="form-control col-6 offset-1" name="estimated_type[]">
                                                                    <option value="H" <?php if ($value->estimated_type == 'H') {echo 'selected';}?>> Hours</option>
                                                                    <option value="D" <?php if ($value->estimated_type == 'D') {echo 'selected';}?>> Days</option>
                                                                    <option value="W" <?php if ($value->estimated_type == 'W') {echo 'selected';}?>> Weeks </option>
                                                                    <option value="M" <?php if ($value->estimated_type == 'M') {echo 'selected';}?>> Months</option>
                                                                </select>
                                                            </div>
                                                            <button class="clone btn btn-primary m-b-15 m-t-15  m-r-15" onclick="add_more_step_fields()">Add</button>
                                                            <button class="delete btn btn-danger m-b-15 m-t-15"  onclick="removeSteps(<?php echo $key;?>)">Delete</button>
                                                        </div>
                                                        <?php } }else{ ?> <script> add_more_step_fields(); </script><?php  } ?>
                                                </div>
                                            </div>
                                            <script>
                                  
                                            y = 1;

                                            function add_more_step_fields() {
                                                html = '<div class="col-sm-6 col-lg-6 " id="step_column_' + y + '">';
                                                html += '<label class="col-form-label">Discription</label>';
                                                html += '<div class="input-group input-group-inverse">';
                                                html += '<input type="text" class="form-control" placeholder="Enter Steps Title" value="" name="title[]">';
                                                html += '</div>';
                                                html += '<label class="col-form-label" >Discription</label>';
                                                html += '<textarea name="description[]" class="myeditable"></textarea>';
                                                html += '<label class="col-form-label">Estimated Time to Complete</label>';
                                                html += '<div class="input-group input-group-inverse">';
                                                html += '<input type="text" class="form-control col-5"  placeholder="Enter Time"  value="<?php echo $value->estimated_time; ?>" name="estimated_time[]">';
                                                html += '<select class="form-control col-6 offset-1" name="estimated_type[]">';
                                                html += '<option value="H"> Hours</option>';
                                                html += '<option value="D"> Days</option>';
                                                html += '<option value="W" selected=""> Weeks </option>';
                                                html += '<option value="M"> Months</option>';
                                                html += '</select>';
                                                html += '</div>';
                                                html += '<button class=" clone btn btn-primary m-b-15 m-t-15 m-r-15" onclick="add_more_step_fields()">Add</button>';
                                                html += '<button class=" delete  btn btn-danger m-b-15 m-t-15" onclick="removeSteps(' + y + ')">Delete</button>';
                                                html += '</div>';
                                                $('#appeded_column_step').append(html);
                                                y++;
                                            }

                                            function removeSteps(id) {
                                                if (y == 1) {
                                                    return;
                                                }
                                                y--;
                                                $('#step_column_' + id).remove();
                                            }
                                            </script>

                                        </fieldset>                                 
                                    </form>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo ADMIN_JS ?>/tinymce/wysiwyg-editor.js"></script>
    <script>
        $("#category_service_forms").steps({
            headerTag: "h3",
            bodyTag: "fieldset",
            transitionEffect: "slideLeft",
            autoFocus: true
        });
        $(".actions a[href$='#finish']").on('click', function() {
            tinyMCE.triggerSave();

            var cate_id = $('#category_id').val();
            var formData = new FormData();
            formData.append("service_img", document.getElementById('service_img').files[0]);
            var fields = $('form#category_service_forms').serializeArray();
            jQuery.each(fields, function(i, field) {

                formData.append(field.name, field.value + "");

            });
            $.ajax({
                url: '<?php echo CATEGORY_DIR ?>/category_ajax.php',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    var records = JSON.parse(data);
                    if (records.result == 'Success') {
                        <?php if(empty($_POST['page'])){ ?>
                        view_category(cate_id);
                        <?php } else { ?>
                        view_category_service(<?php echo $_POST['service_id']; ?>);
                        <?php } ?>
                        hide_category_form();
                        notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft',
                            'animated fadeOutLeft', records.data);
                    } else {
                        notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft',
                            'animated fadeOutLeft', records.data);
                    }
                }
            });
        });
        // $("form#our_service").submit(function() {
        //     cate_id = $('#category_id').val();
        //     var formData = new FormData(this);
        //     $.ajax({
        //         url: '<?php echo SERVICE_DIR ?>/service_ajax.php',
        //         type: 'POST',
        //         data: formData,
        //         cache: false,
        //         contentType: false,
        //         processData: false,
        //         success: function(data) {
        //             var records = JSON.parse(data);
        //             if (records.result == 'Success') {
        //                 view_category(cate_id);
        //                 hide_category_form();
        //                 notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft',
        //                     'animated fadeOutLeft', records.data);
        //             } else {
        //                 notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft',
        //                     'animated fadeOutLeft', records.data);
        //             }
        //         }
        //     });
        // });
    </script>
<?php } ?>

<!--============================
        Service Form
==============================-->

<?php if ($action == 'service_dashboard'){ 

    $serviceId =  $_POST['id'];
    if ($serviceId > 0) {
        $categoryObj->id = $_POST['id'];        
        $rsService = $categoryObj->category_service_data();  
        foreach ($rsService as $K => $V) {
            $$K = $V;
        } } ?>

    <div class="card borderless-card">
        <div class="card-block info-breadcrumb">
            <div class="breadcrumb-header">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item"><a href="<?php echo ADMIN_URL ?>/dashboard.php"> <i  class="fa fa-home"></i>Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo CATEGORY_DIR ?>/index.php">Categories</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);" onclick="view_category(<?php echo $category_id ?>)"><?php  $categoryObj->id = $category_id; $rsCategory = $categoryObj->get_category_details(); echo $rsCategory->category_name; ?></a> </li>
                    <li class="breadcrumb-item"><a href="#!"><?php echo $service_name; ?></a></li>
                </ul>
            </div>
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item"><a href="javascript:void(0);" onclick="view_category(<?php echo $category_id ?>)"> <i class="fa fa-arrow-left"  aria-hidden="true"></i> Back</a></li>
                </ul>
            </div>
        </div>
    </div>

<?php } ?>

<!--============================
        Service Form
==============================-->

<?php if ($action == 'update_category_service_features') {   
    if (!empty($_POST['id'])) {
        $categoryObj->id = $_POST['id'];
        $rsFeatures = $categoryObj->get_service_category_features_by_id();   
        $btnName = $title = 'Edit ';
    } 

    ?>
    <!-- <script> tinymce.remove(); tinymce.init(); </script> -->
    <div class="card-header bg-c-lite-green">
        <h5 class="card-header-text"><?php echo $btnName ?> Featured</h5>
        <a href="javascript:void(0);" onclick="hide_category_form()" style="font-size:16px;"
            class="right-float label label-danger"><i class="feather icon-x">Cancel</i></a>
    </div>
    <div class="card-block" style="background-color: rgb(255, 255, 255);">
        <form action="javascript:void(0);" id="update_features">
            <input type="hidden" value="update_category_service_features" name="act">
            <input type="hidden" name="id" id="fetures_id" value="<?php echo $_POST['id'] ?>">
            <input type="hidden" id="service_id" value="<?php echo $rsFeatures[0]->service_id; ?>">

            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <label class="col-form-label">Featured Name</label>
                    <div class="input-group input-group-inverse">
                        <input type="text" class="form-control" placeholder="Enter Category Name" name="features" value="<?php echo $rsFeatures[0]->features; ?>">
                    </div>
                </div>     
            </div>
   
            <!-- <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <label class="col-form-label">Category Description</label>
                    <div class="input-group input-group-inverse">
                        <textarea rows="5" cols="5" class="form-control" placeholder="Enter Category Description" id="category_description" name="category_description"><?php echo $category_description; ?></textarea>
                    </div>
                </div>
            </div> -->

            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <input type="submit" class="btn btn-grd-primary" value="Submit">
                </div>
            </div>
        </form>
    </div>
    <script>
        $("form#update_features").submit(function() {
            // tinyMCE.triggerSave();
            var formData = $('form#update_features').serialize();
            var service_id = $('#service_id').val();
            // var formData = new FormData(this);        
                $.ajax({
                url: '<?php echo CATEGORY_DIR ?>/category_ajax.php',
                type: 'POST',
                data: formData,
                // cache: false,
                // contentType: false,
                // processData: false,
                success: function(data) {
                    var records = JSON.parse(data);
                    if (records.result == 'Success') {  
                        view_category_service(service_id); 
                        hide_category_form();                
                        notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft',
                            'animated fadeOutLeft', records.data);
                    } else {
                        notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft',
                            'animated fadeOutLeft', records.data);
                    }
                }
            });
        });
    </script>
    <script src="<?php echo ADMIN_JS ?>/tinymce/wysiwyg-editor.js"></script>

<?php }?>