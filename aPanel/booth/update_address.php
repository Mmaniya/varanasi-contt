<?php  
define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php";
ini_set('max_execution_time', '0'); // for infinite time of execution 
$rawDataObj = new VotersRawData;
$booth_number = $_REQUEST['booth_number'];
$voterNewqQry ="SELECT * FROM `".TBL_VOTERS_RAW_DATA."` WHERE booth_number =".$booth_number." and `address` !=''";     
$rsDtls = dB::mExecuteSql($voterNewqQry);   
$cnt=0;
if(count($rsDtls)>0) {  
foreach($rsDtls as $key=>$val) {   
			
$param['address']=$val->address;
$where= array('epic_no'=>$val->voter_id);	
$result = Table::updateData(array('tableName' => TBL_VOTERS_LIST, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
		
$param=array();
$param['address']=$val->address;
$where= array('epic_no'=>$val->voter_id);	
$results = Table::updateData(array('tableName' => TBL_VOTERS_DETAILS, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
	  $cnt++; }
}
	
	echo 'total'.$cnt;