<?php 
define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php";
$action = trim($_REQUEST['act']);

// if ($action == 'services') {
//     ob_clean();

//     $param['service_name'] = $_POST['service_name'];
//     $param['service_description'] = $_POST['service_description'];
//     $param['category_id'] = $_POST['category_id'];
//     $param['service_payment_type'] = $_POST['service_payment_type'];
//     $param['if_recurring_period'] = $_POST['if_recurring_period'];
//     $param['recurring_type'] = $_POST['recurring_type'];
//     $param['service_price'] = $_POST['service_price'];
//     $param['service_delivery_time'] = $_POST['service_delivery_time'];
//     $param['service_delivery_type'] = $_POST['service_delivery_type'];
//     $param['service_questionnaire_complete_days'] = $_POST['service_questionnaire_complete_days'];

//     if ($_FILES['service_img']['name'] != '') {
//         $newFileName = '';
//         $filename = basename($_FILES['service_img']['name']);
//         $file_tmp = $_FILES['service_img']["tmp_name"];
//         $ext = pathinfo($filename, PATHINFO_EXTENSION);
//         $baseName = basename($filename, $ext);
//         $newFileName = rand() . '.' . $ext;
//         $param['service_img'] = $newFileName;
//         move_uploaded_file($file_tmp = $_FILES['service_img']["tmp_name"], "uploads/" . $newFileName) or die('image upload fail');
//     }

//     if (empty($_POST['id'])) {
//         $param['added_by'] = $_POST['access_level'];
//         $result = Table::insertData(array('tableName' => TBL_SERVICE, 'fields' => $param, 'showSql' => 'N'));
//         $explode = explode('::', $result);
//         if (trim($explode[0]) == 'Success') {
//             $response = array("result" => trim($explode[0]), "data" => 'Added Successfully');
//             echo json_encode($response);
//         }
//     } else {
//         $param['updated_by'] = $_POST['access_level'];
//         $where = array('id' => $_POST['id']);
//         $result = Table::updateData(array('tableName' => TBL_SERVICE, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
//         $response = array("result" => 'Success', "data" => 'Updated Successfully');
//         echo json_encode($response);
//     }

//     exit();
// }



// if ($action == 'category_services') {

//     $param['service_name'] = $_POST['service_name'];
//     $param['service_description'] = $_POST['service_description'];
//     $param['category_id'] = $_POST['category_id'];
//     $param['service_payment_type'] = $_POST['service_payment_type'];
//     $param['if_recurring_period'] = $_POST['if_recurring_period'];
//     $param['recurring_type'] = $_POST['recurring_type'];
//     $param['service_price'] = $_POST['service_price'];
//     $param['service_delivery_time'] = $_POST['service_delivery_time'];
//     $param['service_delivery_type'] = $_POST['service_delivery_type'];
//     $param['service_questionnaire_complete_days'] = $_POST['service_questionnaire_complete_days'];

//     if ($_FILES['service_img']['name'] != '') {
//         $newFileName = '';
//         $filename = basename($_FILES['service_img']['name']);
//         $file_tmp = $_FILES['service_img']["tmp_name"];
//         $ext = pathinfo($filename, PATHINFO_EXTENSION);
//         $baseName = basename($filename, $ext);
//         $newFileName = rand() . '.' . $ext;
//         $param['service_img'] = $newFileName;
//         move_uploaded_file($file_tmp = $_FILES['service_img']["tmp_name"], "uploads/" . $newFileName) or die('image upload fail');
//     }

//     if (empty(trim($_POST['id']))) {
//         $param['added_by'] = $_POST['admin_id'];
//         $result = Table::insertData(array('tableName' => TBL_SERVICE, 'fields' => $param, 'showSql' => 'N'));
//         $explode = explode('::', $result);
                
//         $serviceid = trim($explode[2]);
//         $param = array();
//         if (count($_POST['features']) > 0) {
//                 $param['service_id'] =  $serviceid ;
//             foreach ($_POST['features'] as $key => $val) {
//                 $param['features'] = $_POST['features'][$key];
//                 $param['added_date'] = date('Y-m-d H:i:s', time());
//                 $param['added_by'] = $_SESSION['admin_id'];
//                 $result = Table::insertData(array('tableName' => TBL_SERVICE_FEATURES, 'fields' => $param, 'showSql' => 'N'));
//             }    
//         }

