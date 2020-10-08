<?php 
define('ABSPATH',  dirname(__DIR__, 1));
require ABSPATH . "/includes.php";

$action = $_POST['act'];
/*****************************/
/*      ADMIN SIGNIN         */
/*****************************/

if ($action == 'signInAdmin') {
    ob_clean();

    $resultData = Admin::checkCredentials($_POST['username'], $_POST['password']);
    SessionWrite('useremail', $resultData[1]->username);
    SessionWrite('username', $resultData[1]->fullname);
    SessionWrite('last_activity', time());
    SessionWrite('admin_id', $resultData[1]->id);
    SessionWrite('expire_time', 30 * 60);
    $response = array("result" => "Success", "data" => 'Login successfully');
    echo json_encode($response);

    exit();
}
?>