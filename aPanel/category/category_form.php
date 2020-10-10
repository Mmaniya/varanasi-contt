<?php 
define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php";
$action = $_POST['act'];
$categoryObj = new Categories; ?>

<?php if ($action == 'category_statistics') { ?>

    <div class="card borderless-card">
        <div class="card-block info-breadcrumb">
            <div class="breadcrumb-header">
                <h5>Categories</h5>
            </div>
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                    <a href="#!">
                    <i class="fa fa-home"></i>
                    </a>
                    </li>
                    <li class="breadcrumb-item"><a href="<?php echo ADMIN_URL ?>/dashboard.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item"><a href="<?php echo CATEGORY_DIR ?>/index.php">Categories</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div  class="row">
        <div class="col-xl-4 col-md-6">
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
        </div>
        <div class="col-xl-4 col-md-6">
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
    
    <div class="card-header bg-c-lite-green">
        <h5 class="card-header-text"><?php echo $btnName ?> Service Categories</h5>
        <a href="javascript:void(0);" onclick="hide_category_form()"  style="font-size:16px;" class="right-float label label-danger"><i class="feather icon-x">Cancel</i></a>
    </div>
    <div class="card-block" style="background-color: rgb(255, 255, 255);">
        <form action="javascript:void(0);" id="service_category" >
            <input type="hidden" value="service_categories" name="act">
            <input type="hidden"  name="id" value="<?php echo $id; ?>">
            <input type="hidden"  name="admin_id" value="<?php echo $_SESSION['admin_id']; ?>">

            <div class="row">
                <div class="col-sm-6 col-lg-6">
                    <label class="col-form-label">Category Name</label>
                    <div class="input-group input-group-inverse">

                        <input type="text" class="form-control" placeholder="Enter Category Name" required name="category_name" value="<?php echo $category_name; ?>">
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6">
                    <label class="col-form-label">Category Abbreviation</label>
                    <div class="input-group input-group-inverse">

                        <input type="text" class="form-control" placeholder="Enter Category Abbreviation" name="category_abbr" value="<?php echo $category_abbr; ?>" required>
                    </div>
                </div>
            </div>
        
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <label class="col-form-label">Category Description</label>
                    <div class="input-group input-group-inverse">
                        <textarea rows="5" cols="5" class="form-control" placeholder="Enter Category Description" id="category_description"  name="category_description"><?php echo $category_description; ?></textarea>
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
        $("form#service_category").submit(function () { 
            tinyMCE.triggerSave();
            var formData = $('form#service_category').serialize();
            ajax({
                a:"category_ajax",
                b:formData,
                c:function(){},
                d:function(data){ 
                    var records = JSON.parse(data);
                    if(records.result == 'Success'){   
                        tinymce.remove();
                        category_table();
                        category_statistics();
                        hide_category_form();
                        notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                        } else {
                            notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                        }      
                }
            });
        });
    </script>
    <script src="<?php echo ADMIN_JS ?>/tinymce/wysiwyg-editor.js"></script>

<?php }?>

<?php if ($action == 'view_category_statistics'){ 

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
                <h5><?php echo $category_name; ?> Categories</h5>
            </div>
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item"><a href="#!"><i class="fa fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="<?php echo ADMIN_URL ?>/dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo CATEGORY_DIR ?>/index.php">Categories</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div  class="row">

        <div class="col-xl-4 col-md-6">
            <div class="card bg-c-green  text-white">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="m-b-5">Total Service</h4>
                            <h4 class="m-b-0"><?php $categoryObj->category_id = $categoryId; $countCategory = $categoryObj->get_wrk_in_progress_category();  echo $countCategory->total; ?></h4>
                        </div>
                        <div class="col col-auto text-right">
                            <i class="feather icon-user f-50 text-c-green "></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card bg-c-blue  text-white">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="m-b-5">Work In Progress</h4>
                            <h4 class="m-b-0"><?php $categoryObj->category_id = $categoryId;  $countCategory =  $categoryObj->get_wrk_in_progress_category(); echo $countCategory->total_active; ?></h4>
                        </div>
                        <div class="col col-auto text-right">
                            <i class="feather icon-book f-50 text-c-blue"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <a href="javascript:void(0)" onclick="add_edit_category_service()">
            <div class="card bg-c-pink   text-white">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="m-b-5">Add Service</h4>
                            <h4 class="m-b-0"><?php //  $categoryObj->id = $_POST['id']; $rsCount =  $categoryObj->get_wrk_in_progress_category(); echo $rsCount->total; ?></h4>
                        </div>
                        <div class="col col-auto text-right">
                            <i class="feather icon-plus f-50 text-c-pink "></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
  
    </div>

    <!-- <div class="row">
        <div class="col-sm-12">
           
        </div>
    </div> -->
<?php } ?>

