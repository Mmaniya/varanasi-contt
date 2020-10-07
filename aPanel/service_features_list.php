<?php
include '../includes.php';
$serviceId = $_POST['service_id'];
$param = array('tableName' => TBL_SERVICE, 'fields' => array('*'), 'showSql' => 'N', 'condition' => array('id' => $serviceId . '-INT'));
$rsDtls = Table::getData($param);
foreach ($rsDtls as $K => $V) {
    $$K = $V;
} 
?>
 <div class="card" id="service_category_table">
		<div class="card-header bg-c-lite-green">
			<h5><?php echo $service_name; ?> Features </h5>
			<a href="javascript:void(0);" onclick="add_edit_features(<?php echo $serviceId;?>,0)" class="right-float" > Add New</a>&nbsp;&nbsp;
			<a href="javascript:void(0);" onclick="category_position()" class="right-float">Change Position &nbsp;&nbsp;</a>
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
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php
$param = array('tableName' => TBL_SERVICE_FEATURES, 'fields' => array('*'), 'showSql' => 'N', 'condition' => array('service_id' => $serviceId . '-INT'));
$rsFeatures = Table::getData($param);
if (count($rsFeatures) > 0) {
    foreach ($rsFeatures as $key => $value) {
        ?>
							<tr class="row_id_<?php echo $value->id; ?>">
								<th><?php echo $key + 1 ?></th>
								<td><?php echo $value->category_name ?></td>
								<td> <div class="btn-group " role="group" data-toggle="tooltip" data-placement="top" >
										<a href="javascript:void(0);" class="btn btn-primary btn-sm waves-effect waves-light" onclick="add_edit_features(<?php echo $serviceId;?>,<?php echo $serviceId;?>)" >Edit</a>
										<a href="javascript:void(0);" class="btn btn-primary btn-sm waves-effect waves-light" onclick="delete_category(<?php echo $value->id; ?>)" >Delete</a>
									</div>
								</td>
								<td>
								<label class="switch">
									<input type="checkbox" class="status_update_<?php echo $value->id; ?>" onchange="statusCategory(<?php echo $value->id; ?>)" <?php echo $statusArr[$value->status]; ?> >
									<span class="slider round"></span>
								</label>
								</td>
							</tr>
									<?php }} else {?>  <tr> <td colspan="4" class="text-center"> No Records Found. Click here to <a href="javascript:void(0);" onclick="add_edit_features(<?php echo $serviceId;?>,0)" style="color:#01a9ac"> Add New</a> </td>  </tr>  <?php }?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
	<script>
	function add_edit_features(service_id,feature_id) { 
	paramData = {'act':'service_features_list','feature_id':feature_id,'service_id':service_id};
	ajax({ 
		a:'add_edit_service_features',
		b:$.param(paramData),
		c:function(){},
		d:function(data){  		 
		 $('#right_sidebar').show();
		 $('#right_sidebar').html(data);
	}}); 
}
	
	</script>