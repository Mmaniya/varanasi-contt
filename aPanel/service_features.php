<?php
function main() {
  

    ?>

<div class="card borderless-card">
    <div class="card-block caption-breadcrumb">
        <div class="breadcrumb-header">
            <h5>Service Features</h5>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="#!">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#!">Service Features</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="row ">
	<div class="col-7">
	
	<div class="row">
	  <div class="col-6"><label>Select Service</label>
	<select class="form-control" onchange="get_service_features_list(this.value)">
	<option>Select </option>
 <?php 	$rsServiceCategory = Service::get_service(); 
 print_r($rsServiceCategory);
    if (count($rsServiceCategory) > 0) {
        foreach ($rsServiceCategory as $key => $val) {
			echo '<option value="'.$val->id.'">'.$val->service_name.'</option>';
	} }
			?>
	</select>
	  </div>
	</div><br/>
	
	
	 <div class="features_list"></div>
	
	
	
	</div>
    <div class="col-5">
        <div class="z-depth-5 waves-effect" id="right_sidebar" style="display:none">
        </div>
    </div>
</div>

<script>
    
function get_service_features_list(service_id) { 
	paramData = {'act':'service_features_list','service_id':service_id};
	ajax({ 
		a:'service_features_list',
		b:$.param(paramData),
		c:function(){},
		d:function(data){  		 
		 $('.features_list').html(data);
	}}); 
}
</script>

<?php }include 'admin_template.php';?>
