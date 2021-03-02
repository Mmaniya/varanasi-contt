<?php
define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php";


if($_GET['type'] == 'search_booth'){
	$data = array();
	
	$lg_const_id = $_GET['lg_const_id'];
	$qry ="select * from `".TBL_BOOTH."` where lg_id =".$lg_const_id." and  booth_no like '%".$_GET['search_string']."%'"; 
	$rsBooth = dB::mExecuteSql($qry); 	
	
	
	
    		
	 if(count($rsBooth)>0) {
		 foreach($rsBooth as $key=>$val) { 
			    $userQry ="SELECT id,name FROM ".TBL_ADMIN_USER." WHERE FIND_IN_SET(".$val->id.",booth_id) > 0"; 
			$rsUserCheck = dB::mExecuteSql($userQry); 	
			if(count($rsUserCheck)>0) {  
			array_push($data,'0|'.$val->booth_no.' : Already Assigned to '.ucwords($rsUserCheck[0]->name).'|');	
			} else { 
			array_push($data, $val->id.'|'.$val->booth_no.'|'.ucwords($val->booth_name));
			} 			 
	    }
           echo json_encode($data);
		   exit();
	   } 
	   else {
	  array_push($data, '0|No Results|');
	  echo json_encode($data);
	      exit();
	 } 		 
}
?>