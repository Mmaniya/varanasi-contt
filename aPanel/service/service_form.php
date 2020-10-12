<?php 
define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php";
$action = $_POST['act']; ?>


<?php if ($action == 'category_draggable') {?>

        <div class="card">
            <div class="card-header bg-c-lite-green">
                <h5 class="card-header-text">Repositioning Category List</h5>

            </div>
            <div class="card-block">
                <div class="row">
                <form action="javascript:void(0);" id="category_position" style="width:100%">
                    <input type="hidden" name="act" value="category_position">
                    <div class="col-md-12">
                    <div  id="draggableMultiple">
                            <?php $rsCategory = Service::get_service_category();
                                $sno = 0;
                                if (count($rsCategory) > 0) {
                                    foreach ($rsCategory as $key => $value) {
                                        if ($value->status == 'A') {?>
                                    <div class="sortable-moves" style="padding:10px;margin-bottom:10px;">
                                        <p style="margin:0px;"><?php echo $sno + 1; ?>.<?php echo $value->category_name ?></p>
                                        <input type="hidden" name="category_id[]" value="<?php echo $value->id ?>">
                                    </div>
                            <?php $sno++;}}}?>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            $( document ).ready(function() {
                    Sortable.create(draggableMultiple, {
                    group: 'draggableMultiple',
                    animation: 150
                });
            });
            $("form#category_position").submit(function () {
                var formData = $('form#category_position').serialize();
                ajax({
                    a:"service_ajax",
                    b:formData,
                    c:function(){},
                    d:function(data){
                        var records = JSON.parse(data);
                        if(records.result == 'Success'){
                            // toastr.success('<h5>'+records.data+'</h5>');
                            $('#service_category_form').hide();
                            $("#service_category_table").load(location.href + " #service_category_table>*", "");
                               notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                            } else {
                                notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                            }      
                        }
                    }
                });
            });

        </script>
<?php }?>

