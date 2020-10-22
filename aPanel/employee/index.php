<?php function main() { ?>
   
   <!-- <div id="employess_statistics"></div>   -->
   <div class="card borderless-card">
        <div class="card-block warning-breadcrumb">
            <div class="breadcrumb-header">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item"><a href="<?php echo ADMIN_URL ?>/dashboard.php"> <i class="fa fa-home"></i>
                            Dashboard</a> </li>
                    <li class="breadcrumb-item"><a href="<?php echo EMPLOYEE_DIR ?>/index.php">Employees</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div id="employee_statistics"></div>

    <div class="row ajaxResponce">
        <div class="col-7">
            <div class="card" id="employee_table">
            </div>
        </div>
        <div class="col-5">
            <div class="waves-effect" id="employee_form" style="display:show; background-color: rgb(255, 255, 255);"> 
            </div>
        </div>
    </div>

    <div class="row emp_form">
        <div class="col-12">
            <div class="card" id="employee_details">
            </div>
        </div>
    </div>


   
<?php }include '../admin_template.php';?>