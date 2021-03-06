<?php 
define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php";

$voterObj = new Votersdetails;
$rawDataObj = new VotersRawData; 
$userObj = new Users; 
// $getUser = Users::getUserDts($_POST['user']);

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

if($action == 'getallBooth'){
     ob_clean();
        $rawDataObj->const_id= $_POST['const_id'];    
        $getBooth = $rawDataObj->get_booth_dts_by_lg();  
		 if(count($getBooth)>0) { echo '<ul class="booth_list_tag">';
           foreach($getBooth as $K => $V) { ?>       
     <li><input type="checkbox" name="booth_id[]" value="<?php echo $V->booth_no ?>"> <?php echo $V->booth_no; ?>  </li>
	<?php  } echo '</ul>'; } 		
    exit();  
}

if($action == 'add_edit_users'){
    ob_clean();
        $param['state_id'] = $_POST['state_id'];
        $param['district_id'] = $_POST['district_id'];
        $param['lg_const_id'] = $_POST['lg_const_id'];
        $param['name'] = $_POST['name'];
        $param['phone'] = $_POST['phone'];
        $param['email'] = $_POST['email'];
        $param['user_type'] = $_POST['user_type'];
        foreach($_POST['booth_id'] as $key => $value){
            $arrData[] = $value;
        }
        $param['booth_id'] = implode(',', $arrData);
        if($_POST['pass'] == $_POST['cpass']){
            $param['password'] = $_POST['pass'];
            if(empty($_POST['id'])){
                echo $result = Users::addNewUsers($param);
            }else{
                $param['id'] = $_POST['id'];
                echo $result = Users::updateUser($param);
            }
        }else{
            echo 'Password Miss Match';
        }
    exit();  
}

if($action == 'removeBooth'){
    ob_clean();

        $result = "SELECT * FROM ".TBL_ADMIN_USER." WHERE id =".$_POST['id'];   
        $rsUser = dB::sExecuteSql($result); 	        
        $booth_id  =  explode(',', $rsUser->booth_id);
        if (($key = array_search($_POST['booth_id'], $booth_id)) !== false) {
            unset($booth_id[$key]);
        }
        $param['id'] = $_POST['id'];
        $param['booth_id'] = implode(',',$booth_id);
        echo $result = Users::updateUser($param);

    exit();
}


if ($action == 'steps_status_change') {
    $param['status'] = $_POST['status'];
    $where = array('id' => $_POST['id']);
    $result = Table::updateData(array('tableName' => TBL_ADMIN_USER, 'fields' => $param, 'where' => $where, 'showSql' => 'Y'));
    $rsData = explode('::',$result);
    return  $rsData[0];
}

if ($action == 'delete_user') {
    ob_clean();

    $where = array('id' => $_POST['id']);
    $result = Table::deleteData(array('tableName' => TBL_ADMIN_USER, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
    $response = array("result" => 'Success', "data" => 'Successfully Removed');
    echo json_encode($response);

    exit();
}