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

    <script>  tinymce.remove();  tinymce.init(); </script>
    
    <div class="card-header bg-c-lite-green">
        <h5 class="card-header-text"><?php echo $btnName ?> Service Categories</h5>
        <a href="javascript:void(0);" onclick="hide_category_form()" class="right-float label label-danger">Cancel</a>
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

        $(document).ready(function () {
            tinymce.init({
                selector: '#category_description',
                height: 200,
                theme: 'modern',
                // plugins: [
                //     'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                //     'searchreplace wordcount visualblocks visualchars code fullscreen',
                //     'insertdatetime media nonbreaking save table contextmenu directionality',
                //     'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
                // ],
                toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
                // toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
                image_advtab: true
            });
        });

    </script>
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
                            <p class="m-b-5">New Customer</p>
                            <h4 class="m-b-0">852</h4>
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
                            <p class="m-b-5">Work In Progress</p>
                            <h4 class="m-b-0"><?php  $categoryObj->id = $_POST['id']; $rsCount =  $categoryObj->get_wrk_in_progress_category(); echo $rsCount->total; ?></h4>
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
                            <p class="m-b-5">Add Service</p>
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

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="sub-title"><?php echo $category_name; ?> Discription</h5>
                </div>
                <div class="card-block">
                      <?php echo $category_description; ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


