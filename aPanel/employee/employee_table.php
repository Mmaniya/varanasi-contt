<?php define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php";
$action = $_POST['act']; 
$employeeObj = new Employee; ?>

<!-- Employee table -->
<?php if($action == 'employee_main_table'){ ?>
    <div class="card-header bg-c-lite-green;">
        <h5>Employee List</h5>
        <a href="javascript:void(0);" style="font-size:16px;" onclick="add_edit_employee('')"
            class="right-float label label-success"> <i class="feather icon-plus"> Add New</i></a>
    </div>
    <div class="card-block">
        <div class="card-block table-border-style">
            <div class="table-responsive">
                <form action="javascript:void(0);" id="employee_position" style="width:100%">
                    <input type="hidden" name="act" value="employee_position">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee ID</th>
                                <th>Name</th>
                                <th style="text-align:center">Action</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="draggableEmployee" class="draggable">
                            <?php  $statusArr = array('A' => 'checked', 'I' => '');  

                            $employeeObj->status = $_POST['status'];   
                            $rsEmployee = $employeeObj->get_employee_details();
                            if (count($rsEmployee) > 0) {
                                foreach ($rsEmployee as $key => $value) { ?>

                            <tr class="row_id_<?php echo $value->id; ?>" id="<?php echo $value->id; ?>">
                                <input type="hidden" name="emp_id[]" value="<?php echo $value->id ?>">
                                <th><?php echo $key + 1 ?></th>
                                <td><a href="javascript:void(0);" onclick="view_employee(<?php echo $value->id; ?>)"  class="text-primary"><?php echo $value->emp_code ?></a></td>
                                <td><?php echo $value->first_name.'&nbsp;'.$value->last_name ?></td>
                                <td>
                                    <a href="javascript:void(0);" class="label label-info" onclick="add_edit_employee(<?php echo $value->id; ?>)"><i class="fa fa-edit"  aria-hidden="true"></i>Edit</a>
                                    <a href="javascript:void(0);" class="label label-danger" onclick="delete_employee(<?php echo $value->id; ?>)"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a>                                  
                                </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" class="status_update_<?php echo $value->id; ?>" onchange="statusEmployee(<?php echo $value->id; ?>)" <?php echo $statusArr[$value->status]; ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                            </tr>
                            <?php }} else {?>
                            <tr>
                                <td colspan="5" class="text-center"> No Records Found. Click here to <a href="javascript:void(0);" onclick="add_edit_employee('')" style="color:#01a9ac"> Add New</a> </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            Sortable.create(draggableEmployee, {
                group: 'draggableEmployee',
                animation: 150,
                accept: '.sortable-moves',
                onUpdate: function(ui) {
                    var param = $('form#employee_position').serialize();
                    $('.preloader').show();
                    ajax({
                        a: "employee_ajax",
                        b: param,
                        c: function() {},
                        d: function(data) {
                            var records = JSON.parse(data);
                            $('.preloader').hide();
                            employee_main_table();
                            employee_statistics();
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

<!-- Employee Role table -->
<?php if($action == 'employee_role_table'){ ?>
    <div class="card-header bg-c-lite-green;">
        <h5>Employee Role List</h5>
        <a href="javascript:void(0);" style="font-size:16px;" onclick="add_edit_role('')"
            class="right-float label label-success"> <i class="feather icon-plus"> Add New</i></a>
    </div>
    <div class="card-block">
        <div class="card-block table-border-style">
            <div class="table-responsive">
                <form action="javascript:void(0);" id="employee_role_position" style="width:100%">
                    <input type="hidden" name="act" value="employee_role_position">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Role</th>
                                <th style="text-align:center">Action</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="draggableRole" class="draggable">
                            <?php  $statusArr = array('A' => 'checked', 'I' => '');  

                            $employeeObj->status = $_POST['status'];   
                            $rsEmployeerole = $employeeObj->get_employee_role();
                            if (count($rsEmployeerole) > 0) {
                                foreach ($rsEmployeerole as $key => $value) { ?>

                            <tr class="row_id_<?php echo $value->id; ?>" id="<?php echo $value->id; ?>">
                                <input type="hidden" name="role_id[]" value="<?php echo $value->id ?>">
                                <th><?php echo $key + 1 ?></th>
                                <td><a href="javascript:void(0);" onclick="view_category(<?php echo $value->id; ?>)"  class="text-primary"><?php echo $value->role_name ?></a></td>
                                <td>
                                    <a href="javascript:void(0);" class="label label-info" onclick="add_edit_role(<?php echo $value->id; ?>)"><i class="fa fa-edit"  aria-hidden="true"></i>Edit</a>
                                    <a href="javascript:void(0);" class="label label-danger" onclick="delete_employee_role(<?php echo $value->id; ?>)"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a>                                  
                                </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" class="status_update_<?php echo $value->id; ?>" onchange="statusRole(<?php echo $value->id; ?>)" <?php echo $statusArr[$value->status]; ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                            </tr>
                            <?php }} else {?>
                            <tr>
                                <td colspan="4" class="text-center"> No Records Found. Click here to <a href="javascript:void(0);" onclick="add_edit_role('')" style="color:#01a9ac"> Add New</a> </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            Sortable.create(draggableRole, {
                group: 'draggableRole',
                animation: 150,
                accept: '.sortable-moves',
                onUpdate: function(ui) {
                    var param = $('form#employee_role_position').serialize();
                    $('.preloader').show();
                    ajax({
                        a: "employee_ajax",
                        b: param,
                        c: function() {},
                        d: function(data) {
                            var records = JSON.parse(data);
                            $('.preloader').hide();
                            employee_role();
                            employee_statistics();
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