<?php if($action == 'add_edit_service_form'){ 
    
    $serviceId = $_POST['id'];
    $btnName = $title = 'Add New';
	$category_id = $_POST['category_id'];  
    if ($serviceId > 0) {
        $param = array('tableName' => TBL_SERVICE, 'fields' => array('*'), 'condition' => array('id' => $serviceId . '-INT'), 'showSql' => 'N');
        $rsService = Table::getData($param);
        foreach ($rsService as $K => $V) {
            $$K = $V;
        }
        $btnName = $title = 'Edit ';
    }?>

<div class="col-12">
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5><?php echo $btnName ?> Service</h5>
                        <a href="javascript:void(0);" onclick="view_category(<?php echo $_POST['category_id'] ?>)" style="font-size:16px;" class="right-float label label-danger"> <i class="feather icon-x">Cancel</i></a>
                    </div>
                    <div class="card-block">                       
                        <div id="wizard">
                            <section>
                            <form action="javascript:void(0);" class="wizard-form" id="category_service_form" id="our_service" enctype="multipart/form-data" >
                                <input type="hidden" value="services" name="act">
                                <input type="hidden"  name="id" value="<?php echo $id; ?>">
                                <input type="hidden"  name="admin_id" value="<?php echo $_SESSION['admin_id']; ?>">

                                    <h3> Service </h3>
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-sm-4 col-lg-4">
                                                <label class="col-form-label">Select Category</label>
                                                <div class="input-group input-group-inverse">
                                                
                                                    <select  class="form-control" required name="category_id" id="category_id">
                                                        <option value="">Select Category</option>
                                                        <?php $rsCategory = Service::get_service_category();
                                                            if (count($rsCategory) > 0) {
                                                                foreach ($rsCategory as $key => $value) {
                                                                    //if ($value->status == 'A') {?>
                                                                <option value="<?php echo $value->id ?>" <?php if ($category_id == $value->id) {echo 'selected';}?> ><?php echo $value->category_name ?></option>
                                                        <?php } } //}   ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-lg-4">
                                                <label class="col-form-label">Service Name</label>
                                                <div class="input-group input-group-inverse">
                                                    <input type="text" class="required form-control"  placeholder="Enter Service Name" name="service_name" required value="<?php echo $service_name; ?>">
                                                </div>
                                            </div>                 
                                            <div class="col-sm-4 col-lg-4">
                                                <label class="col-form-label">Service Image</label>
                                                <div class="input-group input-group-inverse">
                                                    <input type="file" class="form-control" name="service_img"  value="<?php echo $service_img; ?>">
                                                </div>
                                                <?php if (!empty($service_img)) {?>
                                                    <img src="<?php echo SERVICE_IMAGES . $service_img; ?>" alt="Service Images" width="100" height="100">
                                                <?php }?>
                                            </div>                            
                                        </div>
                            
                                        <div class="row">
                                            <div class="col-sm-3 col-lg-3">
                                                <label class="col-form-label">Service Payment Type</label>
                                                <div class="input-group input-group-inverse">
                                                    <select  class="form-control" required name="service_payment_type" onchange="service_payment(this.value)">
                                                        <option value="onetime" <?php if ($service_payment_type == 'onetime') {echo 'selected';}?>>One Time</option>
                                                        <option value="recurring" <?php if ($service_payment_type == 'recurring') {echo 'selected';}?>>Recurring</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <?php  if($service_payment_type=='recurring') { ?> <script> service_payment('recurring'); </script> <?php } ?>
                                
                                            <div class="col-sm-3 col-lg-3 ">
                                                <label class="col-form-label">Service Price	</label>
                                                <div class="input-group ">
                                                    <input type="number" class="form-control" placeholder="Price" name="service_price" value="<?php echo $service_price; ?>">
                                                    <span class="input-group-addon" id="basic-addon3">$</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-lg-3 recurring_period" style="display:none">
                                                <label class="col-form-label">Recurring Period</label>
                                                <div class="input-group input-group-inverse">

                                                    <input type="text" class="form-control" placeholder="Recurring Period" name="if_recurring_period" value="<?php echo $if_recurring_period; ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-lg-3 recurring_period" style="display:none">
                                                <label class="col-form-label">Recurring Type</label>
                                                <div class="input-group input-group-inverse">

                                                    <select class="form-control" name="recurring_type">
                                                        <option value="weekly"  <?php if ($recurring_type == 'weekly') {echo 'selected';}?> >Weekly</option>
                                                        <option value="bi_weekly" <?php if ($recurring_type == 'bi_weekly') {echo 'selected';}?> >Bi Weekly</option>
                                                        <option value="monthly" <?php if ($recurring_type == 'monthly') {echo 'selected';}?> >Monthly</option>
                                                        <option value="yearly" <?php if ($recurring_type == 'yearly') {echo 'selected';}?> >Yearly</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-2 col-lg-2 newclass">
                                                <label class="col-form-label">Delivery Time</label>
                                                <div class="input-group input-group-inverse">
                                                        <select class="form-control" name="recurring_type">
                                                            <option value="1"  <?php if ($recurring_type == '1') {echo 'selected';}?> >1</option>
                                                            <option value="2"  <?php if ($recurring_type == '2') {echo 'selected';}?> >2</option>
                                                            <option value="3"  <?php if ($recurring_type == '3') {echo 'selected';}?> >3</option>
                                                            <option value="4"  <?php if ($recurring_type == '4') {echo 'selected';}?> >4</option>
                                                            <option value="5"  <?php if ($recurring_type == '5') {echo 'selected';}?> >5</option>
                                                            <option value="6"  <?php if ($recurring_type == '6') {echo 'selected';}?> >6</option>
                                                            <option value="7"  <?php if ($recurring_type == '7') {echo 'selected';}?> >7</option>
                                                            <option value="8"  <?php if ($recurring_type == '8') {echo 'selected';}?> >8</option>
                                                            <option value="9"  <?php if ($recurring_type == '9') {echo 'selected';}?> >9</option>
                                                            <option value="10"  <?php if ($recurring_type == '10') {echo 'selected';}?> >10</option>                                        
                                                        </select>
                                                    <!-- <input type="number" class="form-control" placeholder="Delivery Time" name="service_delivery_time" value="<?php echo $service_delivery_time; ?>"> -->
                                                </div>
                                            </div>
                                            <div class="col-sm-2 col-lg-2 newclass">
                                                <label class="col-form-label">Delivery Type</label>
                                                <div class="input-group input-group-inverse">

                                                    <select class="form-control" name="service_delivery_type">
                                                        <option value="day" <?php if ($service_delivery_type == 'day') {echo 'selected';}?> >Day</option>
                                                        <option value="week" <?php if ($service_delivery_type == 'week') {echo 'selected';}?> >Week</option>
                                                        <option value="month" <?php if ($service_delivery_type == 'month') {echo 'selected';}?> >Month</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-2 col-lg-2 newclass">
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
                                                    <textarea rows="5" cols="5" class="form-control" id="service_description" name="service_description"><?php echo $service_description; ?></textarea>
                                                </div>
                                            </div>
                                        </div>                                                                                                                   
                                    </fieldset>
                                    <h3> Features </h3>
                                    <fieldset>
                                        <div class="form-group row">
                                            <div class="col-md-4 col-lg-2">
                                                <label for="name-2" class="block">First name *</label>
                                            </div>
                                            <div class="col-md-8 col-lg-10">
                                                <input id="name-2" name="name" type="text" class="form-control required">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-4 col-lg-2">
                                                <label for="surname-2" class="block">Last name *</label>
                                            </div>
                                            <div class="col-md-8 col-lg-10">
                                                <input id="surname-2" name="surname" type="text" class="form-control required">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-4 col-lg-2">
                                                <label for="phone-2" class="block">Phone #</label>
                                            </div>
                                            <div class="col-md-8 col-lg-10">
                                                <input id="phone-2" name="phone" type="number" class="form-control required phone">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-4 col-lg-2">
                                                <label for="date" class="block">Date Of Birth</label>
                                            </div>
                                            <div class="col-md-8 col-lg-10">
                                                <input id="date" name="Date Of Birth" type="text" class="form-control required date-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-4 col-lg-2">Select Country</div>
                                            <div class="col-md-8 col-lg-10">
                                                <select class="form-control required">
                                                    <option>Select State</option>
                                                    <option>Gujarat</option>
                                                    <option>Kerala</option>
                                                    <option>Manipur</option>
                                                    <option>Tripura</option>
                                                    <option>Sikkim</option>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <h3> Faq </h3>
                                    <fieldset>
                                        <div class="form-group row">
                                            <div class="col-md-4 col-lg-2">
                                                <label for="University-2" class="block">University</label>
                                            </div>
                                            <div class="col-md-8 col-lg-10">
                                                <input id="University-2" name="University" type="text" class="form-control required">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-4 col-lg-2">
                                                <label for="Country-2" class="block">Country</label>
                                            </div>
                                            <div class="col-md-8 col-lg-10">
                                                <input id="Country-2" name="Country" type="text" class="form-control required">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-4 col-lg-2">
                                                <label for="Degreelevel-2" class="block">Degree level #</label>
                                            </div>
                                            <div class="col-md-8 col-lg-10">
                                                <input id="Degreelevel-2" name="Degree level" type="text" class="form-control required phone">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-4 col-lg-2">
                                                <label for="datejoin" class="block">Date Join</label>
                                            </div>
                                            <div class="col-md-8 col-lg-10">
                                                <input id="datejoin" name="Date Of Birth" type="text" class="form-control required">
                                            </div>
                                        </div>
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

<!-- <script src="<?php echo ADMIN_JS ?>/forms-wizard-validation/form-wizard.js"></script> -->
    <script src="<?php echo ADMIN_JS ?>/tinymce/wysiwyg-editor.js"></script>
    <script>
    'use strict';
    $(document).ready(function() {
        var form = $("#category_service_form").show();
        form.steps({
            headerTag: "h3",
            bodyTag: "fieldset",
            transitionEffect: "slideLeft",
            onStepChanging: function(event, currentIndex, newIndex) {
                if(currentIndex > newIndex) {
                    return true;
                }
                // if(newIndex === 3 && Number($("#age-2").val()) < 18) {
                //     return false;
                // }
                if(currentIndex < newIndex) {
                    // form.find(".body:eq(" + newIndex + ") label.error").remove();
                    //form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
                }
                // form.validate().settings.ignore = ":disabled,:hidden";
                // return form.valid();
            },
            onStepChanged: function(event, currentIndex, priorIndex) {
                if(currentIndex === 2 && Number($("#age-2").val()) >= 18) {
                    form.steps("next");
                }
                if(currentIndex === 2 && priorIndex === 3) {
                    form.steps("previous");
                }
            },
            onFinishing: function(event, currentIndex) {
                form.validate().settings.ignore = ":disabled";
                return form.valid();
            },
            onFinished: function(event, currentIndex) {
                alert("Submitted!");
                $('.content input[type="text"]').val('');
                $('.content input[type="email"]').val('');
                $('.content input[type="password"]').val('');
            }
        });
        // validate({
        //     errorPlacement: function errorPlacement(error, element) {
        //         element.before(error);
        //     },
        //     rules: {
        //         confirm: {
        //             equalTo: "#password-2"
        //         }
        //     }
        // });
    });
    

    $("form#our_service").submit(function () {
    cate_id = $('#category_id').val();
    var formData = new FormData(this);
    $.ajax({
        url: '<?php echo SERVICE_DIR ?>/service_ajax.php',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
            var records = JSON.parse(data);
            if(records.result == 'Success'){  
                    view_category(cate_id);
                    hide_category_form();
                    notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                } else {
                    notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                } 
            }                    
    });
});

    </script>
<?php } ?>