<?php if ($action == 'add_edit_service_form') {
    $serviceId = $_POST['id'];
    $btnName = $title = 'Add New';
	$category_id = $_POST['category_id'];
    $joined_date = '';
    if ($serviceId > 0) {
        $param = array('tableName' => TBL_SERVICE, 'fields' => array('*'), 'condition' => array('id' => $serviceId . '-INT'), 'showSql' => 'N');
        $rsService = Table::getData($param);
        foreach ($rsService as $K => $V) {
            $$K = $V;
        }
        $btnName = $title = 'Edit ';
    }?>

            <div class="card-header bg-c-lite-green">
                <h5 class="card-header-text"><?php echo $btnName ?> Service </h5>
                <a href="javascript:void(0);" onclick="hide_category_form()" class="right-float label label-danger">Cancel</a>
            </div>
            <div class="card-block">
                <form action="javascript:void(0);" id="our_service" enctype="multipart/form-data" >
                    <input type="hidden" value="services" name="act">
                    <input type="hidden"  name="id" value="<?php echo $id; ?>">
                    <input type="hidden"  name="access_level" value="<?php echo $_SESSION['access_level']; ?>">

                    <div class="row">
                        <div class="col-sm-6 col-lg-6">
                            <label class="col-form-label">Select Category</label>
                            <div class="input-group input-group-inverse">
                              
                                <select  class="form-control" required name="category_id" id="category_id">
                                    <option value="">Select Category</option>
                                    <?php $rsCategory = Service::get_service_category();
                                        if (count($rsCategory) > 0) {
                                            foreach ($rsCategory as $key => $value) {
                                                if ($value->status == 'A') {?>
                                            <option value="<?php echo $value->id ?>" <?php if ($category_id == $value->id) {echo 'selected';}?> ><?php echo $value->category_name ?></option>
                                      <?php } } }   ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-6">
                            <label class="col-form-label">Service Name</label>
                            <div class="input-group input-group-inverse">
                                <input type="text" class="form-control" placeholder="Enter Service Name" name="service_name" required value="<?php echo $service_name; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <label class="col-form-label">Service Image</label>
                            <div class="input-group input-group-inverse">
                                <input type="file" class="form-control" name="service_img"  value="<?php echo $service_img; ?>">
                            </div>
                            <?php if (!empty($service_img)) {?>
                                <img src="<?php echo SERVICE_IMAGES . $service_img; ?>" alt="Service Images" width="100" height="100">
                            <?php }?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-lg-6">
                            <label class="col-form-label">Service Payment Type</label>
                            <div class="input-group input-group-inverse">
                                <select  class="form-control" required name="service_payment_type" onchange="service_payment(this.value)">
                                    <option value="onetime" <?php if ($service_payment_type == 'onetime') {echo 'selected';}?>>One Time</option>
                                    <option value="recurring" <?php if ($service_payment_type == 'recurring') {echo 'selected';}?>>Recurring</option>
                                </select>
                            </div>
                        </div>
                        <?php  if($service_payment_type=='recurring') { ?> <script> service_payment('recurring'); </script> <?php } ?>
            
                        <div class="col-sm-6 col-lg-6">
                            <label class="col-form-label">Service Price	</label>
                            <div class="input-group ">
                                <input type="number" class="form-control" placeholder="Price" name="service_price" value="<?php echo $service_price; ?>">
                                <span class="input-group-addon" id="basic-addon3">$</span>
                            </div>
                        </div>
                    </div>
                    <div class="row" id='recurring_period' style="display:none">
                        <div class="col-sm-6 col-lg-6">
                            <label class="col-form-label">Recurring Period</label>
                            <div class="input-group input-group-inverse">

                                <input type="text" class="form-control" placeholder="Recurring Period" name="if_recurring_period" value="<?php echo $if_recurring_period; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-6">
                            <label class="col-form-label">Recurring Type</label>
                            <div class="input-group input-group-inverse">

                                <select class="form-control" name="recurring_type">
                                    <option value="weekly"  <?php if ($recurring_type == 'weekly') {echo 'selected';}?> >Weekly</option>
                                    <option value="bi_weekly" <?php if ($recurring_type == 'bi_weekly') {echo 'selected';}?> >Bi Weekly</option>
                                    <option value="monthly" <?php if ($recurring_type == 'monthly') {echo 'selected';}?> >Monthly</option>
                                    <option value="yearly" <?php if ($recurring_type == 'yearly') {echo 'selected';}?> >Yearly</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row" >
                        <div class="col-sm-6 col-lg-6">
                            <label class="col-form-label">Delivery Time</label>
                            <div class="input-group input-group-inverse">

                                <input type="number" class="form-control" placeholder="Delivery Time" name="service_delivery_time" value="<?php echo $service_delivery_time; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-6">
                            <label class="col-form-label">Delivery Type</label>
                            <div class="input-group input-group-inverse">

                                <select class="form-control" name="service_delivery_type">
                                    <option value="day" <?php if ($service_delivery_type == 'day') {echo 'selected';}?> >Day</option>
                                    <option value="week" <?php if ($service_delivery_type == 'week') {echo 'selected';}?> >Week</option>
                                    <option value="month" <?php if ($service_delivery_type == 'month') {echo 'selected';}?> >Month</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row" >
                        <div class="col-sm-12 col-lg-12">
                            <label class="col-form-label">Service Questionnaire Complete Days</label>
                            <div class="input-group input-group-inverse">

                                <input type="text" class="form-control" placeholder="Service Questionnaire Complete Days" name="service_questionnaire_complete_days" value="<?php echo $service_questionnaire_complete_days; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <label class="col-form-label">Service Description</label>
                            <div class="input-group input-group-inverse">
                                <textarea rows="5" cols="5" class="form-control"  required name="service_description"><?php echo $service_description; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <input type="submit" class="btn btn-primary col-4 mr-auto" value="Submit">
                       </div>
                    </div>
                </form>
            </div>
            <script>
            $("form#our_service").submit(function () {
                // var formData = $('form#our_service').serialize();
                var formData = new FormData(this);
                $.ajax({
                    url: 'service_ajax.php',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data){
                        var records = JSON.parse(data);
                        if(records.result == 'Success'){
                            // toastr.success('<h5>'+records.data+'</h5>');
                            $('#service_form').hide();
                            $("#service_table").load(location.href + " #service_table>*", "");
                            category_service_list($('#category_id').val());
                                 notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                            } else {
                                notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                            } 
                        }                    
                });
            });

    </script>
    <!-- <script src="<?php echo ADMIN_JS ?>/tinymce/tinymce.custom.js"></script> -->
