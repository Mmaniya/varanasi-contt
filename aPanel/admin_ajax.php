<?php 
define('ABSPATH',  dirname(__DIR__, 1));
require ABSPATH . "/includes.php";

$action = $_POST['act'];
/*****************************/
/*      ADMIN SIGNIN         */
/*****************************/

if ($action == 'signInAdmin') {
    ob_clean();

    $resultData = Admin::checkCredentials($_POST['email'], $_POST['password']);
    SessionWrite('useremail', $resultData[1]->email);
    SessionWrite('username', $resultData[1]->name);    
    SessionWrite('user_id', $resultData[1]->id);
    SessionWrite('state_id', $resultData[1]->state_id);
    SessionWrite('district_id', $resultData[1]->district_id);    
    SessionWrite('lg_const_id', $resultData[1]->lg_const_id);
    SessionWrite('booth_id', $resultData[1]->booth_id);
    SessionWrite('admin_role', $resultData[1]->user_type);
    echo $resultData[0];

    exit();
}
?>