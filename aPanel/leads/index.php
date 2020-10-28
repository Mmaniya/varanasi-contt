<?php function main() { ?>
   
   <div class="card borderless-card">
        <div class="card-block warning-breadcrumb">
            <div class="breadcrumb-header">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item"><a href="<?php echo ADMIN_URL ?>/dashboard.php"> <i class="fa fa-home"></i>
                            Dashboard</a> </li>
                    <li class="breadcrumb-item"><a href="<?php echo LEADS_DIR ?>/index.php">Leads</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div id="leads_statistics"></div>

    <div class="row ajaxResponce">
        <div class="col-7">
            <div class="card" id="leads_table">
            </div>
        </div>
        <div class="col-5">
            <div class="waves-effect" id="leads_form" style="display:show; background-color: rgb(255, 255, 255);"> 
            </div>
        </div>
    </div>

    <div class="row leads_forms">
        <div class="col-12">
            <div class="card" id="leads_details">
            </div>
        </div>
    </div>


   
<?php } include '../admin_template.php'; ?>