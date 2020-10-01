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
            SessionWrite('logged_in',true);   
            SessionWrite('last_activity',time());   
            SessionWrite('expire_time',1 * 60);
            $response = array("result" => "Success","data" =>'Login successfully');                     
            echo json_encode($response);

        exit();	
    }

?>