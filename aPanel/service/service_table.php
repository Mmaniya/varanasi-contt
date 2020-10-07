
<?php define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php";
$action = $_POST['act'];

if ($action == 'show_category_service_list') {
    $category_id = $_POST['category_id'];
	$param = array('tableName' => TBL_SERVICE_CATEGORIES, 'fields' => array('*'), 'condition' =>array('id' => $category_id . '-INT', 'showSql' => 'N'));
	$rsCategory = Table::getData($param);
    ?>
	<div id="category_service_table">
	   <div class="card">
                <div class="card-header bg-c-lite-green">
                    <h5><?php  echo $rsCategory->category_name;?> Services</h5>
					
                    <a href="javascript:void(0);" onclick="add_edit_service_frm_category('',<?php  echo $rsCategory->id;?>)" class="right-float ">Add New</a> 
                    <a href="javascript:void(0);" onclick="service_category_position(<?php echo $category_id;?>)" class="right-float ">Change Position &nbsp;&nbsp; </a>
                </div>
                <div class="card-block">
                    <div class="card-block table-border-style">                     
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Service</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody class="service_body">
									<?php
									$statusArr = array('A' => 'checked', 'I' => ''); 									 
									$param = array('tableName' => TBL_SERVICE, 'fields' => array('*'), 'condition' =>array('category_id' => $category_id . '-INT', 'showSql' => 'Y'),'orderby'=>'position', 'sortby'=>'asc');
									$rsServices = Table::getData($param);
									if (count($rsServices) > 0) {
									foreach ($rsServices as $key => $value) {
                                   ?>
                                    <tr class="row_id_<?php echo $value->id; ?>">
                                        <th><?php echo $key + 1 ?></th>
                                        <td><?php echo $value->service_name ?></td>
                                        <td><?php echo money($value->service_price, '$') ?></td>
                                        <td> <div class="btn-group " role="group" data-toggle="tooltip" data-placement="top" >
                                                <a href="javascript:void(0);" class="btn btn-primary btn-sm waves-effect waves-light" onclick="add_edit_service_frm_category(<?php echo $value->id.','.$value->category_id; ?>)" >Edit </a>
                                                <a href="javascript:void(0);" class="btn btn-primary btn-sm waves-effect waves-light" onclick="delete_service(<?php echo $value->id; ?>)" >  Delete</a>
                                            </div>
                                        </td>
                                        <td>
                                        <label class="switch">
                                            <input type="checkbox" class="status_update_<?php echo $value->id; ?>" onchange="statusService(<?php echo $value->id; ?>)" <?php echo $statusArr[$value->status]; ?> >
                                            <span class="slider round"></span>
                                        </label>
                                        </td>
                                    </tr>
                                    <?php }} else {?>  <tr> <td colspan="5" class="text-center"> No Records Found. Click here to <a href="javascript:void(0);" onclick="add_edit_service_frm_category('',<?php  echo $rsCategory->id;?>)" style="color:#01a9ac"> Add New</a> </td>  </tr>  <?php }?>
                                </tbody>
                            </table>						
                        </div> 	<a href="javascript:void(0);" class="btn btn-danger btn-sm" onclick="close_form_table()" class="right-float ">Close</a>
                    </div>
                </div>
            </div>
        </div>
	</div>	
		 <script>
		function close_form_table() {  $('#service_category_form').hide();
			 $('#service_category_form').html('');
		 }
		 </script>
<?php } ?>

<?php if ($action == 'service_features_table') {
    $service = Service::service_category($_POST['service_id']);
    ?>
    <div class="card" id="service_category_table">
        <div class="card-header bg-c-lite-green">
            <h5><?php echo $service->service_name; ?> Features </h5>
            <a href="javascript:void(0);" onclick="add_edit_features(<?php echo $_POST['service_id']; ?>,'')" class="right-float" > Add New</a>&nbsp;&nbsp;
            <a href="javascript:void(0);" onclick="features_position()" class="right-float">Change Position &nbsp;&nbsp;</a>
        </div>
        <div class="card-block">
            <div class="card-block table-border-style">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Features</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $param = array('tableName' => TBL_SERVICE_FEATURES, 'fields' => array('*'), 'showSql' => 'N', 'condition' => array('service_id' => $_POST['service_id'] . '-INT'));
                                $rsFeatures = Table::getData($param);
                                if (count($rsFeatures) > 0) {
                                    foreach ($rsFeatures as $key => $value) {
                                        ?>
                            <tr class="row_id_<?php echo $value->id; ?>">
                                <th><?php echo $key + 1 ?></th>
                                <td><?php echo $value->title ?></td>
                                <td> <div class="btn-group " role="group" data-toggle="tooltip" data-placement="top" >
                                        <a href="javascript:void(0);" class="btn btn-primary btn-sm waves-effect waves-light" onclick="add_edit_features(<?php echo $value->service_id; ?>,<?php echo $value->id; ?>)" >Edit</a>
                                        <a href="javascript:void(0);" class="btn btn-primary btn-sm waves-effect waves-light" onclick="delete_feature(<?php echo $value->id; ?>,<?php echo $value->service_id; ?>)" >Delete</a>
                                    </div>
                                </td>
                            </tr>
                                <?php }} else {?>  <tr> <td colspan="4" class="text-center"> No Records Found. Click here to <a href="javascript:void(0);" onclick="add_edit_features(<?php echo $_POST['service_id']; ?>,0)" style="color:#01a9ac"> Add New</a> </td>  </tr>  <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php }?>