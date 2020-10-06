<?php require ("../../includes.php");  ?>


<?php  if($_POST['act'] == SERVICE_CATEGORIES){  ?>  

    <div class="card borderless-card">
        <div class="card-block caption-breadcrumb">
            <div class="breadcrumb-header">
                <h5>Service Category</h5>
            </div>
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="#!">
                            <i class="icofont icofont-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">Services</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <!-- <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-c-yellow update-card">
                <div class="card-block">
                    <div class="row align-items-end">
                        <div class="col-8">
                            <h4 class="text-white">$30200</h4>
                            <h6 class="text-white m-b-0">All Earnings</h6>
                        </div>
                        <div class="col-4 text-right">
                            <canvas id="update-chart-1" height="50"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : 2:15 am</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-c-green update-card">
                <div class="card-block">
                    <div class="row align-items-end">
                        <div class="col-8">
                            <h4 class="text-white">290+</h4>
                            <h6 class="text-white m-b-0">Page Views</h6>
                        </div>
                        <div class="col-4 text-right">
                            <canvas id="update-chart-2" height="50"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : 2:15 am</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-c-pink update-card">
                <div class="card-block">
                    <div class="row align-items-end">
                        <div class="col-8">
                            <h4 class="text-white">145</h4>
                            <h6 class="text-white m-b-0">Task Completed</h6>
                        </div>
                        <div class="col-4 text-right">
                            <canvas id="update-chart-3" height="50"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : 2:15 am</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-c-lite-green update-card">
                <div class="card-block">
                    <div class="row align-items-end">
                        <div class="col-8">
                            <h4 class="text-white">500</h4>
                            <h6 class="text-white m-b-0">Downloads</h6>
                        </div>
                        <div class="col-4 text-right">
                            <canvas id="update-chart-4" height="50"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : 2:15 am</p>
                </div>
            </div>
        </div>
    </div> -->
    <div class="row">
        <div class="card col-7" id="service_category_table">
            <div class="card-header">
                <h5>Service Category List</h5> 
                <a href="javascript:void(0);" onclick="add_edit_category()" class="right-float"> Add New</a>&nbsp;&nbsp;
                <a href="javascript:void(0);" onclick="category_position()" class="right-float">Click To Arrange Position &nbsp;&nbsp;</a>
            </div>
            <!-- <div class="card-block">
                <div class="table-responsive dt-responsive">
                    <table id="dt-service-category" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category</th>                  
                                <th>Action</th>
                                <th>Status</th>
                            </tr>
                        </thead>               
                    </table>
                </div>
            </div> -->
            <div class="card-block">
                <div class="card-block table-border-style">
                    <div class="table-responsive">
                        <table class="table table-styling">
                            <thead>
                                <tr class="table-primary">
                                    <th>#</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $rsCategory = Service::get_service_category();
                               
                                if(count($rsCategory)>0){
                                    foreach ($rsCategory as $key=>$value){
                                 ?>
                                <tr>
                                    <th><?php echo $key+1?></th>
                                    <td><?php echo $value->category_name ?></td>                      
                                    <td> <div class="btn-group " role="group" data-toggle="tooltip" data-placement="top" title="" data-original-title=".btn-xlg">
                                            <a href="javascript:void(0);" class="btn btn-primary btn-mini waves-effect waves-light" onclick="add_edit_category(<?php echo $value->id;?>)" >Edit</a>
                                            <?php if($value->status == 'A'){ ?>
                                            <a href="javascript:void(0);" class="btn btn-danger btn-mini waves-effect waves-light" onclick="statusCategory(<?php echo $value->id;?>,'I')">Change Inactive</a>
                                            <?php } else { ?>
                                            <a href="javascript:void(0);" class="btn btn-success btn-mini waves-effect waves-light" onclick="statusCategory(<?php echo $value->id;?>,'A')">Change Active</a>
                                            <?php } ?>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if($value->status == 'A'){ ?>
                                            <div class="label-main"><label class="label label-success">Active</label></div>
                                        <?php }else { ?>
                                                <div class="label-main"><label class="label label-danger">Inactive</label></div>
                                        <?php } ?>
                                    </td>
                                </tr>
                                    <?php } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card col-5" id="service_category_form" style="display:none">
        </div>
    </div>

    <?php  }  



  if($_POST['act'] == SERVICES){  ?>  

    <div class="card borderless-card">
        <div class="card-block caption-breadcrumb">
            <div class="breadcrumb-header">
                <h5>Our Services</h5>
            </div>
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="#!">
                            <i class="icofont icofont-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">Services</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <!-- <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-c-yellow update-card">
                <div class="card-block">
                    <div class="row align-items-end">
                        <div class="col-8">
                            <h4 class="text-white">$30200</h4>
                            <h6 class="text-white m-b-0">All Earnings</h6>
                        </div>
                        <div class="col-4 text-right">
                            <canvas id="update-chart-1" height="50"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : 2:15 am</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-c-green update-card">
                <div class="card-block">
                    <div class="row align-items-end">
                        <div class="col-8">
                            <h4 class="text-white">290+</h4>
                            <h6 class="text-white m-b-0">Page Views</h6>
                        </div>
                        <div class="col-4 text-right">
                            <canvas id="update-chart-2" height="50"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : 2:15 am</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-c-pink update-card">
                <div class="card-block">
                    <div class="row align-items-end">
                        <div class="col-8">
                            <h4 class="text-white">145</h4>
                            <h6 class="text-white m-b-0">Task Completed</h6>
                        </div>
                        <div class="col-4 text-right">
                            <canvas id="update-chart-3" height="50"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : 2:15 am</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-c-lite-green update-card">
                <div class="card-block">
                    <div class="row align-items-end">
                        <div class="col-8">
                            <h4 class="text-white">500</h4>
                            <h6 class="text-white m-b-0">Downloads</h6>
                        </div>
                        <div class="col-4 text-right">
                            <canvas id="update-chart-4" height="50"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : 2:15 am</p>
                </div>
            </div>
        </div>
    </div> -->
    <div class="row">
        <div class="card col-7">
            <div class="card-header">
                <h5>Service List</h5>            
                <a href="javascript:void(0);" onclick="add_edit_service()" class="right-float">Add New</a>
                <a href="javascript:void(0);" onclick="service_position()" class="right-float">Click To Arrange Position &nbsp;&nbsp;</a>
            </div>
            <!-- <div class="card-block">
                <div class="table-responsive dt-responsive">
                    <table id="dt-service" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Service</th>                  
                                <th>Price</th>
                                <th>Action</th>
                                <th>Status</th>
                            </tr>
                        </thead>               
                    </table>
                </div>
            </div> -->
            <div class="card-block">
                <div class="card-block table-border-style">
                    <div class="table-responsive">
                        <table class="table table-styling">
                            <thead>
                                <tr class="table-primary">
                                    <th>#</th>
                                    <th>Service</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $rsServices = Service::get_service();
                               
                                if(count($rsServices)>0){
                                    foreach ($rsServices as $key=>$value){
                                 ?>
                                <tr>
                                    <th><?php echo $key+1?></th>
                                    <td><?php echo $value->service_name ?></td>  
                                    <td><?php echo $value->service_price ?></td>                                          
                                    <td> <div class="btn-group " role="group" data-toggle="tooltip" data-placement="top" title="" data-original-title=".btn-xlg">
                                            <a href="javascript:void(0);" class="btn btn-primary btn-mini waves-effect waves-light" onclick="add_edit_service(<?php echo $value->id;?>)" >Edit</a>
                                            <?php if($value->status == 'A'){ ?>
                                            <a href="javascript:void(0);" class="btn btn-danger btn-mini waves-effect waves-light" onclick="statusService(<?php echo $value->id;?>,'I')">Change Inactive</a>
                                            <?php } else { ?>
                                            <a href="javascript:void(0);" class="btn btn-success btn-mini waves-effect waves-light" onclick="statusService(<?php echo $value->id;?>,'A')">Change Active</a>
                                            <?php } ?>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if($value->status == 'A'){ ?>
                                            <div class="label-main"><label class="label label-success">Active</label></div>
                                        <?php }else { ?>
                                                <div class="label-main"><label class="label label-danger">Inactive</label></div>
                                        <?php } ?>
                                    </td>
                                </tr>
                                    <?php } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card col-5" id="service_form" style="display:none">
        </div>
    </div>

<?php } ?>
