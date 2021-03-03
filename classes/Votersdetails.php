<?php

class Votersdetails {

	function getBoothDetails(){
		$booth ="SELECT * FROM `".TBL_BOOTH."` ORDER BY booth_no ASC"; 
        $result = dB::mExecuteSql($booth);
        return $result;	        
    }
    function getBoothBranch($id){
        $branch ="SELECT * FROM `".TBL_BOOTH_BRANCH."` WHERE booth_id ='$id'"; 
        $result = dB::mExecuteSql($branch);
        return $result;	
    }

    function getmemberDetails($getmember){
        $member ="SELECT * FROM `".TBL_MEMBER."` WHERE  `member_voter_id`='$getmember'"; 
        $result = dB::sExecuteSql($member);
        return $result;	
    }

    function getsinglevoters($voterid){
        $voter ="SELECT * FROM `".TBL_VOTERS_DETAILS."` WHERE  `id`='$voterid'"; 
        $result = dB::sExecuteSql($voter);
        return $result;	
    }

    public function getallvoters(){  
        $searchValue ='';
           $limit = "limit ".$this->limit.",100";

           $subQry=array(); 
        if(!empty($this->search)){
            if($this->filter_type=='slno_inpart') {  $searchQry = 'slno_inpart like "%'.$this->search.'%"';   }
            if($this->filter_type=='epic_no') { $searchQry = 'epic_no like "%'.$this->search.'%"';   }
            if($this->filter_type=='name') {  $searchQry = 'name like "%'.$this->search.'%"';   }            
            $subQry[] = " ".$searchQry;  
             $limit = $this->limit ='';
        }
        

        if($this->ward_id!='') {   
            $subQry[]= " ward_id =".$this->ward_id."";  
        }  

        if($this->branchid!='') {   
           $subQry[]= " branch_id =".$this->branchid."";  
        } 

        if($this->booth_id!='') {
        $subQry[] = " booth_id =".$this->booth_id."";
        }

        if($this->getType == 'gender'){
            $gender = $this->filterBy;
            if(!empty($this->filterBy)){ { $subQry[]= " gender ='$gender'"; } }
        }

        if($this->getType == 'karyakarta'){
            if($this->filterBy == 'bla'){
                $subQry[]= " is_bla = 'Y'";
            }
            if($this->filterBy == 'bc'){
                $subQry[]= " is_bc = 'Y'";
            }
       }

       
        if($this->getType == 'ageGroup'){
            if($this->filterBy == 'first_age_group'){
                $subQry[]= " age BETWEEN '18' AND '22'";
            }
            if($this->filterBy == 'second_age_group'){
                $subQry[]= " age BETWEEN '23' AND '30'";
            }
            if($this->filterBy == 'third_age_group'){
                $subQry[]= " age BETWEEN '31' AND '40'";
            }
            if($this->filterBy == 'fourth_age_group'){
                $subQry[]= " age BETWEEN '41' AND '50'";
            }
            if($this->filterBy == 'fifth_age_group'){
                $subQry[]= " age BETWEEN '51' AND '60'";
            }
            if($this->filterBy == 'sixth_age_group'){
                $subQry[]= " age > 60 ";
            }           
        }

        if($this->getType == 'address'){
             $subQry[]= " address != ''";
        }
    
        if(count($subQry)>0) {
          $subQuery = " WHERE ".implode(' AND ',$subQry).""; 
        }            

        $voters ="SELECT * FROM `".TBL_VOTERS_DETAILS."` ".$subQuery."  ORDER BY slno_inpart ASC ".$limit; 
        $result = dB::mExecuteSql($voters);

        // echo count($result);
        return $result;	        
    }

    function getvotersByid($id){
		$vid ="SELECT * FROM `".TBL_VOTERS_DETAILS."` WHERE id ='$id'"; 
        $result = dB::sExecuteSql($vid);
        return $result;	        
    }
    function getParty($st_id){
		$party ="SELECT * FROM `".TBL_PARTY."` WHERE st_code IN ('NP','$st_id') ORDER BY id ASC "; 
        $result = dB::mExecuteSql($party);
        return $result;	        
    }

    function getScheme(){
        $party ="SELECT * FROM `".TBL_SCHEMES."` ORDER BY id ASC "; 
        $result = dB::mExecuteSql($party);
        return $result;
    }


}