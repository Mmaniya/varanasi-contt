<?php  function main() { 
    
    $param = array('tableName'=>TBL_SERVICE_CATEGORIES,'fields'=>array('*'),'condition'=>array('status'=>'A-CHAR'),'showSql'=>'N',);
    $rsCategory = Table::getData($param);

    $param = array('tableName'=>TBL_SERVICE,'fields'=>array('*'),'condition'=>array('status'=>'A-CHAR'),'showSql'=>'N',);
    $rsServices = Table::getData($param);
    
    ?> 
    <div class="row">
        <!-- task, page, download counter  start -->
        <div class="col-xl-3 col-md-4">
                <div class="card bg-c-yellow update-card">
                    <div class="card-block">
                        <div class="row align-items-end">
                            <div  class="col-8">
                                <h4 class="text-white"><?php echo count($rsCategory);?> </h4>
                                <h6 class="text-white m-b-0">Total Category</h6>
                            </div>
                            <div class="col-4 text-right">
                                <canvas id="update-chart-1" height="50"></canvas>
                            </div>
                        </div>
                    </div>
                    <div
                        class="card-footer">
                        <p class="text-white  m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : 2:15 am</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-4">
                <div class="card bg-c-green update-card">
                    <div class="card-block">
                        <div class="row align-items-end">
                            <div class="col-8">
                            <h4 class="text-white"><?php echo count($rsServices);?> </h4>
                                <h6 class="text-white m-b-0">Total Services</h6>
                            </div>
                            <div  class="col-4 text-right">
                                <canvas  id="update-chart-2" height="50"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <p class="text-white m-b-0"><i class="feather  icon-clock text-white f-14 m-r-10"></i>update : 2:15 am</p>
                    </div>
                </div>
            </div>                                          
    <!-- <div id="ajaxResponce"></div> -->
</div>
<?php } include 'admin_template.php'; ?>
 