<?php 
define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php";
$rawDataObj = new VotersRawData;

    $voterNewqQry = "SELECT * FROM `".TBL_VOTERS_RAW_DATA."` WHERE voter_id NOT IN (select epic_no FROM `".TBL_VOTERS_DETAILS."` WHERE `part_no` = '14') AND booth_number = '14' ORDER BY `updated_date` DESC";
    $rsDtls = dB::mExecuteSql($voterNewqQry);

	if(count($rsDtls)>0) {  
        foreach ($rsDtls as $key => $val) {

             $rawData = json_decode($val->raw_data);
             $response = $rawData->response;
             $rawResult = $response->docs[$key]; 

            if($val->booth_number == $rawResult->part_no){

                    $onedata['docs'] = array($data);
                    $secondata['response'] = $onedata;
                    $covertsjson =  json_encode($secondata,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);

                    // insert records
                    $rawDataObj->voterRawdata= $covertsjson;
                    $rawDataObj->voterid= trim($_POST['voter_id']);
                    $rawVoterId = $rawDataObj->update_voter_data();	

                    $params['updated_by'] = '900';
                    $params['is_inserted'] = 'Y';                    
                    $params['raw_data'] = $covertsjson;
                    $where = array('voter_id'=>$_POST['voter_id'],'booth_number'=>$val->booth_number);	
                    $result = Table::updateData(array('tableName' => TBL_VOTERS_RAW_DATA, 'fields' => $params, 'where' => $where, 'showSql' => 'N'));
                                       
                    $cnt++; 
            }
        }
    }

      header('Location: updateduplicaterecords.php');

?>