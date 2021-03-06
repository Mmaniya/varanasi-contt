<?php  

define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php";
 
ini_set('max_execution_time', '0'); // for infinite time of execution 
$rawDataObj = new VotersRawData;
  $booth_number = $_REQUEST['booth_number'];

  
    $voterNewqQry ="SELECT * FROM ".TBL_VOTERS_DETAILS." WHERE ps_no=".$booth_number."";     
    $rsDtls = dB::mExecuteSql($voterNewqQry);   
    
     $cnt=0;
     
     foreach($rsDtls as $key => $value){
        $param['ac_no'] ='390';
        $param['booth_number'] = $booth_number;
        $param['added_by'] = '2';
        $where= array('voter_id'=>$value->epic_no);
        $result = Table::updateData(array('tableName' => TBL_VOTERS_RAW_DATA, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
        $cnt++;
     }
	
	echo 'total'.$cnt;