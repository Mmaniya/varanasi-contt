<?php 
define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php";

$voterObj = new Votersdetails;
$rawDataObj = new VotersRawData; 
$userObj = new Users; 
$action = $_POST['act'];


if($action == 'getallState'){ ?>

    <option value="" selected disabled>Select State</option> <?php 
    $getState = $rawDataObj->get_state_dts();
    foreach($getState as $key => $value){  if($value->st_code != '') { ?>
        
        <option value="<?php echo $value->id ?>" <?php if( $value->id == $_POST['state_id']){ echo 'selected'; } ?>  ><?php echo $value->state_name ?></option>
    
    <?php } }
}

  if($action == 'getallDistrict'){

    $rawDataObj->state_id = $_POST['state_id'];
    $getDist = $rawDataObj->get_dist_dts(); 
    $options = array();   count($getDist); ?>

    <option value="" selected disabled>Select District </option> <?php       
    foreach($getDist as $key => $value){  if($value->dist_no != '') { 
        ?>
    <option value="<?php echo $value->id ?>" <?php if( $value->id == $_POST['dist_id']){ echo 'selected'; } ?>><?php echo $value->district_name ?></option>
    <?php } }

}

if($action == 'getallConstituency'){ 

    $rawDataObj->district_id= $_POST['district_id'];    
    $getDist = $rawDataObj->get_conts_dts(); ?>
    <option value="" selected disabled>Select Constituency</option> <?php 
    foreach($getDist as $key => $value){  ?>
    <option value="<?php echo $value->id ?>" <?php if( $value->id == $_POST['const_id']){ echo 'selected'; } ?>><?php echo $value->lg_const_number ?> - <?php echo $value->lg_const_name ?></option>
    <?php } 

}

if($action == 'getbyallBooth'){
    ob_clean();
       $rawDataObj->const_id= $_POST['const_id'];    
       $getBooth = $rawDataObj->get_booth_dts_by_lg(); ?>
           <option value="" selected disabled>Select Booth</option> <?php 
          foreach($getBooth as $K => $V) { ?>       
            <option value="<?php echo $V->id ?>"><?php echo $V->booth_no ?> - <?php echo $V->booth_name ?></option>
   <?php  } 	
   exit();  
}

if($action == "newBooth"){
    ob_clean(); ?>
    <div class="row justify-content-center" id="newBooth">
    <!-- <div class="form-group col-sm-12 row"> -->
        <input type="number" name="booth_no" class="form-control col-sm-4" style="height: 40px; margin:10px;" placeholder="Booth Number" />										              
        <input type="text"  name="booth_name" class="form-control col-sm-4" style="height: 40px;margin:10px;" placeholder="Booth Name" />
        <input type="text"  name="booth_tname" class="form-control col-sm-4 " style="height: 40px;margin:10px;" placeholder="Booth Name (Language Name)" />
        <input type="text"  name="ps_name" class="form-control col-sm-4" style="height: 40px;margin:10px;" placeholder="Polling Station Name" />
        <input type="text"  name="ps_tname" class="form-control col-sm-4" style="height: 40px;margin:10px;" placeholder="Polling Station Nam (Language Name)" />
    <!-- </div> -->
    </div>
    <?php exit();
}

if($action == 'oldBooth'){
    ob_clean(); ?>
        <div class="form-group col-sm-4">
            <select id='searchByBooth' name="booth_id" class="form-control">
                <option value='' disabled selected>Select Booth</option>
            </select>
        </div>
    <?php exit();
}