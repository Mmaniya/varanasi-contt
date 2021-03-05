<?php

class VotersRawData {

    public function getVotersId(){

        $limit = "limit ".$this->limit.",100";
        $voter ="SELECT * FROM `".TBL_VOTERS_RAW_DATA."` where booth_number = ".$this->group_by ." AND is_inserted = 'N' AND raw_data = ''  ORDER BY id ASC ".$limit; 
        $result = dB::mExecuteSql($voter);
        return $result;	
    }


    public function update_voter_raw_data(){

        if(!empty($this->voterid)){
            $param['is_inserted'] = 'Y';
            $param['raw_data'] = input_string($this->voterRawdata);
            $param['updated_by'] =  $this->userid;
 
            $where= array('voter_id'=>$this->voterid);	
            $result = Table::updateData(array('tableName' => TBL_VOTERS_RAW_DATA, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
                                                        
            }

    }    
    
    public function update_voter_data() {
        $rawData = json_decode($this->voterRawdata);
        $response = $rawData->response;
        
        for($i = 0; $i< count($response->docs); $i++){
            $rawResult = $response->docs[$i];

            // $rawResult = $response->docs[0];  
                
            //check for state
  
            $stateQry ="SELECT * FROM `".TBL_STATE."` WHERE st_code ='".$rawResult->st_code."'"; 
            $stateResult = dB::sExecuteSql($stateQry);
          
            if(count($stateResult) > 0){
                $stateid = $stateResult->id;
            }else{
                $param = array();
                $param['st_code'] = $rawResult->st_code;
                $param['state_name'] = input_string($rawResult->st_name);
                $query = Table::insertData(array('tableName' => TBL_STATE, 'fields' => $param, 'showSql' => 'N')); 
                $lastRecords = explode('::',$query);
                $stateid =  $lastRecords[2];
            }
     

        //check for district

            $distQry ="SELECT * FROM `".TBL_DISTRICT."` WHERE dist_no ='".$rawResult->dist_no."'"; 
            $distResult = dB::sExecuteSql($distQry);

            if(count($distResult) > 0){
                $districtId = $distResult->id;
            }else{
                $param = array();
                $param['dist_no'] = $rawResult->dist_no;
                $param['state_id'] = $stateid;
                $param['district_name'] = input_string($rawResult->dist_name);
                $param['district_name_ta'] = input_string($rawResult->dist_name_v1);
                $query = Table::insertData(array('tableName' => TBL_DISTRICT, 'fields' => $param, 'showSql' => 'N')); 
                $rsRecords = explode('::',$query);
                $districtId =  $rsRecords[2];
            }
      

        //chcek for mp
        
           $mpQry ="SELECT * FROM `".TBL_MP_CONSTITUENCY."` WHERE bjp_mp_const_no ='".$rawResult->pc_no."'"; 
           $mpResult = dB::sExecuteSql($mpQry);

            if(count($mpResult) > 0){
                $mpId = $mpResult->id;
            }else{
                $param = array();
                $param['state_id'] = $stateid; 
                $param['district_id'] = $districtId; 
                $param['bjp_mp_const_no'] = $rawResult->pc_no;;
                $param['bjp_mp_const_name'] = input_string($rawResult->pc_name);
                $param['bjp_mp_const_tname'] = input_string($rawResult->pc_name_v1);
                $query = Table::insertData(array('tableName' => TBL_MP_CONSTITUENCY, 'fields' => $param, 'showSql' => 'N'));
                $rsRecords = explode('::',$query);
                $mpId =  $rsRecords[2];
            }
                    

        //check for lg
           $lgQry ="SELECT * FROM `".TBL_LG_CONSTITUENCY."` WHERE lg_const_number ='".$rawResult->ac_no."'"; 
           $lgResult = dB::sExecuteSql($lgQry);

            if(count($lgResult) > 0){
                $lgId = $lgResult->id;
            }else{
                $param = array();
                $param['district_id'] = $districtId; 
                $param['lg_const_number'] = $rawResult->ac_no;
                $param['lg_const_name'] = input_string($rawResult->ac_name);
                $param['lg_const_tname'] = input_string($rawResult->ac_name_v1);
                $query = Table::insertData(array('tableName' => TBL_LG_CONSTITUENCY, 'fields' => $param, 'showSql' => 'N'));
                $rsRecords = explode('::',$query);
                $lgId =  $rsRecords[2];
            }

        //check for booth

           $boothQry ="SELECT * FROM `".TBL_BOOTH."` WHERE mp_id ='".$mpId."' and lg_id=".$lgId.' and booth_no='.$rawResult->part_no; 
           $boothResult = dB::sExecuteSql($boothQry);

            if(count($boothResult) > 0){
                $boothId = $boothResult->id;
            }else{
                $param = array();
                
                $param['mp_id'] = $mpId; 
                $param['lg_id'] = $lgId;
                $param['booth_no'] =$rawResult->part_no;
                $param['booth_name'] = input_string($rawResult->part_name);
                $param['booth_tname'] = input_string($rawResult->part_name_v1);
                $param['ps_no'] =$rawResult->ps_no;
                $param['ps_name'] = input_string($rawResult->ps_name);
                $param['ps_tname'] = input_string($rawResult->ps_name_v1);                
                $query = Table::insertData(array('tableName' => TBL_BOOTH, 'fields' => $param, 'showSql' => 'N'));
                $rsRecords = explode('::',$query);
                $boothId =  $rsRecords[2];
            }        
                        

        //check if the voter id already exists in TBL_VOTERS_LIST
        $param=array();
        
        $params = array('pc_name','st_code','ps_lat_long_1_coordinate','gender','address','rln_name_v2','rln_name_v1','rln_name_v3','name_v1','epic_no','ac_name','name_v2','name_v3','ps_lat_long','pc_no','last_update','id','dist_no','ps_no','ps_name','ps_name_v1','st_name','dist_name','rln_type','pc_name_v1','part_name_v1','ac_name_v1','part_no','dist_name_v1','ps_lat_long_0_coordinate','_version_','name','section_no','ac_no','slno_inpart','rln_name','age','part_name');
                            
        foreach($params as $field)  {
            $param[$field]= $rawResult->$field;
        }
                    
        $param['booth_id'] = $boothId;	
        $param['branch_id'] =0;	
        $param['ward_id']=0;

		// address update
		$addressQry ="SELECT * FROM `".TBL_VOTERS_RAW_DATA."` WHERE voter_id ='".$rawResult->epic_no."'"; 
		$addressResult = dB::mExecuteSql($addressQry);
		if(count($addressResult) > 0){
            $address = $addressResult[0]->address;
            $booth_number = $addressResult[0]->booth_number;
            $param['address']= $address;
		}
       
                        
        $param['name'] =  ucwords(strtolower(str_replace("","-", input_string($rawResult->name)))); 
        $param['rln_name'] = ucwords(strtolower(str_replace("","-", input_string($rawResult->rln_name)))); 
							
        
        if($rawResult->epic_no == $this->voterid){

        $voterQry ="SELECT * FROM `".TBL_VOTERS_LIST."` WHERE epic_no ='".$rawResult->epic_no."'"; 
        $voterResult = dB::sExecuteSql($voterQry);        
        
        if(count($voterResult) == 0){         
            $result = Table::insertData(array('tableName' => TBL_VOTERS_LIST, 'fields' => $param, 'showSql' => 'N'));
            // echo 'Records Added Successfully'; 
        }else {
            $where= array('id'=>$rawResult->id);	
            $result = Table::updateData(array('tableName' => TBL_VOTERS_LIST, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
            // echo 'Records Updated Successfully';
        }
            $lastInsertDtls = explode('::',$result);            
            
        $param['state_id']=$stateid;
        $param['district_id']=$districtId;
        $param['mp_const_id']=$mpId;
        $param['lg_const_id']=$lgId;
        unset($param['ps_lat_long']);
        unset($param['last_update']);         
        unset($param['_version_']);
        unset($param['rln_name_v2']);
        unset($param['rln_name_v3']);
        unset($param['name_v2']);
        unset($param['name_v3']);
        unset($param['ps_lat_long_1_coordinate']);
        unset($param['ps_lat_long_0_coordinate']);
                
 		$voterNewqQry ="SELECT * FROM `".TBL_VOTERS_DETAILS."` WHERE epic_no ='".trim($param['epic_no'])."'"; 
		$rsDtls = dB::mExecuteSql($voterNewqQry);
        if($booth_number == $rawResult->part_no){
                if(count($rsDtls)>0) { 		   
                    $where= array('epic_no'=>trim($param['epic_no']));	
                    $result = Table::updateData(array('tableName' => TBL_VOTERS_DETAILS, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
                    echo 'Records Updated Successfully';
                    } else {		
                                
                    $query = Table::insertData(array('tableName' => TBL_VOTERS_DETAILS, 'fields' => $param, 'showSql' => 'N'));
                    echo 'Records Added Successfully';
                }               
                    
            }	// VotersRawData::insert_update_voter_details($lastInsertDtls[2],$stateid,$districtId,$mpId,$lgId);
            }
			  
        }
    }


    function insert_update_voter_details($vid,$stateid,$districtId,$mpId,$lgId) {
	   //$vid = $this->vid;
	     $qry ="SELECT * FROM `".TBL_VOTERS_LIST."` WHERE vid =".$vid; 
       $result = dB::sExecuteSql($qry);
			$param['state_id']=$stateid;
			$param['district_id']=$districtId;
			$param['mp_const_id']=$mpId;
			$param['lg_const_id']=$lgId;
			//$param['mandal_id']='';	   
			$param['booth_id']=$result->booth_id;
			//$param['branch_id']=$result->booth_id;
			$param['pc_name']=$result->pc_name;
			$param['st_code']=$result->st_code;
			$param['gender']=$result->gender;
			$param['rln_name_v1']=$result->rln_name_v1;
			$param['epic_no']=$result->epic_no;
			$param['ac_name']=$result->ac_name;
			$param['pc_no']=$result->pc_no;
			$param['dist_no']=$result->dist_no;
			$param['ps_no']=$result->ps_no;
			$param['ps_name']=$result->ps_name;
			$param['ps_name_v1']=$result->ps_name_v1;
			$param['dist_name']=$result->dist_name;
			$param['rln_type']=$result->rln_type;
			// $param['family_slno']=$result->booth_id;
			$param['pc_name_v1']=$result->pc_name_v1;
			$param['part_name_v1']=$result->part_name_v1;
			$param['ac_name_v1']=$result->ac_name_v1;
			$param['part_no']=$result->part_no;
			$param['dist_name_v1']=$result->dist_name_v1;
            $param['name']=$result->name;
            $param['name_v1']=$result->name_v1;
			$param['section_no']=$result->section_no;
			$param['slno_inpart']=$result->slno_inpart;
			$param['rln_name']=$result->rln_name;
			$param['age']=$result->age;
			$param['part_name']=$result->part_name;  
			$param['ac_no']=$result->ac_no;
			
			// address update
			$addressQry ="SELECT * FROM `".TBL_VOTERS_RAW_DATA."` WHERE voter_id ='".$rawResult->epic_no."'"; 
			$addressResult = dB::mExecuteSql($addressQry);
			if(count($addressResult) > 0){
			$address = $addressResult[0]->address;
			$param['address']= $address;
			}
		
	   
	   
		$voterNewqQry ="SELECT * FROM `".TBL_VOTERS_DETAILS."` WHERE epic_no ='".trim($result->epic_no)."'"; 
		$rsDtls = dB::mExecuteSql($voterNewqQry);
	   
		if(count($rsDtls)>0) { 		   
		$where= array('epic_no'=>trim($result->epic_no));	
		$result = Table::updateData(array('tableName' => TBL_VOTERS_DETAILS, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
		echo 'Records Updated Successfully';
		} else {		
					
		$query = Table::insertData(array('tableName' => TBL_VOTERS_DETAILS, 'fields' => $param, 'showSql' => 'N'));
	    echo 'Records Added Successfully';}
    }

    public function get_state_dts(){

        $state ="SELECT * FROM `".TBL_STATE."` ORDER BY id ASC "; 
        $result = dB::mExecuteSql($state);
        return $result; 
    }

    public function get_state(){
        
         $state ="SELECT * FROM `".TBL_STATE."` WHERE id = ".$this->st_id; 
        $result = dB::sExecuteSql($state);
        return $result; 
    }

    public function get_dist(){
        
        $dist ="SELECT * FROM `".TBL_DISTRICT."` WHERE id = ".$this->dist_id; 
        $result = dB::sExecuteSql($dist);
        return $result; 
    }


   public function get_const(){        
        $const ="SELECT * FROM `".TBL_LG_CONSTITUENCY."` WHERE id = ".$this->const_id; 
        $result = dB::sExecuteSql($const);
        return $result; 
    }



    public function get_dist_dts(){   
        if(!empty($this->state_id)){
            $state ="SELECT * FROM `".TBL_DISTRICT."` WHERE state_id = ".$this->state_id." ORDER BY id ASC "; 
        }else{
            $state ="SELECT * FROM `".TBL_DISTRICT."` ORDER BY id ASC "; 
        }
        $result = dB::mExecuteSql($state);
        return $result; 
    }

    public function get_conts_dts(){        
         $const ="SELECT * FROM `".TBL_LG_CONSTITUENCY."` WHERE district_id = ".$this->district_id." ORDER BY id ASC "; 
        $result = dB::mExecuteSql($const);
        return $result; 
    }

    // public function get_booth_dts(){
    //     $booth ="SELECT * FROM `".TBL_BOOTH."` WHERE lg_id = ".$this->const_id." ORDER BY id ASC "; 
    //     $result = dB::mExecuteSql($booth);
    //     return $result; 
    // }

    public function get_booth_dts_by_lg(){
        $booth ="SELECT * FROM `".TBL_BOOTH."` WHERE lg_id = ".$this->const_id." ORDER BY booth_no ASC "; 
        $result = dB::mExecuteSql($booth);
        return $result; 
    }
    
    public function get_booth_branch_dts(){
        $branch ="SELECT * FROM `".TBL_BOOTH_BRANCH."` WHERE booth_id = ".$this->booth_id." ORDER BY id ASC "; 
        $result = dB::mExecuteSql($branch);
        return $result; 
    }

    public function get_booth_name(){
        $booth ="SELECT * FROM `".TBL_BOOTH."` WHERE id = ".$this->booth_id.""; 
        $result = dB::sExecuteSql($booth);
        return $result; 
    }
}
