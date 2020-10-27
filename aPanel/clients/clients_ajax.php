<?php 
define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php";
$action = $_POST['act'];

// 1. Add Clients
if ($action == 'add_edit_clients') {
    ob_clean();

    $param['first_name']       = $_POST['first_name'];
    $param['last_name']        = $_POST['last_name'];
    $param['company_name']     = $_POST['company_name'];
    $param['company_website']  = $_POST['company_website'];
    $param['phone_number']     = $_POST['phone_number'];
    $param['email_address']    = $_POST['email_address'];
    $param['password']         = $_POST['password'];
    $param['address']          = $_POST['address'];
    $param['country']          = $_POST['country'];
    $param['city']             = $_POST['city'];
    $param['state']            = $_POST['state'];
    $param['zipcode']          = $_POST['zipcode'];
    $param['description']      = check_input($_POST['description']);

    if (empty(trim($_POST['id']))) {

        $param['added_by']          = $_POST['admin_id'];
        $result = Table::insertData(array('tableName' => TBL_CLIENTS, 'fields' => $param, 'showSql' => 'N'));
        $response = array("result" => 'Success', "data" => 'Added Successfully');
        echo json_encode($response);

    }else{

        $param['updated_by'] = $_POST['admin_id'];
        $where = array('id' => $_POST['id']);
        $result = Table::updateData(array('tableName' => TBL_CLIENTS, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
        $response = array("result" => 'Success', "data" => 'Updated Successfully');
        echo json_encode($response);

    }
    exit();
}

// 2.Clients remove
if($action == 'remove_clients'){
    ob_clean();

    $where = array('id' => $_POST['id']);
    $result = Table::deleteData(array('tableName' => TBL_CLIENTS, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
    $response = array("result" => 'Success', "data" => 'Successfully Removed');
    echo json_encode($response);

    exit();
}

// 3.Clients position

if($action =='clients_position'){
    ob_clean();
    if (count($_POST['clients_id']) > 0) {
        foreach ($_POST['clients_id'] as $key => $val) {
            $param['position'] = $key + 1;
            $where = array('id' => $val);
            $result = Table::updateData(array('tableName' => TBL_CLIENTS, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
        }
        $response = array("result" => 'Success', "data" => 'Updated Successfully');
        echo json_encode($response);
    }
    exit();
}

