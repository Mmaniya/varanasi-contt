<?php define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php";
$action = $_POST['act']; 
$categoryObj = new Categories;
?>
<?php if ($action == 'category_table') {  ?>
    <div class="card-header bg-c-lite-green;">
        <h5>Categories List</h5>
        <a href="javascript:void(0);" style="font-size:16px;" onclick="add_edit_category()"
            class="right-float label label-success"> <i class="feather icon-plus"> Add New</i></a>
    </div>
    <div class="card-block">
        <div class="card-block table-border-style">
            <div class="table-responsive">
                <form action="javascript:void(0);" id="category_position" style="width:100%">
                    <input type="hidden" name="act" value="category_position">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Categories</th>
                                <th style="text-align:center">Action</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="draggableCategories" class="draggable">
                            <?php  $statusArr = array('A' => 'checked', 'I' => '');  

                            $categoryObj->status = $_POST['status'];   

                            $rsCategory = $categoryObj->get_category();
                            if (count($rsCategory) > 0) {
                                foreach ($rsCategory as $key => $value) { ?>

                            <tr class="row_id_<?php echo $value->id; ?>" id="<?php echo $value->id; ?>">
                                <input type="hidden" name="category_id[]" value="<?php echo $value->id ?>">
                                <th><?php echo $key + 1 ?></th>
                                <td><a href="javascript:void(0);" onclick="view_category(<?php echo $value->id; ?>)"  class="text-primary"><?php echo $value->category_name ?></a></td>
                                <td>
                                    <!-- <div class="btn-group " role="group" > -->
                                    <a href="javascript:void(0);" class="label label-info" onclick="add_edit_category(<?php echo $value->id; ?>)"><i class="fa fa-edit"  aria-hidden="true"></i>Edit</a>
                                    <a href="javascript:void(0);" class="label label-danger" onclick="delete_category(<?php echo $value->id; ?>)"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a>
                                    <!-- <a href="javascript:void(0);" class="btn btn-sm btn-success " ><i class="fa fa-eye" aria-hidden="true"></i>View</a>  -->
                                    <!-- </div> -->
                                </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" class="status_update_<?php echo $value->id; ?>" onchange="statusCategory(<?php echo $value->id; ?>)" <?php echo $statusArr[$value->status]; ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                            </tr>
                            <?php }} else {?>
                            <tr>
                                <td colspan="4" class="text-center"> No Records Found. Click here to <a
                                        href="javascript:void(0);" onclick="add_edit_category()" style="color:#01a9ac"> Add
                                        New</a> </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            Sortable.create(draggableCategories, {
                group: 'draggableCategories',
                animation: 150,
                accept: '.sortable-moves',
                onUpdate: function(ui) {
                    var param = $('form#category_position').serialize();
                    ajax({
                        a: "category_ajax",
                        b: param,
                        c: function() {},
                        d: function(data) {
                            var records = JSON.parse(data);
                            category_table();
                            category_statistics();
                            if (records.result == 'Success') {
                                $('#service_category_form').hide();
                                notify('top', 'right', 'fa fa-check', 'success','animated fadeInLeft', 'animated fadeOutLeft', records.data);
                            } else {
                                notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                            }
                        }
                    });
                },
            });
        });
    </script>
<?php } ?>

