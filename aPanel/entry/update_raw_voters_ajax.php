<?php  define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php";

$rawDataObj = new VotersRawData;

$action = $_POST['act'];

 if($action == 'getallvotersdetails'){   

  $rawDataObj->group_by = $_POST['group_by'];
  $rawDataObj->limit = $_POST['limit'];
  $getAllvoters = $rawDataObj->getVotersId();

  if(count($getAllvoters) > 0 ){
  foreach($getAllvoters as $key => $value){
      if($value->is_inserted != 'Y'){
      ?>

        <tr id="remove_<?php echo $key+$_POST['limit']; ?>">
            <td><?php echo $key+$_POST['limit']; ?></td>
            <td><?php echo $value->voter_id ?> &nbsp;&nbsp;&nbsp; <a href="javascript:void(0);" onclick="getVoterDetails(<?php echo $value->id ?>)" style="color:blue;"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                <input type="hidden" value="<?php echo $value->voter_id ?>" class="form-control"  id="voters_<?php echo $value->id ?>">
            </td>
            <td><?php echo $value->address ?></td>
            <td>
                <input onfocus="pasteElement(<?php echo $value->id ?>)" type="text" value="<?php echo $value->raw_data ?>" <?php  if($value->is_inserted == 'Y' && $value->is_inserted != '') { ?> readonly <?php } ?> class="form-control inputfocus"  id="voters_raw_data_<?php echo $value->id ?>">
            </td>
            <td>
                <span id="responceData<?php echo $value->id ?>" style="display:none">Added</span>
                <a href="javascript:void(0);" id="add_Data<?php echo $value->id ?>" class="btn btn-info" onclick="updateVoterDetails(<?php echo $value->id ?>)">Add</a>

            </td>                                
        </tr>
                             
<?php } } } else { echo 'Select Booth'; } }



if($action == 'updatevoterRawdata'){  

    $rawDataObj->userid= $_POST['user'];
    $rawDataObj->voterRawdata= $_POST['voterRawdata'];
    $rawDataObj->voterid= $_POST['voterid'];
    $updateVoters = $rawDataObj->update_voter_raw_data();
    
    // Dont delete this function
     $rawVoterId = $rawDataObj->update_voter_data();

}


if($action == 'getallState'){ ?>

    <option value="" selected disabled>Select State</option> <?php 
    $getState = $rawDataObj->get_state_dts();
    
    foreach($getState as $key => $value){  if($value->st_code != '') {
        if($_POST['user'] == 'A' && $value->id == '1'){ ?>        
            <option value="<?php echo $value->id ?>"  ><?php echo $value->state_name ?></option>
        <?php }  
        if($_POST['user'] == 'SA') { ?>        
            <option value="<?php echo $value->id ?>"  ><?php echo $value->state_name ?></option>
        <?php }  ?>
   <?php } }

}

if($action == 'getallDistrict'){

    $rawDataObj->state_id = $_POST['state_id'];
    $getDist = $rawDataObj->get_dist_dts(); 
    $options = array();   count($getDist); ?>
 
    <option value="" selected disabled>Select District </option> <?php       
    foreach($getDist as $key => $value){  if($value->dist_no != '') { 
         ?>
    <option value="<?php echo $value->id ?>" ><?php echo $value->district_name ?></option>
   <?php } }

}

if($action == 'getallConstituency'){ 

    $rawDataObj->district_id= $_POST['district_id'];    
    $getDist = $rawDataObj->get_conts_dts(); ?>
    <option value="" selected disabled>Select Constituency</option> <?php 
    foreach($getDist as $key => $value){  ?>
    <option value="<?php echo $value->id ?>"><?php echo $value->lg_const_number ?> - <?php echo $value->lg_const_name ?></option>
   <?php } 

}

if($action == 'getallBooth'){
    ob_clean();

        $rawDataObj->const_id= $_POST['const_id'];    
        $getBooth = $rawDataObj->get_booth_dts_by_lg(); ?>      
        <option value="" selected disabled>Select Booth</option>
        <?php foreach($getBooth as $K => $V) { ?>
        <option value="<?php echo $V->id ?>"><?php echo $V->booth_no ?> - <?php echo $V->booth_name ?></option>
        <?php } 

    exit();
} 

if($action == 'getallBoothBranch'){
    ob_clean();
        $rawDataObj->booth_id= $_POST['booth_id'];    
        $getBooth = $rawDataObj->get_booth_branch_dts();  ?>                 
        <?php foreach($getBooth as $K => $V) { ?>
        <option value="<?php echo $V->id ?>"><?php echo $V->branch_name ?></option>
        <?php } 
    exit();
}

if($action == 'getallBoothName'){
    ob_clean();

        $rawDataObj->booth_id= $_POST['booth_id'];    
        $getBooth = $rawDataObj->get_booth_name(); 
        echo $getBooth->booth_no .'-'. $getBooth->booth_name;

    exit();
}


// dont delete this qry

// if($action == 'gettotalrecords'){

//     $qry ="select  count(*) as total,
//     sum(case when is_inserted = 'Y' and  raw_data != '' then 1 else 0 end) total_insert,
//     sum(case when is_inserted = 'N' and  raw_data = '' then 1 else 0 end) total_noninsert
//     from ".TBL_VOTERS_RAW_DATA." WHERE booth_number =".$_POST['booth_no'].""; 

//     $result = dB::sExecuteSql($qry);
    
//     echo 'Total Voters : '. $result->total; echo '<br>'; 
//     // if($result->total == $result->total_insert){ echo 'completed';}
//     echo 'Added Voters : '. $result->total_insert; echo '<br>';
//     echo 'Pending Voters : '. $result->total_noninsert;

// }

// dont delete this qry

if($action == 'gettotalrecords'){

    $qry ="select  count(*) as total,
    sum(case when raw_data != '' then 1 else 0 end) total_insert,
    sum(case when raw_data = '' then 1 else 0 end) total_noninsert
    from ".TBL_VOTERS_RAW_DATA." WHERE booth_id =".$_POST['booth_no'].""; 

    $result = dB::sExecuteSql($qry);
    
    echo 'Total Voters : '. $result->total; echo '<br>';
    echo 'Added Voters : '. $result->total_insert; 
    echo '<br>';
    echo 'Pending Voters : '. $result->total_noninsert;

}

if($action == 'getvotersbyusers'){
    // $booth_id = explode(',' ,$_POST['booth_id']);

    // $qry ="SELECT * FROM ".TBL_VOTERS_RAW_DATA." WHERE added_by = $userid GROUP by booth_number";
    // $result = dB::mExecuteSql($qry); 

    // foreach($booth_id as $k ){
    echo $qry ="SELECT * FROM ".TBL_BOOTH." WHERE id IN (".$_POST['booth_id'].") ";
    $result = dB::mExecuteSql($qry);      
    ?>
        <option value="">Select Booth Number</option>
        <?php         
            if(count($result)>0) {
    
                foreach($result as $key=>$val) {  
            
                    echo '<option value="'.$val->booth_no.'">'.$val->booth_no.'</option>'; 
                }
            }
        
}

?>