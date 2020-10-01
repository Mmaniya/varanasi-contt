<?

class Users {
	
	static function checkUserId($username) {
	  		$admin_qry ="select * from `".TBL_ADMIN_USER."` where username = '".$username."'";
			$rsUser = dB::sExecuteSql($admin_qry); 
			if($rsUser->id>0){ 
				return 1;
			}else{
				return 0; 
			}
		}
	   
	static function checkCredentials($username,$password) {
			$usernameExists = Users::checkUserId($username);			
	       if($usernameExists==1) {
				$admin_qry ="select * from `".TBL_ADMIN_USER."` where username = '".$username."' and password='".$password."'";
				$rsUser = dB::sExecuteSql($admin_qry);				
				if($rsUser->id>0) {
					if($rsUser->status == 'A') { 
						$returnArr = array("Success",$rsUser); 				 						
					} else { 
						$returnArr = "User is not active.Please contact webmaster"; 
					}
				} else {				
					$returnArr = "Invalid Password"; }
				} else {
					$returnArr = "Invalid UserName"; 
			}
		  	return $returnArr;
	   }

}


?>