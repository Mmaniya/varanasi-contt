<?php
class Users {

    public function getUserList() {
        $user_qry ="select * from `".TBL_ADMIN_USER."`";   
        $rsUser = dB::mExecuteSql($user_qry); 	
        return $rsUser;
    }

    function addNewUsers($param){
        $query = Table::insertData(array('tableName' => TBL_ADMIN_USER, 'fields' => $param, 'showSql' => 'N')); 
        $rsData = explode('::',$query);
        return  $rsData[0];
    }

    function updateUser($param){

        $where= array('id'=>trim($param['id']));	
		$result = Table::updateData(array('tableName' => TBL_ADMIN_USER, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
        $rsData = explode('::',$result);
        return  $rsData[0];
    }



}
?>