<?php }?>

<?php if ($action == 'service_draggable') { ?>

    <div class="card">
        <div class="card-header bg-c-lite-green">
            <h5 class="card-header-text"> Repositioning Service List</h5>
        </div>
        <div class="card-block">
            <div class="row">
            <form action="javascript:void(0);" id="service_position" style="width:100%">
                <input type="hidden" name="act" value="service_position">
                <div class="col-md-12">
                    <div id="draggableMultiple">
                        <?php $rsCategory = Service::get_service();
                                    $sno = 0;
                                    if (count($rsCategory) > 0) {
                                        foreach ($rsCategory as $key => $value) {
                                            if ($value->status == 'A') {  ?>
                                   <div class="sortable-moves" style="padding:10px;margin-bottom:10px;">
                                        <p style="margin:0px;"><?php echo $sno + 1; ?>.<?php echo $value->service_name ?></p>
                                    <input type="hidden" name="service_id[]" value="<?php echo $value->id ?>">
                                </div>
                        <?php $sno++;}}}?>

                    </div>
                        <input type="submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $( document ).ready(function() {
                Sortable.create(draggableMultiple, {
                group: 'draggableMultiple',
                animation: 150
            });
        });
        $("form#service_position").submit(function () {
            var formData = $('form#service_position').serialize();
            ajax({
                a:"service_ajax",
                b:formData,
                c:function(){},
                d:function(data){
                    var records = JSON.parse(data);
                    if(records.result == 'Success'){
                        // toastr.success('<h5>'+records.data+'</h5>');
                        $('#service_form').hide();
                        $("#service_table").load(location.href + " #service_table>*", "");
                            notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                        } else {
                            notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                        } 
                    }
                }
            });
        });

    </script>
<?php } ?>

