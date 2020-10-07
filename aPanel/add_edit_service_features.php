<?php 
include '../includes.php';
$feature_id = $_POST['feature_id'];
$param = array('tableName' => TBL_SERVICE_FEATURES, 'fields' => array('*'), 'showSql' => 'N', 'condition' => array('id' => $feature_id . '-INT'));
$rsDtls = Table::getData($param);  

foreach ($rsDtls as $K => $V) { $$K = $V; }

$serviceId = $_POST['service_id'];
$param = array('tableName' => TBL_SERVICE, 'fields' => array('*'), 'showSql' => 'N', 'condition' => array('id' => $serviceId . '-INT'));
$rsService = Table::getData($param);

?>  
 <div class="card-header bg-c-lite-green">
                <h5>Add New <?php echo $rsService->service_name;?> Features</h5>
                <!-- <a href="javascript:void(0);" onclick="close_service_category()" class="btn btn-success right-float"><i class="icofont icofont-document-search">View Table</i></a> -->
            </div>
            <div class="card-block">
                <form action="javascript:void(0);" id="service_category">
                    <input type="hidden" value="service_categories" name="act">
                    <input type="hidden"  name="id" value="">
                    <input type="hidden"  name="access_level" value="SA">

                					
					 <div class="row" id="appeded_column"></div>
					
					 <div class="row">					 
						<div class="col-sm-6 col-lg-6">
							 <button type="submit"  class="btn btn-primary btn-sm">Submit</button>
						</div>
						
						<div class="col-sm-6 col-lg-6">
							 <button class="btn btn-primary btn-sm float-right" type="button" onclick="add_more_fields()">Add More</button>
						</div>
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
                html+='<input type="text" class="form-control" placeholder="Enter Features" required name="title[]"><span class="input-group-addon" id="basic-addon3"onclick="removeRow('+x+')">X</span> ';
                html+='</div>';
                html+='</div>';
				 
				 $('#appeded_column').append(html);
				 x++;
				  
			}
			
			function removeRow(id) {  if(x==1) {  return;   }  x--;	 $('#column_'+id).remove();  }
			
			
			
            $("form#service_category").submit(function () {
                $("#service_category_table").load(location.href + " #service_category_table>*", "");

                var formData = $('form#service_category').serialize();
                ajax({
                    a:"admin_ajax",
                    b:formData,
                    c:function(){},
                    d:function(data){
                        var records = JSON.parse(data);
                        if(records.result == 'Success'){
                            toastr.success('<h5>'+records.data+'</h5>');
                            $('#service_category_form').hide();
                            $("#service_category_table").load(location.href + " #service_category_table>*", "");
                            // admin_submenu_service('');
                        }
                    }
                });
            });
    </script>
   
