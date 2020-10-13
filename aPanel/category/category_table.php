
<?php define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php";
$action = $_POST['act']; 
$categoryObj = new Categories;
?>
<?php if ($action == 'category_table') {  ?>
    <div class="card-header bg-c-lite-green;">
        <h5>Categories List</h5>
        <a href="javascript:void(0);" style="font-size:16px;" onclick="add_edit_category()" class="right-float label label-success"> <i class="feather icon-plus"> Add New</i></a>
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
                    <tbody  id="draggableCategories" class="draggable">
                    <?php  $statusArr = array('A' => 'checked', 'I' => '');  

                        $categoryObj->status = $_POST['status'];   

                        $rsCategory = $categoryObj->get_category();
                        if (count($rsCategory) > 0) {
                            foreach ($rsCategory as $key => $value) { ?>
                                            
                    <tr class="row_id_<?php echo $value->id; ?>" id="<?php echo $value->id; ?>">
                        <input type="hidden" name="category_id[]" value="<?php echo $value->id ?>">
                        <th><?php echo $key + 1 ?></th>
                        <td><a href="javascript:void(0);" onclick="view_category(<?php echo $value->id; ?>)" class="text-primary" ><?php echo $value->category_name ?></a></td>
                        <td>
                            <!-- <div class="btn-group " role="group" > -->
                                <a href="javascript:void(0);" class="btn btn-sm btn-info" onclick="add_edit_category(<?php echo $value->id; ?>)"><i class="fa fa-edit" aria-hidden="true"></i>Edit</a>
                                <a href="javascript:void(0);" class="btn btn-sm btn-danger" onclick="delete_category(<?php echo $value->id; ?>)"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a>
                                <!-- <a href="javascript:void(0);" class="btn btn-sm btn-success " ><i class="fa fa-eye" aria-hidden="true"></i>View</a>  -->
                            <!-- </div> -->
                        </td>
                        <td>
                            <label class="switch">
                            <input type="checkbox" class="status_update_<?php echo $value->id; ?>" onchange="statusCategory(<?php echo $value->id; ?>)"
                                <?php echo $statusArr[$value->status]; ?>>
                            <span class="slider round"></span>
                            </label>
                        </td>
                    </tr>
                    <?php }} else {?>
                    <tr>
                        <td colspan="4" class="text-center"> No Records Found. Click here to <a
                            href="javascript:void(0);" onclick="add_edit_category()"
                            style="color:#01a9ac"> Add New</a> </td>
                    </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            Sortable.create(draggableCategories, {
                group: 'draggableCategories',
                animation: 150,
                accept: '.sortable-moves',
                onUpdate: function (ui) {  
                    var param = $('form#category_position').serialize();
                    ajax({
                        a: "category_ajax",
                        b: param,
                        c: function () { },
                        d: function (data) {
                            var records = JSON.parse(data);
                                category_table();
                                category_statistics();
                            if (records.result == 'Success') {                              
                                $('#service_category_form').hide();
                                notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                            }else{
                                notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                            }
                        }
                    });
                },
            });
        });
    </script>
<?php } ?>

<?php if ($action == 'category_service_table') {  

        $categoryObj->id = $_POST['id'];
        $rsCategory = $categoryObj->get_category_details(); 
           foreach ($rsCategory as $K => $V) {
            $$K = $V;
        }           
    ?>
        <div class="card">
            <div class="card-header bg-c-lite-green" style="border-bottom: 1px solid lightgray;">
                <h4 style="color:#ffffff"> <?php echo $category_name; ?>
                 <a href="javascript:void(0);" onclick="add_edit_category_service(<?php echo $id ?>,'')"  style="font-size:16px;" class="right-float label label-inverse"><i class="feather icon-plus"> Add Service</i></a>
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
                        <a class="nav-link active" data-toggle="tab" href="#home3" role="tab" aria-expanded="false">Service</a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#profile3" role="tab" aria-expanded="false">Notes</a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#messages3" role="tab" aria-expanded="false">Clients</a>
                        <div class="slide"></div>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#settings3" role="tab" aria-expanded="true">Settings</a>
                        <div class="slide"></div>
                    </li> -->
                </ul>
                <div class="tab-content card-block">
                    <div class="tab-pane active" id="home3" role="tabpanel" aria-expanded="false">
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
                                            <th >Action</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody  id="draggableService" class="draggable">
                                        <?php   $statusArr = array('A' => 'checked', 'I' => ''); 
                                                $categoryObj->id = $_POST['id'];                                 
                                                $rsCategory = $categoryObj->get_category_service();
                                                if (count($rsCategory) > 0) {
                                                    foreach ($rsCategory as $key => $value) { ?>

                                        <tr class="row_id_<?php echo $value->id; ?>" id="<?php echo $value->id; ?>">
                                            <input type="hidden" name="service_id[]" value="<?php echo $value->id ?>">
                                                    <th><?php echo $key + 1 ?></th>
                                                    <td><?php echo $value->service_name ?></td>
                                                    <td><?php echo money($value->service_price, '$') ?></td>
                                            <td>
                                                <!-- <div class="btn-group " role="group" > -->
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-info" onclick="add_edit_category_service(<?php echo $id ?>,<?php echo $value->id; ?>)"><i class="fa fa-edit" aria-hidden="true"></i>Edit</a>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger" onclick="delete_category_service(<?php echo $id ?>,<?php echo $value->id; ?>)"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a>
                                                    <!-- <a href="javascript:void(0);" class="btn btn-sm btn-warning " onclick="category_service_list(<?php echo $value->id; ?>)"><i class="fa fa-plus" aria-hidden="true"></i>Service</a>  -->
                                                    <!-- <a href="javascript:void(0);" class="btn btn-sm btn-success " onclick="view_category(<?php // echo $value->id; ?>)"><i class="fa fa-eye" aria-hidden="true"></i>View</a>  -->
                                                <!-- </div> -->
                                            </td>
                                            <td>
                                                <label class="switch">
                                                <input type="checkbox" class="status_update_<?php echo $value->id; ?>" onchange="statuscategoryService(<?php echo $value->id; ?>,<?php echo $id ?>)"
                                                    <?php echo $statusArr[$value->status]; ?>>
                                                <span class="slider round"></span>
                                                </label>
                                            </td>
                                        </tr>
                                        <?php }} else {?>
                                        <tr>
                                            <td colspan="5" class="text-center"> No Records Found. Click here to <a
                                                href="javascript:void(0);" onclick="add_edit_category_service(<?php echo $id ?>,'')"
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
                    <div class="tab-pane" id="profile3" role="tabpanel" aria-expanded="false">
                        <p class="m-0"></p>
                    </div>
                    <div class="tab-pane" id="messages3" role="tabpanel" aria-expanded="false">
                        <p class="m-0"></p>
                    </div>
                    <!-- <div class="tab-pane " id="settings3" role="tabpanel" aria-expanded="true">
                        <p class="m-0"></p>
                    </div> -->
                </div>
            </div>
        </div>

    <script>
        $(function () {
            Sortable.create(draggableService, {
                group: 'draggableService',
                animation: 150,
                accept: '.sortable-moves',
                onUpdate: function (ui) {  
                    var param = $('form#service_position').serialize();
                    ajax({
                        a: "category_ajax",
                        b: param,
                        c: function () { },
                        d: function (data) {
                            var records = JSON.parse(data);                     
                            if (records.result == 'Success') {                                                          
                                notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                            }else{
                                notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                            }
                        }
                    });
                },
            });
        });
    </script>
<?php } ?>