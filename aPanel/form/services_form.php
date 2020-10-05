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
    
    <div class="row">
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
    </div>
    <div class="row">
        <div class="card col-7" id="service_category_table">
            <div class="card-header bg-c-lite-green">
                <h5>Service Category List</h5>            
                <!-- <a href="javascript:void(0);" onclick="open_service_category()" class="btn btn-success right-float"><i class="icofont icofont-ui-add"> Add New</i></a> -->
            </div>
            <div class="card-block">
                <div class="table-responsive dt-responsive">
                    <table id="dt-service-category" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>                  
                                <th>Action</th>
                                <th>Status</th>
                            </tr>
                        </thead>               
                    </table>
                </div>
            </div>
        </div>
        
        <div class="card col-5" id="service_category_form" >
            <div class="card-header bg-c-lite-green">
                <h5>Service Category Form</h5>
                <!-- <a href="javascript:void(0);" onclick="close_service_category()" class="btn btn-success right-float"><i class="icofont icofont-document-search">View Table</i></a> -->
            </div>
            <div class="card-block">
                <form action="javascript:void(0);" id="service_category">
                    <input type="hidden" value="<?php echo SERVICE_CATEGORIES ?>" name="act">
                    <input type="hidden" value="" name="id">
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <label class="col-form-label">Category Name</label>
                            <div class="input-group input-group-inverse">
                                <span class="input-group-addon"><i class="icofont icofont-idea"></i></span>
                                <input type="text" class="form-control" placeholder="Enter Category Name" name="category_name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-12 col-lg-12">
                            <label class="col-form-label">Category Abbr</label>
                            <div class="input-group input-group-inverse">
                                <span class="input-group-addon"><i class="icofont icofont-queen"></i></span>
                                <input type="text" class="form-control" placeholder="Enter Category Abbr" name="category_abbr">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <label class="col-form-label">Category Description</label>
                            <div class="input-group input-group-inverse">
                                <span class="input-group-addon"><i class="icofont icofont-presentation"></i></span>
                                <textarea rows="5" cols="5" class="form-control" placeholder="Enter Category Description" name="category_description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row m-b-20">
                        <div class="ml-md-auto">
                            <input type="reset" class="btn btn-danger btn-skew">
                            <input type="submit" class="btn btn-primary btn-skew"  id="pnotify-callbacks" value="Submit">   
                        </div>                               
                    </div>            
                </form>
            </div>
        </div>  
    </div>

    <script>
            $("form#service_category").submit(function () {
                var formData = $('form#service_category').serialize();
                ajax({
                    a:"admin_ajax",
                    b:formData,
                    c:function(){},
                    d:function(data){
                        var records = JSON.parse(data)
                            if(records.result == 'Success'){
                                toastr.success('<h5>'+records.data+'</h5>');                  
                        }
                    }          
                });  
            });
    </script>
<?php } ?>

<?php if($_POST['act'] == SERVICES){  ?>  

    <div class="card borderless-card">
        <div class="card-block caption-breadcrumb">
            <div class="breadcrumb-header">
                <h5>Service</h5>
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
    
    <div class="row">
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
    </div>
    <div class="card" id="service_category_form" style="display:none">
        <div class="card-header bg-c-lite-green">
            <h5> Add Service Category</h5>
            <a href="javascript:void(0);" onclick="close_service_category()" class="btn btn-success right-float"><i class="icofont icofont-document-search">View Table</i></a>
        </div>
        <div class="card-block">
            <form action="javascript:void(0);" id="service_category">
                <input type="text" value="<?php echo SERVICE ?>" name="act">
                <input type="hidden" value="" name="id">
                <div class="row">
                    <label class="col-sm-4 col-lg-2 col-form-label">Category Name</label>
                    <div class="col-sm-8 col-lg-10">
                        <div class="input-group input-group-inverse">
                            <span class="input-group-addon"><i class="icofont icofont-idea"></i></span>
                            <input type="text" class="form-control" placeholder="Enter Category Name" name="category_name">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-4 col-lg-2 col-form-label">Category Abbr</label>
                    <div class="col-sm-8 col-lg-10">
                        <div class="input-group input-group-inverse">
                            <span class="input-group-addon"><i class="icofont icofont-queen"></i></span>
                            <input type="text" class="form-control" placeholder="Enter Category Abbr" name="category_abbr">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-4 col-lg-2 col-form-label">Category Description</label>
                    <div class="col-sm-8 col-lg-10">
                        <div class="input-group input-group-inverse">
                            <span class="input-group-addon"><i class="icofont icofont-presentation"></i></span>
                            <textarea rows="5" cols="5" class="form-control" placeholder="Enter Category Description" name="category_description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row m-b-20">
                    <div class="ml-md-auto">
                        <input type="reset" class="btn btn-danger btn-skew">
                        <input type="submit" class="btn btn-primary btn-skew"  id="pnotify-callbacks" value="Submit">   
                    </div>                               
                </div>            
            </form>
        </div>
    </div>
   
    <!-- Generated content for a column table start -->
    <div class="card" id="service_table">
        <div class="card-header bg-c-lite-green">
            <h5>Service Category List</h5>            
            <a href="javascript:void(0);" onclick="open_service_category()" class="btn btn-success right-float"><i class="icofont icofont-ui-add"> Add New</i></a>
        </div>
        <div class="card-block">
            <div class="table-responsive dt-responsive">
                <table id="dt-service-category" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Category Appr</th>
                            <th>Discription</th>
                            <th>Action</th>
                            <th>Status</th>
                        </tr>
                    </thead>               
                </table>
            </div>
        </div>
    </div>
    <!-- Generated content for a column table end -->
    <script>
            $("form#service").submit(function () {
                var formData = $('form#service').serialize();
                ajax({
                    a:"admin_ajax",
                    b:formData,
                    c:function(){},
                    d:function(data){
                        var records = JSON.parse(data)
                            if(records.result == 'Success'){
                                toastr.success('<h5>'+records.data+'</h5>');                  
                        }
                    }          
                });  
            });
    </script>


<?php } ?>
