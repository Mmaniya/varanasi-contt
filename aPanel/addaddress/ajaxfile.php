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