<?php if ($action == 'service_category_draggable') { 
    $service_id =  $_POST['service_id']; 
	
	$param = array('tableName' => TBL_SERVICE, 'fields' => array('*'), 'condition' =>array('id' => $service_id . '-INT', 'showSql' => 'N'));
	$rsDtls = Table::getData($param);
	?>

    <div class="card">
        <div class="card-header bg-c-lite-green">
            <h5 class="card-header-text"> <?php echo $rsDtls->service_name;?> - Reposition  </h5>

        </div>
        <div class="card-block">
            <div class="row">
            <form action="javascript:void(0);" id="service_position" style="width:100%">
                <input type="hidden" name="act" value="feature_position">
                <div class="col-md-12">
                    <div id="draggableMultiple">
                        <?php  
 
		$param = array('tableName' => TBL_SERVICE_FEATURES, 'fields' => array('*'), 'showSql' => 'N', 'condition' => array('service_id' => $_POST['service_id'] . '-INT'),'orderby'=>'position', 'sortby'=>'asc');
		$rsFeatures = Table::getData($param);
                                    $sno = 0;
                                    if (count($rsFeatures) > 0) {
                                        foreach ($rsFeatures as $key => $value) {
                                            if ($value->status == 'A') {

                                                ?>
                                   <div class="sortable-moves" style="padding:10px;margin-bottom:10px;">
                                        <p style="margin:0px;"><?php echo $sno + 1; ?>.<?php echo $value->title; ?></p>
                                    <input type="hidden" name="features_id[]" value="<?php echo $value->id ?>">
                                </div>
                        <?php $sno++;}}}?>

                    </div>
                      
                    </div> 
					 <div class="col-md-12"> 
					 <input type="submit" class="btn btn-primary btn-sm" value="Update Position">
					 
					 <button class="btn btn-danger btn-sm  float-right" type="button" onclick="close_cat_service()">Close   </button>  
					 <button class="btn btn-primary btn-sm float-right" style="margin-right:10px;"  onclick="add_service_features(<?php echo $service_id;?>">Back to Service List</button>    &nbsp; &nbsp;</div>
                </form>
            </div>
        </div>
    </div>
    <script>
	function close_cat_service() {
		$('#service_form').hide();
		$('#service_form').html('');
	}
        $( document ).ready(function() {
                Sortable.create(draggableMultiple, {
                group: 'draggableMultiple',
                animation: 150
            });
        });
        $("form#service_position").submit(function () {
            var formData = $('form#service_position').serialize();
            ajax({
                a:"service_ajax",
                b:formData,
                c:function(){},
                d:function(data){
                    var records = JSON.parse(data);
                    if(records.result == 'Success'){
                        // toastr.success('<h5>'+records.data+'</h5>');
                        $('#service_form').hide();
                        $("#service_table").load(location.href + " #service_table>*", "");
                        add_service_features(<?php echo $service_id;?>);
                            notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                        } else {
                            notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                        } 
                    }
                }
            });
        });

    </script>
<?php } ?>

<?php if($action == 'service_features_list'){ 
    $feature_id = $_POST['feature_id'];

        $rsDtls = Service::service_features($_POST['feature_id']);

        foreach ($rsDtls as $K => $V) {$$K = $V;}
        $service_id = $_POST['service_id'];
        $rsService = Service::service_tbl($service_id); ?>
        
		<div class="card-header bg-c-lite-green">
			<h5>Add New <?php echo $rsService->service_name; ?> Features</h5>
			<!-- <a href="javascript:void(0);" onclick="close_service_category()" class="btn btn-success right-float"><i class="icofont icofont-document-search">View Table</i></a> -->
		</div>
            <div class="card-block">
                <form action="javascript:void(0);" id="service_features_form">
                    <input type="hidden"  name="id" value="">

					<?php if ($feature_id == '') {?>
 					<div class="row" id="appeded_column"></div>	<?php } else {?>
						 <div class="col-sm-12 col-lg-12">
							 <label class="col-form-label">Features</label>
								 <div class="input-group input-group-inverse">
								 <input type="text" class="form-control" placeholder="Enter Features" required name="title" value="<?php echo $title; ?>">
								 <input type="hidden" name="feature_id" value="<?php echo $id; ?>"/>
							 </div>
						 </div>
					<?php }?>
						<input type="hidden" name="service_id" id="service_id" value="<?php echo $service_id; ?>">
						<input type="hidden" name="act" value="submit_service_features">
					 <div class="row">
						<div class="col-sm-6 col-lg-6">
							 <button type="submit"  class="btn btn-primary btn-sm">Submit</button>
						</div>

					        <?php if ($feature_id == '') {?>	<div class="col-sm-6 col-lg-6">
							 <button class="btn btn-primary btn-sm float-right" type="button" onclick="add_more_fields()">Add More</button>
						</div>
					<?php }?>
                    </div>
                </form>
            </div>

            <script>

			x=0;
			add_more_fields();
			function add_more_fields() {

				html ='<div class="col-sm-12 col-lg-12" id="column_'+x+'">';
                html+='<label class="col-form-label">Features</label>';
                html+='<div class="input-group input-group-inverse"> ';
                html+='<input type="text" class="form-control" placeholder="Enter Features" required name="title[]"><span class="input-group-addon" id="basic-addon3"onclick="removeRow('+x+')"><i class="icofont icofont-minus"></i></span> ';
                html+='</div>';
                html+='</div>';

				 $('#appeded_column').append(html);
				 x++;
			}
			function removeRow(id) {  if(x==1) {  return;   }  x--;	 $('#column_'+id).remove();  }
            $("form#service_features_form").submit(function () {
                var formData = $('form#service_features_form').serialize();
                ajax({
                    a:"service_ajax",
                    b:formData,
                    c:function(){},
                    d:function(data){
                        add_service_features($('#service_id').val());
                        var records = JSON.parse(data);
                        if(records.result == 'Success'){
                            // toastr.success('<h5>'+records.data+'</h5>');
                            $('#service_category_form').hide();
                            $("#service_category_table").load(location.href + " #service_category_table>*", "");
                                 notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                            } else {
                                notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                            } 
                        }
                    }
                });
            });
    </script>