//         $param = array();
//         if (count($_POST['question']) > 0) {
//                 $param['service_id'] =  $serviceid ;
//             foreach ($_POST['question'] as $key => $val) {
//                 $param['question'] = $_POST['question'][$key];
//                 $param['answer'] = $_POST['answer'][$key];
//                 $param['added_date'] = date('Y-m-d H:i:s', time());
//                 $param['added_by'] = $_SESSION['admin_id'];
//                 $result = Table::insertData(array('tableName' => TBL_SERVICE_FAQ, 'fields' => $param, 'showSql' => 'N'));
//             }
//         }

//         if (trim($explode[0]) == 'Success') {
//             $response = array("result" => trim($explode[0]), "data" => 'Added Successfully');
//             echo json_encode($response);
//         } 

//     } else {

        
//         $param['updated_by'] = $_POST['admin_id'];
//         $where = array('id' => $_POST['id']);
//         $result = Table::updateData(array('tableName' => TBL_SERVICE, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
//         $response = array("result" => 'Success', "data" => 'Updated Successfully');
//         echo json_encode($response);
        
//         $where = array('service_id' => $_POST['id']);
//         $result = Table::deleteData(array('tableName' => TBL_SERVICE_FEATURES, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));

//         $param = array();
//         if (count($_POST['features']) > 0) {
//                 $param['service_id'] =  $_POST['id'] ;
//             foreach ($_POST['features'] as $key => $val) {
//                 if(!empty($_POST['features'][$key])){
//                 $param['features'] = $_POST['features'][$key];
//                 $param['added_date'] = date('Y-m-d H:i:s', time());
//                 $param['added_by'] = $_SESSION['admin_id'];
//                 $result = Table::insertData(array('tableName' => TBL_SERVICE_FEATURES, 'fields' => $param, 'showSql' => 'N'));
//                 }
//             }    
//         }
        
//         $where = array('service_id' => $_POST['id']);
//         $result = Table::deleteData(array('tableName' => TBL_SERVICE_FAQ, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
        
//         $param = array();
//         if (count($_POST['question']) > 0) {
//                 $param['service_id'] =  $_POST['id'] ;
//             foreach ($_POST['question'] as $key => $val) {
//                 if(!empty($_POST['question'][$key]) && !empty($_POST['answer'][$key])){
//                 $param['question'] = $_POST['question'][$key];
//                 $param['answer'] = $_POST['answer'][$key];
//                 $param['added_date'] = date('Y-m-d H:i:s', time());
//                 $param['added_by'] = $_SESSION['admin_id'];
//                 $result = Table::insertData(array('tableName' => TBL_SERVICE_FAQ, 'fields' => $param, 'showSql' => 'N'));
//                 }
//             }
//         }

//     }

//     exit();
// }



