<?php  
define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php";
// ini_set('max_execution_time', '0'); // for infinite time of execution 
$rawDataObj = new VotersRawData;
	     
    $cnt=0;
        $voterNewqQry ="SELECT * FROM  `".TBL_VOTERS_RAW_DATA."` WHERE booth_number = 314 and raw_data != '' AND is_inserted = 'N'";
    // $voterNewqQry ="SELECT * FROM `".TBL_VOTERS_RAW_DATA."` WHERE raw_data != '' AND is_inserted ='N' AND updated_date LIKE '2021-01-13%' ORDER BY `updated_date` DESC";   
    // $voterNewqQry = "select * from `".TBL_VOTERS_RAW_DATA."` WHERE voter_id NOT IN (SELECT epic_no FROM `".TBL_VOTERS_DETAILS."`) AND booth_number = 33 ORDER BY `id` DESC";
    // $voterNewqQry = "SELECT * FROM `".TBL_VOTERS_RAW_DATA."` WHERE raw_data != '' AND is_inserted = 'N' AND updated_date LIKE '2021-01-12%' ORDER BY `updated_date` DESC";
    // $voterNewqQry = "SELECT * FROM `".TBL_VOTERS_RAW_DATA."` WHERE voter_id NOT IN (select epic_no FROM `".TBL_VOTERS_DETAILS."` WHERE `part_no` = '22') AND booth_number = '22' ORDER BY `updated_date` DESC";
    $rsDtls = dB::mExecuteSql($voterNewqQry);
	if(count($rsDtls)>0) {  
        foreach($rsDtls as $key=>$val) {   
            $rawDataObj->voterRawdata= $val->raw_data;
            $rawDataObj->voterid= trim($val->voter_id);
            $rawVoterId = $rawDataObj->update_voter_data();		

            $param['updated_by'] = '900';
            $param['is_inserted'] = 'Y';
            $where= array('voter_id'=>$val->voter_id);	
            $result = Table::updateData(array('tableName' => TBL_VOTERS_RAW_DATA, 'fields' => $param, 'where' => $where, 'showSql' => 'N')); 
            $cnt++; 
        } 
    }  
	   exit();
	echo $cnt;

	
?>

  
 

 
 
 

 
    