<?php } ?>

<?php if ($action == 'features_draggable') { 
    $service_id =  $_POST['service_id']; 
	
	$param = array('tableName' => TBL_SERVICE, 'fields' => array('*'), 'condition' =>array('id' => $service_id . '-INT', 'showSql' => 'N'));
	$rsDtls = Table::getData($param);
	?>

    <div class="card">
        <div class="card-header bg-c-lite-green">
            <h5 class="card-header-text"> <?php echo $rsDtls->category_name;?> - Reposition  </h5>

        </div>
        <div class="card-block">
            <div class="row">
            <form action="javascript:void(0);" id="service_position" style="width:100%">
                <input type="hidden" name="act" value="service_position">
                <div class="col-md-12">
                    <div id="draggableMultiple">
                        <?php  
						           $param = array('tableName' => TBL_SERVICE, 'fields' => array('*'), 'condition' =>array('category_id' => $category_id . '-INT', 'showSql' => 'N'),'orderby'=>'position', 'sortby'=>'asc');
									$rsCategory = Table::getData($param);
                                    $sno = 0;
                                    if (count($rsCategory) > 0) {
                                        foreach ($rsCategory as $key => $value) {
                                            if ($value->status == 'A') {

                                                ?>
                                   <div class="sortable-moves" style="padding:10px;margin-bottom:10px;">
                                        <p style="margin:0px;"><?php echo $sno + 1; ?>.<?php echo $value->service_name ?></p>
                                    <input type="hidden" name="service_id[]" value="<?php echo $value->id ?>">
                                </div>
                        <?php $sno++;}}}?>

                    </div>
                      
                    </div> 
					 <div class="col-md-12"> 
					 <input type="submit" class="btn btn-primary btn-sm" value="Update Position">
					 
					 <button class="btn btn-danger btn-sm  float-right" type="button" onclick="close_cat_service()">Close   </button>  
					 <button class="btn btn-primary btn-sm float-right" style="margin-right:10px;"  onclick="category_service_list(<?php echo $category_id; ?>)">Back to Service List</button>    &nbsp; &nbsp;</div>
                </form>
            </div>
        </div>
    </div>
    <script>
	function close_cat_service() {
		$('#service_category_form').hide();
		$('#service_category_form').html('');
	}
        $( document ).ready(function() {
                Sortable.create(draggableMultiple, {
                group: 'draggableMultiple',
                animation: 150
            });
        });
        $("form#service_position").submit(function () {
            var formData = $('form#service_position').serialize();
            ajax({
                a:"service_ajax",
                b:formData,
                c:function(){},
                d:function(data){
                    var records = JSON.parse(data);
                    if(records.result == 'Success'){
                        // toastr.success('<h5>'+records.data+'</h5>');
                        $('#service_form').hide();
                        $("#service_table").load(location.href + " #service_table>*", "");
                        category_service_list(<?php echo $category_id;?>);
                            notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                        } else {
                            notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                        } 
                    }
                }
            });
        });

    </script>