<?php if ($action == 'category_dashboard') {  

        $categoryObj->id = $_POST['id'];
        $rsCategory = $categoryObj->get_category_details(); 
           foreach ($rsCategory as $K => $V) {
            $$K = $V;
        }           
    ?>
    <div class="card">
        <div class="card-header bg-c-lite-green" style="border-bottom: 1px solid lightgray;">
            <h4 style="color:#ffffff"> <?php echo $category_name; ?>
                <a href="javascript:void(0);" onclick="add_edit_category_service(<?php echo $id ?>,'')" style="font-size:16px;" class="right-float label label-inverse"><i class="feather icon-plus"> Add Service</i></a>
                <a href="javascript:void(0);" onclick="update_category_form(<?php echo $id ?>)" style="font-size:15px;" class="right-float label label-warning"><i class="fa fa-edit"></i> Edit</a>
            </h4>
            <span style="font-size: 18px; color:#ffffff">[<?php echo $category_abbr; ?>]</span>
            <!-- <a href="<?php echo CATEGORY_DIR ?>/index.php" style="font-size:16px;" class="right-float label label-danger"> <i class="feather icon-arrow-left"> Go Back</i></a> -->
        </div>
        <div class="card-block">
            <?php echo $category_description; ?>
        </div>
    </div>

    <div class="card">
        <div class="col-lg-12">
            <ul class="nav nav-tabs md-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#service" role="tab"
                        aria-expanded="false">Service</a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#notes" role="tab" aria-expanded="false">Notes</a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#clients" role="tab" aria-expanded="false">Clients</a>
                    <div class="slide"></div>
                </li>
                <!-- <li class="nav-item">
                                <a class="nav-link " data-toggle="tab" href="#settings3" role="tab" aria-expanded="true">Settings</a>
                                <div class="slide"></div>
                            </li> -->
            </ul>
            <div class="tab-content card-block">
                <div class="tab-pane active" id="service" role="tabpanel" aria-expanded="false">
                    <p class="m-0">

                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <form action="javascript:void(0);" id="service_position" style="width:100%">
                                <input type="hidden" name="act" value="category_service_position">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Service </th>
                                            <th>Price </th>
                                            <th>Action</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="draggableService" class="draggable">
                                        <?php   $statusArr = array('A' => 'checked', 'I' => ''); 
                                                        $categoryObj->id = $_POST['id'];                                 
                                                        $rsCategory = $categoryObj->get_category_service();
                                                        if (count($rsCategory) > 0) {
                                                            foreach ($rsCategory as $key => $value) { ?>

                                        <tr class="row_id_<?php echo $value->id; ?>" id="<?php echo $value->id; ?>">
                                            <input type="hidden" name="service_id[]" value="<?php echo $value->id ?>">
                                            <th><?php echo $key + 1 ?></th>
                                            <td><a href="javascript:void(0);" class="text-primary" onclick="view_category_service(<?php  echo $value->id; ?>)"><?php echo $value->service_name ?></a></td>
                                            <td><?php echo money($value->service_price, '$') ?></td>
                                            <td>
                                                <a href="javascript:void(0);" class="label label-info" onclick="add_edit_category_service(<?php echo $id ?>,<?php echo $value->id; ?>)"><i class="fa fa-edit" aria-hidden="true"></i>Edit</a>
                                                <a href="javascript:void(0);" class="label label-danger" onclick="delete_category_service(<?php echo $id ?>,<?php echo $value->id; ?>)"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a>
                                                <!-- <a href="javascript:void(0);" class="btn btn-sm btn-warning " onclick="category_service_list(<?php echo $value->id; ?>)"><i class="fa fa-plus" aria-hidden="true"></i>Service</a>  -->
                                                <!-- <a href="javascript:void(0);" class="btn btn-sm btn-success " onclick="view_category(<?php // echo $value->id; ?>)"><i class="fa fa-eye" aria-hidden="true"></i>View</a>  -->
                                            </td>
                                            <td>
                                                <label class="switch">
                                                    <input type="checkbox" class="status_update_<?php echo $value->id; ?>" onchange="statuscategoryService(<?php echo $value->id; ?>,<?php echo $id ?>)" <?php echo $statusArr[$value->status]; ?>>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                        </tr>
                                        <?php }} else {?>
                                        <tr>
                                            <td colspan="5" class="text-center"> No Records Found. Click here to <a href="javascript:void(0);" onclick="add_edit_category_service(<?php echo $id ?>,'')" style="color:#01a9ac"> Add New</a> </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                    </p>
                </div>
                <div class="tab-pane" id="notes" role="tabpanel" aria-expanded="false">
                    <p class="m-0"></p>
                </div>
                <div class="tab-pane" id="clients" role="tabpanel" aria-expanded="false">
                    <p class="m-0"></p>
                </div>
                <!-- <div class="tab-pane " id="settings3" role="tabpanel" aria-expanded="true">
                                <p class="m-0"></p>
                            </div> -->
            </div>
        </div>
    </div>

    <script>
    $(function() {
        Sortable.create(draggableService, {
            group: 'draggableService',
            animation: 150,
            accept: '.sortable-moves',
            onUpdate: function(ui) {
                var param = $('form#service_position').serialize();
                ajax({
                    a: "category_ajax",
                    b: param,
                    c: function() {},
                    d: function(data) {
                        var records = JSON.parse(data);
                        if (records.result == 'Success') {
                            notify('top', 'right', 'fa fa-check', 'success',
                                'animated fadeInLeft', 'animated fadeOutLeft', records
                                .data);
                        } else {
                            notify('top', 'right', 'fa fa-times', 'danger',
                                'animated fadeInLeft', 'animated fadeOutLeft', records
                                .data);
                        }
                    }
                });
            },
        });
    });
    </script>
<?php } ?>

<?php if ($action == 'category_service') {  

        $categoryObj->id = $_POST['id'];
        $reService = $categoryObj->category_service_data(); 
           foreach ($reService as $K => $V) {
           $$K = $V;
        }           
    ?>
    <div class="card">
        <div class="card-header bg-c-lite-green" style="border-bottom: 1px solid lightgray;">
            <h4 style="color:#ffffff"> <?php echo $service_name; ?>
                <a href="javascript:void(0);" onclick="update_category_service(<?php echo $category_id; ?>,<?php echo $id ?>)" style="font-size:15px;" class="right-float label label-warning"><i class="fa fa-edit"></i> Edit</a>
            </h4>
            <!-- <a href="<?php echo CATEGORY_DIR ?>/index.php" style="font-size:16px;" class="right-float label label-danger"> <i class="feather icon-arrow-left"> Go Back</i></a> -->
        </div>
        <div class="card-block">

            <div class="row ">
                <div class="col-sm-4  bg-c-lite-green user-profile">
                    <div class="card-block text-center text-white">
                        <div class="m-b-25">
                            <img src="<?php echo SERVICE_IMAGES .'/'. $service_img; ?>" alt="Service Images" width="100" height="100">
                        </div>
                        <h4 class="f-w-600">PRICE</h4>
                        <h4><?php echo money($service_price,'$'); ?></h4>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="card-block">
                        <!-- <h6 class="m-b-10 p-b-5 b-b-default f-w-600">Description</h6> -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h6 class="text-muted "><?php  echo $service_description; ?></h6>
                            </div>
                        </div>
                        <h6 class="m-b-10 m-t-20 p-b-5 b-b-default f-w-600">Payment</h6>
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- <p class="m-b-10 f-w-600">Payment type</p> -->
                                <h6 class="text-muted  f-w-400" style="text-transform:capitalize;">
                                    <?php  echo $service_payment_type; ?></h6>
                            </div>
                            <div class="col-sm-6">
                                <!-- <p class="m-b-10 f-w-600">Duration</p> -->
                                <?php if($service_payment_type == 'recurring'){ ?>
                                <h6 class="text-muted f-w-400" style="text-transform:capitalize;">
                                    <?php  echo $if_recurring_period; ?>&nbsp;<?php  switch ($recurring_type) { case "bi_weekly": echo "Bi weekly"; break; case "weekly": echo "Weeks"; break; case "monthly": echo "Months"; break;  case "yearly": echo "Years"; break; }?>
                                </h6>
                                <?php } ?>
                            </div>
                        </div>
                        <h6 class="m-b-10 m-t-10 p-b-5 b-b-default f-w-600"></h6>
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="m-b-10 f-w-600">Delivery Time</p>
                                <h6 class="text-muted  f-w-400" style="text-transform:capitalize;">
                                    <?php  echo $service_delivery_time; ?>&nbsp;<?php  switch ($service_delivery_type) { case "day": echo "Days"; break; case "month": echo "Month"; break; case "week": echo "Weeks"; break; }?>
                                </h6>
                            </div>
                            <div class="col-sm-6">
                                <p class="m-b-10 f-w-600">Questionnaire Complete Days</p>
                                <h6 class="text-muted f-w-400" style="text-transform:capitalize;">
                                    <?php  echo $if_recurring_period; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="col-lg-12">
            <ul class="nav nav-tabs md-tabs" role="tablist">
                <!-- <li class="nav-item ">
                    <a class="nav-link " data-toggle="tab" href="#featured" role="tab" aria-expanded="false">Featured</a>
                    <div class="slide"></div>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#features" role="tab"
                        aria-expanded="false">Featured</a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#faq" role="tab" aria-expanded="false">FAQ</a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#steps" role="tab" aria-expanded="false">Steps</a>
                    <div class="slide"></div>
                </li>
              
            </ul>
            <div class="tab-content card-block">        
                <div class="tab-pane active" id="features" role="tabpanel" aria-expanded="false">
                    <p class="m-0">
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <form action="javascript:void(0);" id="features_position" style="width:100%">
                                <input type="hidden" name="act" value="service_features_position">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Action</th>
                                            <th>Is Featured</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="draggableFeatures" class="draggable">
                                        <?php   $statusArr = array('A' => 'checked', 'I' => ''); 
                                                $arrayFeatured = array('Y' => 'checked', 'N' => '');
                                                    $categoryObj->id = $_POST['id'];                                 
                                                    $rsFeatures = $categoryObj->get_service_category_features();
                                                    if (count($rsFeatures) > 0) {
                                                        foreach ($rsFeatures as $key => $value) { ?>

                                        <tr class="row_id_<?php echo $value->id; ?>" id="<?php echo $value->id; ?>">
                                            <input type="hidden" name="features_id[]" value="<?php echo $value->id ?>">
                                            <th><?php echo $key + 1 ?></th>
                                            <td><?php echo $value->features ?></a></td>
                                            <td>
                                            
                                                <a href="javascript:void(0);" class="label label-info" onclick="update_category_service_features(<?php echo $value->id; ?>)"><i class="fa fa-edit" aria-hidden="true"></i>Edit</a>
                                                <a href="javascript:void(0);" class="label label-danger" onclick="delete_category_service_features(<?php echo $id ?>,<?php echo $value->id; ?>)"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a>
                                            </td>
                                            <td>
                                                <label class="switch">
                                                    <input type="checkbox" class="featured_status_update_<?php echo $value->id; ?>" onchange="set_as_featured(<?php echo $value->id; ?>,<?php echo $id ?>)" <?php echo $arrayFeatured[$value->is_featured]; ?>>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>                                            
                                            <td>
                                                <label class="switch">
                                                    <input type="checkbox" class="status_update_<?php echo $value->id; ?>" onchange="status_service_features(<?php echo $value->id; ?>,<?php echo $id ?>)" <?php echo $statusArr[$value->status]; ?>>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                        </tr>
                                        <?php }} else {?>
                                        <tr>
                                            <td colspan="5" class="text-center"> No Records Found. Click here to <a href="javascript:void(0);" onclick="add_edit_category_service(<?php echo $id ?>,'')" style="color:#01a9ac"> Add New</a> </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                    </p>
                </div>
                <div class="tab-pane" id="faq" role="tabpanel" aria-expanded="false">
                    <p class="m-0">
                    <style>th, td { white-space:normal; }</style>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <form action="javascript:void(0);" id="faq_position" style="width:100%">
                                <input type="hidden" name="act" value="service_faq_position">
                          
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Question & Answer </th>
                                            <th>Action</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="draggableFaq" class="draggable">
                                        <?php   $statusArr = array('A' => 'checked', 'I' => ''); 
                                                    $categoryObj->id = $_POST['id'];                                 
                                                    $rsFaq = $categoryObj->get_service_category_faq();
                                                    if (count($rsFaq) > 0) {
                                                        foreach ($rsFaq as $key => $value) { ?>

                                        <tr class="row_id_<?php echo $value->id; ?>" id="<?php echo $value->id; ?>">
                                            <input type="hidden" name="faq_id[]" value="<?php echo $value->id ?>">
                                            <th><?php echo $key + 1 ?></th>
                                            <td style="width:53%;">
                                                <p><strong>Q:</strong> <?php echo $value->question ?></p>
                                               <strong>A:</strong> <?php echo strip_tags($value->answer) ?>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0);" class="label label-info" onclick="update_category_service_faq(<?php echo $value->id; ?>)"><i class="fa fa-edit" aria-hidden="true"></i>Edit</a>
                                                <a href="javascript:void(0);" class="label label-danger" onclick="delete_category_service_faq(<?php echo $id ?>,<?php echo $value->id; ?>)"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a>
                                            </td>  
                                            <td>
                                                <label class="switch">
                                                    <input type="checkbox" class="status_update_<?php echo $value->id; ?>"  onchange="statusServiceFaq(<?php echo $value->id; ?>)"
                                                        <?php echo $statusArr[$value->status]; ?>>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                        </tr>
                                        <?php }} else {?>
                                        <tr>
                                            <td colspan="5" class="text-center"> No Records Found. Click here to <a href="javascript:void(0);" onclick="add_edit_category_service(<?php echo $id ?>,'')" style="color:#01a9ac"> Add New</a> </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                    </p>
                </div>
                <div class="tab-pane" id="steps" role="tabpanel" aria-expanded="false">
                    <p class="m-0">
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <form action="javascript:void(0);" id="steps_position" style="width:100%">
                                <input type="hidden" name="act" value="service_step_position">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Action</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="draggableStep" class="draggable">
                                        <?php   $statusArr = array('A' => 'checked', 'I' => ''); 
                                                    $categoryObj->id = $_POST['id'];                                 
                                                    $rsSteps = $categoryObj->get_service_category_steps();
                                                    if (count($rsSteps) > 0) {
                                                        foreach ($rsSteps as $key => $value) { ?>

                                        <tr class="row_id_<?php echo $value->id; ?>" id="<?php echo $value->id; ?>">
                                            <input type="hidden" name="step_id[]" value="<?php echo $value->id ?>">
                                            <th><?php echo $key + 1 ?></th>
                                            <td> <?php echo $value->title ?></td>
                                            <td>
                                                <a href="javascript:void(0);" class="label label-info" onclick="update_category_service_steps(<?php echo $value->id; ?>)"><i class="fa fa-edit" aria-hidden="true"></i>Edit</a>
                                                <a href="javascript:void(0);" class="label label-danger" onclick="delete_category_service_steps(<?php echo $id ?>,<?php echo $value->id; ?>)"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a>
                                            </td>  
                                            <td>
                                                <label class="switch">
                                                    <input type="checkbox" class="status_update_<?php echo $value->id; ?>"  onchange="statusServiceSteps(<?php echo $value->id; ?>)"
                                                        <?php echo $statusArr[$value->status]; ?>>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                        </tr>
                                        <?php } } else {?>
                                        <tr>
                                            <td colspan="5" class="text-center"> No Records Found. Click here to <a
                                                    href="javascript:void(0);"
                                                    onclick="add_edit_category_service(<?php echo $id ?>,'')"
                                                    style="color:#01a9ac"> Add New</a> </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                    </p>
                </div>             
            </div>
        </div>
    </div>

    <script>
    $(function() {
        Sortable.create(draggableFeatures, {
            group: 'draggableFeatures',
            animation: 150,
            accept: '.sortable-moves',
            onUpdate: function(ui) {
                var param = $('form#features_position').serialize();
                ajax({
                    a: "category_ajax",
                    b: param,
                    c: function() {},
                    d: function(data) {
                        var records = JSON.parse(data);
                        if (records.result == 'Success') {
                            notify('top', 'right', 'fa fa-check', 'success',
                                'animated fadeInLeft', 'animated fadeOutLeft', records
                                .data);
                        } else {
                            notify('top', 'right', 'fa fa-times', 'danger',
                                'animated fadeInLeft', 'animated fadeOutLeft', records
                                .data);
                        }
                    }
                });
            },
        });
        Sortable.create(draggableFaq, {
            group: 'draggableFaq',
            animation: 150,
            accept: '.sortable-moves',
            onUpdate: function(ui) {
                var param = $('form#faq_position').serialize();
                ajax({
                    a: "category_ajax",
                    b: param,
                    c: function() {},
                    d: function(data) {
                        var records = JSON.parse(data);
                        if (records.result == 'Success') {
                            notify('top', 'right', 'fa fa-check', 'success',
                                'animated fadeInLeft', 'animated fadeOutLeft', records
                                .data);
                        } else {
                            notify('top', 'right', 'fa fa-times', 'danger',
                                'animated fadeInLeft', 'animated fadeOutLeft', records
                                .data);
                        }
                    }
                });
            },
        });
        Sortable.create(draggableStep, {
            group: 'draggableStep',
            animation: 150,
            accept: '.sortable-moves',
            onUpdate: function(ui) {
                var param = $('form#steps_position').serialize();
                ajax({
                    a: "category_ajax",
                    b: param,
                    c: function() {},
                    d: function(data) {
                        var records = JSON.parse(data);
                        if (records.result == 'Success') {
                            notify('top', 'right', 'fa fa-check', 'success',
                                'animated fadeInLeft', 'animated fadeOutLeft', records
                                .data);
                        } else {
                            notify('top', 'right', 'fa fa-times', 'danger',
                                'animated fadeInLeft', 'animated fadeOutLeft', records
                                .data);
                        }
                    }
                });
            },
        });
        Sortable.create(draggableFeatured, {
            group: 'draggableFeatured',
            animation: 150,
            accept: '.sortable-moves',
            onUpdate: function(ui) {
                var param = $('form#featured_position').serialize();
                ajax({
                    a: "category_ajax",
                    b: param,
                    c: function() {},
                    d: function(data) {
                        var records = JSON.parse(data);
                        if (records.result == 'Success') {
                            notify('top', 'right', 'fa fa-check', 'success',
                                'animated fadeInLeft', 'animated fadeOutLeft', records
                                .data);
                        } else {
                            notify('top', 'right', 'fa fa-times', 'danger',
                                'animated fadeInLeft', 'animated fadeOutLeft', records
                                .data);
                        }
                    }
                });
            },
        });
    });
    </script>
<?php } ?>