if ($action == 'service_status_change') {
    $param['status'] = $_POST['status'];
    $param['updated_by'] = $_POST['access_level'];
    $where = array('id' => $_POST['id']);
    $result = Table::updateData(array('tableName' => TBL_SERVICE, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
    $response = array("result" => 'Success', "data" => 'Updated Successfully');
    echo json_encode($response);
}

// if ($action == 'service_position') {
//     ob_clean();
//     if (count($_POST['service_id']) > 0) {
//         foreach ($_POST['service_id'] as $key => $val) {
//             $param['position'] = $key + 1;
//             $where = array('id' => $val);
//             $result = Table::updateData(array('tableName' => TBL_SERVICE, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
//         }
//         $response = array("result" => 'Success', "data" => 'Updated Successfully');
//         echo json_encode($response);
//     }
//     exit();
// }

if ($action == 'faq_position') {
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

if ($action == 'feature_position') {
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

if ($action == 'service_remove') {
    ob_clean();

    $where = array('id' => $_POST['id']);
    $result = Table::deleteData(array('tableName' => TBL_SERVICE, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
    $response = array("result" => 'Success', "data" => 'Successfully Removed');
    echo json_encode($response);

    exit();
}

if ($action == 'filter_service_category') {
    ob_clean();

    if ($_POST['filter_type'] == 'service_name') {
        $filter_text = $_POST['filter_text'];
        $condition = array('service_name' => $filter_text . '-STRING');
    }

    if ($_POST['filter_type'] == 'category') {
        $filter_category = $_POST['filter_category'];
        $condition = array('category_id' => $filter_category . '-INT');}

    if ($_POST['filter_type'] == 'status') {
        $filter_status = $_POST['filter_status'];
        $condition = array('status' => $filter_status . '-CHAR');
    }

    $param = array('tableName' => TBL_SERVICE, 'fields' => array('*'), 'condition' => $condition, 'showSql' => 'N');
    $rsServices = Table::getData($param);
    $statusArr = array('A' => 'checked', 'I' => '');

    if (count($rsServices) > 0) {
        foreach ($rsServices as $key => $value) {
            ?>
<tr class="row_id_<?php echo $value->id; ?>">
    <th><?php echo $key + 1 ?></th>
    <td><?php echo $value->service_name ?></td>
    <td><?php echo money($value->service_price, '$') ?></td>
    <td>
        <div class="btn-group " role="group" data-toggle="tooltip" data-placement="top" title=""
            data-original-title=".btn-xlg">
            <a href="javascript:void(0);" class="btn btn-primary btn-sm waves-effect waves-light"
                onclick="add_edit_service(<?php echo $value->id; ?>)">Edit</a>
            <a href="javascript:void(0);" class="btn btn-primary btn-sm waves-effect waves-light"
                onclick="delete_service(<?php echo $value->id; ?>)">Delete</a>
        </div>
    </td>
    <td>
        <label class="switch">
            <input type="checkbox" class="status_update_<?php echo $value->id; ?>"
                onchange="statusService(<?php echo $value->id; ?>)" <?php echo $statusArr[$value->status]; ?>>
            <span class="slider round"></span>
        </label>
    </td>
</tr>

<?php }
    }
    exit();
}

if ($action == 'delete_service_feature') {
    ob_clean();
        $where = array('id' => $_POST['feature_id']);
        Table::deleteData(array('tableName' => TBL_SERVICE_FEATURES, 'fields' => "*", 'showSql' => 'N', 'where' => $where));
        $response = array("result" => 'Success', "data" => 'Successfully Deleted');
        echo json_encode($response);
    exit();
}

if ($action == 'submit_service_features') {
    ob_clean();
    $feature_id = $_POST['feature_id'];
    $param['service_id'] = $_POST['service_id'];
    if ($feature_id == '') {
        if (count($_POST['title']) > 0) {
            foreach ($_POST['title'] as $key => $val) {
                $param['title'] = $_POST['title'][$key];
                $param['added_date'] = date('Y-m-d H:i:s', time());
                $param['added_by'] = $_SESSION['admin_id'];
                $result = Table::insertData(array('tableName' => TBL_SERVICE_FEATURES, 'fields' => $param, 'showSql' => 'N'));
            }
            $explode = explode('::', $result);
            if (trim($explode[0]) == 'Success') {
                $response = array("result" => trim($explode[0]), "data" => 'Added Successfully');
                echo json_encode($response);
            }
        }
    } else {
        $param['title'] = $_POST['title'];
        $param['updated_by'] = $_SESSION['admin_id'];
        $where = array('id' => $_POST['feature_id']);
        $result = Table::updateData(array('tableName' => TBL_SERVICE_FEATURES, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
        $explode = explode('::', $result);
        if (trim($explode[0]) == 'Success') {
            $response = array("result" => trim($explode[0]), "data" => 'Updated Successfully');
            echo json_encode($response);
        }
    }
    exit();
} 

if ($action == 'submit_service_faq') {
    ob_clean();
    $faq_id = $_POST['faq_id'];
    $param['service_id'] = $_POST['service_id'];
    if ($faq_id == '') {
        if (count($_POST['question']) > 0) {
            foreach ($_POST['question'] as $key => $val) {
                $param['question'] = $_POST['question'][$key];
                $param['answer'] = $_POST['answer'][$key];
                $param['added_date'] = date('Y-m-d H:i:s', time());
                $param['added_by'] = $_SESSION['admin_id'];
                $result = Table::insertData(array('tableName' => TBL_SERVICE_FAQ, 'fields' => $param, 'showSql' => 'N'));
            }

            $explode = explode('::', $result);
            if (trim($explode[0]) == 'Success') {
                $response = array("result" => trim($explode[0]), "data" => 'Added Successfully');
                echo json_encode($response);
            }
        }
    } else {
        $param['question'] = $_POST['question'];
        $param['answer'] = $_POST['answer'];
        $param['updated_by'] = $_SESSION['admin_id'];
        $where = array('id' => $_POST['faq_id']);
        $result = Table::updateData(array('tableName' => TBL_SERVICE_FAQ, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
        $explode = explode('::', $result);
        if (trim($explode[0]) == 'Success') {
            $response = array("result" => trim($explode[0]), "data" => 'Updated Successfully');
            echo json_encode($response);
        }
    }
    exit();
}

if ($action == 'delete_service_faq') {
    ob_clean();
    $where = array('id' => $_POST['feature_id']);
    Table::deleteData(array('tableName' => TBL_SERVICE_FAQ, 'fields' => "*", 'showSql' => 'N', 'where' => $where));
    $response = array("result" => 'Success', "data" => 'Successfully Deleted');
    echo json_encode($response);
    exit();
}

?>