<?php } ?>

<?php if ($action == 'service_faq_list') {
    $faq_id = $_POST['faq_id'];
    $label = 'Add New';
    $rsDtls = Service::service_faq($_POST['faq_id']);
    foreach ($rsDtls as $K => $V) {$$K = $V;}
    $service_id = $_POST['service_id'];
    $rsService = Service::service_tbl($service_id);
    $service_id = $_POST['service_id'];

    $param = array('tableName' => TBL_SERVICE, 'fields' => array('*'), 'condition' => array('id' => $service_id . '-INT', 'showSql' => 'N'));
    $rsService = Table::getData($param);

    if($faq_id!='') {  $label = 'Edit'; }
    ?>

		<div class="card-header bg-c-lite-green">
			<h5>  <?php echo $label.' '.$rsService->service_name; ?> Faq</h5>
			<!-- <a href="javascript:void(0);" onclick="close_service_category()" class="btn btn-success right-float"><i class="icofont icofont-document-search">View Table</i></a> -->
		</div>
            <div class="card-block">
                <form action="javascript:void(0);" id="service_faq_form">
                    <input type="hidden"  name="id" value="">

					<?php if ($faq_id == '') {?>
 					<div  id="appeded_column"></div>	<?php } else {?>
						 <div class="col-sm-12 col-lg-12">		  <label class="col-form-label">Question</label> 				 
								 <div class="input-group input-group-inverse">
                                   
                                    <textarea class="form-control" placeholder="Enter Question" required name="question"><?php echo $question; ?></textarea>                                   
							 </div>
                         </div>
                         	 <div class="col-sm-12 col-lg-12">	
                                    <label class="col-form-label">Answer</label> 
                                   <div class="input-group input-group-inverse">	                  
                    <textarea class="form-control" placeholder="Enter Answer" required name="answer"><?php echo $answer; ?></textarea>
                    <input type="hidden" name="faq_id" value="<?php echo $id; ?>"/>
                             </div>     </div>  
					<?php }?>
						<input type="hidden" name="service_id" id="service_id" value="<?php echo $service_id; ?>">
						<input type="hidden" name="act" value="submit_service_faq">
					 <div class="row">
						<div class="col-sm-6 col-lg-6">
							 <button type="submit"  class="btn btn-primary btn-sm">Submit</button>
						</div>

					        <?php if ($id == '') {?>	<div class="col-sm-6 col-lg-6">
							 <button class="btn btn-primary btn-sm float-right" type="button" onclick="add_more_fields()">Add More</button>
						</div>
					<?php }?>
                    </div>
                </form>
            </div>

            <script>
                x=1;
                add_more_fields();
                function add_more_fields() { 
                    html ='<div class="row"  id="column_'+x+'">';
                    html+='<div class="col-md-12 col-md-12">';
                    html+='<label class="col-form-label">Question'+x+'</label>';
                    html+='<div class="input-group input-group-inverse"> ';
                    html+='<textarea class="form-control" placeholder="Enter Question" required name="question[]"></textarea> ';
                    html+='</div>';
                    html+='</div>';
                    html+='<div class="col-md-12 col-md-12">';
                    html+='<label class="col-form-label">Answer'+x+'</label>';
                    html+='<div class="input-group input-group-inverse"> ';
                    html+='<textarea  class="form-control" placeholder="Enter Answer" required name="answer[]"></textarea>';
                    html+='</div>';
                    html+='</div>';
                    html+='<div class="col-md-12 col-lg-12">';
                    html+='<div class="input-group input-group-inverse"> ';
                    html+='<span class="input-group-addon" id="basic-addon3"onclick="removeRow('+x+')"><i class="icofont icofont-minus"></i></span>';
                    html+='</div>';
                    html+='</div>';
                    html+='</div>'; 
                    $('#appeded_column').append(html);
                    x++;
                }
                function removeRow(id) {  if(x==2) {  return;   }  x--;	 $('#column_'+id).remove();  }
                $("form#service_faq_form").submit(function () {
                    var formData = $('form#service_faq_form').serialize();
                    ajax({
                        a:"service_ajax",
                        b:formData,
                        c:function(){},
                        d:function(data){
                            add_service_faq($('#service_id').val());
                            var records = JSON.parse(data);
                            if(records.result == 'Success'){
                                // toastr.success('<h5>'+records.data+'</h5>');
                                $('#service_category_form').hide();
                                $("#service_category_table").load(location.href + " #service_category_table>*", "");
                                    notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                                } else {
                                    notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                                } 
                            }
                        }
                    });
                });
            </script>
