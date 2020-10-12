<?php 
define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php";
$action = $_POST['act'];

if ($action == 'service_categories') {

    ob_clean();
    $param['category_name'] = $_POST['category_name'];
    $param['category_abbr'] = $_POST['category_abbr'];

    $discription = check_input($_POST['category_description']);

    $param['category_description'] = html_entity_decode($discription);

    if (empty($_POST['id'])) {
        $param['added_by'] = $_POST['admin_id'];
        $result = Table::insertData(array('tableName' => TBL_SERVICE_CATEGORIES, 'fields' => $param, 'showSql' => 'N'));
        $explode = explode('::', $result);
        if (trim($explode[0]) == 'Success') {
            $response = array("result" => trim($explode[0]), "data" => 'Added Successfully');
            echo json_encode($response);
        }
    } else {
        $param['updated_by'] = $_POST['admin_id'];
        $where = array('id' => $_POST['id']);
        $result = Table::updateData(array('tableName' => TBL_SERVICE_CATEGORIES, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
        $response = array("result" => 'Success', "data" => 'Updated Successfully');
        echo json_encode($response);
    }
    exit();
}

if ($action == 'category_position') {
    ob_clean();
    if (count($_POST['category_id']) > 0) {
        foreach ($_POST['category_id'] as $key => $val) {
            $param['position'] = $key + 1;
            $where = array('id' => $val);
            $result = Table::updateData(array('tableName' => TBL_SERVICE_CATEGORIES, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
        }
        $response = array("result" => 'Success', "data" => 'Updated Successfully');
        echo json_encode($response);
    }
    exit();
}

if ($action == 'category_remove') {
    ob_clean();
    $where = array('id' => $_POST['id']);
    $result = Table::deleteData(array('tableName' => TBL_SERVICE_CATEGORIES, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
    $response = array("result" => 'Success', "data" => 'Successfully Removed');
    echo json_encode($response);

    exit();
}

if ($action == 'category_status_change') {
    $param['status'] = $_POST['status'];
    $param['updated_by'] = $_POST['admin_id'];
    $where = array('id' => $_POST['id']);
    $result = Table::updateData(array('tableName' => TBL_SERVICE_CATEGORIES, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
    $response = array("result" => 'Success', "data" => 'Updated Successfully');
    echo json_encode($response);
}

if ($action == 'service_status_change') {
    $param['status'] = $_POST['status'];
    $param['updated_by'] = $_POST['access_level'];
    $where = array('id' => $_POST['id']);
    $result = Table::updateData(array('tableName' => TBL_SERVICE, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
    $response = array("result" => 'Success', "data" => 'Updated Successfully');
    echo json_encode($response);
}

if ($action == 'category_service_position') {
    ob_clean();
    if (count($_POST['service_id']) > 0) {
        foreach ($_POST['service_id'] as $key => $val) {
            $param['position'] = $key + 1;
            $where = array('id' => $val);
            $result = Table::updateData(array('tableName' => TBL_SERVICE, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
        }
        $response = array("result" => 'Success', "data" => 'Updated Successfully');
        echo json_encode($response);
    }
    exit();
}

if ($action == 'category_service_remove') {
    ob_clean();

    $where = array('id' => $_POST['id']);
    $result = Table::deleteData(array('tableName' => TBL_SERVICE, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));

    $where = array('service_id' => $_POST['id']);
    $result = Table::deleteData(array('tableName' => TBL_SERVICE_FEATURES, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));

    $where = array('service_id' => $_POST['id']);
    $result = Table::deleteData(array('tableName' => TBL_SERVICE_FAQ, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
        
    $response = array("result" => 'Success', "data" => 'Successfully Removed');
    echo json_encode($response);

    exit();
}


?>