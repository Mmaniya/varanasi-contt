<?php



class Voters {
	
	function getVotersDetails($id){
		$voters ="SELECT * FROM `".TBL_VOTRES."` WHERE id='".$id."'"; 
		$result = dB::sExecuteSql($voters);	
		return $result;	
	}

	function getvoterDetails($id){
		$branch ="SELECT * FROM `".TBL_VOTERS_LIST."` WHERE vid='".$id."'"; 
		$result = dB::sExecuteSql($branch);	
		return $result;	
	}

	function deleteVotersDetails($param) {
		$where = array('vid' => $param);
		$result = Table::deleteData(array('tableName' => TBL_VOTERS_LIST, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
		$response = array("result" => 'Success', "data" => 'Records Deleted Successfully');
        return json_encode($response);	
		
	}

	function getBoothDetails(){
		$booth ="SELECT * FROM `".TBL_BOOTH."` ORDER BY booth_no ASC"; 
		$result = dB::mExecuteSql($booth);	
		return $result;	
	}

	function getsingleBoothDetails($id){
		$booth ="SELECT * FROM `".TBL_BOOTH."` WHERE id='".$id."'"; 
		$result = dB::sExecuteSql($booth);	
		return $result;	
	}

	function getbranchDetails($id){
		$branch ="SELECT * FROM `".TBL_BOOTH_BRANCH."` WHERE booth_id='".$id."'"; 
		$result = dB::mExecuteSql($branch);	
		return $result;	
	}

	function getsinglebranchDetails($id){
		$branch ="SELECT * FROM `".TBL_BOOTH_BRANCH."` WHERE id='".$id."'"; 
		$result = dB::sExecuteSql($branch);	
		return $result;	
	}
    
}