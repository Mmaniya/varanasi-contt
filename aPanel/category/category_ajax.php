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

    if ($_FILES['category_image']['name'] != '') {
        $newFileName = '';
        $filename = basename($_FILES['category_image']['name']);
        $file_tmp = $_FILES['category_image']["tmp_name"];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $baseName = basename($filename, $ext);
        $newFileName = rand() . '.' . $ext;
        $param['category_image'] = $newFileName;
        move_uploaded_file($file_tmp = $_FILES['category_image']["tmp_name"], "uploads/categorys_img/" . $newFileName) or die('image upload fail');
    }


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

if ($action == 'category_services') {

    $param['service_name'] = $_POST['service_name'];
    $param['service_description'] = check_input($_POST['service_description']);
    $param['category_id'] = $_POST['category_id'];
    $param['service_payment_type'] = $_POST['service_payment_type'];
    $param['if_recurring_period'] = $_POST['if_recurring_period'];
    $param['recurring_type'] = $_POST['recurring_type'];
    $param['service_price'] = $_POST['service_price'];
    $param['service_delivery_time'] = $_POST['service_delivery_time'];
    $param['service_delivery_type'] = $_POST['service_delivery_type'];
    $param['service_questionnaire_complete_days'] = $_POST['service_questionnaire_complete_days'];

    if ($_FILES['service_img']['name'] != '') {
        $newFileName = '';
        $filename = basename($_FILES['service_img']['name']);
        $file_tmp = $_FILES['service_img']["tmp_name"];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $baseName = basename($filename, $ext);
        $newFileName = rand() . '.' . $ext;
        $param['service_img'] = $newFileName;
        move_uploaded_file($file_tmp = $_FILES['service_img']["tmp_name"], "uploads/" . $newFileName) or die('image upload fail');
    }

    if (empty(trim($_POST['id']))) {
        $param['added_by'] = $_POST['admin_id'];
        $result = Table::insertData(array('tableName' => TBL_SERVICE, 'fields' => $param, 'showSql' => 'N'));
        $explode = explode('::', $result);
                
        $serviceid = trim($explode[2]);

        $param = array();
        if (count($_POST['features']) > 0) {
                $param['service_id'] =  $serviceid ;
            foreach ($_POST['features'] as $key => $val) {
                $param['features'] = $_POST['features'][$key];
                $param['added_date'] = date('Y-m-d H:i:s', time());
                $param['added_by'] = $_SESSION['admin_id'];
                $result = Table::insertData(array('tableName' => TBL_SERVICE_FEATURES, 'fields' => $param, 'showSql' => 'N'));
            }    
        }

        // $param = array();
        // if (count($_POST['featured']) > 0) {
        //         $param['service_id'] =  $serviceid ;
        //     foreach ($_POST['featured'] as $key => $val) {
        //         $param['featured'] = $_POST['featured'][$key];
        //         $param['added_date'] = date('Y-m-d H:i:s', time());
        //         $param['added_by'] = $_SESSION['admin_id'];
        //         $result = Table::insertData(array('tableName' => TBL_SERVICE_FEATURED, 'fields' => $param, 'showSql' => 'N'));
        //     }    
        // }

        $param = array();
        if (count($_POST['question']) > 0) {
                $param['service_id'] =  $serviceid ;
            foreach ($_POST['question'] as $key => $val) {
                $param['question'] = $_POST['question'][$key];
                $param['answer'] = check_input($_POST['answer'][$key]);
                $param['added_date'] = date('Y-m-d H:i:s', time());
                $param['added_by'] = $_SESSION['admin_id'];
                $result = Table::insertData(array('tableName' => TBL_SERVICE_FAQ, 'fields' => $param, 'showSql' => 'N'));
            }
        }

        $param = array();
        if (count($_POST['title']) > 0) {
                $param['service_id'] =  $serviceid ;
            foreach ($_POST['title'] as $key => $val) {
                $param['title'] = $_POST['title'][$key];
                $param['description'] = check_input($_POST['description'][$key]);
                $param['estimated_time'] = $_POST['estimated_time'][$key];
                $param['estimated_type'] = $_POST['estimated_type'][$key];
                $param['added_date'] = date('Y-m-d H:i:s', time());
                $param['added_by'] = $_SESSION['admin_id'];
                $result = Table::insertData(array('tableName' => TBL_SERVICE_STEPS_LINE_ITEM, 'fields' => $param, 'showSql' => 'N'));
            }
        }
        
        if (trim($explode[0]) == 'Success') {
            $response = array("result" => trim($explode[0]), "data" => 'Added Successfully');
            echo json_encode($response);
        } 

    } else {

        
        $param['updated_by'] = $_POST['admin_id'];
        $where = array('id' => $_POST['id']);
        $result = Table::updateData(array('tableName' => TBL_SERVICE, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
        $response = array("result" => 'Success', "data" => 'Updated Successfully');
        echo json_encode($response);
        
        $where = array('service_id' => $_POST['id']);
        $result = Table::deleteData(array('tableName' => TBL_SERVICE_FEATURES, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));

        $param = array();
        if (count($_POST['features']) > 0) {
                $param['service_id'] =  $_POST['id'];
            foreach ($_POST['features'] as $key => $val) {
                if(!empty($_POST['features'][$key])){
                $param['features'] = $_POST['features'][$key];
                $param['added_date'] = date('Y-m-d H:i:s', time());
                $param['added_by'] = $_SESSION['admin_id'];
                $result = Table::insertData(array('tableName' => TBL_SERVICE_FEATURES, 'fields' => $param, 'showSql' => 'N'));
                }
            }    
        }

        $where = array('service_id' => $_POST['id']);
        $result = Table::deleteData(array('tableName' => TBL_SERVICE_FAQ, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
        
        $param = array();
        if (count($_POST['question']) > 0) {
                $param['service_id'] =  $_POST['id'];
            foreach ($_POST['question'] as $key => $val) {
                if(!empty($_POST['question'][$key]) && !empty($_POST['answer'][$key])){
                $param['question'] = $_POST['question'][$key];
                $param['answer'] = $_POST['answer'][$key];
                $param['added_date'] = date('Y-m-d H:i:s', time());
                $param['added_by'] = $_SESSION['admin_id'];
                $result = Table::insertData(array('tableName' => TBL_SERVICE_FAQ, 'fields' => $param, 'showSql' => 'N'));
                }
            }
        }

        $where = array('service_id' => $_POST['id']);
        $result = Table::deleteData(array('tableName' => TBL_SERVICE_STEPS_LINE_ITEM, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));    

        $param = array();
        if (count($_POST['title']) > 0) {
                $param['service_id'] = $_POST['id'];
            foreach ($_POST['title'] as $key => $val) {
                $param['title'] = $_POST['title'][$key];
                $param['description'] = check_input($_POST['description'][$key]);
                $param['estimated_time'] = $_POST['estimated_time'][$key];
                $param['estimated_type'] = $_POST['estimated_type'][$key];
                $param['added_date'] = date('Y-m-d H:i:s', time());
                $param['added_by'] = $_SESSION['admin_id'];
                $result = Table::insertData(array('tableName' => TBL_SERVICE_STEPS_LINE_ITEM, 'fields' => $param, 'showSql' => 'N'));
            }
        }        

    }

    exit();
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


// Features position update

if ($action == 'service_features_position') {
    ob_clean();
    if (count($_POST['features_id']) > 0) {
        foreach ($_POST['features_id'] as $key => $val) {
            $param['position'] = $key + 1;
            $where = array('id' => $val);
            $result = Table::updateData(array('tableName' => TBL_SERVICE_FEATURES, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
        }
        $response = array("result" => 'Success', "data" => 'Updated Successfully');
        echo json_encode($response);
    }
    exit();
}

if ($action == 'features_status_change') {
    $param['status'] = $_POST['status'];
    $param['updated_by'] = $_POST['access_level'];
    $where = array('id' => $_POST['id']);
    $result = Table::updateData(array('tableName' => TBL_SERVICE_FEATURES, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
    $response = array("result" => 'Success', "data" => 'Updated Successfully');
    echo json_encode($response);
}

if ($action == 'set_asfeatured_status'){
    $param['is_featured'] = $_POST['status'];
    $param['updated_by'] = $_POST['access_level'];
    $where = array('id' => $_POST['id']);
    $result = Table::updateData(array('tableName' => TBL_SERVICE_FEATURES, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
    $response = array("result" => 'Success', "data" => 'Updated Successfully');
    echo json_encode($response);
}

if ($action == 'category_service_features_remove') {
    ob_clean();

    $where = array('id' => $_POST['id']);
    $result = Table::deleteData(array('tableName' => TBL_SERVICE_FEATURES, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));

    $response = array("result" => 'Success', "data" => 'Successfully Removed');
    echo json_encode($response);

    exit();
}

if($action == 'update_category_service_features'){

    $param['features'] = $_POST['features'];
    $param['updated_by'] = $_POST['admin_id'];
    $where = array('id' => $_POST['id']);
    $result = Table::updateData(array('tableName' => TBL_SERVICE_FEATURES, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
    $response = array("result" => 'Success', "data" => 'Updated Successfully');
    echo json_encode($response);
}


// faq position update

if ($action == 'service_faq_position') {
    ob_clean();
    if (count($_POST['faq_id']) > 0) {
        foreach ($_POST['faq_id'] as $key => $val) {
            $param['position'] = $key + 1;
            $where = array('id' => $val);
            $result = Table::updateData(array('tableName' => TBL_SERVICE_FAQ, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
        }
        $response = array("result" => 'Success', "data" => 'Updated Successfully');
        echo json_encode($response);
    }
    exit();
}

if ($action == 'service_faq_status') {
    $param['status'] = $_POST['status'];
    $param['updated_by'] = $_POST['access_level'];
    $where = array('id' => $_POST['id']);
    $result = Table::updateData(array('tableName' => TBL_SERVICE_FAQ, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
    $response = array("result" => 'Success', "data" => 'Updated Successfully');
    echo json_encode($response);
}

if ($action == 'category_service_faq_remove') {
    ob_clean();

    $where = array('id' => $_POST['id']);
    $result = Table::deleteData(array('tableName' => TBL_SERVICE_FAQ, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));

    $response = array("result" => 'Success', "data" => 'Successfully Removed');
    echo json_encode($response);

    exit();
}


// steps position update

if ($action == 'service_step_position') {
    ob_clean();
    if (count($_POST['step_id']) > 0) {
        foreach ($_POST['step_id'] as $key => $val) {
            $param['position'] = $key + 1;
            $where = array('id' => $val);
            $result = Table::updateData(array('tableName' => TBL_SERVICE_STEPS_LINE_ITEM, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
        }
        $response = array("result" => 'Success', "data" => 'Updated Successfully');
        echo json_encode($response);
    }
    exit();
}

if ($action == 'steps_status_change') {
    $param['status'] = $_POST['status'];
    $param['updated_by'] = $_POST['access_level'];
    $where = array('id' => $_POST['id']);
    $result = Table::updateData(array('tableName' => TBL_SERVICE_STEPS_LINE_ITEM, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
    $response = array("result" => 'Success', "data" => 'Updated Successfully');
    echo json_encode($response);
}

if ($action == 'category_service_step_remove') {
    ob_clean();

    $where = array('id' => $_POST['id']);
    $result = Table::deleteData(array('tableName' => TBL_SERVICE_STEPS_LINE_ITEM, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));

    $response = array("result" => 'Success', "data" => 'Successfully Removed');
    echo json_encode($response);

    exit();
}


?>