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
            <a href="javascript:void(0)" onclick="add_edit_category_service(<?php echo $id ?>)">
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
    
    $serviceId = $_POST['service_id'];
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
    <style>.mce-panel{width:100%;}</style>

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
                            <div id="wizard1">
                                <section>
                                <form action="javascript:void(0);" class="wizard-form " id="cotegory_service_forms" enctype="multipart/form-data" >
                                    <input type="hidden" value="category_services" name="act">
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
                                                                    foreach ($rsCategory as $key => $value) { ?>
                                                                    <option value="<?php echo $value->id ?>" <?php if ($category_id == $value->id) {echo 'selected';}?> ><?php echo $value->category_name ?></option>
                                                            <?php } }  ?>
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
                                                        <input type="file" class="form-control" name="service_img" id="service_img"  value="<?php echo $service_img; ?>">
                                                    </div>
                                                    <?php if (!empty($service_img)) {?>
                                                        <img src="<?php echo SERVICE_IMAGES .'/'. $service_img; ?>" alt="Service Images" width="100" height="100">
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
                                    
                                                <div class="col-sm-2 col-lg-2 newclass">
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
                                                            <select class="form-control" name="service_delivery_time">
                                                                <option value="1"  <?php if ($service_delivery_time == '1') {echo 'selected';}?> >1</option>
                                                                <option value="2"  <?php if ($service_delivery_time == '2') {echo 'selected';}?> >2</option>
                                                                <option value="3"  <?php if ($service_delivery_time == '3') {echo 'selected';}?> >3</option>
                                                                <option value="4"  <?php if ($service_delivery_time == '4') {echo 'selected';}?> >4</option>
                                                                <option value="5"  <?php if ($service_delivery_time == '5') {echo 'selected';}?> >5</option>
                                                                <option value="6"  <?php if ($service_delivery_time == '6') {echo 'selected';}?> >6</option>
                                                                <option value="7"  <?php if ($service_delivery_time == '7') {echo 'selected';}?> >7</option>
                                                                <option value="8"  <?php if ($service_delivery_time == '8') {echo 'selected';}?> >8</option>
                                                                <option value="9"  <?php if ($service_delivery_time == '9') {echo 'selected';}?> >9</option>
                                                                <option value="10" <?php if ($service_delivery_time == '10'){echo 'selected';}?> >10</option>                                        
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
                                                        <textarea rows="5" cols="5" class="form-control" id="service_description" name="service_description"><?php echo $service_description; ?></textarea>
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
                                                                if(count($rsServiceFeatures)>0){
                                                                    foreach ($rsServiceFeatures as $key => $value){  ?>
                                                                <div class="col-sm-6 col-lg-6" id="column_'+x+'">
                                                                    <label class="col-form-label">Features</label>
                                                                    <div class="input-group input-group-inverse"> 
                                                                        <span class="input-group-addon" onclick="add_more_features_fields()"><i class="fa fa-plus"></i></span><input type="text" class="form-control" placeholder="Enter Features" value="<?php echo $value->features; ?>" required name="features[]"><span class="input-group-addon" id="basic-addon3"onclick="removeRow('+x+')"><i class="fa fa-minus"></i></span>
                                                                    </div>
                                                                </div>
                                                            <?php } }else{ ?> <script> add_more_features_fields(); </script><?php } ?>
                                                        </div>	
                                                </div>
                                                <script>
                                                    x=1;
                                                    function add_more_features_fields() {
                                                        html ='<div class="col-sm-6 col-lg-6" id="column_'+x+'">';
                                                        html+='<label class="col-form-label">Features</label>';
                                                        html+='<div class="input-group input-group-inverse"> ';
                                                        html+='<span class="input-group-addon" onclick="add_more_features_fields()"><i class="fa fa-plus"></i></span><input type="text" class="form-control" placeholder="Enter Features" required name="features[]"><span class="input-group-addon" id="basic-addon3"onclick="removeRow('+x+')"><i class="fa fa-minus"></i></span> ';
                                                        html+='</div>';
                                                        html+='</div>';
                                                        $('#appeded_column').append(html);
                                                        x++;
                                                    }
                                                    function removeRow(id) {  if(x==1) {  return;   }  x--;	 $('#column_'+id).remove();  }                                                        
                                                </script>             
                                        </fieldset>
                                        <h3> Faq </h3>
                                        <fieldset>

                                        <div class="card-header bg-c-lite-green">
                                            <h5>Add New <?php //echo $rsService->service_name; ?> Faq</h5>
                                        </div>
                                        <div class="card-block">
                                            <div id="appeded_column_faq">
                                                <?php   $categoryObj->id = $id;
                                                        $rsServiceFaq = $categoryObj->get_service_category_faq();
                                                        if(count($rsServiceFaq)>0){
                                                            foreach ($rsServiceFaq as $key => $value){  ?>

                                                    <div class="row" id="faq_column_'+i+'">
                                                        <div class="col-md-6">
                                                            <label class="col-form-label">Question</label>
                                                           <div class="input-group input-group-inverse">
                                                              <span class="input-group-addon" onclick="add_more_faq_fields()"><i class="fa fa-plus"></i></span><input type="text" value="<?php echo $value->question; ?>" class="form-control" placeholder="Enter Question" required name="question[]">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="col-form-label">Answer</label>
                                                            <div class="input-group input-group-inverse"> 
                                                                <input type="text" value="<?php echo $value->answer; ?>" class="form-control" placeholder="Enter Answer" required name="answer[]"><span class="input-group-addon" onclick="removeFaq('+i+')"><i class="fa fa-minus"></i></span>
                                                            </div>
                                                        </div>                                        
                                                    </div>

                                                <?php } }else{ ?> <script> add_more_faq_fields(); </script><?php } ?>
                                            </div>	
                                        </div>
                                            <script>
                                                i=1;
                                                // add_more_faq_fields();
                                                function add_more_faq_fields() { 
                                                    html ='<div class="row" id="faq_column_'+i+'">';
                                                        html+='<div class="col-md-6">';
                                                            html+='<label class="col-form-label">Question</label>';
                                                            html+='<div class="input-group input-group-inverse"> ';
                                                                html+='<span class="input-group-addon" onclick="add_more_faq_fields()"><i class="fa fa-plus"></i></span><input type="text" class="form-control" placeholder="Enter Question" required name="question[]"> ';
                                                            html+='</div>';
                                                        html+='</div>';
                                                        html+='<div class="col-md-6">';
                                                            html+='<label class="col-form-label">Answer</label>';
                                                            html+='<div class="input-group input-group-inverse"> ';
                                                                html+='<input type="text"  class="form-control" placeholder="Enter Answer" required name="answer[]"><span class="input-group-addon"  onclick="removeFaq('+i+')"><i class="fa fa-minus"></i></span>';
                                                            html+='</div>';
                                                        html+='</div>';                                         
                                                    html+='</div>'; 
                                                    $('#appeded_column_faq').append(html);
                                                    i++;
                                                }
                                                function removeFaq(id) {  if(i==1) {  return;   }  i--;	 $('#faq_column_'+id).remove();  }                                       
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

<!-- <script src="<?php echo ADMIN_JS ?>/forms-wizard-validation/form-wizard.js"></script> -->
    <script src="<?php echo ADMIN_JS ?>/tinymce/wysiwyg-editor.js"></script>
    <script>
        $("#cotegory_service_forms").steps({ headerTag: "h3", bodyTag: "fieldset", transitionEffect: "slideLeft", autoFocus: true });
        $(".actions a[href$='#finish']").on('click', function(){
                var cate_id = $('#category_id').val();
                var formData = new FormData();
                formData.append("service_img", document.getElementById('service_img').files[0]); 
                    var fields  = $('form#cotegory_service_forms').serializeArray();
                    jQuery.each( fields, function( i, field ) {  
                        formData.append(field.name, field.value + "");               
                    });
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


