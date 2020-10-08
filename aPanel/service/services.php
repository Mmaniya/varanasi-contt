<?php function main()
{?>

    <div class="card borderless-card">
        <div class="card-block caption-breadcrumb">
            <div class="breadcrumb-header">
                <h5>Services</h5>
            </div>
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="#!">
                            <i class="icofont icofont-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Services</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-7" id="service_table">
            <div class="card">
                <div class="card-header bg-c-lite-green">
                    <h5>Service List</h5>
                    <a href="javascript:void(0);" onclick="add_edit_service()" class="right-float label label-success">Add New</a>
                    <a href="javascript:void(0);" onclick="service_position()" class="right-float label label-warning">Change Position &nbsp;&nbsp; </a>
                </div>
                <div class="card-block">
                    <div class="card-block table-border-style">
                    <div class="row">
                            <div class="col-sm-6 col-lg-6">
                                <div class="input-group input-group-button input-group-primary">
                                    <select id="filter_type"  class="form-control" required name="filter_type" onchange="search_services(this.value)">
                                    <option value=""> Filter By</option>
                                        <option value="service_name">Service Name</option>
                                        <option value="category">Category</option>
                                        <option value="status">Status</option>
                                        <option value="show_all"> Show All</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-6" id="serach_type"  style="display:none">
                                <div class="input-group input-group-button input-group-primary">
                                    <select id="filter_category" class="form-control" required name="filter_category" onchange="filter_service()">
                                    <option value="">Select Category</option>
                                    <?php $rsCategory = Service::get_service_category();
                                            if (count($rsCategory) > 0) {
                                                foreach ($rsCategory as $key => $value) {?>
                                            <option value="<?php echo $value->id ?>" <?php if ($category_id == $value->id) {echo 'selected';}?> ><?php echo $value->category_name ?></option>
                                      <?php } } ?>
                                    </select>
                                    <button class="btn btn-primary input-group-addon" onclick="filter_service()">Search</button>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-6" id="service_status"  style="display:none">
                                <div class="input-group input-group-button input-group-primary">
                                    <select id="filter_status"  class="form-control" required name="filter_status" onchange="filter_service()">
                                    <option value="">Select Status</option>
                                    <option value="A">Active</option>
                                    <option value="I">InActive</option>
                                    </select>
                                    <button class="btn btn-primary input-group-addon" onclick="filter_service()">Search</button>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-6" id="search_box" style="display:none">
                                <div class="input-group input-group-button input-group-primary">
                                    <input type="text" id="filter_text" name="filter_text" class="form-control" onkeyup="filter_service()" placeholder="Search here...">
                                    <button class="btn btn-primary input-group-addon" onclick="filter_service()">Search</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Service</th>
                                        <th>Price</th>
                                        <th style="text-align:center">Action</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody class="service_body">
                                    <?php

                                    $statusArr = array('A' => 'checked', 'I' => '');
                                    $rsServices = Service::get_service();

                                    if (count($rsServices) > 0) {
                                        foreach ($rsServices as $key => $value) {
                                            ?>
                                    <tr class="row_id_<?php echo $value->id; ?>">
                                        <th><?php echo $key + 1 ?></th>
                                        <td><?php echo $value->service_name ?></td>
                                        <td><?php echo money($value->service_price, '$') ?></td>
                                        <td> <div class="btn-group " role="group" data-toggle="tooltip" data-placement="top" >
                                                <a href="javascript:void(0);" class="btn btn-primary btn-sm waves-effect waves-light" onclick="add_edit_service(<?php echo $value->id; ?>)" >Edit </a>
                                                <a href="javascript:void(0);" class="btn btn-primary btn-sm waves-effect waves-light" onclick="delete_service(<?php echo $value->id; ?>)" >Delete</a>
                                                <a href="javascript:void(0);" class="btn btn-primary btn-sm waves-effect waves-light" style="z-index: 999; color:#fff" onclick="add_service_features(<?php echo $value->id; ?>)" >Features</a>
                                                <a href="javascript:void(0);" class="btn btn-primary btn-sm waves-effect waves-light" onclick="add_service_faq(<?php echo $value->id; ?>)" >Faq</a>                                                                                                             
                                            </div>
                                        </td>
                                        <td>
                                        <label class="switch">
                                            <input type="checkbox" class="status_update_<?php echo $value->id; ?>" onchange="statusService(<?php echo $value->id; ?>)" <?php echo $statusArr[$value->status]; ?> >
                                            <span class="slider round"></span>
                                        </label>
                                        </td>
                                    </tr>
                                    <?php }} else {?>  <tr> <td colspan="5" class="text-center"> No Records Found. Click here to <a href="javascript:void(0);" onclick="add_edit_service()" style="color:#01a9ac"> Add New</a> </td>  </tr>  <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-5">
            <div class="z-depth-5 waves-effect" id="service_form" style="display:none;background-color:#fff">
            </div>
        </div>
    </div>
    <style>
        .error_class { border:1px solid #ff0000 !important; }
    </style>

<?php }include '../admin_template.php';?>