<?php function main() { ?>

    <div class="card borderless-card">
        <div class="card-block info-breadcrumb">
            <div class="breadcrumb-header">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item"><a href="<?php echo ADMIN_URL ?>/dashboard.php"> <i class="fa fa-home"></i>
                            Dashboard</a> </li>
                    <li class="breadcrumb-item"><a href="<?php echo CLIENTS_DIR ?>/index.php">Clients</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div id="clients_statistics"></div>

    
    <div class="row ajaxResponce">
        <div class="col-7">
            <div class="card" id="clients_table">
            </div>
        </div>
        <div class="col-5">
            <div class="waves-effect" id="clients_form" style="display:show; background-color: rgb(255, 255, 255);"> 
            </div>
        </div>
    </div>

    <div class="row clients_form">
        <div class="col-12">
            <div class="card" id="clients_details">
            </div>
        </div>
    </div>


<?php }include '../admin_template.php';?>