<?php } 

 if ($action == 'faq_draggable') { 
    $service_id =  $_POST['service_id']; 
	
	$param = array('tableName' => TBL_SERVICE, 'fields' => array('*'), 'condition' =>array('id' => $service_id . '-INT', 'showSql' => 'N'));
	$rsDtls = Table::getData($param);
	?>

    <div class="card">
        <div class="card-header bg-c-lite-green">
            <h5 class="card-header-text"> <?php echo $rsDtls->service_name;?> - Reposition  </h5>

        </div>
        <div class="card-block">
            <div class="row">
            <form action="javascript:void(0);" id="service_position" style="width:100%">
                <input type="hidden" name="act" value="faq_position">
                <div class="col-md-12">
                    <div id="draggableMultiple">
                        <?php  
						           $param = array('tableName' => TBL_SERVICE_FAQ, 'fields' => array('*'), 'condition' =>array('service_id' => $service_id . '-INT', 'showSql' => 'N'),'orderby'=>'position', 'sortby'=>'asc');
									$rsFaq = Table::getData($param);
                                    $sno = 0;
                                    if (count($rsFaq) > 0) {
                                        foreach ($rsFaq as $key => $value) {
                                            if ($value->status == 'A') {

                                                ?>
                                   <div class="sortable-moves" style="padding:10px;margin-bottom:10px;">
                                        <p style="margin:0px;"><?php echo $sno + 1; ?>.<?php echo $value->question ?></p>
                                    <input type="hidden" name="faq_id[]" value="<?php echo $value->id ?>">
                                </div>
                        <?php $sno++;}}}?>

                    </div>
                      
                    </div> 
					 <div class="col-md-12"> 
					 <input type="submit" class="btn btn-primary btn-sm" value="Update Position">
					 
					 <button class="btn btn-danger btn-sm  float-right" type="button" onclick="close_cat_service()">Close   </button>  
					 <button class="btn btn-primary btn-sm float-right" style="margin-right:10px;"  onclick="category_service_list(<?php echo $service_id; ?>)">Back to Faq List</button>    &nbsp; &nbsp;</div>
                </form>
            </div>
        </div>
    </div>
    <script>
	function close_cat_service() {
		$('#service_form').hide();
		$('#service_form').html('');
	}
        $( document ).ready(function() {
                Sortable.create(draggableMultiple, {
                group: 'draggableMultiple',
                animation: 150
            });
        });
        $("form#service_position").submit(function () {
            var formData = $('form#service_position').serialize();
            ajax({
                a:"service_ajax",
                b:formData,
                c:function(){},
                d:function(data){
                    var records = JSON.parse(data);
                    if(records.result == 'Success'){
                        // toastr.success('<h5>'+records.data+'</h5>');
                        $('#service_form').hide();
                        $("#service_table").load(location.href + " #service_table>*", "");
                        add_service_faq(<?php echo $service_id;?>);
                            notify('top', 'right', 'fa fa-check', 'success', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                        } else {
                            notify('top', 'right', 'fa fa-times', 'danger', 'animated fadeInLeft', 'animated fadeOutLeft', records.data);
                        } 
                    }
                }
            });
        });

    </script>
<?php } ?>