<?php require ("../includes.php"); 
$action = $_POST['act'];

/*****************************/
/*      ADMIN SIGNIN         */
/*****************************/

    if($action == 'signInAdmin') { 
        ob_clean();  

            $resultData = Admin::checkCredentials($_POST['username'],$_POST['password']);           
            SessionWrite('useremail',$resultData[1]->username);
            SessionWrite('username',$resultData[1]->fullname);   
            SessionWrite('last_activity',time());   
            SessionWrite('access_level','SA');   
            SessionWrite('expire_time',2 * 60);
            $response = array("result" => "Success","data" =>'Login successfully');                     
            echo json_encode($response);

        exit();	
    }

?>