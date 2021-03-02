<?php function main()
{

    // $param = array('tableName' => TBL_SERVICE_CATEGORIES, 'fields' => array('*'), 'condition' => array('status' => 'A-CHAR'), 'showSql' => 'N');
    // $rsCategory = Table::getData($param);

    // $param = array('tableName' => TBL_SERVICE, 'fields' => array('*'), 'condition' => array('status' => 'A-CHAR'), 'showSql' => 'N');
    // $rsServices = Table::getData($param);  ?>

<div class="row">
    <div class="col-xl-3 col-md-4">
        <div class="card bg-c-yellow update-card">
            <div class="card-block">
                <div class="row align-items-end">
                    <div class="col-12">
                        <h4 class="text-white"><?php echo count($rsCategory); ?> </h4>
                        <h6 class="text-white m-b-0">Total Booth</h6>
                    </div>   
                </div>
            </div>
            <div class="card-footer">
                <p class="text-white  m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : <?php echo  $rsCategory[0]->updated_date; ?> </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-4">
        <div class="card bg-c-green update-card">
            <div class="card-block">
                <div class="row align-items-end">
                    <div class="col-12">
                        <h4 class="text-white"><?php echo count($rsServices); ?> </h4>
                        <h6 class="text-white m-b-0">Total Voters</h6>
                    </div>       
                </div>
            </div>
            <div class="card-footer">
                <p class="text-white m-b-0"><i class="feather  icon-clock text-white f-14 m-r-10"></i>update : <?php echo  $rsServices[0]->updated_date; ?>
                </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-4">
        <div class="card bg-c-lite-green update-card">
            <div class="card-block">
                <div class="row align-items-end">
                    <div class="col-12">
                        <h4 class="text-white"><?php echo count($rsServices); ?> </h4>
                        <h6 class="text-white m-b-0">Total Voters</h6>
                    </div>       
                </div>
            </div>
            <div class="card-footer">
                <p class="text-white m-b-0"><i class="feather  icon-clock text-white f-14 m-r-10"></i>update : <?php echo  $rsServices[0]->updated_date; ?>
                </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-4">
        <div class="card bg-c-pink update-card">
            <div class="card-block">
                <div class="row align-items-end">
                    <div class="col-12">
                        <h4 class="text-white"><?php echo count($rsServices); ?> </h4>
                        <h6 class="text-white m-b-0">Total Voters</h6>
                    </div>       
                </div>
            </div>
            <div class="card-footer">
                <p class="text-white m-b-0"><i class="feather  icon-clock text-white f-14 m-r-10"></i>update : <?php echo  $rsServices[0]->updated_date; ?>
                </p>
            </div>
        </div>
    </div>
    <!-- <div id="ajaxResponce"></div> -->
</div>
<?php } include 'admin_template.php';?>