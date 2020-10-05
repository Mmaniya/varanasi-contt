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
            SessionWrite('expire_time',3 * 60);
            $response = array("result" => "Success","data" =>'Login successfully');                     
            echo json_encode($response);

        exit();	
    }

    if($_POST['act'] == SERVICE_CATEGORIES){  
        if(empty($_REQUEST['id'])){
            $param['category_name'] = $_REQUEST['category_name'];
            $param['category_abbr'] = $_REQUEST['category_abbr'];
            $param['category_description'] = $_REQUEST['category_description'];
            $param['added_by']= $_REQUEST['access_level']; 		
            $result = Table::insertData(array('tableName'=>TBL_SERVICE_CATEGORIES,'fields'=>$param,'showSql'=>'N')); 
            $explode = explode('::',$result);
            if(trim($explode[0])=='Success') {
                $response = array("result" => trim($explode[0]),"data" =>'Added Successfully',"insert_id"=>trim($explode[2])); 
            echo  json_encode($response);
            }
        }
    }

?>